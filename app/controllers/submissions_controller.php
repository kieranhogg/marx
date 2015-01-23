<?php
class SubmissionsController extends AppController {

    var $name = 'Submissions';

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid submission', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Submission->recursive = 2;
        $fields = array('id', 'filename', 'user_id', 'unit_id', 'task_id', 'status_id', 
                        'mark_id', 'teacher_id', 'comment', 'created', 
                        'response_filename'
                  );
        $submission = $this->Submission->read($fields, $id);

        if ($this->Session->read('Auth.User.role') == 'Student') {
            if ($submission['Submission']['user_id'] == $this->Session->read('Auth.User.id')) {
                $this->Submission->setViewed($id);
            }
            else {
                $this->Session->setFlash(__('Permission denied', true));
                $this->redirect('/');
                exit;
            }
        }
        $this->set('submission', $submission);
    }

    function add() {
        if (!empty($this->data) && is_uploaded_file($this->params['data']['Submission']['Upload']['tmp_name'])) {
            $file = $this->params['data']['Submission']['Upload'];

            if($file['size'] > 0) {
                $file_data = fread(fopen($file['tmp_name'],"r"), $file['size']);
                $this->data['Submission']['file'] = $file_data;    
                $this->Submission->create();
                $this->data['Submission']['user_id'] = $this->Session->read('Auth.User.id');
                $this->data['Submission']['filename'] = $file['name'];
                $this->data['Submission']['type'] = $file['type'];
                $this->data['Submission']['size'] = $file['size'];

               if ($this->Submission->save($this->data)) {
                    //get data for email template
                    $this->loadModel('Group');
                    $this->Group->recursive = 0;
                    $group_data = $this->Group->find('all', array('conditions' => array('Group.id' => $this->data['Submission']['group_id'])));
                    $send_email = $group_data[0]['Teacher']['email_notification'];
                    if ($send_email == 1) {
                        $this->loadModel('User');
                        $this->loadModel('Task');
                        $this->User->recursive = 0;
                        $this->Task->recursive = 0;
                        $task_data = $this->Task->find('all', array('conditions' => array('Task.id' => $this->data['Submission']['task_id'])));
                        $user_data = $this->User->find('all', array('conditions' => array('User.id' => $this->Session->read('Auth.User.id'))));
                        $template_vars['group'] = $group_data[0]['Group']['code'];
                        $template_vars['email'] = $group_data[0]['Teacher']['email'];
                        $template_vars['full_name'] =  $group_data[0]['Teacher']['salutation'].' '.$group_data[0]['Teacher']['surname'];
                        $template_vars['student_name'] = $user_data[0]['User']['full_name'];
                        $template_vars['task'] = $task_data[0]['Task']['code'];
                        $template_vars['unit'] = $task_data[0]['Unit']['code'];
                        $template_vars['filename'] = $file['name'];
                        $template_vars['mark_url'] = Router::url("/", true).'submissions/mark/'.$this->Submission->getLastInsertId();
                        $this->requestAction(array('controller' => 'Mailer', 'action' => 'sendTeacherMail', 'pass' => array($template_vars)));
                    }
                    $this->Session->setFlash(__('The submission has been saved', true));
                    $this->redirect(array('controller' => 'groups', 'action' => 'mine'));
                } else {
                    $this->Session->setFlash(__('The submission could not be saved. Please, try again.', true));
                }
            } 
            else {
                $this->Session->setFlash(__('There was an error uploading the file, please try again later.', true));
            }
        }
        else {
            //FIXME must be a better way...
            $units = $this->Submission->query("
                select units.id
                from units, groups_units, groups, groups_users, users
                where units.id = groups_units.unit_id
                and groups_units.group_id = groups.id
                and groups.id = groups_users.group_id
                and groups_users.user_id = users.id
                and users.id = ".$this->Session->read('Auth.User.id'));
            
            //flatten the array to check permissions in the view
            foreach ($units as $key => $val) {
                $units[$key] = $val['units']['id'];
            }

            $tasks = $this->Submission->query("
                select tasks.id
                from tasks, units, groups_units, groups, groups_users, users
                where tasks.unit_id = units.id
                and units.id = groups_units.unit_id
                and groups_units.group_id = groups.id
                and groups.id = groups_users.group_id
                and groups_users.user_id = users.id
                and users.id = ".$this->Session->read('Auth.User.id'));
            
            //flatten the array to check permissions in the view
            foreach ($tasks as $key => $val) {
                $tasks[$key] = $val['tasks']['id'];
            }

            $groups = $this->Submission->query("
                select groups.id
                from groups, groups_users, users
                where groups.id = groups_users.group_id
                and groups_users.user_id = users.id
                and users.id = ".$this->Session->read('Auth.User.id'));
            
            //flatten the array to check permissions in the view
            foreach ($groups as $key => $val) {
                $groups[$key] = $val['groups']['id'];
            }
            if (!in_array($this->params['named']['group'], $groups) OR
                !in_array($this->params['named']['task'], $tasks) OR
                !in_array($this->params['named']['unit'], $units)) {
                $this->Session->setFlash(__("You don't have permission to submit there", true));
                $this->redirect('/');
                exit;
            }
            $this->set(compact('units', 'groups', 'tasks'));
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid submission', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Submission->save($this->data)) {
                $this->Session->setFlash(__('The submission has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The submission could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Submission->read(null, $id);
        }
        $users = $this->Submission->User->find('list');
        $units = $this->Submission->Unit->find('list');
        $tasks = $this->Submission->Task->find('list');
        $teachers = $this->Submission->Teacher->find('list');
        $this->set(compact('users', 'units', 'tasks', 'teachers'));
    }

    function mark($id = null) {
        // only teachers can mark
//         if (!$this->Session->check('Teacher')) {
//             $this->Session->setFlash(__('You must be logged in as a Teacher to mark a submission', true));
//             $this->redirect('/');
//         }

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid submission', true));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->data)) {
            // set the submission to unviewed by the user
            $this->data['Submission']['viewed'] = 0;
            $file = $this->params['data']['Submission']['Upload'];
            if (!isset($this->data['Submission']['remove_response']) OR
                $this->data['Submission']['remove_response'] != 1) {
                if(is_uploaded_file($file['tmp_name']) AND $file['size'] > 0) {
                    $file_data = fread(fopen($file['tmp_name'],"r"), $file['size']);
                    $this->data['Submission']['response'] = $file_data;    
                    $this->Submission->create();
                    $this->data['Submission']['teacher_id'] = $this->Session->read('Auth.User.id');
                    $this->data['Submission']['response_filename'] = $file['name'];
                    $this->data['Submission']['response_type'] = $file['type'];
                    $this->data['Submission']['response_size'] = $file['size'];
/*                    die(pr($this->data['Submission']));*/
                }
            }
            else {
                    $this->data['Submission']['response'] = null;
                    $this->data['Submission']['response_filename'] = null;
                    $this->data['Submission']['response_type'] = null;
                    $this->data['Submission']['response_size'] = null;
            }

            if ($this->Submission->save($this->data)) {
                $this->Submission->recursive = 2;
                $submission_data = $this->Submission->find('all', array('conditions' => array('Submission.id' => $this->data['Submission']['id'])));
                if (!empty($submission_data[0]['User']['email']) AND $submission_data[0]['User']['email_notification'] == 1) {
                    $template_vars['email'] = $submission_data[0]['User']['email'];
                    $template_vars['forename'] = $submission_data[0]['User']['forename'];
                    $template_vars['teacher_name'] = $submission_data[0]['Group']['Teacher']['salutation']. ' '.$submission_data[0]['Group']['Teacher']['surname'];
                    $template_vars['group'] = $submission_data[0]['Group']['code'];
                    $template_vars['unit'] = $submission_data[0]['Unit']['code'];
                    $template_vars['task'] = $submission_data[0]['Task']['code'];
                    $template_vars['mark'] = $submission_data[0]['Mark']['status'];
                    $template_vars['status'] = $submission_data[0]['Status']['status'];
                    $template_vars['submission_url'] = Router::url("/", true).'submissions/view/'.$submission_data[0]['Submission']['id'];
                    $template_vars['comments'] = $submission_data[0]['Submission']['comment'];
                    $this->requestAction(array('controller' => 'Mailer', 'action' => 'sendUserMail', 'pass' => array($template_vars)));
                }
                $this->Session->setFlash(__('The submission has been saved', true));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The submission could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->loadModel('Status');
            $this->loadModel('Mark');
            $this->set('all_statuses', $this->Status->find('list'));
            $this->set('all_marks', $this->Mark->find('list'));
            $this->Submission->recursive = 2;
            $this->data = $this->Submission->read(null, $id);
        }
        $users = $this->Submission->User->find('list');
        $units = $this->Submission->Unit->find('list');
        $tasks = $this->Submission->Task->find('list');
        $icon = $this->Submission->getIcon($this->Submission->data['Submission']['type']);
        if (isset($this->Submission->data['Submission']['response_filename'])) {
            $response_icon = $this->Submission->getIcon($this->Submission->data['Submission']['response_type']);
        }
        //$teachers = $this->Submission->Teacher->find('list');
        $this->set(compact('users', 'units', 'tasks', 'teachers', 'icon', 'response_icon'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for submission', true));
            $this->redirect($this->referrer);
        }
        if ($this->Submission->delete($id)) {
            $this->Session->setFlash(__('Submission deleted', true));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Submission was not deleted', true));
        $this->redirect($this->referer);
    }

    function admin_index() {
        $this->paginate = array('order'=>array('Submission.created' => 'desc'));
        $this->Submission->recursive = 0;
        $this->set('submissions', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid submission', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('submission', $this->Submission->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Submission->create();
            if ($this->Submission->save($this->data)) {
                $this->Session->setFlash(__('The submission has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The submission could not be saved. Please, try again.', true));
            }
        }
        $users = $this->Submission->User->find('list');
        $units = $this->Submission->Unit->find('list');
        $tasks = $this->Submission->Task->find('list');
        $teachers = $this->Submission->Teacher->find('list');
        $this->set(compact('users', 'units', 'tasks', 'teachers'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid submission', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Submission->save($this->data)) {
                $this->Session->setFlash(__('The submission has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The submission could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Submission->read(null, $id);
        }
        $users = $this->Submission->User->find('list');
        $units = $this->Submission->Unit->find('list');
        $tasks = $this->Submission->Task->find('list');
        $teachers = $this->Submission->Teacher->find('list');
        $this->set(compact('users', 'units', 'tasks', 'teachers'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for submission', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Submission->delete($id)) {
            $this->Session->setFlash(__('Submission deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Submission was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

    function download($id) {
       //I like to restrict this to logged in users
 
//          $user=$this->Session->read('User');
//          if(!isset($user['User'])){
//             $this->Session->setFlash("Ya'lls gots'ta be logged in fer to fetch these pages");
//             $this->redirect('/');
//         }
       //IMPORTANT!  turn off debug output, will corrupt filestream.      
        Configure::write('debug', 0);
        $this->Submission->recursive=-1;
        //FIXME need to check users
        $file = $this->Submission->findById($id);
 
       //just in case its been deleted, or someone is getting frisky
        if(!isset($file['Submission']['filename'])){
            $this->Session->setFlash("Problem. Either;<ul><li>We no longer have that file</li><li>We never did.</li><li>You don't have rights</li></ul>");
            $this->redirect('/');
 
        }
        //set the file variabl up for use in our view
        $this->set('file',$file);
 
        // we'll use a new layout, file, that will allow custom headers
        $this->render(null,'file');
    }

    function download_response($id) {
        $this->Submission->recursive=-1;
        //FIXME need to check users
        $file = $this->Submission->findById($id);
        if(!isset($file['Submission']['response_filename'])){
            $this->Session->setFlash("Problem. Either;<ul><li>We no longer have that file</li><li>We never did.</li><li>You don't have rights</li></ul>");
            $this->redirect('/');
        }

        $file['Submission']['type'] = $file['Submission']['response_type'];
        $file['Submission']['filename'] = $file['Submission']['response_filename'];
        $file['Submission']['file'] = $file['Submission']['response'];
        $file['Submission']['size'] = $file['Submission']['response_size'];
        $this->set('file',$file);

        $this->render(null,'file');
    }
 
    function show($id) {
        //set up a variable, so the view well knwo to show it, not prompt to download
        $this->set('inpage',true);
 
        //in my actual controller i do some logic here to set up an array of ''allowed file ids''  but to kepp it simple, well assume everyone can see
 
       //IMPORTANT!  turn off debug output, will corrupt filestream.      
        Configure::write('debug', 0);
        $this->ProjectFile->recursive=-1;
        $file = $this->ProjectFile->findById($id,'user_id = '.$user['User']['id']);
 
        if(!isset($file['ProjectFile']['name']) || substr($file['ProjectFile']['type'],0,5)!='image'){
            echo 'Not an image file';
            exit;           
        }
        //set the file variabl up for use in our view
        $this->set('file',$file);
 
        // we'll use our new layout, file,BUT well also use the same view, download
        $this->render('download','file');
    }

    function mine() {
        // we do this to prevent fetching the actual files
        $fields = 'Submission.id, type, filename, size, created, Unit.id, 
                   Unit.code, Task.id, Task.code, Status.status, Mark.status,
                   Group.id, Group.code, viewed';
        $user_id = $this->Session->read('Auth.User.id');
        $this->set('submissions', $this->Submission->find('all', 
            array('fields' => $fields,
                 'conditions' => array('Submission.user_id' => $user_id))));
        $this->paginate('Submission', array('Submission.user_id' => $user_id));
    }
}
?>
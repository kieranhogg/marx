<?php
class TeachersController extends AppController {

    var $name = 'Teachers';

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->userModel = 'Teacher';
        $this->Auth->allow('login');
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginError = 'Invalid e-mail / password combination.  Please try again';
        $this->Auth->loginRedirect = array('controller' => 'teachers', 'action' => 'dashboard');
        // if we're asking for a teacher login but not from the users 
        // controller, send it there; bug workaround
        if (($this->params['url']['url'] == 'teachers/login') AND $this->referer() != 'users/login') {
            $this->redirect('/users/login');
            exit;
        }
    }

    function afterFilter() {
        $this->Auth->userModel = 'User';
    }

    function index() {
        $this->Teacher->recursive = 0;
        $this->set('teachers', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid teacher', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('teacher', $this->Teacher->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Teacher->create();
            if ($this->Teacher->save($this->data)) {
                $this->Session->setFlash(__('The teacher has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The teacher could not be saved. Please, try again.', true));
            }
        }
        $subjects = $this->Teacher->Subject->find('list');
        $this->set(compact('subjects'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid teacher', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Teacher->save($this->data)) {
                $this->Session->setFlash(__('The teacher has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The teacher could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Teacher->read(null, $id);
        }
        $subjects = $this->Teacher->Subject->find('list');
        $this->set(compact('subjects'));
    }

    function settings($teacher_id = null) {
        if ($teacher_id == null) {
            $teacher_id = $this->Session->read('Auth.User.id');
        }

        if (!$teacher_id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect('/');
        }
        if (!empty($this->data)) {
            $this->data['Teacher']['id'] = $teacher_id;
            if (!empty($this->data['Teacher']['new_password'])) {
                if ($this->data['Teacher']['new_password'] == $this->data['Teacher']['new_password_repeat']) {
                    $this->data['Teacher']['password'] = $this->Auth->password($this->data['Teacher']['new_password']);
                }
                else {
                    $this->Session->setFlash(__('Your passwords do not match', true));
                    $this->redirect('/teachers/settings/');
                }
            }
            
            if ($this->Teacher->save($this->data)) {
                $this->Session->setFlash(__('Your settings have been saved', true));
                $this->redirect('/teachers/settings/');
            } else {
                $this->Session->setFlash(__('Your settings could not be saved. Please, try again.', true));
            }
        }

        if (empty($this->data)) {
            $this->Teacher->recursive = -1;
            $this->data = $this->Teacher->read(null, $teacher_id);
        }
        $this->set('id', $teacher_id);
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for teacher', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Teacher->delete($id)) {
            $this->Session->setFlash(__('Teacher deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Teacher was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
    function admin_index() {
        $this->Teacher->recursive = 0;
        $this->set('teachers', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid teacher', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('teacher', $this->Teacher->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Teacher->create();
            if ($this->Teacher->save($this->data)) {
                $this->Session->setFlash(__('The teacher has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The teacher could not be saved. Please, try again.', true));
            }
        }
        $subjects = $this->Teacher->Subject->find('list');
        $this->set(compact('subjects'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid teacher', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Teacher->save($this->data)) {
                $this->Session->setFlash(__('The teacher has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The teacher could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Teacher->read(null, $id);
        }
        $subjects = $this->Teacher->Subject->find('list');
        $groups = $this->Teacher->Group->find('list');
        $this->set(compact('subjects', 'groups'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for teacher', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Teacher->delete($id)) {
            $this->Session->setFlash(__('Teacher deleted', true));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Teacher was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
    
    function dashboard() {
        $this->loadModel('Group');
        $this->loadModel('Submission');
        $submissions = $this->Submission->query('
            SELECT submissions.filename, submissions.created, submissions.id,
                   users.surname, users.forename, 
                   units.code, tasks.code, marks.status, statuses.status,
                   groups.code, groups.id
            FROM submissions, users, groups, groups_users, teachers, 
                 tasks, units, marks, statuses
            WHERE submissions.user_id = users.id
            AND users.id = groups_users.user_id
            AND groups_users.group_id = groups.id
            AND groups.teacher_id = teachers.id
            AND submissions.group_id = groups.id
            AND submissions.task_id = tasks.id
            AND submissions.unit_id = units.id
            AND submissions.mark_id = marks.id
            AND submissions.status_id = statuses.id
            AND groups.teacher_id ='. $this->Session->read('Auth.User.id').'
            ORDER BY submissions.created DESC
            LIMIT 25
            ');
        $this->set('submissions', $submissions);
        $this->paginate('Submission');
}

    function login() {
        $auth_data = $this->Session->read('AuthData');
        if(!empty($auth_data)) {
            if ($this->Auth->login($auth_data)) 
            {
                $auth_user = $this->Auth->user();
                $auth_user['User'] = $auth_user['Teacher'];
                $this->Session->write('Auth', $auth_user);
                $this->Session->SetFlash(__('Successfully logged in.',true));
                $this->Teacher->id = $this->Session->read('Auth.User.id');
                $this->Teacher->saveField('last_login', date(DATE_ATOM));
                    return true;
                } 
                else {
                    $this->redirect('/users/login');
                    return false;
                }
            }
        }
    

    function checkLogin() {
        if (!$this->Session->read('Teacher')) {
            $this->redirect('/');
        }
    }
}
?>
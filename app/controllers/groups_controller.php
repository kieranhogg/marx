<?php
class GroupsController extends AppController {

    var $name = 'Groups';

    function index() {
        $this->Group->recursive = 2;
        $this->set('groups', $this->paginate());
    }

    function mine() {
        $this->Group->recursive = 1;
        $this->loadModel('User');
        $this->loadModel('Teacher');

        // Get student's groups
        if ($this->Session->read('Auth.User.role') == 'Student') {
            $this->User->id = $this->Session->read('Auth.User.id');
            // manual SQL to get hack around recursive association
            // this could be implemented in a cleaner way, but it works for now
            $this->set('groups', $this->Group->query("
                select Group.code, Teacher.salutation, Teacher.surname, Subject.name, Group.id
                from groups AS `Group`, teachers AS Teacher, subjects AS Subject, users, groups_users
                where users.id = ".$this->Session->read('Auth.User.id')." 
                and users.id = groups_users.user_id
                and groups_users.group_id = Group.id
                and Group.teacher_id = Teacher.id
                and Group.subject_id = Subject.id
            "));
            //$this->set('groups', $this->Group->find('all', array('conditions' => array('User.id' => 4))));
        } else {
            $this->Group->recursive = 0;
            $this->set('groups', $this->Group->find('all', array('conditions' => array('Group.teacher_id' => $this->Session->read('Auth.User.id')))));
        }
    }

    function view($id = null) {
        $this->Group->recursive = 2;
        if (!$id) {
            $this->Session->setFlash(__('Invalid group', true));
            $this->redirect(array('action' => 'index'));
        }
        $group = $this->Group->read(null, $id);
        if ($this->Session->read('Auth.User.role') == 'Admin') {
            $this->redirect('/admin/groups/view/'.$id);
        }
        elseif ($group['Group']['teacher_id'] == $this->Session->read('Auth.User.id')) {
            $user_is_owner = true;
        }
        else {
            $user_is_owner = false;
        }
        $this->set(compact('group', 'user_is_owner'));

    }

    function add() {
        if (!empty($this->data)) {
            $this->Group->create();
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(__('The group has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
            }
        }
        $teachers = $this->Group->Teacher->find('list');
        $this->set(compact('teachers'));
    }

// 	function edit($id = null) {
// 		if (!$id && empty($this->data)) {
// 			$this->Session->setFlash(__('Invalid group', true));
// 			$this->redirect(array('action' => 'index'));
// 		}
// 		if (!empty($this->data)) {
// 			if ($this->Group->save($this->data)) {
// 				$this->Session->setFlash(__('The group has been saved', true));
// 				$this->redirect(array('action' => 'index'));
// 			} else {
// 				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
// 			}
// 		}
// 		if (empty($this->data)) {
// 			$this->data = $this->Group->read(null, $id);
// 		}
// 		$teachers = $this->Group->Teacher->find('list');
// 		$this->set(compact('teachers'));
// 	}
// 
// 	function delete($id = null) {
// 		if (!$id) {
// 			$this->Session->setFlash(__('Invalid id for group', true));
// 			$this->redirect(array('action'=>'index'));
// 		}
// 		if ($this->Group->delete($id)) {
// 			$this->Session->setFlash(__('Group deleted', true));
// 			$this->redirect(array('action'=>'index'));
// 		}
// 		$this->Session->setFlash(__('Group was not deleted', true));
// 		$this->redirect(array('action' => 'index'));
// 	}

    function admin_index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid group', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Group->recursive = 2;
        $this->set('group', $this->Group->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Group->create();
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(__('The group has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
            }
        }
        $subjects = $this->Group->Subject->find('list');
        $teachers = $this->Group->Teacher->find('list');
        $this->set(compact('teachers', 'subjects'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid group', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(__('The group has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Group->read(null, $id);
        }
        $users = $this->Group->User->find('list',array('fields'=>array('id','full_name'), 'order' => array('User.surname ASC')));
        $units = $this->Group->Unit->find('list',array('fields'=>array('id','code'), 'order' => array('Unit.code ASC')));
        $subjects = $this->Group->Subject->find('list');
        $teachers = $this->Group->Teacher->find('list');
        $this->set(compact('teachers', 'users', 'units', 'subjects'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for group', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Group->delete($id)) {
            $this->Session->setFlash(__('Group deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Group was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
}
?>
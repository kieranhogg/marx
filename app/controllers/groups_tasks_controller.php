<?php
class GroupsTasksController extends AppController {

    var $name = 'GroupsTasks';

    function index() {
        $this->GroupsTask->recursive = 0;
        $this->set('groupsTasks', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid groups task', true));
            $this->redirect($this->referer());
        }
        $this->set('groupsTask', $this->GroupsTask->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->GroupsTask->create();
            if ($this->GroupsTask->save($this->data)) {
                $this->Session->setFlash(__('The groups task has been saved', true));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The groups task could not be saved. Please, try again.', true));
            }
        }

        if (!isset($this->params['named']['group']) OR !isset($this->params['named']['task'])) {
            $this->Session->setFlash(__('Missing parameters', true));
            $this->redirect($this->referer());
        }

        $groups = $this->GroupsTask->Group->find('list');
        $tasks = $this->GroupsTask->Task->find('list');
        $this->set(compact('groups', 'tasks'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid groups task', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this->GroupsTask->save($this->data)) {
                $this->Session->setFlash(__('The groups task has been saved', true));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The groups task could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->GroupsTask->read(null, $id);
        }
        $groups = $this->GroupsTask->Group->find('list');
        $tasks = $this->GroupsTask->Task->find('list');
        $this->set(compact('groups', 'tasks'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for groups task', true));
            $this->redirect($this->referer());
        }
        if ($this->GroupsTask->delete($id)) {
            $this->Session->setFlash(__('Groups task deleted', true));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Groups task was not deleted', true));
        $this->redirect($this->referer());
    }
    function admin_index() {
        $this->GroupsTask->recursive = 0;
        $this->set('groupsTasks', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid groups task', true));
            $this->redirect($this->referer());
        }
        $this->set('groupsTask', $this->GroupsTask->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->GroupsTask->create();
            if ($this->GroupsTask->save($this->data)) {
                $this->Session->setFlash(__('The groups task has been saved', true));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The groups task could not be saved. Please, try again.', true));
            }
        }
        $groups = $this->GroupsTask->Group->find('list');
        $tasks = $this->GroupsTask->Task->find('list');
        $this->set(compact('groups', 'tasks'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid groups task', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this->GroupsTask->save($this->data)) {
                $this->Session->setFlash(__('The groups task has been saved', true));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The groups task could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->GroupsTask->read(null, $id);
        }
        $groups = $this->GroupsTask->Group->find('list');
        $tasks = $this->GroupsTask->Task->find('list');
        $this->set(compact('groups', 'tasks'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for groups task', true));
            $this->redirect($this->referer());
        }
        if ($this->GroupsTask->delete($id)) {
            $this->Session->setFlash(__('Customisation deleted', true));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Groups task was not deleted', true));
        $this->redirect($this->referer());
    }
}
?>
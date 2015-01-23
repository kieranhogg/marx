<?php
class TasksController extends AppController {

    var $name = 'Tasks';

    function index() {
        $this->Task->recursive = 0;
        $this->set('tasks', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid task', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Task->recursive = 2;
        $task = $this->Task->read(null, $id);
        $this->set('task', $task);
        $this->loadModel('Subject');
        $this->Subject->recursive = -1;
        $this->set('subject', $this->Subject->read(null, $task['Unit']['subject_id']));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Task->create();
            if ($this->Task->save($this->data)) {
                $this->Session->setFlash(__('The task has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
            }
        }
        $units = $this->Task->Unit->find('list');
        $this->set(compact('units'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid task', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Task->save($this->data)) {
                $this->Session->setFlash(__('The task has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Task->read(null, $id);
        }
        $units = $this->Task->Unit->find('list');
        $this->set(compact('units'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for task', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Task->delete($id)) {
            $this->Session->setFlash(__('Task deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Task was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
    function admin_index() {
        $this->Task->recursive = 0;
        $this->set('tasks', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid task', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Task->recursive = 2;
        $task = $this->Task->read(null, $id);
        $this->set('task', $task);
        $this->loadModel('Subject');
        $this->Subject->recursive = -1;
        $this->set('subject', $this->Subject->read(null, $task['Unit']['subject_id']));    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Task->create();
            if ($this->Task->save($this->data)) {
                $this->Session->setFlash(__('The task has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
            }
        }
        $units = $this->Task->Unit->find('list');
        $this->set(compact('units'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid task', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Task->save($this->data)) {
                $this->Session->setFlash(__('The task has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Task->read(null, $id);
        }
        $units = $this->Task->Unit->find('list');
        $this->set(compact('units', 'groups_task'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for task', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Task->delete($id)) {
            $this->Session->setFlash(__('Task deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Task was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
}
?>
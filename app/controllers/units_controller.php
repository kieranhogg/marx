<?php
class UnitsController extends AppController {

    var $name = 'Units';

    function index() {
        $this->Unit->recursive = 0;
        $this->set('units', $this->paginate());
    }

    function view($id = null) {
        $this->Unit->recursive = 2;
        if (!$id) {
            $this->Session->setFlash(__('Invalid unit', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('unit', $this->Unit->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Unit->create();
            if ($this->Unit->save($this->data)) {
                $this->Session->setFlash(__('The unit has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The unit could not be saved. Please, try again.', true));
            }
        }
        $subjects = $this->Unit->Subject->find('list');
        $groups = $this->Unit->Group->find('list');
        $this->set(compact('subjects', 'groups'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid unit', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Unit->save($this->data)) {
                $this->Session->setFlash(__('The unit has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The unit could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Unit->read(null, $id);
        }
        $subjects = $this->Unit->Subject->find('list');
        $groups = $this->Unit->Group->find('list');
        $this->set(compact('subjects', 'groups'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for unit', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Unit->delete($id)) {
            $this->Session->setFlash(__('Unit deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Unit was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
    function admin_index() {
        $this->Unit->recursive = 0;
        $this->set('units', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid unit', true));
            $this->redirect(array('action' => 'index'));
        }

        $this->Unit->recursive = 2;
        if (isset($this->params['named']['group'])) {
            $this->set('group', $this->Unit->Group->read(null, $this->params['named']['group']));
            $conditions = array('conditions' => array('Group.id' => $this->params['named']['group']));
            $this->Unit->id = $id;
            $this->set('unit', $this->Unit->Group->find('all', $conditions));
        }
        else {
            $this->set('unit', $this->Unit->read(null, $id));
        }
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Unit->create();
            if ($this->Unit->save($this->data)) {
                $this->Session->setFlash(__('The unit has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The unit could not be saved. Please, try again.', true));
            }
        }
        $subjects = $this->Unit->Subject->find('list');
        $groups = $this->Unit->Group->find('list');
        $this->set(compact('subjects', 'groups'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid unit', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Unit->save($this->data)) {
                $this->Session->setFlash(__('The unit has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The unit could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Unit->read(null, $id);
        }
        $subjects = $this->Unit->Subject->find('list');
        $groups = $this->Unit->Group->find('list');
        $this->set(compact('subjects', 'groups'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for unit', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Unit->delete($id)) {
            $this->Session->setFlash(__('Unit deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Unit was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
}
?>
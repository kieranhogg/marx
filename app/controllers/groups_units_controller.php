<?php
class GroupUnitsController extends AppController {

	var $name = 'GroupUnits';
    function index() {
        $this->GroupUnit->recursive = 0;
        $this->set('groupUnits', $this->paginate());
    }

	function admin_index() {
		$this->GroupUnit->recursive = 0;
		$this->set('groupUnits', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid group unit', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('groupUnit', $this->GroupUnit->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->GroupUnit->create();
			if ($this->GroupUnit->save($this->data)) {
				$this->Session->setFlash(__('The group unit has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group unit could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->GroupUnit->Group->find('list');
		$units = $this->GroupUnit->Unit->find('list');
		$this->set(compact('groups', 'units'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid group unit', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->GroupUnit->save($this->data)) {
				$this->Session->setFlash(__('The group unit has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group unit could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->GroupUnit->read(null, $id);
		}
		$groups = $this->GroupUnit->Group->find('list');
		$units = $this->GroupUnit->Unit->find('list');
		$this->set(compact('groups', 'units'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for group unit', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->GroupUnit->delete($id)) {
			$this->Session->setFlash(__('Group unit deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Group unit was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
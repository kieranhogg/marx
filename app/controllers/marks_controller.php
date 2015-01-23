<?php
class MarksController extends AppController {

	var $name = 'Marks';

	function index() {
		$this->Mark->recursive = 0;
		$this->set('marks', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid mark', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('mark', $this->Mark->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Mark->create();
			if ($this->Mark->save($this->data)) {
				$this->Session->setFlash(__('The mark has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mark could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid mark', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Mark->save($this->data)) {
				$this->Session->setFlash(__('The mark has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mark could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mark->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for mark', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Mark->delete($id)) {
			$this->Session->setFlash(__('Mark deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Mark was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Mark->recursive = 0;
		$this->set('marks', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid mark', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('mark', $this->Mark->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Mark->create();
			if ($this->Mark->save($this->data)) {
				$this->Session->setFlash(__('The mark has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mark could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid mark', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Mark->save($this->data)) {
				$this->Session->setFlash(__('The mark has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mark could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mark->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for mark', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Mark->delete($id)) {
			$this->Session->setFlash(__('Mark deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Mark was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
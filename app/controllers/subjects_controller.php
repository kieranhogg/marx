<?php
class SubjectsController extends AppController {

	var $name = 'Subjects';

	function index() {
		$this->Subject->recursive = 0;
		$this->set('subjects', $this->paginate());
	}

	function view($id = null) {
        $this->Subject->recursive = 2;
        $this->loadModel('Teacher');
		if (!$id) {
			$this->Session->setFlash(__('Invalid subject', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subject', $this->Subject->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Subject->create();
			if ($this->Subject->save($this->data)) {
				$this->Session->setFlash(__('The subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subject could not be saved. Please, try again.', true));
			}
		}
		$teachers = $this->Subject->Teacher->find('list');
		$this->set(compact('teachers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid subject', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subject->save($this->data)) {
				$this->Session->setFlash(__('The subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subject could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subject->read(null, $id);
		}
		$teachers = $this->Subject->Teacher->find('list');
		$this->set(compact('teachers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subject', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subject->delete($id)) {
			$this->Session->setFlash(__('Subject deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subject was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Subject->recursive = 0;
		$this->set('subjects', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subject', true));
			$this->redirect(array('action' => 'index'));
		}
        $this->Subject->recursive = 2;
		$this->set('subject', $this->Subject->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Subject->create();
			if ($this->Subject->save($this->data)) {
				$this->Session->setFlash(__('The subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subject could not be saved. Please, try again.', true));
			}
		}
		$teachers = $this->Subject->Teacher->find('list');
		$this->set(compact('teachers'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid subject', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subject->save($this->data)) {
				$this->Session->setFlash(__('The subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subject could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subject->read(null, $id);
		}
		$teachers = $this->Subject->Teacher->find('list');
		$this->set(compact('teachers'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subject', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subject->delete($id)) {
			$this->Session->setFlash(__('Subject deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subject was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
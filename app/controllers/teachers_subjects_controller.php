<?php
class TeachersSubjectsController extends AppController {

	var $name = 'TeachersSubjects';

	function index() {
		$this->TeachersSubject->recursive = 0;
		$this->set('teachersSubjects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid teachers subject', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('teachersSubject', $this->TeachersSubject->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TeachersSubject->create();
			if ($this->TeachersSubject->save($this->data)) {
				$this->Session->setFlash(__('The teachers subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The teachers subject could not be saved. Please, try again.', true));
			}
		}
		$teachers = $this->TeachersSubject->Teacher->find('list');
		$subjects = $this->TeachersSubject->Subject->find('list');
		$this->set(compact('teachers', 'subjects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid teachers subject', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TeachersSubject->save($this->data)) {
				$this->Session->setFlash(__('The teachers subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The teachers subject could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TeachersSubject->read(null, $id);
		}
		$teachers = $this->TeachersSubject->Teacher->find('list');
		$subjects = $this->TeachersSubject->Subject->find('list');
		$this->set(compact('teachers', 'subjects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for teachers subject', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TeachersSubject->delete($id)) {
			$this->Session->setFlash(__('Teachers subject deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Teachers subject was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->TeachersSubject->recursive = 0;
		$this->set('teachersSubjects', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid teachers subject', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('teachersSubject', $this->TeachersSubject->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->TeachersSubject->create();
			if ($this->TeachersSubject->save($this->data)) {
				$this->Session->setFlash(__('The teachers subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The teachers subject could not be saved. Please, try again.', true));
			}
		}
		$teachers = $this->TeachersSubject->Teacher->find('list');
		$subjects = $this->TeachersSubject->Subject->find('list');
		$this->set(compact('teachers', 'subjects'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid teachers subject', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TeachersSubject->save($this->data)) {
				$this->Session->setFlash(__('The teachers subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The teachers subject could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TeachersSubject->read(null, $id);
		}
		$teachers = $this->TeachersSubject->Teacher->find('list');
		$subjects = $this->TeachersSubject->Subject->find('list');
		$this->set(compact('teachers', 'subjects'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for teachers subject', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TeachersSubject->delete($id)) {
			$this->Session->setFlash(__('Teachers subject deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Teachers subject was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
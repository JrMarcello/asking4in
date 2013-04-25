<?php
App::uses('AppController', 'Controller');
/**
 * Temas Controller
 *
 * @property Tema $Tema
 */
class TemasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tema->recursive = 0;
		$this->set('temas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tema->exists($id)) {
			throw new NotFoundException(__('Invalid tema'));
		}
		$this->Tema->contain('Grupo');
		$options = array('conditions' => array('Tema.' . $this->Tema->primaryKey => $id));
		$this->set('tema', $this->Tema->find('first', $options));
		
		$this->paginate = array(
			'conditions' => array(
				'tema_id' => $id
			)
		);
		$this->set('topicos', $this->paginate('Topico'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tema->create();
			if ($this->Tema->save($this->request->data)) {
				$this->Session->setFlash(__('The tema has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tema could not be saved. Please, try again.'));
			}
		}
		$grupos = $this->Tema->Grupo->find('list');
		$this->set(compact('grupos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tema->exists($id)) {
			throw new NotFoundException(__('Invalid tema'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tema->save($this->request->data)) {
				$this->Session->setFlash(__('The tema has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tema could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tema.' . $this->Tema->primaryKey => $id));
			$this->request->data = $this->Tema->find('first', $options);
		}
		$grupos = $this->Tema->Grupo->find('list');
		$this->set(compact('grupos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Tema->id = $id;
		if (!$this->Tema->exists()) {
			throw new NotFoundException(__('Invalid tema'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tema->delete()) {
			$this->Session->setFlash(__('Tema deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tema was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Tema->recursive = 0;
		$this->set('temas', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Tema->exists($id)) {
			throw new NotFoundException(__('Invalid tema'));
		}
		$options = array('conditions' => array('Tema.' . $this->Tema->primaryKey => $id));
		$this->set('tema', $this->Tema->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Tema->create();
			if ($this->Tema->save($this->request->data)) {
				$this->Session->setFlash(__('The tema has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tema could not be saved. Please, try again.'));
			}
		}
		$grupos = $this->Tema->Grupo->find('list');
		$this->set(compact('grupos'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Tema->exists($id)) {
			throw new NotFoundException(__('Invalid tema'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tema->save($this->request->data)) {
				$this->Session->setFlash(__('The tema has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tema could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tema.' . $this->Tema->primaryKey => $id));
			$this->request->data = $this->Tema->find('first', $options);
		}
		$grupos = $this->Tema->Grupo->find('list');
		$this->set(compact('grupos'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Tema->id = $id;
		if (!$this->Tema->exists()) {
			throw new NotFoundException(__('Invalid tema'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tema->delete()) {
			$this->Session->setFlash(__('Tema deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tema was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

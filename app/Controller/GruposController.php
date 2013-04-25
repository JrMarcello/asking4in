<?php
App::uses('AppController', 'Controller');
/**
 * Grupos Controller
 *
 * @property Grupo $Grupo
 */
class GruposController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Grupo->recursive = 0;
		$this->set('grupos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Grupo->exists($id)) {
			throw new NotFoundException(__('Invalid grupo'));
		}
		$options = array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id));
		$this->Grupo->contain();
		$this->set('grupo', $this->Grupo->find('first', $options));
		
		$this->paginate = array(
			'conditions' => array(
				'grupo_id' => $id
			)
		);
		$this->set('temas', $this->paginate('Tema'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Grupo->create();
			if ($this->Grupo->save($this->request->data)) {
				$this->Session->setFlash(__('The grupo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grupo could not be saved. Please, try again.'));
			}
		}
		$usuarios = $this->Grupo->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Grupo->exists($id)) {
			throw new NotFoundException(__('Invalid grupo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Grupo->save($this->request->data)) {
				$this->Session->setFlash(__('The grupo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grupo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Grupo.' . $this->Grupo->primaryKey => $id));
			$this->request->data = $this->Grupo->find('first', $options);
		}
		$usuarios = $this->Grupo->Usuario->find('list');
		$this->set(compact('usuarios'));
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
		$this->Grupo->id = $id;
		if (!$this->Grupo->exists()) {
			throw new NotFoundException(__('Invalid grupo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Grupo->delete()) {
			$this->Session->setFlash(__('Grupo deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Grupo was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

<?php
App::uses('AppController', 'Controller');
/**
 * Perguntas Controller
 *
 * @property Pergunta $Pergunta
 */
class PerguntasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pergunta->recursive = 0;
		$this->set('perguntas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pergunta->exists($id)) {
			throw new NotFoundException(__('Invalid pergunta'));
		}
		$options = array(
            'conditions' => array('Pergunta.' . $this->Pergunta->primaryKey => $id),
            'recursive' => 2
        );
		$this->set('pergunta', $this->Pergunta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pergunta->create();
			if ($this->Pergunta->save($this->request->data)) {
				$this->Session->setFlash(__('The pergunta has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pergunta could not be saved. Please, try again.'));
			}
		}
		$usuarios = $this->Pergunta->Usuario->find('list');
		$topicos = $this->Pergunta->Topico->find('list');
		$this->set(compact('usuarios', 'topicos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Pergunta->exists($id)) {
			throw new NotFoundException(__('Invalid pergunta'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pergunta->save($this->request->data)) {
				$this->Session->setFlash(__('The pergunta has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pergunta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pergunta.' . $this->Pergunta->primaryKey => $id));
			$this->request->data = $this->Pergunta->find('first', $options);
		}
		$usuarios = $this->Pergunta->Usuario->find('list');
		$topicos = $this->Pergunta->Topico->find('list');
		$this->set(compact('usuarios', 'topicos'));
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
		$this->Pergunta->id = $id;
		if (!$this->Pergunta->exists()) {
			throw new NotFoundException(__('Invalid pergunta'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pergunta->delete()) {
			$this->Session->setFlash(__('Pergunta deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pergunta was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

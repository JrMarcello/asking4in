<?php
App::uses('AppController', 'Controller');
/**
 * Respostas Controller
 *
 * @property Resposta $Resposta
 */
class RespostasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Resposta->recursive = 0;
		$this->set('respostas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Resposta->exists($id)) {
			throw new NotFoundException(__('Invalid resposta'));
		}
		$options = array('conditions' => array('Resposta.' . $this->Resposta->primaryKey => $id));
		$this->set('resposta', $this->Resposta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Resposta->create();
			if ($this->Resposta->save($this->request->data)) {
				$this->Session->setFlash(__('Sua resposta foi enviada.'), 'alerts/success');
			} else {
				$this->Session->setFlash(__('A resposta não pode ser enviada.'), 'alerts/error');
			}
		}
		$this->redirect(array(
            'controller' => 'perguntas',
            'action' => 'view',
            $this->request->data['Resposta']['pergunta_id']
        ));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Resposta->exists($id)) {
			throw new NotFoundException(__('Invalid resposta'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Resposta->save($this->request->data)) {
				$this->Session->setFlash(__('The resposta has been saved'), 'alerts/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The resposta could not be saved. Please, try again.'), 'alerts/error');
			}
		} else {
			$options = array('conditions' => array('Resposta.' . $this->Resposta->primaryKey => $id));
			$this->request->data = $this->Resposta->find('first', $options);
		}
		$perguntas = $this->Resposta->Pergunta->find('list');
		$usuarios = $this->Resposta->Usuario->find('list');
		$this->set(compact('perguntas', 'usuarios'));
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
		$this->Resposta->id = $id;
		if (!$this->Resposta->exists()) {
			throw new NotFoundException(__('Invalid resposta'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Resposta->delete()) {
			$this->Session->setFlash(__('Resposta deleted'), 'alerts/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Resposta was not deleted'), 'alerts/error');
		$this->redirect(array('action' => 'index'));
	}
}

<?php

App::uses('AppController', 'Controller');

/**
 * Topicos Controller
 *
 * @property Topico $Topico
 */
class TopicosController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Topico->recursive = 0;
        $this->set('topicos', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Topico->exists($id)) {
            throw new NotFoundException(__('Invalid topico'));
        }
        $options = array('conditions' => array('Topico.' . $this->Topico->primaryKey => $id));
        $this->Topico->contain(array('Pergunta' => array('Usuario')), 'Tema');
        $this->set('topico', $this->Topico->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Topico->create();
            if ($this->Topico->save($this->request->data)) {
                $this->Session->setFlash(__('The topico has been saved'), 'alerts/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The topico could not be saved. Please, try again.'), 'alerts/error');
            }
        }
        $temas = $this->Topico->Tema->find('list');
        $this->set(compact('temas'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Topico->exists($id)) {
            throw new NotFoundException(__('Invalid topico'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Topico->save($this->request->data)) {
                $this->Session->setFlash(__('The topico has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The topico could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Topico.' . $this->Topico->primaryKey => $id));
            $this->request->data = $this->Topico->find('first', $options);
        }
        $temas = $this->Topico->Tema->find('list');
        $this->set(compact('temas'));
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
        $this->Topico->id = $id;
        if (!$this->Topico->exists()) {
            throw new NotFoundException(__('Invalid topico'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Topico->delete()) {
            $this->Session->setFlash(__('Topico deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Topico was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Topico->recursive = 0;
        $this->set('topicos', $this->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Topico->exists($id)) {
            throw new NotFoundException(__('Invalid topico'));
        }
        $options = array('conditions' => array('Topico.' . $this->Topico->primaryKey => $id));
        $this->set('topico', $this->Topico->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Topico->create();
            if ($this->Topico->save($this->request->data)) {
                $this->Session->setFlash(__('The topico has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The topico could not be saved. Please, try again.'));
            }
        }
        $temas = $this->Topico->Tema->find('list');
        $this->set(compact('temas'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Topico->exists($id)) {
            throw new NotFoundException(__('Invalid topico'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Topico->save($this->request->data)) {
                $this->Session->setFlash(__('The topico has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The topico could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Topico.' . $this->Topico->primaryKey => $id));
            $this->request->data = $this->Topico->find('first', $options);
        }
        $temas = $this->Topico->Tema->find('list');
        $this->set(compact('temas'));
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
        $this->Topico->id = $id;
        if (!$this->Topico->exists()) {
            throw new NotFoundException(__('Invalid topico'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Topico->delete()) {
            $this->Session->setFlash(__('Topico deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Topico was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

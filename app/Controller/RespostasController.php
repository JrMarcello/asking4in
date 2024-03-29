<?php

App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

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
            throw new NotFoundException(__('Invalid answer'));
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
                //Conexão com o CODI-Service (Criando Expertise)
                $HttpSocket = new HttpSocket();
                $HttpSocket->post('http://localhost:8080/Plugin-CODI/resources/expertise/degree/create', 
                        'userId=' . $this->Auth->user('facebook_id') .
                        '&expertise=' . trim(str_replace(' ', '-', $this->Resposta->Pergunta->find('first', array('conditions' =>
                            array('Pergunta.id' => $this->request->data['Resposta']['pergunta_id'])))['Topico']['nome'])) .
                        '&score=' . $this->request->data['Resposta']['expertiseLevel']);
                
                $respostPost = array('postID' => $this->Resposta->Pergunta->find('first', array('conditions' => 
                            array('Pergunta.id' => $this->request->data['Resposta']['pergunta_id'])))['Pergunta']['facebook_id'],
                                     'respID' => $this->Resposta->id,
                                     'comentario' => $this->request->data['Resposta']['conteudo']);
                
                $this->Session->write('fbPostResp', $respostPost);
                
                $this->Session->setFlash(__('Your answer has been sent.'), 'alerts/success');
            } else {
                $this->Session->setFlash(__('The answer could not be sent. Please, try again.'), 'alerts/error');
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
            throw new NotFoundException(__('Invalid answer'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Resposta->save($this->request->data)) {
                $this->Session->setFlash(__('The answer has been saved'), 'alerts/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The answer could not be saved. Please, try again.'), 'alerts/error');
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
            throw new NotFoundException(__('Invalid answer'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Resposta->delete()) {
            $this->Session->setFlash(__('Answer deleted'), 'alerts/success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Answer was not deleted'), 'alerts/error');
        $this->redirect(array('action' => 'index'));
    }
    
    
    public function updatefbid() {
         if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $this->Resposta->id = $this->request->data['respid'];
            $this->Resposta->saveField('facebook_id', $this->request->data['fbid']);
            
         }
     }

}

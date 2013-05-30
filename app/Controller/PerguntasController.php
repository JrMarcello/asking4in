<?php

App::uses('AppController', 'Controller');

/**
 * Perguntas Controller
 *
 * @property Pergunta $Pergunta
 */
class PerguntasController extends AppController {
    public $components = array('RequestHandler');
    
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        if (!empty($this->request->query['search'])) {
            $search = trim($this->request->query['search']);
            $this->paginate = array_merge($this->paginate, array(
                'conditions' => array(
                    'OR' => array(
                        'Pergunta.titulo LIKE' => "%$search%",
                        'Pergunta.conteudo LIKE' => "%$search%"
                    )
                )
            ));
            $this->set('search', $search);
        }
        $this->Pergunta->recursive = 0;
        $this->set('perguntas', $this->paginate());
    }
    
    public function typeahead() {
        if (!$this->request->is('ajax')) {
            $this->redirect(array('action' => 'index'));
        }
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');
        
        $query = $this->request->query['query'];
        
        $results = $this->Pergunta->find('list', array(
                'conditions' => array(
                    'Pergunta.titulo LIKE' => "%$query%",
                )
        ));
        return json_encode(array_values($results));
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
            'contains' => false,
            'recursive' => 0
        );
        
        $pergunta = $this->Pergunta->find('first', $options);
        
        $this->paginate = array(
            'conditions' => array('Resposta.pergunta_id' => $id)
        );
        
        $expertise = $this->Pergunta->Usuario->Expertise->find('first', array(
            'conditions' => array(
                'usuario_id' => $this->Auth->user('id'),
                'topico_id' => $pergunta['Topico']['id']
            )
        ));
        
        $this->set('pergunta', $pergunta);
        $this->set('expertise', $expertise);
        $this->set('respostas', $this->paginate('Resposta'));
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
                $this->Session->setFlash(__('The pergunta has been saved'), 'alerts/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pergunta could not be saved. Please, try again.'), 'alerts/error');
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
                $this->Session->setFlash(__('The pergunta has been saved', 'alerts/success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pergunta could not be saved. Please, try again.'), 'alerts/error');
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
            $this->Session->setFlash(__('Pergunta deleted'), 'alerts/success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Pergunta was not deleted'), 'alerts/error');
        $this->redirect(array('action' => 'index'));
    }

}

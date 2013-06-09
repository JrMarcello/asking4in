<?php

App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
//App::uses('Sanitize', 'Utility');

/**
 * Perguntas Controller
 *
 * @property Pergunta $Pergunta
 */
class PerguntasController extends AppController {
    public $paginate = array('limit' => 10);
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
        /* $perguntas = array();
          foreach ($this->paginate() as $pergunta){
          $perguntas[] = Sanitize::clean($pergunta, array('escape' => false));
          }
          $this->set('perguntas', $perguntas); */
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

        $this->paginate = array(
            'conditions' => array('Resposta.pergunta_id' => $id)
        );

        $this->set('pergunta', $this->Pergunta->find('first', $options));
        
        $respostas = array();
        foreach ($this->paginate('Resposta') as $resposta) {
            $expertise = trim(str_replace(' ', '-', $this->Pergunta->Topico->find('first', array('conditions' =>
                                array('Topico.id' => $resposta['Pergunta']['topico_id'])))['Tema']['nome']));
           
            ////Conexão com CODI-Service (Criando Degree)
            $HttpSocket = new HttpSocket();
            $results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/degree', 'userId=' . $resposta['Usuario']['facebook_id'] .
                    '&expertise=' . $expertise);

            if ($results->isOK()) {
                $resposta['Resposta']['score'] = $results->body;
                $respostas[] = $resposta;
            } else {
                $resposta['Resposta']['score'] = '0';
                $respostas[] = $resposta;
            }
        }
        
        foreach ($respostas as $temp)
            $temps[] = $temp['Resposta']['score'];
        
        if (!empty($respostas))
            array_multisort($temps, SORT_DESC, $respostas);

        $this->set('respostas', $respostas);
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
                $grupoId = $this->Pergunta->Topico->find('first', array('conditions' =>
                            array('Topico.id' => $this->request->data['Pergunta']['topico_id'])))['Tema']['grupo_id'];

                //Conexão com CODI-Service (Criando Preferencias)
                $HttpSocket = new HttpSocket();
                $HttpSocket->post('http://localhost:8080/Plugin-CODI/resources/preference/create', 
                        'userId=' . $this->Auth->user('facebook_id') .
                        '&interestName=' . trim(str_replace(' ', '-', 
                                $this->Pergunta->Topico->Tema->Grupo->find('first', array('conditions' =>
                                            array('Grupo.id' => $grupoId)))['Grupo']['nome'])) .
                        '&preferenceName=' . trim(str_replace(' ', '-', 
                                $this->Pergunta->Topico->find('first', 
                                        array('conditions' => array('Topico.id' => 
                                            $this->request->data['Pergunta']['topico_id'])))['Topico']['nome'])) .//corrigir
                        '&score=0');

                //Conexão com CODI-Service (Adicinando o Usuario a um SubGrupo logico baseado em Preferencia)
                $HttpSocket->put('http://localhost:8080/Plugin-CODI/resources/subgroup/user/add', //criar
                        'userId=' . $this->Auth->user('facebook_id') .
                        '&subGroupName=' . trim(str_replace(' ', '-', 
                                $this->Pergunta->Topico->find('first', 
                                        array('conditions' => array('Topico.id' => 
                                            $this->request->data['Pergunta']['topico_id'])))['Topico']['nome'])));

                $this->Session->setFlash(__('The pergunta has been saved'), 'alerts/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pergunta could not be saved. Please, try again.'), 'alerts/error');
            }
        }

        $usuarios = $this->Pergunta->Usuario->find('list');
        $topicos = $this->Pergunta->Topico->find('list', array(
            'conditions' => array(
                'Usuario.id' => $this->Auth->user('id')
            ),
            'joins' => array(
                array(
                    'table' => 'temas',
                    'alias' => 'Tema',
                    'conditions' => array('Tema.id = Topico.tema_id')
                ),
                array(
                    'table' => 'grupos',
                    'alias' => 'Grupo',
                    'conditions' => array('Grupo.id = Tema.grupo_id')
                ),
                array(
                    'table' => 'grupos_usuarios',
                    'alias' => 'GrupoUsuario',
                    'conditions' => array('GrupoUsuario.grupo_id = Grupo.id')
                ),
                array(
                    'table' => 'usuarios',
                    'alias' => 'Usuario',
                    'conditions' => array('GrupoUsuario.usuario_id = Usuario.id')
                )
            )
        ));

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

<?php

App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * Perguntas Controller
 *
 * @property Pergunta $Pergunta
 */
class PerguntasController extends AppController {
    public $notifications = null;
    public $paginate = array('limit' => 10);
    public $components = array('RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function beforeRender() {
        parent::beforeRender();
        
        $this->loadModel('Notificacao');
        $notifications = $this->Notificacao->find('all', array(
            'conditions' => array('Notificacao.usuario_id' => $this->Auth->user('id'))));
        
        $topicos = '';
        $cont = 1;
        $notificationsSize = sizeof($notifications);
        
        if ($notifications != null & !empty($notifications)){
            foreach ($notifications as $notification){
                if ($cont != ($notificationsSize) && $cont == ($notificationsSize - 1)){
                    $topicos .= $notification['Topico']['nome'] . ' ';
                    $cont++;
                } elseif ($cont != ($notificationsSize)) {
                    $topicos .= $notification['Topico']['nome'] . ', ';
                    $cont++;
                } elseif ($cont == $notificationsSize && $notificationsSize != 1){
                    $topicos .= __('e ') . $notification['Topico']['nome'];
                } elseif($notificationsSize == 1){
                    $topicos .= $notification['Topico']['nome'];
                }
            }
            
            if($notificationsSize == 1){
                $this->Session->setFlash(__('Hi, <strong>'. $this->Auth->user('nome') 
                    .'</strong>... You have news in 1 topic: <strong>' 
                    . $topicos . '</strong>'), 'alerts/success');
            }
            else{
                $this->Session->setFlash(__('Olá, <strong>'. $this->Auth->user('nome') 
                    .'</strong>... You have news in ' . $notificationsSize 
                    . ' topicos: <strong>' . $topicos . '</strong>'), 'alerts/success');
            }
        }
        
        $this->Notificacao->deleteAll(array('Notificacao.usuario_id' => $this->Auth->user('id')), false);
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
            throw new NotFoundException(__('Invalid question'));
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
                                array('Topico.id' => $resposta['Pergunta']['topico_id'])))['Topico']['nome']));
           
            ////Conexão com CODI-Service (Criando Degree)
            $HttpSocket = new HttpSocket();
            $results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/degree', 
                    'userId=' . $resposta['Usuario']['facebook_id'] .
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
                                            $this->request->data['Pergunta']['topico_id'])))['Topico']['nome'])) .
                        '&score=0');

                //Conexão com CODI-Service (Adicinando o Usuario a um SubGrupo logico baseado em Preferencia)
                $HttpSocket->put('http://localhost:8080/Plugin-CODI/resources/subgroup/user/add',
                        'userId=' . $this->Auth->user('facebook_id') .
                        '&subGroupName=' . trim(str_replace(' ', '-', 
                                $this->Pergunta->Topico->find('first', 
                                        array('conditions' => array('Topico.id' => 
                                            $this->request->data['Pergunta']['topico_id'])))['Topico']['nome'])));
                
                //Notificando os Usuarios do SubGrupo logico
                $results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/users/group/'
                        . trim(str_replace(' ', '-', $this->Pergunta->Topico->find('first', 
                                        array('conditions' => array('Topico.id' => 
                                            $this->request->data['Pergunta']['topico_id'])))['Topico']['nome'])));
                
                if ($results->isOk()) {
                    $results = json_decode($results->body);
                    foreach ($results as $result) {
                        if ($result != $this->Auth->user('facebook_id')) {
                            $user = $this->Pergunta->Usuario->findByFacebookId($result);
                            
                            $this->loadModel('Notificacao');
                            $this->Notificacao->create();
                            $this->Notificacao->save(array(
                                'Notificacao' => array(
                                'usuario_id' => $user['Usuario']['id'],
                                'topico_id' => $this->request->data['Pergunta']['topico_id']
                                )
                            ));
                    
                        }
                    }
                }
                
                $this->Session->setFlash(__('The question has been saved'), 'alerts/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The question could not be saved. Please, try again.'), 'alerts/error');
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
            throw new NotFoundException(__('Invalid question'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Pergunta->save($this->request->data)) {
                $this->Session->setFlash(__('The question has been saved', 'alerts/success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The question could not be saved. Please, try again.'), 'alerts/error');
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
            throw new NotFoundException(__('Invalid question'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Pergunta->delete()) {
            $this->Session->setFlash(__('Question deleted'), 'alerts/success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Question was not deleted'), 'alerts/error');
        $this->redirect(array('action' => 'index'));
    }

}

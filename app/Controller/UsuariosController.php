<?php

App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 */
class UsuariosController extends AppController {
    public $components = array('SignedRequest');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('ajaxlogin'); 
    }

    public function login() {
        $this->redirect('/');
    }

    public function req() { 
        //gets
        //$HttpSocket = new HttpSocket();
        //$results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/user/' . $this->Auth->user('facebook_id'));
        //$results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/expertises/' . $this->Auth->user('facebook_id'));
        /*$results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/degree',
                'userId=' . $this->Auth->user('facebook_id') .
                '&expertise=rmi');*/
        //$results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/interests/' . $this->Auth->user('facebook_id'));
        /*$results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/preferences', 
                'userId=' . $this->Auth->user('facebook_id') .
                '&interestName=pod');*/
        /*$results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/group', 
                'userId=' . $this->Auth->user('facebook_id') .
                '&group=rmi');*/
        //$results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/groups/' . $this->Auth->user('facebook_id'));
        
        //debug($results->isOk());die();
        //debug(json_decode($results->body));die(); 
        //debug($results->body);die();
    }
    
    public function view($id = null){
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid User'));
        }
        
        $options = array(
            'conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id),
            'contains' => false,
            'recursive' => 0
        );
        
        $this->set('usuario', $this->Usuario->find('first', $options));
    }

    public function ajaxlogin() {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->autoRender = false;

            $facebook_id = $this->request->data['response']['authResponse']['userID'];
            $facebook_id_check = $this->SignedRequest->decode(
                            $this->request->data['response']['authResponse']['signedRequest']
                    )['user_id'];

            if ($facebook_id != $facebook_id_check) {
                $this->Session->setFlash(__('Login Fail', 'alerts/error'));
                $this->redirect('/');
            }

            //Conexão com o CODI-Service (Verificando se Usuario existe e recuperando dados)
            $HttpSocket = new HttpSocket();
            $results = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/user/' . $facebook_id);

            if ($results->isOk()) {
                //carregar as infos do usuarios na codi aki
            } else {
                $HttpSocket = new HttpSocket();
                $HttpSocket->post('http://localhost:8080/Plugin-CODI/resources/user/' . $facebook_id);
            }

            $user = $this->Usuario->findByFacebookId($facebook_id);

            if (!$user) {
                $this->Usuario->create();
                $this->Usuario->save(array(
                    'Usuario' => array(
                        'facebook_id' => $facebook_id,
                        'nome' => $this->request->data['me']['name'],
                        'email' => $this->request->data['me']['email']
                    )
                ));

                $user = array(
                    'Usuario' => array(
                        'id' => $this->Usuario->id,
                        'facebook_id' => $facebook_id,
                        'nome' => $this->request->data['me']['name'],
                        'email' => $this->request->data['me']['email']
                    )
                );
            }

            $login = $this->Auth->login(array(
                'id' => $user['Usuario']['id'],
                'facebook_id' => $user['Usuario']['facebook_id'],
                'nome' => $user['Usuario']['nome'],
                'email' => $user['Usuario']['email']
            ));

            exit($this->request->referer());
        }
    }

    public function ajaxgroups() {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->autoRender = false;

            if ($this->Auth->loggedIn()) {
                $this->Usuario->grupos($this->request->data['groups'], $this->Auth->user('id'));

                $HttpSocket = new HttpSocket();
                $result = $HttpSocket->get('http://localhost:8080/Plugin-CODI/resources/user/' . 
                        $this->Auth->user('facebook_id'));

                if ($result->isOk()) {
                    foreach ($this->request->data['groups'] as $grupo) {
                        //Conexão com CODI-Service (Criando/Atualizando Grupos)
                        $group = $HttpSocket->post('http://localhost:8080/Plugin-CODI/resources/group/create',
                                'name=' . str_replace(' ','-',trim(str_replace('[ASK4In]', '', $grupo['name']))));
                        
                        if($group->isOK()){
                        //Conexão com CODI-Service (Criando/Atualizando Interesses)
                        $interesse = $HttpSocket->post('http://localhost:8080/Plugin-CODI/resources/interest/create', 
                                'groupName=' . str_replace(' ','-',trim(str_replace('[ASK4In]', '', $grupo['name']))) . 
                                '&interestName=' . str_replace(' ','-',trim(str_replace('[ASK4In]', '', $grupo['name']))) . 
                                '&score=1&typeValue=default');
                        }
                        
                        if($interesse->isOk()){
                            $HttpSocket->put('http://localhost:8080/Plugin-CODI/resources/group/user/add',
                                    'userId=' . $this->Auth->user('facebook_id') .
                                    '&groupName=' . str_replace(' ','-',trim(str_replace('[ASK4In]', '', $grupo['name']))));
                        }
                    }
                    
                    //Conexão com CODI-Service (Criando/Atualizando Subgrupos)
                    foreach ($this->Usuario->Pergunta->Topico->find('all') as $topico){
                        $HttpSocket = new HttpSocket();
                        $HttpSocket->post('http://localhost:8080/Plugin-CODI/resources/subgroup/create',
                                    'name=' . trim(str_replace(' ', '-',$topico['Topico']['nome'])));
                    }
                }
            }

            exit;
        }
    }

    public function logout() {
        $this->Auth->logout();
        $this->redirect('/');
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Usuario->recursive = 0;
        $this->set('usuarios', $this->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
        $this->set('usuario', $this->Usuario->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $grupos = $this->Usuario->Grupo->find('list');
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
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->request->data = $this->Usuario->find('first', $options);
        }
        $grupos = $this->Usuario->Grupo->find('list');
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
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Usuario->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

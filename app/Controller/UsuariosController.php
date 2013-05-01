<?php

App::uses('AppController', 'Controller');

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

    public function ajaxlogin() {  
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->autoRender = false;

            $facebook_id = $this->request->data['response']['authResponse']['userID'];
            $facebook_id_check = $this->SignedRequest->decode(
                $this->request->data['response']['authResponse']['signedRequest']
            )['user_id'];

            if ($facebook_id != $facebook_id_check) {
                $this->Session->setFlash('Login Falhou', 'alerts/error');
                $this->redirect('/');
            }

            $user = $this->Usuario->findByFacebookId($facebook_id);

            if (!$user) {
                $this->Usuario->create();
                $this->Usuario->save(array(
                    'Usuario' => array(
                        'facebook_id' =>  $facebook_id,
                        'nome' => $this->request->data['me']['name'],
                        'email' => $this->request->data['me']['email']
                    )
                ));
                $user = array(
                    'Usuario' => array(
                        'id' => $this->Usuario->id,
                        'facebook_id' =>  $facebook_id,
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
            throw new NotFoundException(__('Invalid usuario'));
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
                $this->Session->setFlash(__('The usuario has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usuario could not be saved. Please, try again.'));
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
            throw new NotFoundException(__('Invalid usuario'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('The usuario has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The usuario could not be saved. Please, try again.'));
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
            throw new NotFoundException(__('Invalid usuario'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Usuario->delete()) {
            $this->Session->setFlash(__('Usuario deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Usuario was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

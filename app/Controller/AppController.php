<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array('Session', 'DebugKit.Toolbar',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'usuarios',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array('username' => 'email')
                )
            ),
            'authorize' => 'Controller'
        ),
        'Facebook.Connect' => array('model' => 'Usuario')
    );
    public $helpers = array('Facebook.Facebook');
    
    public function isAuthorized($user = null) {
        return true;
    }
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
    
    public function beforeRender() {
        parent::beforeRender();
        $Topico = ClassRegistry::init('Topico');
        $this->set('topicosSidebar', $Topico->sidebar());
    }
    
    public function beforeFacebookSave() {
        $this->Connect->authUser['Usuario']['email'] = $this->Connect->user('email');
        $this->Connect->authUser['Usuario']['nome'] = $this->Connect->user('name');
        
        return true;
    }
    
    public function beforeFacebookLogin($user) {
        $user['Usuario']['nome'] = $this->Connect->user('name');
        $user['Usuario']['email'] = $this->Connect->user('email');
        
        return $user;
    }

}

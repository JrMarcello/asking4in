<?php

App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * Notificacaos Controller
 *
 * @property Notificacao $Notificacao
 */
class NotificacaosController extends AppController {
    
    /**
     * add method
     *
     * @return void
     */
    public function add($usuario_id, $topico_id) {
        $this->Notificacao->create();
        $this->Notificacao->save(array(
                    'Notificacao' => array(
                        'usuario_id' => $usuario_id,
                        'topico_id' => $topico_id
                    )
                ));
    }  

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Notificacao->id = $id;
        if (!$this->Notificacao->exists()) {
            throw new NotFoundException(__('Invalid notificatios'));
        }
        
        //$this->request->onlyAllow('post', 'delete');
        $this->Notificacao->delete();
        
    }

}

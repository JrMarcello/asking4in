<?php
App::uses('AppModel', 'Model');
/**
 * Resposta Model
 *
 * @property Topico $Topico
 * @property Usuario $Usuario
 */
class Notificacao extends AppModel {
    
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Topico' => array(
			'className' => 'Topico',
			'foreignKey' => 'topico_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    
}

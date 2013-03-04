<?php
App::uses('AppModel', 'Model');
/**
 * Resposta Model
 *
 * @property Pergunta $Pergunta
 * @property Usuario $Usuario
 */
class Resposta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'conteudo';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Pergunta' => array(
			'className' => 'Pergunta',
			'foreignKey' => 'pergunta_id',
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

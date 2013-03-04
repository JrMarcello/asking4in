<?php
App::uses('AppModel', 'Model');
/**
 * Pergunta Model
 *
 * @property Usuario $Usuario
 * @property Topico $Topico
 * @property Resposta $Resposta
 */
class Pergunta extends AppModel {

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
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Topico' => array(
			'className' => 'Topico',
			'foreignKey' => 'topico_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Resposta' => array(
			'className' => 'Resposta',
			'foreignKey' => 'pergunta_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}

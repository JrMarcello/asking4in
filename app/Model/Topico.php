<?php
App::uses('AppModel', 'Model');
/**
 * Topico Model
 *
 * @property Tema $Tema
 * @property Pergunta $Pergunta
 */
class Topico extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nome';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tema' => array(
			'className' => 'Tema',
			'foreignKey' => 'tema_id',
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
		'Pergunta' => array(
			'className' => 'Pergunta',
			'foreignKey' => 'topico_id',
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

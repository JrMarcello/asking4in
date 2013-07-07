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

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nome' => array(
			'notempty' => array(
				'rule' => 'notempty',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => '__("Topic name must be unique")',
            )
		),
		'tema_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

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
		),
                'Notificacao' => array(
                            'className' => 'Notificacao',
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
    
    public function sidebar() {
        $this->contain(array(
            'Pergunta' => array(
                'order' => 'Pergunta.created',
                'limit' => 3
            )
        ));
        
        return $this->find('all', array(
            'order' => 'Created',
            'limit' => 3
        ));
    }

}

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
    
    /**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'titulo' => array(
			'notempty' => array(
				'rule' => 'notempty',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'maxlength' => array(
                'rule' => array('maxLength', 100)
            ),
            'minlength' => array(
                'rule' => array('minLength', 10)
            ),
		),
        'conteudo' => array(
			'notempty' => array(
				'rule' => 'notempty',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'topico_id' => array(
			'notempty' => array(
				'rule' => 'notempty',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);


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
    
    public function beforeValidate($options = array()) {
        parent::beforeValidate($options);
        
        $this->data['Pergunta']['usuario_id'] = AuthComponent::user('id');
    }

}

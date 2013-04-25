<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Grupo Model
 *
 * @property Tema $Tema
 * @property Usuario $Usuario
 */
class Grupo extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'nome';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Tema' => array(
            'className' => 'Tema',
            'foreignKey' => 'grupo_id',
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

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Usuario' => array(
            'className' => 'Usuario',
            'joinTable' => 'grupos_usuarios',
            'foreignKey' => 'grupo_id',
            'associationForeignKey' => 'usuario_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );

    public function addGroups($groups) {
        foreach ($groups as $group) {
            $count = $this->find('count', array(
                'conditions' => array('facebook_id' => $group['id'])
            ));
            if ($count == 0) {
                $group_data = array(
                    'facebook_id' => $group['id'],
                    'nome' => trim(str_replace('[ASK4In]', '', $group['name']))
                );
                
                $result = $this->save($group_data);
                
                unset($group_data);
            }
        }
    }
	
	public function sidebar() {
		$params = array(
			'conditions' => array(
				
			),
			'joins' => array(
				array(
					'table' => 'grupos_usuarios',
					'alias' => 'GruposUsuario',
					'type' => 'INNER',
					'conditions' => array(
						'Grupo.id = GruposUsuario.grupo_id'
					)
				)
			),
			'limit' => 3
		);
		if (AuthComponent::user()) {
			$params['conditions'] = array('GruposUsuario.usuario_id' => AuthComponent::user('id'));
		}
		$this->contain('Tema');
		
		$grupos = $this->find('all', $params);
		
		return $grupos;
	}

}

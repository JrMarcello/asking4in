<?php

App::uses('AppModel', 'Model');

/**
 * Usuario Model
 *
 * @property Pergunta $Pergunta
 * @property Resposta $Resposta
 * @property Grupo $Grupo
 */
class Usuario extends AppModel {

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
        'Pergunta' => array(
            'className' => 'Pergunta',
            'foreignKey' => 'usuario_id',
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
        'Resposta' => array(
            'className' => 'Resposta',
            'foreignKey' => 'usuario_id',
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
            'foreignKey' => 'usuario_id',
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
        'Grupo' => array(
            'className' => 'Grupo',
            'joinTable' => 'grupos_usuarios',
            'foreignKey' => 'usuario_id',
            'associationForeignKey' => 'grupo_id',
            'unique' => false,
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

    public function findGrupos($id) {
        $user = $this->find('first', array(
            'conditions' => array('id' => $id)
        ));
        
        return $user['Grupo'];
    }

    private function reduceGroupsFbIds($groups) {
        function reduceGroup($result, $item) {
            $result[] = $item['facebook_id'];
            return $result;
        }

        return array_reduce($groups, 'reduceGroup', array());
    }

    public function grupos($groups, $id) {
        $data = array();
        $user_groups = $this->reduceGroupsFbIds($this->findGrupos($id));
		
		if (!empty($groups)) {
			$this->Grupo->addGroups($groups);
		}
        
        foreach ($groups as $grupo) {
            if (!in_array($grupo['id'], $user_groups)) {
                $db_group = $this->Grupo->find('first', array(
                    'conditions' => array('facebook_id' => $grupo['id']),
                    'fields' => array('id')
                ));
                $data[] = array(
                    'Usuario' => array(
                        'id' => $id
                    ),
                    'Grupo' => array(
                        'id' => $db_group['Grupo']['id']
                    )
                );
            }
        }
        
        if (!empty($data)) {
            $this->saveAll($data);
        }
    }

}

<?php

App::uses('AppModel', 'Model');

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
                    'nome' => $group['name']
                );
                
                $result = $this->save($group_data);
                if ($result) {
                    debug($group_data);
                    debug($groups);
                    die();
                }
                
                unset($group_data);
            }
        }
    }

}

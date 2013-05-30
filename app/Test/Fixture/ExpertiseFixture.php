<?php
/**
 * ExpertiseFixture
 *
 */
class ExpertiseFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'usuario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'topico_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'nivel' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'usuario_topico' => array('column' => array('usuario_id', 'topico_id'), 'unique' => 1),
			'usuario_id' => array('column' => 'usuario_id', 'unique' => 0),
			'topico_id' => array('column' => 'topico_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'usuario_id' => 1,
			'topico_id' => 1,
			'nivel' => 'Lorem ipsum dolor sit amet'
		),
	);

}

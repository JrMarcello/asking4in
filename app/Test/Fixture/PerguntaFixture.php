<?php
/**
 * PerguntaFixture
 *
 */
class PerguntaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'conteudo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1024, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'topico_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
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
			'conteudo' => 'Lorem ipsum dolor sit amet',
			'usuario_id' => 1,
			'topico_id' => 1
		),
	);

}

<?php
/**
 * RespostaFixture
 *
 */
class RespostaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'conteudo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1024, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'score' => array('type' => 'integer', 'null' => true, 'default' => null),
		'pergunta_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'pergunta_id' => array('column' => 'pergunta_id', 'unique' => 0),
			'usuario_id' => array('column' => 'usuario_id', 'unique' => 0)
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
			'score' => 1,
			'pergunta_id' => 1,
			'usuario_id' => 1,
			'created' => '2013-03-12 21:02:35',
			'modified' => '2013-03-12 21:02:35'
		),
	);

}

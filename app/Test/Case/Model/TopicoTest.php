<?php
App::uses('Topico', 'Model');

/**
 * Topico Test Case
 *
 */
class TopicoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.topico',
		'app.tema',
		'app.grupo',
		'app.usuario',
		'app.grupos_usuario',
		'app.pergunta',
		'app.resposta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Topico = ClassRegistry::init('Topico');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Topico);

		parent::tearDown();
	}

}

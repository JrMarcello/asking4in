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
		'app.pergunta',
		'app.resposta',
		'app.grupos_usuario'
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

<?php
App::uses('Resposta', 'Model');

/**
 * Resposta Test Case
 *
 */
class RespostaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.resposta',
		'app.pergunta',
		'app.usuario',
		'app.grupo',
		'app.tema',
		'app.topico',
		'app.grupos_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Resposta = ClassRegistry::init('Resposta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Resposta);

		parent::tearDown();
	}

}

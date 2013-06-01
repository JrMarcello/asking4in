<?php
App::uses('Expertise', 'Model');

/**
 * Expertise Test Case
 *
 */
class ExpertiseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expertise',
		'app.usuario',
		'app.pergunta',
		'app.topico',
		'app.tema',
		'app.grupo',
		'app.grupos_usuario',
		'app.resposta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expertise = ClassRegistry::init('Expertise');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expertise);

		parent::tearDown();
	}

}

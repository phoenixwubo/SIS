<?php
App::uses('Elective', 'Model');

/**
 * Elective Test Case
 *
 */
class ElectiveTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.elective',
		'app.course',
		'app.semester'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Elective = ClassRegistry::init('Elective');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Elective);

		parent::tearDown();
	}

}

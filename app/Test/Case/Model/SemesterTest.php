<?php
App::uses('Semester', 'Model');

/**
 * Semester Test Case
 *
 */
class SemesterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.semester'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Semester = ClassRegistry::init('Semester');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Semester);

		parent::tearDown();
	}

}

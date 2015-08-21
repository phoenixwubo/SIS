<?php
App::uses('Score', 'Model');

/**
 * Score Test Case
 *
 */
class ScoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.score',
		'app.course_plan',
		'app.course',
		'app.user',
		'app.semester',
		'app.department'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Score = ClassRegistry::init('Score');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Score);

		parent::tearDown();
	}

}

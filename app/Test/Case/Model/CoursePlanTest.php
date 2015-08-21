<?php
App::uses('CoursePlan', 'Model');

/**
 * CoursePlan Test Case
 *
 */
class CoursePlanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->CoursePlan = ClassRegistry::init('CoursePlan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CoursePlan);

		parent::tearDown();
	}

}

<?php
App::uses('TeachingTask', 'Model');

/**
 * TeachingTask Test Case
 *
 */
class TeachingTaskTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.teaching_task',
		'app.department',
		'app.course_plan',
		'app.course',
		'app.user',
		'app.semester'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TeachingTask = ClassRegistry::init('TeachingTask');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TeachingTask);

		parent::tearDown();
	}

}

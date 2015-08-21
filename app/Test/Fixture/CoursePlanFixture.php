<?php
/**
 * CoursePlanFixture
 *
 */
class CoursePlanFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'course_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'comment' => '课程代号'),
		'course_type' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '课程类型'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'semester_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'score_type' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'comment' => '成绩类型'),
		'department_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'course_id' => 1,
			'course_type' => 1,
			'user_id' => 1,
			'semester_id' => 1,
			'score_type' => 1,
			'department_id' => 1
		),
	);

}

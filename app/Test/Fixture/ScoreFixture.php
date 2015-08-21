<?php
/**
 * ScoreFixture
 *
 */
class ScoreFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'score';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'course_plan_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'comment' => '课程代号'),
		'stu_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'comment' => '学号', 'charset' => 'utf8'),
		'regular' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'comment' => '平时成绩'),
		'midterm' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'comment' => '期中成绩'),
		'final' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'comment' => '期末成绩'),
		'total' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'comment' => '总评成绩'),
		'tn1' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => '考试1名称', 'charset' => 'utf8'),
		's1' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '考试1成绩'),
		'tn2' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => '考试2名称', 'charset' => 'utf8'),
		's2' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '考试2成绩'),
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
			'course_plan_id' => 1,
			'stu_number' => 'Lorem ip',
			'regular' => 1,
			'midterm' => 1,
			'final' => 1,
			'total' => 1,
			'tn1' => 'Lorem ipsum dolor ',
			's1' => 1,
			'tn2' => 'Lorem ipsum dolor ',
			's2' => 1
		),
	);

}

<?php
/**
 * ElectiveFixture
 *
 */
class ElectiveFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'stu_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'course_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'semester_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '学期名称'),
		'elective_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '选修课时序号'),
		'result' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 4, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'stu_number' => 'Lorem ip',
			'course_id' => 1,
			'semester_id' => 1,
			'elective_number' => 1,
			'result' => 'Lo',
			'created' => '2015-05-01 10:40:57',
			'modified' => '2015-05-01 10:40:57'
		),
	);

}

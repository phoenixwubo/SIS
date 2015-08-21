<?php
/**
 * StudentFixture
 *
 */
class StudentFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'student';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'stu_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 12, 'collate' => 'utf8_unicode_ci', 'comment' => '学号', 'charset' => 'utf8'),
		'stu_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'comment' => '姓名', 'charset' => 'utf8'),
		'id_card_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => '证件号码', 'charset' => 'utf8'),
		'dob' => array('type' => 'date', 'null' => false, 'default' => null, 'comment' => '出生日期'),
		'nationality' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'comment' => '民族', 'charset' => 'utf8'),
		'native_place' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'comment' => '籍贯', 'charset' => 'utf8'),
		'gender' => array('type' => 'integer', 'null' => false, 'default' => null),
		'address' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'parent_phone1' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'parent_phone2' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null),
		'password' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'integer', 'null' => false, 'default' => null),
		'note' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 1)
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
			'stu_id' => 'Lorem ipsu',
			'stu_name' => 'Lorem ipsum dolor sit amet',
			'id_card_number' => 'Lorem ipsum dolor ',
			'dob' => '2015-02-12',
			'nationality' => 'Lorem ipsum dolor ',
			'native_place' => 'Lorem ipsum dolor sit amet',
			'gender' => 1,
			'address' => 'Lorem ipsum dolor sit amet',
			'parent_phone1' => 'Lorem ipsum dolor ',
			'parent_phone2' => 'Lorem ipsum dolor ',
			'status' => 1,
			'password' => 1,
			'created' => '2015-02-12 04:38:05',
			'modified' => 1,
			'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}

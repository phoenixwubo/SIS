<?php
/**
 * SemesterFixture
 *
 */
class SemesterFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'year' => array('type' => 'text', 'null' => false, 'default' => null, 'length' => 4, 'comment' => '开始年份'),
		'sem_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'comment' => '名称', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '创建时间'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '修改时间'),
		'sem_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'comment' => '学期序号'),
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
			'year' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'sem_name' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-03-14 13:11:08',
			'modified' => '2015-03-14 13:11:08',
			'sem_number' => 1
		),
	);

}

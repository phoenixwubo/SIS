<?php
App::uses('AppModel', 'Model');
/**
 * Course Model
 *
 */
class Course extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'stu_info_man';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'course_name';

}

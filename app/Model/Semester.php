<?php
App::uses('AppModel', 'Model');
/**
 * Semester Model
 *
 */
class Semester extends AppModel {

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
	public $displayField = 'sem_name';

}

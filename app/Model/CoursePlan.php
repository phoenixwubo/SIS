<?php
App::uses('AppModel', 'Model');
/**
 * CoursePlan Model
 *
 * @property Course $Course
 * @property User $User
 * @property Semester $Semester
 * @property Department $Department
 */
class CoursePlan extends AppModel {

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
	public $displayField = 'course_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Course' => array(
			'className' => 'Course',
			'foreignKey' => 'course_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Semester' => array(
			'className' => 'Semester',
			'foreignKey' => 'semester_id',
// 			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

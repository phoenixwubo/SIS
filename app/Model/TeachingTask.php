<?php
App::uses('AppModel', 'Model');
/**
 * TeachingTask Model
 *
 * @property Department $Department
 * @property CoursePlan $CoursePlan
 * @property User $User
 */
class TeachingTask extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'stu_info_man';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CoursePlan' => array(
			'className' => 'CoursePlan',
			'foreignKey' => 'course_plan_id',
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
		)
	);
}

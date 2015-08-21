<?php
App::uses('AppModel', 'Model');
/**
 * Score Model
 *
 * @property CoursePlan $CoursePlan
 */
class Score extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'stu_info_man';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'scores';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *其中学号字段要模糊查找
 * @var array
 */
	public $belongsTo = array(
		'CoursePlan' => array(
			'className' => 'CoursePlan',
			'foreignKey' => 'course_plan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => false,
			'conditions' =>array( 'OR' => array(
			'Student.stu_number = Score.stu_number',
			'Student.note LIKE CONCAT(\'%\', Score.stu_number, \'%\') '		
			)
			),
			'fields' => '',
			'order' => ''
		)
	);
}

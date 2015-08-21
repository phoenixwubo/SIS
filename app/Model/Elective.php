<?php
App::uses('AppModel', 'Model');
/**
 * Elective Model
 *
 * @property Semester $Semester
 * @property Student $Student
 */
class Elective extends AppModel {

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
 * 其中学号字段要模糊查找
 */
	public $belongsTo = array(
// 		'Semester' => array(
// 			'className' => 'Semester',
// 			'foreignKey' => 'semester_id',
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => ''
// 		),
			'Course' => array(
					'className' => 'Course',
					'foreignKey' => 'course_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => false,
			'conditions' =>array( 'OR' => array(
			'Student.stu_number=Elective.stu_number',
			'Student.note LIKE CONCAT(\'%\', Elective.stu_number, \'%\') '		
					)
			),
			'fields' => '',
			'order' => ''
		)
	);
}

<?php
App::uses('AppModel', 'Model');
/**
 * Department Model
 *
 * @property Department $ParentDepartment
 * @property Department $ChildDepartment
 * @property users $users
 */
class Department extends AppModel {
	public $actsAs = array('Tree');
	public $useDbConfig = 'stu_info_man';
	public $useTable = 'departments';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'dept_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'dept_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)/*,
		'parent_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'default'=>0
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentDepartment' => array(
			'className' => 'Department',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	
	
/*	public $hasMany = array(
		'ChildDepartment' => array(
			'className' => 'Department',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);*/


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	/* public $hasAndBelongsToMany = array(
		'students' => array(
			'className' => 'users',
			'joinTable' => 'students',
			'foreignKey' => 'dept_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	); */

}

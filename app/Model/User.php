<?php
App::uses('AppModel', 'Model');
App::uses('upload','upload');

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
// other code.

/**
 * User Model
 *
 */
class User extends AppModel {
	public $useDbConfig = 'stu_info_man';
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
			$this->data[$this->alias]['password']
			);
		}
		return true;
	}
/* 	public $hasOne=array(
		'Profile'=>array(
			'classname'=>'Profile',
			'dependent'=>true
		)
	); */
	/*user hasMany students
	 * var string*/
/* 	public $hasMany=array(
		'Student'=>array(
			'classname'=>'Student'
			
		)
	);
	 */
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'fullname';
	// public $actsAs = array(
	// 		'Upload.Upload' => array(
	// 			'photo'
	// 		)
	// 	);

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'username' => array(
			'required' => array(
			'rule' => array('notEmpty'),
			'message' => 'A username is required'
				)
				),
		'password' => array(
			'required' => array(
			'rule' => array('notEmpty'),
			'message' => 'A password is required'
				)
				),
		'fullname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	),
	),
		'gender' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	),
	),
	);
}

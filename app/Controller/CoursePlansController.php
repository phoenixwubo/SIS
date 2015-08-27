<?php
App::uses('AppController', 'Controller');
App::import('Model','Department');
App::import('Model','Student');
App::import('Model','Elective');
App::import('Model','Score');
/**
 * CoursePlans Controller
 *
 * @property CoursePlan $CoursePlan
 * @property PaginatorComponent $Paginator
 */
class CoursePlansController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index($department_id=null,$semester_id=null,$course_id=null,$course_type=null,$score_type=null) {
		$this->CoursePlan->recursive = 0;
		$this->layout='ajax';
		if(isset($this->request->query ['department_id']) && !(($this->request->query ['department_id']=='')))
		{
			$department_id = $this->request->query ['department_id'];
		}
		
		if(isset($this->request->query ['course_id']) && !($this->request->query ['course_id']=='')){
			($course_id = $this->request->query ['course_id']);
		}
		
		if(isset($this->request->query ['semester_id'])&& !($this->request->query ['semester_id']=='')){
			($semester_id = $this->request->query ['semester_id']);
		}
		
		if(isset($this->request->query ['course_type'])&& !($this->request->query ['course_type']=='')){
			($course_type = $this->request->query ['course_type']);
		}
		
		if(isset($this->request->query ['score_type'])&& !($this->request->query ['score_type']=='')){
			($course_type = $this->request->query ['score_type']);
		}
		
		$this->CoursePlan->recursive = 0;
		$this->layout='ajax';
		if ($department_id == null || $department_id=='null' ) {
			$condition = array (
// 					1 => 1
			);
		} else {
		
			App::import ( 'Controller', 'Departments' );
			$DepartmentsController = new DepartmentsController ();
			$depts = $DepartmentsController->getChildren ( $department_id );
			$dept_count=count($depts);
				
			if($dept_count==1){
				$parent_dept=$DepartmentsController->getparent($department_id);
				$parent_dept_id=$parent_dept['Department']['id'];
				$department_id=$parent_dept_id;
			}
			$condition = array (
					'conditions'=>array(
							'department_id' => $department_id
					)
						
			);
		}
		
		if($semester_id!=null && $semester_id!='null' ) $condition['conditions']['semester_id']=$semester_id;
		if($course_id!=null && $course_id!='null') $condition['conditions']['course_id']=$course_id;
		if($course_type!=null && $course_type!='null') $condition['conditions']['CoursePlan.course_type']=$course_type;
		if($score_type!=null && $score_type!='null') $condition['conditions']['score_type']=$score_type;
		// 		debug($condition);
		$condition['order']='course_id';
// 		debug($condition);
		$this->Paginator->settings=$condition;
		$this->set('coursePlans', $this->Paginator->paginate());
		$result['success']=true;
		$this->set('result',$result);
	
	}
	
	public function listCoursePlans($department_id=null,$semester_id=null,$course_id=null,$course_type=null,$returnback=null) {
		if(isset($this->request->query ['department_id']) && !(($this->request->query ['department_id']=='')))
		{
			$department_id = $this->request->query ['department_id'];
// 			$condition['conditions']['department_id']=$department_id;
				
				
				
		}
		if(isset($this->request->query ['course_id']) && !($this->request->query ['course_id']=='')){
			($course_id = $this->request->query ['course_id']);
// 			$condition['conditions']['course_id']=$course_id;
		}
		if(isset($this->request->query ['semester_id'])&& !($this->request->query ['semester_id']=='')){
			($semester_id = $this->request->query ['semester_id']);
// 			$condition['conditions']['semester_id']=$semester_id;
				
				
		}
		$this->CoursePlan->recursive = 0;
		$this->layout='ajax';
		if ($department_id == null || $department_id=='null' ) {
			$condition = array (
					1 => 1
			);
		} else {
		

			App::import ( 'Controller', 'Departments' );
			$DepartmentsController = new DepartmentsController ();
			$depts = $DepartmentsController->getChildren ( $department_id );
			$dept_count=count($depts);
			
			if($dept_count==1){
				$parent_dept=$DepartmentsController->getparent($department_id);
				$parent_dept_id=$parent_dept['Department']['id'];
				$department_id=$parent_dept_id;
			}
		}			
		$condition = array (
					'conditions'=>array(
						'department_id' => $department_id	
					)
					
			);
		
		if($semester_id!=null && $semester_id!='null' ) $condition['conditions']['semester_id']=$semester_id;
		if($course_id!=null && $course_id!='null') $condition['conditions']['course_id']=$course_id;
		if($course_type!=null && $course_type!='null') $condition['conditions']['CoursePlan.course_type']=$course_type;
// 		debug($condition);
		$condition['order']='course_id';
		$coursePlans=$this->CoursePlan->find('all',$condition);
		
		
		$this->set('coursePlans', $this->CoursePlan->find('all',$condition));
		$result['success']=true;
		$this->set('result',$result);
		if($returnback==true)		return $coursePlans;
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CoursePlan->exists($id)) {
			throw new NotFoundException(__('Invalid course plan'));
		}
		$options = array('conditions' => array('CoursePlan.' . $this->CoursePlan->primaryKey => $id));
		$this->set('coursePlan', $this->CoursePlan->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CoursePlan->create();
			
			
			if(($this->request->data)==NULL){
				
				$result['success']=FALSE;
				$this->layout='ajax';
				//echo('不是通过post传递');
				$string=file_get_contents("php://input");
				$coursePlans=json_decode($string);
// 				print_r($coursePlans) ;
				$department_id=$coursePlans->department_id;
				$score_type=$coursePlans->score_type;
				$course_type=$coursePlans->course_type;
				
				if ($this->CoursePlan->save($coursePlans)||$this->CoursePlan->saveAll($coursePlans)) {
					$id=$this->CoursePlan->getInsertID();
					$result['success']=true;
					$result['id']=$id;
					$result['department_id']=$department_id;
					
// 					if($score_type==1){
// 						$this->score($id,$department_id);//批量增加学生必修的考试科目成绩信息
// 					}else{
// 						$this->elective($id,$course_type,$department_id);
// // 						echo('考查科目');
// // 						die();//此处断电！！
// 					}
					
					
				}
			
				$this->set('result',$result);
			}else{
					if ($this->CoursePlan->save($this->request->data)) {
				$this->Session->setFlash(__('The course plan has been saved.'));
// 				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course plan could not be saved. Please, try again.'));
			}
			}
		
		}
		$courses = $this->CoursePlan->Course->find('list');
		$users = $this->CoursePlan->User->find('list');
		$semesters = $this->CoursePlan->Semester->find('list');
		$departments = $this->CoursePlan->Department->find('list');
		$this->set(compact('courses', 'users', 'semesters', 'departments','results'));
	}
//由课程计划添加学生成绩信息	
	public function score($course_plan_id,$department_id){
		//$course_plan_id=1;
		//$department_id=38;
		$Department = new Department();
		$depts=$Department->read('dept_number',$department_id);
	// 	$depts=$Departments->getChildren($department_id);
	// 	$conditions['Student.stu_number LIKE']=$depts['Department']['dept_number'].'%';
		$options = array('conditions' => array('dept_number like'=> $depts['Department']['dept_number'].'%'));
// 		debug($options);
		$Student = new Student();
		$students=$Student->find('all',$options);
// 		debug($students);
		$data=array();
		foreach($students as $student){
			$data[]=array(
					'stu_number'=>$student['Student']['stu_number'],
					'dept_number'=>$student['Student']['dept_number'],
					'course_plan_id'=>$course_plan_id,
					'course_type'=>1
			);
			
		}
// 		debug($data);
		$Score=new Score();
		$success=$Score->saveAll($data);
		return $success;
	// 	$dept_number=
	// 	$students=
		
	} 
	
	public function elective($course_plan_id,$course_type,$department_id,$semester_id){
		$Department = new Department();
		$success=false;
		$depts=$Department->read('dept_number',$department_id);
		// 	$depts=$Departments->getChildren($department_id);
		// 	$conditions['Student.stu_number LIKE']=$depts['Department']['dept_number'].'%';
		$options = array('conditions' => array('dept_number like'=> $depts['Department']['dept_number'].'%'));
		//debug($options);
		$Student = new Student();
		$students=$Student->find('all',$options);
// 		debug($students);
		$data=array();
		foreach($students as $student){
		$data[]=array(
			'stu_number'=>$student['Student']['stu_number'],
				'dept_number'=>$student['Student']['dept_number'],
					'course_plan_id'=>$course_plan_id,
					'course_type'=>$course_type,
// 					'department_id'=>$department_id
			);
						
		}
// 					debug($data);
					if($data!=array()){
							$Elective=new Elective();
							$success=$Elective->saveAll($data);
							
			
					}
		
			// 	$dept_number=
			// 	$students=
// 			die();
		return $success;
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CoursePlan->exists($id)) {

			if(!$this->request->is(array('post', 'put'))){
			throw new NotFoundException(__('Invalid course plan'));
			}
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data==NULL){
					
				$result['success']=FALSE;
				$this->layout='ajax';
				$string=file_get_contents("php://input");
				$courses=json_decode($string);
// 				debug($courses) ;
				if ($this->CoursePlan->save($courses)||$this->CoursePlan->saveAll($courses)) {
					$result['success']=true;
				}
					
				$this->set('result',$result);
				
					
			}else{
				$oldValue=$this->CoursePlan->field('user_id');
			$newValue=$this->data['CoursePlan']['original_user_id'];
			$oldDate=$this->data['CoursePlan']['original_date'];
			if($oldValue!=$newValue){
				$string=$oldDate;
				$string.='+'.date('Y-m-d H:i:s');;
				$string.='+'.$this->data['CoursePlan']['original_user_id'].'&';
				
				$this->request->data['CoursePlan']['note']=$this->data['CoursePlan']['note'].$string;
				debug($this->request->data);
			}
				
			
			debug($oldValue);
			debug($newValue);
			
			if ($this->CoursePlan->save($this->request->data)) {
				
				$this->Session->setFlash(__('The course plan has been saved.'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course plan could not be saved. Please, try again.'));
			}
			}
			//如果发生改变 
			
		} else {
			$options = array('conditions' => array('CoursePlan.' . $this->CoursePlan->primaryKey => $id));
			$this->request->data = $this->CoursePlan->find('first', $options);
			$this->request->data['CoursePlan']['original_user_id']=$this->request->data['CoursePlan']['user_id'];
			$this->request->data['CoursePlan']['original_date']=$this->request->data['CoursePlan']['modified'];
			debug($this->request->data);
		}
		$courses = $this->CoursePlan->Course->find('list');
		$users = $this->CoursePlan->User->find('list');
		$semesters = $this->CoursePlan->Semester->find('list');
		$departments = $this->CoursePlan->Department->find('list');
		$this->set(compact('courses', 'users', 'semesters', 'departments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function delete($id = null) {

		$this->CoursePlan->id = $id;
		if (!$this->CoursePlan->exists()) {
			if(!$this->request->is(array('post', 'put'))){
				throw new NotFoundException(__('Invalid course plan'));
			}else
			{
				$result['success']=FALSE;
				$this->layout='ajax';
				$string=file_get_contents("php://input");
				$courses=json_decode($string);
				// 				debug($courses);
				$this->CoursePlan->id = $courses->id;
			}
				
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CoursePlan->delete()) {
			//return $this->flash(__('The course has been deleted.'), array('action' => 'index'));
			$result['success']=TRUE;
		} else {
			$result['success']=FALSE;
				
			//return $this->flash(__('The course could not be deleted. Please, try again.'), array('action' => 'index'));
		}
		$this->set('result',$result);
		echo(json_encode($result));
		die();
		
	}
	
	/* 
	 * 
	 * 实施课程计划 
	 * 
	 * 
	 * */
	
	public function implement ($course_plan_id=null,$department_id=null,$course_type=null,$score_type=null,$semester_id=null){
		$this->layout='ajax';
		if ($this->request->is('post')) {
			if(!($this->request->data)==NULL){
				$course_plan_id=$this->request->data['id'];
				$department_id=$this->request->data['department_id'];
				$course_type=$this->request->data['course_type'];
				$score_type=$this->request->data['score_type'];
				$semester_id=$this->request->data['semester_id'];
			}
		}
		$course_plan=$this->CoursePlan->findById($course_plan_id);
		if($course_plan['CoursePlan']['implement']>0){
			$result['tip']='该课程计划已经部署过';
// 			echo('该课程计划已经部署过');
// 			debug($course_plan);
			$result['success']=false;
		}
		else{
			switch ($score_type){
				case 1:
						$result['success']=$this->score($course_plan_id,$department_id);
						if($result['success']){
							$result['tip']='部署必修考试科目课程计划';
							$data['id']=$course_plan_id;
							$data['implement']=1;
							$this->CoursePlan->save($data);
						}
						break;
				case 2:
						switch ($course_type){
							case 1:
								$result['success']=$this->elective($course_plan_id,$course_type,$department_id,$semester_id);
								$result['tip']='部署必修考查科目课程计划';
								break;
							case 2:
								$options['conditions']=array(
									'department_id'=>$department_id,
									'CoursePlan.course_type'=>$course_type,
									'semester_id'=>$semester_id,
									'implement >'=>0
									);
// 								debug($options);
								if(count($this->CoursePlan->find('first',$options))>0){
//									echo('本学期已经有一个选修课时,成功添加选修课程');
									$result['tip']='本学期已经有一个选修课时成功添加选修课程';
									$result['success']=true;
										
								}else{
									$result['success']=$this->elective($course_plan_id,$course_type,$department_id,$semester_id);
									$result['tip']='部署选修课程计划成功，成功添加选修课程';
								}
								break;
								
						}
						
						break;

						
						
				
			}
			 if($result['success']){
							
							$data['id']=$course_plan_id;
							$data['implement']=1;
							$this->CoursePlan->save($data);
						}
						
		}
// 		debug($this->request->data);
		
		
		echo(json_encode($result));
		die();
	}
}

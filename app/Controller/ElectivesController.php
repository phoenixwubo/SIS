<?php
App::uses('AppController', 'Controller');
App::import('Model','Department');
App::import('Model','Student');
/**
 * Electives Controller
 *
 * @property Elective $Elective
 * @property PaginatorComponent $Paginator
 */
class ElectivesController extends AppController {

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
	public function index($course_type=null,$department_id=null,$semester_id=null,$course_id=null) {
		$option=array();
		if(isset($this->request->query ['department_id']) && !(($this->request->query ['department_id']=='')))
		{
			$department_id = $this->request->query ['department_id'];
		}
		if(isset($this->request->query ['course_type']) && !(($this->request->query ['course_type']=='')))
		{
			$course_type = $this->request->query ['course_type'];
		}
		if(isset($this->request->query ['semester_id']) && !(($this->request->query ['semester_id']=='')))
		{
			$semester_id = $this->request->query ['semester_id'];
			$option['conditions']['semester_id']=$semester_id;
		}
		if(isset($this->request->query ['course_id']) && !(($this->request->query ['course_id']=='')))
		{
			$course_id = $this->request->query ['course_id'];
			$option['conditions']['course_id']=$course_id;
		}
		if($course_type!=null) $option['conditions']['Elective.course_type'] =$course_type;
		if($department_id!=null) 
		{


			App::import ( 'Controller', 'Departments' );
			$DepartmentsController = new DepartmentsController ();
			$department = $DepartmentsController->view ( $department_id );
			
// 			debug($department);
			$dept_number=$department['Department']['dept_number'];
			$option['conditions']['Elective.dept_number like ']=$dept_number.'%';
			$this->Paginator->settings=$option;
		}
		$this->Elective->recursive = 0;
		$success=true;

		$page= $this->request->query['page'];
		$limit= $this->request->query['limit'];
		$this->Paginator->settings['page']=$page;
		$this->Paginator->settings['limit'] = $limit;
// 		$this->set('electives',$this->Elective->find('all'));
		$this->set('electives', $this->Paginator->paginate());
		$this->set('success',$success);
		$this->layout='ajax';
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Elective->exists($id)) {
			throw new NotFoundException(__('Invalid elective'));
		}
		$options = array('conditions' => array('Elective.' . $this->Elective->primaryKey => $id));
		$this->set('elective', $this->Elective->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Elective->create();
			if ($this->Elective->save($this->request->data)) {
				return $this->flash(__('The elective has been saved.'), array('action' => 'index'));
			}
		}
		$courses = $this->Elective->Course->find('list');
		$semesters = $this->Elective->Semester->find('list');
		$this->set(compact('courses', 'semesters'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Elective->exists($id)) {
			if(!$this->request->is(array('post','put'))){
				throw new NotFoundException(__('Invalid elective'));
			}

		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data==NULL){
				$this->layout='ajax';
				$string=file_get_contents("php://input");
				$electives=json_decode($string);
				$result['success']=false;
				if($this->Elective->save($electives)||$this->Elective->saveAll($electives)){
					$result['success']=true;
					$this->set('result',$result);
					echo(json_encode($result));
					die();
				}
			}
			else{
				if ($this->Elective->save($this->request->data)) {
				return $this->flash(__('The elective has been saved.'), array('action' => 'index'));
			}
			}
			

		} else {
			$options = array('conditions' => array('Elective.' . $this->Elective->primaryKey => $id));
			$this->request->data = $this->Elective->find('first', $options);
		}
		$courses = $this->Elective->Course->find('list');
		$semesters = $this->Elective->Semester->find('list');
		$this->set(compact('courses', 'semesters'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Elective->id = $id;
		if (!$this->Elective->exists()) {
			throw new NotFoundException(__('Invalid elective'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Elective->delete()) {
			return $this->flash(__('The elective has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The elective could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
	// 选修课课时 
	public function electiveLesson(){
		$this->layout='ajax';
		$conditon=array(
				'fields'=>array('Semester.sem_name','ELective.department_id','MAX(ELective.lesson_number) AS number'),
				'group'=>array('Elective.semester_id'),
				'conditions'=>array('Elective.course_type'=>2)
				);
		$electiveLessons=$this->Elective->find('all',$conditon);
		$this->set('electiveLessons',$electiveLessons);
	}
	
//查询	
// 	批量添加选修课名单
	public function batchElective($department_id=null,$semester_id=null,$course_id=null,$lesson_numbers=1){
		//$course_plan_id=1;
		//$department_id=38;
		$this->layout='ajax';
		$Department = new Department();
		$depts=$Department->read('dept_number',$department_id);
		// 	$depts=$Departments->getChildren($department_id);
		// 	$conditions['Student.stuid LIKE']=$depts['Department']['dept_number'].'%';
		$options = array('conditions' => array('stu_number like'=> $depts['Department']['dept_number'].'%'));
		//debug($options);
		$Student = new Student();
		$students=$Student->find('all',$options);
		//debug($students);
		$data=array();
		
		foreach($students as $student){
			for($i=1;$i<=$lesson_numbers;$i++){
				$data[]=array(
					'stu_number'=>$student['Student']['stu_number'],
					'semester_id'=>$semester_id,
					'lesson_number'=>$i,
					'course_type'=>2,	
					'department_id'=>$department_id
			);
			}
			
				
		}
// 		debug($data);
		$this->Elective->saveAll($data);
		echo '{success:true}';
		die;
		// 	$dept_number=
		// 	$students=
	
	}
	
// 	选修课课时修改

	public function listResults(){
		$this->layout='ajax';
		if(isset($this->request->query['stu_number'])){
			$stu_numbers=$this->request->query['stu_number'];
		}else{
			die();
		}
		
		
		if(isset($stu_numbers)){
			App::import('Controller','Students');
			$Student=new StudentsController();
			$electives=$this->Elective->find('all' ,array(
					'conditions'=>array(
						'elective.stu_number'=>$Student->stuNumbers($stu_numbers)
// 								'elective.stu_number'=>$stu_numbers
					)
			) 
					);
			$success='true';
			$this->set(compact('success','electives'));
		}
	}
	}
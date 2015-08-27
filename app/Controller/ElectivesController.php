<?php
App::uses('AppController', 'Controller');
App::import('Model','Department');
App::import('Model','Student');
App::import('Vendor','excel_reader2');
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
		$conditions=array();
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
			$conditions['semester_id']=$semester_id;
		}
		if(isset($this->request->query ['course_id']) && !(($this->request->query ['course_id']=='')))
		{
			$course_id = $this->request->query ['course_id'];
			$conditions['course_id']=$course_id;
		}
		if($course_type!=null) $conditions['Elective.course_type'] =$course_type;
		if($department_id!=null) 
		{


			App::import ( 'Controller', 'Departments' );
			$DepartmentsController = new DepartmentsController ();
			$department = $DepartmentsController->view ( $department_id );
			
// 			debug($department);
			$dept_number=$department['Department']['dept_number'];
			$conditions['Elective.dept_number like ']=$dept_number.'%';
		}
		$this->Elective->recursive = 0;
		$success=true;
		
		$this->Paginator->settings['conditions']=$conditions;
		$page= $this->request->query['page'];
		$limit= $this->request->query['limit'];
		$this->Paginator->settings['page']=$page;
		$this->Paginator->settings['limit'] = $limit;
// 		$this->set('electives',$this->Elective->find('all'));
// 		
		$electives=$this->Paginator->paginate();
// 		debug($this->Paginator->settings);
		$this->set('electives', $electives);
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
	public function rm($name)
	
	{
		$temp_arr = explode(".", $name);
		$file_ext = array_pop($temp_arr);
		$file_ext = trim($file_ext);
		$file_ext = strtolower($file_ext);
		return strtotime("now").".".$file_ext;
	
	}
	
	public function showXls($file,$department_id=null,$semester_id=null)
	{
	
	
		/* 从Department表中查询dept_id */
		// 		$this->loadModel('Department');//
		//$dept=$this->Department->findByDept_name('2014级高中1班');
	
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('utf-8');
		$data->read($file);
		// 		print_r($data);//输出excel数据
		error_reporting(E_ALL ^ E_NOTICE);
		$arr = array();
		$cols=array();
		$numCols=$data->sheets[0]['numCols'];
		$numRows=$data->sheets[0]['numRows'];
	
		/* 输出行列 */
		// 		echo '共计' .$numRows.'行,共计列数：'.$numCols;
		for($c=1;$c<=$numCols;$c++){
			switch($data->sheets[0]['cells'][1][$c])
			{
				case '姓名':
					$cols[$c]="stu_name";
					// 					debug($cols[$c]);
					break;
						
				case "性别":
					$cols[$c]="gender";
					break;
						
				case "出生日期":
					$cols[$c]="dob";
					break;
						
				case "身份证号":
					$cols[$c]="id_card_number";
					break;
						
				case "学号":
					$cols[$c]="stu_number";
					break;
						
				case "班级":
					$cols[$c]="dept_number";
					break;
	
	
				case '籍贯':
					$cols[$c]='native_place';
					break;
	
				case '民族':
					$cols[$c]='nationality';
					break;
	
				case '家庭地址':
					$cols[$c]='address';
					break;
	
				case '联系电话1':
					$cols[$c]='parent_phone1';
					break;
	
				case '联系电话2':
					$cols[$c]='parent_phone2';
					break;
	
				case '学籍':
					$cols[$c]='status';
					break;
				case '选修名称':
						$cols[$c]='course';
						break;
				case '成绩':
					$cols[$c]='result';
					break;
				default:
					$cols[$c]=$data->sheets[0]['cells'][1][$c];
	
			}
			/* 输出原来的字段名  */
			// 				$cols[$c]=$data->sheets[0]['cells'][1][$c];
		}
		// 		debug($cols);
	
		/* 以表格形式输出结果 */
		// 		echo '<table>';
	
		/* 测试导入3行 */
		App::import('Controller','CoursePlans');
		$CoursePlan=new CoursePlansController();
		$coursepalns=$CoursePlan->listCoursePlans($department_id,$semester_id,null,2,true);
		$courseList=array();
		foreach ($coursepalns as $courseplan){
			$course_name=$courseplan['Course']['course_name'];
			$course_id=$courseplan['Course']['id'];
			$courseList[$course_name]=$course_id;
		}
// 		debug($courseList);
		for ($i = 2; $i <= $numRows; $i++) {
			// 			echo '<tr>';
			// 			$count++;
			for ($j = 1;$j <= $numCols; $j++) {
	
				// 				echo '<td>';
				switch($cols[$j]){
					case "course":
						$course_name=$data->sheets[0]['cells'][$i][$j];
						if(isset($courseList[$course_name])){
						$course_id=$courseList[$course_name];}
						else{
							$course_id=0;
						}
						$arr[$i][$cols[$j]]=$course_id;
						break;
					case "gender":
						switch($data->sheets[0]['cells'][$i][$j]){
							case "男":
								$arr[$i][$cols[$j]]=1;
								break;
							case "女":
								$arr[$i][$cols[$j]]=2;
								break;
							default:
								$arr[$i][$cols[$j]]=1;
	
						}
						break;
	
					case "status":
						if(!isset($data->sheets[0]['cells'][$i][$j])){
							break;
						}else{
							switch($data->sheets[0]['cells'][$i][$j]){
								case "正常":
									$arr[$i][$cols[$j]]=1;
									break;
								case "旁听":
									$arr[$i][$cols[$j]]=4;
									break;
								default:
									$arr[$i][$cols[$j]]=1;
	
							}
							break;
						}
							
							
	
					default:
						if(isset($data->sheets[0]['cells'][$i][$j]))
						{
							$arr[$i][$cols[$j]] =$data->sheets[0]['cells'][$i][$j];
						}
						else
						{
							/* 不处理，默认为空 */
							// 							$arr[$i][$cols[$j]] =NULL;
							// 							echo $i."空".$j;
						}
						/*输出每个数组元素  */
						/* 	if(isset($arr[$i][$cols[$j]])){
						 echo $arr[$i][$cols[$j]];
						 } */
	
	
						// 				echo "</td>";
				}
				// 				echo "</tr>";
				// 				echo "<br>";
	
			}
			}
			// 				echo '</table>';
			/* 输出数组 */
			// 			debug ($arr);
			return $arr;
	
	
		}
	
		public function import($department_id=null,$semester_id=null){
			// 		debug($_FILES);
			$this->layout='ajax';
	

	
				//* 	extjs的上传 */
				if($this->request->is('post')){
					if ($_FILES['import']['error'] > 0)
					{
						$error  = $_FILES['import']['error'];
						$response = array('success' => false, 'msg' => $error);
						echo json_encode($response);
					}
					else
	
	
					{
						$file_name = $_FILES['import']['name'];
						$file_type = $_FILES['import']['type'];
						$file_size = round($_FILES['import']['size'] / 1024, 2) . '  Kilo Bytes';
						$uploaddir = WWW_ROOT."uploads/";
						//debug(WWW_ROOT);
						/*取时间戳为文件名*/
						$name=basename($_FILES['import']['name']);
						$name=$this->rm($name);
						//debug($name);
						$uploadfile = $uploaddir.$name;
							
							
						// 			/*取原名为文件名*/
						//$uploadfile = $uploaddir . basename($_FILES['import']['name']);
							
						/* 如果上传文件名有乱码 */
						/* $uploadfile=iconv("utf-8","GBK", $uploadfile); */
							
							
						if (move_uploaded_file($_FILES['import']['tmp_name'], $uploadfile)) {
							// 					echo "File is valid, and was successfully uploaded.\n";}
							//debug($uploadfile);
							$data=$this->showXls($uploadfile,$department_id,$semester_id);
							$dataLength=count($data);
// 										debug($data);
										
							$elective_data=array();
							foreach ($data as $value){
								$stu_number=$value['stu_number'];
								$course_id=$value['course'];
								$elective_data[$stu_number]=$course_id;
// 								debug($value);
							}
// 							debug($elective_data);
							$this->Elective->unbindModel(array(
									'belongsTo'=> array('CoursePlan','Course','Student')
							));
							
							App::import('Controller','CoursePlans');
							$CoursePlan=new CoursePlansController();
							$coursepalns=$CoursePlan->listCoursePlans($department_id,$semester_id,null,2,true);
							foreach ($coursepalns as $courseplan){
								$courseplan_id[]=$courseplan['CoursePlan']['id'];
							}
							$Department = new Department();
							$depts=$Department->read('dept_number',$department_id);
							$options = array('conditions' => array(
									'stu_number like'=> $depts['Department']['dept_number'].'%',
									'course_plan_id'=>$courseplan_id
							));
// 							debug($options);
							$stu_electiv_namelist=$this->Elective->find('all',$options);
// 							debug($stu_electiv_namelist);
								$num_of_success=0;
							$data=array();
							foreach ($stu_electiv_namelist as $idx=>$record){
// 								debug($student_record);
								$id=$record['Elective']['id'];
								$stu_number=$record['Elective']['stu_number'];
								$data[$idx]['id']=$id;
								$data[$idx]['stu_number']=$stu_number;
								if(isset($elective_data[$stu_number])){
									$data[$idx]['course_id']=$elective_data[$stu_number];
									$elective_data[$stu_number]==0? : ($num_of_success++) ;
									
								}
							}
// 							debug($data);
							if($this->Elective->saveAll($data)){
								// 						echo 'ok';
								$success=true;
	
									
							}else {
								// 					echo 'no';
								$success=false;
							}
							$response = array('success' =>true,
									'data' => array('name' => $file_name, 'size' => $file_size),
									'msg' => '上传了'.$dataLength.'条记录,成功导入了'.$num_of_success.'条记录。'
							);
							echo json_encode($response);
						}
					}
				}
	
				die();
	}
}
	
	
	
	

<?php
App::uses ( 'AppController', 'Controller' );

/**
 * Scores Controller
 *
 * @property Score $Score
 * @property PaginatorComponent $Paginator
 */
class ScoresController extends AppController {
	
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array (
			'Paginator' 
	);
	
	/**
	 * index method
	 *
	 * @return void
	 */
	public function getScoreTable($department_id=null,$semester_id=null,$course_id=null,$exam_name=null) {
		$this->layout = 'ajax';
		
		$limit = 5;
		$page = 2;
		$condition=array();
		if(isset($this->request->query ['department_id']) && !(($this->request->query ['department_id']=='')))
		{
			$department_id = $this->request->query ['department_id'];
			$condition['conditions']['department_id']=$department_id;
			
			
			
		}
		if(isset($this->request->query ['course_id']) && !($this->request->query ['course_id']=='')){
			($course_id = $this->request->query ['course_id']);
			$condition['conditions']['course_id']=$course_id;
		}
		if(isset($this->request->query ['semester_id'])&& !($this->request->query ['semester_id']=='')){
			($semester_id = $this->request->query ['semester_id']);
			$condition['conditions']['semester_id']=$semester_id;
					
			
		}
		if(isset($this->request->query ['exam_name'])&& !($this->request->query ['exam_name']=='')){
			($exam_name = $this->request->query ['exam_name']);
		}
		$condition['conditions']['CoursePlan.score_type']=1;//只找分数类型的
// 		debug($condition);
		if ($department_id == 0) {
			$condition = array (
					1 => 1
			);
			// $dept_number='';
		} else {
				
			$conditon = array (
					'$department_id' => $department_id
			);
			App::import ( 'Controller', 'Departments' );
			$DepartmentsController = new DepartmentsController ();
			$depts = $DepartmentsController->getChildren ( $department_id );
			$dept_count=count($depts);
				
			if($dept_count==1){
				$filer_dept_number=$depts[0]['dept_number'];//如果是查找一个班级的成绩，则将其作为过滤条件
				$parent_dept=$DepartmentsController->getparent($department_id);
				$parent_dept_id=$parent_dept['Department']['id'];
				// 				debug($parent_dept_id);
				$department_id=$parent_dept_id;
				$condition['conditions']['department_id']=$department_id;
			}
			/*	$deptdata = array ();
			 foreach ( $depts as $dept ) {
			 $deptdata [] = $dept ['dept_number'];
			 }
			 	
			 $logdept = array ();
			 // debug(count($deptdata));
			 for($i = 0; $i < count ( $deptdata ); $i ++) {
			 $logdept [] = array (
			 'logdept like' => $deptdata [$i] . '%'
			 );
			 }
			 if (count ( $depts ) == 0) {
			 $deptdata = $dept_number;
			 $logdept = array (
			 'logdept like' => $deptdata . '%'
			 );
			 }
			 // 			debug($deptdata);
			 $conditions = array (
			 'Score.dept_number' => $deptdata,
			 	
			 );endif*/
		}
		
		/* 根据条件查找课程计划 */
		
		App::import ( 'Model', 'Courseplan' );
		
		$Courseplan=new Courseplan();
// 						
		$Courseplan->unbindModel(array(
				'belongsTo'=> array('Semester','User'/* ,'Course' */,'Department')
		));
		
		
		$condition['order']='CoursePlan.course_id';
		$courseplans=$Courseplan->find('all',$condition);
// 						debug($courseplans);
		if(count($courseplans)!=0){
			$courses=array(); //多个课程计划中的学科目录
		
			
			foreach ($courseplans as $idx=>$courseplan){
				$courseplan_id[]=$courseplan['CoursePlan']['id'];
				$courses[$idx]['course_id']=$courseplan['Course']['id'];
				$courses[$idx]['course_name']=$courseplan['Course']['course_name'];
			}
			//debug($courses); //多个课程计划中的学科目录
		}else{
			$courseplan_id=null;
		}
		
		
		$this->Paginator->settings = array(
				'conditions'=>array('course_plan_id'=>$courseplan_id)
		);
		if(isset($filer_dept_number)){
			$this->Paginator->settings ['conditions']['Score.dept_number']=$filer_dept_number;
		}
		
		// debug($page= $this->request);

// 		debug($this->Score->find('all'));
		$page = $this->request->query ['page'];
		$limit = $this->request->query ['limit'];
		$this->Paginator->settings ['page'] = $page;
		$this->Paginator->settings ['limit'] = $limit;
		$this->Paginator->settings ['group'] = 'Score.stu_number';
		$this->Score->recursive = 0;
		$tmp_scores=$this->Paginator->paginate ();
// 		$scores=$tmp_scores;
// 		debug($tmp_scores);
// 		debug($this->Paginator->settings);
		
		$condition=array(
				'conditions'=>array(
					'course_plan_id'=>$courseplan_id)
		
				
		);
// 		$score_datas=$this->Score->find('all',$condition);
// 		debug($score_datas);
		
	if(isset($filer_dept_number)) 
			$condition['conditions']['Score.dept_number']=$filer_dept_number;
// 		$condition['group']='Score.stu_number';
// 		debug($condition);
		$condition['order']='CoursePlan.course_id';
		$student_datas=$this->Score->find('all',$condition);
// 		debug($student_datas);

		$new_scores=array();
		foreach ($tmp_scores as $idx=>$tmp_score){
			$stu_number=$tmp_score['Score']['stu_number'];
			$dept_number=$tmp_score['Score']['dept_number'];
			$new_scores[$idx]['stu_number']=$stu_number;
			$new_scores[$idx]['Student']=$tmp_score['Student'];
			$new_scores[$idx]['dept_number']=$dept_number;
			$key=0;
			foreach ($student_datas as $student_data){
				if($student_data['Score']['stu_number']==$stu_number){
					$new_scores[$idx]['Scores'][$key]['CoursePlan']=$student_data['CoursePlan'];
					$new_scores[$idx]['Scores'][$key]['Score']=$student_data['Score'];
					$key++;
				}
				
			}
			
		}
// 		debug($new_scores);
// 		$tmp_new_scores=array();
// 		foreach ($tmp_scores as $idx=>$tmp_score){
// 			$stu_number=$tmp_score['Score']['stu_number'];
// 				foreach ($score_datas as $idx=>$score_data){
// 				if($score_data['Score']['stu_number']==$stu_number){
// 					$course_id=$score_data['CoursePlan']['course_id'];
// 					$semester_id=$score_data['CoursePlan']['semester_id'];
// 					$tmp_scores[$idx]['other'][$semester_id][$course_id]=$score_data['Score'];
// // 					$scores[$idx]['score'][$course]=$score_datas['Score'];
					
					
						
						
// // 						$stu_number=;
						
// 							}
// 			}
// 			$students[$stu_number][$course]=;
// 		}
// 		debug($tmp_scores);
// 		debug($tmp_new_scores);
// 		debug($students);
/* 		if(isset($courses)){
					foreach ($courses as $id=>$course){
						debug($course);
			
		} 
		
		}*/
// 		debug($courseplans);
		$this->set ( 'scores',$new_scores  );
		$result ['success'] = true;
		$this->set ( compact ( 'result','courseplans','exam_name' ) );

	}
	
	/* 
	 * 查询学科成绩 
	 * 
	 * */
	
	public function getSubjectScoreList($department_id=null,$semester_id=null,$course_id=null,$exam_name=null){
		$this->layout = 'ajax';
		
		$limit = 5;
		$page = 2;
		$condition=array();
		if(isset($this->request->query ['department_id']) && !(($this->request->query ['department_id']=='')))
		{
			$department_id = $this->request->query ['department_id'];
			$condition['conditions']['department_id']=$department_id;
				
				
				
		}
		if(isset($this->request->query ['course_id']) && !($this->request->query ['course_id']=='')){
			($course_id = $this->request->query ['course_id']);
			$condition['conditions']['course_id']=$course_id;
		}
		if(isset($this->request->query ['semester_id'])&& !($this->request->query ['semester_id']=='')){
			($semester_id = $this->request->query ['semester_id']);
			$condition['conditions']['semester_id']=$semester_id;
				
				
		}
		if(isset($this->request->query ['exam_name'])&& !($this->request->query ['exam_name']=='')){
			($exam_name = $this->request->query ['exam_name']);
		}
		$condition['conditions']['CoursePlan.score_type']=1;//只找分数类型的
		// 		debug($condition);
		if ($department_id == 0) {
			$condition = array (
					1 => 1
			);
			// $dept_number='';
		} else {
		
			$conditon = array (
					'$department_id' => $department_id
			);
			App::import ( 'Controller', 'Departments' );
			$DepartmentsController = new DepartmentsController ();
			$depts = $DepartmentsController->getChildren ( $department_id );
			$dept_count=count($depts);
		
			if($dept_count==1){
				$filer_dept_number=$depts[0]['dept_number'];//如果是查找一个班级的成绩，则将其作为过滤条件
				$parent_dept=$DepartmentsController->getparent($department_id);
				$parent_dept_id=$parent_dept['Department']['id'];
				// 				debug($parent_dept_id);
				$department_id=$parent_dept_id;
				$condition['conditions']['department_id']=$department_id;
			}
			/*	$deptdata = array ();
			 foreach ( $depts as $dept ) {
			 $deptdata [] = $dept ['dept_number'];
			 }
					
			 $logdept = array ();
			 // debug(count($deptdata));
			 for($i = 0; $i < count ( $deptdata ); $i ++) {
			 $logdept [] = array (
			 'logdept like' => $deptdata [$i] . '%'
			 );
			 }
			 if (count ( $depts ) == 0) {
			 $deptdata = $dept_number;
			 $logdept = array (
			 'logdept like' => $deptdata . '%'
			 );
			 }
			 // 			debug($deptdata);
			 $conditions = array (
			 'Score.dept_number' => $deptdata,
					
			 );endif*/
		}
		
		/* 根据条件查找课程计划 */
		
		App::import ( 'Model', 'Courseplan' );
		
		$Courseplan=new Courseplan();
		//
		$Courseplan->unbindModel(array(
				'belongsTo'=> array('Semester','User'/* ,'Course' */,'Department')
				));
		
		
				$condition['order']='CoursePlan.course_id';
		$courseplans=$Courseplan->find('all',$condition);
				// 						debug($courseplans);
				if(count($courseplans)!=0){
				$courses=array(); //多个课程计划中的学科目录
		
					
				foreach ($courseplans as $idx=>$courseplan){
				$courseplan_id[]=$courseplan['CoursePlan']['id'];
						$courses[$idx]['course_id']=$courseplan['Course']['id'];
								$courses[$idx]['course_name']=$courseplan['Course']['course_name'];
			}
										//debug($courses); //多个课程计划中的学科目录
				}else{
				$courseplan_id=null;
				}
		
		
				$this->Paginator->settings = array(
						'conditions'=>array('course_plan_id'=>$courseplan_id)
						);
						if(isset($filer_dept_number)){
						$this->Paginator->settings ['conditions']['Score.dept_number']=$filer_dept_number;
				}
		
				// debug($page= $this->request);
		
				// 		debug($this->Score->find('all'));
				$page = $this->request->query ['page'];
		$limit = $this->request->query ['limit'];
		$this->Paginator->settings ['page'] = $page;
						$this->Paginator->settings ['limit'] = $limit;
						$this->Paginator->settings ['group'] = 'Score.stu_number';
						$this->Score->recursive = 0;
						$scores=$this->Paginator->paginate ();
		
// 		debug($this->request);
		$this->set ( 'scores',$scores  );
		$result ['success'] = true;
		$this->set ( compact ( 'result','courseplans','exam_name' ) );
	}
	
	
	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function view($id = null) {
		if (! $this->Score->exists ( $id )) {
			throw new NotFoundException ( __ ( 'Invalid score' ) );
		}
		$options = array (
				'conditions' => array (
						'Score.' . $this->Score->primaryKey => $id 
				) 
		);
		$this->set ( 'score', $this->Score->find ( 'first', $options ) );
	}
	
	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$courses = $this->Score->Course->find ( 'list' );
		if ($this->request->is ( 'post' )) {
			$this->Score->create ();
			
			if ($this->Score->save ( $this->request->data )) {
				$this->Session->setFlash ( __ ( 'The score has been saved.' ) );
				return $this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'The score could not be saved. Please, try again.' ) );
			}
		}
		$this->set ( 'courses', $courses );
	}
	
	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function edit($id = null) {
		if (! $this->Score->exists ( $id )) {
			if (! $this->request->is ( array (
					'post',
					'put' 
			) )) {
				throw new NotFoundException ( __ ( 'Invalid score' ) );
			}
		}
		if ($this->request->is ( array (
				'post',
				'put' 
		) )) {
			if ($this->request->data == NULL) {
				$this->layout = 'ajax';
				$string = file_get_contents ( "php://input" );
				$scores = json_decode ( $string );
				$result ['success'] = false;
				if ($this->Score->save ( $scores ) || $this->Score->saveAll ( $scores )) {
					$result ['success'] = true;
					$this->set ( 'result', $result );
				}
			} else {
				if ($this->Score->save ( $this->request->data )) {
					$this->Session->setFlash ( __ ( 'The score has been saved.' ) );
					return $this->redirect ( array (
							'action' => 'index' 
					) );
				} else {
					$this->Session->setFlash ( __ ( 'The score could not be saved. Please, try again.' ) );
				}
			}
		} else {
			$options = array (
					'conditions' => array (
							'Score.' . $this->Score->primaryKey => $id 
					) 
			);
			$this->request->data = $this->Score->find ( 'first', $options );
		}
	}
	
	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id        	
	 * @return void
	 */
	public function delete($id = null) {
		$this->Score->id = $id;
		if (! $this->Score->exists ()) {
			throw new NotFoundException ( __ ( 'Invalid score' ) );
		}
		$this->request->onlyAllow ( 'post', 'delete' );
		if ($this->Score->delete ()) {
			$this->Session->setFlash ( __ ( 'The score has been deleted.' ) );
		} else {
			$this->Session->setFlash ( __ ( 'The score could not be deleted. Please, try again.' ) );
		}
		return $this->redirect ( array (
				'action' => 'index' 
		) );
	}
	// /查找学生的所有学习记录
	public function listResults() {
		$this->layout = 'ajax';
		if (isset ( $this->request->query ['stu_number'] )) {
			$stu_numbers = $this->request->query ['stu_number'];
		} else {
			// $stu_numbers='201420102';
			die ();
		}
		
		if (isset ( $stu_numbers )) {
			// App::import('Controller','Students');
			// $Student=new StudentsController();
			$scores = $this->Score->find ( 'all', array (
					'conditions' => array (
							'Score.stu_number' => $stu_numbers 
					)
					// 'stu_number'=>$Student->stuNumbers($stu_numbers)
					 
			) );
			
			$this->set ( 'scores', $scores );
		}
	}
	//
	
	/* 随机产生分数 */
	public function random() {
		$this->Score->updateAll ( array (
				'regular ' => 'ceiling(rand()*40+60)',
				'midterm ' => 'ceiling(rand()*60+40)',
				'final ' => 'ceiling(rand()*50+50)' 
		) );
	}
	/*
	 * 统计分数段
	 */
	public function stat_scores_section($department_id=38,$semester_id=1,$course_id=4,$exam_name='final') {
		$this->layout = 'ajax';
		
		/* 检查$department_id的子节点 */
		
		if ($department_id == 0) {
			$conditions = array (
					1 => 1 
			);
			// $dept_number='';
		} else {
			
			$conditon = array (
					'$department_id' => $department_id 
			);
			App::import ( 'Controller', 'Departments' );
			$DepartmentsController = new DepartmentsController ();
			$depts = $DepartmentsController->getChildren ( $department_id );
			$dept_count=count($depts);
			
			if($dept_count==1){
				$filer_dept_number=$depts[0]['dept_number'];//如果是查找一个班级的成绩，则将其作为过滤条件
				$parent_dept=$DepartmentsController->getparent($department_id);
				$parent_dept_id=$parent_dept['Department']['id'];
// 				debug($parent_dept_id);
				$department_id=$parent_dept_id;
			}
		/*	$deptdata = array ();
			foreach ( $depts as $dept ) {
				$deptdata [] = $dept ['dept_number'];
			}
			
			$logdept = array ();
			// debug(count($deptdata));
			for($i = 0; $i < count ( $deptdata ); $i ++) {
				$logdept [] = array (
						'logdept like' => $deptdata [$i] . '%' 
				);
			}
			if (count ( $depts ) == 0) {
				$deptdata = $dept_number;
				$logdept = array (
						'logdept like' => $deptdata . '%' 
				);
			}
// 			debug($deptdata);
			$conditions = array (
							'Score.dept_number' => $deptdata,
							
			);endif*/	
		}
	 	/* 根据$department_id,$semester_id,$course_id查找课程计划 $Courseplan*/
		
		App::import ( 'Model', 'Courseplan' );
		$condition=array(
				'conditions'=>array(
						'department_id'=>$department_id,
						'semester_id'=>	$semester_id,
						'course_id'=>$course_id
				)
		)
		;
		
		$Courseplan=new Courseplan();
// 				debug($condition);
		$Courseplan->unbindModel(array(
				'belongsTo'=> array('Semester','User','Course','Department')
		));
		
		$courseplan=$Courseplan->find('all',$condition);
// 				debug($courseplan);
	
		if($courseplan==array()){
			/* 结果为空，没有此项课程计划 */
			$full_score_sections=array();
			$departments=array();
			$maximum=0;
			
			
		}else{
			/* 	如果查到了$courseplan */
			$courseplan_id=$courseplan[0]['CoursePlan']['id'];
			// 		debug($courseplan_id);


			/* 查找所有的班级的分数段 */
			$condition = array (
					'fields' => array (
							'dept_number',
							'('.$exam_name.' div 10) AS section',
							'count(*) AS number'
					),
					'group' => array (
							'dept_number','section'
					) ,
					'conditions'=>array('course_plan_id'=>$courseplan_id),
					'order'=>array('dept_number DESC'),
			);
			 if(isset($filer_dept_number)){
			 	$condition['conditions']['Score.dept_number'] = $filer_dept_number;
			 }
			// 'conditions'=>array($conditions)
// 			debug($condition);
			$sections = $this->Score->find ( 'all', $condition );
// 					debug($sections);
			
			/* 查找所有的班级 */
			$condition = array (
					'fields' => array (
							'dept_number','count(*) as num_of_stu'
					),
					'group' => array (
							'dept_number'
					) ,
					'conditions'=>array('course_plan_id'=>$courseplan_id)
			);
			$this->Score->unbindModel(array(
				'belongsTo'=> array('Student')
		));
			
			if(isset($filer_dept_number)){
				$condition['conditions']['Score.dept_number'] = $filer_dept_number;
			}
			$departments = $this->Score->find ( 'all', $condition );
			// 		debug($departments);
			
			if(count($sections)==0)
			{
				$sections[0][0]=array(
						'section'=>0,
						'number'=>0
				);
			}
			$parts = 0;
			$score_sections = array ();
			//范围
			/* 获得最大值和分数段 */
			foreach ( $sections as $section ) {
// 				debug($section);
				if ($section [0] ['section'] > $parts)
					$parts = $section [0] ['section'];
				$range['section'][]=$section [0] ['section'];
				$range['number'][]=$section [0] ['number'];
			}
// 			debug($range);
			$part_down=min($range['section']);
			$maximum=max($range['number']);
			
			// die();
			// 		debug($parts);
			/* 		$j = 0;
			 for($i = 0; $i <= $parts; $i ++) {
			 $score_sections [$i] ['section']=$i*10;
			 if ($sections [$j] [0] ['section'] == $i) {
			 // debug($sections[$j][0]);
			
			 $score_sections [$i] ['number'] = $sections [$j] [0] ['number'];
			 $j ++;
			 } else {
			 $score_sections [$i] ['number'] = 0;
			 }
			 } */
			
			
			$length=count($sections);
			$dept=0;
			$part=0;
			
			foreach ( $sections as $section ) {
				$dept_number=$section['Score']['dept_number'];
				$section_number=$section[0]['section']*10;
					
				$number=$section[0]['number'];
				$score_sections[$section_number][$dept_number]=$number;
			}
			
			
// 					debug($score_sections);
			$full_score_sections=array();
			// 		$full_score_sections[0][0]=1;
			for($part=$part_down;$part<=$parts;$part++){
				foreach ($departments as $department){
					$tmp_part=$part*10;
					$dept_number=$department['Score']['dept_number'];
					$full_score_sections[$tmp_part][$dept_number]=0;
					// 				debug($score_sections[0][$department]);
					if(isset($score_sections[$part*10][$dept_number])){
						$full_score_sections[$part*10][$dept_number]=$score_sections[$part*10][$dept_number];
					}
					else{
						$full_score_sections[$part*10][$dept_number]='0';
					}
				}
					
			}
			// 		debug($full_score_sections);
		}
		
// 		die();
		$this->set ( 'scoreSections', $full_score_sections ); 
		$this->set('departments',$departments);
		$this->set('maximum',$maximum);
	}
}
// eof
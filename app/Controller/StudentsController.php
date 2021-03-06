	<?php
App::uses('AppController', 'Controller');
App::import('Vendor','excel_reader2');

/**
 * Students Controller
 *
 * @property Student $Student
 * @property PaginatorComponent $Paginator
 */
class StudentsController extends AppController {

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
	public function index() {
		$this->layout='ajax';

		$limit=5;
		$page=2;
		$dept_id=null;
// 		debug($page= $this->request);
		$page= $this->request->query['page'];
		$limit= $this->request->query['limit'];
		
		$this->Paginator->settings['page']=$page;
		$this->Paginator->settings['limit'] = $limit;
// 		$this->Paginator->settings =array('limit'=>$limit,'page'=>$page);
		if(isset($this->request->query['dept_number'])){
			
			$dept_number=$this->request->query['dept_number'];
			
			App::import('Model','Department');
			App::import('Controller','Departments');
			$Department = new Department();
			$dept_id=$Department->findByDept_number($dept_number)['Department']['id'];
			$DepartmentsController=new DepartmentsController();
			$depts=$DepartmentsController->getChildren($dept_id);
// 			debug($depts);
			$deptdata=array();
			foreach ($depts as $dept){
				$deptdata[]=$dept['dept_number'];
			}
			

			
			$logdept=array();
// 			debug(count($deptdata));
			for($i=0;$i<count($deptdata);$i++){
				$logdept[]=array('logdept like'=>$deptdata[$i].'%');
			}
			if(count($depts)==0){
				$deptdata=$dept_number;
				$logdept=array('logdept like'=>$deptdata.'%');
			}
// 			debug($deptdata);
			$conditions=array('or'=>array(
					'dept_number'=>$deptdata,
					
					'or'=>$logdept
			)
			
			);
// 			debug($conditions);
				$this->Paginator->settings=array(
				'conditions'=>$conditions
		);
		}

		if(isset($this->request->query['stu_name'])){
				
			$qurey=$this->request->query['stu_name'];
			$conditions=array('or'=>array(
					'stu_name like'=>'%'.$qurey.'%',
					'stu_number like'=>$qurey.'%',
					'id_card_number like'=>$qurey.'%',
					'note like'=>'%'.$qurey.'%'
			)
						
			);
			$this->Paginator->settings=array(
					'conditions'=>$conditions
			);
		}

		$this->Paginator->settings['page']=$page;
		$this->Paginator->settings['limit'] = $limit;
		$this->Student->recursive = 0;

		$this->set('students', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Student->exists($id)) {
			throw new NotFoundException(__('Invalid student'));
		}
		$options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
		$result['success']=true;
		$result['student']=$this->Student->find('first', $options);
		$this->set('result',$result);
// 		$this->set('student', $this->Student->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout='ajax';
		$result['success']=false;
		if ($this->request->is('post')) {
		//debug($this->request);
		$string=file_get_contents("php://input");
		$students=json_decode($string);
		//debug($students) ;
		
		if ($this->Student->save($students)) {
			$result['success']=true;
		}
		
		$this->set('result',$result);
		/* 
			$this->Student->create();
			if ($this->Student->save($this->request->data)) {
				$this->Session->setFlash(__('The student has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.'));
			}
		 */}
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		
		if (!$this->Student->exists($id)) {
// 		throw new NotFoundException(__('Invalid student'));
			$this->layout='ajax';
			$result['success']=false;
		}
		if ($this->request->is(array('post', 'put'))) {
			$string=file_get_contents("php://input");
			$students=json_decode($string);
							
			if ($this->Student->save($students)) {
				$result['success']=true;
				$this->Session->setFlash(__('The student has been saved.'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The student could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
			$this->request->data = $this->Student->find('first', $options);
		}
		$this->set('result',$result);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->layout='ajax';
		$this->Student->id = $id;
		if (!$this->Student->exists()) {
			//throw new NotFoundException(__('Invalid student'));
			if ($this->request->is(array('post', 'put'))) {
				$string=file_get_contents("php://input");
				$students=json_decode($string);
				$this->Student->id=$students->id;
				
			}
		}
		$result['success']=false;
		
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Student->delete()) {
			//$this->Session->setFlash(__('The student has been deleted.'));
			$result['success']=true;
		} else {
			//$this->Session->setFlash(__('The student could not be deleted. Please, try again.'));
		}
		//return $this->redirect(array('action' => 'index'));
		$this->set('result',$result);
		
	}
	//stuNumbers 根据学号找出所有用过的学号
	public function stuNumbers($stu_number=null){
		
		$data=$this->Student->find('first',array(
		'conditions'=>array('or'=>array(
				'stu_number'=>$stu_number,	
				'note like'=>'%'.$stu_number.'%'
				)))
		);

		if($data==null){
// 			echo('无此人');
			return null;
		}else{
			$stu_number=$data['Student']['stu_number'];
			$note=$data['Student']['note'];
			$array=explode("&",$note);
			$count= count($array);
			$array[$count-1]=$stu_number;
// 			print_r ($array);
	// 		debug($note);
// 	 		die();	
			return $array;
		}
		
	}
	public function statNativePlace($deppartment_id=0){
		$this->layout='ajax';		
		if($deppartment_id==0){
			$conditions=array(1=>1);
// 			$dept_number='';
		}else{
			
			$conditon=array('$deppartment_id'=>$deppartment_id);
			App::import('Controller','Departments');
			$DepartmentsController=new DepartmentsController();
			$depts=$DepartmentsController->getChildren($deppartment_id);
			$deptdata=array();
			foreach ($depts as $dept){
				$deptdata[]=$dept['dept_number'];
			}
						
			$logdept=array();
			// 			debug(count($deptdata));
			for($i=0;$i<count($deptdata);$i++){
				$logdept[]=array('logdept like'=>$deptdata[$i].'%');
			}
			if(count($depts)==0){
				$deptdata=$dept_number;
				$logdept=array('logdept like'=>$deptdata.'%');
			}
			// 			debug($deptdata);
			$conditions=array('or'=>array(
					'dept_number'=>$deptdata,
						
					'or'=>$logdept
			));
			
		}

		
// 		debug($conditions);
		$condition=array(
				'fields'=>array(
// 						'native_place',
						'((CASE WHEN native_place not like \'%江苏省%\' THEN \'外省\'   
								WHEN native_place not like \'%南京市%\' THEN \'本省外市\'
								ELSE SUBSTRING(native_place,LOCATE(\'市\',native_place)+1) END)) AS region', 
						'count(native_place) AS number'),
// 				'group'=>array("native_place having native_place like '%南京市%'"),
				'group'=>array('region'),
// 				'order'=>array('number DESC'),
				'conditions'=>array($conditions)
		);
		$tmp_nativePlaces=$this->Student->find('all',$condition);
		$nativePlaces=array(
				'1'=>array(
						'region' => '玄武区',
						'number' =>0),
			'2'=>array(
						'region' => '秦淮区',
						'number' =>0),
			'3'=>array(
						'region' => '建邺区',
						'number' =>0),
			'4'=>array(
						'region' => '鼓楼区',
						'number' =>0),
			'5'=>array(
						'region' => '雨花台区',
						'number' =>0),
			'6'=>array(
						'region' => '栖霞区',
						'number' =>0),
			'7'=>array(
						'region' => '江宁区',
						'number' =>0),
			'8'=>array(
						'region' => '浦口区',
						'number' =>0),
			'9'=>array(
						'region' => '六合区',
						'number' =>0),
			'10'=>array(
						'region' => '溧水区',
						'number' =>0),
			'11'=>array(
						'region' => '高淳区',
						'number' =>0),
			'12'=>array(
						'region' => '本省外市',
						'number' =>0),
			'13'=>array(
					'region' => '外省',
					'number' =>0),
			'14'=>array(
					'region' => '其他',
					'number' =>0),
				
		);
		
// 		debug($tmp_nativePlaces);
		foreach($tmp_nativePlaces as $tmp_nativePlace){
			$regin=$tmp_nativePlace['0']['region'];
			$number=$tmp_nativePlace['0']['number'];
			switch ($regin){
				case '玄武区':
					$nativePlaces[1]['number']=$number;
					break;
				case '秦淮区':
					$nativePlaces[2]['number']+=$number;
				break;
				case '建邺区':
					$nativePlaces[3]['number']=$number;
					break;
				case '鼓楼区':
					$nativePlaces[4]['number']+=$number;
					break;
				case '雨花台区':
					$nativePlaces[5]['number']=$number;
					break;
				case '栖霞区':
					$nativePlaces[6]['number']=$number;
					break;
				case '江宁区':
					$nativePlaces[7]['number']=$number;
					break;
				case '浦口区':
					$nativePlaces[8]['number']=$number;
					break;
				case '六合区':
					$nativePlaces[9]['number']=$number;
					break;
				case '溧水区':
					$nativePlaces[10]['number']=$number;
					break;
				case '溧水县':
					$nativePlaces[10]['number']+=$number;
					break;
				case '高淳区':
					$nativePlaces[11]['number']+=$number;
					break;
				case '高淳县':
					$nativePlaces[11]['number']+=$number;
					break;
				case '本省外市':
					$nativePlaces[12]['number']=$number;
					break;
				case '外省':
					$nativePlaces[13]['number']=$number;
					break;
				case '白下区':
					$nativePlaces[2]['number']+=$number;
					break;
				case '下关区':
					$nativePlaces[4]['number']+=$number;
					break;
				default:
					$nativePlaces[14]['number']+=$number;
					break;
			}
		}
// 		die();
		$this->set('nativePlaces',$nativePlaces);
// 		debug($nativePlaces);
	}
	
	public function rm($name)
	
	{
		$temp_arr = explode(".", $name);
		$file_ext = array_pop($temp_arr);
		$file_ext = trim($file_ext);
		$file_ext = strtolower($file_ext);
		return strtotime("now").".".$file_ext;
	
	}
	
	public function showXls($file)
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
// 		$count=0;
		//for ($i = 2; $i <= 32; $i++) {
		for ($i = 2; $i <= $numRows; $i++) {
// 			echo '<tr>';
// 			$count++;
// 			echo '第'.$count.':次<br>';
			for ($j = 1;$j <= $numCols; $j++) {
				
// 				echo '<td>';
				switch($cols[$j]){
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
	
	public function import(){
// 		debug($_FILES);
// 		$this->layout='ajax';			


/* cakephp上传 */

// 		if($this->request->is('post')){
// 			if ($_FILES['data']['error']['document']['import'] > 0)
// 						{
// 							$error  = $_FILES['data']['error']['document']['import'];
// 							$response = array('success' => false, 'msg' => $error);
// 							echo json_encode($response);
// 						}
// 						else
			
			
// 							{
// 							$file_name = $_FILES['data']['name']['document']['import'];
// 							$file_type = $_FILES['data']['type']['document']['import'];
// 							$file_size = round($_FILES['data']['type']['document']['import'] / 1024, 2) . '  Kilo Bytes';
// 							$uploaddir = WWW_ROOT."uploads/";
// 							//debug(WWW_ROOT);
// 							/*取时间戳为文件名*/
// 							$name=basename($_FILES['data']['name']['document']['import']);
// 							$name=$this->rm($name);
// 							//debug($name);
// 							$uploadfile = $uploaddir.$name;
					
					
// 							// 			/*取原名为文件名*/
// 							//$uploadfile = $uploaddir . basename($_FILES['import']['name']);
					
// 							/* 如果上传文件名有乱码 */
// 							/* $uploadfile=iconv("utf-8","GBK", $uploadfile); */
					
					
// 							if (move_uploaded_file($_FILES['data']['tmp_name']['document']['import'], $uploadfile)) {
// 								echo "File is valid, and was successfully uploaded.\n";}
// 								//debug($uploadfile);
// 								$data=$this->showXls($uploadfile);
// 								// 			debug($data);
// 								$dataLength=count($data);
// 								if($this->Student->saveAll($data)){
// // 									echo 'ok';
// 									$success=true;

									
// 								}else {
// // 									echo 'no';
// 									$success=false;
// 								}
// 								$response = array('success' =>$success,
// 												'data' => array('name' => $file_name, 'size' => $file_size),
// 												'msg' => '上传成功并导入了'.$dataLength.'条记录'
// 												);
// 										echo json_encode($response);
// 								}
// 			}
			
		
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
					$data=$this->showXls($uploadfile);
					$dataLength=count($data);
					$ics=array();
					foreach($data as $stu){
						if(isset($stu['id_card_number']))
						$ics[]=$stu['id_card_number'];
					}
					//准备导入的数据
					$data_import=array();
					//统计其中更新的条数
					$updateLength=0;
// 					debug($data);
					if(count($ics)==0) {
					$sns=array();
// 					 echo "type:没有身份证";
					foreach($data as $stu){
						if(isset($stu['stu_number'])) $sns[]=$stu['stu_number'];
// 						debug($sns);
						//查询数据库中已经存在数据
						$data_exist=$this->Student->find('all',array(
								'conditions'=>array('stu_number'=>$sns),
								'fields'=>array('id','stu_number','dept_number','logdept')
									
						));}
						foreach ($data as $idx=>$stu){
							$sn=$stu['stu_number'];
							$dn=$stu['dept_number'];
							foreach ($data_exist as $key=>$stu_exist){
								if($stu_exist['Student']['stu_number']==$sn){
									$stu=array();
									$stu['id']=$stu_exist['Student']['id'];
// 									$stu['logdept']=$stu_exist['Student']['logdept'].$stu_exist['Student']['dept_number'].'&';
									$stu['dept_number']=$dn;
									$stu['regroup']=true;
									$data_import[]=$stu;
									$updateLength++;
									
								}
							}
						}
// 						debug($data_exist);
						
					
					
					
					}
					else{
						debug($ics);
						//查询数据库中已经存在数据
						$data_exist=$this->Student->find('all',array(
								'conditions'=>array('id_card_number'=>$ics),
								'fields'=>array('id','id_card_number','stu_number','dept_number','note','logdept')
									
						));
						// 					debug($data_exist);
						
						foreach($data as $idx=>$stu){
							if(isset($stu['id_card_number'])){
								$ic=$stu['id_card_number'];
								$stu_number=$stu['stu_number'];
								$dept_number=$stu['dept_number'];
						
								foreach ($data_exist as $key=>$stu_exist){
									// 							判读是否是相同身份证号码
									if($stu_exist['Student']['id_card_number']==$ic){
										// 								如果学号相同，则是更新信息
										if($stu_number==$stu_exist['Student']['stu_number'])
										{
											$stu['id']=$stu_exist['Student']['id'];
										}
										else{
											// 									导入的是数据库中信息之后的信息，则更新，且记录学号、班级信息。
						
											if($stu_number>$stu_exist['Student']['stu_number']){
												// echo '之后';
												$stu['id']=$stu_exist['Student']['id'];
												$stu['note']=$stu_exist['Student']['note'].$stu_exist['Student']['stu_number']."&";
												$stu['logdept']=$stu_exist['Student']['logdept'].$stu_exist['Student']['dept_number']."&";
						
											}else{
												// 										echo '之前';
												// 										如果导入的时数据库中信息之前的信息，则只记录学号、班级信息
												$stu=array();
												$stu['id']=$stu_exist['Student']['id'];
												$stu['note']=$stu_exist['Student']['note'].$stu_number."&";
// 												$stu['logdept']=$stu_exist['Student']['logdept'].$dept_number."&";
												
													
						
											}
										}
										$updateLength++;
									}
						
										
								}
							}
							$data_import[]=$stu;
						}
						// 					
					} 
// 					debug($data_import);
					
				if($this->Student->saveAll($data_import)){
// 						echo 'ok';
						$success=true;

									
				}else {
// 					echo 'no';
					$success=false;
				}
				$response = array('success' =>true,
									'data' => array('name' => $file_name, 'size' => $file_size),
									'msg' => '上传成功并导入了'.$dataLength.'条记录，其中更新了'.$updateLength.'条记录.'
									);
				echo json_encode($response);
				}
			}
		}
		
		die();
	}
	
	
	public function outputExcel(){

		//设置PHPExcel类库的include path
		App::import('Vendor', 'Classes/PHPExcel');
		
		// 创建一个处理对象实例
		$objExcel = new PHPExcel();
		
		// 创建文件格式写入对象实例, uncomment
		$objWriter = new PHPExcel_Writer_Excel5($objExcel);     // 用于其他版本格式
		//or
		//$objWriter = new PHPExcel_Writer_Excel2007($objExcel); // 用于 2007 格式
		//$objWriter->setOffice2003Compatibility(true);
		
		
		//设置文档基本属性
		$objProps = $objExcel->getProperties();
		$objProps->setCreator("Zeal Li");
		$objProps->setLastModifiedBy("Zeal Li");
		$objProps->setTitle("Office XLS Test Document");
		$objProps->setSubject("Office XLS Test Document, Demo");
		$objProps->setDescription("Test document, generated by PHPExcel.");
		$objProps->setKeywords("office excel PHPExcel");
		$objProps->setCategory("Test");
		//设置当前的sheet索引，用于后续的内容操作。
		//一般只有在使用多个sheet的时候才需要显示调用。
		//缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet();
		
		//设置当前活动sheet的名称
		$objActSheet->setTitle('测试Sheet');
		
		//设置单元格内容 由PHPExcel根据传入内容自动判断单元格内容类型
		$objActSheet->setCellValue('A1', '字符串内容'); // 字符串内容
		$objActSheet->setCellValue('A2', 26);            // 数值
		$objActSheet->setCellValue('A3', true);          // 布尔值
		$objActSheet->setCellValue('A4', '=SUM(A2:A2)'); // 公式
		
		//显式指定内容类型
		$objActSheet->setCellValueExplicit('A5','8757584',PHPExcel_Cell_DataType::TYPE_STRING);
		
		//合并单元格
		$objActSheet->mergeCells('B1:C22');
		
		//分离单元格
		$objActSheet->unmergeCells('B1:C22');
		//设置宽度
		$objActSheet->getColumnDimension('B')->setAutoSize(true);
		$objActSheet->getColumnDimension('A')->setWidth(30);
		 
		//设置单元格内容的数字格式。
		//如果使用了 PHPExcel_Writer_Excel5 来生成内容的话，
		//这里需要注意，在 PHPExcel_Style_NumberFormat 类的 const 变量定义的
		//各种自定义格式化方式中，其它类型都可以正常使用，但当setFormatCode
		//为 FORMAT_NUMBER 的时候，实际出来的效果被没有把格式设置为"0"。需要
		//修改 PHPExcel_Writer_Excel5_Format 类源代码中的 getXf($style) 方法，
		//在 if ($this->_BIFF_version == 0x0500) { （第363行附近）前面增加一
		//行代码:
		//if($ifmt === '0') $ifmt = 1;
		
		//设置格式为PHPExcel_Style_NumberFormat::FORMAT_NUMBER，避免某些大数字
		//被使用科学记数方式显示，配合下面的 setAutoSize 方法可以让每一行的内容
		//都按原始内容全部显示出来。
		$objStyleA5 = $objActSheet ->getStyle('A5');
		$objStyleA5 ->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
		
		//设置字体
		$objFontA5 = $objStyleA5->getFont();
		$objFontA5->setName('Courier New');
		$objFontA5->setSize(10);
		$objFontA5->setBold(true);
		$objFontA5->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objFontA5 ->getColor()->setARGB('FFFF0000') ;
		$objFontA5 ->getColor()->setARGB( PHPExcel_Style_Color::COLOR_WHITE);
		// $ objFontA5 ->getFont()->setColor(PHPExcel_Style_Color::COLOR_RED);
		
		//设置对齐方式
		$objAlignA5 = $objStyleA5->getAlignment();
		$objAlignA5->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objAlignA5->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		//设置边框
		$objBorderA5 = $objStyleA5->getBorders();
		$objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorderA5->getTop()->getColor()->setARGB('FFFF0000') ; // 边框color
		$objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorderA5->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorderA5->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		
		//设置CELL填充颜色
		$objFillA5 = $objStyleA5->getFill();
		$objFillA5->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objFillA5->getStartColor()->setARGB('FFEEEEEE');
		
		//从指定的单元格复制样式信息.
		$objActSheet->duplicateStyle($objStyleA5, 'B1:C22');
		
		//添加图片
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('ZealImg');
		$objDrawing->setDescription('Image inserted by Zeal');
		$objDrawing->setPath('./zeali.net.logo.gif');
		$objDrawing->setHeight(36);
		$objDrawing->setCoordinates('C23');
		$objDrawing->setOffsetX(10);
		$objDrawing->setRotation(15);
		$objDrawing->getShadow()->setVisible(true);
		$objDrawing->getShadow()->setDirection(36);
		$objDrawing->setWorksheet($objActSheet);
		
		//添加一个新的worksheet
		$objExcel->createSheet();
		$objExcel->getSheet(1)->setTitle('测试2');
		
		//保护单元格
		$objExcel->getSheet(1)->getProtection()->setSheet(true);
		$objExcel->getSheet(1)->protectCells('A1:C22', 'PHPExcel');
		
		//显示网格线:
		$objPHPExcel->getActiveSheet()->setShowGridlines(true);
		
		//显示隐藏列
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setVisible(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setVisible(false);
		
		//显示隐藏行
		$objPHPExcel->getActiveSheet()->getRowDimension('10')->setVisible(false);
		//默认列宽
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);
		//默认行宽
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
		//worksheet 默认style 设置 (和默认不同的需单独设置)
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment();
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//输出内容
		$outputFileName = "output.xls";
		//到文件
		////$objWriter->save($outputFileName);
		//or
		//到浏览器
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header('Content-Disposition:inline;filename="'.$outputFileName.'"');
		header("Content-Transfer-Encoding: binary");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Pragma: no-cache");
		$objWriter->save('php://output');
		
	}
	}//eof sutdentsController
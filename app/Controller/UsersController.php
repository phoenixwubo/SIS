
<?php
App::uses('AppController', 'Controller');
App::import('vendor', 'JSON');
App::import('Vendor','excel_reader2');

//AuthComponent::user('id');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {


	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('add'); // 允许注册

	}

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	public $paginate = array();

	/**
	 * index method
	 *
	 * @return void
	 */

	public function index() {
		$this->layout='ajax';
			//$users=$this->User->find('all');
			//debug($users);
		//$this->set('users',$users);
			//服务器端分页
			$limit=5;
			$page=2;
			//$this->User->recursive = 0;
			$this->paginate =array('limit'=>$limit,'page'=>$page);
			$this->set('users', $this->paginate());/*	*/
			
		//$this->set('users', $this->Paginator->paginate());

			
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
		/*
		$options=array('conditions'=>array('Student.dept_id='.$id));
		$this->set('students',$this->Department->Student->find('all',($options)));*/
		$options=array('conditions'=>array('Profile.user_id='.$id));
		//debug($options);
		debug($this->User->Profile->find('all',($options)));
		//$this->set('profile',$this->User->Profile->find('all',($options)));
		$options=array('conditions'=>array('Student.user_id='.$id));
		//debug($options);
		debug($this->User->Student->find('all',($options)));
		
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$this->layout='ajax';
		$reuslt['success']=false;
		if ($this->request->is('post')) {
			$this->User->create();
			//debug($this->request->data);
			if(($this->request->data)==NULL){
				//echo('不是通过post传递');
				$string=file_get_contents("php://input");
				$users=json_decode($string);
				//print_r($users) ;
				
				if ($this->User->save($users)) {
					$result['success']=true;
				}
				
				$this->set('result',$result);
			}else
			{
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved.'));
					//return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
		}
		else{

		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			//throw new NotFoundException(__('Invalid user'));
			$string=file_get_contents("php://input");
			$users=json_decode($string);
			//print_r($users) ;
		}else{
			echo ("Edit");
		}
		if ($users==null){

		}
		//可能保存成功，也肯能一次没有成功，存在脏数据
		$data=array();
		if(is_array($users)){
			$len=count($users);
			$data=$users;

		}
		else{
			$len=1;
			$data[0]=$users;

		}

		if ($this->User->saveAll($data)){



			echo("{success:true,data:'成功保存{$len}条记录'}");

		}else{
			echo("{success:false,data:'保存失败'}");
		}
			

		/*
			if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
			$this->Session->setFlash(__('The user has been saved.'));
			return $this->redirect(array('action' => 'index'));
			} else {
			$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
			} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
			}/**///*/
		$this->layout='ajax';
			
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
		$this->User->id = $id;
		$result['success']=false;
		if (!$this->User->exists()) {
			
			//echo ('用户'.$id.'不存在');
			//return false;
			if ($this->request->is(array('post', 'put'))) {
				$string=file_get_contents("php://input");
				$users=json_decode($string);
				$this->User->id=$users->id;
				//debug($users->id);
			
			}
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete($id,true)) {
			//$this->Session->setFlash(__('The user has been deleted.'));
			//return true;
			//echo('删除成功');
			$result['success']=true;
		} else {
			//$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
			//echo('删除失败');
			//return false;
		}
		$this->set('result',$result);
		//return $this->redirect(array('action' => 'index'));
	}
	public function getGraph(){
		$this->layout='ajax';
		$records = array('spring' =>20 ,'summer'=>30,'autumn'=>80,'winter'=>10);
		$records['year']=100;
		$this->set('records',$records);
	}


	public function showXls($file)
	{

			
		$this->loadModel('Department');//从Department表中查询dept_id
		//$dept=$this->Department->findByDept_name('2014级高中1班');
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('utf-8');
		$data->read($file);
		//print_r($data);//输出excel数据
		error_reporting(E_ALL ^ E_NOTICE);
		$arr = array();
		$cols=array();
		echo '共计列数：';
		echo $data->sheets[0]['numCols'];//输出列
		for($c=1;$c<=$data->sheets[0]['numCols'];$c++){
			switch($data->sheets[0]['cells'][1][$c])
			{
				case "姓名":
					$cols[$c]="fullname";
					break;
				case "性别":
					$cols[$c]="gender";
					break;
				case "出生日期":
					$cols[$c]="DOB";
					break;
				case "证件号":
					$cols[$c]="id_number";
					break;
				case "学号":
					$cols[$c]="stu_number";
					break;
				case "班级名称";
					$cols[$c]="dept_id";
					break;
				default:
					$cols[$c]=$data->sheets[0]['cells'][1][$c];

			}
			//$cols[$c]=$data->sheets[0]['cells'][1][$c];
		}
		//print_r($cols);


		//echo '<table>';

		//测试导入3行
		$count=0;
		//for ($i = 2; $i <= 32; $i++) {
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
			//echo '<tr>';
			$count++;
			//echo $count+':';
			for ($j = 1;$j <= $data->sheets[0]['numCols']; $j++) {
				//echo '<td>';
				switch($cols[$j]){
					case "gender":
						switch($data->sheets[0]['cells'][$i][$j]){
						case "男":
							$arr[$i]['User'][$cols[$j]]=1;
							break;
						case "女":
							$arr[$i]['User'][$cols[$j]]=2;
							break;
						default:
							$arr[$i]['User'][$cols[$j]]="1";

					}
					break;
					
					case "id_number":
						$arr[$i]['Profile'][$cols[$j]]=$data->sheets[0]['cells'][$i][$j];
						break;
					case "stu_number":
						$arr[$i]['Student'][0][$cols[$j]]=$data->sheets[0]['cells'][$i][$j];
						break;
					case "dept_id":
						$dept=$this->Department->findByDept_name($data->sheets[0]['cells'][$i][$j]);
						$dept_id=$dept['Department']['id'];
						$arr[$i]['Student'][0][$cols[$j]]=$dept_id;
					case "DOB":
						$arr[$i]['Profile'][$cols[$j]]=$data->sheets[0]['cells'][$i][$j];
						break;
					default:
						if($data->sheets[0]['cells'][$i][$j]==NULL)
						{echo "空";}
						$arr[$i]['User'][$cols[$j]] =$data->sheets[0]['cells'][$i][$j];
				}
				
				//if($cols[$j]=="gender"){
					//print_r('处理性别！');
					
				//}
/*				else{
					if($cols[$j]=="id_number"){
						$arr[$i]['Profile'][$cols[$j]]=$data->sheets[0]['cells'][$i][$j];
						
						
					}
					else{
						if($data->sheets[0]['cells'][$i][$j]==NULL)
						{echo "空";}
						$arr[$i]['User'][$cols[$j]] =$data->sheets[0]['cells'][$i][$j];
					}
					//print_r('不是处理性别！');
					
				}*/
				//echo $data->sheets[0]['cells'][$i][$j];
				//echo $arr[$i][$cols[$j]];
				//echo "</td>";
			}
			//echo "</tr>";
			//echo "<br>";

		}
		//echo '</table>';
		return $arr;
	}
	// import method
	// 导入基本信息

	/*由时间戳重命名时间*/
	public function rm($name)

	{
		$temp_arr = explode(".", $name);
		$file_ext = array_pop($temp_arr);
		$file_ext = trim($file_ext);
		$file_ext = strtolower($file_ext);
		return strtotime("now").".".$file_ext;

	}
	public function import($dept_id=null){
		echo json_encode($_FILES);
		$this->layout='ajax';
		//debug($_FILES);


		//print_r($data);//输出excel数据

// 		if($this->request->is('post'))  {
// 			//debug($_FILES);
// 			$uploaddir = WWW_ROOT."uploads\\";
// 			/*取时间戳为文件名*/
// 			$name=basename($_FILES['data']['name']['Post']['doc_file']);
// 			debug($name);
// 			$name=$this->rm($name);
// 			debug($name);
// 			$uploadfile = $uploaddir.$name;


// 			/*取原名为文件名*/
// 			/*
// 			 $uploadfile = $uploaddir . basename($_FILES['data']['name']['Post']['doc_file']);
// 			 $uploadfile=iconv("utf-8","GBK", $uploadfile);*/

// 			debug($uploadfile);
// 			if (move_uploaded_file($_FILES['data']['tmp_name']['Post']['doc_file'], $uploadfile)) {
// 				echo "File is valid, and was successfully uploaded.\n";
// 				$import_data = $this->showXls($uploadfile);//将excel文件中的数据转换到数组中
// 				print_r ($import_data);

// 				/*将数组中的数据保存到数据库中*/
// 			if ($this->User->saveAll($import_data, array('deep' => true))) {
// 				$this->Session->setFlash(__('信息导入成功'));
// 				//$this->redirect(array('action' => 'index'));
// 			} else {
// 				$this->Session->setFlash(__('信息导入失败，请重试。'));
// 			}


// 			} else {

// 				echo "Possible file upload attack!\n";
// 			}
// 		}



	}

	public function listUser() {
		$this->layout='ajax';
		$limit=30;
		$page=0;
		$page= $this->request->query['page'];
		$limit= $this->request->query['limit'];
		// 		 $this->paginate=array('limit'=>$limit,'page'=>$page);
		// 		 $this->set('users', $this->paginate());
			
		$this->Paginator->settings['page']=$page;
		$this->Paginator->settings['limit'] = $limit;

		$this->set('users', $this->Paginator->paginate());
			
			
	}


	public function login() {
		$this->layout='ajax';
		/*先注销以*/

	
		//$this->Auth->logout();
		$result=array();

		if ($this->request->is('post')) {
			/*检查提交数据 格式
			 * 如果是User[]的格式，则是从Form提交，按照if ($this->Auth->login())处理 
			 * 否则是Extjs提交，用if($this->Auth->login($tmpUser))处理 
			 * http://stackoverflow.com/questions/11512651/cakephp-authcomponent-login-using-ajax-without-form*/
			//debug($this->request->data);
				
			if(!isset($this->request->data['User'])){
				/*提交方式extjs还是 form
				 * 将$this->request->data结构进行修改*/
				//echo('extjs');
				$tmpUser['User']['username'] = $this->request->data['username'];
				$tmpUser['User']['password'] = $this->request->data['password'];
				$this->request->data=array();
				$this->request->data=$tmpUser;
				//debug($this->request->data);
				if($this->Auth->login())
				{
						//debug($tmpUser);
						//输出ID
						//$id = $this->Auth->user('id');
					//echo($id);
					//return $this->redirect($this->Auth->redirect());

					$result['success']=true;
					$result['msg']='User Authenticated';
				}else{
					$this->Session->setFlash(__('Invalid username or password, try again'));
						
					$result['success']=false;
					$result['msg']='Incorrect user or password';}
			}


			else {
				/*提交方式extjs还是 form*/
				//echo('cakephp');

				if ($this->Auth->login()) {
					//return $this->redirect($this->Auth->redirect());
					
					$id = $this->Auth->user('id');
					echo($id);
					$result['success']=true;
					$result['msg']='User Authenticated';
				}else{
					$this->Session->setFlash(__('Invalid username or password, try again'));
						
					$result['success']=false;
					$result['msg']='Incorrect user or password';}
			}
			//if($this->request->)

				

			$this->set('result',$result);
		}
	}

	/*	public function login(){
		$this->layout='ajax';
		if($this->request->is('post')){
		$result=array();
		if($this->Auth->login()){
		return $this->redirect($this->Auth->redirect());
		$result['success']=true;
		$result['msg']='User Authenticated';

		}
		$this->Session->setFlash(_('Invalid username or password,try again'));
		$result['success']=false;
		$result['msg']='Incorrect user or password';
			
		$this->set('result',$result);
			
			
		}

		}*/

	public function logout() {
		$this->layout='ajax';
		$this->Auth->logout();
		$result['success']=true;
		$this->set('result',$result);
	}
	
	function loggedIn(){
		$this->layout='ajax';

		$result['success']=false;
		$result['user']=null;
		if (!$this->Auth->loggedIn()) {

			//$this->Session->setFlash('请登录 ');
		}
		else
		///$this->Session->setFlash('登录成功 ');
		$result['success']=true;
		$result['user']=$this->Auth->user('username');//获取登录用户名
		$this->set('result',$result);
		//

	}
	//测试插入关联数据
	function testHasMany(){
		$this->loadModel('Department');
		 $this->User->create();
		 /*$data=array(
			'User'=>array(
				'username'=>'wubo',
				'password'=>'123456',
				'fullname'=>'吴波',
				'gender'=>'1',
				'DOB'=>'1982-01-27'
				)
		);
		$this->User->save($data);*/
		 $dept=$this->Department->findByDept_name('2014级高中1班');
		 debug ($dept['Department']['id']);
		$data=array(
			'User'=>array(
				'username'=>'wubo1',
				'password'=>'123456',
				'fullname'=>'吴波',
				'gender'=>'1',
				'DOB'=>'1982-01-27'
				),
			'Profile'=>array(
				'id_number'=>'320902198201272014',
				'native'=>'盐城'
				),
			'Student' => array(
				array(
				'stu_number' => '201420101',
				'dept_id'=>$dept['Department']['id']
				)
				
			)
		);
		print_r( $data);
		//$this->User->saveAssociated($data, array('deep' => true));
	}
	
		public function clearNotUnique(){
			//获取身份证号码相同的信息的证件号码  	
			//$this->layout='ajax';
			
			$params=array(
					'fields' => array('id','fullname','profile.id_number','COUNT(id_number) as idnum_count'),
					'group'=>array('id_number HAVING idnum_count >1'),
				);
			$unUniqueList=$this->User->find('all',$params);

			//将存在身份证号码相同的记录的信息查询出来
			$id_numbers=array();
			foreach($unUniqueList as $unUniqueUser ){
					$id_numbers[]=$unUniqueUser['Profile']['id_number'];
				//print($unUniqueUser['Profile']['id_number'].' '.$unUniqueUser['User']['fullname'].'<br>');
			}
			//debug($id_numbers);
	$params=array(
					'fields' => array('id','fullname','profile.id_number','created'),
					'conditions'=>array('profile.id_number'=>$id_numbers),
					'order'=>array ('profile.id_number'=> 'ASC',
									   'id'=>' ASC ')
											
				);
			$users=$this->User->find('all',$params);
			//debug($users);
					$user_id=null;
			$tmp_user_id=null;
			$temp_id_number=null;
			$fullname=null;
			$id_number=null;
			$stu=array();
			$this->loadModel('Student');
			
			//$user_id=3177;
			//if($this->delete($user_id));
			foreach($users as $user){
				$fullname=$user['User']['fullname'];
				$id_number=$user['Profile']['id_number'];
				$user_id=$user['User']['id'];
				print($user_id.' '.$fullname.' '.$id_number);
				if($id_number=='未提供'){
					echo('不处理'.'<br>');
				}
				else{
				if($id_number==$temp_id_number){
						echo('删除'.'<br>');
						$stu=$user['Student'][0];
						
						$stu['user_id']=$tmp_user_id;
						$this->Student->save($stu);
						$this->delete($user_id);
						debug($stu);
						
						
						//debug($stu);
					}else{
						echo('下一条 '.'<br>');
						$tmp_user_id=$user_id;
						$temp_id_number=$id_number;
					}
				}
			//	debug($user);
			//debug($user['Student'][0]);
			//print($user_id.' '.$fullname.' '.$id_number.'<br>');
					}
//			
//			$stu=array(
//				'id' => '2711',
//				'stu_number' => '201111037',
//				'user_id' => '306',
//				'dept_id' => '430',
//				'status_id' => '0'
//			);
//			
//			
//			$this->Student->save($stu);
//	/**/
			
		}
		public function jsonDecode(){
				$record=array(
						'Profile' => array(
							'id' => '1',
							'id_number' => '320121199901070712',
							'native' => '江苏南京',
							'DOB' => '1999-01-07'
						),
						'User' => array(
							'fullname' => '毕宇轩',
							'gender' => '1',
							'group_id' => '0',
						),
						'Student' => array(
							'stu_number' => '201111901',
							'dept_id' => '439',
							'status_id' => '0'
						)
							);
						$string=json_encode($record);
						debug($string);
		}
}
	



<?php
App::uses('AppController', 'Controller');
/**
 * Departments Controller
 *
 * @property Department $Department
 * @property PaginatorComponent $Paginator
 */
class DepartmentsController extends AppController {

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
		//$this->Department->recursive = 0;
		//$this->set('departments', $this->Paginator->paginate());
		$Departments=$this->Department->find('all');
		$this->layout='ajax';
	        /* $Departments = $this->Department->generateTreeList(
    		      null,
          			null,
         		 null,
          '~'
        ); */
	//debug($data); 
	$this->set(compact('Departments'));
// 	$parents = $this->Department->getPath(5);
// 	debug($parents);
	
	//die;
	}
	public function listDept() {
		//$this->Department->recursive = 0;
		//$this->set('departments', $this->Paginator->paginate());
		$this->layout='ajax';
		$Departments = $this->Department->generateTreeList(
				null,
				null,
				null,
				'-'
		);
		//debug($Departments);
		$this->set(compact('Departments'));
		
		// 	$parents = $this->Department->getPath(5);
		// 	debug($parents);
	
		//die;
	}
//树状列表降级	
public function movedown($id = null, $delta = null) {
    $this->Department->id = $id;
    if (!$this->Department->exists()) {
       throw new NotFoundException(__('Invalid Department'));
    }

    if ($delta > 0) {
        $this->Department->moveDown($this->Department->id, abs($delta));
    } else {
        $this->Session->setFlash(
          'Please provide the number of positions the field should be' .
          'moved down.'
        );
    }

    return $this->redirect(array('action' => 'index'));
}
//树状列表位置移动

public function moveup($id = null, $delta = null) {
	
	$this->Department->id = $id;
	if (!$this->Department->exists()) {
		throw new NotFoundException(__('Invalid Department'));
	}
	if ($delta > 0) {
		$this->Department->moveUp($this->Department->id, abs($delta));
	} else {
		$this->Session->setFlash(
			'Please provide a number of positions the Department should' .
			'be moved up.'
		);
	}
	return $this->redirect(array('action' => 'index'));
}
//节点变为根节点
public function remove($id = null, $delta = false) {
	$this->layout='ajax';
	$this->Department->id = $id;
	$result['success']=false;
	if (!$this->Department->exists()) {
		throw new NotFoundException(__('Invalid Department'));
	}else{
//	if ($delta > 0) {
		//$this->Department->removeFromTree($this->Department->id, abs($delta));
		//$delta true永久删除  false 转换为根的直接叶子节点
			$this->Department->removeFromTree($this->Department->id, $delta);
			$result['success']=true;
//	} else {
//		$this->Session->setFlash(
//			'Please provide a number of positions the Department should' .
//			'be moved up.'
//		);
//	}

	}
	//return $this->redirect(array('action' => 'index'));
			$this->set('result',$result);
}


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->layout='ajax';
		$resutl['success']=false;
		
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Invalid department'));
		}
		$resutl['success']=true;
		$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
		$this->set('department', $this->Department->find('first', $options));
		$this->set('result',$resutl);
		//$options=array('conditions'=>array('Student.dept_id='.$id));
		//$this->set('students',$this->Department->Student->find('all',($options)));
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
			
			$department=$this->request['data'];
			//debug($department) ;
		
			if ($this->Department->save($department)) {
				$result['success']=true;
			}
		
			$this->set('result',$result);
			}
		
		
		//$this->layout='default';
// 		if ($this->request->is('post')) {
// 			$this->Department->create();
			
// 			debug($this->request->data);
// 			if ($this->Department->save($this->request->data)) {
// 				$this->Session->setFlash(__('The department has been saved.'));
// 				//return $this->redirect(array('action' => 'index'));
// 			} else {
// 				$this->Session->setFlash(__('The department could not be saved. Please, try again.'));
// 			}
// 		}
// 		$parents = $this->Department->find('list',array('fields' => array('id','dept_name')));
// 		//$users = $this->Department->User->find('list');
		
// 		//$departments=$this->Department->find('all');
// 		$this->set(compact('parents', 'users','departments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout='ajax';
		$result['success']=false;
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Invalid department'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Department->save($this->request->data)) {
				$result['success']=true;
				//$this->Session->setFlash(__('The department has been saved.'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
			$this->request->data = $this->Department->find('first', $options);
		}
		//$parents = $this->Department->ParentDepartment->find('list');
		//$users = $this->Department->User->find('list');
		//$this->set(compact('parents', 'users'));
		$this->set(compact($result));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Department->id = $id;
		if (!$this->Department->exists()) {
			throw new NotFoundException(__('Invalid department'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Department->delete()) {
			$this->Session->setFlash(__('The department has been deleted.'));
		} else {
			$this->Session->setFlash(__('The department could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
/*
 * deptTree Method
 * 将department数组转化为树形结构，提供给Extjs的tree使用
 * */
	function getnodes(){
		//debug($this->request->query['node']);
		//了解request结构 
		$id=$this->request->query['node'];
		$this->layout='ajax';
		if($id=='root') $id=NULL;
		$parent=intval($id);
		//$parent=6;
		$nodes=$this->Department->children($parent,true);
		$this->set(compact('nodes'));
		
	}
	
	function getChildren($id){
		///debug($this->request->query['node']);
		//了解request结构
		 
		//$id=$this->request->query['node'];
		$this->layout='ajax';
		if($id=='root') $id=NUll;
		$parent=intval($id);
		//$parent=6;
		$nodes=$this->Department->children($parent,true);
// 		debug($nodes);
		if(count($nodes)==0){
			$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
// 			debug($options);
			$nodes=$this->Department->find('first',$options);
// 			debug($nodes);
			$data[0]=array(
					'id'=>$nodes['Department']['id'],
					'dept_number'=>$nodes['Department']['dept_number'],
					'dept_name'=>$nodes['Department']['dept_name']);
		}else
		{
			$data = array();
			foreach ($nodes as $node){
					$data[]=array(
						'id'=>$node['Department']['id'],
						'dept_number'=>$node['Department']['dept_number'],
						'dept_name'=>$node['Department']['dept_name']);
			
		}
		}

		//echo json_encode($data);
// 		debug($data);
/* 		foreach ($nodes as $node){
			if($node['Department']['lft'] + 1 == $node['Department']['rght'])
			$data[]=array('id'=>$node['Department']['id'],'number'=>$node['Department']['dept_number']);
		}
		if ($data==null)
		$data=$parent; */
		//debug($data);
// 		debug($nodes);
		return $data;
// 		return $nodes; 
	
	}
	/* 查找父节点 */
	function getParent($id){
		$parent = $this->Department->getParentNode($id); //<- id for fun // $parent contains
// 		debug($parent);
		return $parent;	
		
	}
//根据名称查找
	function find(){
		if ($this->request->is('post')) {
			//debug($this->request->data['Department']['dept_name']);
			$dept_name=$this->request->data['Department']['dept_name'];
		if(!isset($dept_name)){
			echo('请输入正确的名称');
		}	
		else{
			
			debug($this->Department->findByDept_name($dept_name));
			
		}
		
	}
	}
	

/**
 * add method
 *
 * @return void
 */
	/* 批量增加班级代码 */
	public function addDepartments() {
		
		if ($this->request->is('post')) {
			$parent_dept=$this->Department->findById($this->request->data['Department']['parent_id']);
			//debug($parent_dept);
			$start=$this->request->data['Department']['start'];
			$end=$this->request->data['Department']['numbers'];
			
			for($i=$start;$i<=$end;$i++){
				echo $parent_dept['Department']['dept_name'];
				echo $i;
				echo '班';
				$this->Department->create();
				$new_dept['Department']['dept_name']=$parent_dept['Department']['dept_name'];
				$new_dept['Department']['dept_name'].=$i;
				$new_dept['Department']['dept_name'].='班';
				$new_dept['Department']['dept_number']=$parent_dept['Department']['dept_number'];
				$new_dept['Department']['dept_number'].=$i>=10?$i:'0'.$i;
				$new_dept['Department']['year_in']=$parent_dept['Department']['year_in'];
				$new_dept['Department']['year_graduate']=$parent_dept['Department']['year_graduate'];
				$new_dept['Department']['parent_id']=$parent_dept['Department']['id'];
			
				//debug($new_dept);
				$this->Department->save($new_dept);
			}
			/*
			
			$this->Department->create();
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash(__('The department has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department could not be saved. Please, try again.'));
			}
		*/}
		$parents = $this->Department->find('list',array('fields' => array('id','dept_name')));

		$this->set(compact('parents', 'users','departments'));
	}
}

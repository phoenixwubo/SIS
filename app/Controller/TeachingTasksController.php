<?php
App::uses('AppController', 'Controller');
/**
 * TeachingTasks Controller
 *
 * @property TeachingTask $TeachingTask
 * @property PaginatorComponent $Paginator
 */
class TeachingTasksController extends AppController {

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
		$this->TeachingTask->recursive = 0;
		$this->set('teachingTasks', $this->Paginator->paginate());
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
		if (!$this->TeachingTask->exists($id)) {
			throw new NotFoundException(__('Invalid teaching task'));
		}
		$options = array('conditions' => array('TeachingTask.' . $this->TeachingTask->primaryKey => $id));
		$this->set('teachingTask', $this->TeachingTask->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TeachingTask->create();
			if(($this->request->data)==NULL){
			
				$result['success']=FALSE;
				$this->layout='ajax';
// 				echo('不是通过post传递');
				$string=file_get_contents("php://input");
				$coursePlans=json_decode($string);
				//print_r($coursePlans) ;
					
				if ($this->TeachingTask->save($coursePlans)||$this->TeachingTask->saveAll($coursePlans)) {
					$result['success']=true;
				}
					
				$this->set('result',$result);
			}
			else{
							if ($this->TeachingTask->save($this->request->data)) {
				return $this->flash(__('The teaching task has been saved.'), array('action' => 'index'));
			
			}
			
}
		}
		$departments = $this->TeachingTask->Department->find('list');
		$coursePlans = $this->TeachingTask->CoursePlan->find('list');
		$users = $this->TeachingTask->User->find('list');
		$this->set(compact('departments', 'coursePlans', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TeachingTask->exists($id)) {
			if(!$this->request->is(array('post', 'put'))){
				throw new NotFoundException(__('Invalid teaching task'));
			}

		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data==NULL){
					
				$result['success']=FALSE;
				$this->layout='ajax';
				$string=file_get_contents("php://input");
				$task=json_decode($string);
				//print_r($task) ;
				$id=$task->id;
				$original_data=$this->TeachingTask->findById($id);
				$original_user_id=$original_data['TeachingTask']['user_id'];
				$original_note=$original_data['TeachingTask']['note'];
				$new_user_id=$task->user_id;
				//print($original_user_id.$new_user_id);
				if($original_user_id!=$new_user_id){
					$string=$original_note;
					$string.=date('Y-m-d H:i:s');;
					$string.='+'.$original_user_id.'&';
					//print($string);
					$task->note=$string;
				}
// 				debug($task);
				if ($this->TeachingTask->save($task)||$this->TeachingTask->saveAll($task)) {
					$result['success']=true;
				}
					
				$this->set('result',$result);
					
			}
			else{
				if ($this->TeachingTask->save($this->request->data)) {
				return $this->flash(__('The teaching task has been saved.'), array('action' => 'index'));
			}
			}
			
			
		} else {
			$options = array('conditions' => array('TeachingTask.' . $this->TeachingTask->primaryKey => $id));
			$this->request->data = $this->TeachingTask->find('first', $options);
		}
		$departments = $this->TeachingTask->Department->find('list');
		$coursePlans = $this->TeachingTask->CoursePlan->find('list');
		$users = $this->TeachingTask->User->find('list');
		$this->set(compact('departments', 'coursePlans', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TeachingTask->id = $id;
		if (!$this->TeachingTask->exists()) {
			throw new NotFoundException(__('Invalid teaching task'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TeachingTask->delete()) {
			return $this->flash(__('The teaching task has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The teaching task could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}

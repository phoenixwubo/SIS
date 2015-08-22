<?php
App::uses('AppController', 'Controller');
/**
 * Courses Controller
 *
 * @property Course $Course
 * @property PaginatorComponent $Paginator
 */
class CoursesController extends AppController {

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
		$this->Course->recursive = 0;
		$result['success']=true;
		$this->set('result',$result);
		$this->set('courses', $this->Paginator->paginate());
// 		$this->set('courses', $this->Course->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Course->exists($id)) {
			throw new NotFoundException(__('Invalid course'));
		}
		$options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
		$this->set('course', $this->Course->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if($this->request->data==NULL){

				$result['success']=FALSE;
				$this->layout='ajax';
				$string=file_get_contents("php://input");
				$courses=json_decode($string);
				//print_r($courses) ;
					
				if ($this->Course->save($courses)||$this->Course->saveAll($courses)) {
					$result['success']=true;
				}
					
				$this->set('result',$result);
				
			}else{

				$this->Course->create();
				if ($this->Course->save($this->request->data)) {
					return $this->flash(__('The course has been saved.'), array('action' => 'index'));
				}
			}
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
		if (!$this->Course->exists($id)) {
			if(!$this->request->is(array('post', 'put'))){
				throw new NotFoundException(__('Invalid course'));

			}
		}
		if ($this->request->is(array('post', 'put'))) {

			if($this->request->data==NULL){
			
				$result['success']=FALSE;
				$this->layout='ajax';
				$string=file_get_contents("php://input");
				$courses=json_decode($string);
				//print_r($courses) ;
					
				if ($this->Course->save($courses)||$this->Course->saveAll($courses)) {
					$result['success']=true;
				}
					
				$this->set('result',$result);
			
			}else{
				if ($this->Course->save($this->request->data)) {
				return $this->flash(__('The course has been saved.'), array('action' => 'index'));
			}
			}
			
		} else {
			$options = array('conditions' => array('Course.' . $this->Course->primaryKey => $id));
			$this->request->data = $this->Course->find('first', $options);
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
		$this->Course->id = $id;
		if (!$this->Course->exists()) {
			if(!$this->request->is(array('post', 'put'))){
				throw new NotFoundException(__('Invalid course'));
			}else
			{
				$result['success']=FALSE;
				$this->layout='ajax';
				$string=file_get_contents("php://input");
				$courses=json_decode($string);
// 				debug($courses);
				$this->Course->id = $courses->id;
			}
			
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Course->delete()) {
			//return $this->flash(__('The course has been deleted.'), array('action' => 'index'));
			$result['success']=TRUE;
		} else {
			$result['success']=FALSE;
			
			//return $this->flash(__('The course could not be deleted. Please, try again.'), array('action' => 'index'));
		}
		$this->set('result',$result);
	}}

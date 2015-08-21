<?php
App::uses('AppController', 'Controller');
/**
 * Semesters Controller
 *
 * @property Semester $Semester
 * @property PaginatorComponent $Paginator
 */
class SemestersController extends AppController {

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
		$this->Semester->recursive = 0;
		$result['success']=true;
		$this->set('result',$result);
		$this->set('semesters', $this->Paginator->paginate());

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Semester->exists($id)) {
			throw new NotFoundException(__('Invalid semester'));
		}
		$options = array('conditions' => array('Semester.' . $this->Semester->primaryKey => $id));
		$this->set('semester', $this->Semester->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Semester->create();
			//debug($this->request->data);
			if($this->request->data==array()){
			$this->layout='ajax';
				$string=file_get_contents("php://input");
				$semesters=json_decode($string);
				//debug($semesters) ;
				//$this->request->data=$semesters;
				
				 if ($this->Semester->save($semesters)) {
					$result['success']=true;
				} 
				$this->set('result',$result);
				
			}
			else{
							if ($this->Semester->save($this->request->data)) {
				//$this->Session->setFlash(__('The semester has been saved.'));
				debug($this->request->data);					
			//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The semester could not be saved. Please, try again.'));
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
		
		if (!$this->Semester->exists($id)) {
			//throw new NotFoundException(__('Invalid semester'));
			$this->layout='ajax';
			$result['success']=false;
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data==array()){
				$string=file_get_contents("php://input");
				$semesters=json_decode($string);
				//debug($semesters) ;
				//$this->request->data=$semesters;
			
				if ($this->Semester->save($semesters)) {
					$result['success']=true;
				}
				$this->set('result',$result);
			
			}
			else{
						if ($this->Semester->save($this->request->data)) {
				$this->Session->setFlash(__('The semester has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The semester could not be saved. Please, try again.'));
			}
			}
	
		} else {
			$options = array('conditions' => array('Semester.' . $this->Semester->primaryKey => $id));
			$this->request->data = $this->Semester->find('first', $options);
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
		$this->Semester->id = $id;
		$result['success']=false;
		if (!$this->Semester->exists()) {
			
			//throw new NotFoundException(__('Invalid semester'));
			$this->layout='ajax';
			if ($this->request->is(array('post', 'put'))) {
				$string=file_get_contents("php://input");
				$Semesters=json_decode($string);
				$this->Semester->id=$Semesters->id;
			
			}
			
			
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Semester->delete()) {
			$result['success']=true;
			$this->set('result',$result);
			//$this->Session->setFlash(__('The semester has been deleted.'));
		} else {
			$this->Session->setFlash(__('The semester could not be deleted. Please, try again.'));
		}
		//return $this->redirect(array('action' => 'index'));
	}}

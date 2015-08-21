<?php
App::uses('AppController', 'Controller');
class CategoriesController extends AppController {
	
	public function index() {
	        $data = $this->Category->generateTreeList(
    		      null,
          			null,
         		 null,
          '   '
        );
	debug($data); die;
}
	public function add(){
		$data['Category']['parent_id'] = 3;
		$data['Category']['name'] = 'Skating';
		$this->Category->save($data);
		$this->redirect('./');
	}
	
	function getnodes($id){
		$parent=intval($id);
		//$parent=6;
		$nodes=$this->Category->children($parent,true);
		$this->set(compact('nodes'));
	}
}

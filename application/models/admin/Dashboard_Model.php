<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_Model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getData($limit, $offset){
		$sql = $this->db->limit($limit, $offset)->get('intern_register');
		return $sql;
	}

	public function takeTask($task){
		if($this->db->insert('intern_task', $task)){
			return 'success';
		}
		else{
			return 'error';
		}
	}

	public function getStatus($data_status){
		//insert login_status value 1
		$result = $this->db->set('login_status','1')->where('user_id', $data_status)->update('intern_register');
		if($result){

		}
		else{
			return 'error';
		}
	}

	public function getStatusActive($data_status){
		//insert login_status value 1
		$result = $this->db->set('login_status','0')->where('user_id', $data_status)->update('intern_register');
		if($result){

		}
		else{
			return 'error';
		}
	}

	public function getDetails_Intern($data){
		return $this->db->where('user_id', $data['id'])->get('intern_task');
	}

	public function approved_task($id){
		$ap = 1;
		$st = array('approved_task'=>$ap);
		$this->db->where('id', $id);
		$this->db->update('intern_task', $st); 
		return $id; //not used
	}

	public function disapproved_task($id){
		$comp = 0;
		$app = 0;
		$st = array('approved_task'=>$app, 'complete_time'=>$comp, 'completed'=>$comp);
		$this->db->where('id', $id);
		$this->db->update('intern_task', $st); 
		return $id; //not used
	}

	public function getRows(){
		return ($this->db->get('intern_register')->num_rows());
	}
	public function getRow(){
		return ($this->db->get('intern_register'));
	}
}
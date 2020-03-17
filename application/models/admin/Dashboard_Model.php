<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_Model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getData(){
		$sql = $this->db->get('intern_register');
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

	public function getDetails_Intern($data){
		return $this->db->where('user_id', $data['id'])->get('intern_task');
	}

	public function approved_task($id){
		$ap = 1;
		$st = array('approved_task'=>$ap);
		$this->db->where('id', $id);
		$this->db->update('intern_task', $st); 
		return $id;
	}

	public function getRow(){
		return ($this->db->get('intern_register'));
	}
}
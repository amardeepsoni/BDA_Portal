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

	public function getDataSchool($limit, $offset){
		$sql = $this->db->limit($limit, $offset)->get('intern_school');
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
		$zero = 0;
		$st = array('approved_task'=>$ap, 'disapproved'=>$zero);
		$this->db->where('id', $id);
		$this->db->update('intern_task', $st); 
		return $id; //not used
	}

	public function disapproved_task($data){
		$comp = 0;
		$app = 0;
		$one = 1;
		$st = array('approved_task'=>$app, 'complete_time'=>$comp, 'completed'=>$comp, 'suggestion'=>$data['suggestion'], 'disapproved'=>$one, 'history'=>'0', 'seen'=> '0');
		$this->db->where('id', $data['id']);
		$this->db->update('intern_task', $st); 
		return $id; //not used
	}

	public function getRows(){
		return ($this->db->get('intern_register')->num_rows());
	}

	public function getRow(){
		return ($this->db->get('intern_register'));
	}
	public function getRowSchool(){
		return ($this->db->get('intern_school'));
	}

	public function getRowSchoolFilter(){
		return ($this->db->get('intern_school')->num_rows());
	}

	public function getNotification(){
		 $date = new DateTime("now");

		 $curr_date = $date->format('Y-m-d ');
		 $ap = 0;
		 $cp = 1;
		 $this->db->select('*');
		 $this->db->from('intern_task'); 
		 $this->db->where('approved_task', $ap);
		 $this->db->where('completed', $cp);
		 $this->db->where('DATE(add_time)',$curr_date);//use date function
		 $query = $this->db->get();
		 return $query;
	}


	public function get_filter_intern_data($data){
		$query = $this->db->like($data['type'], $data['value'])->get('intern_register');
		return $query;
	}
	
	public function getRowsFilter($data){
		return ($this->db->like($data['type'], $data['value'])->get('intern_register')->num_rows());
	}

	public function getRowsFilterSchool($data){
		return ($this->db->like($data['type'], $data['value'])->get('intern_school')->num_rows());
	}

	public function getDataFilter($limit, $offset, $data){
		$sql = $this->db->like($data['type'], $data['value'])->limit($limit, $offset)->get('intern_register');
		return $sql;
	}

	public function getDataFilterSchool($limit, $offset, $data){
		$sql = $this->db->like($data['type'], $data['value'])->limit($limit, $offset)->get('intern_school');
		return $sql;
	}
	
}
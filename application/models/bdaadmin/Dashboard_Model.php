<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_Model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getData($limit, $offset){
			$sql = $this->db->like('user_id', 'wf')->limit($limit, $offset)->get('intern_register');
			return $sql;
		}


	public function getDataEmp($limit, $offset){
			$sql = $this->db->like('user_id', 'emp')->limit($limit, $offset)->get('intern_register');
			return $sql;
		}

	public function getDataSchool($limit, $offset){

		if($this->session->userdata('main_admin_login')){
			$sql = $this->db->limit($limit, $offset)->get('intern_school');
			return $sql;
		}

		else{
			$sql = $this->db->like('user_id', 'wf')->limit($limit, $offset)->get('intern_school');
			return $sql;
		}
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

		//increase scoreboard of this intern
		/*$user = 'EMP3976';
			$this->db->set('score', 'score+1', FALSE);        
		    $where = array('user_id' =>$user);
		    $this->db->where($where);
		    $this->db->update('intern_scoreboard');*/
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
			
			return ($this->db->like('user_id', 'wf')->get('intern_register')->num_rows());
	}

	public function getRowsEmp(){
			
			return ($this->db->like('user_id', 'emp')->get('intern_register')->num_rows());
	}

	public function getRow(){
		$this->db->like('user_id', 'wf');
		return ($this->db->get('intern_register'));
	}

	public function getRowEmp(){
		$this->db->like('user_id', 'emp');
		return($this->db->get('intern_register'));
	}

	public function getRowSchool(){
		if($this->session->userdata('main_admin_login')){
		return ($this->db->get('intern_school'));
	}
	else{
		return ($this->db->like('user_id', 'wf')->get('intern_school'));
	}
	}

	public function getRowSchoolFilter(){
		if($this->session->userdata('main_admin_login')){
		return ($this->db->get('intern_school')->num_rows());
	}
	else{
		return ($this->db->like('user_id', 'wf')->get('intern_school')->num_rows());	
	}
	}

	public function getNotification(){
		if($this->session->userdata('main_admin_login')){
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
		else{
			 $date = new DateTime("now");
			 $curr_date = $date->format('Y-m-d ');
			 $ap = 0;
			 $cp = 1;
			 $this->db->select('*');
			 $this->db->from('intern_task'); 
			 $this->db->like('user_id', 'wf'); 
			 $this->db->where('approved_task', $ap);
			 $this->db->where('completed', $cp);
			 $this->db->where('DATE(add_time)',$curr_date);//use date function
			 $query = $this->db->get();
			 return $query;			
		}
	}


	public function get_filter_intern_data($data){
		$query = $this->db->like($data['type'], $data['value'])->get('intern_register');
		return $query;
	}
	
	public function today_tasks(){
		$this->load->helper('date');
		date_default_timezone_set('Asia/Kolkata');
		// $time =  date("Y-m-d H:i:s", strtotime('-24 hour', strtotime(date("Y-m-d H:i:s"))));
		$time = date("Y-m-d");
		$today = $time." 00:00:00";
		// echo $time;
		$result = $this->db->select('*')->from('intern_task')->where('add_time >=',$time)->get()->result_array();
		// print_r($result);
		return $result;
	}

	public function pie_count(){
		$count['total'] = $this->db->select('*')->from('intern_task')->get()->num_rows();
		$count['completed'] = $this->db->select('*')->from('intern_task')->where('completed','1')->get()->num_rows();
		$count['total'] -=$count['completed'];
		return $count;
	}

	/*public function getDataWhereLike($field, $search)
	{
	    $query = $this->db->like($field, $search)->orderBy('id', 'asc')->get('intern_register');
	    return $query->result();
	}*/
	public function getRowsFilter($data){
		return ($this->db->like('user_id', 'wf')->like($data['type'], $data['value'])->get('intern_register')->num_rows());
	}

	public function getRowsFilterSchool($data){
		if($this->session->userdata('main_admin_login')){
			return ($this->db->like($data['type'], $data['value'])->get('intern_school')->num_rows());
		}
		else{
			return ($this->db->like('user_id', 'wf')->like($data['type'], $data['value'])->get('intern_school')->num_rows());
		}
	}

	public function getDataFilter($limit, $offset, $data){
		$sql = $this->db->like('user_id', 'wf')->like($data['type'], $data['value'])->limit($limit, $offset)->get('intern_register');
				return $sql;
	}

	public function getDataFilterSchool($limit, $offset, $data){
		if($this->session->userdata('main_admin_login')){
			$sql = $this->db->like($data['type'], $data['value'])->limit($limit, $offset)->get('intern_school');
			return $sql;	
		}
		else{
			$sql = $this->db->like('user_id', 'wf')->like($data['type'], $data['value'])->limit($limit, $offset)->get('intern_school');
			return $sql;
		}
		
	}
	
}
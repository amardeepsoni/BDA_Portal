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
		$sql = $this->db->where('user_id', $task['user_id'])->get('intern_register')->row();
		$task['domain'] = $sql->domain;
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

	public function approved_task($id){
		$ap = 1;
		$zero = 0;
		$st = array('approved_task'=>$ap, 'disapproved'=>$zero);
		$this->db->where('id', $id);
		$this->db->update('intern_task', $st); 
		return $id; //not used
	}

	public function scoreboard(){
		//increase scoreboard of this intern
			$user = 'EMP3976';
			$ap = 29;
			$sco = array('score'=>$ap);      
		    /*$where = array('user_id' =>$user);*/
		    $this->db->where('user_id', $ap);
		    $this->db->update('intern_scoreboard', $sco);
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

	public function getRowShowDetails($data){
		return ($this->db->like('user_id', $data)->get('intern_task')->num_rows());
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
		if($this->session->userdata('main_admin_login')){
		$count['total'] = $this->db->select('*')->from('intern_task')->get()->num_rows();
		$count['completed'] = $this->db->select('*')->from('intern_task')->where('completed','1')->get()->num_rows();
		$count['total'] -=$count['completed'];
		return $count;
	}
	else{
			$count['total'] = $this->db->select('*')->from('intern_task')->like('user_id', 'wf')->get()->num_rows();
			$count['completed'] = $this->db->select('*')->from('intern_task')->where('completed','1')->get()->num_rows();
			$count['total'] -=$count['completed'];
			return $count;
		}

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

	public function getDetails_Intern($data, $limit, $offset){
		return ($this->db->where('user_id', $data)->limit($limit, $offset)->get('intern_task'));
	}

	public function getTotalTaskDetail($data){
		return ($this->db->where('user_id', $data)->get('intern_task'));
	}

	//ongoing projects details
	//Business Development
	public function getOnGoingProjectsBusinessDevelopment(){
		/*return($this->db->like('user_id', 'wf')->get('intern_task'));*/
		if($this->session->userdata('main_admin_login')){
			$ap = 1;
		$total = $this->db->where('domain', 'Business Development')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Business Development', 'approved_task'=>$ap);
		$approved = $this->db->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	} 
	else{
		return 0;
	}
		}
		else{
			$ap = 1;
		$total = $this->db->like('user_id', 'wf')->where('domain', 'Business Development')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Business Development', 'approved_task'=>$ap);
		$approved = $this->db->like('user_id', 'wf')->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
		}
		else{
				return 0;
		}
		}
	}

	//operation
	public function getOnGoingProjectsOperation(){
		if($this->session->userdata('main_admin_login')){
			$ap = 1;
		$total = $this->db->where('domain', 'Operation')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Operation', 'approved_task'=>$ap);
		$approved = $this->db->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	}
	else{
		return 0;
	}
		}
		else{
			$ap = 1;
		$total = $this->db->like('user_id', 'wf')->where('domain', 'Operation')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Operation', 'approved_task'=>$ap);
		$approved = $this->db->like('user_id', 'wf')->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	}
	else{
		return 0;
		}
	}
	}

	//State Coordinator
	public function getOnGoingProjectsStateCoordinator(){
		if($this->session->userdata('main_admin_login')){
			$ap = 1;
		$total = $this->db->where('domain', 'State Coordinator')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'State Coordinator', 'approved_task'=>$ap);
		$approved = $this->db->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	}
	else{
		return 0;
			}
		}

		else{
			$ap = 1;
		$total = $this->db->like('user_id', 'wf')->where('domain', 'State Coordinator')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'State Coordinator', 'approved_task'=>$ap);
		$approved = $this->db->like('user_id', 'wf')->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	}
	else{
		return 0;
			}
		}
	}

	//volunteering
	public function getOnGoingProjectsVolunteering(){
		if($this->session->userdata('main_admin_login')){
			$ap = 1;
		$total = $this->db->where('domain', 'Volunteering')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Volunteering', 'approved_task'=>$ap);
		$approved = $this->db->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	}
	else{
		return 0;
	}
		}
		else{
			$ap = 1;
		$total = $this->db->like('user_id', 'wf')->where('domain', 'Volunteering')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Volunteering', 'approved_task'=>$ap);
		$approved = $this->db->like('user_id', 'wf')->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	}
	else{
		return 0;
	}
		}
	}

	//getOnGoingProjectsMarketing
	public function getOnGoingProjectsMarketing(){
		if($this->session->userdata('main_admin_login')){
			$ap = 1;
		$total = $this->db->where('domain', 'Marketing')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Marketing', 'approved_task'=>$ap);
		$approved = $this->db->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	}
	else{
		return 0;
	}
		}
		else{
			$ap = 1;
		$total = $this->db->like('user_id', 'wf')->where('domain', 'Marketing')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Marketing', 'approved_task'=>$ap);
		$approved = $this->db->like('user_id', 'wf')->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	} 
	else{
		return 0;
		}
	}
	}

	//Sales
	public function getOnGoingProjectsSales(){
		if($this->session->userdata('main_admin_login')){
			$ap = 1;
		$total = $this->db->where('domain', 'Sales')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Sales', 'approved_task'=>$ap);
		$approved = $this->db->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	}
	else{
		return 0;
	}
		}
		else{
			$ap = 1;
		$total = $this->db->like('user_id', 'wf')->where('domain', 'Sales')->get('intern_task')->num_rows();
		if(!$total==0){
		$wh = array('domain'=> 'Sales', 'approved_task'=>$ap);
		$approved = $this->db->like('user_id', 'wf')->where($wh)->get('intern_task')->num_rows();
		$perc = ($approved/$total)*100;
		return $perc;
	} 
	else{
		return 0;
		}
	}
	}

	//group task assign team
	public function get_task_project_details($data){
		$uid = '';
		$no = 1;
		foreach($data as $dt){
			if($no==1){
				$uid .= $dt;
				$no++;	
			}
			else{
			$uid.= ' ,'.$dt;
			$no++;
		}
		}
		$wh = array('user_id'=> $uid);
		if($no==2){
			$sql = $this->db->where($wh)->get('intern_register')->result(); 
			return $sql;	
		}
		else{
			$sql = $this->db->where_in($wh)->get('intern_register')->result(); 
			return $sql;
		}
		
	}

	//insert group task
	public function insert_group_task($data, $topic, $description, $mentor){
		$this->load->helper('date');
		date_default_timezone_set('Asia/Kolkata');
		$time = date("Y-m-d H:i:s");
		$sql = 'error';
		foreach ($data as $value) {
			$str = array('user_id'=>$value, 'topic'=>$topic, 'description'=>$description, 'mentor'=>$mentor, 'add_time'=>$time);
			$this->db->insert('intern_task', $str);
			$sql = 'true';
		}
		return $sql;
	}

	
}
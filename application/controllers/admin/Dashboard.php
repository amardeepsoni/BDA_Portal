<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	protected $title = ['page_title'=> 'Admin Dashboard'];
	protected $title1 = ['page_title'=> 'Admin Dashboard'];
	//constructor
	public function __construct(){
		parent::__construct();
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$this->title['notification'] = $this->dm->getNotification();
	}
	public function index() {
		if (!$this->session->userdata('admin_login')) {
			redirect('admin');
		}
		$data['page_title'] = 'Admin Dashboard';
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$data['row'] = $this->dm->getRow();//intern rows
		$data['rows'] = $this->dm->getRowSchool();//school rows
		$data['notification'] = $this->dm->getNotification();//notification rows
		$this->load->View('header', $data);
		$this->load->view(adminpath . '/dashboard.php', $this->title);
		$this->load->View('footer');
	}
	public function taskAssign() {
		$this->load->view('header', $this->title);
		$this->load->view(adminpath . '/task_assign');
		$this->load->view('footer');
	}

	public function insertTask() {
		$task = array('user_id' => htmlspecialchars($this->input->post('user_id')), 'topic' => htmlspecialchars($this->input->post('topic')), 'description' => htmlspecialchars($this->input->post('description')));
		$this->load->helper('date');
		date_default_timezone_set('Asia/Kolkata');
		$task['add_time'] = date("Y-m-d H:i:s");
		$this->load->model(adminpath . '/Dashboard_Model', 'dmt');
		$result = $this->dmt->takeTask($task);
		echo $result;
	}

	public function intern_list(){
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('admin/Dashboard/intern_list'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRows()
		];
		$this->pagination->initialize($config);
		
		$data['fetch_data'] = $this->dm->getData($config['per_page'], $this->uri->segment(4));
		$this->load->View('header', $this->title);
		$this->load->view(adminpath . '/internList.php', $data);
		$this->load->View('footer');
	}

	public function intern_school(){
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('admin/Dashboard/intern_school'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowSchoolFilter()
		];
		$this->pagination->initialize($config);
		
		$data['fetch_data'] = $this->dm->getDataSchool($config['per_page'], $this->uri->segment(4));
		$this->load->View('header', $this->title);
		$this->load->view(adminpath . '/internSchoolList.php', $data);
		$this->load->View('footer');
	}

	public function insertStatus(){
		$data_Status = htmlspecialchars($this->input->post('user_id'));
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->getStatus($data_Status);
		echo $res;
	}

	public function insertStatusActive(){
		$data_Status = htmlspecialchars($this->input->post('user_id'));
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->getStatusActive($data_Status);
		echo $res;
	}

	public function showDetails(){
		$data['id'] = $_GET['id'];
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$details['detail'] = $this->dm->getDetails_Intern($data);
		$this->load->View('header', $this->title1);
		$this->load->view(adminpath . '/showDetails_Intern.php', $details);
		$this->load->View('footer');
	}

	public function approvedTask(){
		$id = $this->input->post('id');
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->approved_task($id);
		echo $res;
	}	

	public function disapprovedTask(){
		$data['id'] = htmlspecialchars($this->input->post('id'));
		$data['suggestion'] = htmlspecialchars($this->input->post('sugg'));
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->disapproved_task($data);
		echo $res;
	}

	public function filter_data_intern(){
		if(isset($_POST['typeFilter']) AND isset($_POST['FilterData'])){
			$this->session->set_userdata('filter_status',$this->input->post('typeFilter'));
			$this->session->set_userdata('value_status',$this->input->post('FilterData'));
			$data['type'] = $this->session->userdata('filter_status');
            $data['value'] = $this->session->userdata('value_status');
	}
	else{
			if($this->session->userdata('filter_status')!='')
            {
                $data['type'] = $this->session->userdata('filter_status');
                $data['value'] = $this->session->userdata('value_status');
            }
		}
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('admin/Dashboard/filter_data_intern'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowsFilter($data)
		];
		$this->pagination->initialize($config);
		
		$data['fetch_data'] = $this->dm->getDataFilter($config['per_page'], $this->uri->segment(4), $data);
		$this->load->View('header', $this->title);
		$this->load->view(adminpath . '/intern_list_filter.php', $data);
		$this->load->View('footer');
	}

	public function filter_data_intern_school_list(){
		if(isset($_POST['typeFilter']) AND isset($_POST['FilterData'])){
			$this->session->set_userdata('filter_status',$this->input->post('typeFilter'));
			$this->session->set_userdata('value_status',$this->input->post('FilterData'));
			$data['type'] = $this->session->userdata('filter_status');
            $data['value'] = $this->session->userdata('value_status');
	}
	else{
			if($this->session->userdata('filter_status')!='')
            {
                $data['type'] = $this->session->userdata('filter_status');
                $data['value'] = $this->session->userdata('value_status');
            }
		}
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('admin/Dashboard/filter_data_intern'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowsFilterSchool($data)
		];
		$this->pagination->initialize($config);
		
		$data['fetch_data'] = $this->dm->getDataFilterSchool($config['per_page'], $this->uri->segment(4), $data);
		$this->load->View('header', $this->title);
		$this->load->view(adminpath . '/intern_list_filter_school.php', $data);
		$this->load->View('footer');
	}


}

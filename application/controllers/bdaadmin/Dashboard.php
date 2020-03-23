<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	protected $title = ['page_title' => 'Admin Dashboard'];
	protected $title1 = ['page_title' => 'Admin Dashboard'];
	//constructor
	public function __construct() {
		parent::__construct();
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$this->title['notification'] = $this->dm->getNotification();
		if (!$this->session->userdata('admin_login')) {
			if (!$this->session->userdata('main_admin_login')) {
				redirect('bdaadmin');
			}
		}
	}
	public function index() {

		if ($this->session->userdata('main_admin_login')) {
			$data['page_title'] = 'Admin Dashboard';
			$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
			$data['row'] = $this->dm->getRow(); //intern rows
			$data['rows'] = $this->dm->getRowSchool(); //school rows
			$data['row_emp'] = $this->dm->getRowEmp(); //emp rows
			$data['todays_task'] = $this->dm->today_tasks(); //today task table
			$data['counts'] = $this->dm->pie_count();
			$data['notification'] = $this->dm->getNotification(); //notification rows
			//ongoing projects percentages for main admin
			$data['Business_Development'] = $this->dm->getOnGoingProjectsBusinessDevelopment();
			$data['Operation'] = $this->dm->getOnGoingProjectsOperation();
			$data['State Coordinator'] = $this->dm->getOnGoingProjectsStateCoordinator();
			$data['Volunteering'] = $this->dm->getOnGoingProjectsVolunteering();
			$data['Marketing'] = $this->dm->getOnGoingProjectsMarketing();
			$data['Sales'] = $this->dm->getOnGoingProjectsSales();
			//
			$this->load->View('bdaheader', $data);
			$this->load->view(bdaadminpath . '/dashboard.php', $this->title);
			$this->load->View('bdafooter');
		} else {
			$data['page_title'] = 'Admin Dashboard';
			$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
			$data['row'] = $this->dm->getRow(); //intern rows
			$data['rows'] = $this->dm->getRowSchool(); //school rows
			//$data['row_emp'] = $this->dm->getRowEmp(); //school rows
			$data['todays_task'] = $this->dm->today_tasks(); //today task table
			$data['counts'] = $this->dm->pie_count();
			$data['notification'] = $this->dm->getNotification(); //notification rows
			//ongoing projects percentages for local admin
			$data['Business_Development'] = $this->dm->getOnGoingProjectsBusinessDevelopment();
			$data['Operation'] = $this->dm->getOnGoingProjectsOperation();
			$data['State_Coordinator'] = $this->dm->getOnGoingProjectsStateCoordinator();
			$data['Volunteering'] = $this->dm->getOnGoingProjectsVolunteering();
			$data['Marketing'] = $this->dm->getOnGoingProjectsMarketing();
			$data['Sales'] = $this->dm->getOnGoingProjectsSales();
			//
			$this->load->View('bdaheader', $data);
			$this->load->view(bdaadminpath . '/dashboard.php', $this->title);
			$this->load->View('bdafooter');
		}

	}
	public function taskAssign() {
		$this->load->view('bdaheader', $this->title);
		$this->load->view(bdaadminpath . '/task_assign');
		$this->load->view('bdafooter');
	}

	public function insertTask() {
		$task = array('user_id' => htmlspecialchars($this->input->post('user_id')), 'topic' => htmlspecialchars($this->input->post('topic')), 'description' => htmlspecialchars($this->input->post('description')));
		$this->load->helper('date');
		date_default_timezone_set('Asia/Kolkata');
		$task['add_time'] = date("Y-m-d H:i:s");
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dmt');
		$result = $this->dmt->takeTask($task);
		echo $result;
	}

	public function intern_list() {
		if($this->session->userdata('showDetailsID')){
			$this->session->unset_userdata('showDetailsID');
		}
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('bdaadmin/Dashboard/intern_list'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRows(),
		];
		$this->pagination->initialize($config);

		$data['fetch_data'] = $this->dm->getData($config['per_page'], $this->uri->segment(4));
		$this->load->View('bdaheader', $this->title);
		$this->load->view(bdaadminpath . '/internList.php', $data);
		$this->load->View('bdafooter');
	}

	public function emp_list() {
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('bdaadmin/Dashboard/intern_list'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowsEmp(),
		];
		$this->pagination->initialize($config);

		$data['fetch_data'] = $this->dm->getDataEmp($config['per_page'], $this->uri->segment(4));
		$this->load->View('bdaheader', $this->title);
		$this->load->view(bdaadminpath . '/internList.php', $data);
		$this->load->View('bdafooter');
	}

	public function intern_school() {
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('bdaadmin/Dashboard/intern_school'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowSchoolFilter(),
		];
		$this->pagination->initialize($config);

		$data['fetch_data'] = $this->dm->getDataSchool($config['per_page'], $this->uri->segment(4));
		$this->load->View('bdaheader', $this->title);
		$this->load->view(bdaadminpath . '/internSchoolList.php', $data);
		$this->load->View('bdafooter');
	}

	public function insertStatus() {
		$data_Status = htmlspecialchars($this->input->post('user_id'));
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->getStatus($data_Status);
		echo $res;
	}

	public function insertStatusActive() {
		$data_Status = htmlspecialchars($this->input->post('user_id'));
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->getStatusActive($data_Status);
		echo $res;
	}

	public function showDetails() {
		if(isset($_GET['id'])){
			$data['id'] = $_GET['id'];	
			$this->session->set_userdata('showDetailsID', $data['id']);
		}
		
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('bdaadmin/Dashboard/showDetails'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowShowDetails($this->session->userdata('showDetailsID')),
		];
		/*$this->load->helper('string');
		$data['id'] = substr($data['id'], 0, 7);
		echo $data['id'];
		echo $this->uri->segment(4).'hello';
		
			$off = substr($data['id'], 7, 10);
			echo $off;*/
		
		$this->pagination->initialize($config);
		$details['detail'] = $this->dm->getDetails_Intern($this->session->userdata('showDetailsID'), $config['per_page'], $this->uri->segment(4));
		$details['detail123'] = $this->dm->getTotalTaskDetail($this->session->userdata('showDetailsID'));
		$this->load->View('bdaheader', $this->title);
		$this->load->view(bdaadminpath . '/showDetails_Intern.php', $details);
		$this->load->View('bdafooter');
	}

	public function approvedTask() {
		$id = $this->input->post('id');
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->approved_task($id);
		echo $res;
	}

	public function disapprovedTask() {
		$data['id'] = htmlspecialchars($this->input->post('id'));
		$data['suggestion'] = htmlspecialchars($this->input->post('sugg'));
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->disapproved_task($data);
		echo $res;
	}

	public function filter_data_intern() {
		if (isset($_POST['typeFilter']) and isset($_POST['FilterData'])) {
			$this->session->set_userdata('filter_status', $this->input->post('typeFilter'));
			$this->session->set_userdata('value_status', $this->input->post('FilterData'));
			$data['type'] = $this->session->userdata('filter_status');
			$data['value'] = $this->session->userdata('value_status');
		} else {
			if ($this->session->userdata('filter_status') != '') {
				$data['type'] = $this->session->userdata('filter_status');
				$data['value'] = $this->session->userdata('value_status');
			}
		}
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('bdaadmin/Dashboard/filter_data_intern'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowsFilter($data),
		];
		$this->pagination->initialize($config);

		$data['fetch_data'] = $this->dm->getDataFilter($config['per_page'], $this->uri->segment(4), $data);
		$this->load->View('bdaheader', $this->title);
		$this->load->view(bdaadminpath . '/intern_list_filter.php', $data);
		$this->load->View('bdafooter');
	}

	public function filter_data_intern_school_list() {
		if (isset($_POST['typeFilter']) and isset($_POST['FilterData'])) {
			$this->session->set_userdata('filter_status', $this->input->post('typeFilter'));
			$this->session->set_userdata('value_status', $this->input->post('FilterData'));
			$data['type'] = $this->session->userdata('filter_status');
			$data['value'] = $this->session->userdata('value_status');
		} else {
			if ($this->session->userdata('filter_status') != '') {
				$data['type'] = $this->session->userdata('filter_status');
				$data['value'] = $this->session->userdata('value_status');
			}
		}
		$this->load->model(bdaadminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('bdaadmin/Dashboard/filter_data_intern'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowsFilterSchool($data),
		];
		$this->pagination->initialize($config);

		$data['fetch_data'] = $this->dm->getDataFilterSchool($config['per_page'], $this->uri->segment(4), $data);
		$this->load->View('bdaheader', $this->title);
		$this->load->view(bdaadminpath . '/intern_list_filter_school.php', $data);
		$this->load->View('bdafooter');
	}
}

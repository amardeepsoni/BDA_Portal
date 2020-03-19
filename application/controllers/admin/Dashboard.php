<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
		if (!$this->session->userdata('admin_login')) {
			redirect('admin');
		}
		//$data['page_title'] = 'Dashboard';
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$data['row'] = $this->dm->getRow();//intern rows
		$data['rows'] = $this->dm->getRowSchool();//school rows
		$data['notification'] = $this->dm->getNotification();//notification rows
		$this->load->View('header');
		$this->load->view(adminpath . '/dashboard.php', $data);
		$this->load->View('footer');
	}
	public function taskAssign() {
		$this->load->view('header');
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
		$this->load->View('header');
		$this->load->view(adminpath . '/internList.php', $data);
		$this->load->View('footer');
	}

	public function intern_school(){
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('admin/Dashboard/intern_school'),
			'per_page' => 10,
			'total_rows' => $this->dm->getRowSchool()
		];
		$this->pagination->initialize($config);
		
		$data['fetch_data'] = $this->dm->getDataSchool($config['per_page'], $this->uri->segment(4));
		$this->load->View('header');
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
		$this->load->View('header');
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
		$id = $this->input->post('id');
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->disapproved_task($id);
		echo $res;
	}

/*	public function filterData(){
        $filter = $this->input->post('filter');
        $field  = $this->input->post('field');
        $search = $this->input->post('search');

        if (isset($filter) && !empty($search)) {
            $this->load->model(adminpath . '/Dashboard_Model', 'dm');
            $data['filter_data'] = $this->dm->getDataWhereLike($field, $search);
        } else {
            $this->load->model(adminpath . '/Dashboard_Model', 'dm');
            $data['filter_data'] = $this->dm->getDataFilter();
        }

        $data['module']    = 'admin';
        $data['view_file'] = 'students/view';

        $this->load->module('templates');
        $this->templates->admin($data);    
	}*/	

}

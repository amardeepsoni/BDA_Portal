<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
		if (!$this->session->userdata('admin_login')) {
			redirect('admin');
		}
		//$data['page_title'] = 'Dashboard';
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$data['fetch_data'] = $this->dm->getData();
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
		$task = array('user_id' => $this->input->post('user_id'), 'topic' => $this->input->post('topic'), 'description' => $this->input->post('description'));
		$this->load->helper('date');
		date_default_timezone_set('Asia/Kolkata');
		$task['add_time'] = date("Y-m-d H:i:s");
		$this->load->model(adminpath . '/Dashboard_Model', 'dmt');
		$result = $this->dmt->takeTask($task);
		echo $result;
	}

	public function intern_list(){
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$data['fetch_data'] = $this->dm->getData();
		$this->load->View('header');
		$this->load->view(adminpath . '/internList.php', $data);
		$this->load->View('footer');
	}

	public function insertStatus(){
		$data_Status['login_status'] = $this->input->post('user_id');
		$this->load->model(adminpath . '/Dashboard_Model', 'dm');
		$res = $this->dm->getStatus();
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
		echo $id;
	}

}

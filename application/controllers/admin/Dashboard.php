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
		$this->load->model(adminpath . '/Dashboard_Model', 'dmt');
		$result = $this->dmt->takeTask($task);
		echo $result;
	}

}

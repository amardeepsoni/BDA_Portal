<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends CI_Controller {

	public function index() {
		if ($this->session->userdata('intern')) {
			redirect('Intern/InternDashboard');
		}
		$data['page_title'] = 'Intellify | Career';
		$this->load->View('bdaheader', $data);
		$this->load->View('bdahome');
		$this->load->View('bdafooter');

	}
}

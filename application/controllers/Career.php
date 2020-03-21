<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends CI_Controller {

	public function index() {
		if ($this->session->userdata('intern')) {
			redirect('intern/dashboard');
		}
		$data['page_title'] = 'Home';
		$this->load->View('header', $data);
		$this->load->View('home');
		$this->load->View('footer');

	}
}

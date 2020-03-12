<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		if($this->session->set_userdata('intern')){
			$data['page_title'] = 'Home';
		$this->load->View('header', $data);
		$this->load->View('home');
		$this->load->View('footer');
		}else{
			redirect("intern/dashboard");
		}
		
	}
}

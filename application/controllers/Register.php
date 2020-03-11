<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {

		$data['page_title'] = 'Home';
		$this->load->View('header');
		$this->load->View('Register');
		$this->load->View('footer');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index() {

		$data['page_title'] = 'Home';
		$this->load->View('header');
		$this->load->View('Register');
		$this->load->View('footer');
	}

	public function take_data_intern(){
		$data = array('name'=>$this->input->post('name'), 'gender'=>$this->input->post('gender'), 'mobile_no'=>$this->input->post('mobile'), 'city'=>$this->input->post('city'), 'district'=>$this->input->post('district'), 'college'=>$this->input->post('college'), 'state'=>$this->input->post('state'), 'email'=>$this->input->post('email'), 'domain'=>$this->input->post('domain'));
		$this->load->model('Register_Model', 'rm');
		$result = $this->rm->data_intern($data);
		echo $result;
	}
}

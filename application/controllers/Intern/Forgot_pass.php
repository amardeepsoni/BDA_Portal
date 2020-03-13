<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot_pass extends CI_Controller {
	public function index() {
		$data['page_title'] = 'Forgot Password';
		$this->load->View('header', $data);
		$this->load->View('intern/forgotpass', $data);
		$this->load->View('footer');
	}

	public function quiz() {
		$this->load->model('Dashboard_Model', 'dm');

		$out = $this->dm->check_status($this->session->userdata("intern")['user_id']);
		if (!$out[0]->quiz_status) {
			if ($_SESSION['Quiz'] != 0) {
				$rand = rand(1, 11);
				$result['all_data'] = $this->dm->fetch_quiz($rand);

				$this->load->View('quiz', $result);
			} else {
				echo "<center><h1>Quiz Over!!</h1><br><h4>Confirmation mail will be sent soon.<br>Wait redirecting...</h4></center>";
				$this->dm->update_status($this->session->userdata("intern")['user_id']);
				header("Refresh:5; url= " . base_url() . "intern/dashboard"); //Add whole part for site
			}
		} else {
			redirect('intern/dashboard');
		}
	}

}

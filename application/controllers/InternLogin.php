<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InternLogin extends CI_Controller {

	public function index() {
		if ($this->session->userdata('intern')) {
			redirect('Intern/InternDashboard');
		}
		$data = array();

		$data['page_title'] = 'Login';
		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => base_url(),
		);

		$this->load->view('bdaheader', $data);
		$this->load->view('internRegister', $data);
		$this->load->view('bdafooter');
	}

	public function checklogin() {
		if ($this->session->userdata('intern')) {
			$this->session->unset_userdata('intern');
		}
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['password'] = md5($data['password']);

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('loginnotify', 'Email and Password not Valid.');
				/*redirect('login');*/
			} else {
				$this->load->model('Register_Model');
				$result = $this->Register_Model->logincheck($data);
				if ($result == TRUE) {
					$username = $this->input->post('username');
					$result = $this->Register_Model->studentinfo($username);
					if ($result != false) {
						$session_data = array(
							'name' => $result->name,
							'email' => $result->email,
							'domain' => $result->domain,
							'mobile_no' => $result->mobile_no,
							'college' => $result->college,
							'city' => $result->city,
							'district' => $result->district,
							'state' => $result->state,
							'gender' => $result->gender,
							'user_id' => $result->user_id,
							'Quiz' => 5,
							'register_on' => $result->register_on,
							'referral_id' => $result->referral_id,
						);
						// Add user data in session
						$this->session->set_userdata('intern', $session_data);

						redirect('Intern/InternDashboard');
					}
				} else {
					$this->session->set_flashdata('loginnotify', 'Username and Password not Valid.');
					redirect('internLogin');
				}
			}

		}
	}

	public function logout() {
		$this->session->unset_userdata('intern');

		redirect('/Career');

	}

}

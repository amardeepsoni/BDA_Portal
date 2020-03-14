<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		if ($this->session->userdata('admin_login')) {
			redirect('admin/dashboard');
		}

		if ($this->input->post('int_admin_login_user') != '') {

			$username = $this->input->post('int_admin_login_user');
			$password = $this->input->post('int_admin_login_pass');

			$data['username'] = $username;
			$data['password'] = $password;

			$this->load->model('admin/Model_admin_login', 'admin');
			$result = $this->admin->logincheck($data);
			print_r($data);
			if ($result == TRUE) {
				$username = $this->input->post('int_admin_login_user');
				$result = $this->admin->userinfo($username);
				print_r($result);
				if ($result != false) {
					$session_data = array(
						'id' => $result->id,
						'username' => $result->username,
						'password' => $result->password,
						'email' => $result->email,

					);
					// Add user data in session
					$this->session->set_userdata('admin_login', $session_data);
					redirect('admin/dashboard');
				}
			} else {
				$this->session->set_flashdata('loginnotify', 'Username and Password not Valid.');
			}

		} else {

			$this->load->view('admin/bda_admin');
		}
	}

	public function logout() {
		$this->session->unset_userdata('logged_in');
		redirect(adminpath . '/login', 'refresh');
	}

}

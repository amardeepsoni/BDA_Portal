<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		if ($this->session->userdata('admin_login')) {
			redirect('admin/dashboard');
		}

		if ($this->input->post('int_admin_login_user') != '') {

			$username = htmlspecialchars($this->input->post('int_admin_login_user'));
			$password = htmlspecialchars($this->input->post('int_admin_login_pass'));

			$data['username'] = $username;
			$data['password'] = $password;

			$this->load->model('admin/Model_admin_login', 'admin');
			$result = $this->admin->logincheck($data);

			if ($result == TRUE) {
				$username = $this->input->post('int_admin_login_user');
				$result = $this->admin->userinfo($username);

				if ($result != false) {
					$session_data = array(
						'id' => $result->id,
						'name' => $result->name,
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
				redirect('admin');
			}

		} else {

			$this->load->view('admin/bda_admin');
		}
	}

	public function logout() {
		$this->session->unset_userdata('admin_login');
		redirect('admin');
	}

}

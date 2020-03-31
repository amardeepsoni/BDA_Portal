<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		if ($this->session->userdata('admin_login')) {
			redirect('bdaadmin/dashboard');
		}
		if (!$this->session->userdata('admin_login')) {
			if($this->session->userdata('main_admin_login')){
			redirect('bdaadmin/dashboard');
		}
		}


		if ($this->input->post('int_admin_login_user') != '') {

			$username = htmlspecialchars($this->input->post('int_admin_login_user'));
			$password = htmlspecialchars($this->input->post('int_admin_login_pass'));
			$login_type = htmlspecialchars($this->input->post('loginType'));

			$data['username'] = $username;
			$data['password'] = $password;
			$data['login_type'] = $login_type;

			$this->load->model('bdaadmin/Model_admin_login', 'admin');
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
					//set the main admin session
					$maint = "main";
					if($data['login_type']===$maint){
						$this->session->set_userdata('main_admin_login', $session_data);
						$this->session->unset_userdata('admin_login');
					}
					//set the local admin session
					else{
						$this->session->unset_userdata('main_admin_login');
						$this->session->set_userdata('admin_login', $session_data);
					}
					
					redirect('bdaadmin/Dashboard');
				}
			} else {
				$this->session->set_flashdata('loginnotify', 'Username and Password not Valid.');
				redirect('bdaadmin');
			}

		} else {
			$this->load->view('bdaadmin/bda_admin');
		}
	}

	public function logout() {
		$this->session->unset_userdata('admin_login');
		redirect('bdaadmin');
	}
	public function mainlogout(){
		$this->session->unset_userdata('main_admin_login');
		redirect('bdaadmin');
	}

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot_pass extends CI_Controller {
	public function index() {
		$data['page_title'] = 'Forgot Password';
		$this->load->View('header', $data);
		$this->load->View('intern/forgotpass', $data);
		$this->load->View('footer');
	}

	public function forgotpassword() {

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$data['email'] = $this->input->post('email');
			$this->form_validation->set_rules('email', 'email', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('loginnotify', 'Email not Valid.');
				$this->session->set_flashdata('color', 'bg-danger');
				redirect('intern/Forgot_pass');
			} else if ($this->input->post('new_password') != $this->input->post('conf_password')) {
				$this->session->set_flashdata('loginnotify', 'Confirm password not match');
				$this->session->set_flashdata('color', 'bg-danger');
				redirect('intern/Forgot_pass');
			} else {
				$this->load->model('Dashboard_model');
				$result = $this->Dashboard_model->checkmail($data['email']);
				if ($result == TRUE) {
					$email = htmlspecialchars($this->input->post('email'));
					$security_answer = htmlspecialchars($this->input->post('security_answer'));
					if ($this->input->post('old_password')) {
						$old_password = htmlspecialchars($this->input->post('old_password'));
					} else {
						$old_password = '';
					}

					$result2 = $this->Dashboard_model->checkmail_security_ans($email, $security_answer, $old_password);

					if ($result2 == TRUE) {

						$new_password = md5($this->input->post('new_password'));

						if ($this->Dashboard_model->password_update($email, $new_password) == TRUE) {
							$this->session->set_flashdata('loginnotify', 'Password changed successfully');
							$this->session->set_flashdata('color', 'bg-success');

							redirect('intern/Forgot_pass');
						}

					} else {
						$this->session->set_flashdata('loginnotify', 'Security_answer or password are not match in existing information.');
						$this->session->set_flashdata('color', 'bg-danger');
						redirect('intern/Forgot_pass');
					}

				} else {

					$this->session->set_flashdata('loginnotify', 'Email not exist');
					$this->session->set_flashdata('color', 'bg-danger');
					redirect('intern/Forgot_pass');
				}
			}
		}

	}
}

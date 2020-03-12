<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		if ($this->session->userdata('intern')['user_id']) {
			redirect('dashboard');
		}
		$data = array();

		$data['page_title'] = 'Login';
		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => base_url(),
		);

		$this->load->view('header', $data);
		$this->load->view('register', $data);
		$this->load->view('footer');
	}

	public function checklogin() {

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');

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
						);
						// Add user data in session
						$this->session->set_userdata('intern', $session_data);
						if ($this->session->userdata('intern')['user_id']) {
							$this->session->unset_userdata('intern');
						}
						redirect('dashboard');
					}
				} else {
					$this->session->set_flashdata('loginnotify', 'Username and Password not Valid.');
					redirect('login');
				}
			}

		}
	}

	public function forgotpassword() {

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$data['email'] = $this->input->post('email');
			$this->form_validation->set_rules('email', 'email', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('forgotnotify', 'Email not Valid.');
				redirect('forgotpassword');
			} else {
				$this->load->model('student_model');
				$result = $this->student_model->checkmail($data['email']);
				if ($result == TRUE) {
					$email = $this->input->post('email');
					$result = $this->student_model->customerinfo($email);
					if ($result != false) {

						$message = "<div style='width:600px; border:solid 1px #40383b'>";

						$message = $message . "<table width='100%' border='0' cellspacing='0' cellpadding='20'>";

						$message = $message . " <tr>";

						$message = $message . "<td bgcolor='#ffffff' style='border-bottom: solid 6px #40383b'>";

						$message = $message . "Dear " . $result[0]->firstname . " " . $result[0]->surname;

						$message = $message . ",<br />

						<br />";

						$message = $message . "<b>Your new password is:</b> " . $result[0]->mpassword . " <br /><br />";

						$message = $message . "

						You can change your password at any time by logging into your account.<br />

						<br />

						Regards,<br />

						Team NCHHW 2018 <br />";

						$message = $message . "</td>";

						$message = $message . " </tr>";

						$message = $message . "  </table>";

						$subject = "New password for " . $result[0]->firstname . "";

						$this->email->set_mailtype("html");
						$this->email->from($data['email'], "New password for " . $result[0]->firstname);
						$this->email->to($data['email']);
						$this->email->subject($subject);
						$this->email->message($message);
						$this->email->send();
						$this->session->set_flashdata('forgotnotify', 'Pssword send to your email.');
						redirect('login');
					}
				} else {
					$this->session->set_flashdata('forgotnotify', 'Email not Valid.');
					redirect('login');
				}
			}

		}
	}

	public function logout() {
		$this->session->unset_userdata('studentlogged_in');

		redirect('/');

	}

}

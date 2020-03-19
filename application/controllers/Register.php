<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Register extends CI_Controller {
	public function index() {
		if ($this->session->userdata('intern')['user_id']) {
			redirect('intern/Dashboard');
		}

		$data['page_title'] = 'Home';
		$this->load->View('header');
		$this->load->View('Register');
		$this->load->View('footer');
	}

	public function take_data_intern() {
		$this->load->model('Register_Model', 'rm');
		$intern_id = 'INT' . rand(1111, 9999);
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$';
		$referrals = 'Intellifybda' . $intern_id;
		if (htmlspecialchars($this->input->post('referal_by'))) {
			$referred_by = htmlspecialchars($this->input->post('referal_by'));
		} else {
			$referred_by = " ";
		}
		// Shufle the $str_result and returns substring
		// of specified length
		date_default_timezone_set('Asia/Kolkata');
		$intern_pass = substr(str_shuffle($str_result), 0, 8);
		$data = array(
			'name' => htmlspecialchars($this->input->post('name')),
			'gender' => htmlspecialchars($this->input->post('gender')),
			'mobile_no' => htmlspecialchars($this->input->post('mobile')),
			'city' => htmlspecialchars($this->input->post('city')),
			'district' => htmlspecialchars($this->input->post('district')),
			'college' => htmlspecialchars($this->input->post('college')),
			'state' => htmlspecialchars($this->input->post('state')),
			'email' => htmlspecialchars($this->input->post('email')),
			'domain' => htmlspecialchars($this->input->post('domain')),
			'user_id' => htmlspecialchars($intern_id),
			'password' => md5($intern_pass),
			'security_question' => htmlspecialchars($this->input->post('security_question')),
			'security_answer' => htmlspecialchars($this->input->post('security_answer')),
			'referral_id' => strtoupper($referrals),
			'referred_by' => strtoupper($referred_by),
			'register_on' => date('Y-m-d h:i:s', time()),
		);

		$flag = 0;
		foreach ($data as $keyword) {
			if (!$keyword) {
				$flag = 1;

				break;

			}
		}

		if ($flag) {
			$cdata = array(
				'message' => 'All fields are not specified',
				'flag' => 2,
			);
			$this->session->set_flashdata('register', $cdata);

			redirect(base_url() . 'Register');
		} else {
			if ($this->rm->read_by_email($data['email'])) {
				$cdata = array(
					'message' => 'Email already exists',
					'flag' => 0,
				);

				$this->session->set_flashdata('register', $cdata);

				redirect(base_url() . 'Register');
				//                    print_r($cdata);
			} else {
				require 'vendor/autoload.php';
				$result = $this->rm->data_intern($data);

				$to = $result[0]->email;
				$cdata = array(
					'message' => 'Successfully Registered & Please wait for approval',
					'flag' => 1,
				);
				// Instantiation and passing `true` enables exceptions
				$mail = new PHPMailer(true);
				// redirect(base_url() . adminpath . '/ApproveSchoolRegistration');
				try {
					//Server settings
					$mail->SMTPDebug = 0; // Enable verbose debug output
					$mail->isSMTP(); // Send using SMTP
					$mail->Host = 'smtp.zoho.com'; // Set the SMTP server to send through
					$mail->SMTPAuth = true; // Enable SMTP authentication
					$mail->Username = 'info@intellify.in'; // SMTP username
					$mail->Password = 'Solve@2020'; // SMTP password
					$mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
					$mail->Port = 465; // TCP port to connect to
					//Recipients
					$mail->setFrom('info@intellify.in', 'Intellify');
					$mail->addAddress($to); // Add a recipient
					$mail->addCC('amardeep.irsc@gmail.com');
					// Content
					$mail->isHTML(true); // Set email format to HTML
					$mail->Subject = 'Registration for Internship | Intellify | An initiative of IIT Delhi students and alumni';
					$message = '<html lang="en-GB"><head>
								<style >
							body,td,div,p,a,input {font-family: arial, sans-serif;}
							</style><style type="text/css">
							body, td {font-size:13px}
							</style></head><body><div class="bodycontainer"><div class="maincontent"><table width=100% cellpadding=0 cellspacing=0 border=0 class="message"><div dir="ltr">Dear Candidate, <br><br><b>Your username and password to login on the portal are:<br>Username: ' . $to . '<br>Password: ' . $intern_pass . '<br></b><br>Please click on the following link to directly go on the portal: <a href="http://intellify.in/Career/login">intellify.in/Career/login</a><br>Intellify along with <b>NSS IIT Delhi</b> and <b>CCL IIT Gandhinagar </b>recently launched National Science &amp; Creativity Program 2020 under <b>iSAFE </b>with the support of <b>5 Union Ministries</b>. <br><br><b>Please go through the following website before clicking on the above link:<br></b><a href="https://sites.google.com/view/teamintellify" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en-GB&amp;q=https://sites.google.com/view/teamintellify&amp;source=gmail&amp;ust=1584084510334000&amp;usg=AFQjCNE3Hea8bwEqpeMwRwaA90YVfaLIUg">https://sites.google.com/view/<wbr>teamintellify</a>  <br> <br><div><div><div><div ><div><div><span>If you think you received this email by mistake, feel free to ignore it.
							</span><font color="#000000" style="background-color:rgb(255,255,255)"><br>Regards,</font></div><div><font color="#000000"><b>Team Intellify</b><br><b>Solve Foundation</b><br></font></div></div></div></div></div></div></div>
							</font></div></table></table></div></div></body></html>';
					$mail->Body = $message;
					$mail->AltBody = strip_tags($message);

					if ($mail->send()) {

						$this->session->set_flashdata('register', $cdata);

						redirect(base_url() . 'Register');

					}

					//whatsapp

					//whatsapp
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}

			}

		}
	}
}
?>
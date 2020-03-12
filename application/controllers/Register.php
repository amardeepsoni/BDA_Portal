<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Register extends CI_Controller {
	public function index() {

		$data['page_title'] = 'Home';
		$this->load->View('header');
		$this->load->View('Register');
		$this->load->View('footer');
	}

	public function take_data_intern() {

		$intern_id = 'INT' . rand(1111, 9999);
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$';
		// Shufle the $str_result and returns substring
		// of specified length
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
		);

		$this->load->model('Register_Model', 'rm');
		$result = $this->rm->data_intern($data);

		$to = $result[0]->email;
		require 'vendor/autoload.php';

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
			$mail->addCC('amardeep.irsc@gmial.com');
			// Content
			$mail->isHTML(true); // Set email format to HTML
			$mail->Subject = ' National Science and Creativity Program 2020 - Student Registration !!';
			$message = '<html><body>Thank You, Your Username : ' . $result[0]->email . '<br> Password : ' . $intern_pass . '</body></html>';
			$mail->Body = $message;
			$mail->AltBody = strip_tags($message);

			if ($mail->send()) {
				redirect(base_url() . 'index.php/Register');

			}
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

	}
}
?>
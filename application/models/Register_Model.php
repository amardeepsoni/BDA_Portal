<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Register_Model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function read_by_email($email = null) {
		return $this->db->select("*")->from('intern_register')->where('email', $email)->get()->row();
	}
	public function data_intern($data) {
		if ($this->db->insert('intern_register', $data)) {
			return $this->db->select('*')->from('intern_register')->where('email', $data['email'])->get()->result();
		}

	}
}
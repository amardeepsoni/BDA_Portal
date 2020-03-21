<?php defined('BASEPATH') or exit('No direct script access allowed');
class Register_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function read_by_email($email = null)
	{
		return $this->db->select("*")->from('intern_register')->where('email', $email)->get()->row();
	}
	public function data_intern($data)
	{
		if ($this->db->insert('intern_register', $data)) {
			$score = array(
				'user_id' => $data['user_id']
			);
			if ($this->db->insert('intern_scoreboard', $score)) {
				return $this->db->select('*')->from('intern_register')->where('email', $data['email'])->get()->result();
			}
		}
	}

	public function logincheck($data)
	{
		$enc_pass = md5($data['password']);
		$condition = "email =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $enc_pass . "'";
		$this->db->select('*');
		$this->db->from('intern_register');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function studentinfo($username)
	{
		$condition = "email =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('intern_register');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
}

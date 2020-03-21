<?php
class Model_admin_login extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function logincheck($data) {

		$this->db->select('*');
		$this->db->from('BDA_admin');
		$this->db->where('username', $data['username'])->where('password', $data['password']);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $this->db->last_query();
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function userinfo($username) {
		$condition = "username =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('BDA_admin');
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
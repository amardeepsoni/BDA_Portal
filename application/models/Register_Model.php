<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Register_Model extends CI_Model {
function __construct() {
parent::__construct();
$this->load->database();
}

public function data_intern($data){
	if($this->db->insert('intern_register', $data)){
		return 'true';
	}
	else{
		return 'false';
	}
}
}
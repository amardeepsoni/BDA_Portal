<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_Model extends CI_Model {
    function __construct() {
		parent::__construct();
		$this->load->database();
	}
    public function fetch_quiz($id){
            return $this->db->select('*')->from('Quiz_Questions')->where('Id', $id)->get()->result();
    }
}
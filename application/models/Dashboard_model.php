<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_Model extends CI_Model {
    function __construct() {
		parent::__construct();
		$this->load->database();
	}
    public function fetch_quiz($id){
            return $this->db->select('*')->from('Quiz_Questions')->where('Id', $id)->get()->result();
    }
    public function check_status($id){
        return $this->db->select('quiz_status')->from('intern_register')->where('user_id', $id)->get()->result();
    }
    public function update_status($id){
       if($this->db->set('quiz_status','1')->where('user_id', $id)->update('intern_register')){
        return $this->db->select('quiz_status')->from('intern_register')->where('user_id', $id)->get()->result();
       }
    }
}
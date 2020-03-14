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
    public function upload_status($url,$id){
        if($this->db->set('profile_link',$url)->where('user_id', $id)->update('intern_register')){
            $this->db->set('upload_status','1')->where('user_id', $id)->update('intern_register');           
        }
    }
    public function check_upload_status($id){
        return $this->db->select('upload_status,profile_link')->from('intern_register')->where('user_id', $id)->get()->result();
    }
}
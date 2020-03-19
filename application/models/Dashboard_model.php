<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function fetch_quiz($id)
	{
		return $this->db->select('*')->from('Quiz_Questions')->where('Id', $id)->get()->result();
	}
	public function check_status($id)
	{
		return $this->db->select('quiz_status')->from('intern_register')->where('user_id', $id)->get()->result();
	}
	public function update_status($id)
	{
		if ($this->db->set('quiz_status', '1')->where('user_id', $id)->update('intern_register')) {
			return $this->db->select('quiz_status')->from('intern_register')->where('user_id', $id)->get()->result();
		}
	}
	public function upload_status($url, $id)
	{
		if ($this->db->set('profile_link', $url)->where('user_id', $id)->update('intern_register')) {
			$this->db->set('upload_status', '1')->where('user_id', $id)->update('intern_register');
		}
	}
	public function check_upload_status($id)
	{
		return $this->db->select('upload_status,profile_link')->from('intern_register')->where('user_id', $id)->get()->result();
	}
	public function takeTask($task)
	{
		$this->db->insert('intern_task', $task);
	}
	public function fetch_tasks($u_id)
	{
		return $this->db->select('*')->from('intern_task')->where('user_id', $u_id)->get()->result();
	}
	public function task_completed($id)
	{
		$this->db->set('completed', '1');
		$this->load->helper('date');
		$now = unix_to_human(gmt_to_local(now(), 'UP55', False));
		$this->db->set('complete_time', $now);
		$this->db->where('id', $id)->update('intern_task');
	}
	public function checkmail($email)
	{
		$count = $this->db->select('email')->from('intern_register')->where('email', $email)->get()->num_rows();
		if ($count == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function checkmail_security_ans($email, $security_ans, $old_password)
	{
		if ($old_password == '') {
			$count = $this->db->select('*')->from('intern_register')->where('email', $email)->where('security_answer', $security_ans)->get()->num_rows();

			if ($count == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			$count = $this->db->select('*')->from('intern_register')->where('email', $email)->where('security_answer', $security_ans)->where('password', md5($old_password))->get()->num_rows();
			if ($count == 1) {
				return true;
			} else {
				return false;
			}
		}
	}
	public function password_update($email, $new_password)
	{
		$this->db->set('password', $new_password);
		$this->db->where('email', $email);
		if ($this->db->update('intern_register')) {
			return true;
		}
	}
	public function update_sol($id, $message)
	{
		$this->db->set('response', $message);
		$this->db->set('completed', '1');
		$this->load->helper('date');
		date_default_timezone_set('Asia/Kolkata');
		$this->db->set('complete_time', date("Y-m-d H:i:s"));
		$this->db->where('id', $id);
		if ($this->db->update('intern_task')) {
			return true;
		}
	}
	public function upload_schools($data)
	{

		print_r($data);
		if ($this->db->insert('intern_school', $data)) {
			return true;
		}
	}
	public function return_school($id)
	{
		$count['number'] = $this->db->select('*')->from('intern_school')->where('user_id', $id)->get()->num_rows();

		$this->db->select('sName');
		$this->db->select('sAddress');
		$this->db->select('sContact');
		$this->db->select('sPerson');
		$this->db->select('no_of_students');
		$this->db->select('add_time');
		$count['info'] = $this->db->from('intern_school')->where('user_id', $id)->get()->result_array();
		return $count;
	}
	public function return_intern($id)
	{
		$this->db->select('id');
		$this->db->select('name');
		$this->db->select('college');
		$this->db->select('city');
		$this->db->select('state');
		$this->db->select('email');
		$this->db->select('domain');
		return $this->db->from('intern_register')->where('user_id', $id)->get()->result();
	}
	public function updateTasks($id)
	{
		$this->db->select('*')->from('intern_task');
		$this->load->helper('date');
		date_default_timezone_set('Asia/Kolkata');
		$time =  date("Y-m-d H:i:s", strtotime('-24 hour', strtotime(date("Y-m-d H:i:s"))));
		$this->db->where('complete_time<=', $time);
		$this->db->where('approved_task', '1');
		$this->db->where('user_id',$id);
		$query_tasks = $this->db->get();
		$count = $query_tasks->num_rows();
		$result = $query_tasks->result();
		// print_r($result);
		while ($count) {
			$count--;
			$result = $query_tasks->result();
			$out = $result[$count];
			if ($this->db->insert('task_history', $out)) {
				if ($this->db->where('id', $out->id)->delete('intern_task'))
					return true;
			} else {
				return false;
			}
		}
	}
}

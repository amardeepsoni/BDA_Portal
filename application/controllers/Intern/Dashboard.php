<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->model('Dashboard_Model', 'dm');
        // session_start();
        $_SESSION['Quiz'] = 5;
        $out['data'] = $this->dm->check_status($this->session->userdata("intern")['user_id']);
        $this->load->View('header');
        $this->load->View('dashboard', $out);
        $this->load->View('footer');
    }

    public function quiz()
    {
        $this->load->model('Dashboard_Model', 'dm');

        $out = $this->dm->check_status($this->session->userdata("intern")['user_id']);
        if (!$out[0]->quiz_status) {
            if ($_SESSION['Quiz'] != 0) {
                $rand = rand(1, 11);
                $result['all_data'] = $this->dm->fetch_quiz($rand);

                $this->load->View('quiz', $result);
            } else {
                echo "<center><h1>Quiz Over!!</h1><br><h4>Confirmation mail will be sent soon.<br>Wait redirecting...</h4></center>";
                $this->dm->update_status($this->session->userdata("intern")['user_id']);
                header("Refresh:5; url= http://localhost/BDA_Portal/intern/dashboard");    //Add whole part for site
            }
        }else{
            redirect('intern/dashboard');
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $_SESSION['Quiz'] = 5;
        $this->load->View('header');
        $this->load->View('dashboard');
        $this->load->View('footer');
    }
    function logout()
    {
    }
    public function quiz()
    {
        $this->load->model('Dashboard_Model', 'dm');

        $out = $this->dm->check_status(22);
        if(!$out[0]->quiz_status){
        if ($_SESSION['Quiz'] != 0) {
            $rand = rand(1, 11);
            $result['all_data'] = $this->dm->fetch_quiz($rand);

            $this->load->View('quiz', $result);
            $_SESSION['Quiz']--;
        } else {
            // echo "Quiz Over!!";
            $this->load->View('quiz');
            $this->dm->update_status(22);
        }
        }else{
            echo "Status Set!!";
        }
    }
}

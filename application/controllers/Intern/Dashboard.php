<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index() {
		$this->load->model('Dashboard_Model', 'dm');
		// session_start();
		$_SESSION['Quiz'] = 5;
		$out['data'] = $this->dm->check_status($this->session->userdata("intern")['user_id']);
		$out['tasks'] = $this->dm->fetch_tasks($this->session->userdata("intern")['user_id']);
		$this->load->View('header');
		$this->load->View('dashboard', $out);
		$this->load->View('footer');
	}

	public function quiz() {
		$this->load->model('Dashboard_Model', 'dm');

		$out = $this->dm->check_status($this->session->userdata("intern")['user_id']);
		if (!$out[0]->quiz_status) {
			// $_SESSION['Quiz'] = 0;    //change
			if ($_SESSION['Quiz'] != 0) {
				$rand = rand(1, 11);
				$result['all_data'] = $this->dm->fetch_quiz($rand);

				$this->load->View('quiz', $result);
			} else {
				echo "<center><br><br><h1>Quiz Over!!</h1><br></center>";
				$this->dm->update_status($this->session->userdata("intern")['user_id']);
				?>
                <center>
                    <br><Br><br>
                    <a href="<?php echo base_url(); ?>uploads/OfferLetter.pdf" download="<?php echo $this->session->userdata("intern")['name'] ?>">
                        <button alt="Offer Letter">
                            <h3>Download Offer Letter</h3>
                        </button>
                    </a>
                    <br><br><Br><br>
                    <button alt="Offer Letter"><a href=" ">
                            <h4>Redirect to home</h4>
                        </a></button>
                </center>
<?php

                // header("Refresh:5; url= " . base_url() . "intern/dashboard");    //Add whole part for site
            }
        } else {
            redirect('intern/dashboard');
        }
    }
    public function upload_id()
    {
        $this->load->model('Dashboard_Model', 'dm');
        if (!$this->dm->check_upload_status($this->session->userdata("intern")['user_id'])['0']->upload_status) {
            if ($_FILES['file']['size']) {
                $this->load->library('S3');
                $ext = pathinfo(basename($_FILES['file']['name']), PATHINFO_EXTENSION);
                if ($_FILES["file"]["size"] > 5000000) {            //approx 50mb
                    echo "<center><br><br><h1>Sorry, your file is too large!!</h1><br><h4>Try Again with smaller size!!<br>Wait redirecting...</h4></center>";
                    header("Refresh:3; url= " . base_url() . "intern/dashboard");
                    exit;
                }
                if ($ext != "png" && $ext != "jpeg" && $ext != "jpg" && $ext != "PNG" && $ext != "JPEG" && $ext != "JPG" && $ext != "pdf" && $ext != "PDF") {
                    echo "<center><br><br><h1>Sorry, your file type not supported!!</h1><br><h4>Try Again!!<br>Wait redirecting...</h4></center>";
                    header("Refresh:3; url= " . base_url() . "intern/dashboard");
                    exit;
                }
                $target_dir = "application\controllers\Intern\uploads/";
                $target_file = $target_dir . $this->session->userdata("intern")['user_id'] . '.' . $ext;
                $url = base_url() . $target_file;

                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    // echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                    echo "<center><br><br><h1>Your file uploaded!!</h1><br><h4>Wait redirecting...</h4></center>";
                    $task = array('user_id' => $this->session->userdata("intern")['user_id'], 'topic' => "First Task to do", 'description' => "Contact and register details for 3 schhool. Click above add school to add details.");
                    $this->load->helper('date');
                    date_default_timezone_set('Asia/Kolkata');
                    $task['add_time'] = date("Y-m-d H:i:s");
                    $this->dm->takeTask($task);
                    header("Refresh:3; url= " . base_url() . "intern/dashboard");
                    $this->dm->upload_status($url, $this->session->userdata("intern")['user_id']);
                } else {
                    echo "<center><br><br><h1>Sorry, there was an error uploading your file.</h1><br><h4>Try Again after some time!!<br>Wait redirecting...</h4></center>";
                    header("Refresh:3; url= " . base_url() . "intern/dashboard");
                }
            }
        } else {
            echo "<center><br><br><h1>File already Uploaded!!</h1><br>Wait redirecting...</h4></center>";
            header("Refresh:3; url= " . base_url() . "intern/dashboard");            
        }
    }
    function task_completed($id)
    {
        $this->load->model('Dashboard_Model', 'dm');
        $this->dm->task_completed($id);
        echo "<center><br><br><h1>Your Response marked!!</h1><br><h4>Wait redirecting...</h4></center>";
        header("Refresh:3; url= " . base_url() . "intern/dashboard");
    }
    public function upload_task($id)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['solution'] = $this->input->post('solution');
        }
        echo "Hello";
        echo $data['solution'];
        $this->load->model('Dashboard_Model', 'dm');
        // $out['data'] = $this->dm->check_status($this->session->userdata("intern")['user_id']);
        // $out['tasks'] = $this->dm->fetch_tasks($this->session->userdata("intern")['user_id']);
        if ($this->dm->update_sol($id, $data['solution'])) {
            redirect('intern/dashboard');
        }
    }
    public function upload_school()
    {
        $this->load->View('header');
        $this->load->View('intern/upload_school');
        $this->load->View('footer');
    }
    function uploaded_school()
    {
        $data = array(
            'sName' => htmlspecialchars($this->input->post('name')),
            'sAddress' => htmlspecialchars($this->input->post('address')),
            'sContact' => htmlspecialchars($this->input->post('contact')),
            'sPerson' => htmlspecialchars($this->input->post('cPerson')),
            'user_id' => $this->session->userdata("intern")['user_id'],
        );
        $this->load->model('Dashboard_Model', 'dm');
        if ($this->dm->upload_schools($data)) {
            redirect('intern/dashboard');
        }
    }
    public function viewSchool(){
        $this->load->model('Dashboard_Model', 'dm');
        $result['data'] =  $this->dm->return_school($this->session->userdata('intern')['user_id']);
        $this->load->View('header');
        $this->load->View('intern/view_school',$result);
        $this->load->View('footer');
    }
}
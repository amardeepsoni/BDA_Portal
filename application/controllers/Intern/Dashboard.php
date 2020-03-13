<?php
defined('BASEPATH') or exit('No direct script access allowed');

<<<<<<< HEAD
class Dashboard extends CI_Controller {
	public function index() {
		$_SESSION['Quiz'] = 5;
		$this->load->View('header');
		$this->load->View('dashboard');
		$this->load->View('footer');
	}
	function logout() {
	}
	public function quiz() {
		$this->load->model('Dashboard_Model', 'dm');

		$out = $this->dm->check_status(22);
		if (!$out[0]->quiz_status) {
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
		} else {
			echo "Status Set!!";
		}
	}
=======
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
                    <a href="http://localhost/BDA_Portal/uploads/OfferLetter.pdf" download="<?php echo $this->session->userdata("intern")['name'] ?>">
                        <button alt="Offer Letter"><h3>Download Offer Letter</h3></button>
                    </a>
<br><br><Br><br>
                    <button alt="Offer Letter"><a href=" "><h4>Redirect to home</h4></a></button>
                </center>
<?php
                // header("Refresh:5; url= " . base_url() . "/intern/dashboard");    //Add whole part for site
            }
        } else {
            redirect('intern/dashboard');
        }
    }
<<<<<<< HEAD
    public function upload_id()
    {
        if ($_FILES['file']['size']) {
            $this->load->library('S3');
            $ext = pathinfo(basename($_FILES['file']['name']), PATHINFO_EXTENSION);
            if ($_FILES["file"]["size"] > 5000000) {            //approx 50mb
                echo "<center><br><br><h1>Sorry, your file is too large!!</h1><br><h4>Try Again with smaller size!!<br>Wait redirecting...</h4></center>";
                header("Refresh:3; url= " . base_url() . "/intern/dashboard");
                exit;
            }
            if ($ext != "png" && $ext != "jpeg" && $ext != "jpg" && $ext != "PNG" && $ext != "JPEG" && $ext != "JPG" && $ext != "pdf" && $ext != "PDF") {
                echo "<center><br><br><h1>Sorry, your file type not supported!!</h1><br><h4>Try Again!!<br>Wait redirecting...</h4></center>";
                header("Refresh:3; url= " . base_url() . "/intern/dashboard");
                exit;
            }
            $target_dir = "application\controllers\Intern\uploads/";
            $target_file = $target_dir . $this->session->userdata("intern")['user_id'] . '.' . $ext;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                echo "<center><br><br><h1>Your file uploaded!!</h1><br><h4>Wait redirecting...</h4></center>";
                header("Refresh:3; url= " . base_url() . "/intern/dashboard");
            } else {
                echo "<center><br><br><h1>Sorry, there was an error uploading your file.</h1><br><h4>Try Again after some time!!<br>Wait redirecting...</h4></center>";
                header("Refresh:3; url= " . base_url() . "/intern/dashboard");
            }
        }
    }
=======
>>>>>>> bb94866e2b8634092e3adfdaabd45f55ef083da2
>>>>>>> 6658482c87ccc2932149b549316ceb240bda3111
}

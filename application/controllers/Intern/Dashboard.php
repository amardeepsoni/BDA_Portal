<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->model('Dashboard_Model', 'dm');
        // session_start();
        $_SESSION['Quiz'] = 5;
        $out['data'] = $this->dm->check_status($this->session->userdata("intern")['user_id']);
        $out['tasks'] = $this->dm->fetch_tasks($this->session->userdata("intern")['user_id']);
        $this->load->View('header');
        $this->load->View('dashboard', $out);
        $this->load->View('footer');
    }


    public function quiz()
    {
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
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
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
        $this->load->model('Dashboard_Model', 'dm');
        if (!$this->dm->check_upload_status($this->session->userdata("intern")['user_id'])['0']->upload_status) {
            if ($_FILES['file']['size']) {
                $this->load->library('S3');
                $ext = pathinfo(basename($_FILES['file']['name']), PATHINFO_EXTENSION);
                if ($_FILES["file"]["size"] > 5000000) {
                    //approx 50mb
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
                    echo "<center><br><br><h1>Your file uploaded!!</h1><br></center>";
                    //mail

                    $this->load->model('Dashboard_Model', 'dm');
                    $result_int = $this->dm->return_intern($this->session->userdata('intern')['user_id']);
                    require 'vendor/autoload.php';
                    $info_int = $result_int['0'];
                    $to = $info_int->email;

                    $subject = "Intern Id Card of" . $info_int->name;
                    $message = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                        </head>
                        <body style="">
                        <table style="width: 500px;height: 700px; background:url(http://call2repairstore.000webhostapp.com/image/bg.png); ">
                        <tr>
                        <td style="text-align: center;"  colspan="2">
                            <img src="http://call2repairstore.000webhostapp.com/image/logo.png" style="width: 200px; height: 200px;">
                        </td>
                        </tr>
                        <tr>
                        <td style="text-align: center;" colspan="2">
                            <center style="font-size: 22px; color: white; text-transform: uppercase; font-family: sans-serif;">' . $info_int->name . '</center>
                            <center style="font-size: 15px; color: white; text-transform: uppercase;font-family: sans-serif;">' . $info_int->state . '</center>
                            <br>
                            <center style="font-size: 25px; color: white; text-transform: uppercase;font-family: sans-serif;text-decoration: underline;">' . $info_int->domain . '</center>
                        </td>
                        </tr>
                        <tr>
                        <td style="text-align: center; font-size: 30px;" colspan="2">
                                NSCP 20
                        </td>
                        </tr>
                        <tr>
                        <td style="text-align: center;" colspan="2">
                            <br>
                            <br>
                            <br>
                            <br>

                            <img src="http://call2repairstore.000webhostapp.com/image/signature.png">
                        </td>
                        </tr>
                        <tr>
                        <td  colspan="2">
                            <hr style="width: 100%;height: 1px;background: black;">
                            <center style="font-family: sans-serif;font-size: 18px;">(Amar Srivastava, President, Intellify)</center>

                        </td>
                        </tr>
                        <tr style="display: flex;flex-direction: row; justify-content: center;align-items: center;width: 100%;">

                        <td style="width: 50%; text-align: center;border: none;border-top: 2px solid black!important;display: flex;justify-content: center;align-items: center;">

                        <img src="https://cdn1.iconfinder.com/data/icons/seo-and-web-set-1/100/Untitled-2-24-41-512.png" style="width: 30px; height: 30px;"> info@intellify.in


                        </td>
                        <td style=" width: 50%; text-align: center;border: none;border-top: 2px solid black!important;display: flex;justify-content: center;align-items: center;">
                            <img src="https://www.freeiconspng.com/uploads/black-www-icon-17.png" style="width: 30px; height: 30px;"> www.intellify.in</div>
                        </td>
                        </tr>

                        </table>
                        </body>
                        </html>
                        ';
                    // echo $message;
                    // Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    try {
                        //Server settings
                        $mail->SMTPDebug = 0; // Enable verbose debug output
                        $mail->isSMTP(); // Send using SMTP
                        $mail->Host = 'smtp.zoho.com'; // Set the SMTP server to send through
                        $mail->SMTPAuth = true; // Enable SMTP authentication
                        $mail->Username = 'info@intellify.in'; // SMTP username
                        $mail->Password = 'Solve@2020'; // SMTP password
                        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                        $mail->Port = 465; // TCP port to connect to
                        //Recipients
                        $mail->setFrom('info@intellify.in', 'Intellify');
                        $mail->addAddress($to); // Add a recipient
                        $mail->addCC('amardeep.irsc@gmail.com');
                        // Content
                        $mail->isHTML(true); // Set email format to HTML
                        $mail->Subject = $subject;

                        $mail->Body = $message;
                        // $mail->AltBody = strip_tags($message);

                        if ($mail->send()) {
                            echo "<center><br><br><h1>Your ID card is mailed!!</h1>Check you mail.<br><h4>Wait redirecting... " . $this->session->userdata('intern')['email'] . "</h4></center>";
                            header("Refresh:3; url= " . base_url() . "intern/dashboard");
                        }
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    //mail

                    $task = array('user_id' => $this->session->userdata("intern")['user_id'], 'topic' => "First Task to do", 'description' => "Contact and register details for 3 schhool. Click above add school to add details.");
                    $this->load->helper('date');
                    date_default_timezone_set('Asia/Kolkata');
                    $task['add_time'] = date("Y-m-d H:i:s");
                    $this->dm->takeTask($task);
                    $this->dm->upload_status($url, $this->session->userdata("intern")['user_id']);
                    header("Refresh:3; url= " . base_url() . "intern/dashboard");
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
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
        $this->load->model('Dashboard_Model', 'dm');
        $this->dm->task_completed($id);
        echo "<center><br><br><h1>Your Response marked!!</h1><br><h4>Wait redirecting...</h4></center>";
        header("Refresh:3; url= " . base_url() . "intern/dashboard");
    }
    public function upload_task($id)
    {
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
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
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
        $this->load->View('header');
        $this->load->View('intern/upload_school');
        $this->load->View('footer');
    }
    function uploaded_school()
    {
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
        $data = array(
            'sName' => stripslashes(strip_tags($this->input->post('name'))),
            'sAddress' => stripslashes(strip_tags($this->input->post('address'))),
            'sContact' => stripslashes(strip_tags($this->input->post('contact'))),
            'sPerson' => stripslashes(strip_tags($this->input->post('cPerson'))),
            'user_id' => $this->session->userdata("intern")['user_id'],
        );
        $this->load->model('Dashboard_Model', 'dm');
        if ($this->dm->upload_schools($data)) {
            redirect('intern/dashboard');
        }
    }
    public function viewSchool()
    {
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
        $this->load->model('Dashboard_Model', 'dm');
        $result['data'] = $this->dm->return_school($this->session->userdata('intern')['user_id']);
        $this->load->View('header');
        $this->load->View('intern/view_school', $result);
        $this->load->View('footer');
    }
    public function id()
    {
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
        $this->load->model('Dashboard_Model', 'dm');
        $result['data'] = $this->dm->return_intern($this->session->userdata('intern')['user_id']);
        $this->load->View('intern/id', $result);
    }
    function downloadData()
    {
        if (!$this->session->userdata('intern')['user_id']) {
            redirect(base_url());
        }
        // get data 
        $this->load->model('Dashboard_Model', 'dm');
        $users =  $this->dm->return_school($this->session->userdata('intern')['user_id']);
        // print_r($users);
        $usersData = $users['info'];

        // file name 
        $filename = 'SchoolList' . $this->session->userdata('intern')['user_id'] . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("Name of the School     ", "School Address   ", "Contact Details     ", "Contact Person   ", "Number of Registered Students", "Schhol Added on     ");
        fputcsv($file, $header);
        foreach ($usersData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }
}

<?php
if (!$this->session->userdata("intern")['user_id']) {
    redirect('/');
}
$tasks = $all_task['tasks'];
?>

<head>
    <style>
        .list-group-item-action {
            color: #000;
            background-color: #fff;
        }

        #task_topic.checked {
            background: #888;
            color: #fff;
            text-decoration: line-through;
        }

        .list-group-item-info.list-group-item-action.active {
            color: #000;
            background-color: #bee5eb;
        }
    </style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>
<?php foreach ($tasks as $task) {

    if ($task->disapproved == 1) { ?>
        <script type="text/javascript">
            swal("A task disapproved by admin", "Please check your message...", "warning");
        </script>
<?php }
    break;
} ?>

</head>

<div class="container-fluid" style="margin: 0;padding: 0;">
    <?php
    $this->load->model('Dashboard_Model', 'dm');
    $query_out = $this->dm->check_upload_status($this->session->userdata("intern")['user_id']);
    if ($query_out['0']->upload_status) {
    ?>
        <div class="container-fluid" style="margin: 0;padding: 0;">
            <div style="background: #9796f0;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #fbc7d4, #9796f0);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #fbc7d4, #9796f0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
;position: absolute;width: 100%;height: 350px;">
                <div class="">
                    <div class="col-sm-12">
                        <div class="row p-3">
                            <div class="col-sm-3 p-2" style=" ">
                                <div class="card" style="background: #eee;height: 200px;">
                                    <div class="card-body bg-white p-3">

                                        <div style="width: 100%;display: flex;justify-content: space-between;align-items:center;">
                                            <div class="text-secondary font-weight-bold" style="text-transform: capitalize;color:grey !important;"><?php echo 'Hi, ' . $this->session->userdata('intern')['name']; ?></div>
                                            <div class="rounded-circle" style="border: 1px solid white;width: 50px; height: 50px; display: flex;justify-content: center;align-items: center;background: #9796f0;  background:-webkit-linear-gradient(to right, #fbc7d4, #9796f0);  background:linear-gradient(to right, #fbc7d4, #9796f0); "><i class='fas fa-user' style='font-size:24px; color: white;'></i>
                                            </div>
                                        </div>
                                        <div class="text-primary" style="width: 100%;padding:0.5rem 0;">

                                            <font style="font-size: 0.9em;color:grey;">Intern ID : <span style="color:skyblue;font-size:1rem;"><?php echo $this->session->userdata('intern')['user_id']; ?></span></font><br>
                                            <font style="font-size: 0.9em;color:grey;">Domain : <span style="color:skyblue;font-size:1rem;"><?php echo $this->session->userdata('intern')['domain']; ?></span></font>
                                        </div>
                                        <div class="" style="width: 100%;">
                                            <img src="https://img.icons8.com/cute-clipart/64/000000/calendar.png" style="width: 30px; height: 30px;" /><span style="font-size:0.9rem;color:grey;">Joining Date </span>: <span style="color:skyblue;font-size:1rem;"><?php echo $this->session->userdata('intern')['register_on']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 p-2" style="">
                                <div class="card" style="background: #eee; height: 200px;">
                                    <a class="card-body  bg-white p-3" style="text-decoration: none;">
                                        <div style="width: 100%;display: flex;justify-content: space-between; align-items:center;">
                                            <div class="text-secondary font-weight-bold">List your registered school!</div>
                                            <div class="rounded-circle" style="border: 1px solid white;width: 50px; height: 50px; display: flex;justify-content: center;align-items: center;background: #9796f0;  background:-webkit-linear-gradient(to right, #fbc7d4, #9796f0);  background:linear-gradient(to right, #fbc7d4, #9796f0); "><i class='fas fa-list-alt' style='font-size:24px; color: white;'></i></div>
                                        </div>                                      
                                        <div class="py-3" style="width: 100%; color:grey; font-size:0.9rem;">
                                            Schools: <span style="color:skyblue;font-size:1rem;"><?php
                                                        $this->load->model('Dashboard_Model', 'dm');
                                                        echo $this->dm->return_school($this->session->userdata('intern')['user_id'])['number'];
                                                        ?>
                                                        </span>
                                        </div>
                                        <div class="d-flex" style="justify-content:space-between;">
                                            <button type="button" data-toggle="modal" data-target="#schoolModal" class="btn btn-success" style="font-size:0.9rem; padding:0.2rem 1rem !important; margin-top:0.5rem;margin-right:0.5rem;">Add School</button>
                                            <button type="button" onclick="window.location.href='InternDashboard/viewSchool'" class="btn btn-info" style="font-size:0.9rem;padding:0.2rem 1rem !important; margin-top:0.5rem;margin-right:0.5rem;">View School</button>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-sm-3 p-2">
                                <div class="card" style="background: #eee;height: 200px;">
                                    <div class="card-body  bg-white p-3">
                                        <div style="width: 100%;display: flex;justify-content: space-between; align-items:center;">
                                            <div class="text-secondary font-weight-bold">Referral Id</div>
                                            <div class="rounded-circle" style="border: 1px solid white;width: 50px; height: 50px; display: flex;justify-content: center;align-items: center;background: #9796f0;  background:-webkit-linear-gradient(to right, #fbc7d4, #9796f0);  background:linear-gradient(to right, #fbc7d4, #9796f0); "><i class='fa fa-share-alt' style='font-size:24px; color: white;'></i></div>
                                        </div>
                                        <div class="text-primary" style="font-size: 1.5em; width: 100%;">
                                            <?php echo $this->session->userdata('intern')['referral_id']; ?>
                                        </div>

                                        <div class="" style="width: 100%;">
                                            <a style="font-size:0.9rem; padding:0.2rem 1rem !important; margin-top:0.5rem; margin-right:0.5rem" class="btn btn-success" href="https://api.whatsapp.com/send?phone=+91<?php echo $this->session->userdata('intern')['mobile_no']; ?>&text=Intellify career referal : <?php echo $this->session->userdata('intern')['referral_id']; ?>" target="_blank"><i class='fab fa-whatsapp' style='font-size:20px'></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 p-2" style="">
                                <div class="card" style="background: #eee;height: 200px;">
                                    <div class="card-body  bg-white p-3">
                                        <div style="width: 100%;display: flex;justify-content: space-between; align-items:center;">
                                            <div class="text-secondary font-weight-bold">Your Signed Doc</div>
                                            <div class="rounded-circle" style="border: 1px solid white;width: 50px; height: 50px; display: flex;justify-content: center;align-items: center;background: #9796f0;  background:-webkit-linear-gradient(to right, #fbc7d4, #9796f0);  background:linear-gradient(to right, #fbc7d4, #9796f0); "><i class='fas fa-file-pdf' style='font-size:24px;color:white;'></i></i></div>
                                        </div>
                                        <div>

                                            <a href="<?php echo $query_out['0']->profile_link; ?>" target="_blank" class="btn btn-success" style="font-size:0.9rem; padding:0.2rem 1rem !important; margin-top:0.5rem; margin-right:0.5rem">Check File Once!!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- schhol modal-->
                <div class="modal fade" id="schoolModal" tabindex="-1" role="dialog" aria-labelledby="schoolModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="schoolModalLabel">Enter School Details:</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="InternDashboard/uploaded_school" method="POST">
                                    <div class="form-group">
                                        <label for="name">School Name</label>
                                        <input required type="text" class="form-control bg-grey" id="name" pattern="[A-Za-z ]{5,20}" name="name" aria-describedby="Help" placeholder="Enter School Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="school address"> School Address</label>
                                        <input required type="text" class="form-control" id="school address" pattern="[A-Za-z-0-9, ]{5,30}" name="address" aria-describedby="Help" placeholder="Enter school address">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact</label>
                                        <input required type="tel" pattern="[0-9]{10}" class="form-control" id="contact" name="contact" aria-describedby="Help" placeholder="Enter conatct details">
                                    </div>
                                    <div class="form-group">
                                        <label for="cPerson">Contact Person Name</label>
                                        <input required type="text" class="form-control" id="cPerson" pattern="[A-Za-z ]{5,20}" name="cPerson" aria-describedby="Help" placeholder="Enter contact person's name">
                                    </div>
                                    <div class="form-group">
                                        <label for="number">Number of students regitered:</label>
                                        <input required type="number" class="form-control" pattern="[0-9]{2,4}" id="number" name="number" aria-describedby="Help" placeholder="Enter Number of students regitered">
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg" type="submit">Submit Details</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- school modal ends -->
                <div class="col-sm-12 mt-3" style="">
                    <div class="row p-3">
                        <div class="col-sm-8 p-3" style="">
                            <div class="card" style="width: 100%; height: 500px; background: #eee;box-shadow: 2px 1px 20px rgba(0,0,0,0.2)">
                                <div class="card-header list-group-item-info py-4" style="border:none;font-weight:bold; background:#FBC7D4;">
                                    To do list <?php echo "<b>&nbsp;&nbsp;&nbsp;#</b>" . $all_task['count']; ?>
                                </div>
                                <div class="card-body p-0" style="background: #eee; overflow: auto; overflow-x: hidden;">
                                    <div class="list-group-flush list-group" id="list-tab" role="tablist">
                                        <?php if ($tasks) {
                                            foreach ($tasks as $list) {
                                        ?>
                                                <a class="list-group-item m-1 list-group-item-action list-group-item-info" data-toggle="list" href="#list-<?php echo $list->id ?>" role="tab" aria-controls="<?php echo $list->id ?>">
                                                    <div class="d-flex w-100" >
                                                        <div class="" id="list-<?php echo $list->id ?>" style="width:70%;">
                                                            <div id="task_topic<?php echo $list->id ?>" <?php if ($list->completed) {
                                                                                                            echo 'style="text-decoration: line-through; " ';
                                                                                                        }
                                                                                                        ?>>
                                                                <?php echo $list->topic; ?>
                                                            </div>
                                                            <?php if ($list->disapproved) {
                                                                echo '&nbsp;&nbsp;<span class="badge badge-pill badge-danger">Disapproved Task</span>';
                                                            }
                                                            if ($list->seen) {
                                                                echo '&nbsp;&nbsp;<span class="badge badge-pill badge-info">Task seen</span>';
                                                            } ?>

                                                        </div>
                                                        
                                                        <div class="justify-content-end ml-auto">
                                                            <?php if ($list->approved_task) { ?>
                                                                <button type="button" class="btn btn-success mt-3" disabled>Approved</button>
                                                            <?php } else {
                                                            ?>
                                                                <button type="button" style="font-size:0.9rem;padding:0.2rem 1rem !important;"class=" btn btn-info mt-3" <?php if ($list->completed) {
                                                                                                                echo 'disabled';
                                                                                                            }
                                                                                                            ?> data-toggle="modal" data-target="#modalCenter"<?php echo $list->id ?>>
                                                                    Submit task
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <small <?php if ($list->completed) {
                                                                echo 'style="text-decoration: line-through; " ';
                                                            }
                                                            ?>><?php echo $list->add_time; ?></small>
                                                    <div id="task_description<?php echo $list->id ?>" class="p-2 border" style="display: none; background-color:#fff; ">
                                                        <?php echo $list->description;
                                                        if ($task->disapproved) {
                                                            echo "<hr><b>Suggestion:</b><br>" . $task->suggestion;
                                                        }
                                                        ?>
                                                    </div>
                                                </a>
                                            <?php }
                                        } else { ?>
                                            <a href="#" class="list-group-item  list-group-item-action list-group-item-info">No task available</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-footer text-right px-4">
                                    <a href="<?php echo base_url(); ?>Intern/InternDashboard/taskHistory" class="btn btn-outline-dark"> History</a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <?php foreach ($tasks as $list) { ?>
                            <div class="modal fade" id="modalCenter<?php echo $list->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCenterTitle">Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="InternDashboard/upload_task/<?php echo $list->id ?>" method="POST">
                                            <div id="task_sol" class="modal-body">
                                                <label for="task_sol">Enter your message below:</label>
                                                <textarea pattern="[A-Za-z. ]{5,20}" id="task_sol" rows="6" cols="45" name="solution" required></textarea>
                                            </div>
                                            <button type="submit" class="m-0 btn-block p-3 btn-success">Submit Task</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- modal closed -->
                        <div class="col-sm-4 p-3" style="">
                            <div class="card list-group-item-info" style="width: 100%; height: 500px; background: #fff;">
                                <div class="card-header py-4" style="border:none;font-weight:bold; background:white;"> 
                                    Leader Scoreboard <?php echo "<b>#</b>" . $score['count']; ?>
                                </div>
                                <div class="card-body p-1" style="overflow: auto; overflow-x: hidden;">
                                    <div><?php $this->load->View('intern/leaderscore', $score); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } else if ($data['0']->quiz_status) { ?>

        <div class="container p-3">
            <h3>Upload your documents, <?php echo $this->session->userdata("intern")['name']; ?></h3>
            If, You are failed to download please download again your offer letter.<a href="<?php echo base_url(); ?>uploads/OfferLetter.pdf" download="<?php echo $this->session->userdata("intern")['name'] ?>">download</a>
            <h5>Instruction:-</h5>
            <ul>
                <li>
                    Ulpoad your Governemnt Id and Offer letter in a single pdf.
                </li>
            </ul>
            <form action="InternDashboard/upload_id" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input class="btn btn-outline-primary" type="file" name="file" id="fileToUpload">
                <input class="btn btn-info" type="submit" value="Upload Image" name="submit">
            </form>
        </div>

    <?php } else { ?>

        <div class="container p-3">
            <h3 class="p-3">To start Quiz click below,</h3>
            <a href="InternDashboard/quiz"><button type="button" class="btn btn-primary">Start Quiz</button></a>
        </div>
    <?php } ?>
</div>

<!-- scripts -->
<script>
    $(document).ready(function() {
        <?php foreach ($tasks as $list) { ?>
            $("#list-<?php echo $list->id ?>").click(function() {
                $("#task_description<?php echo $list->id ?>").toggle();

                <?php
                if (!$list->seen) { ?>
                    window.location.href = "InternDashboard/taskSeen/<?php echo $list->id ?>";
                <?php } ?>
            });
        <?php } ?>
    });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
if (!$this->session->userdata("intern")['user_id']) {
    redirect('/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .list-group-item.active {
            color: #000;
            background-color: #fff;
        }
    </style>
</head>

<body>

    <div class="container-fluid p-4" style="height: 80vh;">
        <?php
        $this->load->model('Dashboard_Model', 'dm');
        $query_out = $this->dm->check_upload_status($this->session->userdata("intern")['user_id']);
        if ($query_out['0']->upload_status) { ?>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 p-3" style=" ">
                                <div class="card" style="background: #eee;">
                                    <div class="card-body">

                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <div class="text-secondary font-weight-bold" style="text-transform: capitalize;"><?php echo 'Hi, ' . $this->session->userdata('intern')['name']; ?></div>
                                            <div class="rounded-circle" style="border: 1px solid white;width: 50px; height: 50px; display: flex;justify-content: center;align-items: center;background: #007991;  background: -webkit-linear-gradient(to right, #78ffd6, #007991);  background: linear-gradient(to right, #78ffd6, #007991); "><i class='fas fa-user' style='font-size:24px; color: white;'></i>
                                            </div>
                                        </div>
                                        <div class="text-primary" style="width: 100%;">

                                            <font style="font-size: 1.5em;">Intern ID : <?php echo $this->session->userdata('intern')['user_id']; ?></font><br>
                                            <font style="font-size: 1em;"><?php echo $this->session->userdata('intern')['domain']; ?></font>,
                                        </div>
                                        <div class="" style="width: 100%;">
                                            Joining Date : <?php echo $this->session->userdata('intern')['register_on']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 p-3" style="">
                                <div class="card" style="background: #eee; height:150px;">
                                    <div class="card-body">
                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <div class="text-secondary font-weight-bold">Users</div>
                                            <div class="rounded-circle" style="border: 1px solid white;width: 50px; height: 50px; display: flex;justify-content: center;align-items: center;background: #007991;  background: -webkit-linear-gradient(to right, #78ffd6, #007991);  background: linear-gradient(to right, #78ffd6, #007991); "><i class='fas fa-user' style='font-size:24px; color: white;'></i></div>
                                        </div>
                                        <div class="" style="width: 100%;">
                                            78,988
                                        </div>
                                        <div class="" style="width: 100%;">
                                            3.48% Since last month
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 p-3" style="">
                                <div class="card" style="background: #eee; height:150px;">
                                    <div class="card-body">
                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <div class="text-secondary font-weight-bold">Users</div>
                                            <div class="rounded-circle" style="border: 1px solid white;width: 50px; height: 50px; display: flex;justify-content: center;align-items: center;background: #007991;  background: -webkit-linear-gradient(to right, #78ffd6, #007991);  background: linear-gradient(to right, #78ffd6, #007991); "><i class='fas fa-user' style='font-size:24px; color: white;'></i></div>
                                        </div>
                                        <div class="" style="width: 100%;">
                                            78,988
                                        </div>
                                        <div class="" style="width: 100%;">
                                            3.48% Since last month
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 p-3" style="">
                                <div class="card" style="background: #eee;height:150px;">
                                    <div class="card-body">
                                        <div style="width: 100%;display: flex;justify-content: space-between;">
                                            <div class="text-secondary font-weight-bold">Your Signed Doc</div>
                                            <div class="rounded-circle" style="border: 1px solid white;width: 50px; height: 50px; display: flex;justify-content: center;align-items: center;background: #007991;  background: -webkit-linear-gradient(to right, #78ffd6, #007991);  background: linear-gradient(to right, #78ffd6, #007991); "><i class='fas fa-file-pdf' style='font-size:24px;color:white;'></i></i></div>
                                        </div>
                                        <div>

                                            <a href="<?php echo $query_out['0']->profile_link; ?>" target="_blank" class="btn btn-success">Check File Once!!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12" style="">
                        <div class="row">
                            <div class="col-sm-8 p-3" style="">
                                <div class="card list-group-item-info" style="width: 100%; height: 400px;background: #fff;">
                                    <div class="card-header ">
                                        Task Details
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="nav-tabContent">
                                            <?php foreach ($tasks as $list) { ?>
                                                <div class="tab-pane fade" id="list-<?php echo $list->id ?>" role="tabpanel" aria-labelledby="list-<?php echo $list->id ?>e-list">
                                                    <?php echo $list->description; ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 p-3" style="">
                                <div class="card" style="width: 100%; background: #eee;">
                                    <div class="card-header list-group-item-info">
                                        To do list
                                    </div>
                                    <div class="card-body p-0" style="background: #eee;">
                                        <div class="list-group-flush list-group" id="list-tab" role="tablist">
                                            <?php foreach ($tasks as $list) { ?>
                                                <a class="list-group-item  list-group-item-action list-group-item-info" id="list-<?php echo $list->id ?>-list" data-toggle="list" href="#list-<?php echo $list->id ?>" role="tab" aria-controls="<?php echo $list->id ?>">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <div>
                                                            <?php echo $list->topic; ?>
                                                        </div>
                                                        <button class="btn btn-info" onclick="document.location = 'dashboard/task_completed/<?php echo $list->id ?>'" <?php if ($list->completed) { ?> disabled <?php } ?>>Complete</button>
                                                    </div>
                                                    <small><?php echo $list->add_time ?></small>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if ($data['0']->quiz_status) { ?> <h3>Upload your documents, <?php echo $this->session->userdata("intern")['name']; ?></h3>
            If, You are failed to download please download again your offer letter.<a href="<?php echo base_url(); ?>uploads/OfferLetter.pdf" download="<?php echo $this->session->userdata("intern")['name'] ?>">download</a>
            <h5>Instruction:-</h5>
            <ul>
                <li>
                    Ulpoad your Governemnt Id and Offer letter in a single pdf.
                </li>
            </ul>
            <form action="dashboard/upload_id" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input class="btn btn-outline-primary" type="file" name="file" id="fileToUpload">
                <input class="btn btn-info" type="submit" value="Upload Image" name="submit">
            </form>

        <?php } else { ?>

            <h3 class="p-3">To start Quiz click below,</h3>
            <a href="dashboard/quiz"><button type="button" class="btn btn-primary">Start Quiz</button></a>

        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
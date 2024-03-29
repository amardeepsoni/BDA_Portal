<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php if ($page_title) {echo $page_title;} else {echo "Career";}?></title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900|Rubik:300,400,700&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favlogo.png" type="image/png" sizes="16x16">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/style_home/style1.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/dashboard/admindash.css" rel="stylesheet">

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://kit.fontawesome.com/0a7a557465.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <style>
    .dropdown-content {
      display: none;
      width:100% !important;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      padding: 12px 16px;
      z-index: -1;
      padding-top:2rem;
    }

    .dropdown:hover .dropdown-content {
      width:100%;
      display: inline-block;
    }
    .dropdown-item{
      padding: 5px;

    }
    .drop-btn{
      z-index:10 !important;
      background-color:#F8F9FA !important;
    }
    .drop-btn span{
      background-color:#F8F9FA !important;
      color:#93D2DC !important;
    }


  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>images/logocareer.png" style="width: 216px;height: 83px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav ml-auto mr-4">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>Career"> Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>/about"> About Us </a>
        </li>
        <?php if ($this->session->userdata('admin_login')) {?>
          <li>
        <div class="dropdown" style=" margin-right: 90px;">
          <a href="<?php echo base_url(); ?>bdaadmin/Dashboard" class="btn btn-outline-info nav-link mt-3">
          <font style="text-transform: capitalize; padding:0.5rem;"><?php echo 'Hi, ' . $this->session->userdata('admin_login')['name']; ?></font>Admin
          </a>&nbsp;
          <div class="dropdown-content" aria-labelledby="dropdownMenuLink" style="background:#fff;z-index: 9999;">
            <a class="dropdown-item" href="#">Support</a><hr>
          <a class="dropdown-item" href="<?php echo base_url(); ?>bdaadmin/Login/logout" class="btn btn-outline-danger nav-link">Log Out</a>&nbsp;
          </div>
          </div>
        </li>
        <?php }
        
if ($this->session->userdata('main_admin_login')) {?>
  <li>
  <div class="dropdown" style=" margin-right: 90px;">
          <a href="<?php echo base_url(); ?>bdaadmin/Dashboard" class="btn btn-outline-info nav-link mt-3">
            <font style="text-transform: capitalize;"> </font><?php echo 'Hi, ' . $this->session->userdata('main_admin_login')['name']; ?> Admin
          </a>&nbsp;
          <div class="dropdown-content" aria-labelledby="dropdownMenuLink" style="background:#fff;z-index: 9999;">
            <a class="dropdown-item" href="#">Support</a><hr>
          <a class="dropdown-item" href="<?php echo base_url(); ?>bdaadmin/Login/mainlogout" class="btn btn-outline-danger nav-link">Log Out</a>&nbsp;
          </div>
          </div>
        <?php }?>
</li>
      </ul>

      <div class="form-inline my-2 my-lg-0">
        <!-- <a class="btn btn-outline-info nav-link" href="#">Help</a>&nbsp; -->
    

      </div>
    </div>
  </nav>

  <style>
  #notific{
  position: absolute;
  top:8%;
  left: 95%;
}
</Style>
<?php if (isset($notification)) {
	?>
    <ul class="navbar-nav mr-auto">
<i class="fas fa-bell btn btn-link"  title="<?php echo $notification->num_rows(); ?>" id="notific" data-toggle="modal" data-target="#myModal-header" type=""><i class="h-6 text-danger badge"><?php echo $notification->num_rows(); ?> </i></i>
</ul>
<?php
?>
<!-- modal for notifications -->

<!-- Modal -->
<div id="myModal-header" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 100% !important; height: 100% !important; margin: 0 !important;  padding: 0 !important; max-width:none !important;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Today Task</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid mt-5">

  <!-- table -->
<div class="row">
  <div class="col-12">


<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Intern_ID</th>
      <th scope="col">Topic</th>
      <th scope="col">Description</th>
      <th scope="col">Add-time</th>
      <th scope="col">Completed-time</th>
      <th scope="col">Consumed-time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
if ($notification->num_rows() > 0) {
		foreach ($notification->result() as $row) {
			?>
        <tr>
          <th scope="row" class="text-primary"><a href="<?php echo base_url() . adminpath ?>/Dashboard/showDetails?id=<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></a></th>
          <td><?php echo $row->topic; ?></td>
          <td><?php echo $row->description; ?></td>
          <td><?php echo $row->add_time; ?></td>
          <td><?php echo $row->complete_time; ?></td>
          <?php
$start = new DateTime($row->add_time);
			$end = new DateTime($row->complete_time);
			$diff = $start->diff($end);
			?>
          <td> <?php echo $diff->format('%d days %h hours %i minutes %S seconds'); ?> </td>
        </tr>
        <?php
}
	} else {
		?>
      <tr>
        <td colspan="6" style="text-align: center;">Today Completed Task not found</td>
      </tr>
    <?php
}

	?>
    </tr>
  </tbody>
</table>
<div class="row">
<div class="col-12">
<p class="text-center font-weight-bold" style="word-spacing: 30px;"><?php //$this->pagination->create_links();?></p>
</div>
</div>
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <i type="button" class="btn btn-default" data-dismiss="modal">Close</i>
      </div>
    </div>

  </div>
</div>
<?php
}
?>
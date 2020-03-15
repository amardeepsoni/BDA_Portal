<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page_title; ?></title>
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
 <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <script src='https://kit.fontawesome.com/a076d05399.js'></script>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <script src="https://kit.fontawesome.com/0a7a557465.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>images/logocareer.png" style="width: 216px;height: 83px;"></a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(); ?>">About</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
        <a class="btn btn-outline-info nav-link" href="#">Help</a>&nbsp;
<?php if ($this->session->userdata('intern')) {?>

        <a href="<?php echo base_url(); ?>intern/Dashboard" class="btn btn-outline-info nav-link"><font style="text-transform: capitalize;"><?php echo 'Hi, ' . $this->session->userdata('intern')['name']; ?> </font>Profile</a>&nbsp;
        <a href="<?php echo base_url(); ?>Login/logout" class="btn btn-outline-danger nav-link">Log Out</a>&nbsp;

<?php }if ($this->session->userdata('admin_login')) {?>
        <a href="<?php echo base_url(); ?>admin/Dashboard" class="btn btn-outline-info nav-link"><font style="text-transform: capitalize;"><?php echo 'Hi, ' . $this->session->userdata('admin_login')['name']; ?> </font>Profile</a>&nbsp;
        <a href="<?php echo base_url(); ?>admin/Login/logout" class="btn btn-outline-danger nav-link">Log Out</a>&nbsp;
<?php }?>
    </div>
  </div>
</nav>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php if ($page_title) {echo $page_title;} else {echo "Career";}?></title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900|Rubik:300,400,700&display=swap" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/style_home/forgetpassword.css" rel="stylesheet">

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <style>
    .dropdown-content {
      display: none;
      width:100%;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      padding: 12px 16px;
      z-index: -1 !important;
      top:70%;
      padding-top:2rem;
    }

    .dropdown:hover .dropdown-content {
      display: inline-block;
    }
    .dropdown-item{
      padding: 5px;

    }
    .drop-btn{
      z-index:10 !important;
      background-color:#F8F9FA !important;
      /* background:#fff; */

    }
    .drop-btn span{
      background:#F8F9FA !important;
      color:#93D2DC !important;
      
    }


    body{
      font-family:'roboto',sans-serif !important;
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
        <?php if (!$this->session->userdata('intern') && !$this->session->userdata('admin_login') && !$this->session->userdata('main_admin_login')) {?>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url(); ?>/bdaadmin"> Admin <span class="sr-only">(current)</span></a>
          </li>
        <?php }?>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>/about"> About Us </a>
        </li>
      </ul>

      <div class="form-inline my-2 my-lg-0">
        <!-- <a class="btn btn-outline-info nav-link" href="#">Help</a>&nbsp; -->
        <?php if ($this->session->userdata('intern')) {?>
          <div class="dropdown drop-btn" style=" margin-right: 90px;">
            <span class="btn btn-outline-info nav-link" style="border-radius: 50px;"><img src="https://cdn.iconscout.com/icon/free/png-512/avatar-380-456332.png" class="rounded-circle" style="width: 30px; height: 30px;"> <?php echo 'Welcome, ' . $this->session->userdata('intern')['name']; ?></span>

            <div class="dropdown-content" aria-labelledby="dropdownMenuLink" style="background:#fff;z-index: 9999;">
              <a class="dropdown-item" href="<?php echo base_url(); ?>Intern/InternDashboard">My Profile</a>
              <a class="dropdown-item" href="#">Support</a><hr>
              <a class="dropdown-item" href="<?php echo base_url(); ?>InternLogin/logout">Logout</a>
            </div>
          </div>
        <?php }?>

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
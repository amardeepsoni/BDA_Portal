
<div id="page-content-wrapper">
<a href="#menu-toggle" class="menuopener" id="menu-toggle"><i class="fa fa-bars"></i></a>
<div class="demo-parallax parallax section looking-photo nopadbot" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo base_url();?>schoolassest/upload/demo_02.jpg');">
  <div class="page-title section nobg">
    <div class="container-fluid">
      <div class="clearfix">
        <div class="title-area pull-left">
          <h2>Student Register <small></small></h2>
        </div>
        <!-- /.pull-right -->
        <div class="pull-right hidden-xs">
          <div class="bread">
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url();?>schooldashboard/">Home</a></li>
              <li class="active">Student Login</li>
            </ol>
          </div>
          <!-- end bread --> 
        </div>
        <!-- /.pull-right --> 
      </div>
      <!-- end clearfix --> 
    </div>
  </div>
  <!-- end page-title --> 
</div>
<div class="section">
  <div class="container-fluid">

    <div class="cnt-block">
                  <form name="registrationform" class="defaultform row "  method="post" action="<?php echo $action; ?>" id="registrationform">
                        <div class="col-md-12">
                            <div class="register-widget clearfix">
                                <div class="widget-title">
                                    <h3>Registration</h3>
                                    <hr>
                                </div><!-- end title -->
                                <div class="row">
                                    
                                    <div class="form-group col-lg-6">
                                        <label>First Name</label>
                                       <input name="firstname" required="" value="<?php if(isset($_POST['firstname'])){ echo $_POST['firstname']; } ?>" type="text" id="firstname" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Last Name</label>
                                       <input name="lastname" required="" value="<?php if(isset($_POST['lastname'])){ echo $_POST['lastname']; } ?>" type="text" id="lastname" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Email</label>
                                       <input name="email" required="" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" type="text" id="email" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Mobile</label>
                                       <input name="mobile" required="" value="<?php if(isset($_POST['mobile'])){ echo $_POST['mobile']; } ?>" type="text" id="mobile" pattern="[789][0-9]{9}" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Select Course</label>
                                        <select id="category_id" name="category_id" class="form-control">

                  <option value="">Select Course</option>

                  <?php if($allcategorys){

                    foreach($allcategorys as $category){?>

                      <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>

                    <?php } } ?>

                </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Password</label>
                                         <input name="password" required=""  value="" type="password" id="password" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Repeat Password</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                                    </div>  
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </div>          
                            </div>
                        </div>
                    
                        
                    </form><!-- end row -->
                </div>
  </div>
  <!-- end container --> 
</div>
<!-- end section --> 

















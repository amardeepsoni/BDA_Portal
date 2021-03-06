 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/register/style1.css">
 <!-- Include the above in your HEAD tag -->


 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <?php

    if (isset($this->session->flashdata('register')['flag'])) {
        if ($this->session->flashdata('register')['flag'] == 1) {
            echo '<script type="text/javascript"> swal({
icon : "success",
title: "Success",
text: "Check your E-mail...",
type:"Success",
showConfirmButton: false,
})

</script>';
        } else if ($this->session->flashdata('register')['flag'] == 0) {
            echo '<script type="text/javascript"> swal({
      icon : "error",
      title: "Email already exist..",
      type:"Error",
      showConfirmButton: false,
})

</script>';
        } else {
            echo '<script type="text/javascript"> swal({
      icon : "error",
      title: "All fields are not specified",
      type:"error",
      showConfirmButton: false,
})

</script>';
            if ($this->session->userdata('register')['flag']) {
                $this->session->unset_userdata('register');
            }
        }
    }
    ?>

 <div class="modal" id="myModal">
     <div class="modal-dialog">
         <div class="modal-content p-2" style="border:none;border-radius:0;">
             <!-- Modal Header -->
             <div class="modal-header">
                 <h4 class="modal-title">Log In</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>

             <!-- Modal body -->
             <div class="modal-body form-group mt-3">
                 <form method="post" action="<?php echo base_url(); ?>InternLogin/checklogin">
                     <div class="form-row">
                         <input type="text" class="form-control" name="username" placeholder="Username">
                     </div>
                     <br>
                     <div class="form-row">
                         <input type="password" class="form-control" name="password" placeholder="Password">
                     </div>
                     <br>
                     <button class="btn btn-primary">Log In</button>
                 </form>
             </div>

             <!-- Modal footer -->
             <div class="modal-footer">
                 <a href="<?php echo base_url(); ?>intern/Forgot_pass">Forgot password?</a>
             </div>

         </div>
     </div>
 </div>

 <div class="container-fluid register">

     <div class="row">
         <div class="col-md-3 register-left">
             <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
             <h3>Welcome</h3>

             <button class="btn bg-white" data-toggle="modal" data-target="#myModal">Log In</button>
         </div>
         <div class="col-md-9 register-right">
             <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                 <li class="nav-item">
                     <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Intern</a>
                 </li>
                 <!--                             <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Volunteer</a>
</li> -->
             </ul>
             <div class="tab-content" id="myTabContent">
                 <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                     <h3 class="register-heading">Apply as a Intern</h3>

                     <form method="post" action="<?php echo base_url(); ?>Register/take_data_intern">
                         <div class="row register-form">
                             <div class="col-md-6">

                                 <div class="form-group">
                                     <input type="text" class="form-control" placeholder="Name *" value="" required name="name" />

                                 </div>

                                 <div class="form-group">
                                     <input type="text" class="form-control" placeholder="City *" value="" required name="city" />

                                 </div>
                                 <div class="form-group">
                                     <input type="text" class="form-control" placeholder="District *" value="" required name="district" />
                                 </div>
                                 <div class="form-group">
                                     <input type="text" class="form-control" placeholder="State *" value="" required name="state" />

                                 </div>
                                 <div class="form-group">
                                     <div class="form-group">
                                         <select class="form-control" name="type" required>
                                             <option>Intern Work from Office</option>
                                             <option>Intern Work from Home</option>
                                             <option>Employee</option>
                                         </select>
                                     </div>
                                     <div class="maxl">
                                         <label class="radio inline">
                                             <input type="radio" name="gender" value="male" checked required>
                                             <i> Male </i>
                                         </label>
                                         <label class="radio inline">
                                             <input type="radio" name="gender" value="female" required>
                                             <i>Female </i>
                                         </label>
                                     </div>
                                 </div>

                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <input type="email" class="form-control" placeholder="Email *" value="" name="email" />

                                 </div>
                                 <div class="form-group">
                                     <select class="form-control" name="domain" required>
                                         <option>Business Development</option>
                                         <option>State Coordinator</option>
                                         <option>Operation</option>
                                         <option>Volunteering</option>
                                         <option>Marketing</option>
                                         <option>Sales</option>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <input type="text" class="form-control" placeholder="Mobile Number *" value="" required name="mobile" maxlength="10" minlength="10"/>

                                 </div>
                                 <div class="form-group">
                                     <input type="text" class="form-control" placeholder="College *" value="" required name="college" />

                                 </div>
                                 <div class="form-group">
                                     <input type="text" class="form-control" placeholder="Referal(Optional)" value="" name="referal_by" />

                                 </div>
                                 <div class="form-group">
                                     <label for="">Security Question*</label>
                                     <select class="form-control" name="security_question" required>
                                         <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                                         <option value="What is your pet's name?">What is your pet's name?</option>
                                         <option value="What was your childhood phone number including area code?">What was your childhood phone number including area code?</option>
                                         <option value="What was the name of your first stuffed animal?">What was the name of your first stuffed animal?</option>
                                     </select>
                                 </div>
                                 <div class="">
                                     <label for="">Security Answer*</label>
                                     <input class="form-control" type="" name="security_answer" required>
                                 </div>
                                 <button type="submit" class="btnRegister" name="register">Register</button>
                             </div>

                         </div>
                     </form>
                 </div>


             </div>
         </div>
     </div>
 </div>
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
title: "Success",
text: "Check your E-mail...",
type:"Success",
showConfirmButton: false,
})

</script>';

	} else if ($this->session->flashdata('register')['flag'] == 0) {
		echo '<script type="text/javascript"> swal({
title: "Email already exist..",
type:"Error",
showConfirmButton: false,
})

</script>';

	} else {
		echo '<script type="text/javascript"> swal({
title: "All fields are not specified",
type:"Error",
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
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Log In</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body form-group">
        <div class="form-row">
            <input type="text" class="form-control" name="" placeholder="Username">
       </div>
       <br>
       <div class="form-row">
       <input type="password" class="form-control" name="Password" placeholder="Password">
       </div>
       <br>
       <button class="btn btn-primary">Log In</button>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a href="#">Forgot password?</a>
      </div>

    </div>
  </div>
</div>

<div class="container-fluid register">

                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
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

                                 <form method="post" action="<?php echo base_url(); ?>Register/take_data_intern">                  <div class="row register-form">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name *" value="" required name="name" />

                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="City *" value="" required name="city" />

                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="District *" value="" required name="district" />
                                            </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="State *" value="" required name="state" />

                                        </div>
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline">
                        <input type="radio" name="gender" value="male" checked  required>
                                                    <i> Male </i>
                                                </label>
                                                <label class="radio inline">
                                                    <input type="radio" name="gender" value="female" required>
                                                    <i>Female </i>
                                                </label>
                                                <span id="gem" class="text-danger">Select any One</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email *" value="" name="email"/>

                                        </div>
                                        <div class="form-group">
                                        <select class="form-control" name="domain" required>
                                          <option>Business Development</option>
                                          <option>State Coordinator</option>
                                          <option>Operation</option>
                                          <option>Volunteering</option>
                                          <option>Government Relation</option>
                                          <option>Marketing</option>
                                          <option>Sales</option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Mobile Number *" value="" required name="mobile"/>

                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="College *" value="" required name="college"/>

                                        </div>
                                        <button type="submit" class="btnRegister"   name="register">Register</button>
                                    </div>

                                </div>
                                </form>
                            </div>

                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Apply as a Volunteer</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name *" value="" required id="name" />
                                            <span class="text-danger" id="ne">Name is Empty</span>
                                        </div>
                                       
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="City *" value="" required id="city" />
                                            <span class="text-danger" id="ce">City is Empty</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="District *" value="" required id="district" />
                                            <span class="text-danger" id="de">District is Empty</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="State *" value="" required id="state" />
                                            <span class="text-danger" id="se">State is Empty</span>
                                        </div>
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline">
                                                    <input type="radio" name="gender" value="male" checked  required>
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
                                            <input type="email" class="form-control" placeholder="Email *" value="" id="email"/>
                                            <span class="text-danger" id="ee">Email is Empty</span>
                                        </div>
                                        <div class="form-group">      
                                        <select class="form-control" id="domain" required>
                                          <option>Business Development</option>
                                          <option>State Coordinator</option>
                                          <option>Operation</option>
                                          <option>Volunteering</option>
                                          <option>Government Relation</option>
                                          <option>Marketing</option>
                                          <option>Sales</option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Mobile Number *" value="" required id="mobile"/>
                                            <span class="text-danger" id="me">Mobile Number is Empty</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="College *" value="" required id="college"/>
                                            <span class="text-danger" id="cne">College Name is Empty</span>
                                        </div>
                                        <button type="submit" class="btnRegister"   id="register">Register</button>
                                    </div>
                                </div><!-- 
 -->                            </div>
                        </div>
                    </div>
                </div>
            </div>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/register/style1.css">
<!-- Include the above in your HEAD tag -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css">
    span{
        display: none;
    }
</style>
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
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Volunteer</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Apply as an Intern</h3>
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
                                                <span id="gem" class="text-danger">Select any One</span>
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
<script>    
    $(document).ready(function(){
        var c = 0;
        var check_user = "Int";
        $('#home-tab').click(function(){check_user="Int";});
        $('#profile-tab').click(function(){check_user="Vol";});
        $('#register').click(function(){
            if($('#name').val()==""){
                $('#ne').css('display', 'block');
                c--;
                //return false;
            }
            else{
                $('#ne').css('display', 'none');
                c++;
            }
            if($('#city').val()==""){
                $('#ce').css('display', 'block');
                c--;
                //return false;
            }
            else{
                $('#ce').css('display', 'none');
                c++;
            }
            if($('#district').val()==""){
                $('#de').css('display', 'block');
                c--;
                //return false;
            }
            else{
                $('#de').css('display', 'none');
                c++;
            }
            if($('#mobile').val()==""){
                $('#me').css('display', 'block');
                c--;
                //return false;
            }
            else{
                $('#me').css('display', 'none');
                c++;
            }
            if($('#email').val()==""){
                $('#ee').css('display', 'block');
                c--;
                //return false;
            }
            else{
                $('#ee').css('display', 'none');
                c++;
            }
            if($('#state').val()==""){
                $('#se').css('display', 'block');
                c--;
               // return false;
            }
            else{
                $('#se').css('display', 'none');
                c++;
            }
            if($('#college').val()==""){
                $('#cne').css('display', 'block');
                c--;
                //return false;                                                                                                                                 
            }
            else{
                $('#cne').css('display', 'none');
                c++;
            }
            if($("input[name='gender']:checked").val()){
                c++;
                $('#gem').css('display', 'none                                                                                                                                                                                                                                                                                                                                                                                                          ');
            }
            else{
                $('#gem').css('display', 'block');
                c--;
            }
            if(c==8){
              
                if(check_user=="Vol"){
                $.post(
                    '<?php echo base_url();?>/Register/take_data_intern',
                    {
                        name : $('#name').val(),
                        email : $('#email').val(),
                        mobile : $('#mobile').val(),
                        city : $('#city').val(),
                        district : $('#district').val(),
                        college : $('#college').val(),
                        state : $('#state').val(),
                        domain : $('#domain').val(),
                        gender : $("input[name='gender']:checked").val(),
                        user_id : check_user
                    },
                    function(result){
                        if(result=='error'){
                            alert('Something Wrong !..');
                        }
                        else{
                            alert('Registration Successfully');
                            $('input').val('');
                            c = 0;
                        }
                    }
                    );
                }
                else{
                $.post(
                    '<?php echo base_url();?>/Register/take_data_intern',
                    {
                        name : $('#name').val(),
                        email : $('#email').val(),
                        mobile : $('#mobile').val(),
                        city : $('#city').val(),
                        district : $('#district').val(),
                        college : $('#college').val(),
                        state : $('#state').val(),
                        domain : $('#domain').val(),
                        gender : $("input[name='gender']:checked").val(),
                        user_id : check_user
                    },
                    function(result){
                        if(result=='error'){
                            alert('Something Wrong !..');
                        }
                        else{
                            alert('Registration Successfully');
                            $('input').val('');
                            c = 0;
                        }
                    }
                    );
            }//else
            }

        });
    });
</script>
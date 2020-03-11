<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Include the above in your HEAD tag -->
<style>

span{
    display: none;
}
</style>
<div class="container-fluid register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>

                        <input type="submit" name="" value="Login"/><br/>
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
                                <h3 class="register-heading">Apply as a Intern</h3>
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
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Apply as a Hirer</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" maxlength="10" minlength="10" class="form-control" placeholder="Phone *" value="" />
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Confirm Password *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                                                <option>What is your Birthdate?</option>
                                                <option>What is Your old Phone Number</option>
                                                <option>What is your Pet Name?</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="`Answer *" value="" />
                                        </div>
                                        <input type="submit" class="btnRegister"  value="Register"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script>    
    $(document).ready(function(){
        var c = 0;
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
            if(c==7){
                alert('done');
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
                        gender : $("input[name='gender']:checked").val()
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

        });
    });
</script>
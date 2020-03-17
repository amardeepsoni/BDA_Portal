
<style type="text/css">
	form div{
		margin-top: 5px;
	}
</style>
<div class="container" style="height: 100vh;">
	<div class="card" style="width: 60%;margin:auto;">
		<div class="card-header">
			Forgot Password
		</div>
		<?php if ($this->session->flashdata('loginnotify')) {?>
      <div class="card <?php echo $this->session->flashdata('color'); ?>" style="background: #CC5771;color: #ddd;">
        <div class="card-body">
            <?php echo $this->session->flashdata('loginnotify'); ?>
        </div>
      </div>
      <?php }?>
			<form class="form-group p-4" action="<?php echo base_url(); ?>intern/Forgot_pass/forgotpassword" method="post">
				<div class="">
					<label for="">Email*</label>
					<input class="form-control" type="email" name="email" required>
				</div>
			<div class="">
					<label for="">Old</label>
					<input  class="form-control" type="Password" name="password" placeholder="Old Password (#Optional)">
				</div>
				<div class="" style="">
				<label for="">Security Question*</label>
				<select class="form-control" name="secutrity_question" required>
					<option value="What was your childhood nickname?">What was your childhood nickname?</option>
					<option value="What is your pet's name?">What is your pet's name?</option>
					<option value="What was your childhood phone number including area code?">What was your childhood phone number including area code?</option>
					<option value="What was the name of your first stuffed animal?">What was the name of your first stuffed animal?</option>
				</select>
				</div>
					<div class="">
				<label for="">Security Answer*</label>
				<input class="form-control" type="text" name="security_answer" required>
				</div>
				<div class="">
				<label for="">New Password*</label>
				<input class="form-control" type="password" name="new_password" required>
				</div>
				<div class="">
				<label for="">Confirm Password*</label>
				<input type="password" class="form-control" name="conf_password" required>
				</div>
				<button class="btn btn-success">Submit</button>
			</form>
		</div>
	</div>
</div>
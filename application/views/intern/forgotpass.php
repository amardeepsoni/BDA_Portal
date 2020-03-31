<!--  -->
<div class="container mt-3" style="height: 100vh;">
	<div class="card" style="width: 60%;margin:auto;">
		<div class="head">
			Forgot Password
		</div>
		<?php if ($this->session->flashdata('loginnotify')) {?>
      <div class="card <?php echo $this->session->flashdata('color'); ?>" style="background: #CC5771;color: #ddd;">
        <div class="card-body">
            <?php echo $this->session->flashdata('loginnotify'); ?>
        </div>
      </div>
      <?php }?>
			<form class="px-4 pt-2 pb-4" action="<?php echo base_url(); ?>intern/Forgot_pass/forgotpassword" method="post">
				<div class="pass">
					<input class="form-control" type="email" name="email" placeholder="Email*" required>
				</div>
			<div class="pass">
					<input  class="form-control" type="Password" placeholder="Old password" name="password" placeholder="Old Password (#Optional)">
				</div>
				<div class="pass" style="">
				<select class="form-control" name="secutrity_question" placeholder="Security question" required>
					<option value="What was your childhood nickname?">What was your childhood nickname?</option>
					<option value="What is your pet's name?">What is your pet's name?</option>
					<option value="What was your childhood phone number including area code?">What was your childhood phone number including area code?</option>
					<option value="What was the name of your first stuffed animal?">What was the name of your first stuffed animal?</option>
				</select>
				</div>
					<div class="pass">
				<input class="form-control" type="text" placeholder="Security answer*" name="security_answer" required>
				</div>
				<div class="pass">
				<input class="form-control" type="password" placeholder="new password*" name="new_password" required>
				</div>
				<div class="pass">
				<input type="password" class="form-control" placeholder="new password*" name="conf_password" required>
				</div>
				<button class="btn  submit">Submit</button>
			</form>
		</div>
	</div>
</div>
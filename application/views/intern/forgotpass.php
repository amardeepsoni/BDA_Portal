
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
		<div class="card-body">
			<form class="form-group p-4" action="<?php base_url();?>intern/Forgot_pass/changepass" method="post">
				<div class="">
					<label for="">Email*</label>
					<input class="form-control" type="" name="">
				</div>
			<div class="">
					<label for="">Old</label>
					<input  class="form-control" type="" name="" placeholder="Optional">
				</div>
				<div class="" style="">
				<label for="">Security Question*</label>
				<select class="form-control" type="" name="">
					<option value="What was your childhood nickname?">What was your childhood nickname?</option>
					<option value="What is your pet's name?">What is your pet's name?</option>
					<option value="What was your childhood phone number including area code?">What was your childhood phone number including area code?</option>
					<option value="What was the name of your first stuffed animal?">What was the name of your first stuffed animal?</option>
				</select>
				</div>
					<div class="">
				<label for="">Security Answer*</label>
				<input class="form-control" type="" name="">
				</div>
				<div class="">
				<label for="">New Password*</label>
				<input class="form-control" type="" name="">
				</div>
				<div class="">
				<label for="">Confirm Password*</label>
				<input type="" class="form-control" name="">
				</div>
				<button class="btn btn-success">Submit</button>
			</form>
		</div>
	</div>
</div>
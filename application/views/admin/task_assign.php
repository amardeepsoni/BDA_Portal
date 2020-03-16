<?php $user_id = $_GET['id']; ?>
<div class="container"> 
  <p class="display-4 text-center"><u class="text-primary">Admin</u></p>
</div>
<div class="clearfix"></div>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <p class="h4 text-primary">Intern Id =<span class="text-danger"> <?php echo $user_id;?></span> </p>
    </div>
    <div class="container">
    <div class="row mt-2 mb-5">
   		 <form class="container">
	    	<div class="col-12 ml-2 text-center">
	    		<label class="text-primary  font-weight-bold h4">Topic</label>
	    		<input type="text" name="" class="form-control" placeholder="Enter the Topic"  required id="topic">
	    	</div>
	    	<div class="col-12 ml-2 text-center">
	    		<label class="text-danger font-weight-bold h3">Description</label>
	    		<textarea class="form-control" placeholder="Enter the Description" required id="description"></textarea>
	    	</div>
	    	<div class="col-12 text-center">
	    		<button class="btn btn-outline-primary mt-3" role="submit" type="submit">Task Assign</button>
	    	</div>
    	</form>
    </div>
    </div>
  </div>
</div> <!-- close of container fluid -->
<script type="text/javascript">
	$(document).ready(function(){
		$('form').submit(function(e){
			e.preventDefault();
			$.post(
				'<?php echo base_url().adminpath;?>/Dashboard/insertTask',
				{
					user_id:'<?php echo $user_id; ?>',
					topic : $('#topic').val(),
					description: $('#description').val()
				},
				function(result){
					if(result=="error"){
						alert('Task is not Assigned!..');
					}
					else{
						alert('Task Assigned Successfully to '+'<?php echo $user_id; ?>');
						window.location="<?php echo base_url().adminpath ?>/Dashboard";
					}
				}
				);
		});
	});
</script>
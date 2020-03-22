<!--




  Dont't use button and span and also i tag in this webpage




 -->

 <style>

  /*counter css start*/
.counter {
    display: block;
    font-size: 32px;
    font-weight: 700;
    color: #666;
    line-height: 28px
}
/*counter css end*/
  #not-empty-admin-suggestion{
    display: none;
    color:red;
  }
</style>
<div class="row">
  <div class="col-2">
    <p class="h-5 text-success pl-1 text-left font-weight-bold">Intern_Id: <u class="text-primary"> <?php echo $_GET['id']; ?></u></p>
  </div>
 </div>


     <?php if ($detail->num_rows() > 0) {
	$comp = 0;
	$appr = 0;
	foreach ($detail->result() as $value) {
		if ($value->completed == 1) {
			$comp++;
		}
		if ($value->approved_task == 1) {
			$appr++;
		}
	}
} else {
	$comp = 0;
	$appr = 0;
}

?>



<!-- counter -->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class=""> <i class="counter"><?php echo $detail->num_rows(); ?></i>
                <p>Total Tasks</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class=""> <i class="counter"><?php echo $appr; ?></i>
                <p>Approved Tasks</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class=""><i class="counter"><?php echo $comp; ?></i>
                <p>Completed Tasks</p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-0">

  <!-- table -->
<div class="row">
  <div class="col-12">


<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Task_ID</th>
      <th scope="col">Topic</th>
      <th scope="col">Description</th>
      <th scope="col">Add-time</th>
      <th scope="col">Completed-time</th>
      <th scope="col">Consumed-time</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
if ($detail->num_rows() > 0) {
	foreach ($detail->result() as $row) {
		?>
        <tr>
          <th scope="row" class="text-primary"><a href="<?php echo base_url() . bdaadminpath ?>/Dashboard/showDetails?id=<?php echo $row->user_id; ?>"><?php echo $row->id; ?></a></th>
          <td><?php echo $row->topic; ?></td>
          <td><?php echo $row->description; ?></td>
          <td><?php echo date("d-m-Y, h:m:i a", strtotime($row->add_time)); ?></td>

          <?php
if ($row->complete_time != '0000-00-00 00:00:00') {
			?>
  <td><?php echo date("d-m-Y, h:m:i a", strtotime($row->complete_time)); ?></td>
  <?php
$start = new DateTime($row->add_time);
			$end = new DateTime($row->complete_time);
			$diff = $start->diff($end);

			?><td><?php echo $diff->format('%d days %h hours %i minutes %S seconds'); ?> </td><?php
} else {
			$diff = 0;
			?>
      <td><?php echo $row->complete_time; ?></td>
   <td>Not Completed</td>

   <?php
}

		?>
          <?php
if ($row->approved_task == 1) {
			?>
              <td style="display: flex;"><i class="btn btn-primary disabled mb-1" title="Approved" id="<?php echo $row->id; ?>"class="approved-btn" ><i class="far fa-thumbs-up "></i></i>
                <?php if ($row->completed) {?>
                <span class="btn" title="<?php echo $row->id; ?> Task submition Description" id="<?php echo $row->response; ?>"class="description-btn" ><i class="fab fa-readme" class="sr-only" value="<?php echo $row->response; ?>"></i></span> <?php }if ($row->completed == 1) {?><a role="button" class="btn ml-1 btn-danger disapproved" title="Disapproved" id="<?php echo $row->id; ?>"><i class="far fa-thumbs-down"  ></i></a><?php }?></td>
            <?php
} else {
			if ($row->completed == 1) {
				?>
          <td style="display: flex;"> <?php if ($row->completed == 1) {?><button class="btn btn-primary mb-1" title="Approved" id="<?php echo $row->id; ?>"class="approved-btn" ><i class="far fa-thumbs-up"></i></button><?php }if ($row->completed == 1) {?><span class="btn" title="<?php echo $row->id; ?> Task submition Description" id="<?php echo $row->response; ?>"class="description-btn" data-toggle="modal" data-target="#descriptionModal"><i class="fab fa-readme"></i></span><?php }if ($row->completed == 1) {?><a role="button" class="btn ml-1 btn-danger disapproved" title="Disapproved" id="<?php echo $row->id; ?>"><i class="far fa-thumbs-down"  ></i></a><?php }?> </td>
          <?php
} else {
				if ($row->seen == 1) {
					?>
              <td><p class="text-success">Task Seen</p></td>
            <?php
} else {
					?>
              <td><p class="text-danger">Task Not Seen</p></td>
            <?php
}
			}
		}
		?>

        </tr>

        <?php
}
} else {
	?>
      <tr>
        <td colspan="4">No data found</td>
      </tr>
    <?php
}
?>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>
<!-- Modal body -->
<!-- Modal -->
<i type="button" class="btn btn-primary sr-only" data-toggle="modal" data-target="#descriptionModal" id="modal-desc">
  Launch Description Modal
</i >
<div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true" style="position: absolute;top: 50%;left: 50%;  transform: translate(-50%, -50%); width: 50%;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><p class="h-5 text-success pl-1 text-left font-weight-bold">Intern_Id: <u class="text-primary"> <?php echo $_GET['id']; ?></u></p>Task Description </h5>
        <i type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="remove-modal-body-content">&times;</i>
        </i>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <i type="button" class="btn btn-secondary remove-modal-body-content" data-dismiss="modal">Close</i>
      </div>
    </div>
  </div>
</div>
      <!-- Modal footer -->

      <!-- modal end -->

      <!-- Button trigger modal -->
<i type="button" class="btn btn-primary sr-only" data-toggle="modal" data-target="#suggestion-task" id="suggestion-task-modal">
  Launch modal
</i>

<!-- Modal -->
<div class="modal fade" id="suggestion-task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  style="position: absolute;top: 50%;left: 50%;  transform: translate(-50%, -50%); width: 50%;">
  <div class="modal-dialog modal-dialog-centered" role="">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Suggestion</h5>

      </div>
      <div class="">
        <textarea class="form-control" required id="suggestion-admin"></textarea>
        <i id="not-empty-admin-suggestion">Please Eneter the suggestion</i>
      </div>
      <div class="modal-footer">
        <i type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal-save">Close</i>
        <i type="submit" class="btn btn-primary" id="save-changes" role="button">Submit Suggestion</i>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    //to deapproved
    var idi;
    $(document).on('click', '.disapproved', function(){
     // alert($(this).attr('id'));
     idi = $(this).attr('id');
     $('#suggestion-admin').val(null);
      $('#suggestion-task-modal').trigger('click');
    });
    $('#save-changes').click(function(){

      if($('#suggestion-admin').val()!=''){
            $('#not-empty-admin-suggestion').css('display', 'none');
            myswalfunction(idi);
            $('#close-modal-save').trigger('click');
    }
    else{
      $('#not-empty-admin-suggestion').css('display', 'block');
      $('#suggestion-admin').val(null);
    }

    });
    function myswalfunction(id){
      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Disapproved it!'
}).then((result) => {
  if (result.value) {
    $.post(
         '<?php echo base_url() . bdaadminpath; ?>/Dashboard/disapprovedTask',
         {
          id:id,
          sugg:$('#suggestion-admin').val()
         },
         function(res){
          if(res=='error'){
            alert('Something Wrong!..');
          }
          else{
          //dont show anything
          }
         }
      );
    Swal.fire(
      'Disapproved!',
      'Task has been disapproved.',
      'success'
    )
    location.reload(true);
  }
});
    }
    //to show intern description.
    /*$(document).on('click', '.description-btn', function(){
      alert($(this).attr('id'));
    });*/
    $('span').on('click', function(){
      //alert($(this).attr('id'));
      $('#descriptionModal .modal-body').append($(this).attr('id'));
      $('#modal-desc').trigger('click');

    });
    //to approved
      $('button').on('click', function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Approved it!'
}).then((result) => {
  if (result.value) {
    $.post(
         '<?php echo base_url() . bdaadminpath; ?>/Dashboard/approvedTask',
         {
          id:$(this).attr('id')
         },
         function(res){
          if(res=='error'){
            alert('Something Wrong!..');
          }
          else{
          //dont show anything
          }
         }
      );
    Swal.fire(
      'Approved!',
      'Task has been Approved.',
      'success'
    )
    location.reload(true);
  }
});
   });


      //remove modal body text after close
      $('.remove-modal-body-content').click(function(){
        $('#descriptionModal .modal-body').html('');
      });
      });

  /*conter js*/

  $(document).ready(function() {

$('.counter').each(function () {
$(this).prop('Counter',0).animate({
Counter: $(this).text()
}, {
duration: 500,
easing: 'swing',
step: function (now) {
$(this).text(Math.ceil(now));
}
});
});

});
  /*end counter js*/
</script>
<!-- 




  Dont't use button and span and also i tag in this webpage 




 -->
<div class="row">
  <div class="col-12">
    <p class="h-5 text-success pl-1 text-left font-weight-bold">Intern_Id: <u class="text-primary"> <?php echo $_GET['id'];?></u></p>
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
      if($detail->num_rows()>0){
       foreach($detail->result() as $row){
        ?>
        <tr>
          <th scope="row" class="text-primary"><a href="<?php echo base_url().adminpath ?>/Dashboard/showDetails?id=<?php echo $row->user_id; ?>"><?php echo $row->id; ?></a></th>
          <td><?php echo $row->topic;?></td>
          <td><?php echo $row->description;?></td>
          <td><?php echo $row->add_time;?></td>
          <td><?php echo $row->complete_time;?></td>
          <?php 
          if($row->complete_time!='0000-00-00 00:00:00'){
           $start = new DateTime($row->add_time);
  $end = new DateTime($row->complete_time);
  $diff = $start->diff($end);
  

 ?><td><?php echo $diff->format('%d days %h hours %i minutes %S seconds');?> </td><?php
}else{
  $diff = 0;
  ?>
   <td>Not Completed</td>

   <?php
}
          ?>
          <?php 
            if($row->approved_task==1){
              ?>
              <td><button class="btn btn-primary disabled" title="Approved" id="<?php echo $row->id; ?>"class="approved-btn" ><i class="far fa-thumbs-up"></i></button><span class="btn" title="<?php echo $row->id; ?> Task submition Description" id="<?php echo $row->response; ?>"class="description-btn" ><i class="fab fa-readme" class="sr-only" value="<?php echo $row->response; ?>"></i></span> <a role="button" class="btn btn-danger disapproved" title="Disapproved" id="<?php echo $row->id;?>"><i class="far fa-thumbs-down"  ></i></a></td>
            <?php
            }
            else{
          ?>
          <td><button class="btn btn-primary" title="Approved" id="<?php echo $row->id; ?>"class="approved-btn" ><i class="far fa-thumbs-up"></i></button><span class="btn" title="<?php echo $row->id; ?> Task submition Description" id="<?php echo $row->response; ?>"class="description-btn" data-toggle="modal" data-target="#descriptionModal"><i class="fab fa-readme"></i></span>  <a role="button" class="btn btn-danger disapproved" title="Disapproved" id="<?php echo $row->id;?>"><i class="far fa-thumbs-down"  ></i></a></td>
          <?php 
            }
          ?>
        </tr>

        <?php
      }
    }
    else{
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
<div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><p class="h-5 text-success pl-1 text-left font-weight-bold">Intern_Id: <u class="text-primary"> <?php echo $_GET['id'];?></u></p>Task Description </h5>
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
<script>
  $(document).ready(function(){
    //to deapproved
    $(document).on('click', '.disapproved', function(){
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
         '<?php echo base_url().adminpath;?>/Dashboard/disapprovedTask',
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
      'Disapproved!',
      'Task has been disapproved.',
      'success'
    )
    location.reload(true);
  }
});
    });
    //to show intern description.
    /*$(document).on('click', '.description-btn', function(){
      alert($(this).attr('id'));
    });*/
    $('span').on('click', function(){
      //alert($(this).attr('id'));
      $('.modal-body').append($(this).attr('id'));
      $('#modal-desc').trigger('click');

    });
    //to approved
      $('button').on('click', function(){
        /*alert($(this).attr('id'));*/
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
         '<?php echo base_url().adminpath;?>/Dashboard/approvedTask',
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
        $('.modal-body').html('');
      });
      });
</script>
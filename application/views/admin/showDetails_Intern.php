<div class="row">
  <div class="col-12">
    <p class="display-4 text-success text-center">Intern_Id -><u class="text-primary"> <?php echo $_GET['id'];?></u></p>
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
          if($row->complete_time){
          $date1 = date("Y-m-d",strtotime($row->add_time));
$date2 = date("Y-m-d",strtotime($row->complete_time));
$diff = abs(strtotime($date2) - strtotime($date1));
 ?><td><?php echo $diff;?> Days</td><?php
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
              <td><button class="btn btn-primary disabled" title="Approved" id="<?php echo $row->id; ?>"class="approved-btn" >Approved</button></td>
            <?php
            }
            else{
          ?>
          <td><button class="btn btn-primary" title="Approved" id="<?php echo $row->id; ?>"class="approved-btn" >Approved</button></td>
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

<script>
  $(document).ready(function(){
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
      });
</script>
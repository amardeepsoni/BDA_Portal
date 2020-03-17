<style>
    input:focus, textarea:focus, select:focus{
        outline: none;
        border : 1px solid red;
    }
</style>
<div class="container-fluid mt-5">

  <!-- table -->
<div class="row">
  <div class="col-12">
    
  
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Inter_ID</th>
      <th scope="col">Name</th>
      <th scope="col">Domain</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php 
      if($fetch_data->num_rows()>0){
       foreach($fetch_data->result() as $row){
        ?>
        <tr>
          <th scope="row" class="text-primary"><a href="<?php echo base_url().adminpath ?>/Dashboard/showDetails?id=<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></a></th>
          <td><?php echo $row->name;?></td>
          <td><?php echo $row->domain;?></td>
          <td><a class="btn text-success" title="Active"><i class="fas fa-user m-1"></i></a>&nbsp;<a href="#" role="button" class="btn text-danger b-de" title="Deactive" id="<?php echo $row->user_id; ?>"><i class="fas fa-user-slash m-1"></i></a>&nbsp;<a href="#myModal" role="button" class="btn m-1 text-warning open-AddBookDialog" data-toggle="modal"  title="Task Assign" data-id="<?php echo $row->user_id;?>"><i class="fas fa-tasks"></i></a>&nbsp;<a href="#" role="button" class="btn btn-default m-1 " title="Delete"><i class="fas fa-trash-alt"></i></a></td>
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
<div class="row">
<div class="col-12">
<p class="text-center font-weight-bold" style="word-spacing: 130px;"><?= $this->pagination->create_links();?></p>
</div>
</div>
</div>
</div>
</div>
  <!-- table closed  -->

<!--   Modal  -->


<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Task Assign</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <p class="h4 text-primary text-center">Intern Id <span class="text-danger"> <input type="text" name="" value="" id="modal-user-id" readonly class=" border text-danger "></span> </p>
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
          <button class="btn btn-outline-primary mt-3" role="submit" type="submit" id="task-assign-data">Task Assign</button>
        </div>
      </form>
    </div>
 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="close-modal">Close</button>
      </div>

    </div>
  </div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>


$(document).ready(function(){
  var myBookId;
$(document).on("click", ".open-AddBookDialog", function () {
     myBookId = $(this).data('id');
     $(".modal-body #modal-user-id").val(myBookId);
});
   $('.modal-body form').submit(function(e){
    e.preventDefault();
    $.post(
      '<?php echo base_url().adminpath;?>/Dashboard/insertTask',
      {
        user_id:myBookId,
        topic : $('#topic').val(),
        description: $('#description').val()
      },
      function(result){
        if(result=='error'){
          swal("Task is not Assigned !..");
        } 
        else{
           $('#close-modal').trigger('click');
          swal(myBookId, "Task Assigned Successfully to "+myBookId, "success");
          $('#topic').val('');
          $('#description').val('');
        }
      }
      );
   });

   //deactive

   $(document).on('click', '.b-de', function(){
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) { 
    $.post(
        '<?php echo base_url().adminpath;?>/Dashboard/insertStatus',
        {
          user_id:$(this).attr('id')
        },
        function(res){
          if(res=='error'){
            alert('Something Wrong');
          }
          else{
           //don't show anything
          }
        }
      );
    Swal.fire(
      'Deactivated!',
      'Your Intern has been deactivated.',
      'success'
    )
  }
});
   }); 
});

</script>
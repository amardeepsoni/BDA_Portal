<style>
    input:focus, textarea:focus, select:focus{
        outline: none;
        border : 1px solid red;
    }
</style>
<div class="container-fluid mt-1">
<!-- filter -->
<!-- <form class="form-inline" action="<?php //echo base_url() .bdaadminpath .'/Dashboard/filterData'; ?>" method="post">
        <select class="form-control" name="field">
            <option selected="selected" disabled="disabled" value="">Filter By</option>
            <option value="Intern_Id<">Intern_Id</option>
            <option value="Name">Name</option>
            <option value="Domain">Domain</option>
        </select>
        <input class="form-control" type="text" name="search" value="" placeholder="Search...">
        <input class="btn btn-default" type="submit" name="filter" value="Go">
</form> -->

<div class="container">
<h1 align="right"><button type="button";  class="btn btn-warning"><i class='fas fa-download'>Generate Report</i>
 </h1></button>
  </div>

  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse-filter-new-data" aria-expanded="false" aria-controls="collapse-filter-new-data" id="filter-data-new">
    Filter List
  </button>
<div class="collapse fade" id="collapse-filter-new-data">
<form method="post" class="form-inline" action="<?php echo base_url() . bdaadminpath . '/Dashboard/filter_data_intern'; ?>">
  <label for="typeFilter">Choose Type of Filter: </label>

<select  name="typeFilter">
  <option value="user_id">Intern_Id</option>
  <option value="name">Name</option>
  <option value="domain">Domain</option>
</select> &nbsp;&nbsp;
<input type="text" name="FilterData" placeholder="Enter the filter data" id="filter-input" required="">&nbsp;&nbsp;
<button type="submit" class="btn btn-danger">Search</button>
</form>
</div>


  <!-- table -->
<div class="row mt-2">
  <div class="col-12">


<table class="table text-center table-bordered table-hover"; id="myTable">
  <thead>
    <tr>
      <th scope="col">Intern_ID</th>
      <th scope="col">Name</th>
      <th scope="col">Domain</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
if ($fetch_data->num_rows() > 0) {
	foreach ($fetch_data->result() as $row) {
		?>
        <tr>
          <td scope="row" class="text-primary"><a href="<?php echo base_url() . bdaadminpath ?>/Dashboard/showDetails?id=<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></a></td>
          <td><?php echo $row->name; ?></td>
          <td><?php echo $row->domain; ?></td>
          <td>
            <?php if ($row->login_status) {?>
            <a class="btn text-success active-btn-login" title="Active" id="<?php echo $row->user_id; ?>"><i class="fas fa-user m-1"></i></a>&nbsp;
          <?php } else {
			?>
              <a class="btn text-success disabled" title="Active"><i class="fas fa-user m-1"></i></a>&nbsp;
            <?php
}
		?>
            <?php if (!$row->login_status) {?><a href="#" role="button" class="btn text-danger b-de" title="Deactive" id="<?php echo $row->user_id; ?>"><i class="fas fa-user-slash m-1"></i></a>
          <?php } else {?>
           <a href="#" role="button" class="btn text-danger disabled" title="Deactive" id="<?php echo $row->user_id; ?>"><i class="fas fa-user-slash m-1"></i></a>
          <?php }?>
          &nbsp;<a href="#myModal" role="button" class="btn m-1 text-warning open-AddBookDialog" data-toggle="modal"  title="Task Assign" data-id="<?php echo $row->user_id; ?>"><i class="fas fa-tasks"></i></a>&nbsp;<a href="#" role="button" class="btn btn-default m-1 " title="Delete"><i class="fas fa-trash-alt"></i></a>&nbsp;<a href="#" role="button" class="btn btn-default m-1 show-documents-intern" title="Intern Documents" id="<?php echo $row->user_id; ?>"><i class="fas fa-info-circle"></i></a></td>
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
<div class="row">
<div class="col-12">
<p class="text-center font-weight-bold" style="word-spacing: 30px;"><?=$this->pagination->create_links();?></p>
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
        <h4 class="modal-title">TASK ASSIGN</h4>
        <button type="button" class="close" data-dismiss="modal" id="#close-modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
    <div class="container">
    <div class="row mt-2 mb-5">
<<<<<<< HEAD
      <div class="col ml-2 text-right">
     <input value="" id="modal-user-id" readonly class="text-danger"></p>
    </div>

=======
      <div class="col ml-2 text-right"> 
      <input value="" id="modal-user-id" readonly class="text-danger" />
      </div>
       
>>>>>>> bafcb9ce2efb490fd5b43e9d38237e208bcf0ba3
<form class="container">
        <div class="col-12 ml-2 text-left">
          <label class="text-primary  font-weight-bold h4">Task Heading</label>
          <input type="text" name="" class="form-control" placeholder="Enter the Topic"  required id="topic">
        </div>
        <div class="col-12 ml-2 text-left">
          <label class="text-primary font-weight-bold h3">Task Description</label>
          <textarea class="form-control" placeholder="Enter the Description" required id="description"></textarea>
        </div>

    </div>

      </div>

      <!-- Modal footer -->
        <div class="modal-footer">
          <div class="col ml-2 text-left">
        <button type="button" class="btn btn-warning">RESET</button> </div>
           <div class="col ml-2 text-center">
        <button type="submit" class="btn btn-primary .open-AddBookDialog" role="submit" type="submit" id="task-assign-data">SUBMIT</button></div>
          <div class="col ml-2 text-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button></div>
        </div>
</form>
    </div>
  </div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
  var countDomain = 0;
  var ref = 0;

$(document).ready(function(){
  //task assign
  var myBookId;
$(document).on("click", ".open-AddBookDialog", function () {
     myBookId = $(this).data('id');
     $('#description').val('');
     $('#topic').val('');
     $(".modal-body #modal-user-id").val(myBookId);
});
   $('.modal-body form').submit(function(e){
    e.preventDefault();
    $.post(
      '<?php echo base_url() . bdaadminpath; ?>/Dashboard/insertTask',
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
          swal(myBookId, "Task Assigned Successfully to "+myBookId, "success");
          /*$('#topic').val('');
          $('#description').val('');*/
          /*$('#close-modal').trigger('click');*/
          location.reload(true);
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
  confirmButtonText: 'Yes, deactivated it!'
}).then((result) => {
  if (result.value) {
    $.post(
        '<?php echo base_url() . bdaadminpath; ?>/Dashboard/insertStatus',
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
    location.reload(true);
  }
});
   });

   //activate the login status
   $(document).on('click', '.active-btn-login', function(){
    Swal.fire({
  title: 'Are you sure?',
  text: "You will be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, activated it!'
}).then((result) => {
  if (result.value) {
    $.post(
        '<?php echo base_url() . bdaadminpath; ?>/Dashboard/insertStatusActive',
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
      'Activated!',
      'Your Intern has been activated.',
      'success'
    )
    location.reload(true);
  }
});
   });


});
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $(document).on('click', '.show-documents-intern', function() {
        var fileName = '<?php echo base_url(); ?>'+'application/controllers/Intern/uploads/'+$(this).attr('id')+'.pdf';
        var tit = $(this).attr('id');
            $("#dialog").dialog({
                modal: true,
                title: tit,
              width:540,
              height:450,
              position: {my:"center", at: "center", of: window},
              resizable: false,
              show: {
                effect: "blind",
                duration: 1000
              },
              hide: {
                effect: "blind",
                duration: 1000
              },
                buttons: {
                    Close: function () {
                        $(this).dialog('close');
                    }
                },
                open: function () {
                    var object = "<object data='"+fileName+"' type=\"application/pdf\" width=\"500px\" height=\"300px\">";
                    object += "If you are unable to view file, you can download from <a href = '"+fileName+"'>here</a>";
                    object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
                    object += "</object>";
                    object = object.replace(/{FileName}/g, "Files/" + fileName);
                    $("#dialog").html(object);
                }
            });
    });
</script>
<div id="dialog" style="display: none">
</div>

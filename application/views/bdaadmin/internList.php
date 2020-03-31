<style>
    input:focus, textarea:focus, select:focus{
        outline: none;
        border : 1px solid red;
    }
    /*task grouping checkbox */
    .task-grouping{
      display:none;
    }
    /*temp-div*/
    #temp-div{
      display: inline-block;
    }
    /*check mentor*/
    #check-mentor{
      display: none;
    }
    /*check mentor end*/
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
 </button> </h1>
  </div>

  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse-filter-new-data" aria-expanded="false" aria-controls="collapse-filter-new-data" id="filter-data-new">
    Filter List
  </button>
  
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#team-grouping-task" aria-expanded="false" aria-controls="team-grouping-task" id="groupingTask">
    Task Grouping
  </button>
<div class="collapse" id="team-grouping-task" id="temp-div">
    <button class="btn btn-success mt-1" id="array-of-task-group">Create team</button>
    <button class="btn btn-danger mt-1" id="array-of-task-group-cancel">Cancel</button>
</div>

<!--   
  <button class="btn btn-danger" id="groupingTaskId">Task Grouping ID</button>
  <button class="btn btn-danger" id="testing"> ID</button> -->
<div class="collapse fade search-filter" id="collapse-filter-new-data">
<form method="post" class="form-inline" action="<?php echo base_url() . bdaadminpath . '/Dashboard/filter_data_intern'; ?>">
  <label for="typeFilter">Choose Type of Filter:  </label>

<select  name="typeFilter" class="select">
  <option value="user_id" class="option">Intern_Id</option>
  <option value="name">Name</option>
  <option value="domain">Domain</option>
</select> &nbsp;&nbsp;
<input type="text" name="FilterData" placeholder="Enter the filter data" id="filter-input" required="">&nbsp;&nbsp;
<button type="submit" class="btn btn-danger filter">Search</button>
</form>
</div>


  <!-- table -->
<div class="row mt-2 list-content">
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
          <td scope="row" class="text-primary"> <input type="checkbox" name="" class="task-grouping" id="<?php echo $row->user_id; ?>"> <a href="<?php echo base_url() . bdaadminpath ?>/Dashboard/showDetails?id=<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></a></td>
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

      <div class="col ml-2 text-right">
      <input value="" id="modal-user-id" readonly class="text-danger" />
      </div>


<form class="container">
        <div class="col-12 ml-2 text-left">
          <label class="font-weight-bold h5 p-2">Task Heading</label>
          <input type="text" name="" class="form-control" placeholder="Enter the Topic"  required id="topic">
        </div>
        <br>
        <div class="col-12 ml-2 text-left">
          <label class="font-weight-bold h5 m-2">Task Description</label>
          <textarea class="form-control" placeholder="Enter the Description" required id="description" ></textarea>
        </div>

      <!-- Modal footer -->
        <div class="modal-footer">
          <div class="row">
          <div class="col ml-2 text-left">
        <button type="button" class="btn btn-warning" id="reset-modal-task-assign">RESET</button>
         </div>
           <div class="col ml-2 text-center">
        <button type="submit" class="btn btn-primary .open-AddBookDialog" role="submit" type="submit" id="task-assign-data">SUBMIT</button>
      </div>
          <div class="col ml-2 text-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
      </div>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
</div>
</div>
</div> <!-- main modal close div -->
<!-- modal for grouping task -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary sr-only" data-toggle="modal" data-target="#task-grouping-modal" id="task-group-modal-open">
  Launch grouping task modal
</button>

<!-- Modal -->
<div class="modal fade" id="task-grouping-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <button id="check-mentor" class="btn-outline-success btn">Reselect the Mentor</button>
     <form class="container" id="task-group-form">
      <div class="row">
        <div class="col-12 text-center text-danger">
          Project : 
        </div>
        <div class="col-12 text-center ">
          <input type="text" name="prj"  class="form-control" required id="t-g-task">
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center  text-danger">
          Description : 
        </div>
        <div class="col-12 text-center ">
          <textarea class="form-control" name="desc" required id="d-g-task"></textarea>
        </div>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"  id="clear-l-s">Close</button>
        <button type="submit" class="btn btn-primary" id="insert-grouping-task">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- end -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
  var countDomain = 0;
  var ref = 0;

$(document).ready(function(){
  //trigger the task grouping button if
  if(localStorage.getItem('team')===null){
     //alert('empty');
  }
  else{
    $('#groupingTask').trigger('click');
    $('.task-grouping').css('display', 'inline-block');
  }
  //clear ls
  $('#clear-l-s').click(function(){localStorage.clear(); location.reload(true);});
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
//reset the content of task assign 
$('#reset-modal-task-assign').click(function(){
  $('#topic').val('');
  $('#description').val('');
});

//task grouping
$(document).on('click', '#groupingTask', function(){
  $('.task-grouping').toggle('slow');
});

//checkbox 
var arr = [];
$(document).on('click', '.task-grouping', function(){
  var tempid = $(this).attr('id');
  if(arr.indexOf(tempid)==-1){
    arr = JSON.parse(localStorage.getItem('team')) || [];
    arr.push(tempid);
    localStorage.setItem('team', JSON.stringify(arr));
    /*alert('added');*/
  }
  else{
    let ind = arr.indexOf(tempid);
    if(ind > -1){
      /*alert('removed'+arr[ind]);*/
      arr.splice(ind);
      /*alert('removed'+arr[ind]);
      alert('lcoa = '+localStorage.getItem('team'));*/
      localStorage.setItem('team', JSON.stringify(arr));
      /*alert(localStorage.getItem('team'));*/
      /*alert('removed');*/
    }
  }
});
var te3 = [];
$(document).on('click', '#groupingTaskId', function(){
  $('input[type="checkbox"]').each(function(){ 
    /*if($(this).is(':checked')){
    te3 = JSON.parse(localStorage.getItem('team')) || [];
    te3.push($(this).attr('id'));
    alert(te3);
    localStorage.setItem('team', JSON.stringify(te3));
    }*/
  });//close of each function
});
var mentor = '';
//mentor for group task
$(document).on('click', '.mentor-group-task', function(){
  if($(this).is(':checked')){
     var grp = 'input:checkbox[name="'+ $(this).attr('name') + '"]'; 
     $(grp).prop('checked', false);
     $(this).prop('checked', true);

    $('.mentor-group-task').css('display', 'none');
    mentor =$(this).attr('id');
    /*alert(mentor);
    alert($(this).attr('id'));*/
   $('#'+ mentor).removeClass("text-primary").addClass('text-success');
   $('#check-mentor').css('display', 'inline-block');
  }
  else{
    $(this).prop('checked', false);
    mentor ='';
  }
  
});

$('#check-mentor').click(function(){
 
    $('.mentor-group-task').css('display', 'inline-block');
 
});
//insert grouping task
/*$('#insert-grouping-task').click(function(){
  if(mentor==''){
    alert('Please Select One Mentor');
    return false;
  }
  else{

  }
});*/
//cancel create team
$('#array-of-task-group-cancel').click(function(){$('#groupingTask').trigger('click'); arr=[]; localStorage.clear(); $('.task-grouping').each(function(){$(this).prop('checked', false);}); });
var lcl = [];
$(document).on('submit', '#task-group-form',function(e){
  e.preventDefault();
  if(mentor==''){
    alert('Please Select One Mentor');
    return false;
  }
  else{
    /*var adr = [];
    $("#task-group-table tr").each(function(){
        adr.push($(this).find("td:first").text());
        alert($(this).find("td:first").text()); //put elements into array
    });*/
    
  // Declare variables
  /*var input,  table, tr, td, i, txtValue;*/
/*  table = document.getElementById("task-group-table");
  tr = table.getElementsByTagName("tr");
  $(document).on(function(){
    table = document.getElementById("task-group-table");
  tr = table.getElementsByTagName("tr");
    // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      alert(txtValue);
    }
    else{
      alert('not');
    }
  }
  });*/
  
    $.post(
    '<?php echo base_url().bdaadminpath ?>/Dashboard/get_group_task',
    {
      data :JSON.parse(localStorage.getItem('team')),
      topic :$('#t-g-task').val() ,
      description :$('#d-g-task').val(),
      mentor: mentor
    },
    function(result){
      if(result=='error'){
        alert('Something Wrong!..');
        $('#t-g-task').val('') ,
        $('#d-g-task').val('')
        mentor = '';
        localStorage.clear();
        location.reload(true);
      }
      else{
        alert("Your Team is created!..");
        $('#t-g-task').val('') ,
        $('#d-g-task').val('')
        mentor = '';
        localStorage.clear();
        location.reload(true);
      }
    }
    );
  }
});
$('#array-of-task-group').click(function(){/*
  alert('arr = '+arr);
  alert('localStorage = '+localStorage.getItem('team'));*/
/*  $('#task-grouping-modal .modal-body').html(localStorage.getItem('team'));
  $('#task-group-modal-open').trigger('click');*/
  $.post(
    '<?php echo base_url().bdaadminpath ?>/Dashboard/take_group_task',
    {
      data :JSON.parse(localStorage.getItem('team')) 
    },
    function(result){
      if(result=='error'){
        alert('Does not Create team');
      }
      else{
       /* var res = '<table class="table"> <tr> <th> ID </th> <th> Name</th> <th> Domain </th> </tr> <tr> '+result[0]->user_id+' </tr> </table>'*/
        $('#task-grouping-modal .modal-body').html(result);
        $('#task-group-modal-open').trigger('click');
        /*localStorage.clear();*/
        arr = [];
      }
    }
    );
  /*localStorage.clear();*/
/*  arr = [];*/
 /* alert('arr = '+arr);
  alert('localStorage = '+localStorage.getItem('team'));*/
});

/*$('#testing').click(function(){alert(localStorage.getItem('team'))});*/
if(typeof(Storage) !== "undefined") {
// Code for localStorage/sessionStorage.
} else {
// Sorry! No Web Storage support..
alert('Sorry Your Browser does not support to create team');
}
});//close of $(document).ready()
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
                    object += "If you are unable to view file, you can download from <a href = '"+fileName+"'><p class='text-primary'>here</p></a>";
                    object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
                    object += "</object>";
                    object = object.replace(/{FileName}/g, "Files/" + fileName);
                    $("#dialog").html(object);
                }
            });
    });
</script>
<div id="dialog" style="display: none;">
</div>

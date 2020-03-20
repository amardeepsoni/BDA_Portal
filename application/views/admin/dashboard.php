<!-- admin card -->
<Style>
  a.custom-card,
a.custom-card:hover {
  color: inherit;
}
a{
  text-decoration: none;
}
.modal-dialog {
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        max-width:none !important;

    }
#notific{
  position: absolute;
  top: 6.2%;
  left: 78%;
}
</Style>
<div class="container mt-1">
<!--   <div class="row">
     <div class="col-12 text-right">
        <i class="fas fa-bell btn btn-link" title="<?php //echo $notification->num_rows(); ?>" id="notific" data-toggle="modal" data-target="#myModal" type="button"></i>
      </div>    
  </div> -->
  <br> <br>  
 <h1 align="right"><button type="button";  class="btn btn-warning"><i class='fas fa-download'>Generate Report</i>
 </h1></button>
 <br> <br>
<div class="container">
  
  <div class="card-columns"><a href="<?php echo base_url().adminpath ?>/Dashboard/intern_list" class="custom-card">
    <div class="card bg-info">
      <div class="card-body text-center">
        <p class="card-text">Total Interns</p><span class="h2 font-weight-bold mt-5"><?php echo $row->num_rows(); ?><span class="font-weight-normal ml-3"></span></span>
      </div>
    </div></a>
        <a href="<?php echo base_url().adminpath ?>/Dashboard/intern_school" class="custom-card"><div class="card bg-warning">
      <div class="card-body text-center">
        <p class="card-text">Total School Registered</p>
        <span class="h2 font-weight-bold mt-5 text-center"><?php echo $rows->num_rows();?></span>
      </div>
    </div> </a>
        <div class="card bg-success">
      <div class="card-body text-center">
        <p class="card-text">Today Present</p>
      </div>
    </div>
  </div>
</div>

<br> <br>

<div class="container-fluid">
  <div class="row">
    <div class="col" style="background-color:lightyellow;">Space Left for backend developer to place bar graph of the calls made so far (Day,Month,Year,Intern wise view)</div>
    <div class="col" style="background-color:lavender;">Space left for the backend developer to place pie chart of the calls that was successive out of total calls (Day,Month,Year,Intern wise view)</div>
  </div>
</div>

<br> <br>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4" style="background-color:lavender;">
    <div class="container">
  <h2>On Going Projects</h2>
   
  <p>Server Migration </p>
  <div class="progress">
    <div class="progress-bar progress-bar-striped" style="width:30%"></div>
  </div>
  <br>
  <p>Mobile App</p>
  <div class="progress">
    <div class="progress-bar bg-success progress-bar-striped" style="width:40%"></div>
  </div>
  <br>
  <p>Marketing</p>
  <div class="progress">
    <div class="progress-bar bg-info progress-bar-striped" style="width:50%"></div>
  </div>
  <br>
  <p>abc</p>
  <div class="progress">
    <div class="progress-bar bg-warning progress-bar-striped" style="width:60%"></div>
  </div>
  <br>
  <p>def</p>
  <div class="progress">
    <div class="progress-bar bg-danger progress-bar-striped" style="width:70%"></div>
  </div>
</div>

    </div>
    <div class="col-sm-8" style="background-color:lavenderblush;"> <div class="container">
  <h2>Today's Task</h2>
  <div class="alert alert-warning alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong><div class="container">          
  <table class="table text-center table-bordered table-hover">
    <thead>
      <tr>
        <th><font color="red">Intern_ID</th></font>
        <th><font color="red">Topic</th></font>
        <th><font color="red">Description</th></font>
        <th><font color="red">Add<br>Time</th></font>
        <th><font color="red">Completed<br>Time</th></font>
        <th><font color="red">Consumed<br>Time</th></font>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table></strong>
  </div> </th>
</div> </div>
  </div> 
</div>

<!-- modal for notifications -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Today Task</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="container-fluid mt-5">

  <!-- table -->
<div class="row">
  <div class="col-12">
    
  
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Intern_ID</th>
      <th scope="col">Topic</th>
      <th scope="col">Description</th>
      <th scope="col">Add-time</th>
      <th scope="col">Completed-time</th>
      <th scope="col">Consumed-time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php 
      if($notification->num_rows()>0){
       foreach($notification->result() as $row){
        ?>
        <tr>
          <th scope="row" class="text-primary"><a href="<?php echo base_url().adminpath ?>/Dashboard/showDetails?id=<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></a></th>
          <td><?php echo $row->topic; ?></td>
          <td><?php echo $row->description; ?></td>
          <td><?php echo $row->add_time; ?></td>
          <td><?php echo $row->complete_time; ?></td>
          <?php 
            $start = new DateTime($row->add_time);
            $end = new DateTime($row->complete_time);
            $diff = $start->diff($end);
          ?>
          <td> <?php echo $diff->format('%d days %h hours %i minutes %S seconds'); ?> </td>
        </tr>
        <?php
      }
    }
    else{
    ?>
      <tr>
        <td colspan="4">Today Completed Task not found</td>
      </tr>
    <?php
  } 

      ?>
    </tr>
  </tbody>
</table>
<div class="row">
<div class="col-12">
<p class="text-center font-weight-bold" style="word-spacing: 30px;"><?php //$this->pagination->create_links();?></p>
</div>
</div>
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
  $(document).ready(function(){
    /*$('#notific').click(function(){
      $('#').trigger
    });*/
  });
</script>

<!-- 
<div class="container"> 
  <aside class="float-right border ">
  <a  class="h3 mr-2 text-success" href="#">Add Quiz</a>
</aside>
</div> --><!-- 
<div class="clearfix"></div> -->
<!-- <div class="container-fluid mt-5"> -->

  <!-- table -->
<!-- <div class="row">
  <div class="col-12"> -->
    
  
<!-- <table class="table table-bordered">
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
      //if($fetch_data->num_rows()>0){
       // foreach($fetch_data->result() as $row){
        ?>
        <tr>
          <th scope="row" class="text-primary"><?php //echo $row->user_id; ?></th>
          <td><?php //echo $row->name;?></td>
          <td><?php// echo $row->domain;?></td>
          <td><a class="btn text-success" title="Active"><i class="fas fa-user m-1"></i></a>&nbsp;<a href="#" role="button" class="btn text-danger" title="Deactive"><i class="fas fa-user-slash m-1"></i></a>&nbsp;<a href="<?php// echo base_url().adminpath; ?>/Dashboard/taskAssign?id=<?php //echo $row->user_id; ?>" role="button" class="btn m-1 text-warning" title="Task Assign"><i class="fas fa-tasks"></i></a>&nbsp;<a href="#" role="button" class="btn btn-default m-1 " title="Delete"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php
    /*  }
    }*/
   /* else*/{
    ?>
      <tr>
        <td colspan="4">No data found</td>
      </tr>
    <?php
  } 

      ?>
    </tr>
  </tbody>
</table> -->
  <!-- table closed  -->
  <!-- modal  -->
  <!-- close modal  -->
<!-- </div> -->



<!-- <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Interns
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <table class="table table-bordered">
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
     // if($fetch_data->num_rows()>0){
        //foreach($fetch_data->result() as $row){
        ?>
        <tr>
          <th scope="row" class="text-primary"><?php //echo $row->user_id; ?></th>
          <td><?php// echo $row->name;?></td>
          <td><?php// echo $row->domain;?></td>
          <td><a class="btn text-success" title="Active"><i class="fas fa-user m-1"></i></a>&nbsp;<a href="#" role="button" class="btn text-danger" title="Deactive"><i class="fas fa-user-slash m-1"></i></a>&nbsp;<a href="<?php// echo base_url().adminpath; ?>/Dashboard/taskAssign?id=<?php //echo $row->user_id; ?>" role="button" class="btn m-1 text-warning" title="Task Assign"><i class="fas fa-tasks"></i></a>&nbsp;<a href="#" role="button" class="btn btn-default m-1 " title="Delete"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php
    /*  }
    }
    else{*/
    ?>
      <tr>
        <td colspan="4">No data found</td>
      </tr>
    <?php
/*  } 
*/
      ?>
    </tr>
  </tbody>
</table>
      </div>
    </div>
  </div>
</div>
</div>
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
</Style>
<div class="container mt-1">
  <div class="row">
     <div class="col-12 text-right">
        <i class="fas fa-bell btn btn-link" title="<?php echo $notification->num_rows(); ?>" id="notific" data-toggle="modal" data-target="#myModal" type="button"></i>
      </div>    
  </div>
<div class="row">
            <div class="col-xl-3 col-md-6 bg-muted">
              <a href="<?php echo base_url().adminpath ?>/Dashboard/intern_list" class="custom-card">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body border shadow rounded border-warning">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-muted mb-0 font-weight-bold">Hi Admin</h5>
                      <span class="h2 font-weight-bold mt-5"><?php echo $row->num_rows(); ?><span class="font-weight-normal ml-3">Intern</span></span>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                  </p>
                </div>
              </div>
            </a>
            </div>
            <div class="col-xl-3 col-md-6 bg-muted">
              <a href="<?php echo base_url().adminpath ?>/Dashboard/intern_school" class="custom-card">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body border shadow rounded border-warning">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-muted font-weight-bold mb-0">School Registered</h5>
                      <span class="h2 font-weight-bold mt-5 text-center"><?php echo $rows->num_rows();?></span>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                  </p>
                </div>
              </div>
            </a>
            </div>
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
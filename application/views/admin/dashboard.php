
<!-- admin card -->
<Style>
  a.custom-card,
a.custom-card:hover {
  color: inherit;
}
a{
  text-decoration: none;
}
</Style>
<div class="container mt-2">
<div class="row">
            <div class="col-xl-3 col-md-6 bg-muted">
              <a href="<?php echo base_url().adminpath ?>/Dashboard/intern_list" class="custom-card">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body border shadow rounded border-warning">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-muted mb-0">Hi Admin</h5>
                      <span class="h2 font-weight-bold mt-5"><?php echo $row->num_rows(); ?><span class="font-weight-normal ml-3">Intern</span></span>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                  </p>
                </div>
              </div>
            </a>
            </div>
    </div> 
</div><!-- 
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
</div> -->
<div class="container"> 
  <p class="display-4 text-center"><u class="text-primary">Admin</u></p>
  <aside class="float-right border ">
  <a  class="h3 mr-2 text-success" href="#">Add Quiz</a>
</aside>
</div>
<div class="clearfix"></div>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <p class="h4 text-warning">List of Intern</p>
    </div>
  </div>
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
          <th scope="row" class="text-primary"><?php echo $row->user_id; ?></th>
          <td><?php echo $row->name;?></td>
          <td><?php echo $row->domain;?></td>
          <td><a class="btn text-success" title="Active"><i class="fas fa-user m-1"></i></a>&nbsp;<a href="#" role="button" class="btn text-danger" title="Deactive"><i class="fas fa-user-slash m-1"></i></a>&nbsp;<a href="<?php echo base_url().adminpath; ?>/Dashboard/taskAssign?id=<?php echo $row->user_id; ?>" role="button" class="btn m-1 text-warning" title="Task Assign"><i class="fas fa-tasks"></i></a>&nbsp;<a href="#" role="button" class="btn btn-default m-1 " title="Delete"><i class="fas fa-trash-alt"></i></a></td>
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
  <!-- table closed  -->
  <!-- modal  -->
  <!-- close modal  -->
</div>

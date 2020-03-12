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
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php 
      if($fetch_data->num_rows()>0){
        foreach($fetch_data->result() as $row){
        ?>
        <tr>
          <th scope="row"><?php echo $row->user_id; ?></th>
          <td><?php echo $row->name;?></td>
          <td><?php echo $row->domain;?></td>
          <td><a class="btn fab fa-adn m-1" style='font-size:48px;color:red;' title="Active"></a>&nbsp;<a href="#" role="button" class="fas fa-book-dead btn active m-1"style='font-size:48px;' title="Deactive"></a>&nbsp;<a href="#taskAssigner" role="button" class="btn  active m-1" title="Task Assign"><i class="material-icons" style="font-size:48px">assignment</i></a>&nbsp;<a href="#" role="button" class="btn btn-default m-1 " title="Delete"><i class="material-icons" style="font-size:48px">delete</i></a></td>
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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskAssigner">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="taskAssigner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  <!-- close modal  -->
</div>

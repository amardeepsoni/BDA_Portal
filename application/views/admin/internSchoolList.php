
<div class="container-fluid mt-5">

  <!-- table -->
<div class="row">
  <div class="col-12">
    
  
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Intern ID</th>
      <th scope="col">School Name</th>
      <th scope="col">School Contact</th>
      <th scope="col">School Person</th>
      <th scope="col">Add Time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php 
      if($fetch_data->num_rows()>0){
       foreach($fetch_data->result() as $row){
        ?>
        <tr>
          <th class="" scope="row"><?php echo $row->user_id; ?></th>
          <td><?php echo $row->sName; ?></td>
          <td><?php echo $row->sContact; ?></td>
          <td><?php echo $row->sPerson; ?></td>
          <td><?php echo $row->add_time; ?></td>
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
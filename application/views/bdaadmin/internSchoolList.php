

<div class="container-fluid mt-1">
<!-- filter -->
 <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse-filter-new-data" aria-expanded="false" aria-controls="collapse-filter-new-data" id="filter-data-new">
    Filter List
  </button>
<div class="collapse fade" id="collapse-filter-new-data">
<form method="post" class="form-inline" action="<?php echo base_url() .adminpath .'/Dashboard/filter_data_intern_school_list'; ?>">
  <label for="typeFilter">Choose Type of Filter: </label>


<select  name="typeFilter">
  <option value="user_id">Intern_Id</option>
  <option value="sName">School Name</option>
  <option value="sAddress">School Address</option>
  <option value="sContact">School Contact</option>
  <option value="sPerson">School Person</option>
  <option value="add_time">Adding Time of School</option>
</select> &nbsp;&nbsp;
<input type="text" name="FilterData" placeholder="Enter the filter data" id="filter-input" required="">&nbsp;&nbsp;
<button type="submit" class="btn btn-danger">Search</button>
</form>
</div>
  <!-- table -->
<div class="row mt-2">
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
          <td class="text-primary"><?php echo $row->user_id; ?></td>
          <td><?php echo $row->sName; ?></td>
          <td><?php echo $row->sContact; ?></td>
          <td><?php echo $row->sPerson; ?></td>
          <td><?php echo date("d-m-Y, h:m:i a", strtotime($row->add_time)); ?></td>
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
<p class="text-center font-weight-bold" style="word-spacing: 30px;"><?= $this->pagination->create_links();?></p>
</div>
</div>
</div>
</div>
</div>
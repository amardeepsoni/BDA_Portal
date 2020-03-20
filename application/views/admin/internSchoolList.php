
<div class="container">  
<h1 align="right"><button type="button";  class="btn btn-warning"><i class='fas fa-download'>Generate Report</i>
 </h1></button>         
  <ul class="pagination">
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
    <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
    <li class="page-item"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseInternList" aria-expanded="false" aria-controls="collapseInternList" id="filter-data">
    Filter Intern List
  </button></li>
  </ul>
</p>
<div class="collapse fade" id="collapseInternList">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Names..">
    <input type="text" id="myIntern" onkeyup="myFunctionIntern()" placeholder="Search for Intern_ID..">
    <input type="text" id="myDomain" onkeyup="myFunctionDomain()" placeholder="Search for Domains.."><br>
</div></div>

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
          <td scope="row" class="text-primary"><a href="<?php echo base_url().adminpath ?>/Dashboard/showDetails?id=<?php echo $row->user_id; ?>"><?php echo $row->user_id; ?></a></td>
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
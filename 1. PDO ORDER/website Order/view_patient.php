<?php include_once('header.php');?>
          <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Dashboard</h3>
              </div>
              <div class="panel-body">
                 <div class="content-row">
                  <?php include_once('message.php');?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>View Patients </b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-striped table-hover" id="myTable">
                          <thead>
                            <tr>
                              <th>Sri No.</th>
                              <th>Full Name</th>
                              <th>Phone Number</th>
                              <th>Address</th>
                              <th>Illness</th>
                              <th>Allergies</th>
                              <th>Physician</th>
                              <th>Note</th>
                              <th>Created Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          $query=mysqli_query($con,"SELECT * FROM patient order by full_name ASC");
                          $c=0;
                          while($ab=mysqli_fetch_array($query))
                           {  ?>

                           <tr>
                              <td><?= ++$c?></td>
                              <td><?= $ab['full_name']?></td>
                              <td><?= $ab['phone_number']?></td>
                              <td><?= $ab['address']?></td>
                              <td><?= $ab['illness']?></td>
                              <td><?= $ab['allergies']?></td>
                              <td><?= $ab['physician']?></td>
                              <td><?= $ab['note']?></td>
                              <td><?= $ab['created_dt'];?></td>
                              <td><a onclick="return confirm('Are you sure you want to Update <?= $ab['full_name']?> ?')" href="edit_patient.php?p_id=<?= $ab['patient_id'];?>" class="btn btn-sm btn-success">Edit</a>
                               <a onclick="return confirm('Are you sure you want to Delete <?= $ab['full_name']?> ?')" href="delete_page.php?p_id=<?= $ab['patient_id'];?>" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>

                         <?php
                           } 
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
          </div><!-- content -->
        </div>
    </div>
  </div>  
    <!--footer-->
<?php include_once('footer.php');?> 
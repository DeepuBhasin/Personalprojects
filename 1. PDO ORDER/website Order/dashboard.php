<?php include_once('header.php');?>
          <div class="col-xs-12 col-sm-12 content">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Dashboard</h3>
              </div>
              <div class="panel-body">
                 <div class="content-row">
                  <?php include_once('message.php');?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>Dashboard </b>
                      </div>
                    </div>
                   <div class="panel-body">
                     
                      <div class="col-md-6">
                          <div class="alert alert-warning alert-dismissable">
                            <h4>Total Patient</h4>
                            <p>Total Number of Patients : <?php $query=mysqli_query($con,"SELECT * FROM patient");
                             echo mysqli_num_rows($query);   
                            ?></p><br/>
                            <a href="view_patient.php" class="btn btn-sm btn-info">View</a>
                          </div>
                      </div>
                        <div class="col-md-6">
                          <div class="alert alert-warning alert-dismissable">
                            <h4>Total Doctors</h4>
                            <p>Total Number Send : <?php $query=mysqli_query($con,"SELECT * FROM doctor");
                             echo mysqli_num_rows($query);   
                            ?></p><br/>
                            <a href="view_patient.php" class="btn btn-sm btn-info">View</a>
                          </div>
                      </div>
                    <div class="col-md-6">
                          <div class="alert alert-info alert-dismissable">
                            <h4>Total Users </h4>
                            <p>Total Number Send : <?php $query=mysqli_query($con,"SELECT * FROM login");
                             echo mysqli_num_rows($query);   
                            ?></p>
                            <p><a class="btn btn-info" href="view_user.php">View</a></p>
                          </div>
                      </div>
                    </div>
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
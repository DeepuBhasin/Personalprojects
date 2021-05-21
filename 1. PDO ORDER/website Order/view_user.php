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
                              <th>First Name</th>
                              <th>last Name</th>
                              <th>Email Id</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          $query=mysqli_query($con,"SELECT * FROM login order by first_name ASC");
                          $c=0;
                          while($ab=mysqli_fetch_array($query))
                           {  ?>

                           <tr>
                              <td><?= ++$c?></td>
                              <td><?= $ab['first_name']?></td>
                              <td><?= $ab['last_name']?></td>
                              <td><?= $ab['email_id']?></td>
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
<?php include_once('header.php');?>
          <div class="col-xs-12 col-sm-12 content">
            <div class="panel panel-default">
             <div class="panel-body">
                 <div class="content-row">
                  <?php include_once('message.php');?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>Dashboard </b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <div class="col-md-12">
                        <div class="alert alert-info alert-dismissable">
                          <h4>Last Login Details </h4>
                          <p>
                            <h6>Date : <?= date("d D/m/Y",strtotime($_SESSION['login_time']));?></h6>
                            <h6>Time : <?= date("H:i:s ",strtotime($_SESSION['login_time']));?></h6>
                            <strong>IpAddress <?= $_SESSION['login_address'];?></strong>
                          </p>
                        </div>
                      </div>
                      <div class="col-md-12">
                          <div class="alert alert-success alert-dismissable">
                            <h4>Total Contacts</h4>
                            <p>Total Number of Contact : <?php $user_count=mysqli_query($con,"SELECT count(user_id) as user_count FROM user where status=1");
                            $row = mysqli_fetch_object($user_count);   
                              echo $row->user_count; 
                            ?></p>
                            <p> <a href="view_contact_sms.php" class="btn-warning btn"> View </a></p>
                           </div>
                      </div>
                        <div class="col-md-12">
                          <div class="alert alert-warning alert-dismissable">
                            <h4>Sent Message Report</h4>
                            <p>Total Number of  SMS Sent : <?php $total_sms_count=mysqli_query($con,"SELECT count(sms_id) as sms_count FROM sms_history where status in ('sent','Failed')");
                             $row = mysqli_fetch_object($total_sms_count);   
                              echo $row->sms_count; 
                            ?></p>
                            <p>Total Number of SMS Sent Successfully : <?php $sent_count=mysqli_query($con,"SELECT count(sms_id) as sms_count FROM sms_history where status='Sent'");
                             $row = mysqli_fetch_object($sent_count);   
                              echo $row->sms_count;
                            ?></p>
                            <p>Total Number of SMS Failed to Deliver : <?php $failed_count=mysqli_query($con,"SELECT count(sms_id) as sms_count FROM sms_history where status='Failed'");
                             $row = mysqli_fetch_object($failed_count);   
                             echo $row->sms_count;
                            ?></p>
                            <p><a class="btn btn-warning" href="sent_sms.php">View</a></p>
                          </div>
                      </div>
                       <div class="col-md-12">
                          <div class="alert alert-info alert-dismissable">
                            <h4>Received Message Report</h4>
                            <p>Total Number of SMS Received : <?php $total_sms_count=mysqli_query($con,"SELECT count(sms_id) as sms_count FROM sms_history where status in ('received')");
                             $row = mysqli_fetch_object($total_sms_count);   
                              echo $row->sms_count; 
                            ?></p>
                           <p><a class="btn btn-warning" href="inbox.php">View</a></p>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="alert alert-warning alert-dismissable">
                            <h4>Total Message Report</h4>
                            <p>Total Number of  SMS : <?php $total_sms_count=mysqli_query($con,"SELECT count(sms_id) as sms_count FROM sms_history");
                             $row = mysqli_fetch_object($total_sms_count);   
                              echo $row->sms_count; 
                            ?></p>
                           <p><a class="btn btn-warning" href="sms_report.php">View</a></p>
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
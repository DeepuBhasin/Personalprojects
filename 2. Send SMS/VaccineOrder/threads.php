<?php include_once('header.php');?>
<link rel=stylesheet type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-default">
              <div class="panel-body">
                 <div class="content-row">
                  <?php include_once('message.php');?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>All Threads</b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <div class="table-responsive" style="overflow: auto;">
                        <table class="table table-hover table-striped table-hover" id="smsReport">
                          <thead>
                            <tr>
                              <th>Sri No.</th>
                              <th>Reply From</th>
                              <td>Action</td>
                              
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          $query=mysqli_query($con,"SELECT send_to FROM sms_history WHERE method='reply' group by send_to order by created_dt DESC");
                          $c=0;
                          while($ab=mysqli_fetch_array($query))
                           {  ?>

                           <tr>
                              <td><?= ++$c?></td>
                              <td><?= $ab['send_to']?></td>  
                              <td><a href="open_thread.php?thread_id=<?= base64_encode($ab['send_to']);?>" class="btn btn-success btn-sm">Show</a></td>  
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
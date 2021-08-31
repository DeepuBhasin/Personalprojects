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
                      <div class="panel-title"><b>SMS History </b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <div class="table-responsive" style="overflow: auto;">
                        <table class="table table-hover table-striped table-hover" id="myTable">
                          <thead>
                            <tr>
                              <th>Sri No.</th>
                              <th>Account SID</th>
                              <th>SID</th>
                              <th>Message Type</th>
                              <th>Send From</th>
                              <th>Send To</th>
                              <th>Message</th>
                              <th>Message Count</th>
                              <th>Status</th>
                              <th>Remarks</th>
                              <th>Created Date</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          $query=mysqli_query($con,"SELECT * FROM sms_history where method='reply' order by created_dt DESC");
                          $c=0;
                          while($ab=mysqli_fetch_array($query))
                           {  ?>

                           <tr>
                              <td><?= ++$c?></td>
                              <td><?= $ab['account_sid']?></td>
                              <td><?= $ab['sid']?></td>
                              <td><?= ucfirst($ab['type']); ?></td>
                              <td><?= $ab['send_to'];?></td>
                              <td><?= $ab['message_from']?></td>
                              <td><?= $ab['body']?></td>
                              <td><?= $ab['num_segments']?></td>
                              <td><?= $ab['status']?></td>
                              <td><?= $ab['remarks']?></td>
                              <td><?= $ab['created_dt'];?></td>
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
  <br/><br/><br/><br/>
    <!--footer-->
<?php include_once('footer.php');?> 
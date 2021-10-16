<?php include_once('header.php');
$thread_id=base64_decode($_GET['thread_id']);
?>
<link rel=stylesheet type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-default">
              <div class="panel-body">
                 <div class="content-row">
                  <?php include_once('message.php');?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>SMS Thread</b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <div class="table-responsive" style="overflow: auto;">
                        <table class="table table-hover table-striped table-hover" id="smsReport">
                          <thead>
                            <tr>
                              <th>Sri No.</th>
                              <th>Account SID</th>
                              <th>SID</th>
                              <th>Message Type</th>
                              <th>Send To</th>
                              <th>Send From</th>
                              <th>Message</th>
                              <th>Message Count</th>
                              <th>Status</th>
                              <th>Remarks</th>
                              <th>Created Date</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                         
                          $query=mysqli_query($con,"SELECT * FROM sms_history WHERE send_to like '$thread_id' order by created_dt DESC");
                          $c=0;
                          while($ab=mysqli_fetch_array($query))
                           {  ?>

                           <tr>
                              <td><?= ++$c?></td>
                              <td><?= $ab['account_sid']?></td>
                              <td><?= $ab['sid']?></td>
                              <td><?= ucfirst($ab['type']); ?></td>
                              <?php 
                                if($ab['method']=='out' || $ab['method']=='automatic out')
                                {
                              ?>
                                <td><?= $ab['send_to'];?></td>
                                <td><?= $ab['message_from']?></td>    
                              
                              <?php    
                                }else {?>
                                  <td><?= $ab['message_from']?></td>  
                                  <td><?= $ab['send_to'];?></td>
                                
                              <?php      
                                }

                              ?>
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
    <!--footer-->
    
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#smsReport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                title:'Thread SMS',

            },
            {
                extend: 'pdf',
                title:'Thread SMS',
                orientation: 'landscape',
                pageSize: 'A4'

            },
            {
                extend: 'excel',
                title:'Thread SMS',

            },
        ],
        "lengthMenu": [[50]],
    } );
} );
</script>
<?php include_once('footer.php');?> 
<?php include_once('header.php');?>


          <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-default">
              <div class="panel-body">
                 <div class="content-row">
                  <?php include_once('message.php');?>
                  <?php 
                  if(isset($_POST['send']))
                   {

                     $message=mysqli_real_escape_string($con,htmlentities(trim($_POST['message'])));
                     $from=$_POST['from'];
                     
                    $count = count($_POST['mobile_number']);

                     for($i=0;$i<$count;$i++) {

                      $mobile_number = '+'.$_POST['mobile_number'][$i];

                      $api = curl_init("https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json");
                      curl_setopt_array($api, array(
                          CURLOPT_RETURNTRANSFER => 1,
                          CURLOPT_POST => 1,
                          CURLOPT_HTTPHEADER => array("Authorization: Basic ".base64_encode($sid.':'.$auth)),
                          CURLOPT_POSTFIELDS => array(
                              'Body' =>$message,
                              'To' => $mobile_number,
                              'From' =>$from
                          )
                      ));
                      
                      $resp = curl_exec($api);
                      $resp = json_decode($resp,true);

                    if(isset($resp['sid']))
                      {
                         $account_sid=$resp['account_sid'];
                         $message_sid=$resp['sid'];
                         $type='Bulk SMS';
                         $send_to=$mobile_number;
                         $message_from=$from;
                         $body=$message;
                         $num_segments=$resp['num_segments'];
                         $created_by=$_SESSION['id'];
                         $created_dt=$get_time;
                         $status="Sent";
                         $method="out";
                         $remarks="Message Sent Successfully";
                       
                      }
                      else
                      {  
                         $account_sid="Not Availabe";
                         $message_sid="Not Availabe";
                         $type='Bulk SMS';
                         $send_to=$mobile_number;
                         $message_from=$from;
                         $body=$message;
                         $num_segments=0;
                         $created_by=$_SESSION['id'];
                         $created_dt=$get_time;
                         $status="Failed";
                         $method="out";
                         $remarks=mysqli_real_escape_string($con,stripslashes(htmlentities(trim($resp['message']))));
                         
                      }

                      $x=mysqli_query($con,"INSERT into sms_history(account_sid,sid,type,send_to,message_from,body,num_segments,status,remarks,method,created_by,created_dt) values('$account_sid','$message_sid','$type','$send_to','$message_from','$body',$num_segments,'$status','$remarks','$method',$created_by,'$created_dt')");
                    }

                    if(isset($resp)){
                    ?>
                      <div class="alert alert-success">
                        <strong>Program Executed Successfully Please Check Your Reports</strong>
                      </div>
                    <?php
                    } 
                  }
                  ?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>Send SMS To Contact </b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <form role="form" action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="form-group">
                          <label for="mobile_number">Select User *</label>
                          
                          <div class="table-responsive">
                            <table class="table table-hover stripped">
                              <thead>
                                <tr>
                                  <th><input type="checkbox" name="" id="select_all"></th>
                                  <th>Name</th>
                                  <th>Phone Number</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $query=mysqli_query($con,"SELECT full_name,mobile_number FROM user where status=1 order by full_name ASC");
                                $c=0;
                                while($a=mysqli_fetch_array($query))
                                {?>
                                <tr>
                                <tr id="check_column<?= ++$c;?>">
                                      <td><input type="checkbox" onchange="radio_check(this);" id="<?= $c?>" class="my_check_box<?= $c?>" name="mobile_number[]" value="<?= $a['mobile_number']?>"></td>
                                  <td><?= ucfirst($a['full_name']);?></td>
                                  <td><?= $a['mobile_number']?></td>
                                </tr>

                                <?php
                                } 
                                ?>
                              </tbody>
                            </table>
                          </div>
                          
                          
                         
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="from">From *</label>
                          <select name="from" required="" class="form-control" id="from">
                            <option value="">Select From</option>
                            <?php for($i=0;$i<count($from_list);$i++){?>
                              <option value="<?= $from_list[$i]?>"><?= $from_list[$i]?></option>
                            <?php }?>
                          </select>
                        </div>
                        
                        
                        <div class="form-group">
                          <label for="message">Enter Message *</label>
                          <textarea id="message" name="message" placeholder="Enter Message" required="" class="form-control"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-success" name="send">Send</button> <button type="reset" class="btn btn-info">Reset</button>
                      </form>
                    </div>
                  </div>

                </div>
          </div><!-- content -->
        </div>
    </div>
  </div>  
    <!--footer-->
 <script>
   function radio_check(val)
    {
      var check_column=$('#check_column'+val.id);
      var check_column_class=val.className;
    
    if($('.'+check_column_class).is(':checked'))
      {
        $(check_column).css({'background-color':'#009688','color':'#fff'});
      }
      else {
          $(check_column).css({'background-color':'#fff','color':'#000'});
        } 

        var x=($(':checkbox:checked').length);
        if($('#select_all').is(':checked'))
        {
          x=x-1;
        }
        if(x<=0)
        {
          $('#select_all').prop('checked', false);
          $('#send_button').attr('disabled',true);
        }
        else {
          $('#select_all').prop('checked',true);
          $('#send_button').removeAttr('disabled');
        }

    }
 </script>   
<?php include_once('footer.php');?> 
<script>
  $('#select_all').change(function(){
  if($(this).is(':checked'))
  {
    $('input:checkbox').prop('checked', true);
    $('tr[id^=check_column]').css({'background-color':'#009688','color':'#fff'});
    $('#send_button').removeAttr('disabled');

  }
  else {
    $('input:checkbox').prop('checked', false);
    $('tr[id^=check_column]').css({'background-color':'#fff','color':'#000'});
    $('#send_button').attr('disabled',true)
  }
});
</script>
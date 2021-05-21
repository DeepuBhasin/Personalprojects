<?php include_once('header.php');
$query=mysqli_query($con,"SELECT * FROM login where id=".$_SESSION['id']);
while($ab=mysqli_fetch_array($query))
{
  $first_name=$ab['first_name'];
  $last_name=$ab['last_name'];
  $email_id=$ab['email_id'];
  $mobile_number=$ab['mobile_number'];
}

?>
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
                      <div class="panel-title"><b>Update Profile </b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <form role="form" action="program_file.php" method="post">
                        <div class="form-group">
                          <label for="first_name">Full Name *</label>
                          <input type="text" class="form-control" name="first_name" id="first_name"  required="required" autocomplete="off" placeholder="Enter Full Name *" value="<?= ucfirst($first_name);?>">
                        </div>
                        <div class="form-group">
                          <label for="last_name">Last Name *</label>
                          <input type="text" class="form-control" name="last_name" id="last_name"  required="required" autocomplete="off" placeholder="Enter Full Name *" value="<?= ucfirst($last_name);?>">
                        </div>
                        <div class="form-group">
                          <label for="mobile_number">Mobile Number *</label>
                          <input type="number" class="form-control" name="mobile_number" id="mobile_number"  required="required" autocomplete="off" placeholder="Enter Mobile Number *" value="<?= ucfirst($mobile_number);?>">
                        </div>
                        <div class="form-group">
                          <label for="email_id">Email Id *</label>
                          <input type="email" class="form-control" name="email_id" id="email_id"  required="required" autocomplete="off" placeholder="Enter Email Id *" value="<?= $email_id;?>">
                        </div>
                       <button type="submit" class="btn btn-success" name="update">Update</button>
                      </form>
                    </div>
                  </div>

                </div>
          </div><!-- content -->
        </div>
    </div>
  </div>  
    <!--footer-->
<?php include_once('footer.php');?> 
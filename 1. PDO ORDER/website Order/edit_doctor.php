<?php 
 include_once('header.php');

if(isset($_GET['d_id']))
{
 
  include_once('database.php');
    $doctor_id=$_GET['d_id'];
    $query=mysqli_query($con,"SELECT * FROM doctor where doctor_id=$doctor_id");
    if(mysqli_num_rows($query)==1)
    {
       
       while($ab=mysqli_fetch_array($query))
        {
          $full_name=$ab['full_name'];
          $specialist=$ab['specialist'];
          $phone_number=$ab['phone_number'];
          $address=$ab['address'];
          $note=$ab['note'];
          $doctor_id=$ab['doctor_id'];
        }
    } 
    else
    {
      header("location:view_doctor.php");
    } 
   
}
else
{
  header("location:view_doctor.php");
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
                      <div class="panel-title"><b>Add Doctor</b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <form role="form" action="program_file.php" method="post">
                      <input type="hidden" value="<?= $doctor_id; ?>" name="doctor_id">
                        <div class="form-group">
                          <label for="full_name">Full Name *</label>
                          <input type="text" class="form-control" name="full_name" id="full_name"  required="required" autocomplete="off" placeholder="Enter Full Name " value="<?= $full_name ?>">
                        </div>
                        <div class="form-group">
                          <label for="specialist">Specialist *</label>
                          <input type="text" class="form-control" name="specialist" id="specialist"  required="required" autocomplete="off" placeholder="Enter Specialist" value="<?= $specialist ?>">
                        </div>
                        <div class="form-group">
                          <label for="phone_number">Phone Number *</label>
                          <input type="text" class="form-control" name="phone_number" id="phone_number"  required="required" autocomplete="off" placeholder="Enter Phone Number " value="<?= $phone_number ?>">
                        </div>
                        <div class="form-group">
                          <label for="address">Address *</label>
                          <input type="text" class="form-control" name="address" id="address"  required="required" autocomplete="off" placeholder="Enter Address" value="<?= $address ?>">
                        </div>

                        <div class="form-group">
                          <label for="note">Note *</label>
                          <textarea class="form-control" name="note" id="note"  required="required" autocomplete="off" placeholder="Enter Note *"><?= $note ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-success" name="update_doctor">Update</button>
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
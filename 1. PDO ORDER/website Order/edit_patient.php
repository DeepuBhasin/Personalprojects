<?php 
 include_once('header.php');

if(isset($_GET['p_id']))
{
 
  include_once('database.php');
    $patient_id=$_GET['p_id'];
    $query=mysqli_query($con,"SELECT * FROM patient where patient_id=$patient_id");
    if(mysqli_num_rows($query)==1)
    {
       
       while($ab=mysqli_fetch_array($query))
        {
          $full_name=$ab['full_name'];
          $phone_number=$ab['phone_number'];
          $address=$ab['address'];
          $illness=$ab['illness'];
          $allergies=$ab['allergies'];
          $physician=$ab['physician'];
          $note=$ab['note'];
          $patient_id=$ab['patient_id'];
        }
    } 
    else
    {
      header("location:view_patient.php");
    } 
   
}
else
{
  header("location:view_patient.php");
}  

?>
          <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a>Dashboard</h3>
              </div>
              <div class="panel-body">
                 <div class="content-row">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>Edit Patient</b>
                      </div>
                    </div>
                   <div class="panel-body">
                      <form role="form" action="program_file.php" method="post">
                      <input type="hidden" value="<?= $patient_id; ?>" name="patient_id">
                        <div class="form-group">
                          <label for="full_name">Full Name *</label>
                          <input type="text" class="form-control" name="full_name" id="full_name"  required="required" autocomplete="off" placeholder="Enter Full Name " value="<?= $full_name ?>">
                        </div>
                        <div class="form-group">
                          <label for="phone_number">Phone Number *</label>
                          <input type="text" class="form-control" name="phone_number" id="phone_number"  required="required" autocomplete="off" placeholder="Enter Phone Number " value="<?= $phone_number ?>">
                        </div>
                        <div class="form-group">
                          <label for="address">Address *</label>
                          <input type="text" class="form-control" name="address" id="address"  required="required" autocomplete="off" placeholder="Enter Address" value="<?= $address; ?>">
                        </div>
                        <div class="form-group">
                          <label for="illness">Illness *</label>
                          <input type="text" class="form-control" name="illness" id="illness"  required="required" autocomplete="off" placeholder="Enter Illness " value="<?= $illness ?>">
                        </div>
                        <div class="form-group">
                          <label for="allergies">Allergies *</label>
                          <input type="text" class="form-control" name="allergies" id="allergies"  required="required" autocomplete="off" placeholder="Enter Allergies " value="<?= $allergies ?>">
                        </div>
                        <div class="form-group">
                          <label for="physician">Physician *</label>
                          <input type="text" class="form-control" name="physician" id="physician"  required="required" autocomplete="off" placeholder="Enter Physician " value="<?= $physician ?>">
                        </div>

                        <div class="form-group">
                          <label for="note">Note *</label>
                          <textarea class="form-control" name="note" id="note"  required="required" autocomplete="off" placeholder="Enter Note *" ><?= $note ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-success" name="update_patient">Update</button>
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
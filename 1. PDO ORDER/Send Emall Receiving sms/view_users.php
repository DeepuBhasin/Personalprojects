<?php
session_start();
if(!isset($_SESSION['user_name']))
{
	header("location:index.php");
}
include_once('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
</head>
<body>
<?php include_once('header.php');?>
<div class="container">
<br/>
<br/>
  <div class="row">
        <center style="color:#000;">
          <h1>VIEW USERS</h1>
          <br/>
        </center>
          <br/>
          <?php
           if(isset($_GET['message']))
                      {
                        if($_GET['message']=='success')
                        {
                            ?>
                            <div class="alert alert-success">
                              <strong>Success : </strong> User Updated Successfully.
                            </div>
                            <?php
                        }
                        if($_GET['message']=='fail')
                        {
                            ?>
                            <div class="alert alert-danger">
                              <strong>Error : </strong> Database Problem.
                            </div>
                            <?php
                        } 
                        if($_GET['message']=='not_update')
                        {
                            ?>
                            <div class="alert alert-danger">
                              <strong>Error : </strong> Data Not Update.
                            </div>
                            <?php
                        } 
                        if($_GET['message']=='limit_error')
                        {
                            ?>
                            <div class="alert alert-danger">
                              <strong>Error : </strong> Data cannot update because your Limit is less then Actual Limit.
                            </div>
                            <?php
                        }   
                      } 
          ?>
            <!-- <h1>Please Wait.</h1> -->
              <table class="table-hover table-bordered table-responsive table-striped" id="table_id">
                <thead>
                  <tr>
                    <th>Sr. No</th>
                    <th>Full Name</th>
                    <th>Destination Number</th>
                    <th>Email Id</th>
                    <th>Limit</th>
                    <th>Limit Status</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    try{
                        
                        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        // binding Parameters and provide name to parameters 
                        $stmt = $DBH->prepare("SELECT * FROM didww_user ORDER BY full_name DESC;"); // 
                          
                          //Assigning Values to parameters  
                          $stmt->execute();
                          
                          if($stmt->rowCount()>0)
                          {
                            $c=0;
                            // set the resulting array to object
                            while($row = $stmt->fetch(PDO::FETCH_OBJ))
                            {
                              ?>
                              <tr>
                                <td><?= ++$c;?></td>
                                <td><?= ucwords($row->full_name);?></td>
                                <td><?= $row->user_number?></td>
                                <td><?= $row->email_id?></td>
                                <td><?= $row->user_limit?></td>
                                <td><?php if($row->limit_status==0){echo "Active";}else{echo "Over";} ?></td>
                                <td><?= $row->created_dt?></td>
                                <td><?php if($row->status==1){echo "Active";}else{echo "Inactive";} ?></td>
                                <td><a href="update_user.php?id=<?= base64_encode($row->user_id) ?>" class="btn btn-success">UPDATE</a></td>
                              </tr>
                              <?php
                            }
                          }
                          $DBH = null;
                        }
                       catch(PDOException $e)
                        {
                          echo $e->getMessage();
                        }   
                  ?>
            </tbody>
          </table> 
      </div>
      <?php include_once('footer.php');?>  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
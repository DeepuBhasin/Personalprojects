<?php include_once('header.php');
include_once('../db.php');
?>

        <!-- List Posts -->
            <div class="main-wrap">
                <div class="container">
                    <div class="row">
                        <div class="main col-md-8 col-md-offset-2" id="main">
                        <?php include_once('../message.php');?>   
                            <div class="post">
                                <h1>Change Password</h1><br/>
                                <form id="addCustomerSubmit" action="prog_file.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="old_pass" class="col-sm-4 control-label">Old Password * :</label>
                                        <input type="password" name="old_pass" id="old_pass" class="form-control" required="required" placeholder="Enter Old Password *" maxlength="50">
                                </div>
                                <div class="form-group">
                                        <label for="new_pass" class="col-sm-4 control-label">New Pasword * :</label>
                                        <input type="password" name="new_pass" id="new_pass" class="form-control" required="required" placeholder="Enter New Password *" maxlength="50">
                                </div>
                                <div class="form-group">
                                        <label for="re_pass" class="col-sm-4 control-label">Retype Password * :</label>
                                        <input type="password" name="re_pass" id="re_pass" class="form-control" required="required" placeholder="Enter Password Again *" maxlength="50">
                                </div>
                                    <button type="submit" name="change_password" class="btn btn-success">Change</button>
                                    <button type="reset" class="btn btn-info">Clear</button>
                                 </form>
                            </div>
                            
                        </div>
                        <!-- Sidebar -->
                    </div>
                </div>
            </div>
            <script>
       
       function functionBlock(element,message){
            alert(message);
            element.value='';
            element.focus();
             return false;

       }

       let addCustomerSubmit = document.getElementById('addCustomerSubmit');
       addCustomerSubmit.addEventListener('submit',function(e){
           
        let old_pass = document.getElementById('old_pass');
        let new_pass = document.getElementById('new_pass');
        let re_pass = document.getElementById('re_pass');
        

            if(old_pass.value.trim().length==0){
                e.preventDefault();
               functionBlock(old_pass,'Please Enter Old Password');

            }else if(new_pass.value.trim().length==0){
                e.preventDefault();
               functionBlock(new_pass,'Please Enter New Password');
                
            }else if(re_pass.value.trim().length==0){
                e.preventDefault();
               functionBlock(re_pass,'Please Enter Again New Password');
                
            }else if(re_pass.value!==new_pass.value){
                e.preventDefault();
                functionBlock(re_pass,'Password and Confirm Password Don\'t match');
                
            }else{
                let check = confirm('Are you sure you want to Update Password ?');
                if(check==true){
                    return true;
                }else{
                     e.preventDefault();
                    return false;
                }
            }
       });

        
    </script> 
<?php include_once('footer.php');?>
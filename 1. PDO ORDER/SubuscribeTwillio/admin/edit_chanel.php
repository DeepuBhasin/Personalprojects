<?php include_once('header.php');
$id=$_GET['id'];
$result=mysqli_query($con,"SELECT * FROM customer_table where customer_id='$id'");
$result=mysqli_fetch_object($result);

?>
        <!-- List Posts -->
            <div class="main-wrap">
                <div class="container">
                    <div class="row">
                        <div class="main col-md-8 col-md-offset-2" id="main">
                         
                            <div class="post">
                                <h1>Update Customer</h1><br/>
                               <form id="addCustomerSubmit"  action="prog_file.php" method="post" autocomplete="off">
                               <input type="hidden" name="customer_id" value="<?= $result->customer_id;?>">
                                        <div class="form-group">
                                            <label for="mac_address" class="col-sm-5 control-label">MAC Address * :</label>
                                            <input type="text" name="mac_address" id="mac_address" class="form-control" required="required" placeholder="Enter MAC Address *" maxlength="150" value="<?= $result->mac_adddress?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="customer_name" class="col-sm-5 control-label">Customer Name * :</label>
                                            <input type="text" name="customer_name" id="customer_name" class="form-control" required="required" placeholder="Enter Customer Name *" maxlength="50" value="<?= $result->customer_name?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number" class="col-sm-5 control-label">Phone Number (with country code) * :</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" required="required" placeholder="Enter Phone Number *" maxlength="50"  value="<?= $result->phone_number?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="start_sub" class="col-sm-5 control-label">Start Subscription * :</label>
                                            <input type="Date" name="start_sub" id="start_sub" class="control-label col-sm-6" required="required" placeholder="Enter Start Subscription *" maxlength="50" value="<?= $result->start_sub?>">
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label for="sub_type" class="col-sm-5 control-label">Subscription Type * :</label>
                                            <select name="sub_type" required="" class="control-label col-sm-6" id="sub_type">
                                                <option value="">Select Type</option>
                                                <option value="1M" <?php if($result->sub_type=='1M'){echo "SELECTED";}?> >1 Month</option>
                                                <option value="3M" <?php if($result->sub_type=='3M'){echo "SELECTED";}?> >3 Month</option>
                                                <option value="6M" <?php if($result->sub_type=='6M'){echo "SELECTED";}?> >6 Month</option>
                                                <option value="12M" <?php if($result->sub_type=='12M'){echo "SELECTED";}?> >12 Month</option>
                                            </select>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label for="sub_type" class="col-sm-5 control-label">Sub Status * :</label>
                                            <select name="status" required="" class="control-label col-sm-5" id="sub_type">
                                                <option value="">Select Type</option>
                                                <option value="1" <?php if($result->status=='1'){echo "SELECTED";}?> >Active</option>
                                                <option value="0" <?php if($result->status=='0'){echo "SELECTED";}?> >Inactive</option>
                                            </select>
                                        </div>
                                        <br/>
                                    <button type="submit" name="update_chanel" class="btn btn-success">Update</button>
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
           
        let mac_address = document.getElementById('mac_address');
        let customer_name = document.getElementById('customer_name');
        let phone_number = document.getElementById('phone_number');
        let start_sub = document.getElementById('start_sub');

            if(mac_address.value.trim().length==0){
                e.preventDefault();
               functionBlock(mac_address,'Please Enter Mac Address');

            }else if(customer_name.value.trim().length==0){
                e.preventDefault();
               functionBlock(customer_name,'Please Enter Customer Name');
                
            }else if(phone_number.value.trim().length==0){
                e.preventDefault();
               functionBlock(phone_number,'Please Enter Phone Number');
                
            }else if(isNaN(phone_number.value.trim())){
                e.preventDefault();
                functionBlock(phone_number,'Please Enter Numbers Only in Phone Number Field');
                
            }else if(start_sub.value.trim().length==0){
                e.preventDefault();
             functionBlock(start_sub,'Please Select Subscription Start');  
            }else{
                let check = confirm('Are you sure you want to Update Customer ?');
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
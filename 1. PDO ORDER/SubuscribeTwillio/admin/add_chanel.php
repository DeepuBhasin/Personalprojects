<?php
include_once('header.php');
include_once('../db.php');
?>
        <!-- List Posts -->
            <div class="main-wrap">
                <div class="container">
                    <div class="row">
                        <div class="main col-md-8 col-md-offset-2" id="main">
                        <?php include_once('../message.php');?>   
                            <div class="post">
                                <h1>Add Customer</h1><br/>
                                    <form id="addCustomerSubmit" action="prog_file.php" method="post" autocomplete="off" >
                                        <div class="form-group">
                                            <label for="mac_address" class="col-sm-5 control-label">MAC Address * :</label>
                                            <input type="text" name="mac_address" id="mac_address" class="form-control" required="required" placeholder="Enter MAC Address *" maxlength="150">
                                        </div>
                                        <div class="form-group">
                                            <label for="customer_name" class="col-sm-5 control-label">Customer Name * :</label>
                                            <input type="text" name="customer_name" id="customer_name" class="form-control" required="required" placeholder="Enter Customer Name *" maxlength="50">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number" class="col-sm-5 control-label">Phone Number (with country code) * :</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" required="required" placeholder="Enter Phone Number *" maxlength="50">
                                        </div>
                                        <div class="form-group">
                                            <label for="start_sub" class="col-sm-5 control-label">Subscription Start * :</label>
                                            <input type="Date" name="start_sub" id="start_sub" class="control-label col-sm-6" required="required" placeholder="Enter Start Subscription *" maxlength="50">
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label for="sub_type" class="col-sm-5 control-label">Subscription Type * :</label>
                                            <select name="sub_type" required="" class="control-label col-sm-6" id="sub_type">
                                                <option value="">Select Type</option>
                                                <option value="1M">1 Month</option>
                                                <option value="3M">3 Month</option>
                                                <option value="6M">6 Month</option>
                                                <option value="12M">12 Month</option>
                                            </select>
                                        </div>
                                        <br/>
                                    
                                        <button type="submit" name="add"  class="btn btn-success">Create</button>
                                        <button type="reset" class="btn btn-danger">Clear</button>
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
                let check = confirm('Are you sure you want to Add Customer ?');
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
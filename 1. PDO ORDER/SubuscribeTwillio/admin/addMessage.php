<?php include_once('header.php');
$result=mysqli_query($con,"SELECT * FROM message_table where message_id=1");
$result=mysqli_fetch_object($result);

?>

        <!-- List Posts -->
            <div class="main-wrap">
                <div class="container">
                    <div class="row">
                        <div class="main col-md-8 col-md-offset-2" id="main">
                             <?php include_once('../message.php');?>   
                            <div class="post">
                                <h1>Add Message</h1><br/>
                                <form id="addCustomerSubmit" action="prog_file.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-left:-2%">
                                            <textarea rows="10" type="text" name="textMessage" id="textMessage" class="form-control" required="required" placeholder="Enter Message *"><?= htmlspecialchars($result->message_text);?></textarea>
                                        </div>
                                    </div>
                                     <div>
                                        <p id="messageCount"> Message Count : 0</p>
                                     </div>
                                    <button type="submit" name="add_message" class="btn btn-success">Save</button>
                                    <button type="reset" class="btn btn-danger">Clear</button>
                                 </form>
                            
                            <h4>Note : Use {{name}} for Customer Name</h4>
                            <h4>Note : Use {{phone}} for Customer Number</h4>
                            </div>
                        <!-- Sidebar -->
                    </div>
                </div>
            </div>
<script>
        (function(){
            let textMessage = document.getElementById('textMessage');
            let textCount = textMessage.value.trim().length;
            document.getElementById('messageCount').innerHTML = `Message Count : ${textCount}`;
            
        })();
       
       function functionBlock(element,message){
            alert(message);
            element.value='';
            element.focus();
             return false;
        }

       let addCustomerSubmit = document.getElementById('addCustomerSubmit');
       addCustomerSubmit.addEventListener('submit',function(e){
           
        let textMessage = document.getElementById('textMessage');
        
        if(textMessage.value.trim().length==0){
                e.preventDefault();
               functionBlock(textMessage,'Please Enter Subscription Message');
            }else{
                let check = confirm('Are you sure you want to Save Message ?');
                if(check==true){
                    return true;
                }else{
                     e.preventDefault();
                    return false;
                }
            }
       });

       let textMessage = document.getElementById('textMessage');
       addCustomerSubmit.addEventListener('input',function(e){
           let textCount = textMessage.value.trim().length;
           document.getElementById('messageCount').innerHTML = `Message Count : ${textCount}`;
       });

        
    </script> 
<?php include_once('footer.php');?>
<?php include_once'header.php';
include_once'__db.php';

if(isset($_POST['submit'])){
    
    $offer_id = $_POST['offer_id'];
    $from_user_id = $_POST['send_by'];
    $to_user_id = $_POST['send_to'];
    $message = $_POST['message'];

        $sql = "INSERT INTO message values(null,$from_user_id,$to_user_id,$offer_id,CURRENT_TIMESTAMP(),'$message')";
    
    $x = mysqli_query($con,$sql);

    $sql = "UPDATE offer set message_status=1 where id=$offer_id";
    
    $y = mysqli_query($con,$sql);

    if($x&&$y)
    {
        header('location:sendInbox.php?id='.$offer_id.'&status=success&message='.urlencode('Message Sent Successfully'));
    }
    else
    {
        header('location:sendInbox.php?id='.$offer_id.'&status=danger&message='.urlencode('Database Problem'));    
    }
    
    
}



$offer_id = $_GET['id'];
$user_id = $_SESSION['id'];
 $sql = "SELECT h.*,o.user_id,o.send_to,o.offer,o.accepted,o.submitted as offer_submitted,urs.email as sent_by,urr.email as send_to_email FROM offer as o INNER JOIN hammer as h ON h.id=o.hammer_id INNER JOIN user as urs ON urs.id=o.user_id INNER JOIN user as urr ON urr.id=o.send_to WHERE o.id=$offer_id";

$offer_data= mysqli_fetch_assoc(mysqli_query($con,$sql));




?>
 

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>CHAT BOX (Send)</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
              <?php include_once('sidemenu.php');?>
                <div class="col-md-8">
                 <?php include_once'message.php';?>
                    <div class="product-content-right">
                        <div class="woocommerce">
                        <h2 class="text-warning">OFFER DESCRIPTION</h2>       
                            <div id="customer_details" class="col8-set">
                                <div class="col-3">
                                    <div class="woocommerce-shipping-fields">
                                           <div class="shipping_address" style="display: block;">
                                                <table class="table table-bordered">
                                                <tr><td>Title</td><td>Information</td></tr>
                                                <tr><td>Hammer Title</td><td><?= $offer_data['title'];?></td></tr>
                                                <tr><td>Hammer Description</td><td><?= $offer_data['description'];?></td></tr>
                                                <tr><td>Hammer Image</td><td><img src="img/uploaded/<?= $offer_data['image'];?>" class="img-responsive img-thumbnail" width="100" alt=""></td></tr>
                                                <tr><td>Offer Description</td><td><?= $offer_data['offer'];?></td></tr>
                                                <tr><td>Offer Submitted</td><td><?= $offer_data['offer_submitted'];?></td></tr>
                                                <tr><td>Sent By</td><td><?= $offer_data['sent_by'];?></td></tr>
                                                <tr><td>Sent To</td><td><?= $offer_data['send_to_email'];?></td></tr>
                                                <tr><td>Status</td><td>
                                                <?php 
                                                    if($offer_data['accepted']==2){
                                                        echo "Offer Accepted";
                                                    }else if($offer_data['accepted']==3){
                                                        echo "Offer Rejected";
                                                    }else{
                                                        echo "Pending";
                                                     }   
                                                ?>    
                                                
                                                </tr>
                                               </table> 
                                           </div>
                                        <div class="shipping_address" style="display: block;">
                                             <table class="table table-bordered">
                                               <thead>
                                                    <tr>
                                                    <th>Sri no</th>
                                                    <th>Message</th>
                                                    <th>Message To</th>
                                                    <th>Message From</th>
                                                    <th>Time</th>
                                                </tr>
                                               </thead>
                                               <tbody>
                                                   <?php 
                                                     $sql = "SELECT m.*,re.email as receiver,sender.email as sender FROM message as m INNER JOIN user as re ON re.id=m.to_user_id INNER join user as sender ON sender.id=m.from_user_id WHERE m.offer_id=$offer_id order by m.sent ASC;";
                                                   $query = mysqli_query($con,$sql);

                                                   if(mysqli_num_rows($query)>0){
                                                    $x=0;
                                                    while($row= mysqli_fetch_assoc($query)){
                                                    ?>
                                                   <tr>
                                                        <td><?= ++$x?></td>
                                                        <td><?= $row['text'];?></td>
                                                        <td><?= $row['receiver'];?></td>
                                                        <td><?= $row['sender'];?></td>
                                                        <td><?= $row['sent'];?></td>
                                                    </tr>
                                                    <?php
                                                   }}else{
                                                    ?>
                                                        <tr><td colspan="4">No Chat found ....</td></tr>
                                                    <?php
                                                   } 

                                                   ?>
                                               </tbody>
                                             </table> 

                                             <?php
                                             if($offer_data['accepted']==1){
                                                ?>
                                                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                                                 <input type="hidden" name="offer_id" value="<?= $offer_id?>">
                                                 <input type="hidden" name="send_by" value="<?= $offer_data['user_id']?>">
                                                 <input type="hidden" name="send_to" value="<?= $offer_data['send_to']?>">
                                                 <textarea rows="5" name="message" class="form-control" placeholder="Enter Message here ...." required=""></textarea>
                                                 <input type="submit" name="submit" value="SEND MESSAGE" class="btn btn-success"/>
                                             </form>
                                             <?php
                                                    }
                                             ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>
<?php include_once'footer.php';?>
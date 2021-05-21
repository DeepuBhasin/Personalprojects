<?php 
include_once'__db.php';
include_once'header.php';
include_once'sessionHeader.php';
$id = $_SESSION['id'];
?>
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>SENT OFFER PAGE</h2>
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
                     <div class="woocommerce">
                           <div id="customer_details" class="col2-set">
                                    <div class="col-4">
                                        <div class="woocommerce-billing-fields">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                    <th>Sri</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Offer</th>
                                                    <th>Acceted Status</th>
                                                    <th>Submitted</th>
                                                    <th>Message</th>
                                                    <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql = "SELECT o.id,o.offer,o.accepted,o.submitted,o.message_status,h.title,h.image FROM offer as o INNER JOIN hammer as h on h.id=o.hammer_id WHERE o.user_id=$id ORDER BY o.submitted DESC";
                                                        $query = mysqli_query($con,$sql);
                                                        if(mysqli_num_rows($query)>0){
                                                            $c=0;
                                                            while($row=mysqli_fetch_assoc($query)){
                                                                ?>
                                                                <tr>
                                                                    <td><?=++$c?></td>
                                                                    <td><?=ucwords($row['title']) ?></td>
                                                                    <td><img src="img/uploaded/<?=$row['image']?>" class="img-responsive img-thumbnail" width="150"></td>
                                                                    <td><?=$row['offer']?></td>
                                                                    <td><?php
                                                                          $status = $row['accepted'];  
                                                                        if($status==1){echo "Pending";}else if($status==2){echo "Accepted";}else if ($status==3){echo "Rejected";}?></td>
                                                                    <td><?=$row['submitted']?></td>
                                                                    
                                                                    <?php if($status==1){?>

                                                                    <td><?php
                                                                          $message_status = $row['message_status'];  
                                                                        if($message_status==0){echo "waiting of Buyer Replay";}else if($message_status==1){echo "waiting of your Replay";}?></td>
                                                                   <?php }else if ($status==2){?>
                                                                        <td>Offer Accepted</td>
                                                                    <?php }else if ($status==3){?>
                                                                        <td>Offer Rejected</td>
                                                                    <?php }?>
                                                                    <td><a href="sendInbox.php?id=<?= $row['id']?>" class="btn btn-success" onclick="confirm('Are you sure you want to do chat with Seller ? ');" >Make Chat</a></td> 
                                                                </tr>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?>
                                                            <tr><td colspan="8">No Record Found....</td></tr>
                                                            <?php
                                                        }

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>                    
                </div>
            </div>
        </div>
    </div>
<?php include_once'footer.php';?>
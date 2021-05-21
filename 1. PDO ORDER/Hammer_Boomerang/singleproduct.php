<?php 
include_once'header.php';
include_once'__db.php';

if(isset($_POST['submit'])){
    
    $from_user_id = $_POST['from_user_id'];
    $to_user_id = $_POST['to_user_id'];
    $hammer_id = $_POST['hammer_id'];
    $offer = $_POST['offer'];

    $sql = "INSERT INTO offer values(null,$from_user_id,$hammer_id,'$offer',1,CURRENT_TIMESTAMP(),'$to_user_id',1)";
    $x = mysqli_query($con,$sql);

    $offer_id = mysqli_insert_id($con);

    $sql = "INSERT INTO message values(null,$from_user_id,$to_user_id,$offer_id,CURRENT_TIMESTAMP(),'$offer')";
    
    $y = mysqli_query($con,$sql);

    if($x && $y)
    {
        header('location:singleproduct.php?id='.$hammer_id.'&status=success&message='.urlencode('Offer Sent Successfully. To check offer Sent by you just Click on link  <a href="sentoffer.php" class="btn btn-success">Click here<a>'));
    }
    else
    {
        header('location:singleproduct.php?id='.$hammer_id.'&status=danger&message='.urlencode('Database Problem'));    
    }
   
}



if(isset($hammer_id)){
$productId = $hammer_id;
}else{
  $productId = $_GET['id'];
}


if(empty($productId)){
    header('location:index.php');
}


$sql = "SELECT * FROM hammer where id= $productId";
$row = mysqli_fetch_assoc(mysqli_query($con,$sql));



$viewCount = $row['viewCount'] + 1;

$sql = "UPDATE hammer set viewCount=$viewCount where id=$productId";
mysqli_query($con,$sql);


if(isset($_SESSION['id']))
{
  
  $id = $_SESSION['id'];


  $sql = "DELETE FROM recentlyview where hammer_id=$productId and user_id=$id";
  mysqli_query($con,$sql);


  $sql = "INSERT INTO recentlyview values(null,$id,$productId,CURRENT_TIMESTAMP())";
  mysqli_query($con,$sql);

}



?>

    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>HAMMER DESCRIPTION</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                
                
                <div class="col-md-12   ">
                <?php include_once'message.php';?>
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="index.php">Home</a>
                            <a href="#">Hammer</a>
                            <a href=""><?= ucwords($row['title']);?></a>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="img/uploaded/<?= $row['image']?>" class="img-responsive img-thumbnail" alt="" width="500">
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                
                                    <h2 class="product-name"><?= ucwords($row['title']);?></h2>
                                    <?php 
                                      $user_id = $row['user_id'];
                                      $newsql = "SELECT * from user Where id=$user_id";
                                      $userRow = mysqli_fetch_assoc(mysqli_query($con,$newsql));
                                      echo '<p>Hammer added By : '.$userRow['email'].'</p>';
                                      echo '<p>Added on : '.$row['submitted'].'</p>';

                                    ?>
                                    <div class="product-inner-price">
                                     Seeking   <ins><?= ucwords($row['seeking']);?>$</ins>
                                    </div>    
                                    
                                   <?php 
                                   if(isset($_SESSION['id'])){
                                      if($_SESSION['id']!=$row['user_id']){
                                        echo '<a class="btn btn-primary" data-toggle="modal" href="#modal-id">CREATE OFFER</a>';
                                      }else{
                                        echo "You Cannot create Offer beacuse you added this Hammer";
                                      }
                                   }else{
                                    echo "To create offere Please must login first";
                                   }

                                   ?> 
                                   
                                   <div class="modal fade" id="modal-id">
                                       <div class="modal-dialog">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                   <h4 class="modal-title">Create Offer for <?= $userRow['email']?></h4>
                                               </div>
                                               <div class="modal-body">
                                                   <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
                                                     <label for>Enter Description</label>
                                                     <input type="hidden" name="from_user_id" value="<?= $id?>">
                                                     <input type="hidden" name="to_user_id" value="<?= $row['user_id']?>">
                                                     <input type="hidden" name="hammer_id" value="<?= $productId?>">
                                                     <div class="form-group">
                                                       <textarea name="offer" rows="6" class="form-control" id="offer" placeholder="Enter your offer ..." required=""></textarea>
                                                     </div>
                                                     <div class="form-group">
                                                       <input type="submit" name="submit" value="SUBMIT OFFER"/>
                                                     </div>
                                                   </form>
                                               </div>
                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                   <button type="button" class="btn btn-primary">Save changes</button>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <br/><br/><br/>
                                   <h1>Description</h1>
                                   <p><?= $row['description'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

<?php include_once'footer.php';?>
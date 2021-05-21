<?php 
include_once'header.php';
include_once'sessionHeader.php';
$id = $_SESSION['id'];
if(isset($_POST['submit']))
{
    include_once'__db.php';

    $title = addslashes($_POST['title']);
    $description = addslashes($_POST['description']);
    $seeking = $_POST['seeking'];

    
    $file_name=$_FILES['hammerImage']['name'];
    $file_size=$_FILES['hammerImage']['size'];                 // upload in kb always 
    $file_temp=$_FILES['hammerImage']['tmp_name'];
    $file_type=$_FILES['hammerImage']['type'];

    $file_name = time().'-'.$file_name.'.jpg';

    move_uploaded_file($file_temp,'img/uploaded/'.$file_name); 

    $sql = "INSERT INTO hammer VALUES (NULL,$id,'$title','$description','$file_name','$seeking',CURRENT_TIMESTAMP(),0)";
    $query = mysqli_query($con,$sql);

    if($query)
    {
        header('location:addhammer.php?status=success&message='.urlencode('Hammer Added Successfully'));
    }
    else
    {
        header('location:addhammer.php?status=danger&message='.urlencode('Database Problem'));    
    }

    
}
?>
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>ADD HAMMER PAGE</h2>
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
                           <form onsubmit="return addhammerFunction();" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                                <div id="customer_details" class="col2-set">
                                    <div class="col-4">
                                        <div class="woocommerce-billing-fields">
                                        <?php include_once'message.php';?>
                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="hammerImage">Select Image * </label>
                                                 <input type="file" id="hammerImage" name="hammerImage" class="input-text" style="width: 100%;" required="" accept="image/x-png,image/gif,image/jpeg" />
                                            </p>
                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="title">Title * </label>
                                                 <input type="text" value="" placeholder="Enter Title" id="title" name="title" class="input-text" style="width: 100%;" required="">
                                            </p>

                                             <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="description">Description * </label>
                                                 <textarea cols="4" rows="4" value="" placeholder="Enter Description" id="description" name="description" class="input-text" style="width: 100%;" required=""></textarea>
                                            </p>
                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="seeking">Seeking * </label>
                                                 <input type="text" value="" placeholder="Enter Seeking" id="seeking" name="seeking" class="input-text" style="width: 100%;" required="">
                                            </p>
                                            <p><button type="submit" name="submit" class="btn-sm btn btn-success">Add Hammer</button></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>                    
                </div>
            </div>
        </div>
    </div>
<?php include_once'footer.php';?>
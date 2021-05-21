<?php
include_once'header.php';
include_once'__db.php';
?>
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Hammer</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
         <?php
                $sql = "SELECT * FROM hammer order by submitted DESC";
                $query = mysqli_query($con,$sql);

                if(mysqli_num_rows($query)>0)
                {
                    
                    while($row = mysqli_fetch_assoc($query))
                    {

                  ?>

                        <div class="col-md-3 col-sm-6">
                            <div class="single-shop-product">
                                <div class="product-upper">
                                    <img src="img/uploaded/<?= $row['image']?>" class="img-responsive img-thumbnail" alt="">
                                </div>
                                <h2><a href="singleproduct.php?id=<?= $row['id']?>"><?= $row['title']?></a></h2>
                                <div class="product-carousel-price">
                                    <ins>$<?= $row['seeking']?></ins>
                                </div>  
                                
                                <div class="product-option-shop">
                                    <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="singleproduct.php?id=<?= $row['id']?>">SEE DETAILS</a>
                                </div>                       
                            </div>
                        </div>
                 <?php
                                }
                                
                            }else{
                        ?>  
                        <h1>No Record Found....</h1>
                        <?php }?>

                
               
            </div>
        </div>
    </div>

<?php include_once'footer.php';?>
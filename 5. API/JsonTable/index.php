<?php
include_once'main.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
</head>
<body>
<h1>All Data</h1>
  <table border="1" cellpadding="9">
    <th>Sri</th>
    <th>id</th>
    <th>Title</th>
    <th>Categories</th>
    <th>Price</th>
    <th>labels</th>
  
    <?php

        $product_count = count($data['products']);
   

    $qq=0;
    for($z=0;$z<$product_count;$z++){
        
      ?>
        <tr>
        <td><?= ++$qq?></td>
          <td><?= $product_array[$z]['id'] ?></td>
          <td><?= $product_array[$z]['title'] ?></td>
          <td>
          <?php 
            $count_categories = count($product_array[$z]['categories']);

            for($q=0;$q<$count_categories;$q++){
              
              echo $product_array[$z]['categories'][$q]['id'].' : '.$product_array[$z]['categories'][$q]['title'].'<br/>';
            }

          ?>
          </td>
          <td><?= $product_array[$z]['price'] ?></td>
          <td>
          <?php 
            $count_lable = count($product_array[$z]['labels']);

            for($q=0;$q<$count_lable;$q++){
              
              echo $product_array[$z]['labels'][$q]['id'].' : '.$product_array[$z]['labels'][$q]['lalel_title'].'<br/>';
            }

          ?>
          </td>
        </tr>
  <?php
    
    }

    ?>
      <tr>
        <td colspan="5">Category Count</td><td>
          
          <?php 
          for($q=0;$q<count($category_array);$q++)
          {
            echo $category_array[$q]['title'].' : '.$category_array[$q]['count']."<br/>";
          }
          ?>
        </td>
    </tr>
     <tr>
        <td colspan="5">Lable Count</td><td>
          
          <?php 
          for($q=0;$q<count($label_array);$q++)
          {
            echo $label_array[$q]['id'].' : '.$label_array[$q]['title'].' : '.$label_array[$q]['count']."<br/>";
          }
          ?>
        </td>
    </tr>
    <tr>
        <td colspan="5">Category with lable</td><td>
          
          <?php 
          for($q=0;$q<count($category_and_lable);$q++)
          {
            $string = implode(",",$category_and_lable[$q]['product_id']);
            echo $category_and_lable[$q]['title'].' : '.$string."<br/>";
          }
          ?>
        </td>
    </tr>
    <tr>
        <td colspan="5">Attribute with lable</td><td>
          
          <?php 
          
            if(isset($attribut_lable_array)){
                $color = implode(",",$attribut_lable_array['color']);
               $size = implode(",",$attribut_lable_array['size']);
            
            echo 'Color : ' .$color."<br/>";
            echo 'Size : ' .$size."<br/>";
            }
          
          ?>
        </td>
    </tr>



    
  </tbody>
</body>
</html>
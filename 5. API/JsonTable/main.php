<?php
$data = file_get_contents('catalog.json');
$data = json_decode($data,true);
// print_r($data);
$product_count = count($data['products']);
$product_array = $data['products'];
$product_attribute= count($data['attributes']);
$product_attribute_array= $data['attributes'];

  // creating attribute array
    $attribute=[];
    $c=0;
    for($i=0;$i<$product_attribute;$i++){

          $internal_count = count($product_attribute_array[$i]['labels']);
            for($x=0;$x<$internal_count;$x++){

                // creating attribute of lable

                $array= array(
                  'id'=>$product_attribute_array[$i]['labels'][$x]['id'],
                  'title'=>$product_attribute_array[$i]['title'],
                  'lalel_title'=>$product_attribute_array[$i]['labels'][$x]['title']

                  );
                $attributes[]=$array;
                $c++;
            }
    }
   
     // end of createing attribute 
    
    
      //createing attribute and lable array 
      for($rt=0;$rt<$product_count;$rt++){
              $label_id = $product_array[$rt]['labels'];

              for($fg=0;$fg<count($label_id);$fg++){

                      for($to=0;$to<count($attributes);$to++){
                                if($attributes[$to]['id']==$label_id[$fg]){
                                 $zz[$attributes[$to]['title']][]=$label_id[$fg];
                            }

                      }
              }
      }  

      $attribut_lable_array= array(
        'color'=>array_unique($zz['Color']),
        'size'=>array_unique($zz['Size']),
      );
      //ending attribute and lable array 

      

    //creating product Array

    $attributes_count = count($attributes);  
        
    for($i=0;$i<$product_count;$i++)
          { 
              $labels_count = count($product_array[$i]['labels']);
                for($x=0;$x<$attributes_count;$x++)
                  
                  {
                      $attribute_id = $attributes[$x]['id'];
                      $lalel_title = $attributes[$x]['lalel_title'];
                      
                      $array_label=[];
                       $product_new=[]; 
                      for($y=0;$y<$labels_count;$y++)
                        {
                            $product_lable_id = $product_array[$i]['labels'][$y];

                              
                              if($attribute_id==$product_lable_id){
                                    $array_label = array(
                                      'id'=>$product_lable_id,
                                      'lalel_title'=>$lalel_title
                                      );

                                      $product_array[$i]['labels'][$y]=$array_label;        // new product array is created


                                } 


                          }

                          
                          
                   }
           } 


   
   // create category count
   $category_array=[]; 
    for($w=0;$w<$product_count;$w++){
            $category_interal_count = count($product_array[$w]['categories']);
          for($r=0;$r<$category_interal_count;$r++){
            if(!in_array($product_array[$w]['categories'][$r]['title'],$category_array)){
                $category_array[]=$product_array[$w]['categories'][$r]['title'];
                
            }
          }

    } 
    for($w=0;$w<count($category_array);$w++){
      $category_array[$w]=array(
        'title'=>$category_array[$w],
        'count'=>0,
        'product_id'=>[],
        );
    }


    $category_and_lable=$category_array;
    
    

    $category_new_count_array=[];
    $category_array_count = count($category_array);
    for($w=0;$w<$product_count;$w++)
    {
        $category_interal_count = count($product_array[$w]['categories']);
          for($r=0;$r<$category_interal_count;$r++)
          {
                 for($t=0;$t<$category_array_count;$t++) 
                 { 
                  if($product_array[$w]['categories'][$r]['title']==$category_array[$t]['title'])
                  { 
                      $number = $category_array[$t]['count']+1;
                      $category_array[$t]['count']=$number;

                      for($ol=0;$ol<count($data['products'][$w]['labels']);$ol++){
                        // echo $data['products'][$w]['labels'][$ol].'<br/>';
                          if(!in_array($data['products'][$w]['labels'][$ol],$category_and_lable[$t]['product_id'])){
                                   $category_and_lable[$t]['product_id'][]=$data['products'][$w]['labels'][$ol];
                          } 
                      }



                  }
            }
          }
      
       }   

      
    // end  create category count  



    // create lable count
   $label_array=[]; 
    for($w=0;$w<$product_count;$w++){
            $category_interal_count = count($product_array[$w]['labels']);
          for($r=0;$r<$category_interal_count;$r++){
            if(!in_array($product_array[$w]['labels'][$r]['id'],$label_array)){
                $label_array[]=$product_array[$w]['labels'][$r]['id'];
                 $label_array_title[]=$product_array[$w]['labels'][$r]['lalel_title'];
                
            }
          }

    } 
    for($w=0;$w<count($label_array);$w++){
      $label_array[$w]=array(
        'id'=>$label_array[$w],
        'title'=>$label_array_title[$w],
        'count'=>0,
        );
    }


    $category_new_count_array=[];
    $label_array_count = count($label_array);
    for($w=0;$w<$product_count;$w++)
    {
        $category_interal_count = count($product_array[$w]['labels']);
          for($r=0;$r<$category_interal_count;$r++)
          {
                 for($t=0;$t<$label_array_count;$t++) 
                 { 
                  if($product_array[$w]['labels'][$r]['id']==$label_array[$t]['id'])
                  { 
                      $number = $label_array[$t]['count']+1;
                      $label_array[$t]['count']=$number;
                  }
            }
          }
      
       }   



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
<style type="text/css">
    body{
            padding: 0px;
            margin: 0px;
             box-sizing: content-box;
        }
      #heading{
        width: 98%;
          height: auto;
          /*margin: 0 auto;*/
          background-color: #00134d;
          border: solid 2px #fff;
          color:#fff;
          padding: 30px 0px 30px 20px;  
      }  
      #container{
        width: 98%;
      height: auto;
      /*margin: 0 auto;*/
      background-color: #00134d;
      border: solid 2px #fff;
      color:#fff;
      padding: 30px 0px 30px 20px;
     
  }

</style>    
</head>
<body>

        <div id="heading"><h2>Films</h2></div>
        <?php
            $get = file_get_contents('film.xml');
            $arr = simplexml_load_string($get);
            foreach($arr->film as $data)
            {?>
            
               
                <div id="container">
                    <h3>Title : <?=$data->title;?></h3>
                    <p>Anbieter: <?=$data->anbieter;?></p>
                    <p>darsteller<br/>
                        <?php foreach($data->darsteller as $actor){
                                   foreach($actor->man as $m){
                                    echo 'Male : '.$m.'<br/>';
                                   }
                                   foreach($actor->woman as $f){
                                    echo 'female : '.$f.'<br/>';
                                   }
                             }?>
                    </p>
                    <p>bewertungen <br/>
                        <?php $x=0;foreach($data->bewertungen as $rating){
                               echo "kritiker : ".$rating->bewertung[0].'<br/>';
                               echo "publikum : ".$rating->bewertung[1];
                            
                         }?>
                    </p>
                </div> 
        <?php }
        ?>
       
</body>
</html>
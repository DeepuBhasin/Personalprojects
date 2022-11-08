<br/>
<?php

    if(isset($_GET['message'])){
        echo $_GET['message'];
    } 
    else if (isset($response) && is_array($response))
    {
        echo "<ul>";
        foreach($response as $value){
            echo "<li> $value </li>";
        }
        echo "</ul>";
    }

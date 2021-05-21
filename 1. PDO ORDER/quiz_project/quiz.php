<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz</title>
</head>
<body>
<h1>Welcome To <?= urldecode($_GET['p']);?> Quiz</h1>
<form name="movie_quiz" action="results.php" method="post">
<?php
session_start();

try {

    $dbhost=$_SESSION['dbhost'];
    $dbusr=$_SESSION['dbusr'];
    $dbpwd=$_SESSION['dbpwd'];
    $dbname=$_SESSION['dbname'];

    if($_GET['p']=='Movies')
    {
        $_SESSION['table_name']='q_movies';
    }
    else if(urldecode($_GET['p'])=='Video Games')
    {
        $_SESSION['table_name']='q_videogames';
    }    

    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $ex) {
    echo 'Connection failed: ' . $ex->getMessage();
}

    $table_name=$_SESSION['table_name'];
    $result = $db->prepare("SELECT * FROM $table_name ORDER BY RAND() limit 15"); // 
    $result->execute([]);
    $question_count=1;

    if($result->rowCount()>0)
    {
        // set the resulting array to object
        while($row = $result->fetch(PDO::FETCH_OBJ))
        {
            ?>
                 <lable><?= $question_count;?>. <?= stripcslashes($row->question);?></lable><br>
                 <input type="hidden" value="<?= $row->question_id?>" name="question_id[]">
                 <input type="hidden" value="0" name="quizCheck[<?=$row->question_id;?>]">
                 <lable><input type="radio" name="quizCheck[<?=$row->question_id;?>]" value="<?=$row->option1?>"> a. <?=$row->option1?></lable><br>
                 <lable><input  type="radio"  name="quizCheck[<?=$row->question_id;?>]" value="<?=$row->option2?>"> b. <?=$row->option2?></></lable><br>
                 <lable> <input type="radio" name="quizCheck[<?=$row->question_id;?>]" value="<?=$row->option3?>"> c. <?=$row->option3?></></lable><br>
                 <lable><input type="radio" name="quizCheck[<?=$row->question_id;?>]" value="<?=$row->option4?>"> d. <?=$row->option4?></lable><br><br>

            <?php

            ++$question_count;
        }

    }
?>

    <input type="submit" name="submit">
</form>
</body>
</html>

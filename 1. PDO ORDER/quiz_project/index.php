<?php
session_start();
$_SESSION['dbhost']="localhost";
$_SESSION['dbusr']="root";
$_SESSION['dbpwd']="";
$_SESSION['dbname']="quiz";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz TIME!</title>
    <link rel="stylesheet" href="=quiz.css">
</head>
<body>
<h1> QUIZ TIME! </h1>
<div>
    <a href="quiz.php">
        <?
        ?>
        <a href="quiz.php?p=Video Games" title="Video Games">Quiz on Videogames!</a>
    <a href=" quiz.php?p=Movies" title="Movies">Quiz on Movies!</a>
</div>
</body>
</html>
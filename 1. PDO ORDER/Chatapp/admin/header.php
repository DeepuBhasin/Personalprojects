<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Welcome to Chat App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="./../public/styles.css" />
</head>
<body>

  <header class="header">
    <div class="header-container">
      <div class="header-content">
        <h2>WELCOME TO CHAT APPLICATION</h2>
      </div>
    </div>
  </header>
  <nav class="tools">
      <div class="tools-container">
        
        <div class="tools-items">
          <div class="tools-item">
            <h3> <a href="dashboard.php">Home</a></h3>
          </div>
          <div class="tools-item">
            <h3><a href="updateprofile.php">Update Profile</a></h3>
          </div>
          <div class="tools-item">
            <h3><a href="changepassword.php">Change Password</a></h3>
          </div>
          <div class="tools-item">
            <h3><a href="allusers.php">All Users</a></h3>
          </div>
          <div class="tools-item">
            <h3><a href="searchfriend.php">Search User</a></h3>
          </div>
          <div class="tools-item">
            <h3><a href="./../logout.php">logout</a></h3>
          </div>
          
        </div>
      </div>
    </nav>  
</main>
  <section>
    
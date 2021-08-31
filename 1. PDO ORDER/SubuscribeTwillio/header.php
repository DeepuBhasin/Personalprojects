<?php 
include_once('db.php');
session_start();
    if(isset($_SESSION['admin_id']))
    {
        header("location:admin/index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="vipewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Management System | Henrry Goels</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Blog HTML5 Template - v1.0">
    <meta name="author" content="BionThemes">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CLato:400,400i,700,700i" rel="stylesheet">
    <!-- StyleSheet -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/swiper.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen" />
</head>

<body>
    <div id="wrapper">
        <!-- Pre-Loader -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_one"></div>
                </div>
            </div>
        </div>
        <!-- Header Mobile -->
        <header class="visible-sm visible-xs" id="mobile-header">
            <div class="container">
                <!-- Mobile Menu -->
                <div class="m-menu">
                    <div class="m-menu-offcanvas">
                        <span class="m-close"><span></span></span>
                        <div class="m-header">
                            <span>Navigation Menu</span>
                        </div>
                        <div class="m-navigation mmenu section" id="mmenu">
                            <h2>Mobile Navigation</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Login</a>
                                </li>
                             </ul>
                        </div>
                        
                    </div>
                    <span class="toggle"><span></span></span>
                </div>
            </div>
        </header>
        <!-- Header PC -->
        <header class="header no-border visible-lg visible-md" id="header">
            <div class="header-content default-style">
                <div class="container">
                    <div class="logo text-center section" id="logo">
                        <div id="header-inner">
                            <a href="index.php">
                                <h1 style="text-transform: uppercase;">Subscription Management system</h1>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <!-- Topbar -->
            <div class="topbar stick-me not-sticking">
                <div class="container">
                    <!-- Social -->
                   
                    <!-- Main menu -->
                    <div class="topmenu section" id="topmenu">
                        <ul>
                           <li>
                                <a href="index.php">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

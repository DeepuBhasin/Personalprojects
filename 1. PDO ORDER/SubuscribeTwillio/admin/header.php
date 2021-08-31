<?php session_start();
if(!$_SESSION['admin_id'])
{
    header("location:../index.php");
}
include_once('../db.php');
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
    <!-- Favicon -->
    <link rel="icon" href="../images/favicon.png" sizes="32x32" type="image/png">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CLato:400,400i,700,700i" rel="stylesheet">
    <!-- StyleSheet -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/swiper.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/responsive.css" media="screen" />
    <style type="text/css">
        .parent > a{cursor: pointer;};
    </style>
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
                            <span>Mobile Menu</span>
                        </div>
                        <div class="m-navigation mmenu section" id="mmenu">
                            <h2>Navigation</h2>
                              <ul>
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li class="parent">
                                <a>Customer</a>
                                <ul>
                                    <li><a href="add_chanel.php">Add Customer</a>
                                    </li>
                                    <li><a href="export_user.php">All Customers</a>
                                    </li>
                                    <li><a href="sms_report.php">SMS Report</a></li>
                                </ul>
                            </li>
                             <li>
                                <a href="addMessage.php">Add Message</a>
                            </li>
                            <li>
                                <a href="change_password.php">Change Password</a>
                            </li>
                            <li>
                                <a href="../logout.php">Logout</a>
                            </li>
                        </ul>
                        </div>
                        <div class="m-footer">
                            <p><i class="fa fa-copyright"></i> &nbsp;2017</p>
                        </div>
                    </div>
                    <span class="toggle"><span></span></span>
                </div>
                <!-- Mobile Logo -->
                <div class="m-logo section" id="m-logo">
                    <div id="header-inner-m">
                        <a href="index.php">
                            <h3 style="color:#fff;margin-top: -5px;">Analysis of TRP</h3>
                        </a>
                    </div>
                </div>
                
            </div>
        </header>
        <!-- Header PC -->
        <header class="header no-border visible-lg visible-md" id="header">
        <?php
             $sql = "SELECT message_text FROM message_table where message_id=1";
            $query = mysqli_query($con,$sql);
            $check = mysqli_fetch_object($query)->message_text;
            
            if($check=='')
            {
            ?>
            <div class="alert alert-danger text-center">
                <strong>Alert : </strong> Please add Message Body first to execute Application.
            </div>
        <?php
        
            }
        ?>
            <div class="header-content default-style">
                <div class="container">
                    <div class="logo text-center section" id="logo">
                        <div id="header-inner">
                            <a href="index.php">
                                <h1 style="text-transform: uppercase;">Subscription Management System </h1>
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
                                <a href="index.php">Home</a>
                            </li>
                            <li class="parent">
                                <a>Customer</a>
                               <ul>
                                    <li><a href="add_chanel.php">Add Customer</a></li>
                                    <li><a href="export_user.php">All Customers</a></li>
                                    <li><a href="sms_report.php">SMS Report</a></li>
                                </ul>
                            </li>
                             <li>
                                <a href="addMessage.php">Add Message</a>
                            </li>
                            <li>
                                <a href="change_password.php">Change Password</a>
                            </li>
                            <li>
                                <a href="../logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </header>
        <div class="row">

        </div>

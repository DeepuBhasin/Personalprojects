<?php include_once('header.php');?>
        <!-- List Posts -->
            <div class="main-wrap">
                <div class="container">
                    <div class="row">
                        <div class="main col-md-8 col-md-offset-2" id="main">
                            <div class="post">
                                <h1>Dashboard</h1>
                                <p>Hello <?= $_SESSION['admin_full_name']?></p>
                                <p>Your User Name is : <?= $_SESSION['admin_email']?></p>
                                <?php echo "Today Date is : ".date("D d/m/Y");?>
                            </div>
                            
                        </div>
                        <!-- Sidebar -->
                    </div>
                </div>
            </div>
<?php include_once('footer.php');?>
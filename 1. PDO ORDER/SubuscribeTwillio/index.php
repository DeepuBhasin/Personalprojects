<?php include_once('header.php');?>
<div id="content">
            <!-- List Posts -->
            <div class="main-wrap">
                <div class="container">
                    <div class="row">
                        <div class="main col-md-8 col-md-offset-2" id="main">
                        <?php include_once('message.php');?>  
                            <div class="post single-post">
                                <div class="post-content">
                                    <h3 class="post-title">
						            	Login Here
						            </h3><br/>
                                    <form action="prog_login.php" method="post" name="" autocomplete="off" >
                                       <div class="form-group">
                                            <label for="input" class="col-sm-4 control-label">Username * :</label>
                                            <input type="text" name="email" id="username" class="form-control" required="required" placeholder="Enter User Name *">
                                        </div>
                                        <div class="form-group">
                                            <label for="input" class="col-sm-4 control-label">Password * :</label>
                                            <input type="password" name="password" id="password" class="form-control" required="required" placeholder="Enter Password *">
                                        </div>
                                        
                                        <button type="submit" name="login" class="btn btn-success">Login</button>
                                        <button type="reset" class="btn btn-danger">Clear</button>
                                    </form>
                                    
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include_once('footer.php');?>
<?php

session_start();
require_once("class/userClass.php");
$id=$_GET['id'];

$usrObj=new userClass();
$fetchStaff1=$usrObj::fetchStaff($id);
$staff_data = mysqli_fetch_array($fetchStaff1['result']);


if(isset($_POST['update']))
{
    $id=$_POST['id'];

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$emailidf=$_POST['emailidf'];
$emailids=$_POST['emailids'];
$username=$_POST['username'];
$password=$_POST['password'];
$admintype=$_POST['admintype'];
$status=1;

$editstaff=$usrObj::editStaff($id,$fname,$lname,$emailidf,$emailids,$password,$admintype,$status);


  if($editstaff['status']=='Success')
  {
    $_SESSION['msg']="Update Successfully";
     
    
  }
  else
  {
     $_SESSION['msg']="Data Is not Updated";
  }


}

?>


<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>



	<!-- Global stylesheets -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

	<link href="global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">

	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<link href="assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">

	<link href="assets/css/layout.min.css" rel="stylesheet" type="text/css">

	<link href="assets/css/components.min.css" rel="stylesheet" type="text/css">

	<link href="assets/css/colors.min.css" rel="stylesheet" type="text/css">

	<!-- /global stylesheets -->



	<!-- Core JS files -->

	<script src="global_assets/js/main/jquery.min.js"></script>

	<script src="global_assets/js/main/bootstrap.bundle.min.js"></script>

	<script src="global_assets/js/plugins/loaders/blockui.min.js"></script>

	<!-- /core JS files -->



	<!-- Theme JS files -->

	<script src="global_assets/js/plugins/forms/styling/switchery.min.js"></script>

	<script src="global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="global_assets/js/plugins/forms/selects/select2.min.js"></script>



	<script src="assets/js/app.js"></script>

	<script src="global_assets/js/demo_pages/form_actions.js"></script>

	<!-- /theme JS files -->



</head>



<body>



	<!-- Main navbar -->

	<div class="navbar navbar-expand-md navbar-dark">

		<div class="navbar-brand">

			<a href="index.html" class="d-inline-block">

				<img src="global_assets/images/logo_light.png" alt="">

			</a>

		</div>



		<div class="d-md-none">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">

				<i class="icon-tree5"></i>

			</button>

			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">

				<i class="icon-paragraph-justify3"></i>

			</button>

		</div>



		<div class="collapse navbar-collapse" id="navbar-mobile">

			<ul class="navbar-nav">

				<li class="nav-item">

					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">

						<i class="icon-paragraph-justify3"></i>

					</a>

				</li>



				<li class="nav-item dropdown">

					<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">

						<i class="icon-git-compare"></i>

						<span class="d-md-none ml-2">Git updates</span>

						<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">9</span>

					</a>



					<div class="dropdown-menu dropdown-content wmin-md-350">

						<div class="dropdown-content-header">

							<span class="font-weight-semibold">Git updates</span>

							<a href="#" class="text-default"><i class="icon-sync"></i></a>

						</div>



						<div class="dropdown-content-body dropdown-scrollable">

							<ul class="media-list">

								<li class="media">

									<div class="mr-3">

										<a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon"><i class="icon-git-pull-request"></i></a>

									</div>



									<div class="media-body">

										Drop the IE <a href="#">specific hacks</a> for temporal inputs

										<div class="text-muted font-size-sm">4 minutes ago</div>

									</div>

								</li>



								<li class="media">

									<div class="mr-3">

										<a href="#" class="btn bg-transparent border-warning text-warning rounded-round border-2 btn-icon"><i class="icon-git-commit"></i></a>

									</div>

									

									<div class="media-body">

										Add full font overrides for popovers and tooltips

										<div class="text-muted font-size-sm">36 minutes ago</div>

									</div>

								</li>



								<li class="media">

									<div class="mr-3">

										<a href="#" class="btn bg-transparent border-info text-info rounded-round border-2 btn-icon"><i class="icon-git-branch"></i></a>

									</div>

									

									<div class="media-body">

										<a href="#">Chris Arney</a> created a new <span class="font-weight-semibold">Design</span> branch

										<div class="text-muted font-size-sm">2 hours ago</div>

									</div>

								</li>



								<li class="media">

									<div class="mr-3">

										<a href="#" class="btn bg-transparent border-success text-success rounded-round border-2 btn-icon"><i class="icon-git-merge"></i></a>

									</div>

									

									<div class="media-body">

										<a href="#">Eugene Kopyov</a> merged <span class="font-weight-semibold">Master</span> and <span class="font-weight-semibold">Dev</span> branches

										<div class="text-muted font-size-sm">Dec 18, 18:36</div>

									</div>

								</li>



								<li class="media">

									<div class="mr-3">

										<a href="#" class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon"><i class="icon-git-pull-request"></i></a>

									</div>

									

									<div class="media-body">

										Have Carousel ignore keyboard events

										<div class="text-muted font-size-sm">Dec 12, 05:46</div>

									</div>

								</li>

							</ul>

						</div>



						<div class="dropdown-content-footer bg-light">

							<a href="#" class="text-grey mr-auto">All updates</a>

							<div>

								<a href="#" class="text-grey" data-popup="tooltip" title="Mark all as read"><i class="icon-radio-unchecked"></i></a>

								<a href="#" class="text-grey ml-2" data-popup="tooltip" title="Bug tracker"><i class="icon-bug2"></i></a>

							</div>

						</div>

					</div>

				</li>

			</ul>



			<span class="badge bg-success ml-md-3 mr-md-auto">Online</span>



			<ul class="navbar-nav">

				<li class="nav-item dropdown">

					<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">

						<i class="icon-people"></i>

						<span class="d-md-none ml-2">Users</span>

					</a>

					

					<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-300">

						<div class="dropdown-content-header">

							<span class="font-weight-semibold">Users online</span>

							<a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>

						</div>



						<div class="dropdown-content-body dropdown-scrollable">

							<ul class="media-list">

								<li class="media">

									<div class="mr-3">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>

									<div class="media-body">

										<a href="#" class="media-title font-weight-semibold">Jordana Ansley</a>

										<span class="d-block text-muted font-size-sm">Lead web developer</span>

									</div>

									<div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>

								</li>



								<li class="media">

									<div class="mr-3">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>

									<div class="media-body">

										<a href="#" class="media-title font-weight-semibold">Will Brason</a>

										<span class="d-block text-muted font-size-sm">Marketing manager</span>

									</div>

									<div class="ml-3 align-self-center"><span class="badge badge-mark border-danger"></span></div>

								</li>



								<li class="media">

									<div class="mr-3">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>

									<div class="media-body">

										<a href="#" class="media-title font-weight-semibold">Hanna Walden</a>

										<span class="d-block text-muted font-size-sm">Project manager</span>

									</div>

									<div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>

								</li>



								<li class="media">

									<div class="mr-3">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>

									<div class="media-body">

										<a href="#" class="media-title font-weight-semibold">Dori Laperriere</a>

										<span class="d-block text-muted font-size-sm">Business developer</span>

									</div>

									<div class="ml-3 align-self-center"><span class="badge badge-mark border-warning-300"></span></div>

								</li>



								<li class="media">

									<div class="mr-3">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>

									<div class="media-body">

										<a href="#" class="media-title font-weight-semibold">Vanessa Aurelius</a>

										<span class="d-block text-muted font-size-sm">UX expert</span>

									</div>

									<div class="ml-3 align-self-center"><span class="badge badge-mark border-grey-400"></span></div>

								</li>

							</ul>

						</div>



						<div class="dropdown-content-footer bg-light">

							<a href="#" class="text-grey mr-auto">All users</a>

							<a href="#" class="text-grey"><i class="icon-gear"></i></a>

						</div>

					</div>

				</li>



				<li class="nav-item dropdown">

					<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">

						<i class="icon-bubbles4"></i>

						<span class="d-md-none ml-2">Messages</span>

						<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">2</span>

					</a>

					

					<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">

						<div class="dropdown-content-header">

							<span class="font-weight-semibold">Messages</span>

							<a href="#" class="text-default"><i class="icon-compose"></i></a>

						</div>



						<div class="dropdown-content-body dropdown-scrollable">

							<ul class="media-list">

								<li class="media">

									<div class="mr-3 position-relative">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>



									<div class="media-body">

										<div class="media-title">

											<a href="#">

												<span class="font-weight-semibold">James Alexander</span>

												<span class="text-muted float-right font-size-sm">04:58</span>

											</a>

										</div>



										<span class="text-muted">who knows, maybe that would be the best thing for me...</span>

									</div>

								</li>



								<li class="media">

									<div class="mr-3 position-relative">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>



									<div class="media-body">

										<div class="media-title">

											<a href="#">

												<span class="font-weight-semibold">Margo Baker</span>

												<span class="text-muted float-right font-size-sm">12:16</span>

											</a>

										</div>



										<span class="text-muted">That was something he was unable to do because...</span>

									</div>

								</li>



								<li class="media">

									<div class="mr-3">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>

									<div class="media-body">

										<div class="media-title">

											<a href="#">

												<span class="font-weight-semibold">Jeremy Victorino</span>

												<span class="text-muted float-right font-size-sm">22:48</span>

											</a>

										</div>



										<span class="text-muted">But that would be extremely strained and suspicious...</span>

									</div>

								</li>



								<li class="media">

									<div class="mr-3">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>

									<div class="media-body">

										<div class="media-title">

											<a href="#">

												<span class="font-weight-semibold">Beatrix Diaz</span>

												<span class="text-muted float-right font-size-sm">Tue</span>

											</a>

										</div>



										<span class="text-muted">What a strenuous career it is that I've chosen...</span>

									</div>

								</li>



								<li class="media">

									<div class="mr-3">

										<img src="global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">

									</div>

									<div class="media-body">

										<div class="media-title">

											<a href="#">

												<span class="font-weight-semibold">Richard Vango</span>

												<span class="text-muted float-right font-size-sm">Mon</span>

											</a>

										</div>

										

										<span class="text-muted">Other travelling salesmen live a life of luxury...</span>

									</div>

								</li>

							</ul>

						</div>



						<div class="dropdown-content-footer justify-content-center p-0">

							<a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Load more"><i class="icon-menu7 d-block top-0"></i></a>

						</div>

					</div>

				</li>



				<li class="nav-item dropdown dropdown-user">

					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">

						<img src="global_assets/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">

						<span>Victoria</span>

					</a>



					<div class="dropdown-menu dropdown-menu-right">

						<a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>

						<a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>

						<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-blue ml-auto">58</span></a>

						<div class="dropdown-divider"></div>

						<a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>

						<a href="#" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>

					</div>

				</li>

			</ul>

		</div>

	</div>

	<!-- /main navbar -->





	<!-- Page content -->

	<div class="page-content">



		<!-- Main sidebar -->

		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">



			<!-- Sidebar mobile toggler -->

			<div class="sidebar-mobile-toggler text-center">

				<a href="#" class="sidebar-mobile-main-toggle">

					<i class="icon-arrow-left8"></i>

				</a>

				Navigation

				<a href="#" class="sidebar-mobile-expand">

					<i class="icon-screen-full"></i>

					<i class="icon-screen-normal"></i>

				</a>

			</div>

			<!-- /sidebar mobile toggler -->





			<!-- Sidebar content -->

			<div class="sidebar-content">



				<!-- User menu -->

				<div class="sidebar-user">

					<div class="card-body">

						<div class="media">

							<div class="mr-3">

								<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>

							</div>



							<div class="media-body">

								<div class="media-title font-weight-semibold">Victoria Baker</div>

								<div class="font-size-xs opacity-50">

									<i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA

								</div>

							</div>



							<div class="ml-3 align-self-center">

								<a href="#" class="text-white"><i class="icon-cog3"></i></a>

							</div>

						</div>

					</div>

				</div>

				<!-- /user menu -->





				<!-- Main navigation -->

				<div class="card card-sidebar-mobile">

					<ul class="nav nav-sidebar" data-nav-type="accordion">



						<!-- Main -->

						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>

						<li class="nav-item">

							<a href="index.html" class="nav-link">

								<i class="icon-home4"></i>

								<span>

									Dashboard

									<span class="d-block font-weight-normal opacity-50">No active orders</span>

								</span>

							</a>

						</li>

						<li class="nav-item nav-item-submenu">

							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>Staff</span></a>



							<ul class="nav nav-group-sub" data-submenu-title="Layouts">

								<li class="nav-item"><a href="allstaff.php" class="nav-link active">All Staff</a></li>

								<li class="nav-item"><a href="addnewstaff.php" class="nav-link">Add New Staff</a></li>

									</ul>

						</li>

						<li class="nav-item nav-item-submenu">

							<a href="#" class="nav-link"><i class="icon-color-sampler"></i> <span>Client</span></a>



							<ul class="nav nav-group-sub" data-submenu-title="Themes">

								<li class="nav-item"><a href="allclient.php" class="nav-link active">All Clients</a></li>

								<li class="nav-item"><a href="addnewclient.pho" class="nav-link">Add New Client</a></li>

								</ul>

						</li>

						

						<!-- /page kits -->



					</ul>

				</div>

				<!-- /main navigation -->



			</div>

			<!-- /sidebar content -->

			

		</div>

		<!-- /main sidebar -->





		<!-- Main content -->

		<div class="content-wrapper">



			<!-- Page header -->

			<div class="page-header page-header-light">

				<div class="page-header-content header-elements-md-inline">

					<div class="page-title d-flex">

						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Add New Staff</span></h4>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>

					</div>



					<div class="header-elements d-none">

						<div class="d-flex justify-content-center">

							<a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>

							<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>

							<a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>

						</div>

					</div>

				</div>



				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">

					<div class="d-flex">

						<div class="breadcrumb">

							<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>

							<a href="form_actions.html" class="breadcrumb-item">Forms</a>

							<span class="breadcrumb-item active">Actions</span>

						</div>



						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>

					</div>



					<div class="header-elements d-none">

						<div class="breadcrumb justify-content-center">

							<a href="#" class="breadcrumb-elements-item">

								<i class="icon-comment-discussion mr-2"></i>

								Support

							</a>



							<div class="breadcrumb-elements-item dropdown p-0">

								<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">

									<i class="icon-gear mr-2"></i>

									Settings

								</a>



								<div class="dropdown-menu dropdown-menu-right">

									<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>

									<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>

									<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>

									<div class="dropdown-divider"></div>

									<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!-- /page header -->





			<!-- Content area -->

			<div class="content">



				<!-- Form action components -->

				<div class="mb-3">

					<h6 class="mb-0 font-weight-semibold">

						Form action components

					</h6>

					<span class="text-muted d-block">Form actions with mixed elements</span>

				</div>



				<div class="row">

					

			        	<div class="col-md-2">

			        	    </div>

	                



					<div class="col-md-6">



			        	<!-- Left and right buttons -->

			            <div class="card">

							<div class="card-header header-elements-inline">

				                <h6 class="card-title">Staff Login</h6>

								<div class="header-elements">

									<div class="list-icons">

				                		<a class="list-icons-item" data-action="collapse"></a>

				                		<a class="list-icons-item" data-action="reload"></a>

				                		<a class="list-icons-item" data-action="remove"></a>

				                	</div>

			                	</div>

							</div>




			                <div class="card-body">

			                   <?php 
		if(isset($_SESSION['msg'])) { 
	?>
	<div class="alert alert-danger" role="alert">
  		<?php echo (isset($_SESSION['msg'])) ? $_SESSION['msg'] : ''; ?>
	</div>
	<?php unset($_SESSION['msg']); } ?>
			                	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			                	    <input name="id" type="hidden" value="<?php echo $staff_data['id'];?>" />
			                	   
									<div class="form-group">

										<label>Your name:</label>

										<input type="text" class="form-control"  value="<?php echo $staff_data['fname']; ?>"  name="fname">

									</div>

									<div class="form-group">

										<label>Your Last Name:</label>

										<input type="text" class="form-control" value="<?php echo $staff_data['lname']; ?>"  name="lname">

									</div>

									

									<div class="form-group">

										<label>Your Email Id:</label>

										<input type="email" class="form-control" value="<?php echo $staff_data['emailidf']; ?>"  name="emailidf">

									</div>

									

									<div class="form-group">

										<label>Your Email Id(Optional):</label>

										<input type="email" class="form-control" value="<?php echo $staff_data['emailids']; ?>"  name="emailids">

									</div>



									<div class="form-group">

										<label>Your password:</label>

										<input type="password" class="form-control" value="<?php echo $staff_data['password']; ?>"  name="password">

									</div>



								

								<div class="form-group mb-3 mb-md-2">

									<label class="d-block font-weight-semibold">Admin Type</label>

									<div class="custom-control custom-control-right custom-radio custom-control-inline">

										<input type="radio" class="custom-control-input" name="admintype" id="custom_radio_inline_right_checked" value="<?php echo $staff_data['admintype']; ?>" checked="">

										<label class="custom-control-label position-static" for="custom_radio_inline_right_checked">Staff</label>

									</div>



									<div class="custom-control custom-control-right custom-radio custom-control-inline">

										<input type="radio" class="custom-control-input" name="admintype" id="custom_radio_inline_right_unchecked" value="<?php echo $staff_data['admintype']; ?>">

										<label class="custom-control-label position-static" for="custom_radio_inline_right_unchecked">Client</label>

									</div>

								</div>



									<div class="d-flex justify-content-between align-items-center">

										<button type="submit" class="btn btn-light">Cancel</button>

										<button type="submit" class="btn bg-blue" name="update" value="submit">Submit <i class="icon-paperplane ml-2"></i></button>

									</div>

								</form>

							</div>

		                </div>

		                <!-- /left and right buttons -->





					

</div>

				



			</div>

			<!-- /content area -->

</div>



			<!-- Footer -->

			<div class="navbar navbar-expand-lg navbar-light">

				<div class="text-center d-lg-none w-100">

					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">

						<i class="icon-unfold mr-2"></i>

						Footer

					</button>

				</div>



				<div class="navbar-collapse collapse" id="navbar-footer">

					<span class="navbar-text">

						&copy; 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>

					</span>



					<ul class="navbar-nav ml-lg-auto">

						<li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>

						<li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>

						<li class="nav-item"><a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link font-weight-semibold"><span class="text-pink-400"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li>

					</ul>

				</div>

			</div>

			<!-- /footer -->



		</div>

		<!-- /content wrapper -->



	</div>

	<!-- /page content -->



</body>

</html>


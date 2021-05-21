

				<!-- Main navigation -->

				<div class="card card-sidebar-mobile">

					<ul class="nav nav-sidebar" data-nav-type="accordion">



						<!-- Main -->

						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>

						<li class="nav-item">

							<a href="#" class="nav-link active">

								<i class="icon-home4"></i>

								<span>

									Dashboard

								</span>

							</a>

						</li>
 <?php 
        if ($_SESSION['admintype']==0)
          {
      ?>
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

								<li class="nav-item"><a href="addnewclient.php" class="nav-link">Add New Client</a></li>

								</ul>

						</li>

			<?php 
        }
        else if ($_SESSION['admintype']==1)
        {
            ?>
            <li class="nav-item nav-item-submenu">

							<a href="#" class="nav-link"><i class="icon-color-sampler"></i> <span>Client</span></a>



							<ul class="nav nav-group-sub" data-submenu-title="Themes">

								<li class="nav-item"><a href="allclient.php" class="nav-link active">All Clients</a></li>

								<li class="nav-item"><a href="addnewclient.php" class="nav-link">Add New Client</a></li>

								</ul>

						</li>
     <?php 
        }
      ?>			

						<!-- /page kits -->



					</ul>

				</div>

				<!-- /main navigation -->



		
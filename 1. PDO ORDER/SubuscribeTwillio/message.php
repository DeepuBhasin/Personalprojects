<?php if(isset($_GET['id']))
                       		 {
                       		 	$color=$_GET['id'];
                       		 	?>
                       		 			 <div class="alert alert-<?= $color?>">
				                        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                        	<?= urldecode($_GET['message']);?>
				                        </div>
				        <?php 	
				        	 }
				        ?>  
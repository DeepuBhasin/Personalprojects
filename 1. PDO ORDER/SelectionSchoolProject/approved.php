<?php require'__database.php';
	if(isset($_POST['approved'])) 
	{

		$sql='';
		$newArray= array_values($_POST['teacher_id']);
		$count = count($newArray);
		// // print_r($newArray);
		// exit;
		for($i=0; $i<$count;$i++){
			echo $count[$i];

			$sql .= "UPDATE teacher_table SET status='approved' where teacher_id=".$newArray[$i].';';
		}
			$x=mysqli_multi_query($conn,$sql);
		if($x){
			$message = urlencode("Approved Informtaion Updated Succssfully");
			$color ="success";
		}else{
			$message = urlencode("Database Problem");
			$color ="danger";
		}
		header('location:index.php?message='.$message.'&color='.$color);
	}




	require 'header.php';
?>
	<div class="container">
		<div class="jumbotron">
			<div class="container  offset-sm-2 col-sm-8">
				<a href="index.php" class="btn btn-primary">Select Teacher</a>
				</br></br></br>
				<h1 class="text-info">Teacher with Pending Status </h1>
				<br/>
				<?php
							$sql = "SELECT * FROM teacher_table where status='pending' ORDER BY teacher_name ASC";
						    // exit;
						    $result = @mysqli_query($conn, $sql);

					        if (mysqli_num_rows($result) > 0) {
						?>
				<form id="" onsubmit="return submitfunction();" action="<?= $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">

						
						<table id="myTableId" class="table table-responsive">
	                    <thead class="table-dark">
	                    <tr>
	                        <th><input type="checkbox" id="checkAll" onchange="checkAllFunction(this);"></th>
	                        <th>Sri. No</th>
	                        <th>Teacher Name</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                    	$x=0;            
				            while ($row = mysqli_fetch_assoc($result)) {

				                echo  "<tr><td><input type='checkbox' onchange='checkboxfunction(this)' name='teacher_id[".$x."]' value='".$row['teacher_id']."' id='idCheck_".$x."'></td><td>".++$x."</td><td>{$row['teacher_name']}</td></tr>";
				            }
	                    ?>
	                    </tbody>
	                    </table>

					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success" id="submitButton" name="approved">Approved</button>
						<button type="reset" class="btn btn-danger">Clear</button>
					</div>
				</form>
				<?php }else{?>
					<h2>No Record Found</h2>
				<?php }?>
			</div>
		</div>
	</div>	
	<script src="public/js/jquery.js"></script> 
	<script src="public/js/bootstrap.bundle.min.js"></script>
	<script src="public/js/custom.js"></script>

	<script type="text/javascript">

		function checkAllFunction(e){
			
			var check=document.getElementById(e.id).checked;
			var checkCount = document.querySelectorAll('input[type="checkbox"]').length;
			if(check == true){
				for(i=0;i<checkCount-1;i++){
					document.getElementById('idCheck_'+i).checked=true;
				}
			}else{
				for(i=0;i<checkCount-1;i++){
					document.getElementById('idCheck_'+i).checked=false;
				}
			}
		}
		function checkboxfunction(e){
			
			// var checkCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
				// if(document.getElementById('checkAll').checked == true){
				// 	if(checkCount<2){
				// 		document.getElementById('checkAll').checked = false;
				// 	}else{
				// 		document.getElementById('checkAll').checked = true;
				// 	}
				// }else{
				// 	document.getElementById('checkAll').checked=true;
				// }

		}
	</script>
 </body>
</html>
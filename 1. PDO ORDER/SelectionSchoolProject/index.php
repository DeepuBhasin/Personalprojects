<?php require'__database.php';
	if(isset($_POST['submit'])) 
	{

		$sql='';
		$newArray= array_values($_POST['teacher_id']);
		$count = count($newArray);
		// print_r($newArray);
		// exit;
		for($i=0; $i<$count;$i++){
			echo $count[$i];

			$sql .= "UPDATE teacher_table SET status='pending' where teacher_id=".$newArray[$i].';';
		}
		$x=mysqli_multi_query($conn,$sql);
		if($x){
			$message = urlencode("Pending Informtaion Updated Succssfully");
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
			<?php if((isset($_GET['message']) && (isset($_GET['color'])))){
				$message = $_GET['message'];
				$color = $_GET['color'];
				?>
				<div class="alert alert-<?= $color;?>">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?= $message?>
					</div>
				<?php
					}
				?>
				<a href="approved.php" class="btn btn-primary">Approved Page</a>
				</br></br></br>
				<h1 class="text-info">School Project</h1>
				<br/>
				<form id="" onsubmit="return submitfunction();" action="<?= $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<lable for="className">Select Class *</lable>
						<select id="classId" class="form-control col-sm-5" onchange="getData(this);" required="" name="className">
							<option value="" data-id="">Select Class *</option>
					      <?php 
						     $sql="SELECT * FROM class_table ORDER BY class_name ASC";
						      $query = mysqli_query($conn,$sql);
						      while($row=mysqli_fetch_assoc($query)){
						      	echo '<option value="'.$row['class_id'].'" data-id="'.$row['class_limit'].'">'.$row['class_name'].'</option>';
						      }
							?>
					      			
						</select>
						<input type="hidden" id="classLimit" value="">	
					</div>
					<div class="form-group" style="display: none;" id="sectionDiv">
						<lable for="teacherName">Select Section *</lable>
						<select id="sectionId" class="form-control col-sm-5" required="" name="sectionId"  onchange="getFullData(this)">
						</select>
					</div>
					<div class="form-group" style="display: none" id="searchDiv">
						<label for="searchId">Enter Teacher Name</label>
						<input type="text" class="form-control col-sm-5" id="searchId" name="searchId" onkeydown="searchFunction(this);">	
					</div>
					<div class="form-group" id="tableIddiv">
						<div id="tableId"></div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success" id="submitButton" name="submit">Submit</button>
						<button type="reset" class="btn btn-danger">Clear</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
	<script src="public/js/jquery.js"></script>
	<script src="public/js/bootstrap.bundle.min.js"></script>
	<script src="public/js/custom.js"></script>

	<script type="text/javascript">
	function getData(e){
		var classId = e.value;
		$('#tableId').html('');	
		if(classId!==''){
				$.ajax({
				url: 'getData.php',
				type: 'POST',
				data : {'classId':classId},
				success : function(data){

				if(data.length>0){
						document.getElementById('sectionDiv').style.display="Block";
						$('#sectionId').html(data);
					}else{
						document.getElementById('sectionDiv').style.display="Block";
						$('#sectionId').html('<option value="">Select Section</option>');
					}
				}
			});
			}else{
				document.getElementById('sectionDiv').style.display="none";
			}
			document.getElementById("searchDiv").style.display='none';

		}

		function getFullData(e){
			var sectionId = e.value;
			var classId = document.getElementById("classId").value;


			if(sectionId!=='' && classId!==''){
				$.ajax({
				url: 'getfulldata.php',
				type: 'POST',
				data : {'classId':classId,'sectionId':sectionId},
				success : function(data){
					console.log(data)
					var responseData = JSON.parse(data);
					var output = responseData['output'];
					// console.log(output);
					if (output!=undefined) 
					{
						document.getElementById("classLimit").value =  responseData['class_limit'];
						document.getElementById("searchDiv").style.display='block';
						document.getElementById('searchId').value="";
						$('#tableId').html(output);
					}else{
						$('#tableId').html('');	
						document.getElementById("searchDiv").style.display='none';
						document.getElementById('searchId').value="";
					}
				}
			});
			}else{
				document.getElementById("searchDiv").style.display='none';
				document.getElementById('searchId').value="";
				$('#tableId').html('');	
			}
		}	
		function searchFunction(e){
			 var input, filter, table, tr, td, i, txtValue;
			  input = e.value;
			  filter = input.toUpperCase();
			  table = document.getElementById("myTableId");
			  tr = table.getElementsByTagName("tr");


			  
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[2];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
			  }
		} 

		function checkboxfunction(e){
			// alert(e.name);
			// alert(e.value);
			var checkCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
			var checkLimit = document.getElementById("classLimit").value;
			
			if(checkCount>checkLimit){
				alert('You can Select only '+checkLimit+ ' No. of Techer from list');
				document.getElementById(e.id).checked = false;



			}
		}
	</script>
 </body>
</html>
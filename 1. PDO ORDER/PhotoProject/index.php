<?php require'__database.php';
	session_start();
	
	function isMobile() 
	{
    	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}
	
	$_SESSION['studentId']=1;

	if(isset($_POST['submit'])  &&!empty($_POST['teacherId'])){

		$time = time();
		$filename = $_SESSION['studentId'].'-'.$time.'.jpeg';
		
		$file_name=$_FILES['uploadFile']['name'];
	    $file_size=$_FILES['uploadFile']['size'];                 // upload in kb always 
	    $file_temp=$_FILES['uploadFile']['tmp_name'];
	    $file_type=$_FILES['uploadFile']['type'];

	    

	    if($_FILES['uploadFile']['type']!='image/jpeg'){
	        
	        header('location:index.php?status=error&&message=This extension file not allowed, Please choose a JPG or JPEG file');
	    }
	    if($file_size>5242880)  
	    {
	    	header('location:index.php?status=error&&message=File size must be 2MB or Lower');   
	    }
	    
	    $_SESSION['imageName']=$filename;
		$_SESSION['teacherId']=$_POST['teacherId'];
	    
	    move_uploaded_file($file_temp,'images/upload/'.$filename);
		
		header('location:selectTemplate.php');
	  }
	if(isset($_POST['ClickPhoto'])){
		$_SESSION['teacherId']=$_POST['teacherId'];
		unset($_SESSION['imageName']);

		header('location:Scan/');

	}


	include 'header.php';


	?>
	<div class="container">
		<div class="jumbotron col-sm-12">
			<div class="container">
				<h1 class="text-info">Welcome To Photo Web Application</h1>
				<br/>
				<form id="" onsubmit="return submitfunction();" action="<?= $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<lable for="teacherName">Teacher Name*</lable>
						<select id="" class="form-control col-sm-5" onchange="getData(this);" required="" name="teacherId">
							<option value="">Select Teacher *</option>
					      <?php 
						     $sql="SELECT * FROM userdetails ORDER BY teacherName ASC";
						      $query = mysqli_query($conn,$sql);
						      while($row=mysqli_fetch_assoc($query)){
						      	echo '<option value="'.$row['teacherId'].'">'.$row['teacherName'].'</option>';
						      }
							?>
					      			
						</select>
					</div>
					<div class="form-group">
						<div id="tableId"></div>
					</div>
					<div class="form-group" id="uploadImage" style="display: none;" />
						<lable>Upload Image</lable> <br/>
						<input type="file" class=" btn btn-primary btn-lg" name="uploadFile" id="uploadFile" accept=".jpg,.jpeg" />
							<?php 
								if(!isMobile()){
								   ?>
								   <button type="submit" id="ClickPhoto" name="ClickPhoto" class="btn-lg btn btn-primary"/>Click Photo</button>
								   <?php
								}
							?>
						<br/>
						<p></p>
						<p>Image Should be jpeg or jpg format and Image Size should be less than 5MB</p>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-default" id="submitButton" name="submit">Submit</button>
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
	$('#submitButton').on('click',function(){
		var confrimation = confirm('Are you sure you want to submit details ?');
		if(confrimation==true){
			return true;
		}else{
			return false;
		}
	});
		
	function getData(e){
		var userId = e.value;
		if(userId>0){
				$.ajax({
				url: 'getdata.php',
				type: 'POST',
				data : {'teacherId':userId},
				success : function(data){
					$('#tableId').html(data);
					document.getElementById('uploadImage').style.display="Block";
				}
			});
			}else{
				$('#tableId').html('');
				document.getElementById('uploadFile').value='';
				document.getElementById('uploadImage').style.display="none";
			}
		}
	</script>
 </body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Generate Code</title>
</head>

<body>

	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="coupon.php">Home</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="#"></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="showtags.php">Show All Tages</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Logout</a>
						</li>

					</ul>

				</div>
			</div>
		</nav>
	</header>
	<div class="container">
		<br>
		<div class="row">

			<?php
			if (isset($_GET['message'])) :
				$message = $_GET['message'];
				$color = $_GET['color'];
			?>
				<div class="alert alert-<?= $color; ?>">
					<?= $message; ?>

				</div>
			<?php endif; ?>

			<form action="generate_code.php" method="POST">
				<div class="mb-3">
					<label for="total_coupon_numbers" class="form-label">Enter number of Coupon *</label>
					<input type="number" class="form-control" name="total_coupon_numbers" id="total_coupon_numbers" placeholder="Please Enter number of Coupon *">
				</div>

				<div class="mb-3">
					<button type="submit" name="generate" class="btn btn-success">Submit</button>
				</div>
			</form>

		</div>
	</div>



	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
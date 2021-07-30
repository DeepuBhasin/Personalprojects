<?php
include'__db.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Price Data</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>
<body style="background-color:#0083C4;">
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Price Data</a>
		</div>
	</div>
</nav>
<div class="container" style="background-color: #fff;padding: 50px; overflow: auto;" >
<h1>Price Data</h1><br/>
	<table id="example" class="display table-responsive">
		<thead>
		    <tr>
		        <th>Sri no</th>
		        <th>Id</th>
		        <th>Modified</th>
		        <th>departure Name</th>
		        <th>url</th>
		        <th>departure Id</th>
		        <th>expedition_id</th>
		        <th>ship_id</th>
		        <th>ship_name</th>
		        <th>start_date</th>
				<th>end_date</th>
		        <th>duration_days</th>
		        <th>itinerary_id</th>
		        <th>department_id</th>
		        <th>cabin_id</th>
		        <th>occupancy_code</th>
		        <th>price_per_person</th>
		        <th>availability_status</th>
		        <th>availability_description</th>
		        <th>spaces_available</th>

		    </tr>
		</thead>
		<tbody>
		<?php 
			$query ="SELECT m.*,p.* FROM main_table as m INNER JOIN price_table as p ON p.main_id=m.id";
			$row = mysqli_query($con,$query);
			while($ab = mysqli_fetch_assoc($row)){?>
				<tr>
					<td><?= $ab['id']?></td>
					<td><?= $ab['main_id']?></td>
					<td><?= $ab['modified']?></td>
					<td><?= $ab['departure_name']?></td>
					<td><?= $ab['url']?></td>
					<td><?= $ab['departure_id']?></td>
					<td><?= $ab['expedition_id']?></td>
					<td><?= $ab['ship_id']?></td>
					<td><?= $ab['ship_name']?></td>
					<td><?= $ab['start_date']?></td>
					<td><?= $ab['end_date']?></td>
					<td><?= $ab['duration_days']?></td>
					<td><?= $ab['itinerary_id']?></td>
					<td><?= $ab['department_id']?></td>
					<td><?= $ab['cabin_id']?></td>
					<td><?= $ab['occupancy_code']?></td>
					<td><?= $ab['price_per_person']?></td>
					<td><?= $ab['availability_status']?></td>
					<td><?= $ab['availability_description']?></td>
					<td><?= $ab['spaces_available']?></td>

				</tr>
				
		<?php

				}

		?>
		 
		   
		</tbody>
		</table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ]
    } );
} );
</script>
</body>
</html>
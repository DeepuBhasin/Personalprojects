<?php
ini_set('max_execution_time', '0'); // for infinite time of execution 
error_reporting(0);
include'__db.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Xml Data</title>
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
			<a class="navbar-brand" href="#">XML Data</a>
		</div>
	</div>
</nav>
<div class="container" style="background-color: #fff;padding: 50px; overflow: auto;" >
<h1>XML Data</h1><br/>
	<table id="example" class="display table-responsive">
		<thead>
		    <tr>
		        <th>Sri no</th>
		        <th>categ_description</th>
		        <th>capacity_categ</th>
		        <th>ship_name</th>
		        <th>cruise_id</th>
		        <th>categ_type</th>
		        <th>currency</th>
		        <th>single_price</th>
		        <th>double_price</th>
		        <th>third_price</th>
				<th>child_price</th>
		        <th>baby_price</th>
		        <th>tax_amount</th>
		    </tr>
		</thead>
		<tbody>
		<?php 
			$query ="SELECT * FROM xml_table order by id asc";
			$row = mysqli_query($con,$query);
			while($ab = mysqli_fetch_assoc($row)){?>
				<tr>
					<td><?= $ab['id']?></td>
					<td><?= $ab['categ_description']?></td>
					<td><?= $ab['capacity_categ']?></td>
					<td><?= $ab['ship_name']?></td>
					<td><?= $ab['cruise_id']?></td>
					<td><?= $ab['categ_type']?></td>
					<td><?= $ab['currency']?></td>
					<td><?= $ab['single_price']?></td>
					<td><?= $ab['double_price']?></td>
					<td><?= $ab['third_price']?></td>
					<td><?= $ab['child_price']?></td>
					<td><?= $ab['baby_price']?></td>
					<td><?= $ab['tax_amount']?></td>
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
        "pagingType": "full_numbers",
        buttons: [
            'csv', 'excel', 'pdf'
        ]
    } );
} );
</script>
</body>
</html>
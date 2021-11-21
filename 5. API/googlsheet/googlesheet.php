<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Export Data</title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">


</head>
<body>
		<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>layer</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>

	
</body>
</html>
<?php
// https://docs.sheetdb.io/?php#get-all-data document about to upload the data into google sheet

	$conn = mysqli_connect('localhost','root','','fiver_order');
	$c=0;

	$starting = microtime(true);

	$json_data = file_get_contents('weather.json');
	  
	$json_data = json_decode($json_data,true);
	  
	for($i=0;$i<count($json_data);$i++){
		foreach ($json_data[$i]['attributes'] as $key1=>$value1) {
		if(strtolower('Backgrounds')!==strtolower($value1['layer']))
			{?>
				<tr>
					<td><?= ++$c?></td>
					<td><?= $value1['layer']?></td>
					<td><?= $value1['name']?></td>
				</tr>
			<?php }
		}
	}

?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
         "pageLength": 100,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>




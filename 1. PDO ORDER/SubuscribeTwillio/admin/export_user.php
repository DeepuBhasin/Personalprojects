<?php 
include_once('header.php');
?>
<link rel=stylesheet type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">


        <!-- List Posts -->
            <div class="main-wrap">
                <div class="container">
                    <div class="row">
                        <div class="main col-md-12" id="main">
                        <?php include_once('../message.php');?>   
                            <div class="post">
                                <h1>All Customers </h1><br/>
                                <div class="table-responsive" >
                                    <table class="table table-hover" id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Mac Address</th>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                <th>Sub Start </th>
                                                <th>Sub End</th>
                                                <th>Sub Type</th>
                                                <th>Sub Status</th>
                                                <th>SMS Status</th>
                                                <th>Created Date</th>
                                                <th>Updated Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $x=0;
                                            $result=mysqli_query($con,"SELECT * FROM customer_table order by created_dt DESC");
                                            while($row=mysqli_fetch_object($result))
                                            {
                                                

                                        ?>
                                            <tr>
                                                <td><?= ++$x;?></td>
                                                <td><?= $row->mac_adddress;?></td>
                                                <td><?= $row->customer_name?></td>
                                                <td><?= $row->phone_number;?></td>
                                                <td><?= $row->start_sub;?></td>
                                                <td><?= $row->end_sub;?></td>
                                                <td><?php if($row->sub_type=='1M'){echo "1 Month";}else if($row->sub_type=='3M'){echo "3 Months";}else if($row->sub_type=='6M'){echo "6 Months";}elseif($row->sub_type=='12M'){echo "12 Months";}?></td>
                                                <td><?php if($row->status==1){echo "Active";}else{echo "Inactive";}?></td>
                                                <td><?php if($row->sms_send_status==1){echo "Sent";}else{echo "Pending";}?></td>  
                                                <td><?= $row->created_dt;?></td>
                                                <td><?= ($row->update_dt)?$row->update_dt:'Not Available';?></td>
                                                <td><a href="edit_chanel.php?id=<?= $row->customer_id?>" id="" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to Edit Customer ?')">Edit</a> <a href="prog_file.php?type=delete_chanel&delete_id=<?= $row->customer_id?>" id="" class="btn btn-info btn-sm" onclick="return confirm('Are you sure you want to Delete Customer ?')">Delete</a></td>
                                                
                                            </tr>
                                        <?php }?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <!-- Sidebar -->
                    </div>
                </div>
            </div>
<?php include_once('footer.php');?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                title:'All Customer Information',

            },
            {
                extend: 'pdf',
                title:'All Customer Information',

            },
            {
                extend: 'excel',
                title:'All Customer Information',

            },
        ],
        "lengthMenu": [[50]],
    } );
} );
</script>
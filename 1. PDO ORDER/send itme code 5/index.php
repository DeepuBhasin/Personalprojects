<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Multiple Inline Insert into Mysql using Ajax JQuery in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
 </head>
 <body>
 <a href="update_page.php" class="btn btn-success">Update Page</a>
  <br /><br />
  <div class="container">
   <br />
   <h2 align="center">Multiple Inline Insert into Mysql using Ajax JQuery in PHP</h2>
   <br />
   <div class="table-responsive">
    <table class="table table-bordered" id="crud_table">
     <tr>
      <th width="30%">Item Name</th>
      <th width="10%">Item Code</th>
      <th width="45%">Description</th>
      <th width="10%">Price</th>
      <th width="10%">Date</th>
      <th width="5%"></th>
     </tr>
     <tr>
      <td contenteditable="true" class="item_name"></td>
      <td contenteditable="true" class="item_code"></td>
      <td contenteditable="true" class="item_desc"></td>
      <td contenteditable="true" class="item_price"></td>
      <td contenteditable="false" ><input type="date" name="date_vale" class="item_date"/></td>
      <td></td>
     </tr>
    </table>
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
    </div>
    <div align="center">
     <button type="button" name="save" id="save" class="btn btn-info">Save</button>
    </div>
    <br />
    <!-- <div id="inserted_item_data"></div> -->
   </div>
   
  </div>
 </body>
</html>

<script>
 function fetch_item_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('#inserted_item_data').html(data);
   }
  })
 }
 fetch_item_data();
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += "<td contenteditable='true' class='item_name'></td>";
   html_code += "<td contenteditable='true' class='item_code'></td>";
   html_code += "<td contenteditable='true' class='item_desc'></td>";
   html_code += "<td contenteditable='true' class='item_price' ></td>";
   html_code +="<td contenteditable='false' ><input type='date' name='date_vale' class='item_date'/></td>"
   html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
   html_code += "</tr>";  
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
 
 $('#save').click(function(){
  var item_name = [];
  var item_code = [];
  var item_desc = [];
  var item_price = [];
  var item_date = [];
  $('.item_name').each(function(){
   item_name.push($(this).text());
  });
  $('.item_code').each(function(){
   item_code.push($(this).text());
  });
  $('.item_desc').each(function(){
   item_desc.push($(this).text());
  });
  $('.item_price').each(function(){
   item_price.push($(this).text());
  });
  $('.item_date').each(function(){
   item_date.push($(this).val());
  });

$.ajax({
   url:"insert.php",
   method:"POST",
   data:{item_name:item_name, item_code:item_code, item_desc:item_desc, item_price:item_price,item_date:item_date},
   success:function(data){
    alert(data);
    $("td[contentEditable='true']").text("");
    $("input[type=date]").val("")
    for(var i=2; i<= count; i++)
    {
     $('tr#'+i+'').remove();
    }
    fetch_item_data();
   }
  });

 });
 });


 function radio_check(val)
{
	
  var check_column=$('#check_column'+val.id);
  var check_column_class=val.className;
 
 if($('.'+check_column_class).is(':checked'))
  {
    $(check_column).css({'background-color':'#009688','color':'#fff'});
   }
   else {
      $(check_column).css({'background-color':'#fff','color':'#000'});
    } 

    var x=($(':checkbox:checked').length);
    if($('#select_all').is(':checked'))
    {
      x=x-1;
    }
    if(x<=0)
    {
      $('#select_all').prop('checked', false);
      $('#send_button').attr('disabled',true);
    }
    else {
      $('#select_all').prop('checked',true);
      $('#send_button').removeAttr('disabled');
    }

}
function select_all(val)

{

	  if($('#select_all').is(':checked'))
	  {
	    $('input:checkbox').prop('checked', true);
	    $('tr[id^=check_column]').css({'background-color':'#009688','color':'#fff'});
	    $('#send_button').removeAttr('disabled');

	  }
	  else {
	    $('input:checkbox').prop('checked', false);
	    $('tr[id^=check_column]').css({'background-color':'#fff','color':'#000'});
	    $('#send_button').attr('disabled',true)
	  }
	
}
function update_data(val)
{
	var checkedValue = null; 
	var inputElements = document.getElementsByName('check_box');
	z=0;
	for(var i=0; inputElements[i]; ++i){
	      if(inputElements[i].checked)
	      {
	      	check_value=inputElements[i].value;
	      	$.ajax({
		              type: 'POST',
		              // dataType: 'json',
		              data: {'id':check_value},
		              url:"update_data.php",
		             success:function(data){
				    
				    fetch_item_data();
				   }
				 });
	      	
	      	}
	}
	alert('Record Updated Successfully');
}

  $(function () {
    $('#datetimepicker1').datetimepicker();
 });
</script>
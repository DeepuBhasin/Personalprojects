document.getElementById("search").addEventListener("click",function(){

  var routeNumber = document.getElementById("bookCode").value.trim();
  

  if((routeNumber.length==0)){

  		var rowCount = document.getElementById("myTable").rows.length-1;
  		
   		document.getElementById("routeDetails").style.display = "block";
   		for(i=1;i<rowCount;i++){
			document.getElementById("myTable").getElementsByTagName("tr")[i].removeAttribute("style");
		}

		document.getElementById('noOfBooks').innerHTML= rowCount+" Books Found";
		
	}else if(routeNumber.length>0){
  			
  			document.getElementById("routeDetails").style.display="block";
			
  			var input, filter, table, tr, td, i, txtValue;
			  input = routeNumber;
			  filter = input.toUpperCase();
			  table = document.getElementById("myTable");
			  tr = table.getElementsByTagName("tr");
			  
			  var count=0;
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[0];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			        count=++count;
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
			  }
	document.getElementById('noOfBooks').innerHTML=count + " Books Found for  \"Book Code "+routeNumber+"\"";
  }
});











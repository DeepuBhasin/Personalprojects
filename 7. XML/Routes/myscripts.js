document.getElementById("updateButton").addEventListener("click",function(){

  var routeNumber = document.getElementById("routeNumber").value.trim();
  var streetName = document.getElementById("streetName").value.trim();

  if(routeNumber.length==1){
		routeNumber="00"+routeNumber;
	}else if(routeNumber.length==2){
		routeNumber="0"+routeNumber;
	}

  if((routeNumber.length==0) && (streetName.length==0)){

  		var rowCount = document.getElementById("myTable").rows.length;

   		document.getElementById("routeDetails").style.display = "block";
   		for(i=1;i<rowCount;i++){
			document.getElementById("myTable").getElementsByTagName("tr")[i].removeAttribute("style");
		}

		document.getElementById('headingOfStop').innerHTML="All Stops";
		document.getElementById('noOfStop').innerHTML= rowCount+" Stop Found";
		
	}
	else if(routeNumber.length>0 && streetName.length>0){
		document.getElementById("routeDetails").style.display="block";

  			document.getElementById('headingOfStop').innerHTML="Route "+routeNumber +" stop on " + streetName;	
  			
			  var input, filter, table, tr, td, i, txtValue;
			  input1 = streetName;
			  input2 = routeNumber;
			  filter1 = input1.toUpperCase();
			  filter2 = input2.toUpperCase();
			  table = document.getElementById("myTable");
			  tr = table.getElementsByTagName("tr");


			  var count=0;
			  for (i = 0; i < tr.length; i++) {
			    td1 = tr[i].getElementsByTagName("td")[1];
			    td2 = tr[i].getElementsByTagName("td")[4];
			    
			    if (td1 && td2) {
			      txtValue1 = td1.textContent || td1.innerText;
			      txtValue2 = td2.textContent || td2.innerText;

			      if ((txtValue1.toUpperCase().indexOf(filter1) > -1) && (txtValue2.toUpperCase().indexOf(filter2) > -1)) {
			        tr[i].style.display = "";
			        count=++count;
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
			  }

			  document.getElementById('noOfStop').innerHTML=count + " Stops Found";
		
	}
	else if(streetName.length>0){
  		document.getElementById("routeDetails").style.display="block";

  			document.getElementById('headingOfStop').innerHTML="Stops on " + streetName;	
  			
			  var input, filter, table, tr, td, i, txtValue;
			  input = streetName;
			  filter = input.toUpperCase();
			  table = document.getElementById("myTable");
			  tr = table.getElementsByTagName("tr");


			  var count=0;
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[1];
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

			  document.getElementById('noOfStop').innerHTML=count + " Stops Found";
			

  }else if(routeNumber.length>0){
  	document.getElementById("routeDetails").style.display="block";

  			document.getElementById('headingOfStop').innerHTML="Stops on Rout " + routeNumber;

  			var input, filter, table, tr, td, i, txtValue;
			  input = routeNumber;
			  filter = input.toUpperCase();
			  table = document.getElementById("myTable");
			  tr = table.getElementsByTagName("tr");
			  
			  var count=0;
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[4];
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
	document.getElementById('noOfStop').innerHTML=count + " Stops Found";
  }
});











function countryFunction(e){
    document.getElementById('tableDiv').style.display = "none";
    document.getElementById('cityDiv').style.display = "none";
    $('#myTable').html('');
    
    var val = e.value;

    if(val!=''){
         $.ajax({
            url:val,
            datatype : 'JSON',
            success : function(data){
                $('#cityName').html(data);
                
            },
            statusCode : {
                404 : function() {
                   alert('There was a problem with the server.  Try again soon!');
                 }
            }

        });
         document.getElementById('cityDiv').style.display = "Block";
    }else{
        document.getElementById('cityDiv').style.display = "none";
        $('#cityName').html('');
    }   

}
function CityFunction(e){
    var e = document.getElementById(e.id);
    var cityName = e.options[e.selectedIndex].text;

    if(cityName!='Select a City'){
          $.ajax({
            url:'http://api.openweathermap.org/data/2.5/weather?q='+cityName+'&units=metric&appid=36de6328cffc2e631bb64b265304041c',
            datatype : 'JSON',
            success : function(data){
            console.log(data);
            
             if(data.main.temp>35 || data.main.temp<(-5))
                {
                    var tempCondition = 'style="color:#fff;background-color:red"';
                }  
                else{
                    var tempCondition = '';
                }

                if(data.wind.speed>50){
                    var windConditon = 'kph';
                }
                else{
                    var windConditon = 'mph';
                } 

                var degreeTexture = degToCard(data.wind.deg) ;

                $('#myTable').html('<tr><td>'+data.name+'</td><td>'+convertStampDate(data.dt)+'</td><td>'+data.weather[0].description+'</td><td '+tempCondition+' >'+data.main.temp+' C</td><td>'+data.wind.speed+' '+windConditon+'</td><td>'+data.wind.deg+' '+degreeTexture+'</td><td id="image_div"></td></tr>');
           
                  $.ajax({
                          type: "GET",
                          url:'http://openweathermap.org/img/wn/'+data.weather[0].icon+'@2x.png',
                          beforeSend: function (xhr) {
                            xhr.overrideMimeType('text/plain; charset=x-user-defined');
                          },
                          success: function (result, textStatus, jqXHR) {       
                            if(result.length < 1){
                                alert("The thumbnail doesn't exist");
                                $("#image_div").attr("src", "data:image/png;base64,");
                                return
                            }

                            var binary = "";
                            var responseText = jqXHR.responseText;
                            var responseTextLen = responseText.length;

                            for ( i = 0; i < responseTextLen; i++ ) {
                                binary += String.fromCharCode(responseText.charCodeAt(i) & 255)
                            }

                            $('#image_div').html('<img id="image_id" src="data:image/png;base64,'+btoa(binary)+'"/>');    
                           
                            // $("#image_div").attr("src", "data:image/png;base64,"+btoa(binary));
                          },
                          error: function(xhr, textStatus, errorThrown){
                            alert("Error in getting document "+textStatus);
                          } 
                        });    

            },
            statusCode : {
                404 : function() {
                   alert('There was a problem with the server.  Try again soon!');
                 }
            }

        });

        document.getElementById('tableDiv').style.display = "Block";
    }else{
        document.getElementById('tableDiv').style.display = "none";
        $('#myTable').html('');
    }
    
}


    
function degToCard(num) {
    var val = Math.floor((num / 22.5) + 0.5);
    var arr = ["N", "NNE", "NE", "ENE", "E", "ESE", "SE", "SSE", "S", "SSW", "SW", "WSW", "W", "WNW", "NW", "NNW"];
    return arr[(val % 16)];
}

function convertStampDate(unixtimestamp){

// Unixtimestamp

// Months array
// var months_arr = ['January','February','March','April','May','June','July','August','September','October','November','December'];
var months_arr = [01,02,03,04,05,06,07,08,09,10,11,12];

// Convert timestamp to milliseconds
var date = new Date(unixtimestamp*1000);

// Year
var year = date.getFullYear();

// Month
var month = months_arr[date.getMonth()];

// Day
var day = date.getDate();

// Hours
var hours = date.getHours();

// Minutes
var minutes = "0" + date.getMinutes();

// Seconds
var seconds = "0" + date.getSeconds();

// Display date time in MM-dd-yyyy h:m:s format
var fulldate = month+' '+day+'-'+year+' '+hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

// filtered fate
var convdataTime = day+'-'+month+'-'+year;
return convdataTime;
}


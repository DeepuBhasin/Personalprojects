$(document).ready(function(){
        $.ajax({
            url:'weather.json',
            datatype : 'JSON',
            success : function(data){
                var c = 1;
                $.each(data,function(key,value){
                    $('#myTable').append('<tr><td>'+c+'</td><td>'+value.cityid+'</td><td>'+value.cityName+'</td><td>'+value.currentConditions+'</td><td>'+value.temperature+'</td><td>'+value.windSpeed+'</td><td>'+value.windDirection+'</td><td>'+value.windChillFactor+'</td>');
                    c++;
                });
            },
            statusCode : {
                404 : function() {
                   alert('There was a problem with the server.  Try again soon!');
                 }
            }

        });
    });
    function getData(){
        $('#myTable').html('');
         $.ajax({
            url:'weather.json',
            datatype : 'JSON',
            success : function(data){
                var c = 1;
                $.each(data,function(key,value){
                    $('#myTable').append('<tr><td>'+c+'</td><td>'+value.cityid+'</td><td>'+value.cityName+'</td><td>'+value.currentConditions+'</td><td>'+value.temperature+'</td><td>'+value.windSpeed+'</td><td>'+value.windDirection+'</td><td>'+value.windChillFactor+'</td>');
                    c++;
                });
            },
            statusCode : {
                404 : function() {
                   alert('There was a problem with the server.  Try again soon!');
                 }
            }

        });
    }
    setInterval(getData,5000);
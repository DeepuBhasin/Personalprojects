function CityFunction(val){
    $('#myTable').html('');
        $.ajax({
            url:'https://api.openweathermap.org/data/2.5/forecast?mode=json&q='+val.value+'&appid=9219b4b6938695e379a9970ee7db22c1',
            datatype : 'JSON',
            success : function(data){
                var c = 1;
                $.each(data.list,function(key,value){
                    $('#myTable').append('<tr><td>'+c+'</td><td>'+data.city.id+'</td><td>'+data.city.name+'</td><td>'+value.dt_txt+'</td><td>'+value.main.temp+'</td><td>'+value.main.humidity+'</td><td>'+value.weather['0'].main+'</td><td>'+value.weather['0'].description+'</td><td>'+value.wind.speed+'</td><td>'+value.wind.deg+'</td>');
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

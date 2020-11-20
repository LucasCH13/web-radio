let selectedValue;
let api_key = "j99MYuH7ghxGwq5p";
let url_genre;
let tuneInUrl = " http://yp.shoutcast.com"
let url_random;
////http://api.shoutcast.com/legacy/genresearch?k=j99MYuH7ghxGwq5p&genre=Classic&limit=2,1

$(document).ready(function(){
    $('#ajouter_genre').click(function(){
        selectedValue = $("#form-control").val();
        url_genre = "http://api.shoutcast.com/legacy/genresearch?k=" + api_key +"&genre=" + selectedValue + "&limit=2,1";
        url_random = "http://api.shoutcast.com/station/randomstations?k=" + api_key + "&f=json&mt=audio/mpeg&br=128&genre=" + selectedValue + "&limit=1";
        //getRadioByGenre();  
        //console.log(url_random);
       $.ajax({
         type: "POST",
         url: "http://127.0.0.1:8000/administration",
         data: {'url_station_random' :  url_random },
         success: function () {
           console.log(url_random); 
         }
       }); 
    });
  });

function getRadioByGenre() {  
  /*
  $.ajax({
    type: "GET",
    url: url_random,
    beforeSend: function(xhr){
     // xhr.setRequestHeader('Authorization', 'Bearer j99MYuH7ghxGwq5p');
    },
    dataType: "json",
    headers: {
      'Content-Type': 'application/json',
      "Accept": 'application/json',
      'Access-Control-Allow-Origin' : ['*'],
    },
    success: function (data) {
      var jsonResult = $.parseJSON(data);
        for (let i = 0; i < jsonResult.length; i++) {
          $('#api-result-content').append('<audio class="radio"> src="'+tuneInUrl+jsonResult[i].data.station["tunein"].base + "?id=" + jsonResult[i].data.station["id"] + '" type="'+ jsonResult[i].data.station["mt"]+'" ');
        }

    },
    error: function (data) { 
      console.log("Une erreur est survenue");

   }

  });
*/
/*

    $.ajax({
        type: "GET",
        crossDomain: true,
        url: url_genre,
        //problème CORS
        //headers: { 'Access-Control-Allow-Origin': 'http://127.0.0.1:8000/administration', 'Content-Type':'xml' },
        dataType: "jsonp",    
        success: function (xmlResponse) {
            $xmlParse = $.parseXML(xmlResponse);
            $xml = $($xmlParse);
            $tuneInVal = $(xml).find("tunein").text();
            $stationId = $(xml).find("station").each(function () { 
                    var id = $(this).attr('id');
                    return id;
             });
             var audioTag = document.createElement("audio");
                audioTag.src = $tuneInUrl + $tuneInVal + "?id=" + $stationId;
                audioTag.type = 'audio/mpeg';
                document.getElementById('api-content-result').appendChild(audioTag);
        },
        error: function (xmlResponse) { 
            console.log("Une erreur est survenue");

         }
    });
  */

 
}

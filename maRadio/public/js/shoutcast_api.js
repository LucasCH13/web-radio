let selectedValue;
let api_key = "j99MYuH7ghxGwq5p";
let url_genre;
let tuneInUrl = " http://yp.shoutcast.com"
////http://api.shoutcast.com/legacy/genresearch?k=j99MYuH7ghxGwq5p&genre=Classic&limit=2,1

$(document).ready(function(){
    $('#ajouter-genre').click(function(){
        selectedValue = $("#form-control").val();
        url_genre = "http://api.shoutcast.com/legacy/genresearch?k=" + api_key +"&genre=" + selectedValue + "&limit=2,1";
        getRadioByGenre();
        console.log(url_genre);
    });
  });

function getRadioByGenre() {  

    $.ajax({
        type: "GET",
        crossDomain: true,
        url: url_genre,
        //problème CORS
        headers: { 'Access-Control-Allow-Origin': '*' },
        dataType: "xml",    
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

}

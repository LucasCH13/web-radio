

//marche une fois, le lien ne veut prend pas en compte une autre valeur si elle change
let selectedValue = $("#form-control").val();
let api_key = "j99MYuH7ghxGwq5p";
let url_genre =  "http://api.shoutcast.com/legacy/genresearch?k=" + api_key +"&genre=" + selectedValue + "&limit=2,1";
////http://api.shoutcast.com/legacy/genresearch?k=j99MYuH7ghxGwq5p&genre=Classic&limit=2,1

$(document).ready(function(){
    $('#ajouter-genre').click(function(){
        getRadioByGenre();
      console.log(url_genre);
    });
  });
  
function getRadioByGenre() {  
/*
    $.ajax({
        type: "GET",
        url: url_genre,
        dataType: "xml",
        success: function (xml_response) {
            
        }
    });
*/
}




$(function() {
    $("#date").datepicker({
        firstDay: 1 ,
        dateFormat: 'dd-mm-yy',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        minDate: 0, 
        maxDate: "+6M"
        });
    $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
    $('#start-city, #end-city').autocomplete({
        source: "/autocomplete",
        minLength: 2,
        delay: 500,
        autoFocus: true
    });
    $('#search').submit(function() {
        $('#search').attr('action', '/search/' 
                                    + $('#start-city').val() + '/'
                                    + $('#end-city').val() + '/'
                                    + $('#date').val());
    })
})

/*
window.onload=complete;
function complete() {
    document.getElementById('end-city').setAttribute('placeholder', 'Loading...');
    document.getElementById('start-city').setAttribute('placeholder', 'Loading...');
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("cities").innerHTML='';
            document.getElementById("cities").innerHTML=xmlhttp.responseText;
            document.getElementById('end-city').setAttribute('placeholder', 'Ville / code postal de départ');
            document.getElementById('end-city').removeAttribute('disabled');

            document.getElementById('start-city').setAttribute('placeholder', 'Ville / code postal d\'arrivée');
            document.getElementById('start-city').removeAttribute('disabled');
        }
      }
    xmlhttp.open("GET","/autocomplete?all=true" ,true);
    xmlhttp.send();
}
*/



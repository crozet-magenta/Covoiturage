$(function() {
    $("#date").datepicker({
        firstDay: 1 ,
        dateFormat: 'dd-mm-yy',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        minDate: 0, 
        maxDate: "+6M"
        });
    $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
    $('#start-city, #end-city').autocomplete({
        source: "/autocomplete",
        minLength: 2,
        delay: 10,
        autoFocus: true
    });
    $('#search').submit(function() {
        $('#search').attr('action', '/search/' 
                                    + $('#start-city').val() + '/'
                                    + $('#end-city').val() + '/'
                                    + $('#date').val());
    })
});

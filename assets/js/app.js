$(function() {
    $('#start-city, #end-city').autocomplete({
        source: "/autocomplete",
        minLength: 2,
        delay: 500,
        autoFocus: true
    })
})
$(function() {
    $('#start-city, #end-city').autocomplete({
        source: "/autocomplete",
        minLength: 2,
        delay: 500,
        autoFocus: true
    })
})
/*function complete(e) {
    console.log(e);
    input = document.getElementById(e);

    console.log(input);
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("cities").innerHTML='';
            document.getElementById("cities").innerHTML=xmlhttp.responseText;
        }
      }
    xmlhttp.open("GET","/autocomplete?term=" + input.value ,true);
    xmlhttp.send();
}*/
$(document).ready(function(){
    $("#search_symbol").keypress(function (e) {
     if (e.which == 13){
        keyword = document.querySelector('input[name = "search"]').value
        window.open('https://finance.yahoo.com/quote/' + keyword.toUpperCase(), '_blank')
     }
 });
});
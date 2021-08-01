$(document).ready(function() {
    $('#pw_chk').keyup(function() {
        if($('#pw').val() == $('#pw_chk').val()){
            $("#alert-success").css('display', 'inline-block') 
            $("#alert-danger").css('display','none')
        } else{ 
            $("#alert-success").css('display','none')
            $("#alert-danger").css('display', 'inline-block')
        }
    });
});
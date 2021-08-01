$(document).ready(function () {
    $('#sign_up').click(function () {
        if($('#address').val() == "") {
            alert('An email address is required');
            return false;
        }
    });
});
$(document).ready(function () {
    var windowWidth = $( window ).width();
    $('#user_id').click(function () {
        if(windowWidth > 768)
            if($('.user_menu').is(':visible'))
                $('.user_menu').slideUp(400);
            else 
                $('.user_menu').slideDown(400);
    });
});
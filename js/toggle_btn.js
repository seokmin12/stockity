$(document).ready(function(){
    $('#toggle_btn').click(function() {
        if($('.navbar_content').is(':visible'))
            $('.navbar_content').slideUp(400);
        else 
            $('.navbar_content').slideDown(400);
    });
});

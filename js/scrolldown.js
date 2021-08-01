$(document).ready(function () {
    $('#about_btn').click(function () {
        var offset = $('#about').offset(); //선택한 태그의 위치를 반환
        $('html').animate({scrollTop: offset.top}, 900);
    });
    $('#contact_btn').click(function () {
        var offset = $('#contact').offset();
        $('html').animate({scrollTop: offset.top}, 900);
    });

});
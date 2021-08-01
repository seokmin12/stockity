$(document).ready(function () {
    $('#send').click(function () {
        if($('#user_name').val() == "", $('#user_email').val() == "", $('#message').val() == "") {
            alert("Fill in all blanks!")
            return false;
        }
    });
});
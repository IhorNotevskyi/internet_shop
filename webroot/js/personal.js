$(document).ready(function () {
    $('#change_personal_email').click(function () {
        $('#email_cart_user').css('display', 'block');
        $('#password_cart_user').css('display', 'none');
    });

    $('#new_email_reset').click(function () {
        $('#email_cart_user').css('display', 'none');
    });

    $('#change_personal_pass').click(function () {
        $('#password_cart_user').css('display', 'block');
        $('#email_cart_user').css('display', 'none');
    });

    $('#new_password_reset').click(function () {
        $('#password_cart_user').css('display', 'none');
    });
});
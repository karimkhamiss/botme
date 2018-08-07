$(function () {
    $('#signup').submit(function (e) {
        var button = $('#signup button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/signup',
            type: 'POST',
            data: $('#signup').serialize(),
            success: function (data) {
                 // alert(data);
                $("#signup label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#signup>div.alert', "Account Created Successfully , Please Login Now");
                    $("#signup>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#signup>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#signup>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){
                tellme(data);
                // alert(data)
                reload(data);
            }
        });
    });
});
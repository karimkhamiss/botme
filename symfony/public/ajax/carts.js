$(function () {
    $('#add-cart').submit(function (e) {
        var button = $('#add-cart button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/carts/add',
            type: 'POST',
            data: $('#add-cart').serialize(),
            success: function (data) {
                $("#add-cart label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#add-cart>div.alert', "Added Successfully");
                    $("#add-cart>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#add-cart>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#add-cart>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){
                reload(data);
            }
        });
    });
});
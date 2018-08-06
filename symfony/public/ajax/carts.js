$(function () {
    $("button.AddToCart").click(function(){
        waiting();
        var product = $(this).data("product");
        var cart = 1;
        $.ajax({
            url : '/client/cart/'+cart+'/product/'+product+'/add',
            type: 'POST',
            success: function (data) {
                alert(data);
                $("#add-cart label.alert").fadeOut();
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
                tellme(data);
                // reload(data);
            }
        });
        finish();

    });
    $("button.RemoveFromCart").click(function(){
        waiting();
        var id = $(this).data("id");
        var cart = 1;
        $.ajax({
            url : '/client/cart/'+id+'/remove',
            type: 'POST',
            success: function (data) {
                alert(data);
                $("#add-cart label.alert").fadeOut();
                if(data == 1)
                {
                    location.reload();

                }
                else {
                    location.reload();
                }
            },
            error:function(data){
                tellme(data);
                // reload(data);
            }
        });
        finish();

    });
    $("button.EmptyCart").click(function(){
        waiting();
        var cart = $(this).data("cart");
        var client = $(this).data("client");
        $.ajax({
            url : '/client/'+client+'/cart/'+cart+'/empty',
            type: 'POST',
            success: function (data) {
                alert(data);
                $("#add-cart label.alert").fadeOut();
                if(data == 1)
                {
                    location.reload();

                }
                else {
                    location.reload();
                }
            },
            error:function(data){
                tellme(data);
                // reload(data);
            }
        });
        finish();

    });
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
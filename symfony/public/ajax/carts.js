$(function () {
    $('#add-cart').submit(function (e) {
        alert("submitted")
        var button = $('#add-cart button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/categories/add',
            type: 'POST',
            data: $('#add-cart').serialize(),
            success: function (data) {
                 alert(data);
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
                alert(data)
                reload(data);
            }
        });
    });
    $(".delete-cart").click(function(){
        var CartID = $(this).attr("data-id");
        alert(CartID);
        $("#delete-cart input[name='id']").val(CartID);
    })
    $("#delete-cart").submit(function(e){
        var button = $('#delete-cart button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/categories/delete",
            type:"POST",
            data:$("#delete-cart").serialize(),
            success:function(data){
                // alert(data);
                // alert(data['responseText']);
                button_done(button);
                $("#delete-cart label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#delete-cart>div.alert', "Deleted Successfully");
                    $("#delete-cart>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#delete-cart>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#delete-cart>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
    })

});
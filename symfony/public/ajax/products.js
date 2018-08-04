$(function () {
    $('#add-product').submit(function (e) {
        alert("submitted")
        var button = $('#add-product button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/products/add',
            type: 'POST',
            data: $('#add-product').serialize(),
            success: function (data) {
                 alert(data);
                $("#add-product label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#add-product>div.alert', "Added Successfully");
                    $("#add-product>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#add-product>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#add-product>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
            },
            error:function(data){
                tellme(data);
                reload(data);
            }
        });
    });
    $(".delete-product").click(function(){
        var ProductID = $(this).attr("data-id");
        alert(ProductID);
        $("#delete-product input[name='id']").val(ProductID);
    })
    $("#delete-product").submit(function(e){
        var button = $('#delete-product button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/products/delete",
            type:"POST",
            data:$("#delete-product").serialize(),
            success:function(data){
                // alert(data);
                button_done(button);
                $("#delete-product label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#delete-product>div.alert', "Deleted Successfully");
                    $("#delete-product>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#delete-product>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#delete-product>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
$(function () {
    $('#add-category').submit(function (e) {
        alert("submitted")
        var button = $('#add-category button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/categories/add',
            type: 'POST',
            data: $('#add-category').serialize(),
            success: function (data) {
                 alert(data);
                $("#add-category label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#add-category>div.alert', "Added Successfully");
                    $("#add-category>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#add-category>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#add-category>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
    $(".DeleteCategory").click(function(){
        var CategoryID = $(this).attr("data-id");
        // alert(CategoryID);
        $("#DeleteCategory input.hidden").val(CategoryID);
    })
    $("#DeleteCategory").submit(function(e){
        var button = $('#DeleteCategory button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/categories/delete",
            type:"POST",
            data:$("#DeleteCategory").serialize(),
            success:function(data){
                // alert(data);
                // alert(data['responseText']);
                button_done(button);
                $("#DeleteCategory label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#DeleteCategory>div.alert', "Deleted Successfully");
                    $("#DeleteCategory>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#DeleteCategory>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#DeleteCategory>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }


            },
            error:function(data){reload(data);
            //tellme(data)
                button_done(button);
                 // alert(data['responseText']);
                PrintOnSelector('#DeleteCategory>div.alert', "Cannot Delete This Category");
                $("#DeleteCategory>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
                    $(this).delay(1000).fadeOut(function () {
                        location.reload();
                    });
                });
            }
        });
    })

});
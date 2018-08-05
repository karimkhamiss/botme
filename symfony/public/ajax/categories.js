$(function () {
    $('#add-category').submit(function (e) {
        // alert("submitted")
        var button = $('#add-category button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/categories/add',
            type: 'POST',
            data: $('#add-category').serialize(),
            success: function (data) {
                 // alert(data);
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
                // alert(data)
                reload(data);
            }
        });
    });
    $(".delete-category").click(function(){
        var CategoryID = $(this).attr("data-id");
        alert(CategoryID);
        $("#delete-category input[name='id']").val(CategoryID);
    })
    $("#delete-category").submit(function(e){
        var button = $('#delete-category button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/categories/delete",
            type:"POST",
            data:$("#delete-category").serialize(),
            success:function(data){
                // alert(data);
                // alert(data['responseText']);
                button_done(button);
                $("#delete-category label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#delete-category>div.alert', "Deleted Successfully");
                    $("#delete-category>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#delete-category>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#delete-category>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
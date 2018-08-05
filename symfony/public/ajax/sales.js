$(function () {
    function get_price(id,sale_value)
    {
        $.ajax({
            url: '/sales/product/'+id+'/'+sale_value+'/calculate',
            type: 'GET',
            success: function (data) {
                if (data) {
                    // alert(data);
                    //  data = JSON.parse(data);
                    // alert(data);
                    // //  alert(data['required']);
                    $('b#before-value').html(data['before_sale']);
                    $('b#after-value').html(data['after_sale']);
                    $("#sale-result").show();
                }
            },
            error:function(data){
                reload(data);
                // //tellme(data)
            }
        });
    }
    $("#add-sale button#calculate").click(function () {
        waiting();
        var product_id = $("#add-sale select[name='product_id']").val();
        var sale_value = $("#add-sale input[name='value']").val();
        get_price(product_id,sale_value);
        finish();
    });
    $('#add-sale').submit(function (e) {
        alert("submitted")
        var button = $('#add-sale button[type="submit"]');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url : '/sales/add',
            type: 'POST',
            data: $('#add-sale').serialize(),
            success: function (data) {
                 alert(data);
                $("#add-sale label.alert").fadeOut();
                button_done(button);
                if(data == 1)
                {
                    PrintOnSelector('#add-sale>div.alert', "Added Successfully");
                    $("#add-sale>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#add-sale>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#add-sale>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
    $(".delete-sale").click(function(){
        var SaleID = $(this).attr("data-id");
        alert(SaleID);
        $("#delete-sale input[name='id']").val(SaleID);
    })
    $("#delete-sale").submit(function(e){
        var button = $('#delete-sale button');
        button_waiting(button);
        e.preventDefault();
        $.ajax({
            url:"/sales/delete",
            type:"POST",
            data:$("#delete-sale").serialize(),
            success:function(data){
                // alert(data);
                // alert(data['responseText']);
                button_done(button);
                $("#delete-sale label.alert").fadeOut();
                if(data == 1)
                {
                    PrintOnSelector('#delete-sale>div.alert', "Deleted Successfully");
                    $("#delete-sale>div.alert").removeClass("alert-danger").addClass("alert-success").fadeIn(function () {
                        $(this).delay(1000).fadeOut(function () {
                            location.reload();
                        });
                    });
                }
                else {
                    PrintOnSelector('#delete-sale>div.alert', "Unexpected Error Come , Please Try Again");
                    $("#delete-sale>div.alert").removeClass("alert-success").addClass("alert-danger").fadeIn(function () {
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
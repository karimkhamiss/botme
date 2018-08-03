/* popup */
function closePopup()
{
    $(".popup").delay(50).fadeOut(300,function(){
        $(".background").fadeOut(300);
        $(".popup .alert").fadeOut(300);
        $("input[type='radio']").prop('checked', false);
        $("input[type='checkbox']").prop('checked', false);
        $("#session_pricing_container,#session_package_container").hide(1);
        $(".popup input:not([type='hidden']):not([type='radio']):not([type='checkbox']), textarea,select").val("");
    })
}
$(".background").click(function(){
    closePopup();
});

$(".popup .no , .popup i.fa-close").click(function(){
    closePopup();
});
$(document).on('click','*',function(){
    if(this.hasAttribute('data-popup'))
    {
        var popup = $(this).attr("data-popup");
        if(this.hasAttribute("data-img"))
        {
            var image = $(this).attr("src");
            $("#"+popup+" .popup-content img").attr("src",image);
        }
        $(".popup").fadeOut(300,function(){
            $(".background").fadeIn(300,function(){
                $("#"+popup+"-popup").fadeIn(300);
            })
        })
    }

});
/* loading */
$(window).on('load',function () {
    $(".loading *").delay(1000).fadeOut(800, function () {
        $("body").css("overflow", "auto");
        $(".loading").fadeOut(function () {
            $(this).remove();
        });
    });

});
/* loading */
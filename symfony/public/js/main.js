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
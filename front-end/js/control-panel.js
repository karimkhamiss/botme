$(document).ready(function() {
    $('.list-view').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "aaSorting": []
    });
    $(".dataTables_filter input").removeClass("form-control input-sm").
    appendTo("#List-Filter");
    $(".dataTables_length select").removeClass("form-control input-sm").
    appendTo("#List-Length");
    $("div.dataTables_length label , div.dataTables_filter label").remove();
    $("div.filter input").attr('placeholder','Search ...');

    $(".dataTables_paginate").detach().appendTo(".pagination");
} );
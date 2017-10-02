$(document).ready(function() {
    var left_key=0;
    var right_key =0;
    var select_item = "";
    var emp = "";
    var step = "";
    var manual = "";
    var dir = "";
    var name =  "";
    var fio = "";
    var dol =  "";


    $(document).on("click", "#reset", function () {
        $(".cancel_popup").click();
        select();
    });

    // отмена действия
    $(document).on("click", ".cancel_popup", function () {
        $("#popup_context_menu_update").css("display","none");
        $("#action_history_docs_popup").css("display","none");
        $("#popup_update_tree").html("");
        $("#emp_report_name").html("");
        $("#docs_report_name").html("");
        emp = "";
        step = "";
        manual = "";
        dir = "";
        name =  "";
        fio = "";
        dol = "";
        select_item = "";
        left_key = "";
        right_key = "";
    });

    // Выбрать узел
    $(document).on("click", "#node_docs", function () {
        $("#popup_context_menu_update").css("display","block");
        var emp_id = "";
        var report_type = "org_str_tree";
        $.ajax({
            type: "POST",
            url: "/master_report/main",
            data: {
                emp_id:emp_id,
                report_type: report_type
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){

                    $("body").css("margin-top","0px");
                    $('#test_block').fadeIn(0);
                    $('#popup_update_tree').html(content);
                    $(".tree_item").addClass("none");
                    $(".tree_item_fio").addClass("none");
                    $("html, body").animate({ scrollTop: 0 }, 0);
                    $("#tree_main>ul").removeClass("none");
                    // присваеваем классы дня непустых элементов
                    $(".tree_item").each(function() {
                        var parent = $(this).parent("li");
                        if(parent.children('ul').length != 0){
                            $(this).addClass("open_item");
                        }
                    });
                    $(".open_item").closest("ul").removeClass("none");
                    $(".open_item").removeClass("none");

                }
            },
            error: function () {
                console.log('error');
            }
        });
    });


    function select(){
        $.ajax({
            type: "POST",
            url: "/report_step/select",
            data: {
                select_item:select_item,
                left_key:left_key,
                right_key:right_key
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;

                if(status =="ok") {
                    location.reload();
                    //window.location = "/report_step";
                }
                if(status == "") {

                }
            },
            error: function () {
            }
        });
    }

    // Сброс
    $(document).on("click", "#rebut_node_docs", function () {
        left_key=0;
        right_key =0;
        select_item = "";
        $.ajax({
            type: "POST",
            url: "/report_step/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;
                var select = result.select;
                if(content !="") {
                    $('#node_docs_select').html(select);
                }
                if(content !="") {
                    $('#strings').html(content);
                }
            },
            error: function () {
            }
        });
    });

    // выбираем  по отделу
    $(document).on("click", ".tree_item", function () {
        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        select();
    });

    // фильтр по прогрессу прохождения
    $(document).on("change", ".target", function () {
        select_item = $(this).val();
        select();
    });


    // запрос по истории документа
    $(document).on("click", ".docs_report_step_row", function () {
        $("#action_history_docs_popup").css("display","block");
        var file_id =  $(this).attr("file_id");
        dol =  $(this).attr("dol");
        fio =  $(this).attr("fio");
        var name =  $(this).attr("name");


        $("#emp_report_name").html(fio);
        $("#dolg_report_name").html(dol);
        $("#docs_report_name").html(name);

        $.ajax({
            type: "POST",
            url: "/report_step/action_history_docs",
            data: {
                file_id:file_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;

                if(content !="") {
                    $('#popup_action_list').html(content);
                }
            },
            error: function () {
            }
        });
    });



    $(function () {
        $('#table1').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'select':true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
            }
        })
    })





    //var table = $('#table1').DataTable();
    //
    //table.columns().flatten().each( function ( colIdx ) {
    //    // Create the select list and search operation
    //    var select = $('<select />')
    //        .appendTo(
    //        table.column(colIdx).footer()
    //    )
    //        .on( 'change', function () {
    //            table
    //                .column( colIdx )
    //                .search( $(this).val() )
    //                .draw();
    //        } );
    //
    //    table
    //        .column( colIdx )
    //        .cache( 'search' )
    //        .sort()
    //        .unique()
    //        .each( function ( d ) {
    //            select.append( $('<option value="'+d+'">'+d+'</option>') );
    //        } );
    //} );

    //$('#table1').DataTable( {
    //    "scrollX": true
    //} );
});


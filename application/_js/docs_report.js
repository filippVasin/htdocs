$(document).ready(function() {
    var left_key=0;
    var right_key =0;
    var select_item = "";
    var select_item_status = "";
    var emp = "";
    var step = "";
    var manual = "";
    var dir = "";
    var name =  "";
    var fio = "";
    var dol =  "";
    var date_from = "";
    var date_to = "";


    $(document).on("click", "#reset", function () {
        $(".cancel_popup").click();
        $('#datepicker_from').val("");
        $('#datepicker_to').val("");
        select();
    });

    $('#table1_wrapper>.row:first-child').append($("#node_docs_select"));
    $('#table1_wrapper>.row>div').addClass("col-sm-4");
    $('#table1_wrapper .col-sm-4').removeClass("col-sm-6");

    //$('#table1_wrapper .col-sm-6').addClass("col-sm-4");
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
        select_item_status = "";
        left_key = "";
        right_key = "";
        date_from = "";
        date_to = "";
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
            url: "/docs_report/select",
            data: {
                select_item_status:select_item_status,
                select_item:select_item,
                left_key:left_key,
                right_key:right_key,
                date_from:date_from,
                date_to:date_to
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
            url: "/docs_report/start",
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
    $(document).on("change", "#select_item_status", function () {
        select_item_status = $(this).val();
        select();
    });

    // фильтр по прогрессу прохождения
    $(document).on("change", "#select_item", function () {
        select_item = $(this).val();
        select();
    });


    // запрос по истории документа
    $(document).on("click", ".docs_report_step_row", function () {
        $("#action_history_docs_popup_button").click();
        var file_id =  $(this).attr("file_id");
        dol =  $(this).attr("dol");
        fio =  $(this).attr("fio");
        var name =  $(this).attr("name");

        $("#emp_report_name").html(fio);
        $("#dolg_report_name").html(dol);
        $("#docs_report_name").html(name);

        $.ajax({
            type: "POST",
            url: "/docs_report/action_history_docs",
            data: {
                file_id:file_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;

                if(content !="") {
                    $('#popup_action_list').html(content);
                    $("#open_doc_popup").attr("file_id",file_id);
                    $("#open_doc_popup_print").attr("file_id",file_id);
                }
            },
            error: function () {
            }
        });
    });



    var table = $('#table1').DataTable({
        //"language": {
        //    "url": "Russian.json"
        //}
    });
    table.columns().flatten().each( function ( colIdx ) {
        // Create the select list and search operation
        var select = $('<button type="button" class="btn btn-primary btn-sm pull-right select_button" data-toggle="tooltip" title="" data-original-title="Date range" aria-describedby=""> <i class="fa fa-check-square-o"></i></button>')
            .appendTo(
            table.column(colIdx).footer()
        )
        select.closest("th")
            .on( 'change',".dropdownmenu", function () {
                table
                    .column( colIdx )
                    .search( $(this).val())
                    .draw();
            } );

        var html ='<option class = "li_select" value= "" data_select = "">ВСЁ</option>';

        table
            .column( colIdx )
            .cache( 'search' )
            .sort()
            .unique()
            .each( function ( d ) {
                html = html + '<option class = "li_select" value= "'+d+'" data_select = "'+d+'">'+d+'</option>';

            } );
        var parent= $(select).closest("th");
        parent.append('<select class="dropdownmenu none">' +html +'</select> ');

    } );


    $(document).on("click",'.select_button',function(){
        if($(this).hasClass("open_select")){
            $(this).removeClass("open_select");

            var parent= $(this).closest("th");
            var chil = $(parent).children(".dropdownmenu");
            chil.addClass("none");
        } else {
            $(this).addClass("open_select");

            $(".dropdownmenu").addClass("none");
            var parent= $(this).closest("th");
            var chil = $(parent).children(".dropdownmenu");
            chil.removeClass("none");
        }
    });



    // проверка с какого устройтства вошли
    if(isMobile.any()){
        $("#datepicker_to").attr("type","date");
        $("#datepicker_from").attr("type","date");
    } else {
        // datapickers
        $('#datepicker_to').datepicker({
            language: "ru",
            autoclose: true
        }).on('hide', function(e) {
            date_from = $('#datepicker_from').val();
            date_to = $('#datepicker_to').val();
            select();
        });

        $('#datepicker_from').datepicker({
            language: "ru",
            autoclose: true
        }).on('hide', function(e) {
            date_to = $('#datepicker_to').val();
            date_from = $('#datepicker_from').val();
            select();
        });
    }




    $(document).on("click",'#open_doc_popup',function(){
       var file = $(this).attr("file_id");
        window.open("/emp_doc_views?" + file);
    });

    $(document).on("click",'#open_doc_popup_print',function(){
        var file = $(this).attr("file_id");
        window.open("/doc_views?" + file + "&emp_doc");
    });

});


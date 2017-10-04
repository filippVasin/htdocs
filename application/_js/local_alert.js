$(document).ready(function() {
    var left_key = 0;
    var right_key = 0;
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


    function select(){
        $.ajax({
            type: "POST",
            url: "/local_alert/select",
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

    $(document).on("click", ".alert_row", function () {
        dol =  $(this).attr("dol");
        dir =  $(this).attr("dir");
        name =  $(this).attr("name");
        doc =  $(this).attr("doc");
        file_id =  $(this).attr("file_id");
        observer_em =  $(this).attr("observer_em");
        local_id =  $(this).attr("local_id");
        action_type =  $(this).attr("action_type");
        observer_em = $(this).attr("observer_em");
        if( action_type == 10 ){
            $("#emp_report_name").html(name);
            $("#dolg_report_name").html(dol);
            $("#dolg_report_dir").html(dir);
            $("#docs_report_name").html(doc);
            $("#alert_signature_docs_popup_button").click();
        }
        if( action_type == 12 ){
            $("#emp_acception_name").html(name);
            $("#dolg_acception_name").html(dol);
            $("#dolg_acception_dir").html(dir);
            $("#docs_acception_name").html(doc);
            $("#alert_acception_docs_popup_button").click();
        }
        if( action_type == 14 ){
            $("#emp_bailee_push_name").html(name);
            $("#dolg_bailee_push_name").html(dol);
            $("#dolg_bailee_push_dir").html(dir);
            $("#docs_bailee_push_name").html(doc);
            $("#alert_bailee_push_popup_button").click();
        }
    });


// отправляем на исполнение в forms и передаём нужные параметры
    $(document).on("click", "#yes_popup_3", function () {
        var la_real_form_id = file_id;
        var la_employee = observer_em;

        var action_name = "secretary_signature_action";

        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                la_real_form_id:la_real_form_id,
                la_employee:la_employee,
                action_name:action_name,
                observer_em:observer_em,
                local_id:local_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var form_actoin_set = result.form_actoin;
                var la_employee_set = result.la_employee;
                var la_real_form_id_set = result.la_real_form_id;
                var observer_em_set = result.observer_em;

                $(".alert_row").each(function() {
                    if(la_real_form_id_set == $(this).attr("file_id")){
                        $(this).css("display","none");
                    }
                });
                $("#alert_signature_docs_popup").addClass("none");
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    // отправляем на исполнение в forms и передаём нужные параметры
    $(document).on("click", "#yes_popup_4", function () {
        var la_real_form_id = file_id;
        var la_employee = observer_em;

        var action_name = "secretary_get_doc_action";

        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                la_real_form_id:la_real_form_id,
                la_employee:la_employee,
                action_name:action_name,
                observer_em:observer_em,
                local_id:local_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var form_actoin_set = result.form_actoin;
                var la_employee_set = result.la_employee;
                var la_real_form_id_set = result.la_real_form_id;
                var observer_em_set = result.observer_em;

                $(".alert_row").each(function() {
                    if(la_real_form_id_set == $(this).attr("file_id")){
                        $(this).css("display","none");
                    }
                });
                $("#alert_acception_docs_popup").addClass("none");
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    // отправляем на исполнение в forms и передаём нужные параметры
    $(document).on("click", "#yes_popup_14", function () {
        var la_real_form_id = file_id;
        var la_employee = observer_em;

        var action_name = "bailee_action";

        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                la_real_form_id:la_real_form_id,
                la_employee:la_employee,
                action_name:action_name,
                observer_em:observer_em,
                local_id:local_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var form_actoin_set = result.form_actoin;
                var la_employee_set = result.la_employee;
                var la_real_form_id_set = result.la_real_form_id;
                var observer_em_set = result.observer_em;

                $(".alert_row").each(function() {
                    if(la_real_form_id_set == $(this).attr("file_id")){
                        $(this).css("display","none");
                    }
                });
                $("#alert_bailee_push_popup").addClass("none");
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });





// выбор статуса
    $(document).on("change", "#node_docs_select", function () {
        select_item = $(this).val();
        $(".alert_row").addClass("none");
        $(".alert_row").each(function() {
            if ((($(this).attr('doc_trigger') == select_item)||(select_item == ""))&&((select_item_em == "")||($(this).attr('emp') == select_item_em))){
                $(this).removeClass("none");
            }
        });
    });

    // выбор сотрудника
    $(document).on("change", "#node_docs_select_em", function () {
        select_item_em = $(this).val();
        $(".alert_row").addClass("none");
        $(".alert_row").each(function() {
            if ((($(this).attr('doc_trigger') == select_item)||(select_item == ""))&&((select_item_em == "")||($(this).attr('emp') == select_item_em))){
                $(this).removeClass("none");
            }
        });
    });



    // упорядочить по сотруднику
    $(document).on("click", ".order_by", function () {
        group =  $(this).attr("group");

        $.ajax({
            type: "POST",
            url: "/local_alert/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item,
                select_item_em:select_item_em,
                group:group,
                time_from:time_from,
                time_to:time_to
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;
                var select = result.select;
                var select_em = result.select_em;
                if (content != "") {
                    $('#node_docs_select').html(select);
                }
                if (content != "") {
                    $('#node_docs_select_em').html(select_em);
                }
                if (content != "") {
                    $('#strings').html(content);
                }
            },
            error: function () {
                console.log('error');
            }
        });// ajax
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

    // выбираем узел
    $(document).on("click", ".tree_item", function () {
        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        $("#popup_update_tree").attr("left_key", left_key);
        $("#popup_update_tree").attr("right_key", right_key);

        time_from = $("#time_from").val();
        time_to = $("#time_to").val();
        select_item = $(".target").val();
        select_item_em = $(".target_em").val();

        $(".btn-default").click();
        $.ajax({
            type: "POST",
            url: "/local_alert/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item,
                select_item_em:select_item_em,
                group:group,
                time_from:time_from,
                time_to:time_to
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;

                    $('#strings').html(content);
            },
            error: function () {
            }
        });

    });


    //сброс всех фильтров
    $(document).on("click", "#rebut_node_docs", function () {
        left_key = 0;
        right_key = 0;
        dol = "";
        dir = "";
        name = "";
        doc = "";
        left_key = "";
        right_key = "";
        select_item = "";
        observer_em = "";
        select_item_em = "";
        group = "";
        time_from = "";
        time_to ="";

        $("#time_from").val("");
        $("#time_to").val("");

        $(".alert_row").removeClass("none");
    });


    var table = $('#table1').DataTable({
        "language": {
            "url": "Russian.json"
        }
    });
    //table.columns().flatten().each( function ( colIdx ) {
    //    // Create the select list and search operation
    //    var select = $('<button type="button" class="btn btn-primary btn-sm pull-right select_button" data-toggle="tooltip" title="" data-original-title="Date range" aria-describedby=""> <i class="fa fa-check-square-o"></i></button>')
    //        .appendTo(
    //        table.column(colIdx).footer()
    //    )
    //        .on( 'click','.li_select', function () {
    //            table
    //                .column( colIdx )
    //                .search( $(this).attr('data_select'))
    //                .draw();
    //        } );
    //    var html ='<li class = "li_select" data_select = "">ВСЁ</li>';
    //    table
    //        .column( colIdx )
    //        .cache( 'search' )
    //        .sort()
    //        .unique()
    //        .each( function ( d ) {
    //            html = html + '<li class = "li_select" data_select = "'+d+'">'+d+'</li>';
    //        } );
    //
    //    select.append('<div class="dropdownmenu none"><div class="ranges"><ul>' +html +'</ul> <div class="range_inputs"> </div> </div> </div>');
    //
    //} );


    $(document).on("click",'.select_button',function(){
        if($(this).hasClass("open_select")){
            $(this).removeClass("open_select");

            $(".dropdownmenu").addClass("none");

        } else {
            $(this).addClass("open_select");

            $(".dropdownmenu").addClass("none");
            var chil = $(this).children(".dropdownmenu");
            chil.removeClass("none");
        }
    });

    // datapickers
    $('#datepicker_to').datepicker({
        language: "ru"
    }).on('hide', function(e) {
        date_from = $('#datepicker_from').val();
        date_to = $('#datepicker_to').val();
        select();
    });

    $('#datepicker_from').datepicker({
        language: "ru"
    }).on('hide', function(e) {
        date_to = $('#datepicker_to').val();
        date_from = $('#datepicker_from').val();
        select();
    });

});


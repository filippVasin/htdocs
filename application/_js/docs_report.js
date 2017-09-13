$(document).ready(function() {
    var left_key=0;
    var right_key =0;
    var select_item = "";
    var select_item_status ="";
    var dol =  "";
    var fio =  "";
    var emp = "";
    var step = "";
    var manual = "";
    var dir = "";
    var name =  "";


    $.ajax({
        type: "POST",
        url: "/docs_report/start",
        data: {
            left_key:left_key,
            right_key:right_key,
            select_item:select_item,
            select_item_status:select_item_status
        },
        success: function (answer) {
            var result = jQuery.parseJSON(answer);
            var content = result.content;
            var select = result.select;
            var status_select = result.status_select;
            if(content !="") {
                $('#strings').html(content);
            } else {
                $('#strings').html("По запросу ничего нет");
            }

            $('#node_docs_select').html(select);
            $('#node_docs_status_select').html(status_select);
        },
        error: function () {
        }
    });


    // отмена действия
    $(document).on("click", ".cancel_popup", function () {
        $("#popup_context_menu_update").css("display","none");
        $("#popup_update_tree").html("");
        $("#action_history_docs_popup").css("display","none");
        $("#emp_report_name").html("");
        $("#docs_report_name").html("");
        emp = "";
        step = "";
        manual = "";
        dir = "";
        name =  "";
        fio = "";
        dol =  "";
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


    // Сброс
    $(document).on("click", "#rebut_node_docs", function () {
        left_key=0;
        right_key =0;
        select_item = "";
        select_item_status="";
        $.ajax({
            type: "POST",
            url: "/docs_report/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item,
                select_item_status:select_item_status
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;
                var select = result.select;
                if(content !="") {
                    $('#node_docs_select').html(select);
                    $('#strings').html(content);
                }  else {
                    $('#strings').html("По запросу ничего нет");
                }
            },
            error: function () {
            }
        });
    });

    // выбираем сотрудника
    $(document).on("click", ".tree_item", function () {
        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        $(".cancel_popup").click();
        $.ajax({
            type: "POST",
            url: "/docs_report/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item,
                select_item_status:select_item_status
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;

                if(content !="") {
                    $('#strings').html(content);
                } else {
                    $('#strings').html("По запросу ничего нет");
                }
            },
            error: function () {
            }
        });

    });
// выбор экшена
    $(document).on("change", "#node_docs_select", function () {
        select_item = $(this).val();
        $.ajax({
            type: "POST",
            url: "/docs_report/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item,
                select_item_status:select_item_status
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var content = result.content;

                if(content !="") {
                    $('#strings').html(content);
                }  else {
                    $('#strings').html("По запросу ничего нет");
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });

    // выбор статуса
    $(document).on("change", "#node_docs_status_select", function () {
        select_item_status = $(this).val();
        $.ajax({
            type: "POST",
            url: "/docs_report/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item,
                select_item_status:select_item_status
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var content = result.content;

                if(content !="") {
                    $('#strings').html(content);
                }  else {
                    $('#strings').html("По запросу ничего нет");
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });


    // запрос по истории документа
    $(document).on("click", ".report_step_row", function () {
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
            url: "/docs_report/action_history_docs",
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

});


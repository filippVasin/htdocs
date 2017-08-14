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


    $.ajax({
        type: "POST",
        url: "/test/start",
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
        dol =  "";
    });

    // Выбрать узел
    $(document).on("click", "#node_docs", function () {
        $("#popup_context_menu_update").css("display","block");
        $.ajax({
            type: "POST",
            url: "/test/load_node_docs_tree",
            data: {
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $("#popup_update_tree").html(content);
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });


    // Сброс
    $(document).on("click", "#rebut_node_docs", function () {
        left_key=0;
        right_key =0;
        select_item = "";
        $.ajax({
            type: "POST",
            url: "/test/start",
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

    // выбираем сотрудника
    $(document).on("click", ".new_parent", function () {
        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        $(".cancel_popup").click();
        $.ajax({
            type: "POST",
            url: "/test/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;

                if(content !="") {
                    $('#strings').html(content);
                }
            },
            error: function () {
            }
        });

    });

    // фильтр по прогрессу прохождения
    $(document).on("change", ".target", function () {
        select_item = $(this).val();
        if(select_item ==""){
            $(".report_step_row").css("display","block");
        }
        // не начинал
        if(select_item=="Не начатые"){
            $(".report_step_row").each(function() {
                var start_date = $(this).find(".start_date").html();
                if(start_date != "Не начинал"){
                    $(this).css("display","none");
                }
            });
        }

        if(select_item=="Не законченные"){
            $(".report_step_row").css("display","none");
            $(".report_step_row").each(function() {
                var start_date = $(this).find(".start_date").html();
                var end_date = $(this).find(".end_date").html();
                if((start_date != "Не начинал")&&(end_date=="Не прошол")){
                    $(this).css("display","block");
                }
            });
        }

        if(select_item=="Законченные"){
            $(".report_step_row").css("display","none");
            $(".report_step_row").each(function() {
                var end_date = $(this).find(".end_date").html();
                if(end_date!="Не прошол"){
                    $(this).css("display","block");
                }
            });
        }
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
            url: "/test/action_history_docs",
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


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

    // выбираем сотрудника
    $(document).on("click", ".tree_item", function () {
        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        $(".cancel_popup").click();
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
            $(".report_step_row").css("display","none");
            $(".report_step_row").each(function() {
                var start_date = $(this).find(".start_date").html();
                if(start_date == "Не начинал"){
                    $(this).css("display","block");
                }
            });
        }

        if(select_item=="Не законченные"){
            $(".report_step_row").css("display","none");
            $(".report_step_row").each(function() {
                var start_date = $(this).find(".start_date").html();
                var end_date = $(this).find(".end_date").html();
                if((start_date != "Не начинал")&&(end_date=="Не прошел")){
                    $(this).css("display","block");
                }
            });
        }

        if(select_item=="Законченные"){
            $(".report_step_row").css("display","none");
            $(".report_step_row").each(function() {
                var end_date = $(this).find(".end_date").html();
                if(end_date!="Не прошел"){
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




    //$(document).on('click','.open_item',function(){
    //
    //    if($(this).hasClass("open_ul")){
    //        $(this).removeClass("open_ul");
    //
    //        $(this).siblings('ul').addClass('none');
    //    } else {
    //        $(this).addClass("open_ul");
    //
    //        $(this).siblings('ul').removeClass('none');
    //    }
    //});

});


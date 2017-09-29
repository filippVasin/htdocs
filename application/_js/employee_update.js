$(document).ready(function() {
    var item_id = "";
    var item_name =  "";
    var parent_id =  "";
    var parent_name =  "";
    var erarh = "";
    var em_id = "";
    var id_position = "";
    var old_position ="";
    var right_key = "";
    var left_key =  "";

     // отмена действия
    $(document).on("click", ".cancel_popup", function () {
        $("#popup_context_menu").css("display", "none");
        $("#subscript_context_menu_popup").html("");
        $("#popup_context_menu_delete").css("display", "none");
        $("#subscript_context_menu_popup_delete").html("");
        $("#popup_context_menu_update").css("display","none");
        $("#subscript_context_menu_popup_update").html("");
        $("#popup_delete_employee_result").css("display","none");
        item_id = "";
        item_name =  "";
        em_id= "";
        old_position="";
    });

    // отмена действия с перезагрузкой страницы
    $(document).on("click", ".cancel_popup_reload", function () {
        $("#popup_context_menu").css("display", "none");
        $("#subscript_context_menu_popup").html("");
        $("#popup_context_menu_delete").css("display", "none");
        $("#subscript_context_menu_popup_delete").html("");
        $("#popup_context_menu_update").css("display","none");
        $("#subscript_context_menu_popup_update").html("");
        $("#popup_delete_employee_result").css("display","none");
        item_id = "";
        item_name =  "";
        em_id= "";
        old_position="";
        location.reload()
    });

    // выбираем сотрудника
    $(document).on("click", ".table_row", function () {
        item_id =  $(this).attr("item_id");
        item_name =  $(this).attr("item_name");
        em_id =  $(this).attr("em_id");
        old_position =  $(this).attr("position");
        $("#popup_context_menu_button").click();
        $("#subscript_context_menu_popup").html(item_name);
    });

    // команда - уволить
    $(document).on("click", "#delete_popup_context_menu", function () {
        $(".btn-default").click();
        $("#popup_context_menu_delete_button").click();
        $("#popup_context_menu").css("display", "none");
        $("#subscript_context_menu_popup_delete").html(item_name);

    });

    // команда - поменять должность
    $(document).on("click", "#update_popup_context_menu", function () {
        $("#popup_context_menu_update").css("display","block");
        $("#popup_context_menu").css("display", "none");
        $("#subscript_context_menu_popup_update").html(item_name);
        $.ajax({
            type: "POST",
            url: "/employee_update/load_positions_tree",
            data: {
                item_id:item_id
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


    // команда - поменять должность, уже выбрали новую
    $(document).on("click", ".position", function () {
        parent_id =  $(this).attr("parent_id");
        id_position =  $(this).attr("id_position");
        right_key = $(this).attr("right_key");
        left_key =  $(this).attr("left_key");


        // запрос полной иерархии новой должности
        $.ajax({
            type: "POST",
            url: "/employee_update/load_new_erarch",
            data: {
                left_key:left_key,
                right_key:right_key
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $("#subscript_select_position_position").html(content);
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
        $("#popup_update_select_position").css("display","block");
        $("#subscript_select_position_employee").html(item_name);
        $("#subscript_old_position_position").html(old_position);
    });

    $(document).on("click", "#popup_update_select_position_cancel", function () {
        $("#popup_update_select_position").css("display", "none");
        $("#subscript_select_position_employee").html("");
        $("#subscript_select_position_position").html("");
        $("#subscript_select_position_parent").html("");
        $("#popup_context_menu_title_result").html("");
        parent_id = "";
        parent_name = "";
        erarh = "";
        id_position = "";
        right_key = "";
        left_key =  "";
    });
    //  меняем должность
    $(document).on("click", "#popup_update_select_position_yes", function () {
        $.ajax({
            type: "POST",
            url: "/employee_update/update_position_yes",
            data: {
                item_id:item_id,
                em_id:em_id,
                parent_id:parent_id,
                id_position:id_position
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $("#popup_update_select_position").css("display", "none");
                    $("#popup_delete_employee_result").css("display", "block");
                    $("#popup_context_menu_title_result").html(content);

                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    //  увольняем
    $(document).on("click", "#delete_employee_popup_context_menu", function () {
        $.ajax({
            type: "POST",
            url: "/employee_update/delete_employee_yes",
            data: {
                item_id:item_id,
                  em_id:em_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $("#popup_context_menu_delete").css("display", "none");
                    $("#popup_delete_employee_result").css("display", "block");
                    $("#popup_context_menu_title_result").html(content);
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });


});
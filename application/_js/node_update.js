$(document).ready(function() {
    var item_id = "";
    var item_name =  "";
    var new_parent_name = "";
    var new_parent_id = "";
    var child ="";
    var old_erarh =  "";
    var right_key = "";
    var left_key =  "";

    //var parent_name =  "";
    //var erarh = "";
    //var id_position = "";

    // отмена действия
    $(document).on("click", ".cancel_popup", function () {
        $("#popup_context_menu").css("display", "none");
        $("#subscript_context_menu_popup").html("");
        $("#popup_context_menu_delete").css("display", "none");
        $("#subscript_context_menu_popup_delete").html("");
        $("#popup_context_menu_update").css("display","none");
        $("#subscript_context_menu_popup_update").html("");
        $("#popup_child_one").css("display","none");
        $("#popup_delete_node_result").css("display","none");
        $("#popup_delete_node_result_not").css("display","none");
        item_id = "";
        item_name =  "";
        child ="";
        old_erarh = "";
        right_key = "";
        left_key =  "";

    });

    // отмена действия
    $(document).on("click", ".cancel_popup_reload", function () {
        $("#popup_context_menu").css("display", "none");
        $("#subscript_context_menu_popup").html("");
        $("#popup_context_menu_delete").css("display", "none");
        $("#subscript_context_menu_popup_delete").html("");
        $("#popup_context_menu_update").css("display","none");
        $("#subscript_context_menu_popup_update").html("");
        $("#popup_child_one").css("display","none");
        $("#popup_delete_node_result").css("display","none");
        $("#popup_delete_node_result_not").css("display","none");
        item_id = "";
        item_name =  "";
        child ="";
        old_erarh = "";
        right_key = "";
        left_key =  "";
        location.reload()
    });

    // выбираем узел
    $(document).on("click", ".node", function () {
        item_id =  $(this).attr("item_id");
        item_name =  $(this).attr("erarh");
        child =  $(this).attr("child");
        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        // запрос полной иерархии новой должности
        $.ajax({
            type: "POST",
            url: "/node_update/load_old_erarch",
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
                    old_erarh = content;
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
        right_key = "";
        left_key =  "";
        $("#popup_context_menu").css("display","block");
        $("#subscript_context_menu_popup").html(item_name);
    });

    // команда - уволить
    $(document).on("click", "#delete_popup_context_menu", function () {
        $("#popup_context_menu_delete").css("display","block");
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
            url: "/node_update/load_positions_tree",
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


    // команда - поменять должность
    $(document).on("click", ".new_parent", function () {
        new_parent_id =  $(this).attr("new_parent_id");

        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        // запрос полной иерархии новой должности
        $.ajax({
            type: "POST",
            url: "/node_update/load_old_erarch",
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
                    new_parent_name = content;
                }// if
                right_key = "";
                left_key =  "";
                $("#popup_update_select_position").css("display","block");
                $("#subscript_select_position_employee").html(old_erarh);
                $("#subscript_select_position_parent").html(new_parent_name);
            },
            error: function () {
                console.log('error');
            }
        });// ajax

    });

    $(document).on("click", "#popup_update_select_position_cancel", function () {
        $("#popup_update_select_position").css("display", "none");
        $("#subscript_select_position_employee").html("");
        $("#subscript_select_position_parent").html("");
        new_parent_id = "";
        new_parent_name = "";
    });
    //  меняем должность
    $(document).on("click", "#popup_update_select_node_yes", function () {
        $.ajax({
            type: "POST",
            url: "/node_update/update_node_yes",
            data: {
                item_id:item_id,
                new_parent_id:new_parent_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $("#popup_update_select_position").css("display", "none");
                    $("#popup_update_node_result").css("display", "block");
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    //  удаляем элемент
    $(document).on("click", "#delete_node_popup_context_menu", function () {
        if(child==1){
            // если есть дети тогда не удаляем
            $("#popup_context_menu").css("display", "none");
            $("#subscript_context_menu_popup").html("");
            $("#popup_context_menu_delete").css("display", "none");
            $("#subscript_context_menu_popup_delete").html("");
            $("#popup_context_menu_update").css("display","none");
            $("#subscript_context_menu_popup_update").html("");
            item_id = "";
            item_name =  "";
            $("#popup_child_one").css("display","block");
        } else {

            $.ajax({
                type: "POST",
                url: "/node_update/delete_node_yes",
                data: {
                    item_id: item_id
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var content = result.content;
                    // если 'ok' - рисуем тест
                    if (request_result == 'ok') {
                        $("#popup_context_menu_delete").css("display","none");
                        $("#popup_delete_node_result").css("display","block");
                        // удаляем элемент с экрана
                        $('.node').each(function() {
                            if(item_id ==$(this).attr('item_id')){
                                $(this).remove();
                            }
                        });
                    }// if
                    if (request_result == 'Занятно') {
                        $("#popup_context_menu_delete").css("display","none");
                        $("#popup_delete_node_result_not").css("display","block");
                    }// if
                },
                error: function () {
                    console.log('error');
                }
            });// ajax
        }// if child
    });


});
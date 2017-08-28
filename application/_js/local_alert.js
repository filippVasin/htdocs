$(document).ready(function() {
    var left_key=0;
    var right_key =0;
    var dol =  "";
    var dir =  "";
    var name = "";
    var doc = "";
    var select_item = "";
    var observer_em = "";
    var select_item_em="";
    var group = "";
    var time_from = "";
    var time_to = "";
    var file_id= "";
    var local_id = "";

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

                $('#node_docs_select').html(select);


                $('#node_docs_select_em').html(select_em);

            if(content !="") {
                $('#strings').html(content);
            }
        },
        error: function () {
        }
    });


    // отмена действия
    $(document).on("click", ".cancel_popup", function () {
        $("#alert_signature_docs_popup").css("display","none");
        $("#popup_context_menu_update").css("display","none");
        $("#emp_report_name").html("");
        $("#dolg_report_name").html("");
        $("#dolg_report_dir").html("");
        $("#docs_report_name").html("");
        $("#popup_update_tree").attr("left_key", "");
        $("#popup_update_tree").attr("right_key", "");
        dol =  "";
        dir =  "";
        name = "";
        doc = "";
    });


    $(document).on("click", ".alert_row", function () {
        $("#alert_signature_docs_popup").css("display","block");
        dol =  $(this).attr("dol");
        dir =  $(this).attr("dir");
        name =  $(this).attr("name");
        doc =  $(this).attr("doc");
        file_id =  $(this).attr("file_id");
        observer_em =  $(this).attr("observer_em");
        local_id =  $(this).attr("local_id");

        observer_em = $(this).attr("observer_em");
        $("#emp_report_name").html(name);
        $("#dolg_report_name").html(dol);
        $("#dolg_report_dir").html(dir);
        $("#docs_report_name").html(doc);
    });


// отправляем на исполнение в forms и передаём нужные параметры
    $(document).on("click", "#yes_popup", function () {
        var la_real_form_id = file_id;
        var la_employee = observer_em;

        var action_name = "la_signature";

        $.ajax({
            type: "POST",
            url: "/forms/start",
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
                $("#alert_signature_docs_popup").css("display","none");
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });


// выбор статуса
    $(document).on("change", "#node_docs_select", function () {
        select_item = $(this).val();
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

                if(content !="") {
                    $('#strings').html(content);
                } else {
                    $('#strings').html("По запросу ничего нет");
                }
            },
            error: function () {
                console.log('error');
            }
        });

    });

    // выбор сотрудника
    $(document).on("change", "#node_docs_select_em", function () {
        select_item_em = $(this).val();

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

                if(content !="") {
                    $('#strings').html(content);
                } else {
                    $('#strings').html("По запросу ничего нет");
                }
            },
            error: function () {
                console.log('error');
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
        $.ajax({
            type: "POST",
            url: "/report_step/load_node_docs_tree",
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

    // выбираем узел
    $(document).on("click", ".new_parent", function () {
        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        $("#popup_update_tree").attr("left_key", left_key);
        $("#popup_update_tree").attr("right_key", right_key);

        time_from = $("#time_from").val();
        time_to = $("#time_to").val();
        select_item = $(".target").val();
        select_item_em = $(".target_em").val();

        $(".cancel_popup").click();
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
            }
        });
    });





    // фильтр по прогрессу прохождения
    $(document).on("change", ".target", function () {
        time_from = $("#time_from").val();
        time_to = $("#time_to").val();

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

                if(content !="") {
                    $('#strings').html(content);
                }
            },
            error: function () {
            }
        });//ajax
    });




    //$("#time_to").keyup(function(){
    //    alert('Элемент foo потерял фокус.');
    //});
});


$(document).ready(function() {
    var user_id = 0;
    var company_id = 0;
    $(document).on('change', "#select_type_pluse", function () {
        var type = $(this).val();
        if (type == 1) {
            $("#plus_dol").removeClass("none");
            $("#plus_node_kladr").addClass("none");
            $("#plus_node").addClass("none");
            select_admin_list();
        }
        if (type == 4) {
            $("#plus_node").removeClass("none");
            $("#plus_dol").addClass("none");
            select_select_list();
        }
    });


    function select_admin_list() {
        $.ajax({
            type: "POST",
            url: "/supervisor/select_admin_list",
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;

                if (request_result == 'ok') {
                    $("#select_admin_item").html(content);
                }

            },
            error: function () {
            }
        });
    }

    function select_select_list() {
        $.ajax({
            type: "POST",
            url: "/supervisor/select_select_list",
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;

                if (request_result == 'ok') {
                    $("#select_select_item").html(content);
                }
            },
            error: function () {
            }
        });
    }


    $(document).on('click', '#add_new_item', function () {
        var flag = 1;
        var type_plus = 0;
        var admin_id = 0;
        var select_id = 0;
        var user_id = 0;


        type_plus = $('#select_type_pluse').val();
        admin_id = $('#select_admin_item').val();
        select_id = $('#select_select_item').val();
        $('#select_admin_item').val("");
        $('#select_select_item').val("");

        if (type_plus == 0) {
            $("#select_type_pluse").css("border-color", "red");
            setTimeout("$('#select_type_pluse').css('border-color','#ccc')", 3000);
            flag = 0;
        }
        if ((type_plus == 1) && (admin_id == 0)) {
            $("#select_admin_item").css("border-color", "red");
            setTimeout("$('#select_admin_item').css('border-color','#ccc')", 3000);
            flag = 0;
        }
        if ((type_plus == 4) && (select_id == 0)) {
            $("#select_select_item").css("border-color", "red");
            setTimeout("$('#select_select_item').css('border-color','#ccc')", 3000);
            flag = 0;
        }
        if(type_plus == 1){
            user_id = admin_id;
        }
        if(type_plus == 4){
            user_id = select_id;
        }

        if (flag == 1) {
            $.ajax({
                type: "POST",
                url: "/supervisor/add_item",
                data: {
                    type_plus: type_plus,
                    user_id: user_id
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var content = result.content;
                    var message_text = result.message;
                    var id_item = result.id_item;
                    if (request_result == "ok") {
                        if(type_plus == 1){
                            $('#admin_box').append(content);
                        }
                        if(type_plus == 4){
                            $('#selector_box').append(content);
                        }
                    }
                    $("#cancel_add_new_item").click();
                    message(message_text, request_result);
                },
                error: function () {
                }
            });
        } else {
            message("Введите нужные данные", "error");
        }
    });


    $(document).on('click', '.add_observer_item', function () {
        user_id = $(this).attr('user_id');
        $.ajax({
            type: "POST",
            url: "/supervisor/add_observer_item",

            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                if (request_result == "ok") {
                    $("#select_company_list").html(content);
                    $("#select_company_list_popup_button").click();
                }
            },
            error: function () {
            }
        });
    });

    $(document).on('click', '#add_new_item_company', function () {
        var company = 0
        company = $("#select_company_list").val();

        if(company != 0) {
            $.ajax({
                type: "POST",
                url: "/supervisor/add_observer_item_yes",
                data: {
                    company: company,
                    user_id: user_id
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var content = result.content;
                    if (request_result == "ok") {
                        $(".company_item").each(function () {
                            if ($(this).attr('item_id') == user_id) {
                                $(this).append(content);
                            }
                        });

                        $("#cancel_add_new_item_company").click();
                    }
                },
                error: function () {
                }
            });
        } else {
            $("#select_company_list").css("border-color", "red");
            setTimeout("$('#select_company_list').css('border-color','#ccc')", 3000);
        }
    });


    $(document).on('click', '.delete_observer_item', function () {
        user_id = $(this).attr('user_id');
        $("#delete_observer_popup_button").click();
    });


    $(document).on('click', '#delete_observer_yes', function () {
            $.ajax({
                type: "POST",
                url: "/supervisor/delete_observer_item_yes",
                data: {
                    user_id: user_id
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var content = result.content;
                    if (request_result == "ok") {
                        $(".company_item").each(function () {
                            if ($(this).attr('item_id') == user_id) {
                                $(this).remove();
                            }
                        });
                        $("#delete_observer_cancel").click();
                    }
                },
                error: function () {
                }
            });
    });


    $(document).on('click', '.delete_company_item', function () {
        user_id = $(this).attr('user_id');
        company_id = $(this).attr('company_id');
        $("#delete_company_popup_button").click();
    });



    $(document).on('click', '#delete_company_yes', function () {
        $.ajax({
            type: "POST",
            url: "/supervisor/delete_company_item_yes",
            data: {
                user_id: user_id,
                company_id:company_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                if (request_result == "ok") {
                    $(".delete_company_item").each(function () {
                        var parent = $(this).closest(".company_item");
                        var delete_item = $(this).closest(".box-body");
                        if (($(this).attr('company_id') == company_id) && (parent.attr('item_id') == user_id)) {
                            delete_item.remove();
                        }
                    });
                    $("#delete_company_cancel").click();
                }
            },
            error: function () {
            }
        });
    });



    $(document).on("click",'.collapse_button',function(){
        var parent = $(this).closest(".box");
        if(parent.hasClass("collapsed-box")){
            parent.removeClass("collapsed-box");
        } else {
            parent.addClass("collapsed-box");
        }
    });

});
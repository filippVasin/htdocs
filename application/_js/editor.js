$(document).ready(function() {
    var item_id ="";
    var item_name ="";
    var type ="";

    // выбираем элемент для редактированния
    $(document).on("click", ".table_row", function () {
        item_id =  $(this).attr("item_id");
        item_name =  $(this).attr("item_name");
        type =  $(this).attr("type");
        $("#edit_popup").css("display","block");
        $("#edit_popup_input").val(item_name);
    });

    // отмена действия
    $(document).on("click", "#cancel_popup_input", function () {
        $("#edit_popup").css("display","none");
        $("#edit_popup_input").val("");
    });

    // отмена действия
    $(document).on("click", "#save_popup_input", function () {

        if(item_name == $("#edit_popup_input").val()){
            // если не было изменений - просто закрываем
            $("#edit_popup").css("display","none");
            $("#edit_popup_input").val("");
        } else {
            // если были изменения - отправляем изменения
            item_name = $("#edit_popup_input").val();
            $.ajax({
                type: "POST",
                url: "/editor/save_popup_input",
                data: {
                      item_id:item_id,
                    item_name:item_name,
                         type:type
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var request_message = result.message;
                    var content = result.content;
                    // если 'ok' - рисуем тест
                    if(request_result == 'ok'){
                        $(".table_row").each(function() {
                            if (!(($(this).attr("item_id") == item_id) && (type == $(this).attr("type")))) {
                            } else {
                                $(this).children(".type_name").html(content);
                                $(this).attr("item_id", item_id);
                                $(this).attr("item_name", item_name);
                            }
                        });
                        $("#edit_popup").css("display","none");
                        $("#edit_popup_input").val("");
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    });

    // переход между вкладками
    $(document).on("click", "#table_type_title", function () {
        $(".table_box").css("display","none");
        $("#table_type").css("display","block");
    });

    $(document).on("click", "#table_num_title", function () {
        $(".table_box").css("display","none");
        $("#table_num").css("display","block");
    });
    $(document).on("click", "#table_employees_title", function () {
        $(".table_box").css("display","none");
        $("#table_employees").css("display","block");
    });
    $(document).on("click", "#table_user_title", function () {
        $(".table_box").css("display","none");
        $("#table_user").css("display","block");
    });


    // выбираем элемент для редактированния
    $(document).on("click", ".table_row_employee", function () {
        item_id =  $(this).attr("item_id");

        $.ajax({
            type: "POST",
            url: "/editor/employee_card",
            data: {
                item_id:item_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);

                var surname = result.surname;
                var name = result.name;
                var second_name = result.second_name;
                var birthday = result.birthday;
                var start_date = result.start_date;
                var em_status = result.em_status;
                var request_result = result.status;
                var personnel_number = result.personnel_number;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){

                        $("#edit_popup_employees").attr("item_id",item_id);
                        $("#title_employees_item_id").html(item_id);
                        $("#edit_popup_input_surname").val(surname);
                        $("#edit_popup_input_name").val(name);
                        $("#edit_popup_input_second_name").val(second_name);

                        $("#edit_popup_input_start_date").val(start_date);
                        $("#edit_popup_input_birthday").val(birthday);

                        $("#edit_popup_input_status").val(em_status);
                        $("#edit_popup_input_personnel_number").val(personnel_number);

                        $("#edit_popup_employees").css("display","block");
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });

    $(document).on("click", "#cancel_popup_input_employees", function () {
        $("#edit_popup_employees").css("display","none");
    });


    // выбираем элемент для редактированния
    $(document).on("click", "#save_popup_input_employees", function () {
        item_id =  $("#edit_popup_employees").attr("item_id");
       var surname  = $("#edit_popup_input_surname").val();
       var name = $("#edit_popup_input_name").val();
       var second_name  = $("#edit_popup_input_second_name").val();
       var start_date  = $("#edit_popup_input_start_date").val();
       var birthday  = $("#edit_popup_input_birthday").val();
       var em_status   = $("#edit_popup_input_status").val();
        var personnel_number   = $("#edit_popup_input_personnel_number").val();

        $.ajax({
            type: "POST",
            url: "/editor/save_employee_card",
            data: {
                item_id:item_id,
                surname:surname,
                name:name,
                second_name:second_name,
                start_date:start_date,
                birthday:birthday,
                em_status:em_status,
                personnel_number:personnel_number
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var surname = result.surname;
                var name = result.name;
                var second_name = result.second_name;
                var request_result = result.status;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $(".table_row_employee").each(function() {
                        if($(this).attr("item_id")==item_id) {
                            var content = surname + " " + name + " " + second_name;
                            $(this).children(".type_name").html(content);
                        }
                    });
                    $("#edit_popup_employees").css("display","none");
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });



    // выбираем элемент для редактированния
    $(document).on("click", ".table_row_user", function () {
        item_id =  $(this).attr("item_id");

        $.ajax({
            type: "POST",
            url: "/editor/user_card",
            data: {
                item_id:item_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);

                var login = result.login;
                var role_id = result.role_id;
                var employee_id = result.employee_id;
                var full_name = result.full_name;
                var request_result = result.status;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){

                    $("#edit_popup_user").attr("item_id",item_id);
                    $("#title_user_item_id").html(login);

                    $("#edit_popup_input_full_name").val(full_name);
                    $("#edit_popup_input_employee_id").val(employee_id);
                    $("#edit_popup_input_role_id").val(role_id);

                    $("#edit_popup_user").css("display","block");
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });

    $(document).on("click", "#cancel_popup_input_user", function () {
        $("#edit_popup_user").css("display","none");
    });

// выбираем элемент для редактированния
    $(document).on("click", "#save_popup_input_user", function () {
        item_id =  $("#edit_popup_user").attr("item_id");
        var full_name = $("#edit_popup_input_full_name").val();
        var employee_id = $("#edit_popup_input_employee_id").val();
        var role_id = $("#edit_popup_input_role_id").val();
        if(($("#edit_popup_input_pass").val()) == ($("#edit_popup_input_next_pass").val())) {
            var pass = $("#edit_popup_input_pass").val();
            $.ajax({
                type: "POST",
                url: "/editor/save_user_card",
                data: {
                    item_id: item_id,
                    full_name: full_name,
                    employee_id: employee_id,
                    role_id: role_id,
                    pass: pass
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    // если 'ok' - рисуем тест
                    if (request_result == 'ok') {
                        $("#edit_popup_user").css("display", "none");
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        } else {
            $('.input_name_row>.pass').css("border-color","red");
            setTimeout("$('.input_name_row>.pass').css('border-color','initial')", 3000);
        }
    });
    $(function() {
        //задание заполнителя с помощью параметра placeholder
        $("#edit_popup_input_start_date").mask("9999.99.99", {placeholder: "гггг.мм.дд" });
        $("#edit_popup_input_birthday").mask("9999.99.99", {placeholder: "гггг.мм.дд" });

    });

});
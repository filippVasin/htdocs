/**
 * Created by root on 15.02.2017.
 */
$(document).ready(function() {

    $(document).on("click", "#show_add_employees_form", function () {
        $('#add_employees_form').toggle(200);
    });

    $(document).on("change", ".control_select", function () {

        preloader('Загрузка данных', 'show');

        var request = new Array();

        $('.control_select').each(function(){
            var item_value = $(this).val();
            request.push(item_value);
        });

        $.ajax({
            type: "POST",
            url: "/employees_control/get_employees",
            data: "request_data=" + JSON.stringify(request),
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var items = result.items;

                var list = $('#employees_list');
                list.html('');

                if(request_result == 'ok'){
                    $.each(items, function(key, item){
                        list.prepend(item);
                    });
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });
    });

    $(document).on("click", "#add_new_employee", function () {
        preloader('Загрузка данных', 'show');

        var request = new Array();

        $('.control_select').each(function(){
            var item_value = $(this).val();
            if(item_value == '-1'){
                message('Для добавления нового сотрудника нужно выбрать все значения', 'error');
                exit();
            }
            request.push(item_value);
        });

        var employee_surname = $('#new_employee_surname').val();
        var employee_name = $('#new_employee_name').val();
        var employee_second_name = $('#new_employee_second_name').val();
        var employee_birthday = $('#new_employee_birthday').val();
        var employee_start_date = $('#new_employee_start_date').val();

        if(employee_surname == '' || employee_name == '' || employee_second_name == '' || employee_birthday == '' || employee_start_date == ''){
            message('Для добавления нового сотрудника нужно заполнить все поля', 'error');
            return;
        }

        var new_employee_data = new Array();

        new_employee_data.push({'employee_surname' : employee_surname, 'employee_name' : employee_name, 'employee_second_name' : employee_second_name, 'employee_birthday' : employee_birthday, 'employee_start_date' : employee_start_date});

        $.ajax({
            type: "POST",
            url: "/employees_control/add",
            data: "selected_items=" + JSON.stringify(request) + "&new_employee_data=" + JSON.stringify(new_employee_data),
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var new_item = result.new_item;

                $('#no_apps').remove();

                if(request_result == 'ok'){
                    $('#employees_list').prepend(new_item);

                    $('#new_employee_surname').val('');
                    $('#new_employee_name').val('');
                    $('#new_employee_second_name').val('');
                    $('#new_employee_birthday').val('');
                    $('#new_employee_start_date').val('');
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });
    });

});

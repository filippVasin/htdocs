/**
 * Created by root on 12.02.2017.
 */
$(document).ready(function() {
    $(document).on("click", "#show_add_item_form", function () {
        $('#add_item_form').toggle(200);
    });

    $(document).on("change", "#control_item_type_select", function () {

        preloader('Загрузка данных', 'show');

        var selected_item_type = $(this).val();

        $.ajax({
            type: "POST",
            url: "/items_control/get_exist_elements",
            data: "selected_item_type=" + selected_item_type,
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var items = result.items;

                var list = $('#items_list');
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

    $(document).on("click", "#add_new_item", function () {
        var selected_item_type = $('#control_item_type_select').val();
        var department_name = $('#new_item_name').val();

        console.log('"' + selected_item_type + '"');

        if(selected_item_type == '-1'){
            message('Вы не выбрали тип для нового элемента', 'error')
            return;
        }

        if(department_name == ''){
            message('Вы не указали наименование для нового отдела', 'error');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/items_control/add",
            data: "item_type=" + selected_item_type + "&name=" + department_name,
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var new_item = result.new_item;

                $('#no_apps').remove();

                if(request_result == 'ok'){
                    $('#items_list').prepend(new_item);
                    $('#new_item_name').val('');
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });
    });
});

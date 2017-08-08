/**
 * Created by root on 14.02.2017.
 */
$(document).ready(function() {

    $(document).on("click", "#show_add_appointment_form", function () {
        $('#add_appointment_form').toggle(200);
    });

    $(document).on("click", "#add_new_appointment", function () {
        var new_appointment_name = $('#new_appointment_name').val();

        if(new_appointment_name == ''){
            message('Вы не указали наименование для нового отдела', 'error');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/appointments_control/add",
            data: "new_appointment_name=" + new_appointment_name,
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var new_item = result.new_item;

                $('#no_apps').remove();

                if(request_result == 'ok'){
                    $('#appointments_list').prepend(new_item);
                    $('#new_appointment_name').val('');
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });
    });
});
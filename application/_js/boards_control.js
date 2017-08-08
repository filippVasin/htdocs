/**
 * Created by root on 12.02.2017.
 */
$(document).ready(function() {
    $(document).on("click", "#show_add_board_form", function () {
        $('#add_board_form').toggle(200);
    });

    $(document).on("click", "#add_new_board", function () {
        var board_name = $('#new_board_name').val();

        console.log('"' + board_name + '"');

        if(board_name == ''){
            message('Вы не указали наименование для нового отдела', 'error');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/boards_control/add",
            data: "name=" + board_name,
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var new_item = result.new_item;

                if(request_result == 'ok'){
                    $('#company_list').prepend(new_item);
                    $('#new_board_name').val('');
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });
    });
});

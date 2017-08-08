/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {

    $(document).on("click", "#show_add_company_form", function () {
        $('#add_department_form').toggle(200);
    });

    $(document).on("click", "#add_new_company", function () {
        var company_name = $('#new_company_name').val();
        var company_short_name = $('#new_company_short_name').val();
        var new_company_director_surname = $('#new_company_director_surname').val();
        var new_company_director_name = $('#new_company_director_name').val();
        var new_company_director_second_name = $('#new_company_director_second_name').val();

        if(company_name == '' || company_short_name == '' || new_company_director_surname == '' || new_company_director_name == '' || new_company_director_second_name == ''){
            message('Вы не заполнили все необходимые данные', 'error');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/company_control/add",
            data: "company_name=" + company_name + "&company_short_name=" + company_short_name + "&new_company_director_surname=" + new_company_director_surname + "&new_company_director_name=" + new_company_director_name + "&new_company_director_second_name=" + new_company_director_second_name,
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var new_item = result.new_item;

                if(request_result == 'ok'){
                    $('#company_list').prepend(new_item);
                    $('#new_company_name').val('');
                    $('#new_company_short_name').val('');
                    $('#new_company_director_surname').val('');
                    $('#new_company_director_name').val('');
                    $('#new_company_director_second_name').val('');
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });
    });

    $(document).on("click", ".company_turn_control", function () {
        var company_id = $(this).parent('div').parent('div').attr('company_id');
        var this_item = $(this);

        $('.company_turn_control').each(function(){
            $(this).removeClass('on_company');
            $(this).addClass('off_company');
        });

        $.ajax({
            type: "POST",
            url: "/company_control/set_company_control",
            data: "company_id=" + company_id,
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;

                if(request_result == 'ok'){
                    this_item.addClass('on_company');
                    setTimeout(function(){
                        window.location = "/company_control";
                    }, 3000);
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });

    });

});
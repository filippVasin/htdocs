/**
 * Created by root on 15.02.2017.
 */
$(document).ready(function() {
    $(document).on("click", ".list_item", function () {
        var inside_checkbox = $(this).children('div').children('input');

        if(inside_checkbox.prop('checked') == false){
            inside_checkbox.prop('checked', true);
        }   else{
            inside_checkbox.prop('checked', false);
        }

    });

    $(document).on("click", "#select_all_employee", function () {
        $('#employees_list').children('.list_item').each(function(){
            $(this).children('div').children('input').prop('checked', true);
        });
        $(this).fadeOut(200);
        setTimeout(function(){
            $('#deselect_all_employee').fadeIn(200);
        }, 200);
    });

    $(document).on("click", "#deselect_all_employee", function () {
        $('#employees_list').children('.list_item').each(function(){
            $(this).children('div').children('input').prop('checked', false);
        });
        $(this).fadeOut(200);
        setTimeout(function(){
            $('#select_all_employee').fadeIn(200);
        }, 200);
    });

    $(document).on("click", "#show_documents_download_form", function () {
        var selected_employees_count = 0;
        var download_form = $('#documents_download_form');

        $('#employees_list').children('.list_item').each(function(){
            if($(this).children('div').children('input').prop('checked') == true){
                selected_employees_count++;
            }
        });

        if(selected_employees_count > 0 || download_form.css('display') == 'block'){
            download_form.toggle(200);
        }   else{
            message('Выберите хотя бы одного сотрудника для выгрузки документов', 'info');
        }
    });

    $(document).on("click", "#download_document", function () {
        var selected_download_docs = 0;
        var selected_download_docs_array = new Array();

        $('#documents_download_form').children('.list_item').each(function(){
            if($(this).children('div').children('input').prop('checked') == true){
                selected_download_docs++;
                selected_download_docs_array.push($(this).attr('doc_name'));
            }
        });

        if(selected_download_docs == 0){
            message('Вы не выбрали ни одного типа документа для выгрузки', 'error');
            return;
        }

        var selected_employees_count = 0;
        var selected_employees_array = new Array();

        $('#employees_list').children('.list_item').each(function(){
            if($(this).children('div').children('input').prop('checked') == true){
                selected_employees_count++;
                selected_employees_array.push($(this).attr('employee_id'));
            }
        });

        if(selected_employees_count == 0){
            message('Вы не выбрали ни одного сотрудника для выгрузки', 'error');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/documents_download/download",
            data: "docs_array=" + JSON.stringify(selected_download_docs_array) + "&employees_array=" + JSON.stringify(selected_employees_array),
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var download_link = result.download_link;

                if(request_result == 'ok'){
                    $.each(download_link, function(key, item){
                        setTimeout(function(){
                            window.location = item;
                        }, (key+1)*1500);
                    });
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });
    });

});

$(document).ready(function() {
    var content_id= "";
    var test_id = "";
    var form_id = "";
    var doc_id = "";
    var manual_id = "";

    $(document).on("click", ".cancel_popup", function () {
        $(this).closest(".popup").addClass("none")
    });

    // тест
    $(document).on("click", ".test_id", function () {
        content_id = $(this).attr('content_id');
        $("#edit_popup").removeClass("none");
    });

    $(document).on("click", ".row_tests", function () {
        test_id = $(this).attr('test_id');
            $.ajax({
                type: "POST",
                url: "/step_editor/save_test",
                data: {
                    content_id:content_id,
                    test_id:test_id
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    if(request_result=="ok"){
                        $("#edit_popup").addClass("none");
                        $('.test_id[content_id = '+ content_id +']').html(test_id);
                    }
                    message('Запись прошла успешна', request_result);
                }
            });
    });

    // инструкция
    $(document).on("click", ".doc_id", function () {
        content_id = $(this).attr('content_id');
        $("#inst_edit_popup").removeClass("none");
    });

    $(document).on("click", ".row_inst", function () {
        doc_id = $(this).attr('doc_id');
        $.ajax({
            type: "POST",
            url: "/step_editor/save_doc",
            data: {
                content_id:content_id,
                doc_id:doc_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                if(request_result=="ok"){
                    $("#inst_edit_popup").addClass("none");
                    $('.doc_id[content_id = '+ content_id +']').html(doc_id);
                }
                message('Запись прошла успешна', request_result);
            }
        });
    });

    // документ
    $(document).on("click", ".form_id", function () {
        content_id = $(this).attr('content_id');
        $("#doc_edit_popup").removeClass("none");
    });

    $(document).on("click", ".row_doc", function () {
        form_id = $(this).attr('form_id');
        $.ajax({
            type: "POST",
            url: "/step_editor/save_form",
            data: {
                content_id:content_id,
                form_id:form_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                if(request_result=="ok"){
                    $("#doc_edit_popup").addClass("none");
                    $('.form_id[content_id = '+ content_id +']').html(form_id);
                }
                message('Запись прошла успешна', request_result);
            }
        });
    });

    // мануал
    $(document).on("click", ".manual_id", function () {
        content_id = $(this).attr('content_id');
        $("#manual_edit_popup").removeClass("none");
    });

    $(document).on("click", ".row_manual", function () {
        manual_id = $(this).attr('manual_id');
        $.ajax({
            type: "POST",
            url: "/step_editor/save_manual",
            data: {
                content_id:content_id,
                manual_id:manual_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                if(request_result=="ok"){
                    $("#manual_edit_popup").addClass("none");
                    $('.manual_id[content_id = '+ content_id +']').html(manual_id);
                }
                message('Запись прошла успешна', request_result);
            }
        });
    });




});




$(document).ready(function() {
    var content_id= "";
    var test_id = "";


    $(document).on("click", ".test_id", function () {
        content_id = $(this).attr('content_id');
        $("#edit_popup").css("display", "block");
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
                        $("#edit_popup").css("display", "none");
                        $('.test_id.item[content_id = '+ content_id +']').html(test_id);
                    }
                    message('Запись прошла успешна', request_result);
                }
            });
    });

    //$(document).on("click", ".doc_id", function () {
    //    var content_id = $(this).attr('content_id');
    //    $(this).css("border-color","#00ff00");
    //    if(doc_id!=""){
    //        $.ajax({
    //            type: "POST",
    //            url: "/step_editor/save_doc",
    //            data: {
    //                content_id:content_id,
    //                doc_id:doc_id
    //            },
    //            success: function (answer) {
    //                var result = jQuery.parseJSON(answer);
    //                var request_result = result.status;
    //                if(request_result=="ok"){
    //                    setTimeout('$(".doc_id").css("border-color","initial")', 3000);
    //                }
    //                message('Запись прошла успешна', request_result);
    //            }
    //        });
    //    }
    //});
    //
    //$(document).on("click", ".form_id", function () {
    //    var content_id = $(this).attr('content_id');
    //    $(this).css("border-color","#00ff00");
    //    if(form_id!=""){
    //        $.ajax({
    //            type: "POST",
    //            url: "/step_editor/save_form",
    //            data: {
    //                content_id:content_id,
    //                form_id:form_id
    //            },
    //            success: function (answer) {
    //                var result = jQuery.parseJSON(answer);
    //                var request_result = result.status;
    //                if(request_result=="ok"){
    //                    setTimeout('$(".form_id").css("border-color","initial")', 3000);
    //                }
    //                message('Запись прошла успешна', request_result);
    //            }
    //        });
    //    }
    //});
    //
    //$(document).on("click", ".manual_id", function () {
    //    var content_id = $(this).attr('content_id');
    //    $(this).css("border-color","#00ff00");
    //    if(manual_id!=""){
    //        $.ajax({
    //            type: "POST",
    //            url: "/step_editor/save_manual",
    //            data: {
    //                content_id:content_id,
    //                manual_id:manual_id
    //            },
    //            success: function (answer) {
    //                var result = jQuery.parseJSON(answer);
    //                var request_result = result.status;
    //                if(request_result=="ok"){
    //                    setTimeout('$(".manual_id").css("border-color","initial")', 3000);
    //                }
    //                message('Запись прошла успешна', request_result);
    //            }
    //        });
    //    }
    //});
    //$(document).on("click", "#cancel_popup", function () {
    //    $("#edit_popup").css("display","none");
    //});
});




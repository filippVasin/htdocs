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

});




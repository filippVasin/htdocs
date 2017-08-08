
$(document).ready(function() {
    var reset_id = "";
    $(document).on("click", "#reset_progress", function () {
        reset_id =  $(this).attr("reset_id");
        $.ajax({
            type: "POST",
            url: "/dead_end/reset_progress",
            data: {
                reset_id:reset_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    alert("Данные сброшены!");
                    window.location = "/rover";
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });


});
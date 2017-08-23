$(document).ready(function() {

    $(document).on("change", ".period_count", function () {
        var id = $(this).attr('period_count');
        var period_id = $(this).val();
                $(this).css("border-color","#00ff00");
                if(period_id!=""){
                    $.ajax({
                        type: "POST",
                        url: "/period_control/save_period",
                        data: {
                            id:id,
                            period_id:period_id
                        },
                        success: function (answer) {
                            var result = jQuery.parseJSON(answer);
                            var request_result = result.status;
                            if(request_result=="ok"){
                                setTimeout('$(".period_count").css("border-color","initial")', 3000);
                            }
                            message('Запись прошла успешна', request_result);
                        }
                    });
                }
    });

});

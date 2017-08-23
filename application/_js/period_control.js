$(document).ready(function() {

    $(document).on("click", ".save_period", function () {
        var id = $(this).attr('id');
        $('.period_count').each(function(){
            if ($(this).attr('period_count') == id){
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
                                $(this).css("border-color","0000ff");


                            }

                            message('Запись прошла успешна', request_result);
                        }
                    });
                }
            }
        });
    });

});

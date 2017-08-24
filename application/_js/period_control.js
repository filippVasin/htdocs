$(document).ready(function() {

<<<<<<< HEAD
    $(document).on("change", ".period_count", function () {
        var id = $(this).attr('period_count');
        var period_id = $(this).val();
=======
    $(document).on("click", ".save_period", function () {
        var id = $(this).attr('id');
        $('.period_count').each(function(){
            if ($(this).attr('period_count') == id){
                var period_id = $(this).val();
>>>>>>> origin/master
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
<<<<<<< HEAD
                                setTimeout('$(".period_count").css("border-color","initial")', 3000);
                            }
=======
                                $(this).css("border-color","0000ff");


                            }

>>>>>>> origin/master
                            message('Запись прошла успешна', request_result);
                        }
                    });
                }
<<<<<<< HEAD
=======
            }
        });
>>>>>>> origin/master
    });

});

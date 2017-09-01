$(document).ready(function() {
    // сохранили
    $(document).on("focusout", ".period_count", function () {
        var id = $(this).attr('id');
        var periodicity = $(this).val();
        if(periodicity!=""){
            $.ajax({
                type: "POST",
                url: "/period_control/save_period",
                data: {
                    id:id,
                    periodicity:periodicity
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    if(request_result=="ok"){
                        console.log("Запись прошла успешна");
                    }
                }
            });
        }
    });

    // "сохранили";-)
    $(document).on("click", "#save", function () {
        var count = 0;
        $(".period_count").each(function() {
            var fact = $(this).val();
            var history = $(this).attr('history');
            if(fact != history){
                $(this).css("border-color","#00ff00");
                ++count;
            }
        });
        // если были изменения
        if(count>0) {
            message('Запись прошла успешна', 'ok');
            setTimeout('$(".period_count").css("border-color","initial")', 3000);
        }
    });



    $.ajaxSetup({
        beforeSend: function () {
        },
        complete: function () {
            //уничтожаем прилоадер
            $('#floatingBarsG').detach();
        }
    });

});

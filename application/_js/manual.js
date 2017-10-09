$(document).ready(function() {

    // ознакомился
    $(document).on("click", "#go_to_testing", function () {

        $.ajax({
            type: "POST",
            url: "/manual/yes",
            data: {
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                if(request_result == "yes"){
                    window.location = "/pass_test";
                }

            },
            error: function () {
            }
        });
    });

    // документ не показали
    $(document).on("click", "#manual_error", function () {

        $.ajax({
            type: "POST",
            url: "/manual/error",
            data: {
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                if(request_result == "error"){
                    window.location = "/pass_test";
                }

            },
            error: function () {
            }
        });
    });

    // скрипт работы кнопок навигации
    $(document).on("click", "#down", function () {
        window.scrollBy(0, 200);
    });

    $(document).on("click", "#up", function () {
        window.scrollBy(0, -200);
    });
    function print_zz(){
        $('body').css("display","block");
        print();
        //window.location = "/pass_test";
    }


    // скрипт для progress_bar_line
    $(window).on("scroll resize", function() {
        proc = $(window).scrollTop() / ($(document).height() - $(window).height());
        $(".progress_bar_line_back").css({
            "width": (100 * proc | 0) + "%"
        });
        $('.progress_line_proc').html((100*proc|0) + "%");

    })



});


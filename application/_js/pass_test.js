/**
 * Created by root on 14.03.2017.
 */
$(document).ready(function() {


    // флаги док/тест
    var write_doc = 0;
    var go_to_testing = 0;
    // достаём тест test_id для ajax
    //var test_id = $("#start_test").attr('test_id');
        // стартовый запрос на сервер для запуска логики
        $.ajax({
            type: "POST",
            url: "/pass_test/start",
            data: {
                write_doc:write_doc,
                go_to_testing:go_to_testing
                },
            success: function (answer) {
                //  рисуем первый тест/док
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var content = result.content;
                if(request_result == 'manual'){
                    window.location = "/manual";
                }
                if(request_result == 'form'){
                    window.location = "/rover";
                }
                if(request_result == 'next_step'){
                    window.location = "/rover";
                }

                if(request_result == 'ok'){
                    $("#content_box .page_title").css("font-size","30px");
                    $("#content_box .page_title").css("text-align","center");
                    $(".page_title").css("display","none");
                    $(".control_test_item").css("display","none");
                    $("#menu_open").css("display","none");
                    $("#topBar").css("height","70px");
                    $("#test_block").css("margin-top","-40px");
                    $("#content_box").css("padding-top","105px");
                    $(".logo").css("height","70px");
                    $(".logo").css("line-height","70px");
                    $("#body").css("float","none");
                    $("#body").css("margin-left","0px");
                    $("#content_box").css("position","relative");
                    $('#test_block').fadeIn(0);
                    $('#content_box').html(content);
                    $(".logo").css("line-height","70px");
                    $("table").addClass("table");



                }
                var str = $(".info_box_doc").html();
                if(str.length > 73){
                    $(".info_box_doc").css("font-size", "11px");
                }



                message(request_message, request_result);
            },
            error: function () {
            }
        });
    //});

// логика работы тестов и прогресс-бара(по клику меняем состояние)
    $(document).on("click", ".test_answer", function () {
        $(this).parent('div').children('.test_answer').each(function(){
            $(this).removeClass('selected_answer');
            $(this).addClass('unselected_answer');
        });
        // шапокляк для progress_bar_items
        var answer_count = 1;
        $('.selected_answer').each(function(index){
            answer_count++;
        });

        var test_question = 0;
        $('.test_question').each(function(){
            test_question++;
        });
        $('.progress_plan').html(test_question);

        $('.progress_fact').html(answer_count);
        $(".progress_bar_item").each(function(index) {
            if(index<answer_count) {
                $(this).css("color", "#00a65a");
                $('i', this).removeClass('fa-circle-o');
                $('i', this).addClass('fa-check-circle-o');
            }
        });
        // шапокляк end

        $(this).removeClass('unselected_answer');
        $(this).addClass('selected_answer');
    });

    $(document).on("click", "#finish_test", function () {
        var test_result = new Array();

        var test_id = $(this).parents('#test').attr('test_id');

        var answers = new Array();

        // Сичет наличия ответов в вопросах;
        var exist_questions = 0;

        // Сичет наличия ответов в вопросах;
        var exist_answers = 0;

        // Проверяем, на все ли вопросы ответил пользователь;
        $('.test_question').each(function(){
            exist_questions++;

            // Проверяем что есть ответ на этот вопрос;
            $(this).children('.test_answer').each(function(){
                var answer_id = $(this).attr('answer_id');

                if($(this).hasClass('selected_answer') == true){
                    answers.push(answer_id);
                    exist_answers++;
                }
            });
        });

        // Количество сделаных ответов и вопросов должны совпадать;
        if(exist_questions != exist_answers){
            message('Вам нужно ответить на все вопросы для завершения тестирования!', 'error');
            return;
        }

        // ДОбавляем полученные ответы в результирующий массив;
        test_result.push({'test_id' : test_id, 'answers' : answers});

        // Отдаем серверу результаты тестирования на проверку;
        $.ajax({
            type: "POST",
            url: "/pass_test/processing_results",
            data: "test_result=" + JSON.stringify(test_result),
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;




                message(request_message, request_result);

                setTimeout(function(){
                    window.location = "/pass_test";
                }, 5000);

            },
            error: function () {
            }
        });

    });


    $(document).on("click", "#close_test", function () {
        location.reload();
    });
    // запрос второго материала по шагу
    $(document).on("click", "#go_to_testing", function () {

        write_doc = 1;
        go_to_testing = 1;
        // Начинаем прохождение теста;
        $.ajax({
            type: "POST",
            url: "/pass_test/start",
            data: {
                write_doc:write_doc,
                go_to_testing:go_to_testing
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $(".page_title").css("display","none");
                    $(".control_test_item").css("display","none");
                    $("body").css("margin-top","0px");
                    $('#test_block').fadeIn(0);
                    $('#content_box').html(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);

                    if($(window).width()<=1200) {
                        var height = $("#progress_box").height();
                        $(".up").css("top", height);
                        $(".down").css("top", height);
                        $(".navbar").css("margin-top", height - 80);
                    }
                }

                var form = result.form;
                var form_actoin = result.form_actoin;
                if(form !=""){

                    if(form_actoin == "print" ){
                        $('body').html(open);
                        $('body').css("display","none");
                        setTimeout(print_zz, 1000);
                        window.location = "/pass_test";
                    }
                    if(form_actoin == "download" ){
                        var form_link = result.form_link;
                        // создаём ссылку на докумнт и вызываем её
                        var link = document.createElement('a');
                        alert(form_link);
                        link.setAttribute('href',form_link);
                        link.setAttribute('download','download');
                        onload=link.click();
                        window.location = "/pass_test";
                    }
                    if(form_actoin == "open" ){
                        alert("open");
                        $('body').html(open);
                        window.location = "/pass_test";
                    }

                }
                //перезагружаем на следующий step, если нет теста
                if(request_result == 'not test'){
                    window.location = "/pass_test";
                }
                //message(request_message, request_result);
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

    // обработка показа видео
    $(document).on('click','#full_screen',function(){
        if($(this).hasClass("open_screen")) {

            $('iframe').css("width", "800px");
            $('iframe').css("height", "470px");
            $('iframe').css("position", "initial");
            $('iframe').css("top", "initial");
            $('iframe').css("left", "initial");
            $('body').css("position", "initial");

            $('#full_screen').css("z-index", "initial");
            $('#full_screen').css("position", "initial");
            $('#full_screen').css("top", "initial");
            $('#full_screen').css("left", "initial");
            $('#full_screen').css("background-color", "initial");
            $("#full_screen").removeClass("open_screen");
            $('iframe').removeClass("open_screen_if");
        } else {
            var screen_width = $(window).width() + 20;
            var screen_height = $(window).height();
             screen_width = screen_height*1.7;
            $('iframe').css("width", screen_width);
            $('iframe').css("height", screen_height);
            $('iframe').css("position", "absolute");
            $('iframe').css("top", 0);
            $('iframe').css("left",$(window).width()*0.5 - screen_width*0.5);
            $('body').css("position", "absolute");

            $('#full_screen').css("z-index", "999");
            $('#full_screen').css("position", "fixed");
            $('#full_screen').css("bottom", "20px");
            $('#full_screen').css("right", "20px");
            $('#full_screen').css("background-color", "#ccc");
            $("#full_screen").addClass("open_screen");
            $('iframe').addClass("open_screen_if");

        }
    });


});

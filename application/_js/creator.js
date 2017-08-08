/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {
    var  new_type_id = 0;
    var  news_num_id = 0;


    $(document).on("change", ".target", function () {
        var select_item_id = $(this).val();
        $(this).prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/creator/select_event",
            data: {
                select_item_id:select_item_id
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
                    $('#content_box').append(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);
                }


            },
            error: function () {
                console.log('error');
            }
        });

    });


    $(document).on("click", ".button_clear", function () {
        var remoter =  $(this).attr("level");
        $('.create_form_box').remove();
        $('.select_box_item_row').remove();
        $('.target').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).remove();
            }
            $('.dol').remove();
            if(remoter == ($(this).attr("level"))){
                $(this).prop('disabled', false);
            }
        });
        $('.button_clear').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).remove();
            }
        });
        $('.button_plus').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).remove();
            }
        });
    });
    // добавляем наменклатуру
    $(document).on("click", ".button_plus", function () {
        new_type_id = 0;
        news_num_id = 0;
        var id_item =  $(this).attr("item");

        var remoter =  $(this).attr("level");
        $('.create_form_box').remove();
        $('.select_box_item_row').remove();
        $('.target').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).remove();
            }
            $('.dol').remove();
            if(remoter == ($(this).attr("level"))){
                $(this).prop('disabled', false);
            }
        });
        $('.button_clear').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).remove();
            }
        });
        $('.button_plus').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).remove();
            }
        });

        $.ajax({
            type: "POST",
            url: "/creator/button_plus",
            data: {
                id_item:id_item
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;
                var content = result.content;

                if(request_result == 'ok'){
                    $(".page_title").css("display","none");
                    $(".control_test_item").css("display","none");
                    $("body").css("margin-top","0px");
                    $('#test_block').fadeIn(0);
                    $('#create_new_content_box').append(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);
                }


            },
            error: function () {
                console.log('error');
            }
        });

    });


// отправляем форму
//    $(document).on("click", "#send_form", function () {
//        var name = $('#form_name').val();
//        var surname = $('#form_surname').val();
//        var patronymic = $('#form_patronymic').val();
//        var work_start = $('#form_work_start').val();
//        var birthday = $('#form_birthday').val();
//        var email = $('#form_email').val();
//        var id_item = $('#form_id_item').val();
//
//
//
//
//        $.ajax({
//            type: "POST",
//            url: "/creator/create_form",
//            data: {
//                name:name,
//                surname:surname,
//                patronymic:patronymic,
//                work_start:work_start,
//                birthday:birthday,
//                email:email,
//                id_item:id_item
//            },
//            success: function (answer) {
//                var result = jQuery.parseJSON(answer);
//                var request_result = result.status;
//                var request_message = result.message;
//                var content = result.content;
//
//                if(request_result == 'ok'){
//                    $(".page_title").css("display","none");
//                    $(".control_test_item").css("display","none");
//                    $("body").css("margin-top","0px");
//                    $('#test_block').fadeIn(0);
//                    $('#content_box').append(content);
//                    $("html, body").animate({ scrollTop: 0 }, 0);
//                }
//
//
//            },
//            error: function () {
//                console.log('error');
//            }
//        });
//    });

    $(document).on("change", ".new_type", function () {
        new_type_id = $(this).val();
        $(this).prop("disabled", true);
        $.ajax({
            type: "POST",
            url: "/creator/new_type_select",
            data: {
                select_item_id:new_type_id
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
                    $('#news_num').append(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);
                }

                if(request_result == 'new'){
                    $(".page_title").css("display","none");
                    $(".control_test_item").css("display","none");
                    $("body").css("margin-top","0px");
                    $('#test_block').fadeIn(0);
                    $('.select_row').html("");
                    $('.select_row').append(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);
                }

            },
            error: function () {
                console.log('error');
            }
        });

    });


    $(document).on("click", "#save_new_type", function () {
        var select_news_num_id = $("#news_num").val();
        var select_new_type_id = $(".new_type").val();


        var input_new_type = $("#input_new_type").val();
        var input_new_num = $("#input_new_num").val();
        var parent = $(this).attr('parent');

        $.ajax({
            type: "POST",
            url: "/creator/save_new_type_select",
            data: {
                select_news_num_id:select_news_num_id,
                select_new_type_id:select_new_type_id,
                input_new_type:input_new_type,
                input_new_num:input_new_num,
                parent:parent
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
                    $('#news_num').append(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);
                }

                if(request_result == 'not ok'){
                    $(".page_title").css("display","none");
                    $(".control_test_item").css("display","none");
                    $("body").css("margin-top","0px");
                    $('#test_block').fadeIn(0);
                    $('.select_row').append(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);
                }

            },
            error: function () {
                console.log('error');
            }
        });

    });

    $(document).on("change", "#news_num", function () {
        news_num_id = $(this).val();
        if(news_num_id=='new'){
            $("#news_num").remove();
            $('.select_row').append('<input type="text" id="input_new_num" placeholder="Наменклатура">');
        }
    });
    //  валидация вводимых данных, чтобы база норм записать в базу(DATETIME)
    $(function() {
        $("#form_work_start").mask("99.99.9999", {placeholder: "дд-мм-гггг" });
        $("#form_birthday").mask("99.99.9999", {placeholder: "дд-мм-гггг" });
    });

});


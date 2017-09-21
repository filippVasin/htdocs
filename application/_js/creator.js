/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {
    var  new_type_id = 0;
    var  news_num_id = 0;
    var dol_id = 0;


    $(document).on("change", ".target", function () {
        var select_item_id = $(this).val();
        $(".result_creater").remove();
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
                $(this).parent(".select_box_item").remove();
            }
            $('.dol').remove();
            if(remoter == ($(this).attr("level"))){
                $(this).prop('disabled', false);
            }
        });
        $('.button_clear').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).parent(".select_box_item").remove();
            }
        });
        $('.button_plus').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).parent(".select_box_item").remove();
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
                $(this).parent(".select_box_item").remove();
            }
            $('.dol').remove();
            if(remoter == ($(this).attr("level"))){
                $(this).prop('disabled', false);
            }
        });
        $('.button_clear').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).parent(".select_box_item").remove();
            }
        });
        $('.button_plus').each(function(){
            if(remoter <($(this).attr("level"))){
                $(this).parent(".select_box_item").remove();
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

        if((($("#news_num").val()!="")&&($(".new_type").val()!="")&&($(".new_type").length)&&($("#news_num").length))
            ||((($("#input_new_type").val()!="")&&($("#input_new_num").val()!="")&&($("#input_new_type").length)&&($("#input_new_num").length)))
            ||(($("#input_new_num").val()!="")&&($("#input_new_num").length)&&($(".new_type").length))) {
            var select_news_num_id = $("#news_num").val();
            var select_new_type_id = $(".new_type").val();


            var input_new_type = $("#input_new_type").val();
            var input_new_num = $("#input_new_num").val();
            var parent = $(this).attr('parent');

            $.ajax({
                type: "POST",
                url: "/creator/save_new_type_select",
                data: {
                    select_news_num_id: select_news_num_id,
                    select_new_type_id: select_new_type_id,
                    input_new_type: input_new_type,
                    input_new_num: input_new_num,
                    parent: parent
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var request_message = result.message;
                    var content = result.content;
                    // если 'ok' - рисуем тест
                    if (request_result == 'ok') {
                        $(".page_title").css("display", "none");
                        $(".control_test_item").css("display", "none");
                        $("body").css("margin-top", "0px");
                        $('#test_block').fadeIn(0);
                        $("#title_creator_popup").html(content);
                        $("#creator_popup").removeClass("none");

                        //$("html, body").animate({ scrollTop: 0 }, 0);
                    }

                    if (request_result == 'not ok') {
                        $(".page_title").css("display", "none");
                        $(".control_test_item").css("display", "none");
                        $("body").css("margin-top", "0px");
                        $('#test_block').fadeIn(0);
                        $("#title_creator_popup").html(content);
                        $("#creator_popup").removeClass("none");
                    }

                },
                error: function () {
                    console.log('error');
                }
            });
        } else {

            $("#input_new_type").css('border-color','#ff0000');
            $("#input_new_num").css('border-color','#ff0000');
            setTimeout("$('#input_new_type').css('border-color','#ccc')", 3000);
            setTimeout("$('#input_new_num').css('border-color','#ccc')", 3000);

            $("#news_num").css('border-color','#ff0000');
            $(".new_type").css('border-color','#ff0000');
            setTimeout("$('#news_num').css('border-color','#ccc')", 3000);
            setTimeout("$('.new_type').css('border-color','#ccc')", 3000);
        }
    });



    $(document).on("click", "#ok_creator_popup_input", function () {
        $("#creator_popup").addClass("none");
        $("#title_creator_popup").html("Здесь будет сообщение");
        $('#button_clear').click();
        $(".target").val("");
        location.reload();
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

    // проверяем отправку POST

    function check_time(){

        return false; // и этим false отменяем отправку формы
        //// проверяем пару полей
        //var ok = ( $('#form_work_start').val()> 0 && $('#form_birthday').val()< 0 ); // пусть ok хранит результат какой-то проверки
        //
        ////var val_r = val.split("-");
        ////var curDate = new Date(val_r[2], val_r[1], val_r[0]);
        //if (!ok) { // если поля не прошли проверку
        //
        //    // каким-то образом оповещаем об ошибках пользователя
        //    alert('Чето не то!'+$('#form_work_start').val() + $('#form_birthday').val() );
        //
        //    return false; // и этим false отменяем отправку формы
        //}

    }

    $(document).on('click',"#landing_form_offer_one", function () {
        var flag = 0;
        var surname = "";
        var name = "";
        var patronymic = "";
        var work_start = $("#form_work_start").val();
        var birthday = $("#form_birthday").val();
        var email = "";
        var id_item = $("#form_id_item").val();
        var personnel_number = "";
        personnel_number = $("#personnel_number").val();


        // получили сегодня
        var now = new Date()
        var today = new Date(now.getFullYear(), now.getMonth(), now.getDate()).valueOf();


        var hex_today = new Date(today);
        var hex_today_sto = new Date(today);
        if($("#form_birthday").val()==""){
            $("#form_birthday").css("border-color","red");
            setTimeout("$('#form_birthday').css('border-color','#ccc')", 3000);
        }
        if($("#form_work_start").val()==""){
            $("#form_work_start").css("border-color","red");
            setTimeout("$('#form_work_start').css('border-color','#ccc')", 3000);
        }


        // возраст не ниже 14ти лет
        hex_today.setFullYear(hex_today.getFullYear() - 14);
        // и не больше 100 лет
        hex_today_sto.setFullYear(hex_today_sto.getFullYear() - 100);
        if(Date.parse(birthday)>hex_today){
            $("#form_birthday").css("border-color","red");
            setTimeout("$('#form_birthday').css('border-color','#ccc')", 3000);
            flag = 1;
        }
        if(Date.parse(birthday)<hex_today_sto){
            $("#form_birthday").css("border-color","yellow");
            setTimeout("$('#form_birthday').css('border-color','#ccc')", 3000);
            flag = 1;
        }

        if($("#form_surname").val()==""){
            $("#form_surname").css("border-color","red");
            flag = 1;
        } else {
            surname = $("#form_surname").val();
        }

        if($("#form_name").val()==""){
            $("#form_name").css("border-color","red");
            flag = 1;
        } else {
            name = $("#form_name").val();
        }
        if($("#form_patronymic").val()==""){
            $("#form_patronymic").css("border-color","red");
            flag = 1;
        } else {
            patronymic = $("#form_patronymic").val();
        }
        // валидация почты
        if($("#form_email").val() != '') {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if(pattern.test($("#form_email").val())){
                $("#form_email").css({'border' : '1px solid #569b44'});
                email = $("#form_email").val();
            } else {
                $("#form_email").css({'border' : '1px solid #ff0000'});
                flag = 1;
            }
        } else {
            $("#form_email").css({'border' : '1px solid #ff0000'});
            flag = 1;
        }



        var hex_today_30 = new Date(today);
        var hex_today_40 = new Date(today);
        // дата трудоустройства не может быть вперёд больше чем на месяц
        hex_today_30.setDate(hex_today_30.getDate() + 30);
        // и не больше 100 лет
        hex_today_40.setFullYear(hex_today_40.getFullYear() - 40);
        if(Date.parse(work_start)>hex_today_30){
            $("#form_work_start").css("border-color","red");
            setTimeout("$('#form_work_start').css('border-color','#ccc')", 3000);
        }
        if(Date.parse(work_start)<hex_today_40){
            $("#form_work_start").css("border-color","yellow");
            setTimeout("$('#form_work_start').css('border-color','#ccc')", 3000);
        }
        if(flag == 0) {// всё норм
            $.ajax({
                type: "POST",
                url: "/creator/create_form",
                data: {
                    name: name,
                    surname:surname,
                    patronymic:patronymic,
                    work_start:work_start,
                    birthday:birthday,
                    email:email,
                    id_item:id_item,
                    personnel_number:personnel_number,
                    dol_id:dol_id

                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var content = result.content;
                    $("#test_block").after("<div class='result_creater'>"+content+"</div>");
                    $('#button_clear').trigger('click');
                },
                error: function () {
                    console.log('error');
                }
            });
        } else {
            setTimeout("$('.input_form').css('border-color','#ccc')", 3000);
        }

    });


    // Выбрать узел
    $(document).on("click", "#node_docs", function () {
        $("#popup_context_menu_update").css("display","block")
        var emp_id = "";
        var report_type = "org_str_tree";
        $.ajax({
            type: "POST",
            url: "/master_report/main",
            data: {
                emp_id:emp_id,
                report_type: report_type
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
                    $('#popup_update_tree').html(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);
                    $("#tree_main>ul").removeClass("none");
                    $(".tree_item_fio").addClass("none");
                    // присваеваем классы дня непустых элементов
                    $(".tree_item").each(function() {
                        var parent = $(this).parent("li");
                        if(parent.children('ul').length != 0){
                            $(this).addClass("open_item");
                        }
                    });
                    sort_stucture();
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });






    $(document).on('click','.open_item',function(){

        if($(this).hasClass("open_ul")){
            $(this).removeClass("open_ul");

            $(this).siblings('ul').addClass('none');
        } else {
            $(this).addClass("open_ul");

            $(this).siblings('ul').removeClass('none');
        }
    });

    //  если есть отомки тогда в конец списка
    function sort_stucture(){
        $("li").each(function() {
            var item =  $(this).children(".tree_item");
            var parent = $(this).closest("ul");
            var left = $(item).attr('left_key');
            var right = $(item).attr('right_key');
            if ((right - left)>1){
                $(this).detach().appendTo(parent);
            }
        });
    }


    //  если есть отомки тогда в конец списка
    function sort_stucture(){
        $("li").each(function() {
            var item =  $(this).children(".tree_item");
            var parent = $(this).closest("ul");
            var left = $(item).attr('left_key');
            var right = $(item).attr('right_key');
            if ((right - left)>1){
                $(this).detach().appendTo(parent);
            }
        });
    }

    //$(document).on('focusout','.input_form', function(){
    //    if($(this).val()==""){
    //        $(this).css("border-color","red");
    //        setTimeout("$('.input_form').css('border-color','#ccc')", 3000);
    //    }
    //});
    // отмена действия
    $(document).on("click", ".cancel_popup", function () {
        $("#popup_context_menu_update").css("display","none");
        $("#popup_update_tree").html("");
        $("#action_history_docs_popup").css("display","none");
        $("#emp_report_name").html("");
        $("#docs_report_name").html("");
        emp = "";
        step = "";
        manual = "";
        dir = "";
        name =  "";
        fio = "";
        dol =  "";
    });

    $(document).on('click','.tree_item',function() {
        if(!($(this).hasClass("open_item"))){
             dol_id = $(this).attr("id_item");
            var name_dol = $(this).html();
            $("#node_docs").html(name_dol);
            $(".cancel_popup").click();
        }
    });
});


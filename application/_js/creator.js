/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {
    var  new_type_id = 0;
    var  news_num_id = 0;
    var dol_id = 0;
    var email = "";

    if(get_session("control_company") == 29 ) {
        $("#email_box").remove();
    } else {
        $("#speed_button").remove();
    }

    tab_vs_enter();


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


    function check_time(){
        return false; // и этим false отменяем отправку формы
    }

    $(document).on('click',".landing_form_offer_one", function () {

        var flag = 0;
        var medical = $("#medical_organization").val();
        var surname = "";
        var name = "";
        var patronymic = "";
        var work_start = $("#form_work_start").val();
        var birthday = $("#form_birthday").val();

        var id_item = $("#form_id_item").val();
        var personnel_number = "";
        personnel_number = $("#personnel_number").val();

       var  reg_address = $("#reg_address").val();
       var  driver_categories = $("#driver_categories").val();
       var  driver_number = $("#driver_number").val();
       var  driver_start = $("#driver_start").val();
       var  driver_end = $("#driver_end").val();


        // получили сегодня
        var now = new Date()
        var today = new Date(now.getFullYear(), now.getMonth(), now.getDate()).valueOf();

        if(dol_id == 0){
            $("#node_docs").css("border-color","red");
            setTimeout("$('#node_docs').css('border-color','#ccc')", 3000);
            flag = 1;
        }

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
            flag = 2;
        }
        if(Date.parse(birthday)<hex_today_sto){
            $("#form_birthday").css("border-color","yellow");
            setTimeout("$('#form_birthday').css('border-color','#ccc')", 3000);
            flag = 3;
        }

        if($("#form_surname").val()==""){
            $("#form_surname").css("border-color","red");
            flag = 4;
        } else {
            surname = $("#form_surname").val();
        }

        if($("#form_name").val()==""){
            $("#form_name").css("border-color","red");
            flag = 5;
        } else {
            name = $("#form_name").val();
        }
        if($("#form_patronymic").val()==""){
            $("#form_patronymic").css("border-color","red");
            flag = 6;
        } else {
            patronymic = $("#form_patronymic").val();
        }

         if(get_session("control_company") != 29 ) {
             // валидация почты
             var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
             if (pattern.test($("#form_email").val())) {
                 $("#form_email").css({'border': '1px solid #569b44'});
                 email = $("#form_email").val();
             } else {
                 $("#form_email").css("border-color", "red");
                 setTimeout("$('#form_email').css('border-color','#ccc')", 3000);
                 flag = 7;
             }
         }




        var  ajax_url = "";
        // если водитель
        if(dol_id == 183){
            ajax_url = "/creator/create_drivers";
            var pattern =/^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/i;

            if(pattern.test($("#form_birthday").val())) {
                // всё норм
            } else {
                $("#form_birthday").css("border-color", "red");
                setTimeout("$('#form_birthday').css('border-color','#ccc')", 3000);
                flag = 8;
            }

        } else {
            ajax_url = "/creator/create_form";
            // маска для ввода даты
            var pattern =/^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/i;

                // проверяем дату трудоустройства
                var hex_today_30 = new Date(today);
                var hex_today_40 = new Date(today);
                // дата трудоустройства не может быть вперёд больше чем на месяц
                hex_today_30.setDate(hex_today_30.getDate() + 30);
                // и не больше 100 лет
                hex_today_40.setFullYear(hex_today_40.getFullYear() - 40);
                if (Date.parse(work_start) > hex_today_30) {
                    $("#form_work_start").css("border-color", "red");
                    setTimeout("$('#form_work_start').css('border-color','#ccc')", 3000);
                    flag = 9;
                }
                if (Date.parse(work_start) < hex_today_40) {
                    $("#form_work_start").css("border-color", "red");
                    setTimeout("$('#form_work_start').css('border-color','#ccc')", 3000);
                    flag = 10;
                }

                if(pattern.test($("#form_work_start").val())) {
                    // всё норм
                } else {
                    $("#form_work_start").css("border-color", "red");
                    setTimeout("$('#form_work_start').css('border-color','#ccc')", 3000);
                    flag = 11;
                }
                if(pattern.test($("#form_birthday").val())) {
                    // всё норм
                } else {
                    $("#form_birthday").css("border-color", "red");
                    setTimeout("$('#form_birthday').css('border-color','#ccc')", 3000);
                    flag = 12;
                }
        }

        $("#landing_form_offer_one").removeClass("landing_form_offer_one");
        setTimeout("$('#landing_form_offer_one').addClass('landing_form_offer_one')", 3000);
        //alert(flag);// выводим где ошибка
        if(flag == 0) {// всё норм

            $.ajax({
                type: "POST",
                url: ajax_url,
                data: {
                    name: name,
                    surname:surname,
                    patronymic:patronymic,
                    work_start:work_start,
                    birthday:birthday,
                    email:email,
                    id_item:id_item,
                    personnel_number:personnel_number,
                    dol_id:dol_id,
                    reg_address:reg_address,
                    driver_categories:driver_categories,
                    driver_number:driver_number,
                    driver_start:driver_start,
                    driver_end:driver_end,
                    medical:medical

                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var content = result.content;
                    var status = result.status;
                    var link = result.link;

                    //$("#test_block").after("<div class='result_creater'>"+content+"</div>");
                    message(content, status);

                    $("#landing_form_offer_one").addClass("landing_form_offer_one");
                    if(status == "ok"){
                        if(dol_id == 183) {
                            print_link(link);
                        }
                        $(".create_box input").val("");
                        $("#node_docs").html("");
                        dol_id = 0;
                    }
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
        $("#popup_context_menu_update").css("display","block");
        $('#popup_update_tree').html("");
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


    //  если есть отомки тогда в конец списка и удаляем дубли
    function sort_stucture(){
        $(".tree_item").each(function() {
           var unique_item = $(this).attr('id_item');
           var count = 0;
            $(".tree_item").each(function() {
                var regular_item = $(this).attr('id_item');
                var regular_obj = $(this);
                if(unique_item == regular_item){
                    if(count == 0){
                        ++count;
                    } else {
                        regular_obj.remove();
                    }

                }
            });
        });

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
            $(".new_input").remove();
             dol_id = $(this).attr("id_item");
            var name_dol = $(this).html();

            // обрезаем  длинные строки
            var limit_str_position = 39;
            if (name_dol.length > limit_str_position) {
                name_dol = name_dol.slice(0, limit_str_position);
                name_dol = name_dol + "...";
            }
            $("#node_docs").html(name_dol);
            $(".btn-default").click();
            $.ajax({
                type: "POST",
                url: "/creator/get_input",
                data: {
                    dol_id:dol_id
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var content = result.content;
                    var email = result.email;

                    if(request_result == 'ok'){
                        $('#form_id_item').before(content);
                        // проверка с какого устройтства вошли
                        if(isMobile.any()){
                            $("#driver_start").attr("type","date");
                            $("#driver_end").attr("type","date");
                        } else {
                            $('#driver_start').datepicker({
                                language: "ru",
                                autoclose: true
                            });
                            $('#driver_end').datepicker({
                                language: "ru",
                                autoclose: true
                            });
                        }
                        if(dol_id == 183){
                            $("#form_work_start").addClass("none");
                            $("#today_button").addClass("none");
                            $("#personnel_number_box").addClass("none");
                            $("#personnel_number").removeClass("tab_vs_enter")
                            $("#form_work_start").removeClass("tab_vs_enter");
                        } else {
                            if(email != "") {
                                $("#form_email").val(email);
                            }
                            $("#form_work_start").removeClass("none");
                            $("#today_button").removeClass("none");
                            $("#personnel_number_box").removeClass("none");
                            $("#personnel_number").addClass("tab_vs_enter")
                            $("#form_work_start").addClass("tab_vs_enter");
                        }
                        tab_vs_enter();
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    });

    // проверка с какого устройтства вошли
    if(isMobile.any()){
        $("#form_work_start").attr("type","date");
        $("#form_birthday").attr("type","date");
    } else {
        $(".valid_date").mask("99.99.9999");
    }
    // datapickers



    $(document).on('click','#speed_button',function(){
                dol_id = 183;
                $("#node_docs").html("Водитель автобуса на регулярные городск...");
                $(".new_input").remove();
                $(".btn-default").click();

                $("#speed_button").addClass("none");
                setTimeout("$('#speed_button').removeClass('none')", 5000);

                 $("#form_work_start").addClass("none");
                 $("#today_button").addClass("none");
                 $("#personnel_number_box").addClass("none")
                 $("#personnel_number").removeClass("tab_vs_enter")
                 $("#form_work_start").removeClass("tab_vs_enter");
                    tab_vs_enter();
    });


    $(document).on('click','#today_button',function(){
        var date = new Date();
        var options = {

            year: 'numeric',
            month: 'numeric',
            day: 'numeric'
        };
        $("#form_work_start").val(date.toLocaleString("ru", options));
    });


    // работаем ентером как табом
    function tab_vs_enter() {
        var $inputs = $("body").find('.tab_vs_enter');
        $inputs.each(function (i) {
            $(this).keypress(function (ev) {
                if (ev.which == 13 && i == $inputs.length - 1) {
                    $("#landing_form_offer_one").click();
                }
                if (ev.which == 13) {
                    $inputs.eq(i + 1).focus();
                    return false;
                }
            });
        });
    }

});


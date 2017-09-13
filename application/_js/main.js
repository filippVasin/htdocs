$(document).ready(function() {

    start();
    $(document).on('click','#test_circle',function(){
        if($("#test_circle").hasClass("open_dept")){
            $("#test_circle").removeClass("open_dept");

            $("#test_report .node_report").addClass('none');
            $('#test_report .node_report>.progress-group').addClass('none');
        } else {
            $("#test_circle").addClass("open_dept");

            $("#test_report .node_report").removeClass('none');
            $('#test_report .node_report>.progress-group').removeClass('none');
        }
    });

    $(document).on('click','#emp_circle',function(){
        if($("#emp_circle").hasClass("open_depe")){
            $("#emp_circle").removeClass("open_depe");

            $("#emp_report .node_report").addClass('none');
            $('#emp_report .node_report>.progress-group').addClass('none');
        } else {
            $("#emp_circle").addClass("open_depe");

            $("#emp_report .node_report").removeClass('none');
            $('#emp_report .node_report>.progress-group').removeClass('none');
        }
    });


    $(document).on('click','#doc_circle',function(){
        if($("#doc_circle").hasClass("open_depd")){
            $("#doc_circle").removeClass("open_depd");

            $("#doc_report .node_report").addClass('none');
            $('#doc_report .node_report>.progress-group').addClass('none');
        } else {
            $("#doc_circle").addClass("open_depd");

            $("#doc_report .node_report").removeClass('none');
            $('#doc_report .node_report>.progress-group').removeClass('none');
        }
    });




    $(document).on('click','#look_dep',function(){
        $(".node_report").removeClass('none');
        $("#look_dep").addClass('none');
        $("#close_dep").removeClass('none');
        $('.node_report>.progress-group').removeClass('none');
    });

    $(document).on('click','#look_dep_all',function(){
        $(".node_report").removeClass('none');
        $('.progress-group').removeClass('none');
        $('.node_report>.progress-group').addClass("look_on");
        $('.node_report>.progress-group').removeClass("look_off");
        $("#look_dep_all").addClass('none');
        $("#close_dep").removeClass('none');
        $("#look_dep").addClass('none');
    });

    $(document).on('click','#close_dep',function(){
        $('.progress-group').addClass('none');
        $(".node_report").addClass('none');
        $("#look_dep").removeClass('none');
        $("#close_dep").addClass('none');
        $("#look_dep_all").removeClass('none');
        $('.node_report>.progress-group').addClass("look_off");
        $('.node_report>.progress-group').removeClass("look_on");

    });


    // логика дашборда по отделам
    // расскрываем отдел
    $(document).on('click','.look_off',function() {
        $(this).addClass("look_on");
        $(this).removeClass("look_off");
        var parent = $(this).closest(".parent");

        $(parent).children('.progress-group').removeClass('none');
    });
    // сворачеваем отдел
    $(document).on('click','.look_on',function() {
        $(this).addClass("look_off");
        $(this).removeClass("look_on");

        var parent = $(this).closest(".parent");
        $(parent).children('.progress-group').addClass('none');
    });


    // выбор подразделения

    $(document).on("click", "#select_node", function () {
        $("#popup_context_menu_update").removeClass("none");
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

                    $("body").css("margin-top","0px");
                    $('#test_block').fadeIn(0);
                    $('#popup_update_tree').html(content);
                    $(".tree_item").addClass("none");
                    $(".tree_item_fio").addClass("none");
                    $("html, body").animate({ scrollTop: 0 }, 0);
                    $("#tree_main>ul").removeClass("none");
                    // присваеваем классы дня непустых элементов
                    $(".tree_item").each(function() {
                        var parent = $(this).parent("li");
                        if(parent.children('ul').length != 0){
                            $(this).addClass("open_item");
                        }
                    });
                    $(".open_item").closest("ul").removeClass("none");
                    $(".open_item").removeClass("none");

                }
            },
            error: function () {
                console.log('error');
            }
        });
    });



    $(document).on("click", "#cancel_popup", function () {
        $("#popup_context_menu_update").addClass("none");
    });

    $(document).on("click", ".tree_item", function () {
        $("#popup_context_menu_update").addClass("none");

        $("#nods_key").attr('left',$(this).attr('left_key'));
        $("#nods_key").attr('right',$(this).attr('right_key'));
        start();
    });

    $(document).on("click", "#all_node_popup", function () {
        $("#popup_context_menu_update").addClass("none");

        $("#nods_key").attr('left',"");
        $("#nods_key").attr('right',"");
        start();
    });



    function start() {
        var node_left_key = $("#nods_key").attr('left');
        var node_right_key = $("#nods_key").attr('right');
        $.ajax({
            type: "POST",
            url: "/main/start",
            data: {
                node_left_key:node_left_key,
                node_right_key:node_right_key
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;

                if(request_result == 'ok'){
                    $("#load_dashboard").html(content);
                    create_node_structure();
                }// if
                if(request_result == 'not company'){
                    window.location = "/company_control";
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    }

    function create_node_structure(){
        // создание дашборда по отделам
        // тестированние
        $("#test_node_report .progress-group").each(function() {
            var parent_level = 0;
            var parent_left = 0;
            var parent_right = 0;
            var count_child = 0;
            var parent = $(this);
            var fact = 0;
            var  target = 0;
            fact = Number(parent.attr('fact'));
            target = Number(parent.attr('target'));
            parent_level = $(this).attr('level');
            parent_left = $(this).attr('left_key');
            parent_right = $(this).attr('right_key');
            $('#test_node_report .progress-group').each(function() {
                child_left = 0;
                child_right = 0;
                child_left = $(this).attr('left_key');
                child_right = $(this).attr('right_key');
                if ((parent_left < child_left)&&(parent_right > child_right)){
                    $(this).addClass('none');
                    $(this).detach().appendTo(parent);
                    fact += Number($(this).attr('fact'));
                    target += Number($(this).attr('target'));
                    ++count_child;
                }
                //$(this).append("<br> " + parent_left + "<"+ child_left+" : " + parent_right + ">" + child_right);
            });
            // выводим суммарную цыфру по отделам
            $('.progress-text-row>.progress-number:first',this).html("<b>"+ fact +"</b>/" + target);
            var width_proc = (Math.round(fact/target*100)) + "%";
            $('.progress-bar:first',this).css("width",width_proc);

            if(count_child>0){
                $(this).addClass("parent");
                $('.progress-text',this).addClass("look_off");
            } else {
                $(this).addClass("last");
            }
        });
        // cтавим администрацию на первое место
        $("#test_node_report .progress-group").each(function() {
            var level = $(this).attr('level');
            var left = $(this).attr('left_key');
            if ((level ==  1)&&(left>002)){
                $(this).detach().appendTo("#test_node_report");
            }
        });

        // у кого нет потомков идите в конце
        $("#test_node_report .progress-group").each(function() {
            var level = $(this).attr('level');
            var left = $(this).attr('left_key');
            if ((level ==  1)&&(!($(this).hasClass("parent")))){
                $(this).detach().appendTo("#test_node_report");
            }
        });

        // сотрудники
        $("#emp_node_report .progress-group").each(function() {
            var parent_level = 0;
            var parent_left = 0;
            var parent_right = 0;
            var count_child = 0;
            var parent = $(this);
            var fact = 0;
            var  target = 0;
            fact = Number(parent.attr('fact'));
            target = Number(parent.attr('target'));
            parent_level = $(this).attr('level');
            parent_left = $(this).attr('left_key');
            parent_right = $(this).attr('right_key');
            $('#emp_node_report .progress-group').each(function() {
                child_left = 0;
                child_right = 0;
                child_left = $(this).attr('left_key');
                child_right = $(this).attr('right_key');
                if ((parent_left < child_left)&&(parent_right > child_right)){
                    $(this).addClass('none');
                    $(this).detach().appendTo(parent);
                    fact += Number($(this).attr('fact'));
                    target += Number($(this).attr('target'));
                    ++count_child;
                }
                //$(this).append("<br> " + parent_left + "<"+ child_left+" : " + parent_right + ">" + child_right);
            });
            // выводим суммарную цыфру по отделам
            $('.progress-text-row>.progress-number:first',this).html("<b>"+ fact +"</b>/" + target);
            var width_proc = (Math.round(fact/target*100)) + "%";
            $('.progress-bar:first',this).css("width",width_proc);

            if(count_child>0){
                $(this).addClass("parent");
                $('.progress-text',this).addClass("look_off");
            } else {
                $(this).addClass("last");
            }
        });

        $("#emp_node_report .progress-group").each(function() {
            var level = $(this).attr('level');
            var left = $(this).attr('left_key');
            if ((level ==  1)&&(left>002)){
                $(this).detach().appendTo("#emp_node_report");
            }
        });
        // у кого нет потомков идите в конце
        $("#emp_node_report .progress-group").each(function() {
            var level = $(this).attr('level');
            var left = $(this).attr('left_key');
            if ((level ==  1)&&(!($(this).hasClass("parent")))){
                $(this).detach().appendTo("#emp_node_report");
            }
        });


        // сотрудники
        $("#doc_node_report .progress-group").each(function() {
            var parent_level = 0;
            var parent_left = 0;
            var parent_right = 0;
            var count_child = 0;
            var parent = $(this);
            var fact = 0;
            var  target = 0;
            fact = Number(parent.attr('fact'));
            target = Number(parent.attr('target'));
            parent_level = $(this).attr('level');
            parent_left = $(this).attr('left_key');
            parent_right = $(this).attr('right_key');
            $('#doc_node_report .progress-group').each(function() {
                child_left = 0;
                child_right = 0;
                child_left = $(this).attr('left_key');
                child_right = $(this).attr('right_key');
                if ((parent_left < child_left)&&(parent_right > child_right)){
                    $(this).addClass('none');
                    $(this).detach().appendTo(parent);
                    fact += Number($(this).attr('fact'));
                    target += Number($(this).attr('target'));
                    ++count_child;
                }
                //$(this).append("<br> " + parent_left + "<"+ child_left+" : " + parent_right + ">" + child_right);
            });
            // выводим суммарную цыфру по отделам
            $('.progress-text-row>.progress-number:first',this).html("<b>"+ fact +"</b>/" + target);
            var width_proc = (Math.round(fact/target*100)) + "%";
            $('.progress-bar:first',this).css("width",width_proc);

            if(count_child>0){
                $(this).addClass("parent");
                $('.progress-text',this).addClass("look_off");
            } else {
                $(this).addClass("last");
            }
        });

        $("#doc_node_report .progress-group").each(function() {
            var level = $(this).attr('level');
            var left = $(this).attr('left_key');
            if ((level ==  1)&&(left>002)){
                $(this).detach().appendTo("#doc_node_report");
            }
        });
        // у кого нет потомков идите в конце
        $("#doc_node_report .progress-group").each(function() {
            var level = $(this).attr('level');
            var left = $(this).attr('left_key');
            if ((level ==  1)&&(!($(this).hasClass("parent")))){
                $(this).detach().appendTo("#doc_node_report");
            }
        });

    }


    // открываем и закрываем сотрудников
    $(document).on('click','.icon',function(){
        var parent = $(this).closest(".people");
        if($(this).hasClass("open_people")){
             $(".fio_box",parent).addClass("none");
            $(this).removeClass("open_people");
        } else {
            $(".fio_box",parent).removeClass("none");
            $(this).addClass("open_people");
        }
    });

    // показать/скрываем отчёт по сотруднику
    $(document).on('click','.people_report',function(){
        var report_type = $(this).attr('report_type');
        var emp_id = $(this).attr('emp_id');

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
                var content = result.content;
                if (request_result == "ok") {
                    $("#popup_report_emp_content").html(content);
                    $("#popup_report_emp").removeClass("none");
                }
            }
        });

    });

    $(document).on('click','#ok_popup_report_emp',function(){
        $("#popup_report_emp").addClass("none");
    });


});
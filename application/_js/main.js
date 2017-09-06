$(document).ready(function() {

    start();

    //$(document).on('click','.c100',function(){
    //    if($(".c100").hasClass("open_dep")){
    //        $("#close_dep").click();
    //        $(".c100").removeClass("open_dep");
    //    } else {
    //        $("#look_dep").click();
    //        $(".c100").addClass("open_dep");
    //    }
    //});

    $(document).on('click','#test_circle',function(){
        if($("#test_circle").hasClass("open_dep")){
            $("#test_circle").removeClass("open_dep");

            $("#test_report .node_report").addClass('none');
            $('#test_report .node_report>.progress-group').addClass('none');
        } else {
            $("#test_circle").addClass("open_dep");

            $("#test_report .node_report").removeClass('none');
            $('#test_report .node_report>.progress-group').removeClass('none');
        }
    });

    $(document).on('click','#emp_circle',function(){
        if($("#emp_circle").hasClass("open_dep")){
            $("#emp_circle").removeClass("open_dep");

            $("#emp_report .node_report").addClass('none');
            $('#emp_report .node_report>.progress-group').addClass('none');
        } else {
            $("#emp_circle").addClass("open_dep");

            $("#emp_report .node_report").removeClass('none');
            $('#emp_report .node_report>.progress-group').removeClass('none');
        }
    });


    $(document).on('click','#doc_circle',function(){
        if($("#test_circle").hasClass("open_dep")){
            $("#doc_circle").removeClass("open_dep");

            $("#doc_report .node_report").addClass('none');
            $('#doc_report .node_report>.progress-group').addClass('none');
        } else {
            $("#doc_circle").addClass("open_dep");

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
        $(this).children('.progress-group').removeClass('none');
    });
    // сворачеваем отдел
    $(document).on('click','.look_on',function() {
        $(this).addClass("look_off");
        $(this).removeClass("look_on");
        $(this).children('.progress-group').addClass('none');
    });


    // выбор подразделения

    $(document).on("click", "#select_node", function () {
        $("#popup_context_menu_update").removeClass("none");
        $.ajax({
            type: "POST",
            url: "/docs_report/load_node_docs_tree",
            data: {
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $("#popup_update_tree").html(content);
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });



    $(document).on("click", "#cancel_popup", function () {
        $("#popup_context_menu_update").addClass("none");
    });

    $(document).on("click", ".new_parent", function () {
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
                $(this).addClass("look_off");
            } else {
                $(this).addClass("last");
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
                $(this).addClass("look_off");
            } else {
                $(this).addClass("last");
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
                $(this).addClass("look_off");
            } else {
                $(this).addClass("last");
            }
        });

    }

});
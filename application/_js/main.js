$(document).ready(function() {

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

        if(count_child>0){
            $(this).addClass("parent");
            $(this).addClass("look_off");
        } else {
            $(this).addClass("last");
        }
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
});
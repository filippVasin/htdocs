$(document).ready(function() {
    $(document).on('click','#look_dep',function(){
        $("#test_report .node_report").removeClass('none');
        $("#emp_report .node_report").removeClass('none');
        $("#doc_report .node_report").removeClass('none');
        $("#look_dep").addClass('none');
        $("#close_dep").removeClass('none');
    });

    $(document).on('click','#look_dep_all',function(){
        $("#test_report .node_report").removeClass('none');
        $("#emp_report .node_report").removeClass('none');
        $("#doc_report .node_report").removeClass('none');
        $('.two_level').css("display","block");
        $(".one_level").addClass("look_on");
        $(".one_level").removeClass("look_off");
        $("#look_dep_all").addClass('none');
        $("#close_dep").removeClass('none');
        $("#look_dep").addClass('none');
    });

    $(document).on('click','#close_dep',function(){
        $('.two_level').css("display","none");
        $("#test_report .node_report").addClass('none');
        $("#emp_report .node_report").addClass('none');
        $("#doc_report .node_report").addClass('none');
        $("#look_dep").removeClass('none');
        $("#close_dep").addClass('none');
        $("#look_dep_all").removeClass('none');
        $(".one_level").addClass("look_off");
        $(".one_level").removeClass("look_on");

    });



    $("#test_node_report .progress-group").each(function() {
        if($(this).attr('level') == 1) {
            $(this).addClass("one_level");
        }
    });

    $("#test_node_report .progress-group").each(function() {
        if($(this).attr('level') == 2) {
            $(this).addClass("two_level");
            $(this).css("display", "none");
            $(this).addClass("last");
        }
    });
    //emp_node_report
    $("#emp_node_report .progress-group").each(function() {
        if($(this).attr('level') == 1) {
            $(this).addClass("one_level");
        }
    });

    $("#emp_node_report .progress-group").each(function() {
        if($(this).attr('level') == 2) {
            $(this).addClass("two_level");
            $(this).css("display", "none");
            $(this).addClass("last");
        }
    });

    //doc_node_report
    $("#doc_node_report .progress-group").each(function() {
        if($(this).attr('level') == 1) {
            $(this).addClass("one_level");
        }
    });

    $("#doc_node_report .progress-group").each(function() {
        if($(this).attr('level') == 2) {
            $(this).addClass("two_level");
            $(this).css("display", "none");
            $(this).addClass("last");
        }
    });
    $("#test_node_report .one_level").each(function() {
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
        $('#test_node_report .two_level').each(function() {
            child_left = 0;
            child_right = 0;
            child_left = $(this).attr('left_key');
            child_right = $(this).attr('right_key');
                if ((parent_left < child_left)&&(parent_right > child_right)){
                    $(this).detach().appendTo(parent);
                    fact += Number($(this).attr('fact'));
                    target += Number($(this).attr('target'));
                    ++count_child;
                }
            //$(this).append("<br> " + parent_left + "<"+ child_left+" : " + parent_right + ">" + child_right);
        });

        // собрали со всех общее значение и поставили
        $('.progress-text-row>.progress-number:first',this).html("<b>"+ fact +"</b>/" + target);

        if(count_child>0){
            $(this).addClass("parent");
            $(this).addClass("look_off");
        } else {
            $(this).addClass("last");
        }
    });

    $("#emp_node_report .one_level").each(function() {
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
        $('#emp_node_report .two_level').each(function() {
            child_left = 0;
            child_right = 0;
            child_left = $(this).attr('left_key');
            child_right = $(this).attr('right_key');
            if ((parent_left < child_left)&&(parent_right > child_right)){
                $(this).detach().appendTo(parent);
                fact += Number($(this).attr('fact'));
                target += Number($(this).attr('target'));
                ++count_child;
            }
            //$(this).append("<br> " + parent_left + "<"+ child_left+" : " + parent_right + ">" + child_right);
        });

        // собрали со всех общее значение и поставили
        $('.progress-text-row>.progress-number:first',this).html("<b>"+ fact +"</b>/" + target);

        if(count_child>0){
            $(this).addClass("parent");
            $(this).addClass("look_off");
        } else {
            $(this).addClass("last");
        }
    });

    $("#doc_node_report .one_level").each(function() {
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
        $('#doc_node_report .two_level').each(function() {
            child_left = 0;
            child_right = 0;
            child_left = $(this).attr('left_key');
            child_right = $(this).attr('right_key');
            if ((parent_left < child_left)&&(parent_right > child_right)){
                $(this).detach().appendTo(parent);
                fact += Number($(this).attr('fact'));
                target += Number($(this).attr('target'));
                ++count_child;
            }
            //$(this).append("<br> " + parent_left + "<"+ child_left+" : " + parent_right + ">" + child_right);
        });

        // собрали со всех общее значение и поставили
        $('.progress-text-row>.progress-number:first',this).html("<b>"+ fact +"</b>/" + target);

        if(count_child>0){
            $(this).addClass("parent");
            $(this).addClass("look_off");
        } else {
            $(this).addClass("last");
        }
    });

    //// расскрываем отдел
    $(document).on('click','.look_off',function() {
        $(this).addClass("look_on");
        $(this).removeClass("look_off");
        $(this).children('.progress-group').css("display","block");
    });
    // сворачеваем отдул
    $(document).on('click','.look_on',function() {
        $(this).addClass("look_off");
        $(this).removeClass("look_on");
        $(this).children('.progress-group').css("display","none");
    });






});
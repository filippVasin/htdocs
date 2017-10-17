/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {
    var id_node_plus = 0;


    // всё дерево
    $(document).on("click", "#whole_tree", function () {
        var sel = document.getElementById("tree"); // Получаем наш список
        var item_id = sel.options[sel.selectedIndex].value;
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
                var role = result.role;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $(".page_title").css("display","none");
                    $(".control_test_item").css("display","none");
                    $("body").css("margin-top","0px");
                    $('#test_block').fadeIn(0);
                    $('#content_box').html(content);
                    $("html, body").animate({ scrollTop: 0 }, 0);
                    $("#tree_main>ul").removeClass("none");
                    // присваеваем классы дня непустых элементов
                    $(".tree_item").each(function() {
                        var parent = $(this).parent("li");
                        if(parent.children('ul').length != 0){
                            $(this).addClass("open_item");
                        }
                    });
                    sort_stucture();
                    add_node_button(role);
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });


    // всё дерево
    $(document).on("click", "#tree_up", function () {
        var sel = document.getElementById("tree"); // Получаем наш список
        var item_id = sel.options[sel.selectedIndex].value;
        var left = 0;
        var right =0;

        // нашли ключи нужного элемента
        $(".tree_item").each(function() {
            if(item_id == $(this).attr('id_item')) {
                left = $(this).attr('left_key');
                right = $(this).attr('right_key');
            }
        });
        $(".tree_item").each(function(){
            var parent = $(this).closest("li");
            $(parent).addClass("none");
            if( (left >= $(this).attr('left_key')) && ($(this).attr('right_key') >= right)){
                $(parent).removeClass("none");
            }
        });

    });


    $(document).on("click", "#tree_down", function () {
        var sel = document.getElementById("tree"); // Получаем наш список
        var item_id = sel.options[sel.selectedIndex].value;
        var left = 0;
        var right = 0;
        var parent = "";

        // нашли ключи нужного элемента
        $(".tree_item").each(function() {
            if(item_id == $(this).attr('id_item')) {
                parent = $(this).closest("li");
            }
        });

        $(parent).detach().appendTo("#tree_main");
        $("#tree_main").children('ul').addClass("none");

    });




    // всё дерево
    $(document).on("click", "#whole_branch", function () {
        var sel = document.getElementById("tree"); // Получаем наш список
        var item_id = sel.options[sel.selectedIndex].value;
        var left = 0;
        var right =0;

        // нашли ключи нужного элемента
        $(".tree_item").each(function() {
            if(item_id == $(this).attr('id_item')) {
                left = $(this).attr('left_key');
                right = $(this).attr('right_key');
            }
        });
        $(".tree_item").each(function(){
            var parent = $(this).closest("li");
            $(parent).addClass("none");
            if( (left >= $(this).attr('left_key')) && ($(this).attr('right_key') >= right) || (left <= $(this).attr('left_key')) && ($(this).attr('right_key') <= right)){
                $(parent).removeClass("none");
            }
        });


    });


    $(document).on('click','.title_item',function(){
        var parent  = $(this).closest(".open_item");
        if($(parent).hasClass("open_ul")){
            $(parent).removeClass("open_ul");

            $(parent).siblings('ul').addClass('none');
        } else {
            $(parent).addClass("open_ul");

            $(parent).siblings('ul').removeClass('none');
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
    $("#whole_tree").click();


    function add_node_button(role) {
        $(".tree_item").each(function () {
            var plus_button = '';
            if(role == 1){
                plus_button = '<i class="plus_item_button fa fa-plus"></i>';
            } else {
                plus_button = '<i class="plus_item_button none fa fa-plus"></i>';
            }

            if ($(this).hasClass("pluses")) {
                var title_item = '<div class="title_item"> ' + $(this).html() + ' </div>' + plus_button;
                $(this).html(title_item);
            }
        });

    }


    $(document).on('click','.plus_item_button',function(){
        $("#plus_dol").addClass("none");
        $("#plus_node").addClass("none");
        $("#plus_node_kladr").addClass("none");
        $('#select_dol_item').val(0);
        $('#select_node_item').val(0);
        $('#select_type_pluse').val(0);
        $("#select_kladr_item").val(0);
        var parent  = $(this).closest(".tree_item ");
        id_node_plus = parent.attr("id_item");
        $("#add_department_form_button").click();
    });



    $(document).on( 'change',"#select_type_pluse", function () {
        var type = $(this).val();
        if(type == 1){
            $("#plus_dol").removeClass("none");
            $("#plus_node_kladr").addClass("none");
            $("#plus_node").addClass("none");
            select_dol_list();
        }
        if(type == 2) {
            $("#plus_node").removeClass("none");
            $("#plus_dol").addClass("none");
            select_node_list();
        }
    });

    $(document).on( 'change',"#select_node_item", function () {
            $("#plus_node_kladr").removeClass("none");
            select_kladr_list()

    });




    function select_dol_list() {
        $.ajax({
            type: "POST",
            url: "/structure/select_dol_list",
            data: {
                parent_id:id_node_plus
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;

                if(request_result == 'ok'){
                    $("#select_dol_item").html(content);
                }

            },
            error: function () {
            }
        });
    }
    function select_node_list() {
        $.ajax({
            type: "POST",
            url: "/structure/select_node_list",
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;

                if(request_result == 'ok'){
                    $("#select_node_item").html(content);
                }
            },
            error: function () {
            }
        });
    }

    function select_kladr_list(){
        var kladr_type_id = $("#select_node_item").val();
        $.ajax({
            type: "POST",
            url: "/structure/select_kladr_list",
            data: {
                parent_id:id_node_plus,
                kladr_type_id:kladr_type_id
             },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;

                if(request_result == 'ok'){
                    $("#select_kladr_item").html(content);
                }
            },
            error: function () {
            }
        });
    }



    $(document).on('click','#add_new_item',function(){
        var flag = 1;
        var type_plus = 0;
        var select_dol = 0;
        var select_node = 0;
        var kladr_id = 0;

        var parent_id = id_node_plus;
        type_plus = $('#select_type_pluse').val();
        select_dol = $('#select_dol_item').val();
        select_node = $('#select_node_item').val();
        kladr_id = $('#select_kladr_item').val();

        if(type_plus == 0){
            $("#select_type_pluse").css("border-color","red");
            setTimeout("$('#select_type_pluse').css('border-color','#ccc')", 3000);
            flag = 0;
        }
        if((type_plus == 1) && (select_dol == 0)){
            $("#select_dol_item").css("border-color","red");
            setTimeout("$('#select_dol_item').css('border-color','#ccc')", 3000);
            flag = 0;
        }
        if((type_plus == 2) && (select_node == 0)){
            $("#select_node_item").css("border-color","red");
            setTimeout("$('#select_node_item').css('border-color','#ccc')", 3000);
            flag = 0;
        }
        if((type_plus == 2) && (kladr_id == 0)){
            $("#select_node_item").css("border-color","red");
            setTimeout("$('#select_node_item').css('border-color','#ccc')", 3000);
            flag = 0;
        }

        if(flag == 1){
            $.ajax({
                type: "POST",
                url: "/structure/add_item",
                data: {
                    type_plus:type_plus,
                    select_dol:select_dol,
                    select_node:select_node,
                    kladr_id:kladr_id,
                    parent_id:parent_id
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var content = result.content;
                    var type_plus = result.type_plus;
                    var level = result.level;
                    var parent = result.parent;
                    var id_item = result.id_item;
                    var left_key = result.left_key;
                    var right_key = result.right_key;
                    var item_name = result.item_name;

                    if(request_result == "ok") {
                        $("#cancel_add_new_item").click();
                        var html = "";
                        if(type_plus == 1){
                            html = '<li> <div class="tree_item " level="'+ level +'" parent="'+ parent +'" id_item="'+ id_item +'" left_key="'+ left_key +'" right_key="'+ right_key +'">'+ item_name+'</div> </li>';
                        }
                        if(type_plus == 2){
                            html =      '<li>'
                                     +       '<div class="tree_item pluses open_item" level="'+ level +'" parent="'+ parent +'" id_item="'+ id_item +'" left_key="'+ left_key +'" right_key="'+ right_key +'">'
                                     +           '<div class="title_item">'+ item_name+'</div>'
                                     +           '<i class="plus_item_button fa fa-plus"></i>'
                                     +           '</div>'
                                     +       '<ul class="none"></ul>';
                                     +  '</li>';
                        }

                        $(".tree_item").each(function() {
                            if($(this).attr("id_item") == parent){
                                $(this).siblings('ul').append(html);
                            }
                        });

                    }
                    message(content, request_result);
                },
                error: function () {
                }
            });
        } else {
            message("Введите нужные данные", "error");
        }
    });


});
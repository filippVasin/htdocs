/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {

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

});
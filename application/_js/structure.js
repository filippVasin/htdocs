/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {

    // всё дерево
    $(document).on("click", "#whole_tree", function () {
        var sel = document.getElementById("tree"); // Получаем наш список
        var item_id = sel.options[sel.selectedIndex].value;


        $.ajax({
            type: "POST",
            url: "/structure/whole_tree",
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
                }


            },
            error: function () {
                console.log('error');
            }
        });
    });


    // всё дерево
    $(document).on("click", "#tree_down", function () {
        var sel = document.getElementById("tree"); // Получаем наш список
        var item_id = sel.options[sel.selectedIndex].value;



        $.ajax({
            type: "POST",
            url: "/structure/tree_down",
            data: {
                item_id:item_id
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



        $.ajax({
            type: "POST",
            url: "/structure/tree_up",
            data: {
                item_id:item_id
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
                }


            },
            error: function () {
                console.log('error');
            }
        });
    });



    // всё дерево
    $(document).on("click", "#whole_branch", function () {
        var sel = document.getElementById("tree"); // Получаем наш список
        var item_id = sel.options[sel.selectedIndex].value;

        $.ajax({
            type: "POST",
            url: "/structure/whole_branch",
            data: {
                item_id:item_id
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
                }


            },
            error: function () {
                console.log('error');
            }
        });
    });


});
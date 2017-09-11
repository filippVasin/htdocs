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
            url: "/structure/whole_tree_new",
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


    $(document).on('click','.open_item',function(){

        if($(this).hasClass("open_ul")){
            $(this).removeClass("open_ul");

            $(this).siblings('ul').addClass('none');
        } else {
            $(this).addClass("open_ul");

            $(this).siblings('ul').removeClass('none');
        }
    });




});
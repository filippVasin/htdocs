/**
 * Created by root on 01.03.2017.
 */
function message(text, type){
    var icon = '';
    var message_text = $(".message_text");

    switch(type){
        case 'info':
            var message_div = $('#message_info').removeClass("none");;
            break;
        case 'error':
            var message_div = $('#message_error').removeClass("none");;
            break;
        case 'ok':
            var message_div = $('#message_ok').removeClass("none");;
            break;
        default:
            var message_div = $('#message_default').removeClass("none");;
    }

    message_div.removeClass("none");
    setTimeout(function(){


        message_text.html(text);

        message_div.fadeIn(200);

        window.show_message = setTimeout(function(){
            message_div.fadeOut(200);
            message_div.addClass("none");
        }, 5000);

    }, 200);
}

// открыть прияный файл в отдельном окне и вызвать форму печати
function print_link(link){
    var click_link = $('<a id="click_link" style="color: #fff" class="button" href="' + link + '" target="_blank">Стартовый бланк</a>');
    $("body").append(click_link);
    document.getElementById("click_link").click();
    $("#click_link").remove();
}



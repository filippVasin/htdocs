$(document).ready(function() {



    $.ajax({
        type: "POST",
        url: "/forms/start",
        data: {
        },
        success: function (answer) {
            var logern = "creater";
            var result = jQuery.parseJSON(answer);
            var request_result = result.status;
            var request_message = result.message;
            var content = result.content;

            var page = result.page;
            var form_actoin = result.form_actoin;



            if(page !=""){

                if(form_actoin == "print" ){
                    $('body').html(page);
                    $('body').css("display","none");
                    setTimeout(print_zz, 50);
                }
                if(form_actoin == "download" ){
                    $('body').html(page);
                    var form_link = result.form_link;
                    // создаём ссылку на докумнт и вызываем её
                    var link = document.createElement('a');
                    link.setAttribute('href',form_link);
                    link.setAttribute('download','download');
                    onload=link.click();
                    $('#popup_update_select_position').css("display","block");
                }
                if(form_actoin == "open"){
                    $('body').html(page);
                }
                if(form_actoin == "signature"){
                    $('body').html(page);
                    $('#popup_update_select_position').css("display","block");
                }
                if(form_actoin == "user_pass_form_end"){
                    window.location = "/rover";
                }
                if(form_actoin == "save" ){
                    location.reload();
                }
                if(form_actoin == "email_alert" ){
                    location.reload();
                }
                if(form_actoin == "local_alert" ){
                    location.reload();
                }
                if (form_actoin == "creater"){
                    location.reload();
                }
                if(form_actoin == "secretary_accept_alert"){
                    window.location = "/rover";
                }


            }





            message(request_message, request_result);
        },
        error: function () {
        }
    });


    function print_zz(){
        $('body').css("display","block");
        print();
        $('#popup_update_select_position').css("display","block");

    }


    $(document).on("click", "#popup_update_select_node_yes", function () {
        $.ajax({
            type: "POST",
            url: "/forms/yes",
            data: {
            },
            success: function (answer) {
                        location.reload();
            },
            error: function () {
            }
        });// ajax
    });

    $(document).on("click", "#yes_i_read", function () {
        $.ajax({
            type: "POST",
            url: "/forms/yes",
            data: {
            },
            success: function (answer) {
                location.reload();
            },
            error: function () {
            }
        });// ajax
    });

    $(document).on("click", "#popup_update_select_position_cancel", function () {
        location.reload();
    });


});


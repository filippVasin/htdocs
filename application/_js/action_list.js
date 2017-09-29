$(document).ready(function() {

    var action_name = "";
    var trigger ="";

    // отмена действия
    $(document).on("click", "#cancel_popupos", function () {
        $("#popup_action_list").removeClass("block");
        action_name = "";
        trigger ="";
    });
    //
    //// показать окно
    //$(document).on("click", "#add_action", function () {
    //    $("#popup_action_list").addClass("block");
    //
    //});
    //



    // запрос по истории документа
    $(document).on("click", ".row_data", function () {
        $("#popup_action_list_button").click();
        action_name =  $(this).attr("action_name");
        trigger =  $(this).attr("trigger");
        $("#actoin_name").val(action_name);

    });


    // запрос по истории документа
    $(document).on("click", "#popup_action_list_yes", function () {
        $("#popup_action_list").removeClass("block");
        action_name = $("#actoin_name").val();
        $.ajax({
            type: "POST",
            url: "/action_list/new_action_name",
            data: {
                trigger:trigger,
                action_name:action_name
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;

                if(request_result =="ok") {
                    $(".row_data").each(function() {
                        var edit_trigger = $(this).find(".cell_two").html();
                        if(edit_trigger == trigger){
                            $(this).find(".cell_four").html(action_name);
                            $(this).attr("action_name",action_name)
                        }
                    });
                }
            },
            error: function () {
            }
        });
    });


});


$(document).ready(function() {
    $(document).on("click", ".company_turn_control", function () {
        $('.company_turn_control').css("background-color","#3c8dbc");
        $(this).css("background-color","yellowgreen");

        var parent = $(this).closest(".list_item");
        var company_id =  parent.attr("company_id");
        $.ajax({
            type: "POST",
            url: "/select_company_control/start_company_control",
            data: {
                company_id: company_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                if (request_result == "ok") {
                    message("Компания доступна", request_result);
                }
            },
            error: function () {
            }
        });

    });
});

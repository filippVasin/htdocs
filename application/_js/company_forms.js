$(document).ready(function() {
    var path = "";
    $(document).on("click", ".link", function () {
        path = $(this).attr('path');
        $.ajax({
            type: "POST",
            url: "/company_forms/look_file",
            data: {
                path:path
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var form_actoin = result.form_actoin;
                var page = result.page;
                if(request_result=="ok"){
                    if(form_actoin == "open"){
                        $("#look_doc").html(page);
                        $("#look_doc_popup").removeClass("none");
                    }
                }

            }
        });
    });

    $(document).on("click", "#yes_i_read", function () {
        $("#look_doc_popup").addClass("none");
    });
});
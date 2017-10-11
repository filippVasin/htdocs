/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {

    $(document).on("click", "#show_add_company_form", function () {
        $('#add_department_form').toggle(200);
    });

    $(document).on("click", "#add_new_company", function () {
        var flag = 0;
        var type = 0;
        var org_id_group = 0;

        // группа компаний
        if($('#select_type_company').val() == "Группа Компаний"){

            var new_group_company_name = $('#new_group_company_name').val();

            if(new_group_company_name != ""){
                flag = 1;
                type = 1;// Группа Компаний
            }
        }

        // Компания
        if($('#select_type_company').val() == "Организация"){

            var company_name = $('#new_company_name').val();
            var company_short_name = $('#new_company_short_name').val();
            var new_company_director_surname = $('#new_company_director_surname').val();
            var new_company_director_name = $('#new_company_director_name').val();
            var new_company_director_second_name = $('#new_company_director_second_name').val();
            var new_company_director_email = $('#new_company_director_email').val();


            if(company_name != "" && company_short_name != "" && new_company_director_surname != "" && new_company_director_name != "" && new_company_director_second_name != "" ){

                if($('#select_group_company').val() == "Компания сама по себе"){
                    flag = 1;
                    type = 2;// Компания сама по себе
                }
                if($('#select_group_company').val() == "Компания в составе Группы"){

                    org_id_group = $('#select_group_companys_item').val();
                    if(org_id_group != 0){
                        flag = 1;
                        type = 3;// Компания в составе Группы
                    }
                }
            }
        }



        if(flag == 0){
            message('Вы не заполнили все необходимые данные', 'error');
        } else {

            $.ajax({
                type: "POST",
                url: "/company_control/add",
                data:{
                    new_group_company_name:new_group_company_name,
                    company_name:company_name,
                    company_short_name:company_short_name,
                    new_company_director_surname:new_company_director_surname,
                    new_company_director_name:new_company_director_name,
                    new_company_director_second_name:new_company_director_second_name,
                    new_company_director_email:new_company_director_email,
                    org_id_group:org_id_group,
                    type:type
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var request_message = result.message;
                    var new_item = result.new_item;

                    if (request_result == 'ok') {
                        $('#company_list').prepend(new_item);
                        $('#new_company_name').val('');
                        $('#new_company_short_name').val('');
                        $('#new_company_director_surname').val('');
                        $('#new_company_director_name').val('');
                        $('#new_company_director_second_name').val('');
                        $('#show_add_company_form').click();
                        $("#cancel_add_new_company").click();
                    }

                    message(request_message, request_result);
                },
                error: function () {
                }
            });
        }
    });

    $(document).on("click", ".company_turn_control", function () {
        var company_id = $(this).parent('div').parent('div').attr('company_id');
        var this_item = $(this);

        $('.company_turn_control').each(function(){
            $(this).removeClass('on_company');
            $(this).addClass('off_company');
        });

        $.ajax({
            type: "POST",
            url: "/company_control/set_company_control",
            data: "company_id=" + company_id,
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var request_message = result.message;

                if(request_result == 'ok'){
                    this_item.addClass('on_company');
                    setTimeout(function(){
                        window.location = "/company_control";
                    }, 3000);
                }

                message(request_message, request_result);
            },
            error: function () {
            }
        });

    });


    $(document).on("click", "#add_test_users_couple", function () {
        $("#plus_test_users_couple").removeClass("none");
    });
    $(document).on("click", "#cancel_test_users_couple", function () {
        $("#create_test_users_couple").removeClass("none");
        $("#cancel_test_users_couple").html("Отмена");
        $("#plus_test_users_couple_input").removeClass("none");
        $(".users").html("");
        $("#plus_test_users_couple_input").val("");
        $("#plus_test_users_couple_input").removeClass("none");
    });

    $(document).on("click", "#create_test_users_couple", function () {
        var email = $("#plus_test_users_couple_input").val();
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if((email != '' && pattern.test(email)) || email =="") {
            $("#plus_test_users_couple_input").addClass("none");
            $("#plus_test_users_couple_input").val("");
            $("#create_test_users_couple").addClass("none");
            $("#cancel_test_users_couple").html("Запомните логины/пароли");
            $("#plus_test_users_couple_input").addClass("none");
            $.ajax({
                type: "POST",
                url: "/company_control/plus_test_users_couple",
                data: {
                    email:email
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var request_result = result.status;
                    var content = result.content;

                        $(".users").html(content);

                }
            });
        } else {
            $("#plus_test_users_couple_input").css("border-color","red");
            setTimeout("$('#plus_test_users_couple_input').css('border-color','#ccc')", 3000);
        }
    });

    $(document).on( 'change',"#select_type_company", function () {
       var type = $(this).val();
        if(type == "Организация"){
            $("#item_company").removeClass("none");
            $("#group_companys").addClass("none");
        } else {
            $("#group_companys").removeClass("none");
            $("#item_company").addClass("none");
        }
    });

    $(document).on( 'click',"#cancel_add_new_company", function () {
        $("#select_type_company").val(0);
        $("#select_group_company").val(0);
        $("#item_company").addClass("none");
        $("#group_companys").addClass("none");
        $("#add_department_form input").val("");
    })
    $(document).on( 'change',"#select_group_company", function () {
        var group = $(this).val();
        if(group == "Компания в составе Группы"){
            $("#select_group_companys_item_box").removeClass("none");
            group_companys_item_content();
        } else {
            $("#select_group_companys_item").html("");
            $("#select_group_companys_item_box").addClass("none");
        }
    });




    function group_companys_item_content() {

        $.ajax({
            type: "POST",
            url: "/company_control/select_group_companys_item",
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;

                if(request_result == 'ok'){
                    $("#select_group_companys_item").html(content);
                }

            },
            error: function () {
            }
        });
    }

});



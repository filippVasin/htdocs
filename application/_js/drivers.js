$(document).ready(function() {
   var item_id = 0;
   var user_id = 0;


    var table = $('#table1').DataTable({
        "language": {
            "url": "Russian.json"
        }
    });



    $(document).on("click", ".driver_row", function () {
        item_id =  $(this).attr("item_id");
        $("#start_position").click();
        $("#edit_popup_user").attr("item_id",user_id);
        $.ajax({
            type: "POST",
            url: "/editor/employee_card",
            data: {
                item_id:item_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);

                var surname = result.surname;
                var name = result.name;
                var second_name = result.second_name;
                var birthday = result.birthday;
                var start_date = result.start_date;
                var em_status = result.em_status;
                var request_result = result.status;
                var personnel_number = result.personnel_number;
                var content = result.content;
                var address = result.address;
                var category = result.category;
                var license_number = result.license_number;
                var start_date_driver = result.start_date_driver;
                var end_date_driver = result.end_date_driver;

                // если 'ok' - рисуем тест
                if(request_result == 'ok'){

                    $("#edit_popup_employees").attr("item_id",item_id);
                    $("#title_employees_item_id").html(item_id);
                    $("#edit_popup_input_surname").val(surname);
                    $("#edit_popup_input_name").val(name);
                    $("#edit_popup_input_second_name").val(second_name);

                    $("#edit_popup_input_start_date").val(start_date);
                    $("#edit_popup_input_birthday").val(birthday);

                    $("#edit_popup_input_status").val(em_status);


                    if(em_status == 1 ){
                        $("#add_emp_mix").addClass("none");
                        $("#delete_emp_mix").removeClass("none");
                    } else {
                        $("#delete_emp_mix").addClass("none");
                        $("#add_emp_mix").removeClass("none");
                    }
                    if(address!=""){
                        $("#popup_reg_address").val(address);
                    }
                    if(category!=""){
                        $("#popup_driver_categories").val(category);
                        $("#popup_driver_number").val(license_number);
                        $("#popup_driver_start").val(start_date_driver);
                        $("#popup_driver_end").val(end_date_driver);
                    }

                    $("#edit_popup_input_personnel_number").val(personnel_number);

                    $("#edit_popup_employees_button").click();
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });



    //// показываем карточку редактированния для забивания данных о документах водителя после мед осмотра
    //function edit_driver(){
    //    var item_id = employee_id;
    //
    //    //$("#edit_popup_employees_button").click();
    //    $("#edit_popup_user").attr("item_id",employee_id);
    //    $.ajax({
    //        type: "POST",
    //        url: "/editor/employee_card",
    //        data: {
    //            item_id:item_id
    //        },
    //        success: function (answer) {
    //            var result = jQuery.parseJSON(answer);
    //
    //            var surname = result.surname;
    //            var name = result.name;
    //            var second_name = result.second_name;
    //            var birthday = result.birthday;
    //            var start_date = result.start_date;
    //            var em_status = result.em_status;
    //            var request_result = result.status;
    //            var personnel_number = result.personnel_number;
    //            var content = result.content;
    //            var address = result.address;
    //            var category = result.category;
    //            var license_number = result.license_number;
    //            var start_date_driver = result.start_date_driver;
    //            var end_date_driver = result.end_date_driver;
    //
    //            // если 'ok' - рисуем тест
    //            if(request_result == 'ok'){
    //
    //                $("#edit_popup_employees").attr("item_id",item_id);
    //                $("#title_employees_item_id").html(item_id);
    //                $("#edit_popup_input_surname").val(surname);
    //                $("#edit_popup_input_name").val(name);
    //                $("#edit_popup_input_second_name").val(second_name);
    //
    //                $("#edit_popup_input_start_date").val(start_date);
    //                $("#edit_popup_input_birthday").val(birthday);
    //
    //                $("#edit_popup_input_status").val(em_status);
    //
    //
    //                if(em_status == 1 ){
    //                    $("#add_emp_mix").addClass("none");
    //                    $("#delete_emp_mix").removeClass("none");
    //                } else {
    //                    $("#delete_emp_mix").addClass("none");
    //                    $("#add_emp_mix").removeClass("none");
    //                }
    //                if(address!=""){
    //                    $("#popup_reg_address").val(address);
    //                }
    //                if(category!=""){
    //                    $("#popup_driver_categories").val(category);
    //                    $("#popup_driver_number").val(license_number);
    //                    $("#popup_driver_start").val(start_date_driver);
    //                    $("#popup_driver_end").val(end_date_driver);
    //                }
    //
    //                $("#edit_popup_input_personnel_number").val(personnel_number);
    //
    //                $("#edit_popup_employees_button").click();
    //            }
    //        },
    //        error: function () {
    //            console.log('error');
    //        }
    //    });
    //}



    $(document).on("click", "#save_popup_input_employees", function () {
        item_id =  $("#edit_popup_employees").attr("item_id");
        var surname  = $("#edit_popup_input_surname").val();
        var name = $("#edit_popup_input_name").val();
        var second_name  = $("#edit_popup_input_second_name").val();
        var start_date  = $("#edit_popup_input_start_date").val();
        var birthday  = $("#edit_popup_input_birthday").val();
        var em_status   = $("#edit_popup_input_status").val();
        var personnel_number   = $("#edit_popup_input_personnel_number").val();
        var address   = $("#popup_reg_address").val();
        var category   = $("#popup_driver_categories").val();
        var license_number   = $("#popup_driver_number").val();
        var start_date_driver   = $("#popup_driver_start").val();
        var end_date_driver   = $("#popup_driver_end").val();



        $.ajax({
            type: "POST",
            url: "/editor/save_employee_card",
            data: {
                item_id:item_id,
                surname:surname,
                name:name,
                second_name:second_name,
                start_date:start_date,
                birthday:birthday,
                em_status:em_status,
                personnel_number:personnel_number,
                address:address,
                category:category,
                license_number:license_number,
                start_date_driver:start_date_driver,
                end_date_driver:end_date_driver
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var surname = result.surname;
                var name = result.name;
                var second_name = result.second_name;
                var request_result = result.status;
                // если 'ok' - рисуем тест
                if(request_result == 'ok'){
                    $(".table_row_employee").each(function() {
                        if($(this).attr("item_id")==item_id) {
                            var content = surname + " " + name + " " + second_name;
                            $(this).children(".type_name").html(content);
                        }
                    });
                    $(".btn-default").click();
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });

    $(document).on("click", "#print_drivers_table", function () {
        var link = "/doc_views?PATP1_list_of_drivers&probation";
        print_link(link);
    });

});



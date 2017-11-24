$(document).ready(function() {
    var left_key = 0;
    var right_key = 0;
    var select_item = "";
    var select_item_status = "";
    var emp = "";
    var step = "";
    var manual = "";
    var dir = "";
    var name =  "";
    var fio = "";
    var dol =  "";
    var date_from = "";
    var date_to = "";
    var doc = 0;
    var file_id = 0;
    var observer_em =  0;
    var local_id =  0;
    var action_type =  0;
    var employee_id = 0;
    var inst_routs_edit = 0;

    tab_vs_enter_one();
    tab_vs_enter_two();

    $(document).on("click", "#reset", function () {
        $(".cancel_popup").click();
        $('#datepicker_from').val("");
        $('#datepicker_to').val("");
        select();
    });


    function select(){
        $.ajax({
            type: "POST",
            url: "/local_alert/select",
            data: {
                select_item_status:select_item_status,
                select_item:select_item,
                left_key:left_key,
                right_key:right_key,
                date_from:date_from,
                date_to:date_to
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;

                if(status =="ok") {
                    location.reload();
                    //window.location = "/report_step";
                }
                if(status == "") {

                }
            },
            error: function () {
            }
        });
    }


    $('#table1_wrapper>.row:first-child').append($("#node_docs_select"));
    $('#table1_wrapper>.row>div').addClass("col-sm-4");
    $('#table1_wrapper .col-sm-4').removeClass("col-sm-6");

    // отмена действия
    $(document).on("click", ".cancel_popup", function () {
        $("#popup_context_menu_update").css("display","none");
        $("#action_history_docs_popup").css("display","none");
        $("#popup_update_tree").html("");
        $("#emp_report_name").html("");
        $("#docs_report_name").html("");
        emp = "";
        step = "";
        manual = "";
        dir = "";
        name =  "";
        fio = "";
        dol = "";
        select_item = "";
        select_item_status = "";
        left_key = "";
        right_key = "";
        date_from = "";
        date_to = "";
    });

    $(document).on("click", ".alert_row", function () {
        dol =  $(this).attr("dol");
        dir =  $(this).attr("dir");
        name =  $(this).attr("name");
        doc =  $(this).attr("doc");
        file_id =  $(this).attr("file_id");
        emp =  $(this).attr("emp");
        local_id =  $(this).attr("local_id");
        action_type =  $(this).attr("action_type");
        observer_em = $(this).attr("observer_em");
        if( action_type == 10 ){
            $("#emp_report_name").html(name);
            $("#dolg_report_name").html(dol);
            $("#dolg_report_dir").html(dir);
            $("#docs_report_name").html(doc);
            $("#alert_signature_docs_popup_button").click();
        }
        if( action_type == 12 ){
            $("#emp_acception_name").html(name);
            $("#dolg_acception_name").html(dol);
            $("#dolg_acception_dir").html(dir);
            $("#docs_acception_name").html(doc);
            $("#alert_acception_docs_popup_button").click();
        }
        if( action_type == 14 ){
            $("#emp_bailee_push_name").html(name);
            $("#dolg_bailee_push_name").html(dol);
            $("#dolg_bailee_push_dir").html(dir);
            $("#docs_bailee_push_name").html(doc);
            $("#alert_bailee_push_popup_button").click();
        }
        if( action_type == 17 ){
            $("#driver_name_popup").html(name);
            $("#alert_create_driver_popup_button").click();
        }
        if( action_type == 18 ){

            $.ajax({
                type: "POST",
                url: "/local_alert/internship_list",
                data: {
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var content = result.content;
                    $("#internship_list_content").html(content);
                    $(".valid_date").mask("99.99.9999");
                    tab_vs_enter_inst();
                },
                error: function () {
                    console.log('error');
                }
            });// ajax

            $("#print_probationer_popup_name").html(name);
            $("#alert_print_probationer_button").click();
        }
        if( action_type == 19 ){
            $.ajax({
                type: "POST",
                url: "/local_alert/check_inst_complete",
                data: {
                    emp:emp
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var content = result.content;
                    if(content == "yes"){
                        // прошли стажировку
                        $("#yes_popup_19").removeClass("none");
                    } else {
                        $("#yes_popup_19").addClass("none");
                    }
                    $("#driver_probation_actoin_popup").html(name);
                    $("#alert_probation_actoin_popup_button").click();
                },
                error: function () {
                    console.log('error');
                }
            });// ajax
        }
        if( action_type == 20 ){
            $("#driver_probation_actoin_popup_20").html(name);
            $("#alert_probation_actoin_popup_20_button").click();
        }
        if( action_type == 21 ){
            $("#driver_probation_actoin_popup_21").html(name);
            $("#alert_probation_actoin_popup_21_button").click();
        }
        if( action_type == 22 ){
            $("#driver_probation_actoin_popup_22").html(name);
            $("#alert_probation_actoin_popup_22_button").click();
        }
        if( action_type == 23 ){
            $("#driver_probation_actoin_popup_23").html(name);
            $("#alert_probation_actoin_popup_23_button").click();
        }
        if( action_type == 24 ){
            $("#driver_probation_actoin_popup_24").html(name);
            $("#alert_probation_actoin_popup_24_button").click();
        }
    });


// отправляем на исполнение в forms и передаём нужные параметры
    $(document).on("click", "#yes_popup_3", function () {
        var la_real_form_id = file_id;
        var la_employee = observer_em;

        var action_name = "secretary_signature_action";

        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                la_real_form_id:la_real_form_id,
                la_employee:la_employee,
                action_name:action_name,
                observer_em:observer_em,
                local_id:local_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var form_actoin_set = result.form_actoin;
                var la_employee_set = result.la_employee;
                var la_real_form_id_set = result.la_real_form_id;
                var observer_em_set = result.observer_em;

                $(".alert_row").each(function() {
                    if(la_real_form_id_set == $(this).attr("file_id")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $(".btn-default").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    // отправляем на исполнение в forms и передаём нужные параметры
    $(document).on("click", "#yes_popup_4", function () {
        var la_real_form_id = file_id;
        var la_employee = observer_em;

        var action_name = "secretary_get_doc_action";

        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                la_real_form_id:la_real_form_id,
                la_employee:la_employee,
                action_name:action_name,
                observer_em:observer_em,
                local_id:local_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var form_actoin_set = result.form_actoin;
                var la_employee_set = result.la_employee;
                var la_real_form_id_set = result.la_real_form_id;
                var observer_em_set = result.observer_em;

                $(".alert_row").each(function() {
                    if(la_real_form_id_set == $(this).attr("file_id")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $(".btn-default").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    // отправляем на исполнение в forms и передаём нужные параметры
    $(document).on("click", "#yes_popup_14", function () {
        var la_real_form_id = file_id;
        var la_employee = observer_em;
        var action_name = "bailee_action";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                la_real_form_id:la_real_form_id,
                la_employee:la_employee,
                action_name:action_name,
                observer_em:observer_em,
                local_id:local_id
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var form_actoin_set = result.form_actoin;
                var la_employee_set = result.la_employee;
                var la_real_form_id_set = result.la_real_form_id;
                var observer_em_set = result.observer_em;

                $(".alert_row").each(function() {
                    if(la_real_form_id_set == $(this).attr("file_id")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $(".btn-default").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });



    $(document).on("click", "#yes_popup_17", function () {
        var la_real_form_id = file_id;
        var action_name = "create_driver";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                la_real_form_id:la_real_form_id,
                action_name:action_name
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                employee_id = result.employee_id;
                var la_real_form_id_set = result.la_real_form_id;
                var status = result.status;
                var link = result.link;

                $(".alert_row").each(function() {
                    if(la_real_form_id_set == $(this).attr("file_id")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $(".btn-default").click();
                if(status == "ok"){
                    //print_link(link);
                }
                edit_driver();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    $(document).on("click", "#yes_popup_19", function () {
        var la_real_form_id = emp;
        var action_name = "probation_actoin";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                emp:emp,
                action_name:action_name
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                employee_id = result.employee_id;
                var la_real_form_id_set = result.la_real_form_id;
                var status = result.status;
                var link = result.link;

                $(".alert_row").each(function() {
                    if(emp == $(this).attr("emp")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                var link = "/doc_views?PATP1_Probationer&probation&" + emp;
                print_link(link);
                $("#inst_list_19_cancel").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });



    $(document).on("click", "#yes_popup_18", function () {
        var flag = 0

        if($("#18_order_number").val()==""){
            $("#18_order_number").css("border-color","red");
            setTimeout("$('#18_order_number').css('border-color','#ccc')", 3000);
            flag = 1;
        }
        if($("#18_order_date").val()==""){
            $("#18_order_date").css("border-color","red");
            setTimeout("$('#18_order_date').css('border-color','#ccc')", 3000);
            flag = 2;
        }
        if($("#18_mentor").val() == 0){
            $("#18_mentor").css("border-color","red");
            setTimeout("$('#18_mentor').css('border-color','#ccc')", 3000);
            flag = 3;
        }
        if($("#18_bus").val() == 0){
            $("#18_bus").css("border-color","red");
            setTimeout("$('#18_bus').css('border-color','#ccc')", 3000);
            flag = 4;
        }
        if($("#18_route").val() == 0){
            $("#18_route").css("border-color","red");
            setTimeout("$('#18_route').css('border-color','#ccc')", 3000);
            flag = 5;
        }
        if($("#18_hours").val() == 0){
            $("#18_hours").css("border-color","red");
            setTimeout("$('#18_hours').css('border-color','#ccc')", 3000);
            flag = 6;
        }
        if($("#18_inst_date").val()==""){
            $("#18_inst_date").css("border-color","red");
            setTimeout("$('#18_inst_date').css('border-color','#ccc')", 3000);
            flag = 7;
        }

        var order = $("#18_order_number").val() + " от " + $("#18_order_date").val();
        var mentor_id = $("#18_mentor").val();
        var bus_id = $("#18_bus").val();
        var route_id = $("#18_route").val();
        var hours = $("#18_hours").val();
        var inst_date = $("#18_inst_date").val();

        var action_name = "probation_alert";
        if(flag == 0){
            $.ajax({
                type: "POST",
                url: "/distributor/main",
                data: {
                    emp: emp,
                    action_name: action_name,
                    order: order,
                    mentor_id: mentor_id,
                    bus_id: bus_id,
                    route_id: route_id,
                    hours: hours,
                    inst_date: inst_date
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var status = result.status;
                    var link = result.link;

                    $(".alert_row").each(function () {
                        if (file_id == $(this).attr("file_id")) {
                            if (18 == $(this).attr("action_type")) {
                                $(this).css("display", "none");
                            }
                        }
                    });
                    $(".btn-default").click();
                    if (status == "ok") {
                        print_link(link);
                    }
                },
                error: function () {
                    console.log('error');
                }
            });// ajax
        } else {
            //alert(flag);
        }
    });

    // событие выбора автобуса
    $(document).on("change",'#18_bus',function(){
        var bus_id = $("#18_bus").val();
        // получаем маршруты автобуса
        // если маршрут ещё не выбирали
        if($("#18_route").val() == 0){
            $.ajax({
                type: "POST",
                url: "/local_alert/get_bus_routes",
                data: {
                    bus_id: bus_id
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var status = result.status;
                    var content = result.content;
                    // помешаем доступные маршруты в выпадашку
                    if (status == "ok") {
                        $("#18_route").html(content);
                    }

                },
                error: function () {
                    console.log('error');
                }
            });// ajax
        }
    });

    // событие выбора маршрута
    $(document).on("change",'#18_route',function(){
        var route_id = $("#18_route").val();
        // получаем автобусы на маршруте
        // если автобус ещё не выбирали
        if($("#18_bus").val() == 0) {
            $.ajax({
                type: "POST",
                url: "/local_alert/get_route_buses",
                data: {
                    route_id: route_id
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var status = result.status;
                    var content = result.content;
                    // помешаем доступные автобусы в выпадашку
                    if (status == "ok") {
                        $("#18_bus").html(content);
                    }

                },
                error: function () {
                    console.log('error');
                }
            });// ajax
        }
    });




    $(document).on("click", "#inst_list_19", function () {
        $.ajax({
            type: "POST",
            url: "/local_alert/internship_list_edit",
            data: {
                emp:emp
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;
                $("#popup_inst_list_edit").html(content);
                $(".valid_date").mask("99.99.9999");
                tab_vs_enter_inst_edit();

                $("#popup_inst_list_button").click();
                $("#yes_popup_19 .btn-default").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    $(document).on("click", "#print_med_form", function () {
        var action_name = "print_med_form";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                file_id:file_id,
                action_name:action_name
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var link = result.link;

                if(status == "ok"){
                    print_link(link);
                }
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });



    $(document).on("click", "#inst_list_19_plus_route", function () {

        $.ajax({
            type: "POST",
            url: "/local_alert/internship_list_edit_plus_route",
            data: {
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var content = result.content;
                $("#popup_inst_list_edit_plus_route").html(content);
                $(".valid_date").mask("99.99.9999");
                $("#inst_list_19_cancel").click();
                $("#inst_list_19_edit_cancel").click();
                $("#popup_inst_list_plus_route_button").click();
                tab_vs_enter_inst_edit_plus_route();
                check_route_and_bus()
            },
            error: function () {
                console.log('error');
            }
        });// ajax

    });


    $(document).on("click", "#inst_list_19_plus_route_save", function () {
        var flag = 0

        if($("#18_mentor_plus").val() == 0){
            $("#18_mentor_plus").css("border-color","red");
            setTimeout("$('#18_mentor_plus').css('border-color','#ccc')", 3000);
            flag = 1;
        }
        if($("#18_bus_plus").val() == 0){
            $("#18_bus_plus").css("border-color","red");
            setTimeout("$('#18_bus_plus').css('border-color','#ccc')", 3000);
            flag = 2;
        }
        if($("#18_route_plus").val() == 0){
            $("#18_route_plus").css("border-color","red");
            setTimeout("$('#18_route_plus').css('border-color','#ccc')", 3000);
            flag = 3;
        }
        if($("#18_hours_plus").val() == 0){
            $("#18_hours_plus").css("border-color","red");
            setTimeout("$('#18_hours_plus').css('border-color','#ccc')", 3000);
            flag = 4;
        }
        if($("#18_inst_date_plus").val()==""){
            $("#18_inst_date_plus").css("border-color","red");
            setTimeout("$('#18_inst_date_plus').css('border-color','#ccc')", 3000);
            flag = 5;
        }

        var mentor_id = $("#18_mentor_plus").val();
        var bus_id = $("#18_bus_plus").val();
        var route_id = $("#18_route_plus").val();
        var hours = $("#18_hours_plus").val();
        var inst_date = $("#18_inst_date_plus").val();

        if(flag == 0){
            $("#inst_list_19_plus_route_cancel").click();
            $.ajax({
                type: "POST",
                url: "/local_alert/inst_save_new_route",
                data: {
                    emp: emp,
                    mentor_id: mentor_id,
                    bus_id: bus_id,
                    route_id: route_id,
                    hours: hours,
                    inst_date: inst_date
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var status = result.status;
                    var link = result.link;
                    var content = result.content;
                    if (status == "ok") {
                        $("#inst_table_router_rows").html(content);

                        $("#popup_inst_list_button").click();

                    }
                },
                error: function () {
                    console.log('error');
                }
            });// ajax
        } else {
            //alert(flag);
        }
    });

    $(document).on("click", "#inst_list_19_plus_route_cancel", function () {
        setTimeout('$("#popup_inst_list_button").click()', 500);
    });

    $(document).on("click", "#inst_list_19_print", function () {
        var link = "/doc_views?PATP1_Probationer&probation&" + emp;
        print_link(link);
    });
    $(document).on("click", ".print_inst_list", function () {
        var link = "/doc_views?PATP1_Probationer&probation&" + emp;
        print_link(link);
    });


    $(document).on("click", "#yes_popup_20", function () {
        var action_name = "ACS_signature_from_the_driver";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                emp:emp,
                action_name:action_name
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);

                $(".alert_row").each(function() {
                    if(emp == $(this).attr("emp")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $("#popup_20_edut_cancel").click();

            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });


    $(document).on("click", "#yes_popup_21", function () {
        var action_name = "transfer_to_personnel_department";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                emp:emp,
                action_name:action_name
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);

                $(".alert_row").each(function() {
                    if(emp == $(this).attr("emp")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $("#popup_21_edut_cancel").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    $(document).on("click", "#yes_popup_22", function () {
        var action_name = "personnel_department_receive";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                emp:emp,
                action_name:action_name
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);

                $(".alert_row").each(function() {
                    if(emp == $(this).attr("emp")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $("#popup_22_edut_cancel").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    $(document).on("click", "#yes_popup_23", function () {
        var action_name = "sign_staff_department";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                emp:emp,
                action_name:action_name
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);

                $(".alert_row").each(function() {
                    if(emp == $(this).attr("emp")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $("#popup_23_edut_cancel").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    $(document).on("click", "#yes_popup_24", function () {
        var action_name = "sign_Deputy_TB_and_DB";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                emp:emp,
                action_name:action_name
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);

                $(".alert_row").each(function() {
                    if(emp == $(this).attr("emp")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $("#popup_24_edut_cancel").click();
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    $(document).on("click", "#popup_22_edut_button", function () {
        $("#popup_22_edut_cancel").click();
            $.ajax({
                type: "POST",
                url: "/local_alert/internship_list_edit",
                data: {
                    emp:emp
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var content = result.content;
                    $("#popup_inst_list_edit").html(content);
                    $(".valid_date").mask("99.99.9999");
                    tab_vs_enter_inst_edit();
                    $("#popup_inst_list_button").click();
                },
                error: function () {
                    console.log('error');
                }
            });// ajax
    });

    // показываем карточку редактированния для забивания данных о документах водителя после мед осмотра
    function edit_driver(){
        var item_id = employee_id;

        //$("#edit_popup_employees_button").click();
        $("#edit_popup_user").attr("item_id",employee_id);
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
    }


    // выбираем элемент для редактированния
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
        var flag = 0;
        var pattern =/^(?:(?:31(\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/i;

        if(start_date != ""){
            if(pattern.test(start_date)){
                // норм
            } else {
                $("#edit_popup_input_start_date").css("border-color", "red");
                setTimeout("$('#edit_popup_input_start_date').css('border-color','#ccc')", 3000);
                flag = 1;
            }
        }

        if(birthday != ""){
            if(pattern.test(birthday)){
                // норм
            } else {
                $("#edit_popup_input_birthday").css("border-color", "red");
                setTimeout("$('#edit_popup_input_birthday').css('border-color','#ccc')", 3000);
                flag = 2;
            }
        }

        if(start_date_driver != ""){
            if(pattern.test(start_date_driver)){
                // норм
            } else {
                $("#popup_driver_start").css("border-color", "red");
                setTimeout("$('#popup_driver_start').css('border-color','#ccc')", 3000);
                flag = 3;
            }
        }

        if(end_date_driver != ""){
            if(pattern.test(end_date_driver)){
                // норм
            } else {
                $("#popup_driver_end").css("border-color", "red");
                setTimeout("$('#popup_driver_end').css('border-color','#ccc')", 3000);
                flag = 4;
            }
        }


        if(flag == 0) {// всё норм
            $.ajax({
                type: "POST",
                url: "/editor/save_employee_card",
                data: {
                    item_id: item_id,
                    surname: surname,
                    name: name,
                    second_name: second_name,
                    start_date: start_date,
                    birthday: birthday,
                    em_status: em_status,
                    personnel_number: personnel_number,
                    address: address,
                    category: category,
                    license_number: license_number,
                    start_date_driver: start_date_driver,
                    end_date_driver: end_date_driver
                },
                success: function (answer) {
                    var result = jQuery.parseJSON(answer);
                    var surname = result.surname;
                    var name = result.name;
                    var second_name = result.second_name;
                    var request_result = result.status;
                    // если 'ok' - рисуем тест
                    if (request_result == 'ok') {
                        $(".table_row_employee").each(function () {
                            if ($(this).attr("item_id") == item_id) {
                                var content = surname + " " + name + " " + second_name;
                                $(this).children(".type_name").html(content);
                            }
                        });
                        $(".btn-default").click();
                        //var link = "/doc_views?PATP1_Probationer&probation&" + item_id;
                        //print_link(link);
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    });

// выбор статуса
    $(document).on("change", "#node_docs_select", function () {
        select_item = $(this).val();
        $(".alert_row").addClass("none");
        $(".alert_row").each(function() {
            if ((($(this).attr('doc_trigger') == select_item)||(select_item == ""))&&((select_item_em == "")||($(this).attr('emp') == select_item_em))){
                $(this).removeClass("none");
            }
        });
    });

    // выбор сотрудника
    $(document).on("change", "#node_docs_select_em", function () {
        select_item_em = $(this).val();
        $(".alert_row").addClass("none");
        $(".alert_row").each(function() {
            if ((($(this).attr('doc_trigger') == select_item)||(select_item == ""))&&((select_item_em == "")||($(this).attr('emp') == select_item_em))){
                $(this).removeClass("none");
            }
        });
    });


    $(document).on("click", ".inst_routs_row", function () {
        $("#inst_list_19_cancel").click();
        $("#inst_list_19_edit_cancel").click();
        inst_routs_edit = $(this).attr("id_routs");
        $.ajax({
            type: "POST",
            url: "/local_alert/internship_list_edit_route",
            data: {
                inst_routs_edit:inst_routs_edit
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var content = result.content;
                $("#popup_inst_list_edit_route_body").html(content);
                $("#popup_inst_list_edit_route_button").click();
                $(".valid_date").mask("99.99.9999");
                tab_vs_enter_inst_edit_route()
                check_route_and_bus()
            },
            error: function () {
                console.log('error');
            }
        });// ajax


    });

    $(document).on("click", "#inst_list_19_edit_route_save", function () {
        var flag = 0

        if($("#18_mentor_edit").val() == 0){
            $("#18_mentor_edit").css("border-color","red");
            setTimeout("$('#18_mentor_edit').css('border-color','#ccc')", 3000);
            flag = 1;
        }
        if($("#18_bus_edit").val() == 0){
            $("#18_bus_edit").css("border-color","red");
            setTimeout("$('#18_bus_edit').css('border-color','#ccc')", 3000);
            flag = 2;
        }
        if($("#18_route_edit").val() == 0){
            $("#18_route_edit").css("border-color","red");
            setTimeout("$('#18_route_edit').css('border-color','#ccc')", 3000);
            flag = 3;
        }
        if($("#18_hours_edit").val() == 0){
            $("#18_hours_edit").css("border-color","red");
            setTimeout("$('#18_hours_edit').css('border-color','#ccc')", 3000);
            flag = 4;
        }
        if($("#18_inst_date_edit").val()==""){
            $("#18_inst_date_edit").css("border-color","red");
            setTimeout("$('#18_inst_date_edit').css('border-color','#ccc')", 3000);
            flag = 5;
        }

        var mentor_id = $("#18_mentor_edit").val();
        var bus_id = $("#18_bus_edit").val();
        var route_id = $("#18_route_edit").val();
        var hours = $("#18_hours_edit").val();
        var inst_date = $("#18_inst_date_edit").val();

        if(flag == 0){
            //setTimeout('$("#inst_list_19").click()', 500);
            $.ajax({
                type: "POST",
                url: "/local_alert/inst_edit_new_route",
                data: {
                    inst_routs_edit: inst_routs_edit,
                    mentor_id: mentor_id,
                    bus_id: bus_id,
                    route_id: route_id,
                    hours: hours,
                    inst_date: inst_date
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var status = result.status;
                    var link = result.link;
                    var content = result.content;
                    if (status == "ok") {
                        $("#inst_table_router_rows").html(content);
                        $("#inst_list_19_edit_route_cancel").click();

                    }
                },
                error: function () {
                    console.log('error');
                }
            });// ajax
        } else {
            //alert(flag);
        }
        // сохранить
    });


    $(document).on("click", "#inst_list_19_edit_route_delete", function () {
        //setTimeout('$("#inst_list_19").click()', 500);
        $.ajax({
            type: "POST",
            url: "/local_alert/inst_delete_new_route",
            data: {
                inst_routs_edit: inst_routs_edit
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var link = result.link;
                var content = result.content;
                if (status == "ok") {
                    $("#inst_table_router_rows").html(content);
                    $("#inst_list_19_edit_route_cancel").click();

                }
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    $(document).on("click", "#inst_list_19_edit_instr_list", function () {
        $("#inst_list_19_cancel").click();
        $("#inst_list_19_edit_cancel").click();
        $.ajax({
            type: "POST",
            url: "/local_alert/edit_instr_list",
            data: {
                emp:emp
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var link = result.link;
                var content = result.content;
                if (status == "ok") {
                    $("#popup_edit_instr_list_body").html(content);
                    setTimeout('$("#popup_edit_instr_list_button").click()', 500);
                }
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    $(document).on("click", "#inst_list_19_edit_instr_list_save", function () {
        var flag = 0

        if($("#18_order_number_inst_edit").val()==""){
            $("#18_order_number_inst_edit").css("border-color","red");
            setTimeout("$('#18_order_number_inst_edit').css('border-color','#ccc')", 3000);
            flag = 1;
        }
        if($("#18_order_date_inst_edit").val()==""){
            $("#18_order_date_inst_edit").css("border-color","red");
            setTimeout("$('#18_order_date_inst_edit').css('border-color','#ccc')", 3000);
            flag = 2;
        }
        if($("#18_mentor_inst_edit").val() == 0){
            $("#18_mentor_inst_edit").css("border-color","red");
            setTimeout("$('#18_mentor_inst_edit').css('border-color','#ccc')", 3000);
            flag = 3;
        }
        if($("#18_bus_inst_edit").val() == 0){
            $("#18_bus_inst_edit").css("border-color","red");
            setTimeout("$('#18_bus_inst_edit').css('border-color','#ccc')", 3000);
            flag = 4;
        }
        if($("#18_route_inst_edit").val() == 0){
            $("#18_route_inst_edit").css("border-color","red");
            setTimeout("$('#18_route_inst_edit').css('border-color','#ccc')", 3000);
            flag = 5;
        }
        if($("#18_hours_inst_edit").val() == 0){
            $("#18_hours_inst_edit").css("border-color","red");
            setTimeout("$('#18_hours_inst_edit').css('border-color','#ccc')", 3000);
            flag = 6;
        }
        if($("#18_inst_date_inst_edit").val()==""){
            $("#18_inst_date_inst_edit").css("border-color","red");
            setTimeout("$('#18_inst_date_inst_edit').css('border-color','#ccc')", 3000);
            flag = 7;
        }
        if($("#18_ass_bus_inst_edit").val()==0){
            $("#18_ass_bus_inst_edit").css("border-color","red");
            setTimeout("$('#18_ass_bus_inst_edit').css('border-color','#ccc')", 3000);
            flag = 7;
        }

        var order = $("#18_order_number_inst_edit").val() + " от " + $("#18_order_date_inst_edit").val();
        var mentor_id = $("#18_mentor_inst_edit").val();
        var bus_id = $("#18_bus_inst_edit").val();
        var route_id = $("#18_route_inst_edit").val();
        var hours = $("#18_hours_inst_edit").val();
        var inst_date = $("#18_inst_date_inst_edit").val();
        var ass_bus_id = $("#18_ass_bus_inst_edit").val();

        if(flag == 0){

            $("#inst_list_19_cancel").click();
            $("#inst_list_19_edit_instr_list_cancel").click();
            $.ajax({
                type: "POST",
                url: "/local_alert/edit_instr_list_save",
                data: {
                    emp: emp,
                    order: order,
                    mentor_id: mentor_id,
                    bus_id: bus_id,
                    route_id: route_id,
                    hours: hours,
                    inst_date: inst_date,
                    ass_bus_id:ass_bus_id
                },
                success: function (answer) {

                    var result = jQuery.parseJSON(answer);
                    var status = result.status;
                    if(status == "ok"){

                        //setTimeout('$("#popup_inst_list_button").click()', 500);
                    }

                },
                error: function () {
                    console.log('error');
                }
            });// ajax
        } else {
            //alert(flag);
        }

    });

    $(document).on("click", "#inst_list_19_edit_instr_list_cancel", function () {
        setTimeout('$("#inst_list_19").click()', 500);
    });
    $(document).on("click", "#inst_list_19_edit_route_cancel", function () {
        setTimeout('$("#inst_list_19").click()', 500);
    });


    // упорядочить по сотруднику
    $(document).on("click", ".order_by", function () {
        group =  $(this).attr("group");

        $.ajax({
            type: "POST",
            url: "/local_alert/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item,
                select_item_em:select_item_em,
                group:group,
                time_from:time_from,
                time_to:time_to
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;
                var select = result.select;
                var select_em = result.select_em;
                if (content != "") {
                    $('#node_docs_select').html(select);
                }
                if (content != "") {
                    $('#node_docs_select_em').html(select_em);
                }
                if (content != "") {
                    $('#strings').html(content);
                }
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });


    // Выбрать узел
    $(document).on("click", "#node_docs", function () {
        $("#popup_context_menu_update").css("display","block");
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

                    $("body").css("margin-top","0px");
                    $('#test_block').fadeIn(0);
                    $('#popup_update_tree').html(content);
                    $(".tree_item").addClass("none");
                    $(".tree_item_fio").addClass("none");
                    $("html, body").animate({ scrollTop: 0 }, 0);
                    $("#tree_main>ul").removeClass("none");
                    // присваеваем классы дня непустых элементов
                    $(".tree_item").each(function() {
                        var parent = $(this).parent("li");
                        if(parent.children('ul').length != 0){
                            $(this).addClass("open_item");
                        }
                    });
                    $(".open_item").closest("ul").removeClass("none");
                    $(".open_item").removeClass("none");

                }
            },
            error: function () {
                console.log('error');
            }
        });
    });

    // выбираем узел
    $(document).on("click", ".tree_item", function () {
        left_key =  $(this).attr("left_key");
        right_key =  $(this).attr("right_key");
        $("#popup_update_tree").attr("left_key", left_key);
        $("#popup_update_tree").attr("right_key", right_key);

        time_from = $("#time_from").val();
        time_to = $("#time_to").val();
        select_item = $(".target").val();
        select_item_em = $(".target_em").val();

        $(".btn-default").click();
        $.ajax({
            type: "POST",
            url: "/local_alert/start",
            data: {
                left_key:left_key,
                right_key:right_key,
                select_item:select_item,
                select_item_em:select_item_em,
                group:group,
                time_from:time_from,
                time_to:time_to
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var content = result.content;

                    $('#strings').html(content);
            },
            error: function () {
            }
        });

    });


    //сброс всех фильтров
    $(document).on("click", "#rebut_node_docs", function () {
        left_key = 0;
        right_key = 0;
        dol = "";
        dir = "";
        name = "";
        doc = "";
        left_key = "";
        right_key = "";
        select_item = "";
        observer_em = "";
        select_item_em = "";
        group = "";
        time_from = "";
        time_to ="";

        $("#time_from").val("");
        $("#time_to").val("");

        $(".alert_row").removeClass("none");
    });


    var table = $('#table1').DataTable({
        "language": {
            "url": "Russian.json"
        }
    });
    //table.columns().flatten().each( function ( colIdx ) {
    //    // Create the select list and search operation
    //    var select = $('<button type="button" class="btn btn-primary btn-sm pull-right select_button" data-toggle="tooltip" title="" data-original-title="Date range" aria-describedby=""> <i class="fa fa-check-square-o"></i></button>')
    //        .appendTo(
    //        table.column(colIdx).footer()
    //    )
    //        .on( 'click','.li_select', function () {
    //            table
    //                .column( colIdx )
    //                .search( $(this).attr('data_select'))
    //                .draw();
    //        } );
    //    var html ='<li class = "li_select" data_select = "">ВСЁ</li>';
    //    table
    //        .column( colIdx )
    //        .cache( 'search' )
    //        .sort()
    //        .unique()
    //        .each( function ( d ) {
    //            html = html + '<li class = "li_select" data_select = "'+d+'">'+d+'</li>';
    //        } );
    //
    //    select.append('<div class="dropdownmenu none"><div class="ranges"><ul>' +html +'</ul> <div class="range_inputs"> </div> </div> </div>');
    //
    //} );




    $(document).on("click",'.select_button',function(){
        if($(this).hasClass("open_select")){
            $(this).removeClass("open_select");

            $(".dropdownmenu").addClass("none");

        } else {
            $(this).addClass("open_select");

            $(".dropdownmenu").addClass("none");
            var chil = $(this).children(".dropdownmenu");
            chil.removeClass("none");
        }
    });

    // datapickers
    $('#datepicker_to').datepicker({
        language: "ru",
        autoclose: true
    }).on('hide', function(e) {
        date_from = $('#datepicker_from').val();
        date_to = $('#datepicker_to').val();
        select();
    });

    $('#datepicker_from').datepicker({
        language: "ru",
        autoclose: true
    }).on('hide', function(e) {
        date_to = $('#datepicker_to').val();
        date_from = $('#datepicker_from').val();
        select();
    });

    // проверка с какого устройтства вошли
    if(isMobile.any()){
        $("#popup_driver_start").attr("type","date");
        $("#popup_driver_end").attr("type","date");
    } else {
        $(".valid_date").mask("99.99.9999");
    }
    // datapickers

    // работаем ентером как табом в первой вкладке
    function tab_vs_enter_one() {
        var $inputs = $("body").find('.tab_vs_enter_one');
        $inputs.each(function (i) {
            $(this).keypress(function (ev) {
                if (ev.which == 13 && i == $inputs.length - 1) {
                    $(".enter_click_one").click();
                }
                if (ev.which == 13) {
                    $inputs.eq(i + 1).focus();
                    return false;
                }
            });
        });
    }

    // работаем ентером как табом во второй вкладке
    function tab_vs_enter_two() {
        var $inputs = $("body").find('.tab_vs_enter_two');
        $inputs.each(function (i) {
            $(this).keypress(function (ev) {
                if (ev.which == 13 && i == $inputs.length - 1) {
                    $(".enter_click_two").click();
                }
                if (ev.which == 13) {
                    $inputs.eq(i + 1).focus();
                    return false;
                }
            });
        });
    }


    // работаем ентером как табом форме стажировочного листа
    function tab_vs_enter_inst() {
        var $inputs = $("body").find('.tab_vs_enter_inst');
        $inputs.each(function (i) {
            $(this).keypress(function (ev) {
                if (ev.which == 13 && i == $inputs.length - 1) {
                    $("#yes_popup_18").click();
                }
                if (ev.which == 13) {
                    $inputs.eq(i + 1).focus();
                    return false;
                }
            });
        });
    }

    // работаем ентером как табом форме стажировочного листа
    function tab_vs_enter_inst_edit() {
        var $inputs = $("body").find('.tab_vs_enter_inst_edit');
        $inputs.each(function (i) {
            $(this).keypress(function (ev) {
                if (ev.which == 13 && i == $inputs.length - 1) {
                    $("#inst_list_19_save").click();
                }
                if (ev.which == 13) {
                    $inputs.eq(i + 1).focus();
                    return false;
                }
            });
        });
    }
    function tab_vs_enter_inst_edit_plus_route() {
        var $inputs = $("body").find('.tab_vs_enter_plus_route');
        $inputs.each(function (i) {
            $(this).keypress(function (ev) {
                if (ev.which == 13 && i == $inputs.length - 1) {
                    $("#inst_list_19_plus_route_save").click();
                }
                if (ev.which == 13) {
                    $inputs.eq(i + 1).focus();
                    return false;
                }
            });
        });
    }

    function tab_vs_enter_inst_edit_route() {
        var $inputs = $("body").find('.tab_vs_enter_edit_route');
        $inputs.each(function (i) {
            $(this).keypress(function (ev) {
                if (ev.which == 13 && i == $inputs.length - 1) {
                    $("#inst_list_19_edit_route_save").click();
                }
                if (ev.which == 13) {
                    $inputs.eq(i + 1).focus();
                    return false;
                }
            });
        });
    }



    function check_route_and_bus(){
        // событие выбора автобуса
        $(document).on("change", '#18_bus_plus', function () {
            var bus_id = $("#18_bus_plus").val();
            // получаем маршруты автобуса
            // если маршрут ещё не выбирали
            if ($("#18_route_plus").val() == 0) {
                $.ajax({
                    type: "POST",
                    url: "/local_alert/get_bus_routes",
                    data: {
                        bus_id: bus_id
                    },
                    success: function (answer) {
                        var result = jQuery.parseJSON(answer);
                        var status = result.status;
                        var content = result.content;
                        // помешаем доступные маршруты в выпадашку
                        if (status == "ok") {
                            $("#18_route_plus").html(content);
                        }

                    },
                    error: function () {
                        console.log('error');
                    }
                });// ajax
            }
        });

        // событие выбора маршрута
        $(document).on("change", '#18_route_plus', function () {
            var route_id = $("#18_route_plus").val();
            // получаем автобусы на маршруте
            // если автобус ещё не выбирали
            if ($("#18_bus_plus").val() == 0) {
                $.ajax({
                    type: "POST",
                    url: "/local_alert/get_route_buses",
                    data: {
                        route_id: route_id
                    },
                    success: function (answer) {

                        var result = jQuery.parseJSON(answer);
                        var status = result.status;
                        var content = result.content;
                        // помешаем доступные автобусы в выпадашку
                        if (status == "ok") {
                            $("#18_bus_plus").html(content);
                        }

                    },
                    error: function () {
                        console.log('error');
                    }
                });// ajax
            }
        });
    }



});


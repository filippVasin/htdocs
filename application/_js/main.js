$(document).ready(function() {
    var left_key=0;
    var right_key =0;
    var dol =  "";
    var dir =  "";
    var name = "";
    var doc = "";
    var select_item = "";
    var observer_em = "";
    var select_item_em= "";
    var group = "";
    var time_from = "";
    var time_to = "";
    var file_id= "";
    var local_id = "";
    var action_type = "";
    var employee_id = 0;
    var inst_routs_edit = 0;
    var emp = "";
    // если сотрудник - делать ему тут нечего
    if (get_session("role_id") == 3) {
        window.location = "/rover";
    }


    start();



    $(document).on("click",'.open_list_report',function(){
        if($(".open_list_report").hasClass("open_dept")){
            $(".open_list_report").removeClass("open_dept");

            $("#test_report .node_report").addClass('none');
            $('#test_report .node_report>.progress-group').addClass('none');
        } else {
            $(".open_list_report").addClass("open_dept");

            $("#test_report .node_report").removeClass('none');
            $('#test_report .node_report>.progress-group').removeClass('none');

            // плавные переход к открывшемуся блоку
            var destination = $("#test_report").offset().top-80;
            jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 800);
            return false;

        }
    });




    $(document).on('click','#doc_circle',function(){
        if($("#doc_circle").hasClass("open_depd")){
            $("#doc_circle").removeClass("open_depd");

            $("#doc_report .node_report").addClass('none');
            $('#doc_report .node_report>.progress-group').addClass('none');
        } else {
            $("#doc_circle").addClass("open_depd");

            $("#doc_report .node_report").removeClass('none');
            $('#doc_report .node_report>.progress-group').removeClass('none');
        }
    });




    $(document).on('click','#look_dep',function(){
        $(".node_report").removeClass('none');
        $("#look_dep").addClass('none');
        $("#close_dep").removeClass('none');
        $('.node_report>.progress-group').removeClass('none');
    });

    $(document).on('click','#look_dep_all',function(){
        $(".node_report").removeClass('none');
        $('.progress-group').removeClass('none');
        $('.node_report>.progress-group').addClass("look_on");
        $('.node_report>.progress-group').removeClass("look_off");
        $("#look_dep_all").addClass('none');
        $("#close_dep").removeClass('none');
        $("#look_dep").addClass('none');
    });

    $(document).on('click','#close_dep',function(){
        $('.progress-group').addClass('none');
        $(".node_report").addClass('none');
        $("#look_dep").removeClass('none');
        $("#close_dep").addClass('none');
        $("#look_dep_all").removeClass('none');
        $('.node_report>.progress-group').addClass("look_off");
        $('.node_report>.progress-group').removeClass("look_on");

    });



    $(document).on('click','.click_area',function() {
        var parent = $(this).closest(".progress-group");
        if($(this).hasClass("look")){
            $(this).removeClass("look");
            $(parent).children('.progress-group').addClass('none');
        } else {
            $(this).addClass("look");
            $(parent).children('.progress-group').removeClass('none');
        }
    });




    $(document).on("click", "#cancel_popup", function () {
        $("#popup_context_menu_update").addClass("none");
    });

    $(document).on("click", ".tree_item", function () {
        $("#popup_context_menu_update").addClass("none");

        $("#nods_key").attr('left',$(this).attr('left_key'));
        $("#nods_key").attr('right',$(this).attr('right_key'));
        start();
    });

    $(document).on("click", "#all_node_popup", function () {
        $("#popup_context_menu_update").addClass("none");

        $("#nods_key").attr('left',"");
        $("#nods_key").attr('right',"");
        start();
    });



    function start() {

        var node_left_key = $("#nods_key").attr('left');
        var node_right_key = $("#nods_key").attr('right');
        $.ajax({
            type: "POST",
            url: "/main/start",
            data: {
                node_left_key:node_left_key,
                node_right_key:node_right_key
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;

                if(request_result == 'ok'){
                    $("#load_dashboard").html(content);
                    create_node_structure();
                }// if
                if(request_result =="not_data"){
                    $("#load_dashboard").remove();
                }
                if(request_result == 'not company'){
                    window.location = "/company_control";
                }// if
            },
            error: function () {
                console.log('error');
            }
        });// ajax

        $('#calendar').fullCalendar({
            events: '/main/calendar',
            eventClick: function(calEvent) {

               var str_data = new Date(calEvent.start);

               if(calEvent.type == '2'){
                   get_calendary_all_event(calEvent.data_str);
               }

            }
        });
    }

    function get_calendary_item(str_date){
        var report_type = "calendary_item";
        $.ajax({
            type: "POST",
            url: "/master_report/main",
            data: {
                str_date:str_date,
                report_type:report_type
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                if (request_result == "ok") {
                    $("#calendar_event_popup_data").html(content);
                    $("#calendar_event_popup_button").click();
                }
            }
        });
    }

    function get_calendary_type_emp(str_emp,str_date){
        var report_type = "calendary_item_type_emp";
        $.ajax({
            type: "POST",
            url: "/master_report/main",
            data: {
                str_emp:str_emp,
                str_date:str_date,
                report_type:report_type
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                if (request_result == "ok") {
                    $("#calendar_event_popup_data").html(content);
                    $("#calendar_event_popup_button").click();
                }
            }
        });
    }

    function get_calendary_all_event(str_date){
        var report_type = "get_calendary_all_event";
        $.ajax({
            type: "POST",
            url: "/master_report/main",
            data: {
                str_date:str_date,
                report_type:report_type
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var request_result = result.status;
                var content = result.content;
                if (request_result == "ok") {
                    $("#calendar_event_popup_data").html(content);
                    $("#calendar_event_popup_button").click();
                }
            }
        });
    }



    function create_node_structure(){
        // создание дашборда по отделам
        // сборный
        $("#test_node_report .progress-group").each(function() {
            var parent_level = 0;
            var parent_left = 0;
            var parent_right = 0;
            var count_child = 0;
            var parent = $(this);
            var fact = 0;
            var  target = 0;
            fact = Number(parent.attr('fact'));
            target = Number(parent.attr('target'));
            parent_level = $(this).attr('level');
            parent_left = $(this).attr('left_key');
            parent_right = $(this).attr('right_key');
            $('#test_node_report .progress-group').each(function() {
                child_left = 0;
                child_right = 0;
                child_left = $(this).attr('left_key');
                child_right = $(this).attr('right_key');
                if ((parent_left < child_left)&&(parent_right > child_right)){
                    $(this).addClass('none');
                    $(this).detach().appendTo(parent);
                    fact += Number($(this).attr('fact'));
                    target += Number($(this).attr('target'));
                    ++count_child;
                }
                //$(this).append("<br> " + parent_left + "<"+ child_left+" : " + parent_right + ">" + child_right);
            });

            if(count_child>0){
                $(this).addClass("parent");
                $('.progress-text',this).addClass("look_off");
            } else {
                $(this).addClass("last");
            }
        });
        // cтавим администрацию на первое место
        $("#test_node_report .progress-group").each(function() {
            var level = $(this).attr('level');
            var left = $(this).attr('left_key');
            if ((level ==  1)&&(left > 002)){
                $(this).detach().appendTo("#test_node_report");
            }
        });

        // у кого нет потомков идите в конце
        $("#test_node_report .progress-group").each(function() {
            var level = $(this).attr('level');
            var left = $(this).attr('left_key');
            if ((level ==  1)&&(!($(this).hasClass("parent")))){
                $(this).detach().appendTo("#test_node_report");
            }
        });
        // ищим отделы только с сотрудниками без дочерних отделов и показываем сразу сотрудников
        $(".people").each(function() {
            if($(this).siblings(".progress-group").length == 0){
                var parent = $(this);
                $(".fio_box",parent).removeClass("none");
                $(".people_title",parent).addClass("none");
            }
        });
        // выводим суммарную цифру по отделам
        $(".progress-group").each(function() {
            var parent = $(this);
            var childs = parent.find(".fio_box");
            var fact = 0;
            var target = 0;
            childs.each(function() {
               fact += parseInt($(this).attr("fact"));
               target += parseInt($(this).attr("target"));
            });
            $('.progress-number:first',parent).html("<b>"+ fact +"</b>/" + target);
            var width_proc = (Math.round(fact/target*100)) + "%";
            $('.progress-bar:first',parent).css("width",width_proc);
        });

    }


    // открываем и закрываем сотрудников
    $(document).on('click','.people_title',function(){
        var parent = $(this).closest(".people");
        if($(this).hasClass("open_people")){
             $(".fio_box",parent).addClass("none");
            $(this).removeClass("open_people");
        } else {
            $(".fio_box",parent).removeClass("none");
            $(this).addClass("open_people");
        }
    });

    // показать/скрываем отчёт по сотруднику
    $(document).on('click','.fio_box',function(){
        var emp_id = $(this).attr('emp_id');
        var dol = $(this).attr('dol');
        var fio = $(this).attr('fio');
        var all_content = "";
        var report_type = "test_doc";
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
                var content = result.content;
                if (request_result == "ok") {
                    $("#popup_report_emp_content").html(content);
                    $("#popup_report_emp_button").click();
                    $("#popup_emp_fio").html(fio);
                    $("#popup_emp_dol").html(dol);
                }
            }
        });

    });

    $(document).on('click','#ok_popup_report_emp',function(){
        $("#popup_report_emp").addClass("none");
    });
    $(document).on('click','#link_docs_report',function(){
        window.location = "/local_alert ";
    });


    $(document).on("click", ".alert_row", function () {
        dol =  $(this).attr("dol");
        dir =  $(this).attr("dir");
        name =  $(this).attr("name");
        doc =  $(this).attr("doc");
        emp =  $(this).attr("emp");
        file_id =  $(this).attr("file_id");
        observer_em =  $(this).attr("observer_em");
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
                            $(this).closest("li").css("display", "none");
                        }
                    }
                });
                $(".alert_cancel").click();
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
                            $(this).closest("li").css("display", "none");
                        }
                    }
                });
                $(".alert_cancel").click();
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
                            $(this).closest("li").css("display", "none");
                        }
                    }
                });
                $(".alert_cancel").click();
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


    $(document).on("click", "#yes_popup_18", function () {
        var action_name = "probation_alert";
        $.ajax({
            type: "POST",
            url: "/distributor/main",
            data: {
                emp:emp,
                action_name:action_name
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var link = result.link;

                $(".alert_row").each(function() {
                    if(file_id == $(this).attr("file_id")){
                        if(18 == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $(".btn-default").click();
                if(status == "ok"){
                    print_link(link);
                }
            },
            error: function () {
                console.log('error');
            }
        });// ajax
    });

    // показываем карточку редактированния для забивания данных о документах водителя после мед осмотра
    function edit_driver(){
        var item_id = employee_id;

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
                    var link = "/doc_views?PATP1_Probationer&probation&" + item_id;
                    print_link(link);
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });


    // отмена действия
    $(document).on("click", ".cancel_popup", function () {
        $("#alert_signature_docs_popup").addClass("none");
        $("#alert_acception_docs_popup").addClass("none");
        $("#alert_bailee_push_popup").addClass("none");
        $("#popup_context_menu_update").css("display","none");
        $("#emp_report_name").html("");
        $("#dolg_report_name").html("");
        $("#dolg_report_dir").html("");
        $("#docs_report_name").html("");
        $("#popup_update_tree").attr("left_key", "");
        $("#popup_update_tree").attr("right_key", "");
        dol =  "";
        dir =  "";
        name = "";
        doc = "";
    });

    $(document).on("click", "#search_local_alert", function () {

        var search_string = $("#search_local_alert_input").val();
        var report_type = "local_alert_journal";

        $.ajax({
            type: "POST",
            url: "/master_report/main",
            data: {
                report_type:report_type,
                search_string:search_string
            },
            success: function (answer) {

                var result = jQuery.parseJSON(answer);
                var content = result.content;
                var status = result.status;


                if(status == "ok"){
                    $("#ul_alert_journal").html(content);
                }

            },
            error: function () {
                console.log('error');
            }
        });// ajax

    });

    //$("#menu_open_closer").click();


$(".fc-day-grid-container").css("height","100%");



    $(document).on("click", "#popup_report_emp_content", function () {
        if( screen.width <= 760){
            $(".btn-default").addClass("none");
        }
    });





    // проверка с какого устройтства вошли
    if(isMobile.any()){
        $("#popup_driver_start").attr("type","date");
        $("#popup_driver_end").attr("type","date");
    } else {
        $('#popup_driver_start').datepicker({
            language: "ru",
            autoclose: true
        });
        $('#popup_driver_end').datepicker({
            language: "ru",
            autoclose: true
        });
    }
    // datapickers

    // отработка нажетия Enter
    $("#search_local_alert_input").keypress(function(e){
        if(e.keyCode==13){
            //alert("ds");
            $("#search_local_alert").click();
        }
    });


// листок стажировки

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
                            var parent = $(this).closest("li");
                            parent.remove();
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
                        $("#inst_list_19_plus_route_cancel").click();

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
                            var parent = $(this).closest("li");
                            parent.remove();
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
                            var parent = $(this).closest("li");
                            parent.remove();
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
                            var parent = $(this).closest("li");
                            parent.remove();
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
                            var parent = $(this).closest("li");
                            parent.remove();
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
                            var parent = $(this).closest("li");
                            parent.remove();
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
                $("#popup_22_edut_cancel").click();
                setTimeout('$("#popup_inst_list_button").click()', 500);
            },
            error: function () {
                console.log('error');
            }
        });// ajax
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
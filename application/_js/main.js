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
            // выводим суммарную цыфру по отделам
            $('.progress-text-row>.progress-number:first',this).html("<b>"+ fact +"</b>/" + target);
            var width_proc = (Math.round(fact/target*100)) + "%";
            $('.progress-bar:first',this).css("width",width_proc);

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
            if ((level ==  1)&&(left>002)){
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
                var la_real_form_id_set = result.la_real_form_id;
                employee_id = result.employee_id;

                $(".alert_row").each(function() {
                    if(la_real_form_id_set == $(this).attr("file_id")){
                        if(action_type == $(this).attr("action_type")) {
                            $(this).css("display", "none");
                        }
                    }
                });
                $(".btn-default").click();
                edit_driver();
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





    //// рубрика - эксперементы
    //$(".progress-group").each(function() {
    //    if($(this).children('.progress-group').length == 1){
    //        $(this).addClass("colorGreen");
    //    };
    //});
    //$(".progress-group").each(function() {
    //    if($(this).attr('left_key') == 223){
    //        var fact = $(this).children('.num_fact');
    //        var int = Number(fact.html());
    //        fact.html(int - 4);
    //    }
    //});

    // отработка нажетия Enter
    $("#search_local_alert_input").keypress(function(e){
        if(e.keyCode==13){
            //alert("ds");
            $("#search_local_alert").click();
        }
    });

});
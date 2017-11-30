$(document).ready(function() {
    var bus_id = 0;
    var driver_id = 0;
    var route_id = 0;
    var owner_id = 0;
    // инициализируем таблицы
     $('#table_bus_list').DataTable({
        "language": {
            "url": "Russian.json"
        }
    });

     $('#table_list_drivers').DataTable({
        "language": {
            "url": "Russian.json"
        }
    });

    $('#table_bus_list_owners').DataTable({
        "language": {
            "url": "Russian.json"
        }
    });

    $('#table_bus_list_routes').DataTable({
        "language": {
            "url": "Russian.json"
        }
    });

    // кликаем по менюшке таблиц
    $(document).on("click", ".tab_click", function () {
        $(".tab_click").removeClass("active_li");
        $(this).addClass("active_li");
        var link = $(this).attr("data");
        $(".table_item").addClass("none");
        $(link).removeClass("none");
    });


    $(document).on("click", ".bus_row", function () {
        bus_id = $(this).attr("item_id");
        $("#edit_popup_brand_of_bus").val($(this).attr("brand_of_bus"));
        $("#edit_popup_gos_number").val($(this).attr("gos_number"));
        $.ajax({
            type: "POST",
            url: "/buses_edit/bus_edit",
            data: {
                bus_id:bus_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var message_text = result.message;
                var content = result.content
                if(status == 'ok'){
                    $("#bus_edit_popup_boby_select").html(content);
                    $("#bus_edit_popup_button").click();
                } else {
                    message(message_text, status);
                }
            },
            error: function () {
            }
        });
    });

    $(document).on("click", "#yes_bus_edit_boby", function () {
       var brand_of_bus = $("#edit_popup_brand_of_bus").val();
       var gos_number = $("#edit_popup_gos_number").val();
       var route = $("#bus_edit_popup_boby_select").val();
        $.ajax({
            type: "POST",
            url: "/buses_edit/bus_edit_save",
            data: {
                bus_id:bus_id,
                brand_of_bus:brand_of_bus,
                gos_number:gos_number,
                route:route
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var message_text = result.message;
                var content = result.content

                if(status == 'ok'){
                    $(".bus_row").each(function () {
                        if($(this).attr("item_id") == bus_id){
                            $(".brand_of_bus",this).html(brand_of_bus);
                            $(".gos_number",this).html(gos_number);
                            $(this).attr('brand_of_bus',brand_of_bus);
                            $(this).attr('gos_number',gos_number);
                        }
                    });

                    $("#cancel_bus_edit_boby").click();
                } else {
                    message(message_text, status);
                }
            },
            error: function () {
            }
        });
    });


    // строчка в таблице водетелей
    $(document).on("click", ".driver_row", function () {
        driver_id = $(this).attr("item_id");
        $("#edit_popup_surname").val($(this).attr("surname"));
        $("#edit_popup_name").val($(this).attr("name"));
        $("#edit_popup_second_name").val($(this).attr("second_name"));
        $("#edit_popup_phone").val($(this).attr("phone"));
        $("#edit_popup_phone_2").val($(this).attr("phone_2"));
        $.ajax({
            type: "POST",
            url: "/buses_edit/driver_edit",
            data: {
                driver_id:driver_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var message_text = result.message;
                var content = result.content
                if(status == 'ok'){
                    $("#driver_edit_popup_bus_select").html(content);
                    $("#driver_edit_popup_button").click();
                } else {
                    message(message_text, status);
                }
            },
            error: function () {
            }
        });
    });


    $(document).on("click", "#yes_driver_edit_boby", function () {
        var surname = $("#edit_popup_surname").val();
        var name = $("#edit_popup_name").val();
        var second_name = $("#edit_popup_second_name").val();
        var phone = $("#edit_popup_phone").val();
        var phone_2 = $("#edit_popup_phone_2").val();
        var bus = $("#driver_edit_popup_bus_select").val();
        $.ajax({
            type: "POST",
            url: "/buses_edit/driver_edit_save",
            data: {
                driver_id:driver_id,
                surname:surname,
                name:name,
                second_name:second_name,
                phone:phone,
                phone_2:phone_2,
                bus:bus
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var message_text = result.message;
                var content = result.content

                if(status == 'ok'){
                    $(".driver_row").each(function () {
                        if($(this).attr("item_id") == driver_id){
                            $(".fio",this).html(surname  + " " + name  + " " + second_name);
                            $(".phone",this).html(phone  + " " + phone_2);
                            $(this).attr('surname',surname);
                            $(this).attr('name',name);
                            $(this).attr('second_name',second_name);
                            $(this).attr('phone',phone);
                            $(this).attr('phone_2',phone_2);
                        }
                    });

                    $("#cancel_driver_edit_boby").click();
                } else {
                    message(message_text, status);
                }
            },
            error: function () {
            }
        });
    });



    $(document).on("click", ".route_row", function () {
        route_id = $(this).attr("item_id");
        $("#edit_popup_route_number").val($(this).attr("route_number"));
        $("#edit_popup_route_name").val($(this).attr("route_name"));
        $("#route_edit_popup_button").click();
    });


    $(document).on("click", "#yes_route_edit_boby", function () {
        var route_number = $("#edit_popup_route_number").val();
        var route_name = $("#edit_popup_route_name").val();
        $.ajax({
            type: "POST",
            url: "/buses_edit/route_edit_save",
            data: {
                route_id:route_id,
                route_number:route_number,
                route_name:route_name
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var message_text = result.message;
                var content = result.content

                if(status == 'ok'){
                    $(".route_row").each(function () {
                        if($(this).attr("item_id") == route_id){
                            $(".route_number",this).html(route_number);
                            $(".route_name",this).html(route_name);
                            $(this).attr('route_number',route_number);
                            $(this).attr('route_name',route_name);
                        }
                    });

                    $("#cancel_route_edit_boby").click();
                } else {
                    message(message_text, status);
                }
            },
            error: function () {
            }
        });
    });

    // строчка в таблице водетелей
    $(document).on("click", ".owner_row", function () {
        owner_id = $(this).attr("item_id");
        $("#owner_edit_popup_surname").val($(this).attr("surname"));
        $("#owner_edit_popup_name").val($(this).attr("name"));
        $("#owner_edit_popup_second_name").val($(this).attr("patronymic"));
        $("#owner_edit_popup_phone").val($(this).attr("phone_one"));
        $("#owner_edit_popup_phone_2").val($(this).attr("phone_two"));
        $("#owner_edit_popup_button").click();
    });


    $(document).on("click", "#yes_owner_edit_boby", function () {
        var surname = $("#owner_edit_popup_surname").val();
        var name = $("#owner_edit_popup_name").val();
        var second_name = $("#owner_edit_popup_second_name").val();
        var phone = $("#owner_edit_popup_phone").val();
        var phone_2 = $("#owner_edit_popup_phone_2").val();
        $.ajax({
            type: "POST",
            url: "/buses_edit/owner_edit_save",
            data: {
                owner_id:owner_id,
                surname:surname,
                name:name,
                second_name:second_name,
                phone:phone,
                phone_2:phone_2
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var status = result.status;
                var message_text = result.message;
                var content = result.content

                if(status == 'ok'){
                    $(".owner_row").each(function () {
                        if($(this).attr("item_id") == owner_id){
                            $(".fio",this).html(surname  + " " + name  + " " + second_name);
                            $(".phone",this).html(phone  + " " + phone_2);
                            $(this).attr('surname',surname);
                            $(this).attr('name',name);
                            $(this).attr('patronymic',second_name);
                            $(this).attr('phone_one',phone);
                            $(this).attr('phone_two',phone_2);
                        }
                    });

                    $("#cancel_owner_edit_boby").click();
                } else {
                    message(message_text, status);
                }
            },
            error: function () {
            }
        });
    });


});
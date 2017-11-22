
$(document).ready(function() {
    var driver_id = 0;
    var bus_id = 0;
    var brand_of_bus = "";
    var gos_number = "";
    var owners_id = 0;
    var owners_surname = "";
    var owners_name = "";
    var owners_patronymic = "";
    var responsible = "";
    var owner_phone = "";
    var owner_phone_two = "";
    var employees_id = 0;
    var employee_surname = "";
    var employee_name = "";
    var employee_second_name = "";
    var driver_phone = "";
    var driver_phone_two = "";
    var route_id = 0;
    var route_number = "";
    var route_name = "";
    var company_id = 0;
    // инициализируем таблицу
    var table = $('#table1').DataTable({
        "language": {
            "url": "Russian.json"
        }
    });






    $(document).on("click", ".bus_row", function () {
        driver_id = $(this).attr("driver_id");
        $.ajax({
            type: "POST",
            url: "/buses/bus_row_edit",
            data: {
                driver_id:driver_id
            },
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                bus_id = result.bus_id;
                brand_of_bus = result.brand_of_bus;
                gos_number = result.gos_number;
                owners_id = result.owners_id;
                owners_surname = result.owners_surname;
                owners_name = result.owners_name;
                owners_patronymic = result.owners_patronymic;
                responsible = result.responsible;
                owner_phone = result.owner_phone;
                owner_phone_two = result.owner_phone_two;
                driver_id = result.driver_id;
                employees_id = result.employees_id;
                employee_surname = result.employee_surname;
                employee_name = result.employee_name;
                employee_second_name = result.employee_second_name;
                driver_phone = result.driver_phone;
                driver_phone_two = result.driver_phone_two;
                route_id = result.route_id;
                route_number = result.route_number;
                route_name = result.route_name;
                company_id = result.company_id;

                $("#edit_popup_brand_of_bus").val(brand_of_bus);
                $("#edit_popup_gos_number").val(gos_number);
                $("#edit_popup_owners_surname").val(owners_surname);
                $("#edit_popup_owners_name").val(owners_name);
                $("#edit_popup_owners_patronymic").val(owners_patronymic);
                $("#edit_popup_responsible").val(responsible);
                $("#edit_popup_owner_phone").val(owner_phone);
                $("#edit_popup_owner_phone_two").val(owner_phone_two);
                $("#edit_popup_employee_surname").val(employee_surname);
                $("#edit_popup_employee_name").val(employee_name);
                $("#edit_popup_employee_second_name").val(employee_second_name);
                $("#edit_popup_driver_phone").val(driver_phone);
                $("#edit_popup_driver_phone_two").val(driver_phone_two);
                $("#edit_popup_route_number").val(route_number);
                $("#edit_popup_route_name").val(route_name);


                    //var status = result.status;
                    //var report = result.message;
                    //message(report, status);
                $("#bus_row_edit_button").click();
            },
            error: function () {
            }
        });
    });
});
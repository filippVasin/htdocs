<div class="container">

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="table1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Марка автобуса</th>
                    <th>Номер автобуса</th>
                    <th>Ф.И.О. хозяина</th>
                    <th>Телефон хозяина</th>
                    <th>Ф.И.О. водителя</th>
                </tr>
                </thead>
                <tbody id="strings">


                %buses%



                </tbody>
                <tfoot>
                <tr>
                    <th>№</th>
                    <th>Марка автобуса</th>
                    <th>Номер автобуса</th>
                    <th>Ф.И.О. хозяина</th>
                    <th>Телефон хозяина</th>
                    <th>Ф.И.О. водителя</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



    <button id="bus_row_edit_button" class="btn btn-primary none" data-toggle="modal" data-target="#bus_row_edit">Кнопка</button>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="bus_row_edit" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Изменить данные?</h4>
                </div>
                <div class="modal-body" id="popup_report_emp_content" style="min-height: 90px">
                    <label>Марка автобуса:</label>
                    <input id="edit_popup_brand_of_bus" class="form-control">

                    <label>Гос.Номер:</label>
                    <input id="edit_popup_gos_number" class="form-control">

                    <label>Фирма/Фамилия владельца:</label>
                    <input id="edit_popup_owners_surname" class="form-control">

                    <label>Имя владельца:</label>
                    <input id="edit_popup_owners_name" class="form-control">

                    <label>Отчество владельца:</label>
                    <input id="edit_popup_owners_patronymic" class="form-control">

                    <label>Ответственное лицо:</label>
                    <input id="edit_popup_responsible" class="form-control">

                    <label>Телефон:</label>
                    <input id="edit_popup_owner_phone" class="form-control valid_phone">

                    <label>Телефон 2:</label>
                    <input id="edit_popup_owner_phone_two" class="form-control valid_phone">

                    <label>Фамилия водителя:</label>
                    <input id="edit_popup_employee_surname" class="form-control">

                    <label>Имя водителя:</label>
                    <input id="edit_popup_employee_name" class="form-control">

                    <label>Отчество водителя:</label>
                    <input id="edit_popup_employee_second_name" class="form-control">

                    <label>Телевой водителя:</label>
                    <input id="edit_popup_driver_phone" class="form-control valid_phone">

                    <label>Телефон водителя 2:</label>
                    <input id="edit_popup_driver_phone_two" class="form-control valid_phone">

                    <label>Номер маршрута:</label>
                    <input id="edit_popup_route_number" class="form-control">

                    <label>Название маршрута:</label>
                    <input id="edit_popup_route_name" class="form-control">


                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"  id="bus_row_edit_yes">Сохранить</button>
                    <button type="button" class="btn btn-default" id="cancel_add_new_item" data-dismiss="modal">Отмена</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
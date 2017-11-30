
<ul class="tab_menu">
    <li class="tab_click active_li" data="#bus_list">Автобусы</li>
    <li class="tab_click" data="#list_drivers">Водители</li>
    <li class="tab_click" data="#list_routes">Маршруты</li>
    <li class="tab_click" data="#list_owners">Владельцы</li>
</ul>


<div class="box">
    <!-- /.box-header -->
    <div class="box-body table_item" id="bus_list">
        <div class="table_title">Автобусы:</div>
        <table id="table_bus_list" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Марка</th>
                <th>Номер</th>
            </tr>
            </thead>
            <tbody id="strings">

            %bus_list%

            </tbody>

        </table>
    </div>

    <div class="box-body table_item none" id="list_drivers">
        <div class="table_title">Водители:</div>
        <table id="table_list_drivers" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>Телефон</th>
            </tr>
            </thead>
            <tbody id="strings">

            %bus_list_drivers%

            </tbody>

        </table>
    </div>

    <div class="box-body table_item none" id="list_owners">
        <div class="table_title">Владельцы:</div>
        <table id="table_bus_list_owners" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Марка</th>
                <th>Номер</th>
            </tr>
            </thead>
            <tbody id="strings">

            %bus_list_owners%

            </tbody>

        </table>
    </div>

    <div class="box-body table_item none" id="list_routes">
        <div class="table_title">Маршруты:</div>
        <table id="table_bus_list_routes" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Номер</th>
                <th>Название</th>
            </tr>
            </thead>
            <tbody id="strings">

            %bus_list_routes%

            </tbody>

        </table>
    </div>

</div>


<!-- Modal -->
<button id="bus_edit_popup_button" class="none" data-toggle="modal" data-target="#bus_edit_popup">
</button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="bus_edit_popup" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Редактировать автобус</h4>

            </div>

            <div class="modal-body" id="bus_edit_popup_boby">
                <label>Марка:</label>
                <input id="edit_popup_brand_of_bus" class="form-control">
                <label>Номер:</label>
                <input id="edit_popup_gos_number" class="form-control">
                <label>Маршрут:</label>
                <div class="select_triangle">
                    <select class="form-control"  id="bus_edit_popup_boby_select">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_bus_edit_boby" class="btn btn-primary">Сохранить</button>
                <button type="button"  id="cancel_bus_edit_boby" class="btn btn-default" data-dismiss="modal">Отмена</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<button id="driver_edit_popup_button" class="none" data-toggle="modal" data-target="#driver_edit_popup">
</button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="driver_edit_popup" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Редактировать Водителя</h4>

            </div>

            <div class="modal-body" id="driver_edit_popup_boby">
                <label>Фамилия:</label>
                <input id="edit_popup_surname" class="form-control">
                <label>Имя:</label>
                <input id="edit_popup_name" class="form-control">
                <label>Отчество:</label>
                <input id="edit_popup_second_name" class="form-control">
                <label>Телефон:</label>
                <input id="edit_popup_phone" class="form-control">
                <label>Телефон 2:</label>
                <input id="edit_popup_phone_2" class="form-control">
                <label>Автобус:</label>
                <div class="select_triangle">
                    <select class="form-control"  id="driver_edit_popup_bus_select">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_driver_edit_boby" class="btn btn-primary">Сохранить</button>
                <button type="button"  id="cancel_driver_edit_boby" class="btn btn-default" data-dismiss="modal">Отмена</button>

            </div>
        </div>
    </div>
</div>

<button id="route_edit_popup_button" class="none" data-toggle="modal" data-target="#route_edit_popup">
</button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="route_edit_popup" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Редактировать маршрут</h4>

            </div>

            <div class="modal-body" id="route_edit_popup_boby">
                <label>Марка:</label>
                <input id="edit_popup_route_number" class="form-control">
                <label>Номер:</label>
                <input id="edit_popup_route_name" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_route_edit_boby" class="btn btn-primary">Сохранить</button>
                <button type="button"  id="cancel_route_edit_boby" class="btn btn-default" data-dismiss="modal">Отмена</button>

            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<button id="owner_edit_popup_button" class="none" data-toggle="modal" data-target="#owner_edit_popup">
</button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" id="owner_edit_popup" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Редактировать Владельца</h4>
            </div>

            <div class="modal-body" id="owner_edit_popup_boby">
                <label>Фамилия:</label>
                <input id="owner_edit_popup_surname" class="form-control">
                <label>Имя:</label>
                <input id="owner_edit_popup_name" class="form-control">
                <label>Отчество:</label>
                <input id="owner_edit_popup_second_name" class="form-control">
                <label>Телефон:</label>
                <input id="owner_edit_popup_phone" class="form-control">
                <label>Телефон 2:</label>
                <input id="owner_edit_popup_phone_2" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_owner_edit_boby" class="btn btn-primary">Сохранить</button>
                <button type="button"  id="cancel_owner_edit_boby" class="btn btn-default" data-dismiss="modal">Отмена</button>

            </div>
        </div>
    </div>
</div>



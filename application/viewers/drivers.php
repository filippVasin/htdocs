<div class="box">
    <div class="button" id="print_drivers_table">Печать</div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="table1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>Дата рождения</th>
                <th>Адрес по регистрации</th>
                <th>Категория водит. удостоверения</th>
                <th>№ водит. удостоверения</th>
                <th>Срок действия вод.удостоверения</th>

            </tr>
            </thead>
            <tbody id="strings">

            %drivers_table%

            </tbody>

        </table>
    </div>
</div>



<button id="edit_popup_employees_button" class="none" data-toggle="modal" data-target="#edit_popup_employees">
</button>
<div class="modal fade" tabindex="-1" id="edit_popup_employees" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Сотрудник</h4>
            </div>
            <div class="modal-body">



                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" id="start_position" data-toggle="tab" aria-expanded="true">Основные данные</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Документы</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <label>Фамилия</label>
                            <input type="text" class="form-control tab_vs_enter_tab_one" id="edit_popup_input_surname" placeholder="Фамилия">

                            <label>Имя</label>
                            <input  class="form-control tab_vs_enter_tab_one" id="edit_popup_input_name" placeholder="Имя">

                            <label>Отчество</label>
                            <input  class="form-control tab_vs_enter_tab_one"  id="edit_popup_input_second_name" placeholder="Отчество">

                            <label>Дата трудоустройства</label>
                            <input type="text" class="form-control tab_vs_enter_tab_one"  id="edit_popup_input_start_date" placeholder="Дата трудоустройства">

                            <label>Дата рождения</label>
                            <input type="text" class="form-control tab_vs_enter_tab_one"  id="edit_popup_input_birthday" placeholder="Дата рождения">

                            <label>Статус</label>
                            <div class="select_triangle" >
                                <select class="form-control tab_vs_enter_tab_one"  id="edit_popup_input_status">
                                    <option value="0">Уволен</option>
                                    <option value="1">Работает</option>
                                </select>
                            </div>
                            <label>Табельный номер</label>
                            <input class="form-control tab_vs_enter_tab_one"  id="edit_popup_input_personnel_number" placeholder="Табельный номер">

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">

                            <label>Адрес регистрации</label>
                            <input type="text" class="form-control tab_vs_enter_tab_two" id="popup_reg_address" placeholder="Адрес регистрации">

                            <label>Категории</label>
                            <input  class="form-control tab_vs_enter_tab_two" id="popup_driver_categories" placeholder="Категории">

                            <label>№ удостоверения</label>
                            <input  class="form-control tab_vs_enter_tab_two"  id="popup_driver_number" placeholder="№ удостоверения">

                            <label>Начало действия</label>
                            <input type="text" class="form-control tab_vs_enter_tab_two"  id="popup_driver_start" placeholder="Начало действия">

                            <label>Срок действия</label>
                            <input type="text" class="form-control tab_vs_enter_tab_two"  id="popup_driver_end" placeholder="Срок действия">

                        </div>

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <div class="modal-footer">
                <button type="button"  id="save_popup_input_employees" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>


        </div>
    </div>
</div>

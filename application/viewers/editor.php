

<div id="table_titles">
    <div id="table_type_title">Тип</div>
    <div id="table_num_title">Справочник</div>
    <div id="table_employees_title">Сотрудники</div>
</div>

<div id="table_type" class="table_box">%table_type%</div>
<div id="table_num" class="table_box"  style="display: none">%table_num%</div>
<div id="table_employees" class="table_box"  style="display: none">

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="tableThree" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>login/e-mail</th>
                        <th>Сотрудник</th>
                    </tr>
                    </thead>
                <tbody>

                %mix_table%

                </tbody>
            </table>
        </div>
    </div>



</div>


<button id="edit_popup_button" class="none" data-toggle="modal" data-target="#edit_popup">
</button>

<div class="modal fade" tabindex="-1" id="edit_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<!--                <h4 class="modal-title" id="myModalLabel"> Можете поменять название:</h4>-->
            </div>
            <div class="modal-body">
                <input id="edit_popup_input" class="form-control" placeholder="">
            </div>
            <div class="modal-footer">
                <button type="button"  id="save_popup_input" class="btn btn-primary">Сохранить</button>
                <button type="button"  id="delete_popup_input" class="btn btn-primary">Удалить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
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
                <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#edit_popup_user">Сменить пароль</button>
                <button type="button"  id="delete_emp_mix" class="btn btn-primary">Уволить</button>
                <button type="button"  id="add_emp_mix" class="btn btn-primary">Восстановить в должности</button>
                <button type="button"  id="save_popup_input_employees" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>


        </div>
    </div>
</div>




<div class="modal fade" tabindex="-1" id="edit_popup_user" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"> Введите новый пароль два раза</h4>
            </div>
            <div class="modal-body check_pass">
                <input id="edit_popup_input_pass" class="form-control" placeholder="Пароль">
                <br>
                <input id="edit_popup_input_next_pass" class="form-control" placeholder="Ещё раз пароль">
            </div>
            <div class="modal-footer">
                <button type="button"  id="save_popup_input_user" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>





<button id="plus_type_button" class="none" data-toggle="modal" data-target="#plus_type">
</button>
<div class="modal fade" tabindex="-1" id="plus_type" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--                <h4 class="modal-title" id="myModalLabel"> Можете поменять название:</h4>-->
            </div>
            <div class="modal-body">
                <input id="plus_popup_input" class="form-control" placeholder="Введите новый тип">
            </div>
            <div class="modal-footer">
                <button type="button"  id="plus_type_popup" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>



<button id="plus_directory_button" class="none" data-toggle="modal" data-target="#plus_directory">
</button>
<div class="modal fade" tabindex="-1" id="plus_directory" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--                <h4 class="modal-title" id="myModalLabel"> Можете поменять название:</h4>-->
            </div>
            <div class="modal-body">
                <label>Выберите тип подразделений:</label>
                <div class="select_triangle">
                    <select class="form-control" id="select_node_item">

                    </select>
                </div>
                <br>
                <input id="plus_directory_popup_input" class="form-control" placeholder="Введите новую нуменклатуру">
            </div>
            <div class="modal-footer">
                <button type="button"  id="plus_directory_popup" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

<div id="nods_key" left="" right=""></div>
<div id="load_dashboard"></div>


<div class="col-lg-4 col-xs-12">
    <div class="box box-primary">
        <div class="box-header ui-sortable-handle" style="text-align: left;">
            <i class="ion ion-clipboard" ></i>

            <h3 class="box-title">Задачи</h3>


            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="search_local_alert_input"  name="table_search" class="form-control pull-right" placeholder="Поиск">

                    <div class="input-group-btn" id="search_local_alert">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body" style="padding: 1px;">
            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
            <ul class="todo-list ui-sortable" id="ul_alert_journal">
                %journal%
            </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            <button  id="link_docs_report" type="button" class="btn pull-right"> Все</button>
        </div>
    </div>
</div>

<div class="col-lg-4  col-xs-12">
    <div class="box box-primary">
        <div class="box-body no-padding">
            <!-- THE CALENDAR -->
            <div id="calendar" class="fc fc-unthemed fc-ltr">
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /. box -->
</div>




<div class="modal fade" tabindex="-1" id="alert_signature_docs_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Сотрудник:</h4>
            </div>
            <div class="modal-body">
                <div id="emp_report_name"></div>
                <div id="dolg_report_name"></div>
                <div id="dolg_report_dir"></div>
                <div class="popup_context_menu_title"> должен подписать документ: </div>
                <div id="docs_report_name"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_popup_3" class="btn btn-primary">Подписал</button>
                <button type="button" class="btn alert_cancel btn-default" data-dismiss="modal">Не подписал</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="alert_acception_docs_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Сотрудник:</h4>
            </div>
            <div class="modal-body">
                <div id="emp_acception_name"></div>
                <div id="dolg_acception_name"></div>
                <div id="dolg_acception_dir"></div>
                <div class="popup_context_menu_title"> должен сдать: </div>
                <div id="docs_acception_name"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_popup_4" class="btn btn-primary">Сдал</button>
                <button type="button" class="btn alert_cancel btn-default" data-dismiss="modal">Не сдал</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" tabindex="-1" id="alert_bailee_push_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ответственный:</h4>
            </div>
            <div class="modal-body">
                <div id="emp_bailee_push_name"></div>
                <div id="dolg_bailee_push_name"></div>
                <div id="dolg_bailee_push_dir"></div>
                <div class="popup_context_menu_title"> должен подписать документ: </div>
                <div id="docs_bailee_push_name"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_popup_14" class="btn btn-primary">Подписал</button>
                <button type="button" class="btn alert_cancel btn-default" data-dismiss="modal">Не подписал</button>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->
<button id="alert_bailee_push_popup_button" class="none" data-toggle="modal" data-target="#alert_bailee_push_popup">
</button>
<button id="alert_acception_docs_popup_button" class="none" data-toggle="modal" data-target="#alert_acception_docs_popup">
</button>
<button id="alert_signature_docs_popup_button" class="none" data-toggle="modal" data-target="#alert_signature_docs_popup">
</button>
<button id="popup_report_emp_button" class="none" data-toggle="modal" data-target="#popup_report_emp">
</button>
<button id="calendar_event_popup_button" class="none" data-toggle="modal" data-target="#calendar_event_popup">
</button>
<!--// отчёт по сотрудникам-->



<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="popup_report_emp" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <br>
                <h4 class="modal-title" >Отчёт по сотруднику</h4>
                <h4 class="modal-title" id = "popup_emp_fio"></h4>
                <h4 class="modal-title" id = "popup_emp_dol"></h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content" style="overflow-x: scroll;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  data-dismiss="modal">Закрыть</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" id="calendar_event_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Событие</h4>
            </div>
            <div class="modal-body" id="calendar_event_popup_data">

            </div>
            <div class="modal-footer">
                <!--                <button type="button" id="yes_popup_3" class="btn btn-primary">Подписал</button>-->
                <button type="button" class="btn alert_cancel btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<button id="alert_create_driver_popup_button" class="none" data-toggle="modal" data-target="#alert_create_driver_popup">
</button>
<!-- Modal -->
<div class="modal fade" tabindex="-1" id="alert_create_driver_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Водитель:</h4>
            </div>
            <div class="modal-body">
                <div id="driver_name_popup"></div>
                <div class="popup_context_menu_title"> Прошел медосмотр? </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_popup_17" class="btn btn-primary">Прошел</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Не прошел</button>

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
                        <li class=""><a href="#tab_1" id="start_position" data-toggle="tab" aria-expanded="true">Основные данные</a></li>
                        <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Документы</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane " id="tab_1">

                            <label>Фамилия</label>
                            <input type="text" class="form-control" id="edit_popup_input_surname" placeholder="Фамилия">

                            <label>Имя</label>
                            <input  class="form-control" id="edit_popup_input_name" placeholder="Имя">

                            <label>Отчество</label>
                            <input  class="form-control"  id="edit_popup_input_second_name" placeholder="Отчество">

                            <label>Дата трудоустройства</label>
                            <input type="text" class="form-control"  id="edit_popup_input_start_date" placeholder="Дата трудоустройства">

                            <label>Дата рождения</label>
                            <input type="text" class="form-control"  id="edit_popup_input_birthday" placeholder="Дата рождения">

                            <label>Статус</label>
                            <div class="select_triangle" >
                                <select class="form-control "  id="edit_popup_input_status">
                                    <option value="0">Уволен</option>
                                    <option value="1">Работает</option>
                                </select>
                            </div>
                            <label>Табельный номер</label>
                            <input class="form-control"  id="edit_popup_input_personnel_number" placeholder="Табельный номер">

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="tab_2">

                            <label>Адрес регистрации</label>
                            <input type="text" class="form-control" id="popup_reg_address" placeholder="Адрес регистрации">

                            <label>Категории</label>
                            <input  class="form-control" id="popup_driver_categories" placeholder="Категории">

                            <label>№ удостоверения</label>
                            <input  class="form-control"  id="popup_driver_number" placeholder="№ удостоверения">

                            <label>Начало действия</label>
                            <input type="text" class="form-control"  id="popup_driver_start" placeholder="Начало действия">

                            <label>Срок действия</label>
                            <input type="text" class="form-control"  id="popup_driver_end" placeholder="Срок действия">

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



<button id="alert_print_probationer_button" class="none" data-toggle="modal" data-target="#alert_print_probationer">
</button>
<!-- Modal -->
<div class="modal fade" tabindex="-1" id="alert_print_probationer" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Отправить:</h4>
            </div>
            <div class="modal-body">
                <div id="print_probationer_popup_name"></div>
                <div class="popup_context_menu_title"> На стажировку?</div>
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_popup_18" class="btn btn-primary">Отправить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<button id="alert_probation_actoin_popup_button" class="none" data-toggle="modal" data-target="#alert_probation_actoin_popup">
</button>
<div class="modal fade" tabindex="-1" id="alert_probation_actoin_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Водитель:</h4>
            </div>
            <div class="modal-body">
                <div id="driver_probation_actoin_popup"></div>
                <div class="popup_context_menu_title">Прошел стражировку?</div>
            </div>
            <div class="modal-footer">
                <button type="button" id="yes_popup_19" class="btn btn-primary">Прошел</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Не прошел</button>

            </div>
        </div>
    </div>
</div>
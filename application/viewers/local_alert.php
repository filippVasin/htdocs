<div class="container">

    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" id="datepicker_from" placeholder="От" value="%date_from%">
    </div>

    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" id="datepicker_to" placeholder="До" value="%date_to%">
    </div>


    <div class="button" id="reset"  style="float: left;" id="rebut_node_docs">Сброс</div>
    <div class="button" style="float: left;" id="node_docs" data-toggle="modal" data-target="#popup_context_menu_update">Выбор подразделения</div>
    <div id="select">
    </div>


    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="table1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>ФИО</th>
                    <th>Отдел</th>
                    <th>Должность</th>
                    <th>Имя документа</th>
                    <th>Действие</th>
                    <th>Шаг</th>
                    <th>Зафиксирован</th>

                </tr>
                </thead>
                <tbody id="strings">

                %forms%

                </tbody>

            </table>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="popup_context_menu_update" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Выберите интересуемое подразделение:</h4>
                </div>
                <div class="modal-body" id="popup_update_tree">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <button id="alert_bailee_push_popup_button" class="none" data-toggle="modal" data-target="#alert_bailee_push_popup">
    </button>
    <button id="alert_acception_docs_popup_button" class="none" data-toggle="modal" data-target="#alert_acception_docs_popup">
    </button>
    <button id="alert_signature_docs_popup_button" class="none" data-toggle="modal" data-target="#alert_signature_docs_popup">
    </button>
    <button id="alert_create_driver_popup_button" class="none" data-toggle="modal" data-target="#alert_create_driver_popup">
    </button>


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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Не подписал</button>

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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Не сдал</button>

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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Не подписал</button>

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
                                <div title="Дата устройства" class="bef_input">
                                    <input type="text" class="form-control"  id="popup_driver_start" placeholder="Начало действия">
                                </div>
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
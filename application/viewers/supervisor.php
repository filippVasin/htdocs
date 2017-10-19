
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Секретари</a></li>
        <li><a href="#tab_2" data-toggle="tab">Администраторы</a></li>

        <li class="pull-right"><button id="add_department_form_button" class="btn btn-default" data-toggle="modal" data-target="#add_department_form">
            <i class="fa fa-gear"></i></button></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <section class="content" id="selector_box">
                %select_list%
            </section>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <section class="content" id="admin_box">
                %admin_list%
            </section>
        </div>

        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->





<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="add_department_form" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Добавляем смотрящего</h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content" style="min-height: 90px">
                <div class="form-group">
                    <label>Тип</label>
                    <div class="select_triangle">
                        <select class="form-control " id="select_type_pluse">
                            <option value= "0" ></option>
                            <option value= "1" >Администратора</option>
                            <option value= "4" >Секретаря</option>
                        </select>
                    </div>
                </div>


                <div class="form-group none" id="plus_dol">
                    <label>Выберите администратора:</label>
                    <div class="select_triangle">
                        <select class="form-control" id="select_admin_item">

                        </select>
                    </div>
                </div>

                <div class="form-group none" id="plus_node">
                    <label>Выберите секретаря:</label>
                    <div class="select_triangle">
                        <select class="form-control" id="select_select_item">

                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  id="add_new_item">Добавить</button>
                <button type="button" class="btn btn-default" id="cancel_add_new_item" data-dismiss="modal">Отмена</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<button id="select_company_list_popup_button" class="btn btn-default none" data-toggle="modal" data-target="#select_company_list_popup"></button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="select_company_list_popup" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Прикрепить компанию</h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content" style="min-height: 90px">
                <div class="form-group">
                    <label>Компания:</label>
                    <div class="select_triangle">
                        <select class="form-control " id="select_company_list">

                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  id="add_new_item_company">Прикрепить</button>
                <button type="button" class="btn btn-default" id="cancel_add_new_item_company" data-dismiss="modal">Отмена</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<button id="delete_observer_popup_button" class="btn btn-default none" data-toggle="modal" data-target="#delete_observer_popup"></button>
<div class="modal fade modal-warning bs-example-modal-lg" tabindex="-1" role="dialog" id="delete_observer_popup" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Удаление элемента</h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content">
                Вы правда хотите удалить наблюдателя?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"  id="delete_observer_yes">Удалить</button>
                <button type="button" class="btn btn-outline" id="delete_observer_cancel" data-dismiss="modal">Отмена</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<button id="delete_company_popup_button" class="btn btn-default none" data-toggle="modal" data-target="#delete_company_popup"></button>
<div class="modal fade modal-warning bs-example-modal-lg" tabindex="-1" role="dialog" id="delete_company_popup" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Удаление компании</h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content">
                Вы правда хотите убрать наблюдение за компанией?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"  id="delete_company_yes">Убрать</button>
                <button type="button" class="btn btn-outline" id="delete_company_cancel" data-dismiss="modal">Отмена</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<? header('Content-Type: text/html; charset=utf-8');?>

<div id="login_form">
    %select%
    <br>

    <div class="button" id="tree_down">Отобразить подразделение</div>
    <div class="button" id="tree_up">Главное подразделение</div>
    <div class="button" id="whole_branch">Все подразделения</div>
    <div class="button" id="whole_tree">Вся организация</div>
   <br>
    <div id="test_block" style="display: none; text-align: left;"><div id="content_box"></div></div>
</div>


<button id="add_department_form_button" class="btn btn-primary none" data-toggle="modal" data-target="#add_department_form">Добавить новую структуру
</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="add_department_form" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Добавляем новый элемент</h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content" style="min-height: 90px">
                <div class="form-group">
                    <label>Тип</label>
                    <div class="select_triangle">
                        <select class="form-control " id="select_type_pluse">
                            <option value= "0" ></option>
                            <option value= "1" >Должность</option>
                            <option value= "2" >Подразделение</option>
                        </select>
                    </div>
                </div>


                <div class="form-group none" id="plus_dol">
                    <label>Выберите доступную должность:</label>
                    <div class="select_triangle">
                        <select class="form-control" id="select_dol_item">

                        </select>
                    </div>
                </div>

                <div class="form-group none" id="plus_node">
                    <label>Выберите тип подразделений:</label>
                    <div class="select_triangle">
                        <select class="form-control" id="select_node_item">

                        </select>
                    </div>
                </div>
                <div class="form-group none" id="plus_node_kladr">
                    <label>Выберите нуменклатуру:</label>
                    <div class="select_triangle">
                        <select class="form-control" id="select_kladr_item">

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



<div class="update_employees_box">%update_employees_table_box%</div>




<button id="popup_context_menu_button" class="none" data-toggle="modal" data-target="#popup_context_menu">
</button>
<div class="modal fade" tabindex="-1" id="popup_context_menu" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Что сделать с</h4>
            </div>
            <div class="modal-body">
                <div id="subscript_context_menu_popup"></div>
            </div>
            <div class="modal-footer">

                <button type="button"  id="update_popup_context_menu" class="btn btn-primary">Поменять должность</button>
                <button type="button"  id="delete_popup_context_menu" class="btn btn-warning">Уволить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>


<button id="popup_context_menu_delete_button" class="none" data-toggle="modal" data-target="#popup_context_menu_delete">
</button>

<div class="modal modal-warning fade in" id="popup_context_menu_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Вы действительно хотите уволить сотрудника -</h4>
            </div>
            <div class="modal-body">
                <div id="subscript_context_menu_popup_delete"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" id="delete_employee_popup_context_menu">Да</button>
                <button type="button" class="btn btn-outline " data-dismiss="modal">Отмена</button>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" tabindex="-1" id="popup_context_menu" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Что сделать с</h4>
            </div>
            <div class="modal-body">
                <div id="subscript_context_menu_popup"></div>
            </div>
            <div class="modal-footer">

                <button type="button"  id="update_popup_context_menu" class="btn btn-primary">Поменять должность</button>
                <button type="button"  id="delete_popup_context_menu" class="btn btn-warning">Уволить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>



<!--<div id="popup_context_menu_update">-->
<!--    <div class="canvas">-->
<!--        <div class="popup_context_menu_title"> Выберите новую должность для сотрудника: </div>-->
<!--        <div id="subscript_context_menu_popup_update"></div>-->
<!--        <div id="popup_update_tree"></div>-->
<!--        <div class="button_row">-->
<!--            <div class="button cancel_popup">Отмена</div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->

<button id="popup_context_menu_update_button" class="none" data-toggle="modal" data-target="#popup_context_menu_update">
</button>
<!--// отчёт по сотрудникам-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="popup_context_menu_update" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Выберите новую должность для сотрудника:</h4>
                <div id="subscript_context_menu_popup_update"></div>
            </div>
            <div class="modal-body" id="popup_update_tree">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  data-dismiss="modal">Отмена</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






<button id="popup_update_select_position_button" class="none" data-toggle="modal" data-target="#popup_update_select_position">
</button>
<div class="modal fade" tabindex="-1" id="popup_update_select_position" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Вы правда хотите перевести сотрудника:</h4>
            </div>
            <div class="modal-body">
                <div id="subscript_select_position_employee"></div>
                <div class="popup_context_menu_title"> с: </div>
                <div id="subscript_old_position_position"></div>
                <div class="popup_context_menu_title"> на: </div>
                <div id="subscript_select_position_position"></div>
            </div>
            <div class="modal-footer">

                <button type="button"  id="popup_update_select_position_yes" class="btn btn-primary">Да</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>




<div id="popup_delete_employee_result">
    <div class="canvas" style="height: 130px;box-sizing: border-box;">
        <div id="popup_context_menu_title_result"></div>
        <div class="button_row">
            <div class="button cancel_popup_reload">Ок</div>
        </div>
    </div>
</div>

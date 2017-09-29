
<div class="container box">
    <div class="button" style="float: right" id="rebut_node_docs">Сброс</div>
    <div class="button" style="float: right" id="node_docs" data-toggle="modal" data-target="#popup_context_menu_update">Выбор подразделения</div>
    <select class="target " id="node_docs_select" style="float:left;width:200px;">

    </select>
    <div class="list" style="clear: both">
        <div class="header">
            <div class="number">№</div>
            <div class="otdel">Отдел</div>
            <div class="position">Должность</div>
            <div class="fio">ФИО</div>
            <div class="manual_name">Наименование Инструкции</div>
            <div class="start_date"> Начало прохождения</div>
            <div class="end_date">Окончание прохождения</div>
        </div>
        <div class="value" id="strings">


        </div>
    </div>


    <div id="action_history_docs_popup">
        <div class="canvas">
            <div id="emp_report_name"></div>
            <div id="dolg_report_name"></div>
            <div class="popup_context_menu_title"> Шаги по документу: </div>
            <div id="docs_report_name"></div>
            <div id="popup_action_list"></div>
            <div class="button_row">
                <div class="button cancel_popup">Ок</div>
            </div>
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

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


    <div class="button" id="reset"  style="float: right" id="rebut_node_docs">Сброс</div>
    <div class="button" style="float: right" id="node_docs" data-toggle="modal" data-target="#popup_context_menu_update">Выбор подразделения</div>
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
                    <th>Наименование Документа</th>
                    <th>Тип документа</th>
                    <th>Действия</th>
                    <th>Статус документа</th>
                    <th>Дата изменения</th>
                </tr>
                </thead>
                <tbody id="strings">


                %forms%



                </tbody>
                <tfoot>
                <tr>
                    <th>№</th>
                    <th>ФИО</th>
                    <th>Отдел</th>
                    <th>Должность</th>
                    <th>Наименование Документа</th>
                    <th>Тип документа</th>
                    <th>Действия</th>
                    <th>Статус документа</th>
                    <th>Дата изменения</th>
                </tr>
                </tfoot>
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




    <button id="action_history_docs_popup_button" class="none" data-toggle="modal" data-target="#action_history_docs_popup">
    </button>
    <!--// отчёт по сотрудникам-->

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="action_history_docs_popup" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Отчёт по документу</h4>
                </div>
                <div class="modal-body" id="popup_action_list">

                </div>
                <div class="modal-footer">
                    <button type="button" id="open_doc_popup" class="btn btn-primary">Открыть документ</button>
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Закрыть карточку</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
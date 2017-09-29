
<div class="container">
    <div class="button" style="float: right" id="rebut_node_docs">Сброс</div>
    <div class="button" style="float: right" id="node_docs" data-toggle="modal" data-target="#popup_context_menu_update">Выбор подразделения</div>
    <select class="target  select_styte" id="node_docs_select" style="float:left;width:200px;margin-top:15px;">

    </select>

    <select class="target_em select_styte" id="node_docs_select_em" style="float:left;width:200px;margin-top:15px;">

    </select>
    <div class="date_time">
        <div> С какого числа: </div>
        <input type="text" name="date" class="tcal" id="time_from" value="" />
        <div> По какое  число: </div>
        <input type="text" name="date" class="tcal" id="time_to" value="" />
    </div>
    <div class="list" style="clear: both">
        <div class="header">
            <div class="number_doc">№</div>
            <div class="fio order_by" groupe="emp">ФИО</div>
            <div class="otdel">Отдел</div>
            <div class="position order_by" groupe="pos">Должность</div>
            <div class="doc_name">Имя документа</div>
            <div class="doc_type">Действие</div>
            <div class="status">Шаг</div>
            <div class="status_date">Зафиксирован</div>

        </div>
        <div class="value" id="strings">


        </div>
    </div>



<!--    <div id="alert_signature_docs_popup" class="none">-->
<!--        <div class="canvas">-->
<!---->
<!--            <div class="popup_context_menu_title"> Сотрудник: </div>-->
<!--            <div id="emp_report_name"></div>-->
<!--            <div id="dolg_report_name"></div>-->
<!--            <div id="dolg_report_dir"></div>-->
<!--            <div class="popup_context_menu_title"> должен подписать документ: </div>-->
<!--            <div id="docs_report_name"></div>-->
<!--            <div class="button_row">-->
<!--                <div class="button" id="yes_popup_3">Подписал</div>-->
<!--                <div class="button cancel_popup">Не подписал</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!---->
<!--    <div id="alert_acception_docs_popup" class="none">-->
<!--        <div class="canvas">-->
<!---->
<!--            <div class="popup_context_menu_title"> Сотрудник: </div>-->
<!--            <div id="emp_acception_name"></div>-->
<!--            <div id="dolg_acception_name"></div>-->
<!--            <div id="dolg_acception_dir"></div>-->
<!--            <div class="popup_context_menu_title"> должен сдать: </div>-->
<!--            <div id="docs_acception_name"></div>-->
<!--            <div class="button_row">-->
<!--                <div class="button" id="yes_popup_4">Сдал</div>-->
<!--                <div class="button cancel_popup">Не сдал</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!---->
<!---->
<!--    <div id="alert_bailee_push_popup" class="none">-->
<!--        <div class="canvas">-->
<!---->
<!--            <div class="popup_context_menu_title"> Ответственный: </div>-->
<!--            <div id="emp_bailee_push_name"></div>-->
<!--            <div id="dolg_bailee_push_name"></div>-->
<!--            <div id="dolg_bailee_push_dir"></div>-->
<!--            <div class="popup_context_menu_title"> должен подписать документ: </div>-->
<!--            <div id="docs_bailee_push_name"></div>-->
<!--            <div class="button_row">-->
<!--                <div class="button" id="yes_popup_14">Подписал</div>-->
<!--                <div class="button cancel_popup">Не подписал</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Не подписал</button>
                    <button type="button" id="yes_popup_3" class="btn btn-primary">Подписал</button>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Не сдал</button>
                    <button type="button" id="yes_popup_4" class="btn btn-primary">Сдал</button>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Не подписал</button>
                    <button type="button" id="yes_popup_14" class="btn btn-primary">Подписал</button>
                </div>
            </div>
        </div>
    </div>

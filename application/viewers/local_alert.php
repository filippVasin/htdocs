
<div class="container">
    <div class="button" style="float: right" id="rebut_node_docs">Сброс</div>
    <div class="button" style="float: right" id="node_docs">Выбор подразделения</div>
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



    <div id="alert_signature_docs_popup" class="none">
        <div class="canvas">

            <div class="popup_context_menu_title"> Сотрудник: </div>
            <div id="emp_report_name"></div>
            <div id="dolg_report_name"></div>
            <div id="dolg_report_dir"></div>
            <div class="popup_context_menu_title"> должен подписать документ: </div>
            <div id="docs_report_name"></div>
            <div class="button_row">
                <div class="button" id="yes_popup_3">Подписал</div>
                <div class="button cancel_popup">Не подписал</div>
            </div>
        </div>
    </div>



    <div id="popup_context_menu_update">
        <div class="canvas">
            <div class="popup_context_menu_title">Выберите интересуемое подразделение: </div>
            <div id="popup_update_tree"></div>
            <div class="button_row">
                <div class="button cancel_popup">Отмена</div>
            </div>
        </div>
    </div>

    <div id="alert_acception_docs_popup" class="none">
        <div class="canvas">

            <div class="popup_context_menu_title"> Сотрудник: </div>
            <div id="emp_acception_name"></div>
            <div id="dolg_acception_name"></div>
            <div id="dolg_acception_dir"></div>
            <div class="popup_context_menu_title"> должен сдать: </div>
            <div id="docs_acception_name"></div>
            <div class="button_row">
                <div class="button" id="yes_popup_4">Сдал</div>
                <div class="button cancel_popup">Не сдал</div>
            </div>
        </div>
    </div>



    <div id="alert_bailee_push_popup" class="none">
        <div class="canvas">

            <div class="popup_context_menu_title"> Ответственный: </div>
            <div id="emp_bailee_push_name"></div>
            <div id="dolg_bailee_push_name"></div>
            <div id="dolg_bailee_push_dir"></div>
            <div class="popup_context_menu_title"> должен подписать документ: </div>
            <div id="docs_bailee_push_name"></div>
            <div class="button_row">
                <div class="button" id="yes_popup_14">Подписал</div>
                <div class="button cancel_popup">Не подписал</div>
            </div>
        </div>
    </div>
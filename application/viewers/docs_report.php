
<div class="container">
    <div class="button" style="float: right" id="rebut_node_docs">Сброс</div>
    <div class="button" style="float: right" id="node_docs">Выбор подразделения</div>
        <select class="target " id="node_docs_select" style="float:left;width:200px;">
    </select>
    <select class="target " id="node_docs_status_select" style="float:left;width:200px;">
    </select>
<div class="list" style="clear: both">
    <div class="header">
        <div class="number_doc">№</div>
        <div class="fio">ФИО</div>
        <div class="otdel">Отдел</div>
        <div class="position">Должность</div>
        <div class="doc_name">Наименование Документа</div>
        <div class="doc_type">Тип документа</div>
        <div class="action">Действия</div>
        <div class="status">Статус документа</div>
        <div class="status_date">Дата изменения</div>

    </div>
    <div class="value" id="strings" style="clear: both;">


    </div>
</div>

    <div id="popup_context_menu_update">
        <div class="canvas">
            <div class="popup_context_menu_title"> Выберите интересуемое подразделение: </div>
            <div id="popup_update_tree"></div>
            <div class="button_row">
                <div class="button cancel_popup">Отмена</div>
            </div>
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
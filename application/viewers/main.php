<div
<div id="nods_key" left="" right=""></div>
<div id="load_dashboard"></div>

<div id="popup_context_menu_update" class="none">
    <div class="canvas">
        <div class="popup_context_menu_title"> Выберите интересуемое подразделение: </div>
        <div id="popup_update_tree"></div>
        <div class="button_row">
            <div class="button" id="cancel_popup" >Отмена</div>
            <div class="button" id="all_node_popup" >Все отделы</div>
        </div>
    </div>
</div>

<div id="popup_report_emp" class="none">
    <div class="canvas">
        <div id="popup_report_emp_title"> Отчёт по сотруднику </div>
        <div id="popup_report_emp_content"></div>
        <div class="button_row bottom">
            <div class="button" id="ok_popup_report_emp" >OK</div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
<div class="box box-primary">
    <div class="box-header ui-sortable-handle" style="cursor: move;    text-align: left;">
        <i class="ion ion-clipboard" ></i>

        <h3 class="box-title">Задачи</h3>

<!--        <div class="box-tools pull-right">-->
<!--            <ul class="pagination pagination-sm inline">-->
<!--                <li><a href="#">«</a></li>-->
<!--                <li><a href="#">1</a></li>-->
<!--                <li><a href="#">2</a></li>-->
<!--                <li><a href="#">3</a></li>-->
<!--                <li><a href="#">»</a></li>-->
<!--            </ul>-->
<!--        </div>-->

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
        <button  id="link_docs_report" type="button" class="btn btn-default pull-right"> Все</button>
    </div>
</div>
</div>

<div class="col-lg-5  col-xs-12">
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
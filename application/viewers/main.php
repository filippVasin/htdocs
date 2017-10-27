<div
<div id="nods_key" left="" right=""></div>
<div id="load_dashboard"></div>


<div class="col-lg-4 col-xs-12">
<div class="box box-primary">
    <div class="box-header ui-sortable-handle" style="text-align: left;">
        <i class="ion ion-clipboard" ></i>

        <h3 class="box-title">Задачи</h3>


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

<div class="col-lg-4  col-xs-12">
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
                <button type="button" class="btn alert_cancel btn-default" data-dismiss="modal">Не подписал</button>
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
                <button type="button" class="btn alert_cancel btn-default" data-dismiss="modal">Не сдал</button>
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
                <button type="button" class="btn alert_cancel btn-default" data-dismiss="modal">Не подписал</button>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->
<button id="alert_bailee_push_popup_button" class="none" data-toggle="modal" data-target="#alert_bailee_push_popup">
</button>
<button id="alert_acception_docs_popup_button" class="none" data-toggle="modal" data-target="#alert_acception_docs_popup">
</button>
<button id="alert_signature_docs_popup_button" class="none" data-toggle="modal" data-target="#alert_signature_docs_popup">
</button>
<button id="popup_report_emp_button" class="none" data-toggle="modal" data-target="#popup_report_emp">
</button>
<button id="calendar_event_popup_button" class="none" data-toggle="modal" data-target="#calendar_event_popup">
</button>
<!--// отчёт по сотрудникам-->



<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="popup_report_emp" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <br>
                <h4 class="modal-title" >Отчёт по сотруднику</h4>
                <h4 class="modal-title" id = "popup_emp_fio"></h4>
                <h4 class="modal-title" id = "popup_emp_dol"></h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content" style="overflow-x: scroll;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  data-dismiss="modal">Закрыть</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" tabindex="-1" id="calendar_event_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Событие</h4>
            </div>
            <div class="modal-body" id="calendar_event_popup_data">

            </div>
            <div class="modal-footer">
<!--                <button type="button" id="yes_popup_3" class="btn btn-primary">Подписал</button>-->
                <button type="button" class="btn alert_cancel btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

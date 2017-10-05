

<div class="button" id="show_add_company_form" style="width: 250px;">Добавить новую компанию</div>

<div id="add_department_form" style="display: none;">
<br>
    <div class="caption" style="margin-top: 5px;">Наименование новой компании</div>
    <input type="text" id="new_company_name" class="input" style="text-align: center;"><br>

    <div class="caption" style="margin-top: 5px;">Краткое наименование</div>
    <input type="text" id="new_company_short_name" class="input" style="text-align: center;"><br>

    <div class="caption" style="margin-top: 5px;">Фамилия директора</div>
    <input type="text" id="new_company_director_surname" class="input" style="text-align: center;"><br>

    <div class="caption" style="margin-top: 5px;">Имя директора</div>
    <input type="text" id="new_company_director_name" class="input" style="text-align: center;"><br>

    <div class="caption" style="margin-top: 5px;">Отчество директора</div>
    <input type="text" id="new_company_director_second_name" class="input" style="text-align: center;"><br>

    <div class="button" id="add_new_company">Добавить</div>
</div>

<br>
<br>

<div id="company_list" align="center">
    %company_list%
</div>




<!--<div id="add_test_users_couple" class="button">Получить тестировщика</div>-->

<!--<div id="plus_test_users_couple" class="none">-->
<!--    <div class="canvas">-->
<!--        <span>Добавить пару тестировщиков?</span>-->
<!--        <div class="users"></div>-->
<!---->
<!--        <div class="mail_input">-->
<!--            <div>Отправить на почту</div>-->
<!--            <input type="text" id="plus_test_users_couple_input" placeholder="email">-->
<!--        </div>-->
<!--        <div class="button_row">-->
<!--            <div class="button" id="ok_test_users_couple">Создать</div>-->
<!--            <div class="button" id="cancel_test_users_couple">Отмена</div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<button id="add_test_users_couple" class="btn btn-primary" data-toggle="modal" data-target="#popup_report_emp">Получить тестировщика
</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="popup_report_emp" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Добавить пару тестировщиков?</h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content" style="min-height: 90px">
                <div class="users"></div>
                <input type="text" class="form-control" id="plus_test_users_couple_input" placeholder="email">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  id="create_test_users_couple">Создать</button>
                <button type="button" class="btn btn-default" id="cancel_test_users_couple" data-dismiss="modal">Отмена</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


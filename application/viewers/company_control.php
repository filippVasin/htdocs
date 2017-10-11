
<!---->
<!--<div class="button" id="show_add_company_form" style="width: 250px;">Добавить новую структуру</div>-->
<!---->
<!--<div id="add_department_form" style="display: none;">-->
<!--<br>-->
<!--    <div class="caption" style="margin-top: 5px;">Наименование новой компании</div>-->
<!--    <input type="text" id="new_company_name" class="input" style="text-align: center;"><br>-->
<!---->
<!--    <div class="caption" style="margin-top: 5px;">Краткое наименование</div>-->
<!--    <input type="text" id="new_company_short_name" class="input" style="text-align: center;"><br>-->
<!---->
<!--    <div class="caption" style="margin-top: 5px;">Фамилия директора</div>-->
<!--    <input type="text" id="new_company_director_surname" class="input" style="text-align: center;"><br>-->
<!---->
<!--    <div class="caption" style="margin-top: 5px;">Имя директора</div>-->
<!--    <input type="text" id="new_company_director_name" class="input" style="text-align: center;"><br>-->
<!---->
<!--    <div class="caption" style="margin-top: 5px;">Отчество директора</div>-->
<!--    <input type="text" id="new_company_director_second_name" class="input" style="text-align: center;"><br>-->
<!---->
<!--    <div class="button" id="add_new_company">Добавить</div>-->
<!--</div>-->
<!---->
<!--<br>-->
<!--<br>-->

<button id="add_department_form_button" class="btn btn-primary" data-toggle="modal" data-target="#add_department_form">Добавить новую структуру
</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="add_department_form" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Добавляем новую структуру</h4>
            </div>
            <div class="modal-body" id="popup_report_emp_content" style="min-height: 90px">
                <div class="form-group">
                    <label>Тип</label>
                    <select class="form-control" id="select_type_company">
                        <option value=0></option>
                        <option value="Организация">Организация</option>
                        <option value="Группа Компаний">Группа Компаний</option>
                    </select>
                </div>
                <div class="form-group none" id="group_companys">
                    <label>Наименование Группы Компаний</label>
                    <input type="text" class="form-control" id="new_group_company_name" placeholder="Наименование Группы Компаний">
                </div>

                <div class="form-group none" id="item_company">

                    <label>Связи:</label>
                    <select class="form-control" id="select_group_company">
                        <option value=0></option>
                        <option value="Компания сама по себе">Компания сама по себе</option>
                        <option value="Компания в составе Группы">Компания в составе Группы</option>
                    </select>

                    <div class="form-group none" id="select_group_companys_item_box">
                        <label>Группа Компаний:</label>
                        <select class="form-control" id="select_group_companys_item">

                        </select>
                    </div>

                    <label>Наименование новой компании</label>
                    <input type="text" class="form-control" id="new_company_name" placeholder="Наименование новой компании">

                    <label>Краткое наименование</label>
                    <input type="text" class="form-control" id="new_company_short_name" placeholder="Краткое наименование">

                    <label>Фамилия директора</label>
                    <input type="text" class="form-control" id="new_company_director_surname" placeholder="Фамилия директора">

                    <label>Имя директора</label>
                    <input type="text" class="form-control" id="new_company_director_name" placeholder="Имя директора">

                    <label>Отчество директора</label>
                    <input type="text" class="form-control" id="new_company_director_second_name" placeholder="Отчество директора">

                    <label>Электронная почта</label>
                    <input type="email" class="form-control" id="new_company_director_email" placeholder="Электронная почта">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  id="add_new_company">Добавить</button>
                <button type="button" class="btn btn-default" id="cancel_add_new_company" data-dismiss="modal">Отмена</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="company_list" align="center">
    %company_list%
</div>



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
                <input type="email" class="form-control" id="plus_test_users_couple_input" placeholder="email">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  id="create_test_users_couple">Создать</button>
                <button type="button" class="btn btn-default" id="cancel_test_users_couple" data-dismiss="modal">Отмена</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


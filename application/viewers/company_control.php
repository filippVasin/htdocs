<div class="page_title">Управление компаниями</div>

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

<div id="add_test_users_couple" class="button">Получить тестировщика</div>

<div id="plus_test_users_couple" class="none">
    <div class="canvas">
        <span>Добавить пару тестировщиков?</span>
        <div class="users"></div>

        <div class="mail_input">
            <div>Отправить на почту</div>
            <input type="text" id="plus_test_users_couple_input" placeholder="email">
        </div>
        <div class="button_row">
            <div class="button" id="ok_test_users_couple">Создать</div>
            <div class="button" id="cancel_test_users_couple">Отмена</div>
        </div>
    </div>
</div>


<!---->
<!--Введите текст: <input type='text' id='input' /> <input type='button' id='bCopy' value='Copy!' /><br />-->
<!--<span id='log'></span>-->
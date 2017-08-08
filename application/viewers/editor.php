<div class="page_title">Редактор</div>

<div id="table_titles">
    <div id="table_type_title">Тип</div>
    <div id="table_num_title">Справочник</div>
    <div id="table_employees_title">Сотрудники</div>
    <div id="table_user_title">Users</div>
</div>

<div id="table_type" class="table_box" >%table_type%</div>
<div id="table_num" class="table_box"  style="display: none">%table_num%</div>
<div id="table_employees" class="table_box"  style="display: none">%table_employees%</div>
<div id="table_user" class="table_box" style="display: none">%table_type_user%</div>





<div id="edit_popup">
    <div class="canvas">
        <input type="text" id="edit_popup_input" placeholder="">
        <div class="button_row">
            <div class="button" id="save_popup_input">Сохранить</div>
            <div class="button" id="cancel_popup_input">Отмена</div>
        </div>
    </div>
</div>


<div id="edit_popup_employees" item_id="">
    <div class="canvas" style="padding-top: 30px; box-sizing: border-box;">
    <div style="position: absolute; top: 20px; left: 48px">ID: <span id="title_employees_item_id"></span></div>
    <div class="input_name_row">
        <label>Фамилия</label>
        <input type="text" class="edit_popup_input" id="edit_popup_input_surname" placeholder="Фамилия">
    </div>
    <div class="input_name_row">
        <label>Имя</label>
        <input type="text" class="edit_popup_input" id="edit_popup_input_name" placeholder="Имя">
    </div>
    <div class="input_name_row">
        <label>Отчество</label>
        <input type="text" class="edit_popup_input"  id="edit_popup_input_second_name" placeholder="Отчество">
    </div>
    <div class="input_name_row">
        <label>Дата трудоустройства</label>
        <input type="text" class="edit_popup_input"  id="edit_popup_input_start_date" placeholder="Дата трудоустройства">
    </div>
    <div class="input_name_row">
        <label>Дата рождения</label>
        <input type="text" class="edit_popup_input"  id="edit_popup_input_birthday" placeholder="Дата рождения">
    </div>
    <div class="input_name_row">
        <label>Статус</label>
        <input type="text" class="edit_popup_input"  id="edit_popup_input_status" placeholder="Статус">
    </div>
    <div class="button_row">
        <div class="button" id="save_popup_input_employees">Сохранить</div>
        <div class="button" id="cancel_popup_input_employees">Отмена</div>
    </div>
    </div>
</div>



<div id="edit_popup_user" item_id="">
    <div class="canvas" style="padding-top: 30px; box-sizing: border-box;">
    <div style="position: absolute; top: 20px; left: 48px">Login: <span id="title_user_item_id"></span></div>
    <div class="input_name_row">
        <label>Полное имя</label>
        <input type="text" class="edit_popup_input"  id="edit_popup_input_full_name" placeholder="Полное имя">
    </div>
    <div class="input_name_row">
        <label>employee id:</label>
        <input type="text" class="edit_popup_input"  id="edit_popup_input_employee_id" placeholder="employee id">
    </div>
    <div class="input_name_row">
        <label>роль id:</label>
        <input type="text" class="edit_popup_input"  id="edit_popup_input_role_id" placeholder="роль id">
    </div>
    <div>Если надо поменять пароль <br>введите новый пароль два раза</div>
    <div class="input_name_row">
        <input type="password" class="edit_popup_input"  id="edit_popup_input_pass" placeholder="Пароль">
        <input type="password" class="edit_popup_input"  id="edit_popup_input_next_pass" placeholder="Ещё раз пароль">
    </div>
    <div class="button_row">
        <div class="button" id="save_popup_input_user">Сохранить</div>
        <div class="button" id="cancel_popup_input_user">Отмена</div>
    </div>
        </div>
</div>


<div id="table_titles">
    <div id="table_type_title">Тип</div>
    <div id="table_num_title">Справочник</div>
    <div id="table_employees_title">Сотрудники</div>
</div>

<div id="table_type" class="table_box">%table_type%</div>
<div id="table_num" class="table_box"  style="display: none">%table_num%</div>
<div id="table_employees" class="table_box"  style="display: none">%mix_table%</div>

<div id="edit_popup">
    <div class="canvas">
        <input type="text" id="edit_popup_input" placeholder="">
        <div class="button_row">
            <div class="button" id="save_popup_input">Сохранить</div>
            <div class="button" id="delete_popup_input">Удалить</div>
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
        <div class="input_name_row">
            <label>Табельный номер</label>
            <input type="text" class="edit_popup_input"  id="edit_popup_input_personnel_number" placeholder="Табельный номер">
        </div>
    <div class="button_row">
        <div class="button" id="repass_user_mix">Сменить пароль</div>
        <div class="button" id="delete_emp_mix">Уволить</div>
        <div class="button none" id="add_emp_mix">Восстановить в должности</div>
    </div>
    <div class="button_row">
        <div class="button" id="save_popup_input_employees">Сохранить</div>
        <div class="button" id="cancel_popup_input_employees">Отмена</div>
    </div>
    </div>
</div>



<div id="edit_popup_user" item_id="">
    <div class="canvas" style="padding-top: 30px; box-sizing: border-box;">
    <div>Введите новый пароль два раза</div>
    <div class="input_name_row">
        <input type="password" class="edit_popup_input pass"  id="edit_popup_input_pass" placeholder="Пароль">
        <input type="password" class="edit_popup_input pass"  id="edit_popup_input_next_pass" placeholder="Ещё раз пароль">
    </div>
    <div class="button_row">
        <div class="button" id="save_popup_input_user">Сохранить</div>
        <div class="button" id="cancel_popup_input_user">Отмена</div>
    </div>
        </div>
</div>

<div id="plus_type" class="none">
    <div class="canvas">
        <input type="text" id="plus_popup_input" placeholder="Введите новый тип">
        <div class="button_row">
            <div class="button" id="plus_type_popup">Сохранить</div>
            <div class="button" id="plus_type_cancel">Отмена</div>
        </div>
    </div>
</div>

<div id="plus_directory" class="none">
    <div class="canvas">
        <input type="text" id="plus_directory_popup_input" placeholder="Введите новую нуменклатуру">
        <div class="button_row">
            <div class="button" id="plus_directory_popup">Сохранить</div>
            <div class="button" id="plus_directory_cancel">Отмена</div>
        </div>
    </div>
</div>
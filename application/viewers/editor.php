

<div id="table_titles">
    <div id="table_type_title">Тип</div>
    <div id="table_num_title">Справочник</div>
    <div id="table_employees_title">Сотрудники</div>
</div>

<div id="table_type" class="table_box">%table_type%</div>
<div id="table_num" class="table_box"  style="display: none">%table_num%</div>
<div id="table_employees" class="table_box"  style="display: none">%mix_table%</div>


<button id="edit_popup_button" class="none" data-toggle="modal" data-target="#edit_popup">
</button>

<div class="modal fade" tabindex="-1" id="edit_popup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<!--                <h4 class="modal-title" id="myModalLabel"> Можете поменять название:</h4>-->
            </div>
            <div class="modal-body">
                <input id="edit_popup_input" class="form-control" placeholder="">
            </div>
            <div class="modal-footer">
                <button type="button"  id="save_popup_input" class="btn btn-primary">Сохранить</button>
                <button type="button"  id="delete_popup_input" class="btn btn-primary">Удалить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>




<button id="edit_popup_employees_button" class="none" data-toggle="modal" data-target="#edit_popup_employees">
</button>
<div class="modal fade" tabindex="-1" id="edit_popup_employees" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Сотрудник</h4>
            </div>
            <div class="modal-body">

                    <label>Фамилия</label>
                    <input type="text" class="form-control" id="edit_popup_input_surname" placeholder="Фамилия">

                    <label>Имя</label>
                    <input  class="form-control" id="edit_popup_input_name" placeholder="Имя">

                    <label>Отчество</label>
                    <input  class="form-control"  id="edit_popup_input_second_name" placeholder="Отчество">

                    <label>Дата трудоустройства</label>
                    <input type="text" class="form-control"  id="edit_popup_input_start_date" placeholder="Дата трудоустройства">

                    <label>Дата рождения</label>
                    <input type="text" class="form-control"  id="edit_popup_input_birthday" placeholder="Дата рождения">

                    <label>Статус</label>
                    <input  class="form-control"  id="edit_popup_input_status" placeholder="Статус">

                    <label>Табельный номер</label>
                    <input class="form-control"  id="edit_popup_input_personnel_number" placeholder="Табельный номер">

            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#edit_popup_user">Сменить пароль</button>
                <button type="button"  id="delete_emp_mix" class="btn btn-primary">Уволить</button>
                <button type="button"  id="add_emp_mix" class="btn btn-primary">Восстановить в должности</button>
                <button type="button"  id="save_popup_input_employees" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>




<!--<div id="edit_popup_user" item_id="">-->
<!--    <div class="canvas" style="padding-top: 30px; box-sizing: border-box;">-->
<!--    <div>Введите новый пароль два раза</div>-->
<!--    <div class="input_name_row">-->
<!--        <input type="password" class="edit_popup_input pass"  id="edit_popup_input_pass" placeholder="Пароль">-->
<!--        <input type="password" class="edit_popup_input pass"  id="edit_popup_input_next_pass" placeholder="Ещё раз пароль">-->
<!--    </div>-->
<!--    <div class="button_row">-->
<!--        <div class="button" id="save_popup_input_user">Сохранить</div>-->
<!--        <div class="button" id="cancel_popup_input_user">Отмена</div>-->
<!--    </div>-->
<!--        </div>-->
<!--</div>-->

<!---->
<!--<button id="edit_popup_user_button" class="none" data-toggle="modal" data-target="#edit_popup_user">-->
<!--</button>-->

<div class="modal fade" tabindex="-1" id="edit_popup_user" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"> Введите новый пароль два раза</h4>
            </div>
            <div class="modal-body check_pass">
                <input id="edit_popup_input_pass" class="form-control" placeholder="Пароль">
                <br>
                <input id="edit_popup_input_next_pass" class="form-control" placeholder="Ещё раз пароль">
            </div>
            <div class="modal-footer">
                <button type="button"  id="save_popup_input_user" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>





<button id="plus_type_button" class="none" data-toggle="modal" data-target="#plus_type">
</button>
<div class="modal fade" tabindex="-1" id="plus_type" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--                <h4 class="modal-title" id="myModalLabel"> Можете поменять название:</h4>-->
            </div>
            <div class="modal-body">
                <input id="plus_popup_input" class="form-control" placeholder="Введите новый тип">
            </div>
            <div class="modal-footer">
                <button type="button"  id="plus_type_popup" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>



<button id="plus_directory_button" class="none" data-toggle="modal" data-target="#plus_directory">
</button>
<div class="modal fade" tabindex="-1" id="plus_directory" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--                <h4 class="modal-title" id="myModalLabel"> Можете поменять название:</h4>-->
            </div>
            <div class="modal-body">
                <input id="plus_directory_popup_input" class="form-control" placeholder="Введите новую нуменклатуру">
            </div>
            <div class="modal-footer">
                <button type="button"  id="plus_directory_popup" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

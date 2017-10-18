<? header('Content-Type: text/html; charset=utf-8');?>


<div id="login_form">
<!--    %creator %-->

    <div class="create_form_box" >

        <span id="name_dol"></span>
    <div class="create_box">
        <div id="speed_button" dol="Водитель"><i class="plus_item_button fa fa-mail-reply"></i></div>
        <div title="Должность" class="buttom_input" id="node_docs" data-toggle="modal" data-target="#popup_context_menu_update"></div>
        <div title="Фамилия" class="bef_input"><input type="text" id="form_surname" name="surname" placeholder="Фамилия" class="contacts-inp input_form" required=""></div>
        <div title="Имя" class="bef_input"><input type="text" id="form_name" name="name" placeholder="Имя" class="contacts-inp input_form" required=""></div>
        <div title="Отчество" class="bef_input"><input type="text" id="form_patronymic" name="patronymic" placeholder="Отчество" class="contacts-inp input_form" required=""></div>
        <div title="Дата устройства" class="bef_input"><input type="text" id="form_work_start" name="work_start" placeholder="Дата устройства" class="contacts-inp form_work_start_cl input_form" required=""></div>
        <div title="Дата рождения" class="bef_input"><input type="text" id="form_birthday" name="birthday" placeholder="Дата рождения" class="form_birthday_cl contacts-inp input_form" required=""></div>
        <div title="Электронная почта" class="bef_input"><input type="email" id="form_email" name="email" placeholder="Электронная почта" class="contacts-inp input_form" required=""></div>
        <div title="Табельный номер" class="bef_input"><input type="text" id="personnel_number" name="personnel_number" placeholder="Табельный номер(не обязательно)" class="contacts-inp input_form" required=""></div>
        <input type="hidden" id="form_id_item" name="id_item" value="36" required="">
        <div id="landing_form_offer_one" class="button landing_form_offer_one">Записать</div></div>
    </div>
        <div id="test_block" style="display: none; color: #fff;">
        <div id="content_box"></div>
        <div id="create_new_content_box"></div>
            <div id="input_content_box"></div>

</div>

<div id="creator_popup" class="none">
    <div class="canvas">
        <div id="title_creator_popup">Здесь будет сообщение</div>
        <div class="button_row">
            <div class="button" id="ok_creator_popup_input">Ок</div>
        </div>
    </div>
</div>


    <div class="modal fade" tabindex="-1" role="dialog" id="popup_context_menu_update" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Выберите подразделение и должность:</h4>
                </div>
                <div class="modal-body" id="popup_update_tree">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
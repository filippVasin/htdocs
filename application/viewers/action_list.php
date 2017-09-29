
<div id="action_list">%list%
<!--    <div id="add_action" class="button_plus" data-title="Добавить действие"></div>-->
</div>



<button id="popup_action_list_button" class="none" data-toggle="modal" data-target="#popup_action_list">
</button>

<div class="modal fade" tabindex="-1" id="popup_action_list" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Можете поменять название:</h4>
            </div>
            <div class="modal-body">
                <input id="actoin_name" class="form-control" placeholder="Название">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" id="yes_popup_3" id="popup_action_list_yes" class="btn btn-primary">Да</button>
            </div>
        </div>
    </div>
</div>
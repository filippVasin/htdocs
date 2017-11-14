<?php

class Model_supervisor{
    // Данные для обработки POST запросов;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function select_list(){
        global $db;

        $sql = "SELECT users.id,users.name, observer_company.company_id
                FROM observer_company,users
                WHERE users.id = observer_company.observer_user_id
                AND observer_company.role = 4";

        $result = $db->all($sql);

        $user_array = array();
        foreach ($result as $item) {
            $user_array[] = $item['id'];
        }
        $user_array = array_unique($user_array);

        $html_all = '';
        foreach($user_array as $user_id) {

            // сюда собираем блок для конкретного $user_id
            $html = "";
            $html_main = "";
            $html_company = "";
            $count_zero = 0;
            foreach ($result as $item) {
                if($user_id == $item['id']) {
                    // голова
                    if($item['company_id'] == 0 && $count_zero == 0) {
                        $html_main .= '<div class="box box-info collapsed-box company_item" item_id="' . $item['id'] . '">
                        <div class="box-header with-border">
                          <h3 class="box-title">' . $item['name'] . " (ID - " . $item['id'] . ')</h3>
                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool collapse_button" data-widget="" data-toggle="tooltip" title="" data-original-title="Collapse">
                              <i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-box-tool add_observer_item" data-widget="" user_id="'. $item['id'] .'" data-toggle="tooltip" title="Добавить компанию">
                              <i style="color: green" class="fa  fa-plus-circle"></i></button>
                            <button type="button" class="btn btn-box-tool delete_observer_item" data-widget="" user_id="'. $item['id'] .'" data-toggle="tooltip" title="Лишить прав наблюдения">
                              <i style="color: red" class="fa fa-times-circle"></i></button>
                          </div>
                        </div>
                          %company%
                      </div>';
                        ++$count_zero;
                    }
                    // содержание  - список компаний
                    if($item['company_id'] != 0) {
                        $sql = "SELECT * FROM company WHERE company.id =".$item['company_id'];
                        $company = $db->row($sql);
                        $html_company .= '<div class="box-body" >'. $company['name'] .'<button type="button" class="btn btn-box-tool delete_company_item" data-widget="" company_id="'. $company['id'] .'" user_id="'. $item['id'] .'" data-toggle="tooltip" title="Лишить прав наблюдения">
                              <i style="color: #ccc" class="fa fa-remove"></i></button></div>';
                    }
                }
            }
            $html = str_replace('%company%', $html_company, $html_main);
            $html_all .= $html;
        }
        return $html_all;
    }


    public function admin_list(){
        global $db;

        $sql = "SELECT users.id,users.name, observer_company.company_id
                FROM observer_company,users
                WHERE users.id = observer_company.observer_user_id
                AND observer_company.role = 1";

        $result = $db->all($sql);

        $user_array = array();
        foreach ($result as $item) {
            $user_array[] = $item['id'];
        }
        $user_array = array_unique($user_array);

        $html_all = '';
        foreach($user_array as $user_id) {

            // сюда собираем блок для конкретного $user_id
            $html = "";
            $html_main = "";
            $html_company = "";
            $count_zero = 0;
            foreach ($result as $item) {
                if($user_id == $item['id']) {
                    // голова
                    if(($item['company_id'] == 0) && ($count_zero == 0)) {
                        $html_main .= '<div class="box box-info collapsed-box company_item" item_id="' . $item['id'] . '">
                        <div class="box-header with-border">
                          <h3 class="box-title">' . $item['name'] . " (ID - " . $item['id'] . ')</h3>
                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool collapse_button" data-widget="" data-toggle="tooltip" title="" data-original-title="Collapse">
                              <i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-box-tool add_observer_item" data-widget="" user_id="'. $item['id'] .'" data-toggle="tooltip" title="Добавить компанию">
                              <i style="color: green" class="fa  fa-plus-circle"></i></button>
                            <button type="button" class="btn btn-box-tool delete_observer_item" data-widget="" user_id="'. $item['id'] .'" data-toggle="tooltip" title="Лишить прав наблюдения">
                              <i style="color: red" class="fa fa-times-circle"></i></button>
                          </div>
                        </div>
                          %company%
                      </div>';
                        ++$count_zero;
                    }
                    // содержание  - список компаний
                    if($item['company_id'] != 0) {
                        $sql = "SELECT * FROM company WHERE company.id =".$item['company_id'];
                        $company = $db->row($sql);
                        if($company['id'] !=""){
                            $html_company .= '<div class="box-body" >'. $company['name'] .'<button type="button" class="btn btn-box-tool delete_company_item" data-widget="" company_id="'. $company['id'] .'" user_id="'. $item['id'] .'" data-toggle="tooltip" title="Лишить прав наблюдения">
                              <i style="color: #ccc" class="fa fa-remove"></i></button></div>';
                        }
                    }
                }
            }
            $html = str_replace('%company%', $html_company, $html_main);
            $html_all .= $html;
        }
        return $html_all;
    }


    public function select_admin_list(){
        global $db;
        $sql="SELECT *
                FROM users
                WHERE users.role_id = 1";

        $admins = $db->all($sql);
        $html = "<option value=0></option>";
        foreach ($admins as $admin) {
            $html .="<option value='". $admin['id'] ."' >". $admin['name'] ."</option>";
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }


    public function select_select_list(){
        global $db;

        $sql="	SELECT *
                FROM users
                WHERE users.role_id = 4";
        $selects = $db->all($sql);
        $html = "<option value=0></option>";
        foreach ($selects as $select) {
            $html .="<option value='". $select['id'] ."' >". $select['name'] ."</option>";
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }


    public function add_item(){
        global $db;

        if($_SESSION['role_id'] != 1 ) {
            $result_array['status'] = 'error';
            $result_array['content'] = 'У вас нет прав на изменение структуры';
            $result = json_encode($result_array, true);
            die($result);
        }

        $post_data = $this->post_array;
        $type_plus = $post_data['type_plus'];
        $user_id = $post_data['user_id'];


            $observer_user_id = $user_id;
            $company_id = 0;
            $role = $type_plus;

            $sql = "INSERT INTO `observer_company` (`observer_user_id`, `company_id`, `role`)
            VALUES('". $observer_user_id ."', '". $company_id ."', '". $role ."');";
            $db->query($sql);
            $id_item = mysqli_insert_id($db->link_id);


            $sql = "SELECT users.id,users.name
                    FROM users
                    WHERE users.id = ".$user_id;
            $users = $db->row($sql);
            $result_array['content'] = '<div class="box box-info collapsed-box company_item" item_id="'. $user_id .'">
                                            <div class="box-header with-border">
                                              <h3 class="box-title">'. $users['name'] ." (ID - ".$user_id.')</h3>
                                              <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool collapse_button" data-widget="" data-toggle="tooltip" title="" data-original-title="Collapse">
                                                  <i class="fa fa-plus"></i></button>
                                                <button type="button" class="btn btn-box-tool add_observer_item" data-widget="" data-toggle="tooltip" user_id="'. $user_id .'" title="Добавить компанию">
                                                  <i style="color: green" class="fa  fa-plus-circle"></i></button>
                                                <button type="button" class="btn btn-box-tool delete_observer_item" data-widget="" data-toggle="tooltip" user_id="'. $user_id .'" title="Лишить прав наблюдения">
                                                  <i style="color: red" class="fa fa-times-circle"></i></button>
                                              </div>
                                            </div>
                                          </div>';

        $result_array['id_item'] = $id_item;

        $result_array['status'] = 'ok';
        $result_array['message'] = 'Смотрящий успешно добавлен';
        $result = json_encode($result_array, true);
        die($result);
    }






    public function add_observer_item(){
        global $db;

        $sql="SELECT * FROM company";
        $selects = $db->all($sql);
        $html = "<option value=0></option>";
        foreach ($selects as $select) {
            $html .="<option value='". $select['id'] ."' >". $select['name'] ."</option>";
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

    // ставим компанию под наблюдение
    public function add_observer_item_yes(){
        global $db;

        $post_data = $this->post_array;
        $company = $post_data['company'];
        $user_id = $post_data['user_id'];


        $sql = "SELECT *
                FROM observer_company
                WHERE observer_company.observer_user_id =".$user_id . " LIMIT 1";
        $users = $db->row($sql);

        $sql = "INSERT INTO `observer_company` (`observer_user_id`, `company_id`, `role`)
            VALUES('". $user_id ."', '". $company ."', '". $users['role'] ."');";
        $db->query($sql);

        $sql = "SELECT * FROM company WHERE company.id =".$company;
        $company = $db->row($sql);
        $html = '<div class="box-body" >'. $company['name'] .'<button type="button" class="btn btn-box-tool delete_company_item" data-widget="" company_id="'. $company['id'] .'" user_id="'. $user_id .'" data-toggle="tooltip" title="Лишить прав наблюдения">
                              <i style="color: #ccc" class="fa fa-remove"></i></button></div>';

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Наблюдение за компанией включено';
        $result = json_encode($result_array, true);
        die($result);
    }

    public function delete_observer_item_yes(){
        global $db;

        $post_data = $this->post_array;
        $user_id = $post_data['user_id'];

        $sql = "DELETE FROM `observer_company` WHERE  `observer_user_id`=". $user_id;
        $db->query($sql);

        $result_array['status'] = 'ok';
        $result_array['message'] = 'Наблюдатель удалён';
        $result = json_encode($result_array, true);
        die($result);
    }

    public function delete_company_item_yes(){
        global $db;

        $post_data = $this->post_array;
        $user_id = $post_data['user_id'];
        $company_id = $post_data['company_id'];

        $sql = "DELETE FROM `observer_company` WHERE  `observer_user_id`=". $user_id . " AND `company_id` =". $company_id;
        $db->query($sql);

        $result_array['status'] = 'ok';
        $result_array['message'] = 'Наблюдение за компанией убрано';
        $result = json_encode($result_array, true);
        die($result);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_editor
{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // выводим таблицы
    public function table_type(){
        global $db;
        // получаем и выводим таблицу типов
        $sql  ="SELECT items_control_types.id, items_control_types.name FROM items_control_types";
      $employees = $db->all($sql);
        $html = '<div>';
        $html .='<div class="type_title">Тип:</div>';
        foreach($employees as $employee){
            $html .= '<div class="table_row" type="type" item_id="' . $employee['id'] . '"  item_name="' . $employee['name'] . '">';
                $html .= '<div class="type_id">'.  $employee['id'].'</div><div class="type_name">'.  $employee['name'].'</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }

    public function table_num(){
            global $db;
        // получаем и выводим справочник
        $sql  ="SELECT items_control.id, items_control.name FROM items_control";
        $employees = $db->all($sql);
        $html = '<div>';
        $html .='<div class="type_title">Справочник:</div>';
        foreach($employees as $employee){
            $html .= '<div class="table_row" type="num" item_id="' . $employee['id'] . '"  item_name="' . $employee['name'] . '" >';
            $html .= '<div class="type_id">'.  $employee['id'].'</div><div class="type_name">'.  $employee['name'].'</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
            return $html;
        }

    public function table_employees(){
                global $db;
        // получаем и выводим сотрудников
        $sql  ="SELECT `id`, CONCAT_WS(' ', `surname`, `name`, `second_name`) AS `fio` FROM employees";
        $employees = $db->all($sql);
        $html = '<div>';
        $html .='<div class="type_title">Сотрудники:</div>';
        foreach($employees as $employee){
            $html .= '<div class="table_row_employee"  type="employee" item_id="' . $employee['id'] . '">';
            $html .= '<div class="type_id">'.  $employee['id'].'</div><div class="type_name">'.  $employee['fio'].'</div>';
            $html .= '</div>';
        }
        $html .= '</div>';

        return $html;
    }


    public function table_users(){
        global $db;
        // получаем и выводим сотрудников
        $sql  ="SELECT `id`, `name` FROM users";
        $employees = $db->all($sql);
        $html = '<div>';
        $html .='<div class="type_title">Users:</div>';
        foreach($employees as $employee){
            $html .= '<div class="table_row_user"  type="user" item_id="' . $employee['id'] . '"">';
            $html .= '<div class="type_id">'.  $employee['id'].'</div><div class="type_name">'.  $employee['name'].'</div>';
            $html .= '</div>';
        }
        $html .= '</div>';

        return $html;
    }


    // выводим таблицу
    public function save_popup_input(){
        global $db;
        $item_id = $this->post_array['item_id'];
        $item_name = $this->post_array['item_name'];
        $type = $this->post_array['type'];
        // изменяем нужный элемент
        if($type == "num" ) {
            $sql = "UPDATE `items_control` SET `name`='" . $item_name . "' WHERE  `id`='" . $item_id . "'";
            $db->query($sql);
        }
        if($type == "type" ) {
            $sql = "UPDATE `items_control_types` SET `name`='" . $item_name . "' WHERE  `id`='" . $item_id . "'";
            $db->query($sql);
        }

        $result = $item_name;
        $result_array['content'] = $result;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


    // карточка сотрудника
    public function employee_card(){
        global $db;
        $item_id = $this->post_array['item_id'];
        // получаем данные сотрудника
        $sql  ="SELECT * FROM employees WHERE id =" . $item_id ;
        $result = $db->row($sql);

        $result_array['surname'] = $result['surname'];
        $result_array['name'] = $result['name'];
        $result_array['second_name'] = $result['second_name'];
        $result_array['birthday'] = $result['birthday'];
        $result_array['start_date'] = $result['start_date'];
        $result_array['em_status'] = $result['status'];
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }
    // меняем карточку сотрудника
    public function save_employee_card(){
        global $db;

        $item_id = $this->post_array['item_id'];
        $surname = $this->post_array['surname'];
        $name = $this->post_array['name'];
        $second_name = $this->post_array['second_name'];
        $start_date = $this->post_array['start_date'];
        $birthday = $this->post_array['birthday'];
        $em_status = $this->post_array['em_status'];

        // меняем данные сотрудника
        $sql  ="UPDATE `employees` SET `surname`='" . $surname . "', `name`='" . $name . "', `second_name`='" . $second_name . "', `start_date`='" . $start_date . "',`birthday`='" . $birthday . "',`status`='" . $em_status . "'
                WHERE  `id`=" . $item_id;
        $result = $db->query($sql);

        $result_array['surname'] = $surname;
        $result_array['name'] = $name;
        $result_array['second_name'] = $second_name;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

    // карточка user
    public function user_card(){
        global $db;
        $item_id = $this->post_array['item_id'];
        // получаем данные сотрудника
        $sql  ="SELECT * FROM users WHERE id =" . $item_id ;
        $result = $db->row($sql);

        $result_array['login'] = $result['name'];
        $result_array['role_id'] = $result['role_id'];
        $result_array['employee_id'] = $result['employee_id'];
        $result_array['full_name'] = $result['full_name'];

        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }

    // меняем карточку user
    public function save_user_card(){
        global $db;

        $item_id = $this->post_array['item_id'];
        $full_name = $this->post_array['full_name'];
        $employee_id = $this->post_array['employee_id'];
        $role_id = $this->post_array['role_id'];
//        pass = $this->post_array['pass'];

        // получаем данные сотрудника
        $sql  ="UPDATE users SET `full_name`='" . $full_name . "', `role_id`='" . $role_id . "', `employee_id`='" . $employee_id ."'
                WHERE  `id`=" . $item_id;
        $result = $db->query($sql);

        // меняем пароль если нужно
        if(isset($this->post_array['pass'])){
            $pass =md5($this->post_array['pass']);
            $sql  ="UPDATE users SET `password`='" . $pass . "'
                WHERE  `id`=" . $item_id;
            $result = $db->query($sql);
        }

        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

}
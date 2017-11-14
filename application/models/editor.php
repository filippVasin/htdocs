<?php

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
        $html = "";
        if ($_SESSION['role_id'] == 4) {
            return $html;
        } else {
            // получаем и выводим таблицу типов
            $sql = "SELECT items_control_types.id, items_control_types.name FROM items_control_types";
            $employees = $db->all($sql);
            $html .= '<div>';
            $html .= '<div class="type_title">Тип:</div>';
            $html .= '<div class="type_plus"></div>';
            foreach ($employees as $employee) {
                $html .= '<div class="table_row" type="type" item_id="' . $employee['id'] . '"  item_name="' . $employee['name'] . '">';
                $html .= '<div class="type_id">' . $employee['id'] . '</div><div class="type_name">' . $employee['name'] . '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
            return $html;
        }
    }

    public function table_num(){
        global $db;
        $html = "";
        if ($_SESSION['role_id'] == 4) {
            return $html;
        } else {
            // получаем и выводим справочник
            $sql = "SELECT items_control.id, items_control.name FROM items_control WHERE items_control.company_id =".$_SESSION['control_company'];
            $employees = $db->all($sql);
            $html .= '<div>';
            $html .= '<div class="type_title">Справочник:</div>';
            $html .= '<div class="directory_plus"></div>';
            foreach ($employees as $employee) {
                $html .= '<div class="table_row" type="num" item_id="' . $employee['id'] . '"  item_name="' . $employee['name'] . '" >';
                $html .= '<div class="type_id">' . $employee['id'] . '</div><div class="type_name">' . $employee['name'] . '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
            return $html;
        }
    }

    public function mix_table(){
        global $db;

        if(!(isset($_SESSION['control_company']))){
            header("Location:/company_control");
        }
        // получаем и выводим сотрудников
        $sql = "SELECT employees.id AS emp_id, CONCAT_WS(' ', employees.surname, employees.name, employees.second_name) AS `fio`,
                users.id AS user_id, users.name AS login, organization_structure.company_id
                FROM users,employees,employees_items_node, organization_structure
                WHERE users.employee_id = employees.id
                AND employees_items_node.employe_id = employees.id
                AND organization_structure.id = employees_items_node.org_str_id
                AND organization_structure.company_id =" . $_SESSION['control_company'];
        $employees = $db->all($sql);

        $html = '';
        foreach($employees as $employee){
            $html .= '<tr class="table_mix_row" emp_id="' . $employee['emp_id'] . '" user_id="' . $employee['user_id'] . '">';
            $html .=    '<td class="emp_id" rowspan="1" colspan="1">'.  $employee['emp_id'].'</td>';
            $html .=    '<td class="login" rowspan="1" colspan="1">'.  $employee['login'].'</td>';
            $html .=    '<td class="fio" rowspan="1" colspan="1">'.  $employee['fio'].'</td>';
            $html .= '</tr>';
        }



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

        $result_array['birthday'] = date_create($result['birthday'])->Format('d.m.Y');
        $result_array['start_date'] = date_create($result['start_date'])->Format('d.m.Y');

        $result_array['em_status'] = $result['status'];
        $result_array['personnel_number'] = $result['personnel_number'];

        $sql  ="SELECT * FROM registration_address WHERE registration_address.emp_id =" . $item_id ;
        $result = $db->row($sql);
        if($result['id'] != ""){
            $result_array['address'] = $result['address'];
        }

        $sql  ="SELECT * FROM drivers_license WHERE drivers_license.emp_id =" . $item_id ;
        $result = $db->row($sql);
        if($result['id'] != 0){
            $result_array['category'] = $result['category'];
            $result_array['license_number'] = $result['license_number'];
            $result_array['start_date_driver'] = date_create($result['start_date'])->Format('d.m.Y');
            $result_array['end_date_driver'] = date_create($result['end_date'])->Format('d.m.Y');

        }


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
        $personnel_number = $this->post_array['personnel_number'];

        $address = $this->post_array['address'];
        $category = $this->post_array['category'];
        $license_number = $this->post_array['license_number'];
        $start_date_driver = $this->post_array['start_date_driver'];
        $end_date_driver = $this->post_array['end_date_driver'];

        // подготовка дат к записи в базу
        if($start_date_driver !=""){
            $start_date_driver = date_create($start_date_driver)->Format('Y-m-d');
        }
        if($end_date_driver !=""){
            $end_date_driver = date_create($end_date_driver)->Format('Y-m-d');
        }
        if($start_date !=""){
            $start_date = date_create($start_date)->Format('Y-m-d');
        }
        if($birthday !=""){
            $birthday = date_create($birthday)->Format('Y-m-d');
        }


        // меняем данные сотрудника
        if($personnel_number!="") {
            $sql = "UPDATE `employees` SET `personnel_number`='" . $personnel_number . "', `surname`='" . $surname . "', `name`='" . $name . "', `second_name`='" . $second_name . "', `start_date`='" . $start_date . "',`birthday`='" . $birthday . "',`status`='" . $em_status . "'
                WHERE  `id`=" . $item_id;
        } else {
            $sql = "UPDATE `employees` SET `surname`='" . $surname . "', `name`='" . $name . "', `second_name`='" . $second_name . "', `start_date`='" . $start_date . "',`birthday`='" . $birthday . "',`status`='" . $em_status . "'
                WHERE  `id`=" . $item_id;
        }
        $db->query($sql);

        $sql  ="SELECT * FROM registration_address WHERE `emp_id` =" . $item_id ;
        $result = $db->row($sql);
        if($result['id'] != ""){
            $sql = "UPDATE `registration_address` SET `address`='" . $address . "' WHERE  `emp_id`=" . $item_id;
             $db->query($sql);
        } else {
            $sql = "INSERT INTO `registration_address` (`emp_id`, `address`) VALUES ('" . $item_id . "', '" . $address . "')";
            $db->query($sql);
        }


        $sql  ="SELECT * FROM drivers_license WHERE `emp_id` =" . $item_id ;
        $result = $db->row($sql);
        if($result['id'] != ""){
            $sql = "UPDATE `drivers_license` SET `category`='" . $category . "',`license_number`='" . $license_number . "',`start_date`='" . $start_date_driver . "',`end_date`='" . $end_date_driver . "' WHERE  `emp_id`=" . $item_id;
            $db->query($sql);
        } else {
            $sql = "INSERT INTO `drivers_license` (`emp_id`, `company_id`,`category`,`license_number`,`start_date`,`end_date`) VALUES (" . $item_id . ",'" . $_SESSION['control_company'] . "','" . $category. "','" . $license_number. "','" . $start_date_driver. "','" . $end_date_driver. "')";
            $db->query($sql);
        }


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



        // меняем пароль если нужно
        if(isset($this->post_array['pass'])){
            $pass = md5($this->post_array['pass']);
            $sql  = "UPDATE users SET `password`='" . $pass . "'
                WHERE  `id`=" . $item_id;
        $db->query($sql);
        }

        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

    public function plus_type(){
        global $db;
        $new_type = $this->post_array['new_type'];

        $sql = "SELECT *
        FROM items_control_types
            WHERE name ='".$new_type."'";
            $result = $db->row($sql);

        if($result['id']=="") {
            $sql = "INSERT INTO `items_control_types` (`name`) VALUES('" . $new_type . "');";
            $db->query($sql);

            $sql ="SELECT *
            FROM  items_control_types
            WHERE items_control_types.name = '".$new_type ."'";
            $result = $db->row($sql);

            $result_array['status'] = 'ok';
            $html = '<div class="table_row" type="type" item_id="' . $result['id'] . '"  item_name="' . $new_type . '">';
            $html .= '<div class="type_id">'.  $result['id'].'</div><div class="type_name">'.  $new_type .'</div>';
            $html .= '</div>';
            $result_array['content'] = $html;
        } else {
            $result_array['status'] = 'error';
        }


        $result = json_encode($result_array, true);
        die($result);
    }

    public function plus_directory(){
        global $db;
        $new_directory = $this->post_array['new_directory'];
        $sql = "SELECT *
        FROM items_control
            WHERE name ='".$new_directory."'";
        $result = $db->row($sql);

        if($result['id']=="") {
            $sql = "INSERT INTO `items_control` (`name`, `company_id`) VALUES('" . $new_directory . "','" . $_SESSION['control_company'] . "');";
            $db->query($sql);

            $sql ="SELECT *
            FROM  items_control
            WHERE items_control.name = '".$new_directory ."'";
            $result = $db->row($sql);


            $result_array['status'] = 'ok';
            $html = '<div class="table_row" type="num" item_id="' . $result['id'] . '"  item_name="' . $new_directory . '" >';
            $html .= '<div class="type_id">'.  $result['id'].'</div><div class="type_name">'.  $new_directory.'</div>';
            $html .= '</div>';
            $result_array['content'] = $html;
        } else {
            $result_array['status'] = 'error';
        }
        $result = json_encode($result_array, true);
        die($result);
    }


    // выводим таблицу
    public function delete_item(){
        global $db;
        $item_id = $this->post_array['item_id'];
        $type = $this->post_array['type'];
        // изменяем нужный элемент
        if($type == "num" ) {
            $sql ="SELECT items_control.id
                    FROM items_control,organization_structure,route_doc
                    WHERE items_control.id = ". $item_id ."
                    AND
                    (items_control.id = organization_structure.kladr_id
                    OR items_control.id = route_doc.item_type_id)";
            $result = $db->row($sql);

            if($result['id']=="") {
                $sql = "DELETE FROM `items_control` WHERE  `id`=".$item_id ;
                $db->query($sql);
                $result_array['status'] = 'ok';
            } else {
                $result_array['status'] = 'error';
            }
        }
        if($type == "type" ) {
            $sql ="SELECT items_control_types.id
                    FROM items_control_types, organization_structure,items_control
                    WHERE items_control_types.id = ". $item_id ."
                    AND
                    (items_control_types.id = organization_structure.items_control_id
                    OR items_control_types.id = items_control.type_id)";
            $result = $db->row($sql);

            if($result['id']=="") {
                $sql = "DELETE FROM `items_control_types` WHERE  `id`=".$item_id ;
                $db->query($sql);
                $result_array['status'] = 'ok';
            } else {
                $result_array['status'] = 'error';
            }
        }


        $result = json_encode($result_array, true);
        die($result);
    }

    public function select_node_list(){
        global $db;

        $sql="	SELECT *
                FROM items_control_types
                WHERE items_control_types.id not IN(10,11)";
        $group_companys = $db->all($sql);
        $html = "<option value=0></option>";
        foreach ($group_companys as $group_companys_item) {
            $html .="<option value='". $group_companys_item['id'] ."' >". $group_companys_item['name'] ."</option>";
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_employee_update
{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // выводим таблицу
    public function upload_data(){
        global $db;
        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                employees.id AS em_id,
                employees.`status`,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "
                ORDER BY left_key";


        $employees = $db->all($sql);

        $html = '<div class="update_employee_table">';

        foreach($employees as $employee) {
                //  если сотрудник - тогда рисуем ему строку
                if ($employee['fio'] != "") {
                    if ($employee['status'] == 0) {
                        // если сотрудник уволен, строки не будет
                    } else {
                        $down_id = $employee['id'];
                        $name = $employee['fio'] . "<br>";
                        $position = $employee['erarh'];
                        $left = 0;
                        $right = 0;
                        if (isset($down_id)) {
                            foreach ($employees as $employee_key) {
                                if ($down_id == $employee_key['id']) {
                                    $left = $employee_key['left_key'];
                                    $right = $employee_key['right_key'];
                                }
                            }
                        }
                        $erarh = "";
                        $erarh_popup = "";
                        foreach ($employees as $employee_box) {

                            if (($left > $employee_box['left_key']) && ($right < $employee_box['right_key'])) {
                                $erarh .= $employee_box['erarh'] . "<br>";
                                $erarh_popup .= $employee_box['erarh'] . "/";
                            }
                        }
                        // собираем строку
                        $html .= '<div class="table_row" type="employee" position="' . $erarh_popup . $position . '" item_id="' . $employee['id'] . '" item_name="' . $name . '" em_id="' . $employee['em_id'] . '">';
                        $html .= '<div class="type_position">' . $erarh . $position . '</div><div class="type_name">' . $name . '</div>';
                        $html .= '</div>';
                    }
                }
        }
        $html .= '</div>';

        return $html;
    }

    // запрос на дерево позиций
    public function load_positions_tree(){
        global $db;
        $item_id = $this->post_array['item_id'];
        // получаем и выводим справочник
        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                items_control_types.id AS type,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";


        $employees = $db->all($sql);

        $html = "";
        $parent_id = "";
        $parent_name = "";
        foreach($employees as $employee){

               if($employee['id']== $item_id){
                   // не выводим свою должность
               } else {
                   $item = str_repeat('&#8195;', $employee['level'] - 1);
                   if ($employee['type'] == 3) {
                       $position = '<div class="position" left_key = "' . $employee['left_key'] . '" right_key = "' . $employee['right_key'] . '" id_position = "' . $employee['id'] . '" parent_id = "' . $parent_id . '" parent_name = "' . $parent_name . '" erarh = "' . $employee['erarh'] . '" >' . $item . $employee['erarh'] . '</div>';
                       $erarh = "";
                   } else {
                       $erarh = $item . $employee['erarh'] . " / ";
                       $position = "";
                       $parent_id = $employee['id'];
                       $parent_name = $employee['erarh'];
                   }
                   $html .= $erarh . $position;
               }

        }


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


    // получаем ерархию новой должности
    public function load_new_erarch(){
        global $db;
        // получаем и выводим сотрудников
        $html = "";
        $left_key = $this->post_array['left_key'];
        $right_key = $this->post_array['right_key'];

        $sql = "SELECT
        GROUP_CONCAT(CONCAT_WS(': ', items_control_types.name, items_control.name) ORDER BY organization_structure.level  ASC SEPARATOR '/ ') as old_dol
        FROM organization_structure, items_control, items_control_types
        WHERE left_key <= " . $left_key . "
        AND right_key >= ". $right_key ."
        AND organization_structure.items_control_id = items_control_types.id
        AND organization_structure.kladr_id = items_control.id";

        $employees = $db->row($sql);
        $html = $employees['old_dol'];
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }

    // меняем должность сотруднику и пишим логи
    public function update_position_yes(){
        global $db;
        // получаем и выводим сотрудников
        $html = "";
        $item_id = $this->post_array['item_id'];
        $em_id = $this->post_array['em_id'];
        $parent_id = $this->post_array['parent_id'];
        $id_position = $this->post_array['id_position'];

        $sql = "UPDATE `employees_items_node` SET `org_str_id`='" . $id_position . "' WHERE  `employe_id`='" . $em_id . "'";
        $db->query($sql);

        $sql = "INSERT INTO `employees_history` (`employee_id`, `org_str_id`, `event_data`) VALUES('".$em_id."', '". $item_id ."', NOW());";
        $db->query($sql);
        $html = "Сотрудник перемещён";
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


    // увольняем сотрудника и пишим логи
    public function delete_employee_yes(){
        global $db;
        // получаем и выводим сотрудников
        $html = "";
        $item_id = $this->post_array['item_id'];
        $em_id = $this->post_array['em_id'];

        $sql = "DELETE FROM `employees_items_node` WHERE  `employe_id`=" . $em_id;
        $db->query($sql);

        $status = 0;
        $sql = "UPDATE `employees` SET `status`='" . $status . "' WHERE  `id`=" . $em_id;
        $db->query($sql);

        $sql = "SELECT `id`, `password` FROM `users` WHERE `employee_id` = ".$em_id;
        $login_data = $db->row($sql);
        $result_array = array();
        if($login_data['id'] != '') {
            $password = md5($login_data['$password']);
            $sql = "UPDATE `users` SET `password`='" . $password . "' WHERE  `employee_id` = ".$em_id;
            $db->query($sql);
        }


        $sql = "INSERT INTO `employees_history` (`employee_id`, `org_str_id`, `event_data`) VALUES('".$em_id."', '". $item_id ."', NOW());";
        $db->query($sql);

        $html = "Сотрудник уволен";
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }



}
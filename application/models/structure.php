<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_structure
{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // тестим здесь
    public function test()
    {
        global $db, $systems, $elements;;


        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                employees.`status`,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";


        $employees = $db->all($sql);

        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        $html = '<select id="tree" class="" style="">';
        foreach ($employees as $key => $employee_box) {

            $html .= '<option value="' . $employee_box['id'] . '" >' . $employee_box['erarh'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }


    // Вывод всего дерева;
    public function whole_tree(){

        global $db, $systems, $elements;;


        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                employees.`status`,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";


        $employees = $db->all($sql);
//        print_r($employees);
        $down_id = 0;// если надо вывести конкретный отдел
        $left = 0;
        $right = 0;
        if(isset($down_id)){
            foreach($employees as $employee_key) {
                if ($down_id == $employee_key['id']) {
                    $left = $employee_key['left_key'];
                    $right = $employee_key['right_key'];
                }
            }
        }

        $html = "";
        foreach($employees as $employee){

            if($down_id>0){
            global $result_one;
                if((($left <= $employee['left_key']) && ($right >= $employee['right_key'])) || (($left >= $employee['left_key']) && ($right <= $employee['right_key']))){
                    $item = str_repeat('&#8195;', $employee['level'] - 1);
                    if (isset($employee['fio'])) {
                        $name = $employee['fio'];
                    } else {
                        $name = "";
                    }
                    if (($employee['status'] == 0)&&($employee['fio'] != "")) {
                        // если сотрудник уволен, строки не будет
                    } else {
                        $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
                    }
                }
            } else {
                $item = str_repeat('&#8195;', $employee['level'] - 1);
                if (isset($employee['fio'])) {
                    $name = $employee['fio'];
                } else {
                    $name = "";
                }
                if (($employee['status'] == 0)&&($employee['fio'] != "")) {
                    // если сотрудник уволен, строки не будет
                } else {
                    $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
                }

            }
        }


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


    // Вывод всего дерева;
    public function tree_down(){

        global $db, $systems, $elements;;
        // получаем данные из POST запроса
        $item_id = $this->post_array['item_id'];

        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                employees.`status`,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";


        $employees = $db->all($sql);
//        print_r($employees);
        $down_id = 0;// если надо вывести конкретный отдел
        if($item_id!=""){
            $down_id =  $item_id;
        }
        $left = 0;
        $right = 0;
        if(isset($down_id)){
            foreach($employees as $employee_key) {
                if ($down_id == $employee_key['id']) {
                    $left = $employee_key['left_key'];
                    $right = $employee_key['right_key'];
                }
            }
        }

        $html = "";
        foreach($employees as $employee){

            if($down_id>0){
                global $result_one;
                if(($left <= $employee['left_key']) && ($right >= $employee['right_key'])){
                    $item = str_repeat('&#8195;', $employee['level'] - 1);
                    if (isset($employee['fio'])) {
                        $name = $employee['fio'];
                    } else {
                        $name = "";
                    }
                    if (($employee['status'] == 0)&&($employee['fio'] != "")) {
                        // если сотрудник уволен, строки не будет
                    } else {
                        $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
                    }
                }
            } else {
                $item = str_repeat('&#8195;', $employee['level'] - 1);
                if (isset($employee['fio'])) {
                    $name = $employee['fio'];
                } else {
                    $name = "";
                }
                if (($employee['status'] == 0)&&($employee['fio'] != "")) {
                    // если сотрудник уволен, строки не будет
                } else {
                    $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
                }
            }
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }


    // Вывод всего дерева;
    public function tree_up(){

        global $db, $systems, $elements;;
        $item_id = $this->post_array['item_id'];

        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                employees.`status`,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";


        $employees = $db->all($sql);
//        print_r($employees);

        $down_id = 0;// если надо вывести конкретный отдел
        if($item_id!=""){
            $down_id =  $item_id;
        }
        $left = 0;
        $right = 0;
        if(isset($down_id)){
            foreach($employees as $employee_key) {
                if ($down_id == $employee_key['id']) {
                    $left = $employee_key['left_key'];
                    $right = $employee_key['right_key'];
                }
            }
        }

        $html = "";
        foreach($employees as $employee){

            if($down_id>0){
                global $result_one;
                if(($left >= $employee['left_key']) && ($right <= $employee['right_key'])){
                    $item = str_repeat('&#8195;', $employee['level'] - 1);
                    if (isset($employee['fio'])) {
                        $name = $employee['fio'];
                    } else {
                        $name = "";
                    }
                    if (($employee['status'] == 0)&&($employee['fio'] != "")) {
                        // если сотрудник уволен, строки не будет
                    } else {
                        $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
                    }
                }
            } else {
                $item = str_repeat('&#8195;', $employee['level'] - 1);
                if (isset($employee['fio'])) {
                    $name = $employee['fio'];
                } else {
                    $name = "";
                }
                if (($employee['status'] == 0)&&($employee['fio'] != "")) {
                    // если сотрудник уволен, строки не будет
                } else {
                    $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
                }

            }
        }


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }



    // Вывод всего дерева;
    public function whole_branch(){

        global $db, $systems, $elements;;
        $item_id = $this->post_array['item_id'];

        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                employees.`status`,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";


        $employees = $db->all($sql);
//        print_r($employees);
        $down_id = 0;// если надо вывести конкретный отдел
        if($item_id!=""){
            $down_id =  $item_id;
        }

        $left = 0;
        $right = 0;
        if(isset($down_id)){
            foreach($employees as $employee_key) {
                if ($down_id == $employee_key['id']) {
                    $left = $employee_key['left_key'];
                    $right = $employee_key['right_key'];
                }
            }
        }

        $html = "";
        foreach($employees as $employee){

            if($down_id>0){
                global $result_one;
                if((($left <= $employee['left_key']) && ($right >= $employee['right_key'])) || (($left >= $employee['left_key']) && ($right <= $employee['right_key']))){
                    $item = str_repeat('&#8195;', $employee['level'] - 1);
                    if (isset($employee['fio'])) {
                        $name = $employee['fio'];
                    } else {
                        $name = "";
                    }
                    if (($employee['status'] == 0)&&($employee['fio'] != "")) {
                        // если сотрудник уволен, строки не будет
                    } else {
                        $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
                    }
                }
            } else {
                $item = str_repeat('&#8195;', $employee['level'] - 1);
                if (isset($employee['fio'])) {
                    $name = $employee['fio'];
                } else {
                    $name = "";
                }
                if (($employee['status'] == 0)&&($employee['fio'] != "")) {
                    // если сотрудник уволен, строки не будет
                } else {
                    $html .= $item . $employee['erarh'] . " / " . $name .$employee['status'] . "<br>";
                }
            }
        }


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


}
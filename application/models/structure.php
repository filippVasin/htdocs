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
        global $db, $systems, $elements;

        if(!(isset($_SESSION['control_company']))){
            header("Location:/company_control");
        }

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
        $html = '<select id="tree" class="" style="">';
        foreach ($employees as $key => $employee_box) {
            $left_key = str_pad($employee_box['left_key'] , 3, "0", STR_PAD_LEFT);
            $right_key = str_pad($employee_box['right_key'] , 3, "0", STR_PAD_LEFT);
            $html .= '<option value="' . $employee_box['id'] . '" left_key="' . $left_key . '" right_key="' . $right_key . '" >' . $employee_box['erarh'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

//
//    // Вывод всего дерева;
//    public function whole_tree(){
//
//        global $db, $systems, $elements;;
//
//
//        $sql = "SELECT
//                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
//                organization_structure.`level`,
//                organization_structure.id,
//                organization_structure.left_key,
//                organization_structure.right_key,
//                employees.`status`,
//                employees_items_node.org_str_id as 'employee',
//                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
//                FROM organization_structure
//                inner join items_control on organization_structure.kladr_id = items_control.id
//                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
//                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
//                left join employees on employees_items_node.employe_id = employees.id
//                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";
//
//
//        $employees = $db->all($sql);
////        print_r($employees);
//        $down_id = 0;// если надо вывести конкретный отдел
//        $left = 0;
//        $right = 0;
//        if(isset($down_id)){
//            foreach($employees as $employee_key) {
//                if ($down_id == $employee_key['id']) {
//                    $left = $employee_key['left_key'];
//                    $right = $employee_key['right_key'];
//                }
//            }
//        }
//
//        $html = "";
//        foreach($employees as $employee){
//
//            if($down_id>0){
//            global $result_one;
//                if((($left <= $employee['left_key']) && ($right >= $employee['right_key'])) || (($left >= $employee['left_key']) && ($right <= $employee['right_key']))){
//                    $item = str_repeat('&#8195;', $employee['level'] - 1);
//                    if (isset($employee['fio'])) {
//                        $name = $employee['fio'];
//                    } else {
//                        $name = "";
//                    }
//                    if (($employee['status'] == 0)&&($employee['fio'] != "")) {
//                        // если сотрудник уволен, строки не будет
//                    } else {
//                        $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
//                    }
//                }
//            } else {
//                $item = str_repeat('&#8195;', $employee['level'] - 1);
//                if (isset($employee['fio'])) {
//                    $name = $employee['fio'];
//                } else {
//                    $name = "";
//                }
//                if (($employee['status'] == 0)&&($employee['fio'] != "")) {
//                    // если сотрудник уволен, строки не будет
//                } else {
//                    $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
//                }
//
//            }
//        }
//
//
//        $result_array['content'] = $html;
//        $result_array['status'] = 'ok';
//
//        $result = json_encode($result_array, true);
//        die($result);
//    }
//
//
//    // Вывод всего дерева;
//    public function tree_down(){
//
//        global $db, $systems, $elements;;
//        // получаем данные из POST запроса
//        $item_id = $this->post_array['item_id'];
//
//        $sql = "SELECT
//                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
//                organization_structure.`level`,
//                organization_structure.id,
//                organization_structure.left_key,
//                organization_structure.right_key,
//                employees.`status`,
//                employees_items_node.org_str_id as 'employee',
//                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
//                FROM organization_structure
//                inner join items_control on organization_structure.kladr_id = items_control.id
//                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
//                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
//                left join employees on employees_items_node.employe_id = employees.id
//                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";
//
//
//        $employees = $db->all($sql);
////        print_r($employees);
//        $down_id = 0;// если надо вывести конкретный отдел
//        if($item_id!=""){
//            $down_id =  $item_id;
//        }
//        $left = 0;
//        $right = 0;
//        if(isset($down_id)){
//            foreach($employees as $employee_key) {
//                if ($down_id == $employee_key['id']) {
//                    $left = $employee_key['left_key'];
//                    $right = $employee_key['right_key'];
//                }
//            }
//        }
//
//        $html = "";
//        foreach($employees as $employee){
//
//            if($down_id>0){
//                global $result_one;
//                if(($left <= $employee['left_key']) && ($right >= $employee['right_key'])){
//                    $item = str_repeat('&#8195;', $employee['level'] - 1);
//                    if (isset($employee['fio'])) {
//                        $name = $employee['fio'];
//                    } else {
//                        $name = "";
//                    }
//                    if (($employee['status'] == 0)&&($employee['fio'] != "")) {
//                        // если сотрудник уволен, строки не будет
//                    } else {
//                        $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
//                    }
//                }
//            } else {
//                $item = str_repeat('&#8195;', $employee['level'] - 1);
//                if (isset($employee['fio'])) {
//                    $name = $employee['fio'];
//                } else {
//                    $name = "";
//                }
//                if (($employee['status'] == 0)&&($employee['fio'] != "")) {
//                    // если сотрудник уволен, строки не будет
//                } else {
//                    $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
//                }
//            }
//        }
//
//        $result_array['content'] = $html;
//        $result_array['status'] = 'ok';
//        $result = json_encode($result_array, true);
//        die($result);
//    }
//
//
//    // Вывод всего дерева;
//    public function tree_up(){
//
//        global $db, $systems, $elements;;
//        $item_id = $this->post_array['item_id'];
//
//        $sql = "SELECT
//                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
//                organization_structure.`level`,
//                organization_structure.id,
//                organization_structure.left_key,
//                organization_structure.right_key,
//                employees.`status`,
//                employees_items_node.org_str_id as 'employee',
//                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
//                FROM organization_structure
//                inner join items_control on organization_structure.kladr_id = items_control.id
//                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
//                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
//                left join employees on employees_items_node.employe_id = employees.id
//                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";
//
//
//        $employees = $db->all($sql);
////        print_r($employees);
//
//        $down_id = 0;// если надо вывести конкретный отдел
//        if($item_id!=""){
//            $down_id =  $item_id;
//        }
//        $left = 0;
//        $right = 0;
//        if(isset($down_id)){
//            foreach($employees as $employee_key) {
//                if ($down_id == $employee_key['id']) {
//                    $left = $employee_key['left_key'];
//                    $right = $employee_key['right_key'];
//                }
//            }
//        }
//
//        $html = "";
//        foreach($employees as $employee){
//
//            if($down_id>0){
//                global $result_one;
//                if(($left >= $employee['left_key']) && ($right <= $employee['right_key'])){
//                    $item = str_repeat('&#8195;', $employee['level'] - 1);
//                    if (isset($employee['fio'])) {
//                        $name = $employee['fio'];
//                    } else {
//                        $name = "";
//                    }
//                    if (($employee['status'] == 0)&&($employee['fio'] != "")) {
//                        // если сотрудник уволен, строки не будет
//                    } else {
//                        $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
//                    }
//                }
//            } else {
//                $item = str_repeat('&#8195;', $employee['level'] - 1);
//                if (isset($employee['fio'])) {
//                    $name = $employee['fio'];
//                } else {
//                    $name = "";
//                }
//                if (($employee['status'] == 0)&&($employee['fio'] != "")) {
//                    // если сотрудник уволен, строки не будет
//                } else {
//                    $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
//                }
//
//            }
//        }
//
//
//        $result_array['content'] = $html;
//        $result_array['status'] = 'ok';
//
//        $result = json_encode($result_array, true);
//        die($result);
//    }
//
//
//
//    // Вывод всего дерева;
//    public function whole_branch(){
//
//        global $db, $systems, $elements;
//        $item_id = $this->post_array['item_id'];
//
//        $sql = "SELECT
//                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
//                organization_structure.`level`,
//                organization_structure.id,
//                organization_structure.left_key,
//                organization_structure.right_key,
//                employees.`status`,
//                employees_items_node.org_str_id as 'employee',
//                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
//                FROM organization_structure
//                inner join items_control on organization_structure.kladr_id = items_control.id
//                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
//                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
//                left join employees on employees_items_node.employe_id = employees.id
//                Where organization_structure.company_id =" . $_SESSION['control_company'] . "  ORDER BY left_key";
//
//
//        $employees = $db->all($sql);
////        print_r($employees);
//        $down_id = 0;// если надо вывести конкретный отдел
//        if($item_id!=""){
//            $down_id =  $item_id;
//        }
//
//        $left = 0;
//        $right = 0;
//        if(isset($down_id)){
//            foreach($employees as $employee_key) {
//                if ($down_id == $employee_key['id']) {
//                    $left = $employee_key['left_key'];
//                    $right = $employee_key['right_key'];
//                }
//            }
//        }
//
//        $html = "";
//        foreach($employees as $employee){
//
//            if($down_id>0){
//                global $result_one;
//                if((($left <= $employee['left_key']) && ($right >= $employee['right_key'])) || (($left >= $employee['left_key']) && ($right <= $employee['right_key']))){
//                    $item = str_repeat('&#8195;', $employee['level'] - 1);
//                    if (isset($employee['fio'])) {
//                        $name = $employee['fio'];
//                    } else {
//                        $name = "";
//                    }
//                    if (($employee['status'] == 0)&&($employee['fio'] != "")) {
//                        // если сотрудник уволен, строки не будет
//                    } else {
//                        $html .= $item . $employee['erarh'] . " / " . $name . "<br>";
//                    }
//                }
//            } else {
//                $item = str_repeat('&#8195;', $employee['level'] - 1);
//                if (isset($employee['fio'])) {
//                    $name = $employee['fio'];
//                } else {
//                    $name = "";
//                }
//                if (($employee['status'] == 0)&&($employee['fio'] != "")) {
//                    // если сотрудник уволен, строки не будет
//                } else {
//                    $html .= $item . $employee['erarh'] . " / " . $name .$employee['status'] . "<br>";
//                }
//            }
//        }
//
//
//        $result_array['content'] = $html;
//        $result_array['status'] = 'ok';
//
//        $result = json_encode($result_array, true);
//        die($result);
//    }
//
//
//    public function whole_tree_new(){
//
//        global $db;
////        $item_id = $this->post_array['item_id'];
////        $node_left_key = $this->post_array['node_left_key'];
////        $node_right_key = $this->post_array['node_right_key'];
//        $html = "";
//
//        $sql="SELECT
//                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
//                organization_structure.`level`,
//                organization_structure.id,
//                organization_structure.left_key,
//                organization_structure.right_key,
//                organization_structure.parent,
//                employees.`status`,
//                employees_items_node.org_str_id as 'employee',
//                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
//                FROM organization_structure
//                inner join items_control on organization_structure.kladr_id = items_control.id
//                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
//                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
//                left join employees on employees_items_node.employe_id = employees.id
//                Where organization_structure.company_id = " . $_SESSION['control_company'] . "  ORDER BY left_key";
//
//
//        // если сработал выбор по отделам
////        if(($node_left_key!="")&&($node_right_key!="")){
////            $sql.=" AND org_parent.left_key >= ". $node_left_key ."
////                    AND org_parent.right_key <= ". $node_right_key ;
////        }
//        $tree = $db->all($sql);
//
//        $level_array = array();
//        foreach ($tree as $test_item) {
//            $level_array[] = $test_item['level'];
//        }
//        // оставляем все уникальные уровни и сортируем по возрастанию
//        $level_array = array_unique($level_array);
//        asort($level_array);
//        $html='<ul id="tree_main" class="tree">%parent_0%</ul>';
//        foreach ($level_array as $level_array_item) {
//                    foreach($tree as $tree_item) {
//                        if($tree_item['level']==$level_array_item) {
//                            $parent_id = $tree_item['parent'];
//                            $item_html = '<ul class="none">';
//                            foreach($tree as $tree_item) {
//                                if($tree_item['parent']==$parent_id){
//                                    $item_html .= '<li><div class="tree_item" level="' . $tree_item['level'] . '" parent="' . $tree_item['parent'] . '"id_item="' . $tree_item['id'] . '"left_key="' . $tree_item['left_key'] . '"right_key="' . $tree_item['right_key'] . '">' . $tree_item['erarh'] . '</div>';
//                                    if ($tree_item['fio'] != "") {
//                                        $item_html .= '<div class="tree_item_fio">' . $tree_item['fio'] . '</div>';
//                                    }
//                                    $item_html .= "%parent_".$tree_item['id']."%";;
//                                    $item_html .= '</li>';
//                                }
//                            }
//                            $item_html .= '</ul>';
//
//                            // вставляем по сгенерированному ключу
//                            $anchor = "%parent_".$parent_id."%";
//                            $flag   = '<li>';
//                            $pos = strpos($item_html, $flag);
//                            // если есть что вставить вставляем
//                            if ($pos === false) {
//                                $html = str_replace($anchor, "", $html);
//                            } else {
//                                $html = str_replace($anchor, $item_html, $html);
//                            }
//                        }
//                    }
//        }
//        // убираем оставшиеся якоря
//        foreach($tree as $tree_item) {
//            $anchor = "%parent_".$tree_item['id']."%";
//            $html = str_replace($anchor, "", $html);
//        }
//        // убираем "Должность:"
//        foreach($tree as $tree_item) {
//            $html = str_replace("Должность:", "", $html);
//        }
//
//
//
//        $result_array['content'] = $html;
//        $result_array['status'] = 'ok';
//
//        $result = json_encode($result_array, true);
//        die($result);
//    }
//
}
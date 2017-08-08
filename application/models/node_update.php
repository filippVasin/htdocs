<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_node_update
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
                items_control_types.id AS type,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "
                GROUP BY organization_structure.id
                ORDER BY left_key";


        $employees = $db->all($sql);

        $html = "";
        $parent_id = "";
        $parent_name = "";
        foreach($employees as $employee){
                $left = $employee['left_key'];
                $right = $employee['right_key'];
                // есть ли дети
                $child = 0;
                if(($right - $left)> 1 ){
                    $child = 1;
                }
                $item = str_repeat('&#8195;', $employee['level'] - 1);
                if ($employee['type'] == 3) {
                    $position =  $item . $employee['erarh'];
                    $erarh = "";
                } else {
                    $erarh = $item . $employee['erarh'] . " / ";
                    $position = "";
                }
                $html .= '<div class="node" left_key = "' . $employee['left_key'] . '" right_key = "' . $employee['right_key'] . '"  item_id = "' . $employee['id'] . '"  erarh = "' . $employee['erarh'] . '"  child = "' . $child . '" >' . $erarh . $position . '</div>';
            }

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
        $left = "";
        $right = "";
        foreach($employees as $employee_key) {
            if ($item_id == $employee_key['id']) {
                $left = $employee_key['left_key'];
                $right = $employee_key['right_key'];
            }
        }

        foreach($employees as $employee){

            if(($left <= $employee['left_key']) && ($right >= $employee['right_key'])){
                // не выводим свой узел и потомков
            } else {
                $item = str_repeat('&#8195;', $employee['level'] - 1);
                if ($employee['type'] == 3) {
//                    $position = '<div class="position" id_position = "' . $employee[id] . '" parent_id = "' . $parent_id . '" parent_name = "' . $parent_name . '" erarh = "' . $employee['erarh'] . '" >' . $item . $employee['erarh'] . '</div>';
//                    $erarh = "";
                } else {
                    $erarh = $item . $employee['erarh'] . " / ";
                    $html .= '<div class="new_parent" left_key = "' . $employee['left_key'] . '" right_key = "' . $employee['right_key'] . '" new_parent_id = "' . $employee['id'] . '"  new_parent_name = "' . $employee['erarh'] . '" >' . $erarh. '</div>';

                }

            }

        }


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


    // меняем положение узла и пишим логи
    public function update_node_yes(){
        global $db;
        // получаем и выводим сотрудников

//
        // получаем узел и нового родителя
        $item_id = $this->post_array['item_id'];
        $new_parent_id = $this->post_array['new_parent_id'];



        // запрашиваем данные для узла для истории
            $sql = "SELECT * FROM organization_structure WHERE organization_structure.id =" . $item_id;
            $result = $db->row($sql);
            $kladr_id = $result['kladr_id'];
            $items_control_id = $result['items_control_id'];
            $company_id = $result['company_id'];
//        echo $sql . "<br><br>";
        // запись в историю
        $sql = "INSERT INTO `parent_backup` (`id_org_struct`, `id_parent`, `kladr_id`, `item_control_id`, `company_id`, `date_update`)
                 VALUES('" . $item_id . "', '". $new_parent_id ."','". $kladr_id ."','". $items_control_id ."','". $company_id ."', NOW());";
        $db->query($sql);
//        echo $sql . "<br><br>";
        // переносим узел

        $this->MoveNode($item_id,$new_parent_id, $_SESSION['control_company']);

        $html = "Узел перемещён";
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


    // удаляем узел и пишим логи
    public function delete_node_yes(){
        global $db;

        // получаем и выводим сотрудников
        $item_id = $this->post_array['item_id'];

        // проверить есть ли под должностью сотрудник
        $sql = "SELECT *  FROM employees_items_node WHERE employees_items_node.org_str_id = ".$item_id;
        $result = $db->row($sql);
//        print_r($result);
        if(isset($result['id'])){
            $result_array['status'] = 'Занятно';
            $result = json_encode($result_array, true);
            die($result);
        } else {

            // запрашиваем данные для удаляемого узла для истории
//            $sql = "SELECT * FROM organization_structure WHERE organization_structure.id =" . $item_id;
//            $result = $db->row($sql);
//            $kladr_id = $result['kladr_id'];
//            $items_control_id = $result['items_control_id'];
//            $company_id = $result['company_id'];
//            $parent = $result['parent'];

            // удаляем элемент
            $this->DeleteNode($item_id, $_SESSION['control_company']);

            // запись в историю
            $sql = "INSERT INTO `parent_backup` (`id_org_struct`, `id_parent`, `kladr_id`, `item_control_id`, `company_id`, `date_update`)
                 VALUES('" . $item_id . "', '0','0','0','0', NOW());";
            $db->query($sql);


            $result_array['content'] = $item_id;
            $result_array['status'] = 'ok';

            $result = json_encode($result_array, true);
            die($result);
        }
    }

    // получаем ерархию старого узла
    public function load_old_erarch(){
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
        AND organization_structure.kladr_id = items_control.id
        AND organization_structure.company_id =" . $_SESSION['control_company'];
//        echo $sql;
        $employees = $db->row($sql);
        $html = $employees['old_dol'];
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }



/// работа с деревьями

    private  function MoveNode($move_item,$new_parent,$company_id){
        global $db;

        // получаем ключи элемента
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $move_item;
        $result = $db->row($sql);
        $left_key = $result['left_key'];
        $right_key = $result['right_key'];
        // получаем ключи старого родителя
        $sql="SELECT organization_structure.parent, parent_org.left_key, parent_org.right_key
                FROM organization_structure
                LEFT JOIN organization_structure AS parent_org ON parent_org.id = organization_structure.parent
                WHERE organization_structure.id =".$move_item ;
        $result = $db->row($sql);
        $old_parent = $result['parent'];
        $old_parent_left_key = $result['left_key'];
        $old_parent_right_key = $result['right_key'];
        // получаем ключи нового родителя
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $new_parent;
        $result = $db->row($sql);
        $new_parent_left_key = $result['left_key'];
        $new_parent_right_key = $result['right_key'];
        if(($left_key<=$new_parent_left_key)&&($right_key>=$new_parent_right_key)){

            echo "нельзы переносить в самого себя";
        } else {


            // получаем раздницу по левелам
            $sql = "SELECT old_parent.`level` - new_parent.`level` AS level_delta
                FROM organization_structure AS new_parent, organization_structure AS old_parent
                WHERE new_parent.id = " . $new_parent . "
                AND old_parent.id = " . $old_parent;
            $result = $db->row($sql);
            $level_delta = $result['level_delta'];

            // Внешняя дельта - для применения к неперемещаемым узлам = количество перемещаемых ключей)))
            $external_delta = $right_key - $left_key + 1;

            // начинаем перемешение //
            // если идём вверх по ключам
            if ($old_parent_left_key < $new_parent_left_key) {
                // получили дельту для применения к внутренним перемещаемого элементам узла
                $new_right_key = $new_parent_right_key - 1;
                $delta = $new_right_key - $right_key;
                $new_left_key = $left_key + $delta;

                // поменяли ключи у неперемещаемых узлов по пути следования перемещаемого узла
                $sql = "UPDATE `organization_structure` SET `left_key` = `left_key` - {$external_delta} WHERE `left_key` > {$right_key}  AND `left_key` < {$new_parent_right_key}  AND `company_id` = {$company_id}";
                $db->query($sql);
                $sql = "UPDATE `organization_structure` SET `right_key` = `right_key` - {$external_delta} WHERE `right_key` > {$right_key}  AND `right_key` < {$new_parent_right_key}  AND `company_id` = {$company_id};";
                $db->query($sql);

                // меняем ключи у перемещаемого узла и его потомков
                $sql = "UPDATE `organization_structure` SET `left_key` = {$left_key} + {$delta},`right_key` = {$right_key} + {$delta}  WHERE `left_key` >= {$left_key}  AND `right_key` <= {$right_key}  AND `company_id` = {$company_id};";
                $db->query($sql);

            } else { // если идём вниз по ключам
                // получили дельту для применения к внутренним перемещаемого элементам узла
                $new_right_key = $new_parent_right_key - 1;
                $delta = $right_key - $new_right_key;
                $new_left_key = $left_key - $delta;

                // поменяли ключи у неперемещаемых узлов по пути следования перемещаемого узла
                $sql = "UPDATE `organization_structure` SET `left_key` = `left_key` + {$external_delta} WHERE `left_key` >= {$new_parent_right_key}  AND `left_key` < {$left_key}  AND `company_id` = {$company_id}";
//                 echo $sql;
                $db->query($sql);
                $sql = "UPDATE `organization_structure` SET `right_key` = `right_key` + {$external_delta} WHERE `right_key` >= {$new_parent_right_key}  AND `right_key` < {$left_key}  AND `company_id` = {$company_id};";
//                echo $sql;
                $db->query($sql);
                // меняем ключи у перемещаемого узла и его потомков
                $sql = "UPDATE `organization_structure` SET `left_key` = {$left_key} - {$delta},`right_key` = {$right_key} - {$delta}  WHERE `left_key` >= {$left_key}  AND `right_key` <= {$right_key}  AND `company_id` = {$company_id};";
                $db->query($sql);
            }

            // присваеваю родителя перемещаемому узлу
            $sql = "UPDATE `organization_structure` SET `parent` = {$new_parent} WHERE `id` = {$move_item}";
            $db->query($sql);

            // расставляем правельные левелы
            $sql = "UPDATE organization_structure SET `level` = `level` - ". $level_delta ."
                WHERE left_key >= " . $new_left_key . "
                AND right_key <= " . $new_right_key;
//            echo $sql;
            $db->query($sql);
        }
    }


    private function DeleteNode($delete_item,$company_id){
        global $db;
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $delete_item;
        $result = $db->row($sql);
        $left_key = $result['left_key'];
        $right_key = $result['right_key'];



        $sql="DELETE FROM `organization_structure` WHERE `left_key` >= {$left_key} AND `right` <= {$right_key} AND `company_id` = {$company_id};
                  UPDATE `organization_structure` SET `left_key` = `left_key` - {$right_key} + {$left_key} - 1 WHERE `left_key` > {$right_key} AND `company_id` = {$company_id};
                  UPDATE `organization_structure` SET `right_key` = `right_key` - {$right_key} + {$left_key} - 1 WHERE `right_key` > {$right_key} AND `company_id` = {$company_id};";
        echo $sql;
//        $db->query($sql);
    }

    // функция добавление элемента в дерево компании
    private  function InsertNode($new_parent_id,$company_id,$kladr_id,$items_control_id,$boss_type){
        global $db;
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $new_parent_id;
        $result = $db->row($sql);
//        $left_key = $result['left_key'];
        $right_key = $result['right_key'];
        $parent_level = $result['level'];

        // добавляем в конец списка
        $sql="UPDATE `organization_structure` SET `left_key` = `left_key` + 2 WHERE `left_key` > {$right_key} AND `company_id` = {$company_id};
                UPDATE `organization_structure` SET `right_key` = `right_key` + 2 WHERE `right_key` >= {$right_key} AND `company_id` = {$company_id};
                INSERT INTO `organization_structure` SET `left_key` = {$right_key},
                                                        `right_key` = {$right_key} + 1,
                                                        `company_id` = {$company_id},
                                                        `kladr_id` = {$kladr_id},
                                                        `items_control_id` = {$items_control_id},
                                                        `boss_type` = {$boss_type},
                                                        `level` = {$parent_level } + 1,
                                                         `parent`={$new_parent_id} ;";
        echo $sql;
//        $db->query($sql);
    }

}
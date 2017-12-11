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
                Where organization_structure.company_id =" . $_SESSION['control_company'] . "
                AND organization_structure.left_key > 0  ORDER BY left_key";


        $employees = $db->all($sql);
        $html = '<select id="tree" class="" style="">';
        foreach ($employees as $key => $employee_box) {
            $left_key = str_pad($employee_box['left_key'] , 5, "0", STR_PAD_LEFT);
            $right_key = str_pad($employee_box['right_key'] , 5, "0", STR_PAD_LEFT);
            $html .= '<option value="' . $employee_box['id'] . '" left_key="' . $left_key . '" right_key="' . $right_key . '" >' . $employee_box['erarh'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public function select_dol_list(){
        global $db;
        $post_data = $this->post_array;
        $parent_id = $post_data['parent_id'];
        $sql="SELECT items_control.id, items_control.name
                FROM items_control, organization_structure
                WHERE items_control.company_id = " . $_SESSION['control_company'] . "
                AND items_control.type_id = 3
                AND items_control.id = organization_structure.kladr_id
                AND organization_structure.parent !=".$parent_id ." GROUP BY id";

        $group_companys = $db->all($sql);
        $html = "<option value=0></option>";
        foreach ($group_companys as $group_companys_item) {
            $html .="<option value='". $group_companys_item['id'] ."' >". $group_companys_item['name'] ."</option>";
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function select_node_list(){
        global $db;

        $sql="	SELECT *
                FROM items_control_types
                WHERE items_control_types.id not IN(3,10,11)";
        $group_companys = $db->all($sql);
        $html = "<option value=0></option>";
        foreach ($group_companys as $group_companys_item) {
            $html .="<option value='". $group_companys_item['id'] ."' >". $group_companys_item['name'] ."</option>";
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function select_kladr_list(){
        global $db;
        $post_data = $this->post_array;
        $kladr_type_id = $post_data['kladr_type_id'];
        $parent_id = $post_data['parent_id'];
        $sql="SELECT items_control.id, items_control.name
                FROM items_control,organization_structure
                WHERE items_control.type_id = " . $kladr_type_id . "
                AND items_control.company_id = " . $_SESSION['control_company'] . "
                AND items_control.id = organization_structure.kladr_id
                AND organization_structure.parent !=" .$parent_id . " GROUP BY id";
        $group_companys = $db->all($sql);
        $html = "<option value=0></option>";
        foreach ($group_companys as $group_companys_item) {
            $html .="<option value='". $group_companys_item['id'] ."' >". $group_companys_item['name'] ."</option>";
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function add_item(){
        global $db;

        if($_SESSION['role_id'] != 1 ) {
            $result_array['status'] = 'error';
            $result_array['content'] = 'У вас нет прав на изменение структуры';
            // Отправили зезультат
            return json_encode($result_array);
        }

        $post_data = $this->post_array;
        $type_plus = $post_data['type_plus'];
        $select_dol = $post_data['select_dol'];
        $select_node = $post_data['select_node'];
        $parent_id = $post_data['parent_id'];
        $kladr_id = $post_data['kladr_id'];


        if($type_plus == 1){

            $sql = "SELECT * FROM `organization_structure` WHERE `id` = '".$parent_id."';";
            $paren_data = $db->row($sql);

            $level = $paren_data['level'] + 1;
            $left_key = $paren_data['right_key'];
            $right_key = $paren_data['right_key'] + 1;
            $parent = $parent_id;
            $company_id = $paren_data['company_id'];
            $items_control_id = 3;
            $kladr_id = $select_dol;
            $boss_type = 1;


            $sql = "UPDATE `organization_structure` SET `right_key` = (right_key + 2) WHERE `right_key` >= {$paren_data['right_key']}";
            $db->query($sql);
            $sql = "UPDATE `organization_structure` SET `left_key` = (left_key + 2) WHERE `left_key` >= {$paren_data['right_key']}";
            $db->query($sql);

            $mail_period = 0;
            $sql = "INSERT INTO `organization_structure` (`level`, `left_key`, `right_key`, `parent`, `company_id`, `items_control_id`, `kladr_id`, `boss_type`,`mail_period`)
            VALUES('". $level ."', '". $left_key ."', '". $right_key ."', '".$parent."', '".$company_id."', '".$items_control_id."', '". $kladr_id ."', '".$boss_type."', '".$mail_period."');";
            $db->query($sql);
            $id_item = mysqli_insert_id($db->link_id);

            // записываем информацию о создании в бэкап базу (0,parent_new - добавление)
            $parent_old = 0;
            $parent_new = $parent;
            $org_struct_node = $id_item;
            $sql = "INSERT INTO `parent_backup` (`org_struct_node`, `parent_old`, `parent_new`, `company_id`, `date_update`,`level`,`left_key`,`right_key`,`items_control_id`,`kladr_id`,`boss_type`,`mail_period`)
            VALUES('". $org_struct_node ."',
                    '". $parent_old ."',
                     '". $parent_new ."',
                      '".$company_id."',
                        NOW(),
                        '". $level ."',
                         '".$left_key."',
                          '". $right_key ."',
                           '". $items_control_id ."',
                            '".$kladr_id."',
                             '". $boss_type ."',
                              '". $mail_period ."');";
            $db->query($sql);

            $sql = "SELECT * FROM items_control WHERE items_control.id ='".$kladr_id."';";
            $item_data = $db->row($sql);

            $result_array['item_name'] = $item_data['name'];
            $result_array['type_plus'] = $type_plus;
            $result_array['level'] = $level;
            $result_array['parent'] = $parent;
            $result_array['id_item'] = $id_item;
            $result_array['left_key'] = str_pad($left_key , 5, "0", STR_PAD_LEFT);
            $result_array['right_key'] = str_pad($right_key , 5, "0", STR_PAD_LEFT);

        }

        if($type_plus == 2){
            $sql = "SELECT * FROM `organization_structure` WHERE `id` = '".$parent_id."';";
            $paren_data = $db->row($sql);

            $level = $paren_data['level'] + 1;
            $left_key = $paren_data['right_key'];
            $right_key = $paren_data['right_key'] + 1;
            $parent = $parent_id;
            $company_id = $paren_data['company_id'];
            $items_control_id = $select_node;
            $kladr_id = $kladr_id;

            $sql = "UPDATE `organization_structure` SET `right_key` = (right_key + 2) WHERE `right_key` >= {$paren_data['right_key']}";
            $db->query($sql);
            $sql = "UPDATE `organization_structure` SET `left_key` = (left_key + 2) WHERE `left_key` >= {$paren_data['right_key']}";
            $db->query($sql);

            $boss_type = 1;
            $mail_period = 0;
            $sql = "INSERT INTO `organization_structure` (`level`, `left_key`, `right_key`, `parent`, `company_id`, `items_control_id`,`kladr_id`,  `boss_type`, `mail_period`)
            VALUES('". $level ."', '". $left_key ."', '". $right_key ."', '".$parent."', '".$company_id."', '".$items_control_id."', '". $kladr_id ."', '".$boss_type."', '". $mail_period ."');";
            $db->query($sql);
            $id_item = mysqli_insert_id($db->link_id);

            // записываем информацию о создании в бэкап базу (0,parent_new - добавление)
            $parent_old = 0;
            $parent_new = $parent;
            $org_struct_node = $id_item;
            $sql = "INSERT INTO `parent_backup` (`org_struct_node`, `parent_old`, `parent_new`, `company_id`, `date_update`,`level`,`left_key`,`right_key`,`items_control_id`,`kladr_id`,`boss_type`,`mail_period`)
            VALUES('". $org_struct_node ."',
                    '". $parent_old ."',
                     '". $parent_new ."',
                      '".$company_id."',
                        NOW(),
                        '". $level ."',
                         '".$left_key."',
                          '". $right_key ."',
                           '". $items_control_id ."',
                            '".$kladr_id."',
                             '". $boss_type ."',
                              '". $mail_period ."');";
            $db->query($sql);


            $sql = "SELECT * FROM items_control WHERE items_control.id =".$kladr_id ;
            $item_data = $db->row($sql);

            $sql = "SELECT * FROM items_control_types WHERE items_control_types.id =". $items_control_id;
            $type_data = $db->row($sql);

            $result_array['item_name'] = $type_data['name'] .":". $item_data['name'];
            $result_array['type_plus'] = $type_plus;
            $result_array['level'] = $level;
            $result_array['parent'] = $parent;
            $result_array['id_item'] = $id_item;
            $result_array['left_key'] = str_pad($left_key , 5, "0", STR_PAD_LEFT);
            $result_array['right_key'] = str_pad($right_key , 5, "0", STR_PAD_LEFT);
        }




        $result_array['status'] = 'ok';
        $result_array['content'] = 'Элемент успешно добавлен';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function delete_node(){
        global $db;
        $delete_item_id = $this->post_array['delete_item_id'];
        $sql="SELECT organization_structure.left_key, organization_structure.right_key, employees_items_node.employe_id, ORG.*
                FROM (organization_structure, employees_items_node)
                LEFT JOIN organization_structure AS ORG ON (ORG.left_key >= organization_structure.left_key
                                                                            AND
                                                                            ORG.right_key <= organization_structure.right_key
                                                                            AND
                                                                            ORG.company_id = 	organization_structure.company_id)
                WHERE organization_structure.id = ". $delete_item_id ."
                AND employees_items_node.org_str_id = ORG.id
                LIMIT 1";
        $delete_emps = $db->row($sql);
        //
        if($delete_emps['employe_id']!=""){
            $result_array['status'] = 'error';
            $result_array['report'] = 'Ошибка! За элементом закреплены сотрудники';
        } else {



            // получаем данные о удаляемом элемента
            $sql="SELECT (organization_structure.right_key - organization_structure.left_key + 1) AS delta, organization_structure.left_key,
                  organization_structure.right_key,
                  organization_structure.company_id,
                  organization_structure.parent
                    FROM organization_structure
                    WHERE organization_structure.id =".$delete_item_id;
            $delete_node = $db->row($sql);
            $delta = $delete_node ["delta"];
            $left_key = $delete_node ["left_key"];
            $right_key = $delete_node ["right_key"];
            $company_id = $delete_node ["company_id"];
            $parent = $delete_node ["parent"];


            // записываем информацию о удалении в бэкап базу (parent_old, 0 - удаление)
            $sql="SELECT *
                    FROM  `organization_structure`
                    WHERE  `left_key`>= ". $left_key ."
                    AND `right_key`<= ". $right_key ."
                    AND `company_id`=". $company_id;
            $delete_group = $db->all($sql);
            foreach ($delete_group as $delete_item) {
                if($delete_item['parent'] == 0){
                    $parent_old = -1;// это был корневой элемент
                } else {
                   $parent_old = $delete_item['parent'];
                }
                $parent_new = 0;
                $org_struct_node = $delete_item['id'];
                $sql = "INSERT INTO `parent_backup` (`org_struct_node`, `parent_old`, `parent_new`, `company_id`, `date_update`,`level`,`left_key`,`right_key`,`items_control_id`,`kladr_id`,`boss_type`,`mail_period`)
            VALUES('". $org_struct_node ."',
                    '". $parent_old ."',
                     '". $parent_new ."',
                      '".$company_id."',
                        NOW(),
                        '". $delete_item['level'] ."',
                         '". $delete_item['left_key']."',
                          '".$delete_item['right_key'] ."',
                           '".$delete_item['items_control_id'] ."',
                            '".$delete_item['kladr_id'] ."',
                             '".$delete_item['boss_type'] ."',
                              '".$delete_item['mail_period'] ."');";
                $db->query($sql);
            }

            // удаляем элемент со всеми вложенными
            $sql="UPDATE `organization_structure` SET `left_key`= 0, `right_key`= 0 WHERE  `left_key`>=". $left_key ." AND `right_key`<=". $right_key ." AND `company_id`=". $company_id;
            $db->query($sql);

            // обновляем оставшиеся элементы
            $sql="UPDATE `organization_structure` SET `left_key`=(left_key - ". $delta .") WHERE  `left_key`>".$left_key ." AND `company_id`=". $company_id;
            $db->query($sql);
            $sql="UPDATE `organization_structure` SET `right_key`=(right_key - ". $delta .") WHERE  `right_key`>".$right_key ." AND `company_id`=". $company_id;
            $db->query($sql);

            $result_array['status'] = 'ok';
            $result_array['report'] = 'Элемент успешно удалён';
        }

        // Отправили зезультат
        return json_encode($result_array);
    }
}
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

    public function select_dol_list(){
        global $db;

        $sql="SELECT *
                FROM items_control
                WHERE items_control.company_id = " . $_SESSION['control_company'] . "
                AND items_control.type_id = 3";
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
        $result = json_encode($result_array, true);
        die($result);
    }

    public function select_kladr_list(){
        global $db;
        $post_data = $this->post_array;
        $kladr_type_id = $post_data['kladr_type_id'];
        $sql="SELECT	*
                FROM items_control
                WHERE items_control.type_id != 3
                AND items_control.company_id =". $_SESSION['control_company'] ;
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


    public function add_item(){
        global $db;

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


            $sql = "INSERT INTO `organization_structure` (`level`, `left_key`, `right_key`, `parent`, `company_id`, `items_control_id`, `kladr_id`, `boss_type`)
            VALUES('". $level ."', '". $left_key ."', '". $right_key ."', '".$parent."', '".$company_id."', '".$items_control_id."', '". $kladr_id ."', '".$boss_type."');";
            $db->query($sql);

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
            $sql = "INSERT INTO `organization_structure` (`level`, `left_key`, `right_key`, `parent`, `company_id`, `items_control_id`,`kladr_id`,  `boss_type`)
            VALUES('". $level ."', '". $left_key ."', '". $right_key ."', '".$parent."', '".$company_id."', '".$items_control_id."', '". $kladr_id ."', '".$boss_type."');";
            $db->query($sql);

        }

        $result_array['status'] = 'ok';
        $result_array['content'] = 'Элемент успешно добавлен';
        $result = json_encode($result_array, true);
        die($result);
    }

}
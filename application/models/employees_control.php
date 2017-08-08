<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_employees_control{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function add(){
        global $db, $elements, $systems;

        $selected_items = json_decode($this->post_array['selected_items'], true);
        $new_employee_data = json_decode($this->post_array['new_employee_data'], true);
        $new_employee_data = $new_employee_data[0];

        $employee_surname = $new_employee_data['employee_surname'];
        $employee_name = $new_employee_data['employee_name'];
        $employee_second_name = $new_employee_data['employee_second_name'];
        $employee_birthday = $new_employee_data['employee_birthday'];
        $employee_start_date = $new_employee_data['employee_start_date'];

        // Добавляем сотрудника;
        $sql = "INSERT INTO `employees` (`surname`, `name`, `second_name`, `birthday`, `start_date`)
            VALUES('".$employee_surname."', '".$employee_name."', '".$employee_second_name."', '".$employee_birthday."', '".$employee_start_date."');";
        $db->query($sql);
        $new_item_id = mysqli_insert_id($db->link_id);

        // Добавляем метки элементов сотрудника;
        $js_errors = array('-1', 'undefined', 'null', '');
        foreach($selected_items as $selected_item){
            if(!in_array($selected_item, $js_errors)){
                $sql = "INSERT INTO `employees_items_node` (`employe_id`, `item_id`) VALUES('".$new_item_id."', '".$selected_item."');";
                $db->query($sql);
            }
        }

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Новая сотрудник успешно добавлен';
        $result_array['new_item'] = $elements->item($employee_surname.' '.$employee_name.' '.$employee_second_name.' ('.$systems->get_local_date_time($employee_birthday).')', 'employee_'.$new_item_id, '', '', 'employee_id='.$new_item_id);

        $result = json_encode($result_array, true);
        die($result);
    }

    // Получаем селекторы всех параметров;
    public function get_items_selects(){
        global $db, $elements;

        $result = '';

        $sql = "SELECT * FROM `items_control_types`";
        $items_types = $db->all($sql);

        foreach($items_types as $item_type){
            $sql = "SELECT * FROM `items_control` WHERE `company_id` = '".$_SESSION['control_company']."' AND `type_id` = '".$item_type['id']."' AND `status` != 0;";
            $list_items_array = $db->all($sql);

            $items_select = array();
            $items_select[] = array('value' => -1, 'caption' => 'Все', 'selected' => '1', 'disabled' => '');
            foreach($list_items_array as $list_item){
                $items_select[] = array('value' => $list_item['id'], 'caption' => $list_item['name'], 'selected' => '', 'disabled' => '');
            }

            $result .= $elements->combobox('Выберите '.$item_type['name'].' для добавления сотрудника', $items_select, '', 'control_select', '', 'item_type_id='.$item_type['id']);
            $result .= '<br>';
        }

        return $result;
    }

    // Получаем списко сотрудников по переданным переметрам выборки;
    public function get_employees(){
        global $db, $elements, $systems;

        $request_data_array = json_decode($this->post_array['request_data'], true);

        $js_errors = array('-1', 'undefined', 'null', '');
        $sql_in_line = '';
        $select_temp_array = array();
        foreach($request_data_array as $key => $request_data_item){
            if(!in_array($request_data_item, $js_errors)){
                $select_temp_array[] = $request_data_item;
            }
        }

        foreach($select_temp_array as $key => $select_temp_array_item){
            $sql_in_line .= $select_temp_array_item.($key < count($select_temp_array)-1 ? ', ' : '');
        }

        $sql_in_line = '`item_id` IN ('.$sql_in_line.')';

        $sql = "
                select `employees`.`id`, CONCAT_WS(' ', `surname`, `name`, `second_name`) AS `fio`, `birthday`
                from `employees`, `employees_items_node`
                where `employees_items_node`.`employe_id` = `employees`.`id`
                and ".$sql_in_line."
                group by `employees`.`id`
                HAVING COUNT(DISTINCT `item_id`) = ".count($select_temp_array)."
        ";
        $employees = $db->all($sql);

        $result_array = array();

        $result_array['status'] = 'ok';
        $result_array['message'] = 'Данные успешно загружены';
        $result_array['items'] = array();

        if(count($employees) > 0){
            foreach($employees as $employee){
                $result_array['items'][] = $elements->item($employee['fio'].' ('.$systems->get_local_date_time($employee['birthday']).')', 'employee_'.$employee['id'], '', '', 'employee_id='.$employee['id']);
            }
        }   else{
            $result_array['items'][] = $elements->small_title('В выбранной комбинации нет сотрудников', 'no_apps');
        }

        $result = json_encode($result_array, true);
        die($result);
    }
}
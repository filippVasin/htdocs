<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_departments_control{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // Добавление нового компании;
    public function add(){
        global $db, $elements;

        $department_name = $this->post_array['name'];

        $sql = "INSERT INTO `departments` (`company_id`, `name`) VALUES('".$_SESSION['control_company']."', '".$department_name."');";
        $db->query($sql);

        $new_item_id = mysqli_insert_id($db->link_id);

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Новый отдел успешно добавлен';
        $result_array['new_item'] = $elements->item($department_name, 'department_'.$new_item_id, '', '', 'department_id='.$new_item_id);

        $result = json_encode($result_array, true);
        die($result);
    }

    // Получаем список отделов в компании;
    public function get_departments_list(){
        global $db, $elements;

        $html = '';

        $sql = "SELECT * FROM `departments` WHERE `status` != 0 AND `company_id` = '".$_SESSION['control_company']."';";
        $departments_array = $db->all($sql);
        if(count($departments_array) == 0){
            $html .= $elements->small_title('В управляемой компании нет отделов. Добавьте их.');
        }   else {
            foreach ($departments_array as $departments_item) {
                $html .= $elements->item($departments_item['name'], 'department_' . $departments_item['id'], '', '', 'department_id=' . $departments_item['id']);
            }
        }

        return $html;
    }
}
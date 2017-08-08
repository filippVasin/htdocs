<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_appointments_control{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function add(){
        global $db, $elements;

        $new_appointment_name = $this->post_array['new_appointment_name'];

        $sql = "INSERT INTO `appointments` (`company_id`, `name`) VALUES('".$_SESSION['control_company']."', '".$new_appointment_name."');";
        $db->query($sql);

        $new_item_id = mysqli_insert_id($db->link_id);

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Новая должность успешно добавлена';
        $result_array['new_item'] = $elements->item($new_appointment_name, 'appointment_'.$new_item_id, '', '', 'appointment_id='.$new_item_id);

        $result = json_encode($result_array, true);
        die($result);
    }

    // Получаем список должностей в компании;
    public function get_appointments_list(){
        global $db, $elements;

        $html = '';

        $sql = "SELECT * FROM `appointments` WHERE `status` != 0 AND `company_id` = '".$_SESSION['control_company']."';";
        $appointments_array = $db->all($sql);
        if(count($appointments_array) == 0){
            $html .= $elements->small_title('В управляемой компании нет должностей. Добавьте их.');
        }   else {
            foreach ($appointments_array as $appointments_item) {
                $html .= $elements->item($appointments_item['name'], 'appointment_' . $appointments_item['id'], '', '', 'appointment_id=' . $appointments_item['id']);
            }
        }

        return $html;
    }
}
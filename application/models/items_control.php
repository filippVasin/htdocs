<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_items_control{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // Добавление нового компании;
    public function add(){
        global $db, $elements;

        $item_name = $this->post_array['name'];
        $item_type = $this->post_array['item_type'];

        $sql = "INSERT INTO `items_control` (`company_id`, `type_id`, `name`) VALUES('".$_SESSION['control_company']."', '".$item_type."', '".$item_name."');";
        $db->query($sql);

        $new_item_id = mysqli_insert_id($db->link_id);

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Новый элемент успешно добавлен';
        $result_array['new_item'] = $elements->item($item_name, 'item_'.$new_item_id, '', '', 'item_id='.$new_item_id);

        $result = json_encode($result_array, true);
        die($result);
    }

    // Получаем список типов элементов;
    public function get_items_types_select(){
        global $db, $elements;

        $sql = "SELECT * FROM `items_control_types`;";
        $items = $db->all($sql);

        $items_select = array();
        $items_select[] = array('value' => -1, 'caption' => 'Все', 'selected' => '1', 'disabled' => '');
        foreach($items as $item){
            $items_select[] = array('value' => $item['id'], 'caption' => $item['name'], 'selected' => '', 'disabled' => '');
        }

        return $elements->combobox('Выберите тип эелемента', $items_select, 'control_item_type_select');
    }

    // Получаем список отделов в компании;
    public function get_exist_elements(){
        global $db, $elements;

        $type_id = $this->post_array['selected_item_type'];

        $sql = "SELECT * FROM `items_control` WHERE `status` != 0 AND `company_id` = '".$_SESSION['control_company']."' AND `type_id` = '".$type_id."';";
        $elements_array = $db->all($sql);

        $result_array['status'] = 'ok';
        $result_array['message'] = 'Данные успешно загружены';
        $result_array['items'] = array();

        if(count($elements_array) > 0){
            foreach($elements_array as $elements_item){
                $result_array['items'][] = $elements->item($elements_item['name'], 'item_' . $elements_item['id'], '', '', 'item_id=' . $elements_item['id']);
            }
        }   else{
            $result_array['items'][] = $elements->small_title('В выбранной комбинации нет сотрудников', 'no_apps');
        }

        $result = json_encode($result_array, true);
        die($result);
    }
}
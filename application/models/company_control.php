<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_company_control{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // Поулчаем список компаний;
    public function load_company_table(){
        global $db, $elements;

        $html = '';

        $sql = "SELECT * FROM `company` WHERE `status` != 0 AND `author_user_id` = '".$_SESSION['user_id']."';";
        $company_array = $db->all($sql);
        foreach($company_array as $company_item){
            $html .= $elements->company_item($company_item['name'].' ('.$company_item['short_name'].') / '.$company_item['director_surname'].' '.$company_item['director_name'].' '.$company_item['director_second_name'], 'company_'.$company_item['id'], ($company_item['id'] == $_SESSION['control_company'] ? 'on_company' : 'off_company'), '', 'company_id='.$company_item['id']);
        }

        return $html;
    }

    // Добалвяем новую компанию;
    public function add(){
        global $db, $elements;

        $post_data = $this->post_array;

        $name = $post_data['company_name'];
        $short_name = $post_data['company_short_name'];
        $new_company_director_surname = $post_data['new_company_director_surname'];
        $new_company_director_name = $post_data['new_company_director_name'];
        $new_company_director_second_name = $post_data['new_company_director_second_name'];

        $sql = "INSERT INTO `company` (`name`, `short_name`, `author_user_id`, `director_surname`, `director_name`, `director_second_name`)
            VALUES('".$name."', '".$short_name."', '".$_SESSION['user_id']."', '".$new_company_director_surname."', '".$new_company_director_name."', '".$new_company_director_second_name."');";
        $db->query($sql);
        $new_item_id = mysqli_insert_id($db->link_id);

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Новая компания успешно добавлена';
        $result_array['new_item'] = $elements->company_item($name.' ('.$short_name.') / '.$new_company_director_surname.' '.$new_company_director_name.' '.$new_company_director_second_name, 'company_'.$new_item_id, 'off_company', '', 'company_id='.$new_item_id);

        $result = json_encode($result_array, true);
        die($result);
    }

    // Устанавливаем компанию для упарвления;
    public function set_company_control(){
        global $db;

        $post_data = $this->post_array;

        $company_id = $post_data['company_id'];

        $sql = "SELECT * FROM `company` WHERE `id` = '".$company_id."';";
        $company_data = $db->row($sql);

        $_SESSION['control_company'] = $company_id;
        $_SESSION['control_company_name'] = $company_data['short_name'];

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Включен контроль выбранной компании';

        $result = json_encode($result_array, true);
        die($result);
    }
}
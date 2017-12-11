<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_login{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function try_login(){
        global $db,$labro;

        $login = $this->post_array['login'];
        $password = $this->post_array['password'];

        $sql = "SELECT `id`, `role_id`, `employee_id` FROM `users` WHERE `name` = '".$login."' AND `password` = '".md5($password)."';";

        $login_data = $db->row($sql);


        $result_array = array();
        if($login_data['id'] != '') {

            // получаем данные сессии
            $result_array = $labro->get_a_session($login_data['id']);

        }   else {
            $result_array['status'] = 'error';
            $result_array['message'] = 'Неверный логин или пароль!';
        }
        // Отправили зезультат
        return json_encode($result_array);
    }
}
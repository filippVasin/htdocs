<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_url_auth{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function start(){
        global $db, $labro, $get_params;
        if ($get_params!="") {
            echo $get_params;
            $hash = htmlspecialchars($_GET["$get_params"]);

            $sql = "SELECT `user_id` FROM `url_hash` WHERE `hash` = '" . $hash . "';";
            $login_data = $db->row($sql);

            $result_array = array();
            if ($login_data['user_id'] != '') {

                // получаем данные сессии
                $labro->get_a_session($login_data['id']);
                header("Location: /main");
            } else {
                $result_array['status'] = 'error';
                $result_array['message'] = 'Неверный логин или пароль!';
                header("Location: /login");
            }
        }
    }
}

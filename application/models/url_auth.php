<?php

class Model_url_auth{
    // Данные для обработки POST запросов;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function start($hash){
        global $db, $labro;

        if ($hash!="") {
        echo $hash;// тестим

            $sql = "SELECT `user_id` FROM `url_hash` WHERE `hash` = '" . $hash . "';";
            $login_data = $db->row($sql);

            $result_array = array();// пока не удалять, протестить
            if ($login_data['user_id'] != '') {
                // получаем данные сессии
                $result_array = $labro->get_a_session($login_data['user_id']);
                // отправляем по адресу
                if($result_array['status'] == 'company') {
                    header("Location: /main");
                }
                if($result_array['status'] == 'employee') {
                    header("Location: /rover");
                }

            } else {
                echo "<br>Нет";
                header("Location: /login");
            }
        }
    }
}










//global $db, $labro, $get_params;
//if ($get_params!="") {
//            echo $get_params;
//            $hash = htmlspecialchars($_GET["$get_params"]);
//
//            $sql = "SELECT `user_id` FROM `url_hash` WHERE `hash` = '" . $hash . "';";
//            $login_data = $db->row($sql);
//
//            $result_array = array();
//            if ($login_data['user_id'] != '') {
//
//                // получаем данные сессии
//                $labro->get_a_session($login_data['id']);
//                header("Location: /main");
//            } else {
//                $result_array['status'] = 'error';
//                $result_array['message'] = 'Неверный логин или пароль!';
//                header("Location: /login");
//            }
//}
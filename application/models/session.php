<?php

class Model_session
{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }


    // Начинаем прохождение тестирования;
    public function get_session(){
        $session_variable = $this->post_array['session_variable'];

        switch ($session_variable) {
            case "employee_id":
                $result_array['content'] = $_SESSION['employee_id'];
                break;
            case "role_id":
                $result_array['content'] = $_SESSION['role_id'];
                break;
            case "control_company":
                $result_array['content'] = $_SESSION['control_company'];
                break;
            case "user_id":
                $result_array['content'] =  $_SESSION['user_id'];
                break;
        }

        $result_array['status'] = "ok";
        $result = json_encode($result_array, true);
        die($result);
    }

}
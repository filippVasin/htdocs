<?php

class Model_doc_views{
    // Данные для обработки POST запросов;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function start($doc_link){
        global $db;
        $flag = "open";
        $page = "";
        $lorem = 0;
        if($_SESSION['employee_id'] == "" ){
            $_SESSION['employee_id'] = 2; // рыба
            $lorem = 1;
        }

        include(ROOT_PATH.'/application/templates_form/'.$doc_link.'.php');

        if($lorem = 1){
            $_SESSION['employee_id'] = "";
        }

        return $page;
    }


}






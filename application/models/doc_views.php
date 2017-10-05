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

        include(ROOT_PATH.'/application/templates_form/'.$doc_link.'.php');

        return $page;
    }


}






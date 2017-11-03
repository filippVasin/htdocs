<?php

class Model_doc_views{
    // Данные для обработки POST запросов;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function start($doc_link){

        $get_data = explode('&', $doc_link);
        $doc = $get_data[0];
        $emp = $get_data[2];
        switch ($get_data[1]) {
            case "company_forms":
                $page = $this->company_forms_views($doc);
                break;
            case "start_blank":
                $page = $this->creator_views($doc,$emp);
                break;
            case "probation":
                $page = $this->probation($doc,$emp);
                break;
        }
        return $page;
    }

    private function company_forms_views($doc){
        global $db;
        $flag = "open";
        $page = "";
        $lorem = 0;
        if ($_SESSION['employee_id'] == "") {
            $_SESSION['employee_id'] = 2; // рыба
            $lorem = 1;
        }

        include(ROOT_PATH . '/application/templates_form/' . $doc . '.php');

        if ($lorem = 1) {
            $_SESSION['employee_id'] = "";
        }
        $page .='<div id="print" class="button">Печать</div>';
        return $page;
    }

    private function creator_views($doc,$emp){
        global $db;
        $flag = "open";
        $page = "";
        $lorem = 0;
        $employee_id = $emp;
        if ($_SESSION['employee_id'] == "") {
            $_SESSION['employee_id'] = 2; // рыба
            $lorem = 1;
        }

        include(ROOT_PATH . '/application/templates_form/' . $doc . '.php');

        if ($lorem == 1) {
            $_SESSION['employee_id'] = "";
        }
        $page .='<div id="print" class="button">Печать</div>';
        return $page;
    }

    private function probation($doc,$emp){
        global $db;
        $flag = "open";
        $page = "";
        $lorem = 0;
        $employee_id = $emp;
        $company_id = 29;
        include(ROOT_PATH . '/application/templates_form/' . $doc . '.php');

        $page .='<div id="print" class="button">Печать</div>';
        return $page;
    }


}






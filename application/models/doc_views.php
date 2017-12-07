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
            case "emp_doc":
                $page = $this->emp_doc($doc);
                break;
        }
        return $page;
    }

    private function company_forms_views($doc){
        global $db, $labro;
        $flag = "open";
        $page = "";
        $lorem = 0;
        if ($_SESSION['employee_id'] == "") {
            $_SESSION['employee_id'] = 2; // рыба
            $lorem = 1;
        }
        $employee_id = $_SESSION['employee_id'];
        $company_id = $labro->get_org_str_id($_SESSION['employee_id']);

        include(ROOT_PATH . '/application/templates_form/' . $doc . '.php');

        if ($lorem = 1) {
            $_SESSION['employee_id'] = "";
        }
        $page .='<div id="print" class="button">Печать</div>';
        return $page;
    }

    private function creator_views($doc,$emp){
        global $db, $labro;
        $flag = "open";
        $page = "";
        $lorem = 0;
        $employee_id = $emp;
        if ($_SESSION['employee_id'] == "") {
            $_SESSION['employee_id'] = 2; // рыба
            $lorem = 1;
        }
        $company_id = $labro->get_org_str_id($_SESSION['employee_id']);

        include(ROOT_PATH . '/application/templates_form/' . $doc . '.php');

        if ($lorem == 1) {
            $_SESSION['employee_id'] = "";
        }
        $page .='<div id="print" class="button">Печать</div>';
        return $page;
    }

    private function probation($doc,$emp){
        global $db, $labro;
        $flag = "open";
        $page = "";
        $lorem = 0;
        $employee_id = $emp;
        if ($_SESSION['employee_id'] == "") {
            $_SESSION['employee_id'] = 2; // рыба
            $lorem = 1;
        }
        $company_id = $labro->get_org_str_id($_SESSION['employee_id']);
        include(ROOT_PATH . '/application/templates_form/' . $doc . '.php');

        if ($lorem == 1) {
            $_SESSION['employee_id'] = "";
        }

        $page .='<div id="print" class="button">Печать</div>';
        return $page;
    }

    private function emp_doc($file_id){
        global $db;
        $flag = "open";
        $page = "";

        $sql="SELECT * FROM save_temp_files WHERE save_temp_files.id =". $file_id;
        $doc_data = $db->row($sql);

        $path = $doc_data['path'];

        $page = ROOT_PATH.'/'.$path;

        $page = file_get_contents($page);
        $page .='<div id="print" class="button">Печать</div>';
        return $page;
    }
}






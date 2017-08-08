<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_company_forms{


    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else(){
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }



    // тестим здесь
    public function start()
    {


        global $db;

        $sql = "SELECT temp_doc_form.name AS `temp`, type_form.name AS `type`
                FROM company_temps
                LEFT JOIN type_temp ON type_temp.id = company_temps.temp_type_id
                LEFT JOIN type_form ON type_form.id = type_temp.type_form_id
                LEFT JOIN temp_doc_form ON temp_doc_form.id = type_temp.temp_form_id
                WHERE company_temps.company_id =" .  $_SESSION['control_company'];
        $employees = $db->all($sql);


        $html = "<div class='page_title'>". $_SESSION['control_company_name'] ."</div>";
        $html .="<div class='form_table'>";
        $html .= "<div class='row'><div class='title_column_form'>Тип Документа</div><div class='title_column_form'>Название Документа</div></div>";
        foreach($employees as $employee){
            $html.= "<div class='row'><div class='type_form'>".$employee['type']."</div><div class='temp_form'>" .$employee['temp']."</div></div>";
        };
        $html .="</div>";
        return $html;
    }

    // тестим здесь
//    public function reset_progress()
//    {
//        global $db;
//        $reset_id = $this->post_array['reset_id'];
//
//        $sql = "DELETE FROM `history_docs` WHERE  `employee_id`=" . $reset_id;
//
//
////        $date_finish = NULL;
////        $sql = "UPDATE `history_docs` SET `date_finish`='" . $date_finish . "' WHERE  `employee_id`='" . $reset_id . "'";
////        $db->query($sql);
//
//        $db->query($sql);
//
//        $html = $reset_id;
//        $result_array['content'] = $html;
//        $result_array['status'] = 'ok';
//
//        $result = json_encode($result_array, true);
//        die($result);
//    }

}
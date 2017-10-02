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

        if(!(isset($_SESSION['control_company']))){
            header("Location:/company_control");
        }

        $sql = "SELECT temp_doc_form.name AS `temp`, type_form.name AS `type`, temp_doc_form.path AS path
                 FROM company_temps
                LEFT JOIN type_temp ON type_temp.id = company_temps.temp_type_id
                LEFT JOIN type_form ON type_form.id = type_temp.type_form_id
                LEFT JOIN temp_doc_form ON temp_doc_form.id = type_temp.temp_form_id
                WHERE company_temps.company_id =" .  $_SESSION['control_company'];
        $employees = $db->all($sql);




        $html ="<div class='form_table'>";
        $html .= "<div class='row'><div class='title_column_form type'>Тип Документа</div><div class='title_column_form temp'>Название Документа</div></div>";
        foreach($employees as $employee){

            $html.= "<a href='/doc_views?". $employee['path'] ."' target='_blank'> <div class='row link'><div class='type_form'>".$employee['type']."</div><div class='temp_form'>" .$employee['temp']."</div></div></a>";
        };
        $html .="</div>";
        return $html;
    }



}
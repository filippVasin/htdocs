<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_step_editor
{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // тестим здесь
    public function start(){
        global $db;

        if(!(isset($_SESSION['control_company']))){
            header("Location:/company_control");
        }

        $sql="SELECT
                step_content.id AS content_id,
                step_content.test_id,
                step_content.doc_id,
                step_content.form_id,
                step_content.manual_id,
                route_control_step.track_number_id,
                route_control_step.step_name
                FROM step_content,route_control_step, route_doc
                WHERE route_doc.company_id = ". $_SESSION['control_company'] ."
                AND route_doc.id = route_control_step.`track_number_id`
                AND step_content.id = route_control_step.step_content_id";

        $steps_data = $db->all($sql);
        $html = "";
        $html .= "<div class='content_row_title' attr_i>
                    <div class='content_id'>Шаг</div>
                    <div class='track_number_id'>Трек</div>
                    <div class='step_name'>Название Шага</div>
                    <div class='test_id'>Тест</div>
                    <div class='doc_id'>Инструкция</div>
                    <div class='form_id'>Документ</div>
                    <div class='manual_id'>Мануал</div>
                </div>";
        foreach ($steps_data as $step_data) {
            $html .= "<div class='content_row'>";
                $html .="<div class='content_id'>". $step_data['content_id'] ."</div>";
                $html .="<div class='track_number_id'>". $step_data['track_number_id'] ."</div>";
                $html .="<div class='step_name'>". $step_data['step_name'] ."</div>";
                $html .="<div class='test_id item' content_id='". $step_data['content_id']  ."'>". $step_data['test_id'] ."</div>";
                $html .="<div class='doc_id item'  content_id='". $step_data['content_id']  ."'>".$step_data['doc_id'] ."</div>";
                $html .="<div class='form_id item'  content_id='". $step_data['content_id']  ."'>". $step_data['form_id'] ."</div>";
                $html .="<div class='manual_id item '  content_id='". $step_data['content_id']  ."'>". $step_data['manual_id'] ."</div>";
            $html .="</div>";
        };


        // тесты
        $sql="SELECT * FROM control_tests";
        $test_data = $db->all($sql);

        $html .='<div id="edit_popup" class="popup none">';
        $html .='<div class="canvas">';
        $html .='<div class="control_tests">';
        $html .='<div class="row_tests" test_id="0"><div class="num">0</div><div class="name">Сбросить тест</div></div>';
        foreach ($test_data as $test_item) {
            $html .='<div class="row_tests" test_id="'. $test_item['id'] .'">';
                $html .='<div class="num">'. $test_item['id'] .'</div><div class="name">'. $test_item['test_name'] .'</div>';
            $html .='</div>';
        }
        $html .='</div>';
        $html .='<div class="button_row">';
//        $html .='<div class="button" id="drop_popup_input">Сбросить</div>';
        $html .='<div class="button cancel_popup">Отмена</div>';
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';

        // инструкции
        $sql="SELECT * FROM control_doc";
        $test_data = $db->all($sql);

        $html .='<div id="inst_edit_popup" class="popup none">';
        $html .='<div class="canvas">';
        $html .='<div class="control_tests">';
        $html .='<div class="row_inst" doc_id="0"><div class="num">0</div><div class="name">Сбросить инструкцию</div></div>';
        foreach ($test_data as $test_item) {
            $html .='<div class="row_inst" doc_id="'. $test_item['id'] .'">';
            $html .='<div class="num">'. $test_item['id'] .'</div><div class="name">'. $test_item['doc_name'] .'</div>';
            $html .='</div>';
        }
        $html .='</div>';
        $html .='<div class="button_row">';
//        $html .='<div class="button" id="drop_popup_input">Сбросить</div>';
        $html .='<div class="button cancel_popup">Отмена</div>';
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';

        // документ
        $sql="SELECT company_temps.id, temp_doc_form.name
                FROM company_temps, type_temp, type_form,temp_doc_form
                WHERE company_temps.temp_type_id = type_temp.id
                AND temp_doc_form.id = type_temp.temp_form_id
                AND company_temps.company_id = ". $_SESSION['control_company'] ."
                GROUP BY id";
        $test_data = $db->all($sql);

        $html .='<div id="doc_edit_popup" class="popup none">';
        $html .='<div class="canvas">';
        $html .='<div class="control_tests">';
        $html .='<div class="row_doc" form_id="0"><div class="num">0</div><div class="name">Сбросить документ</div></div>';
        foreach ($test_data as $test_item) {
            $html .='<div class="row_doc" form_id="'. $test_item['id'] .'">';
            $html .='<div class="num">'. $test_item['id'] .'</div><div class="name">'. $test_item['name'] .'</div>';
            $html .='</div>';
        }
        $html .='</div>';
        $html .='<div class="button_row">';
//        $html .='<div class="button" id="drop_popup_input">Сбросить</div>';
        $html .='<div class="button cancel_popup">Отмена</div>';
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';

        // мануал
        $sql="SELECT * FROM manual_doc";
        $test_data = $db->all($sql);

        $html .='<div id="manual_edit_popup" class="popup none">';
        $html .='<div class="canvas">';
        $html .='<div class="control_tests">';
        $html .='<div class="row_manual" manual_id="0"><div class="num">0</div><div class="name">Сбросить мануал</div></div>';
        foreach ($test_data as $test_item) {
            $html .='<div class="row_manual" manual_id="'. $test_item['id'] .'">';
            $html .='<div class="num">'. $test_item['id'] .'</div><div class="name">'. $test_item['name'] .'</div>';
            $html .='</div>';
        }
        $html .='</div>';
        $html .='<div class="button_row">';
//        $html .='<div class="button" id="drop_popup_input">Сбросить</div>';
        $html .='<div class="button cancel_popup">Отмена</div>';
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';

        return $html;
    }


    public function save_test(){
        global $db;

        $content_id = $this->post_array['content_id'];
        $test_id = $this->post_array['test_id'];

        if($test_id == 0){
            $sql="UPDATE step_content
                SET test_id = NULL
                WHERE id =" .$content_id;
        } else {
            $sql = "UPDATE step_content
                SET test_id = ". $test_id ."
                WHERE id =" .$content_id;
        }
        $db->query($sql);

        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function save_doc(){
        global $db;

        $content_id = $this->post_array['content_id'];
        $doc_id = $this->post_array['doc_id'];

        if($doc_id == 0){
            $sql = "UPDATE step_content
                SET doc_id = NULL
                WHERE id =" .$content_id;
        } else {
            $sql = "UPDATE step_content
                SET doc_id = ". $doc_id ."
                WHERE id =" .$content_id;
        }
        $db->query($sql);

        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function save_form(){
        global $db;

        $content_id = $this->post_array['content_id'];
        $form_id = $this->post_array['form_id'];

        if($form_id == 0){
            $sql = "UPDATE step_content
                SET form_id = NULL
                WHERE id =" .$content_id;
        } else {
            $sql = "UPDATE step_content
                SET form_id = ". $form_id ."
                WHERE id =" .$content_id;
        }
        $db->query($sql);

        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function save_manual()
    {
        global $db;

        $content_id = $this->post_array['content_id'];
        $manual_id = $this->post_array['manual_id'];

        if ($manual_id == 0) {
            $sql = "UPDATE step_content
                SET manual_id = NULL
                WHERE id =" . $content_id;
        } else {
            $sql = "UPDATE step_content
                SET manual_id = " . $manual_id . "
                WHERE id =" . $content_id;
        }
        $db->query($sql);

        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

}



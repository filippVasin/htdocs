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



        $sql="SELECT * FROM control_tests";
        $test_data = $db->all($sql);

        $html .='<div id="edit_popup">';
        $html .='<div class="canvas">';
        $html .='<div id="control_tests">';
        $html .='<div class="row_tests" test_id="0"><div class="num">0</div><div class="name">Сбросить тест</div></div>';
        foreach ($test_data as $test_item) {
            $html .='<div class="row_tests" test_id="'. $test_item['id'] .'">';
                $html .='<div class="num">'. $test_item['id'] .'</div><div class="name">'. $test_item['test_name'] .'</div>';
            $html .='</div>';
        }
        $html .='</div>';


        $html .='<div class="button_row">';
//        $html .='<div class="button" id="drop_popup_input">Сбросить</div>';
        $html .='<div class="button" id="cancel_popup">Отмена</div>';
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
        $result = json_encode($result_array, true);
        die($result);
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
        $result = json_encode($result_array, true);
        die($result);
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
        $result = json_encode($result_array, true);
        die($result);
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
        $result = json_encode($result_array, true);
        die($result);
    }

    // Обработка результатов тестирования;
    public function save_period(){
        global $db;

        $id = $this->post_array['id'];
        $period_id = $this->post_array['period_id'];

        if($period_id == 0){
            $sql = "UPDATE route_control_step
                SET periodicity = NULL
                WHERE id =" .$id;
        } else {
            $sql = "UPDATE route_control_step
                SET periodicity = ". $period_id ."
                WHERE id =" .$id;
        }
        $db->query($sql);

        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }
}



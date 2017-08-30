<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_period_control
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



        $sql="SELECT route_control_step.id,route_control_step.step_name,route_control_step.periodicity
                FROM route_control_step, route_doc
                WHERE route_doc.company_id = ". $_SESSION['control_company'] ."
                AND route_doc.id = route_control_step.`track_number_id`";

        $period_data = $db->all($sql);
        $html = "";
        $html .= "<div class='inst_row_title'>
                    <div class='inst_name'>Название инструктажа:</div>
                    <div class='pre_intr'>Повторять через(месяцев)</div>
                </div>";
        foreach ($period_data as $period_data) {
                $html .= "<div class='period_row' attr_id='". $period_data['id']  ."'>";
//                $html .="<div class='period_id'>". $period_data['id'] ."</div>";
                $html .="<div class='period_name'>". $period_data['step_name'] ."</div>";
                $html .="<input type='text' class='period_count' value='" . $period_data['periodicity'] ."' period_count='". $period_data['id']  ."' placeholder='нет'>";
                $html .="<div class='save_period' id='". $period_data['id']  ."'>Сохранить</div>";
                $html .="</div>";
        };
        return $html;
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



<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_period_control extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        $period = $this->model->start();
        $this->view = str_replace('%period%', $period, $this->view);
    }


    // Обработка результатов тестирования;
    public function save_period(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;
        // Обрабатываем результат;
        $this->model->save_period();
    }
}
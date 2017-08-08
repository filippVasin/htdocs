<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_company_forms extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        $start = $this->model->start();
        $this->view = str_replace('%company_forms%', $start, $this->view);

    }



//
//    // сброс данных для тестировщика
//    public function reset_progress($post_data){
//        // Записываем массив с даннми в домель;
//        $this->model->post_array = $post_data;
//        // функция сброса
//        $this->model->reset_progress();
//    }

}
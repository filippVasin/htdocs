<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_pass_test extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){

    }

    // Начало выполнения теста;
    public function start($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;

        // Запршиваем у модели начало тестирования;
        $this->model->start();
    }

    // Обработка результатов тестирования;
    public function processing_results($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;

        // Обрабатываем результат;
        $this->model->processing_results();
    }
}
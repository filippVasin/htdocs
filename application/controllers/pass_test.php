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
        $html = $this->model->go_hm();
        $this->view = str_replace('%go_hm%', $html, $this->view);
    }

    // Начало выполнения теста;
    public function start(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;

        // Запршиваем у модели начало тестирования;
        $this->model->start();
    }

    // Обработка результатов тестирования;
    public function processing_results(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;

        // Обрабатываем результат;
        $this->model->processing_results();
    }
}
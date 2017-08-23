<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_step_editor extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        $period = $this->model->start();
        $this->view = str_replace('%step_editor%', $period, $this->view);
    }


    public function save_test($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;
        // Обрабатываем результат;
        $this->model->save_test();
    }
    public function save_doc($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;
        // Обрабатываем результат;
        $this->model->save_doc();
    }
    public function save_form($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;
        // Обрабатываем результат;
        $this->model->save_form();
    }
    public function save_manual($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;
        // Обрабатываем результат;
        $this->model->save_manual();
    }
}
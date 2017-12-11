<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_forms extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){

    }

    public function start(){
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->start();
        $this->view = $result;
    }

    // Начало выполнения теста;
    public function yes(){
        $result = $this->model->yes();
        $this->view = $result;
    }
}
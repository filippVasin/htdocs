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
//        $result=$this->model->start();
//        $this->view = str_replace('%forms%', $result, $this->view);
    }

    public function start(){
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->start();
    }

    // Начало выполнения теста;
    public function yes(){
        $this->model->yes();
    }
}
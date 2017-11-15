<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_main extends Controller{
    // model, view и pointer - объявлены в родительском классе;



    public function exec_default(){
        $result=$this->model->journal();
        $this->view = str_replace('%journal%', $result, $this->view);
    }


    public function start(){
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->start();
    }

    public function show_something(){
        $this->model->show_something_else();
    }

    public function change_viewer(){
        $this->view = str_replace('%some_var%', (isset($this->pointer) && $this->pointer != '' ? $this->pointer : 'CHANGED'), $this->view);
    }

    public function events(){
        $get_date = $this->get_params;
        $this->model->events($get_date);
    }

    public function calendar(){
        $get_date = $this->get_params;
        $this->model->calendar($get_date);
    }
}
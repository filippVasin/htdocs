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
        $result = $this->model->start();
        $this->view = $result;
    }

    public function show_something(){
        $result = $this->model->show_something_else();
        $this->view = $result;
    }

    public function change_viewer(){
        $this->view = str_replace('%some_var%', (isset($this->pointer) && $this->pointer != '' ? $this->pointer : 'CHANGED'), $this->view);
    }

    public function events(){
        $get_date = $this->get_params;
        $result = $this->model->events($get_date);
        $this->view = $result;
    }

    public function calendar(){
        $get_date = $this->get_params;
        $result = $this->model->calendar($get_date);
        $this->view = $result;
    }
}
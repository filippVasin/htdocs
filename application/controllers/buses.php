<?php

class Controller_buses extends Controller
{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){

        $result = $this->model->start();
        $this->view = str_replace('%buses%', $result, $this->view);

    }


    // получаем дерево должностей
    public function bus_row_edit(){
        $this->model->post_array = $this->post_params;
        $this->model->bus_row_edit();
    }
//
//    public function action_history_docs()
//    {
//        $this->model->post_array = $this->post_params;
//        $this->model->action_history_docs();
//    }
//
//    public function select()
//    {
//        $this->model->post_array = $this->post_params;
//        $this->model->select();
//    }

}
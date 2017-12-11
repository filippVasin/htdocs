<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_action_list extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        $list=$this->model->start();
        $this->view = str_replace('%list%', $list, $this->view);
    }

    public function new_action_name(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->new_action_name();
        $this->view = $result;
    }
}
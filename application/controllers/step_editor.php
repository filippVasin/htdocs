<?php

class Controller_step_editor extends Controller{

    public function exec_default(){
        $period = $this->model->start();
        $this->view = str_replace('%step_editor%', $period, $this->view);
    }


    public function save_test($post_data){
        $this->model->post_array = $post_data;
        $this->model->save_test();
    }
    public function save_doc($post_data){
        $this->model->post_array = $post_data;
        $this->model->save_doc();
    }
    public function save_form($post_data){
        $this->model->post_array = $post_data;
        $this->model->save_form();
    }
    public function save_manual($post_data){
        $this->model->post_array = $post_data;
        $this->model->save_manual();
    }

    public function save_period($post_data){
        $this->model->post_array = $post_data;
        $this->model->save_period();
    }
}
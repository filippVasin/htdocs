<?php

class Controller_step_editor extends Controller{

    public function exec_default(){
        $period = $this->model->start();
        $this->view = str_replace('%step_editor%', $period, $this->view);
    }


    public function save_test(){
        $this->model->post_array = $this->post_params;
        $this->model->save_test();
    }
    public function save_doc(){
        $this->model->post_array = $this->post_params;
        $this->model->save_doc();
    }
    public function save_form(){
        $this->model->post_array = $this->post_params;
        $this->model->save_form();
    }
    public function save_manual(){
        $this->model->post_array = $this->post_params;
        $this->model->save_manual();
    }

}
<?php

class Controller_master_report extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        // по умолчанию
    }

    public function main($post_data){
        $this->model->post_array = $post_data;
        $this->model->main();
    }


}
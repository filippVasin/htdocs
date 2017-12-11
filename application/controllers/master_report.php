<?php

class Controller_master_report extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        // по умолчанию
    }

    public function main(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->main();
        $this->view = $result;
    }


}
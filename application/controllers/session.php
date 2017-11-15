<?php

class Controller_session extends Controller{

    public function exec_default(){
        // по умолчанию умалчиваем
    }

    public  function get_session(){
        $this->model->post_array = $this->post_params;
        $this->model->get_session();
    }


}
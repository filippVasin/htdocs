<?php

class Controller_url_auth extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        $this->model->start();
    }

}
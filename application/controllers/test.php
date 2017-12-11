<?php

class Controller_test extends Controller{

    public function exec_default(){

        $result = $this->model->test();
        $this->view = $result;
    }

}
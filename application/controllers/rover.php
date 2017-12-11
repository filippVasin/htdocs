<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_rover extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        $result = $this->model->start();
        $this->view = $result;
    }



}
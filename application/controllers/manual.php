<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_manual extends Controller{

    // model, view и pointer - объявлены в родительском классе;
    public function exec_default(){
        $manual = $this->model->start();
        $this->view = str_replace('%manual%', $manual, $this->view);
    }
    // ознакомился
    public function yes(){
        $this->model->yes();
    }
    // документ не показали
    public function error(){
        $this->model->error();
    }
}
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
        $result = $this->model->yes();
        $this->view = $result;
    }
    // документ не показали
    public function error(){
        $result = $this->model->error();
        $this->view = $result;
    }
}
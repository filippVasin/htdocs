<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_company_forms extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        $start = $this->model->start();
        $this->view = str_replace('%company_forms%', $start, $this->view);

    }


    public function look_file($post_data){
        $this->model->post_array = $post_data;
        // функция сброса
        $this->model->look_file();
    }

}
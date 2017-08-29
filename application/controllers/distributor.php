<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_distributor extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
    // по умолчанию
    }

    public function main($post_data){
        $this->model->post_array = $post_data;
        $this->model->main();
    }

}
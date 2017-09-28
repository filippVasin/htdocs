<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_structure extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
         $selector = $this->model->test();
        $this->view = str_replace('%select%', $selector, $this->view);
    }

}
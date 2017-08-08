<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_test extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
        $this->model->test();
    }

}
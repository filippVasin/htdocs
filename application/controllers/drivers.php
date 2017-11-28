<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_drivers extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
        $selector = $this->model->drivers_table();
        $this->view = str_replace('%drivers_table%', $selector, $this->view);
    }


}
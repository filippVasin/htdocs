<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_login extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
//        echo phpinfo();

    }

    // Попытка авторизаци;
    public function try_login(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;
        // Запускаем метод;
        $result = $this->model->try_login();
        $this->view = $result;
    }
}
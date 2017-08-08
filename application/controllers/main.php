<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_main extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){

    }

    public function show_something(){
        //echo 'Метод выполняется в контроллере вызванные маршрутом '.__FUNCTION__.'<br>';
        // Предположим что этот метод должен вызвать метод из модели;
        $this->model->show_something_else();
    }

    public function change_viewer(){
        $this->view = str_replace('%some_var%', (isset($this->pointer) && $this->pointer != '' ? $this->pointer : 'CHANGED'), $this->view);
    }
}
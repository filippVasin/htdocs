<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_boards_control extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        // Получаем список компаний из модели;
        $boards_list = $this->model->get_boards_list();

        // Строим таблицу с компаниями;
        $this->view = str_replace('%boards_list%', $boards_list, $this->view);
    }

    // Добавление отдела;
    public function add($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;

        // Запускаем метод;
        $this->model->add();
    }
}
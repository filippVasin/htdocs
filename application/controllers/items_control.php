<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_items_control extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        // Получаем список элементов;
        $departments_list = $this->model->get_items_types_select();

        // Выводим этот список;
        $this->view = str_replace('%item_type_select%', $departments_list, $this->view);
    }

    // Добавление отдела;
    public function add($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;

        // Запускаем метод;
        $this->model->add();
    }

    // Получаемс содержимое для выбранного элемента;
    public function get_exist_elements($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;

        // Запускаем метод;
        $this->model->get_exist_elements();
    }
}
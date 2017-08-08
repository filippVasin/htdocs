<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_employees_control extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        // Подменяем списки;
        /*
        $departments_selector = $this->model->get_departments_select();
        $appointments_selector = $this->model->get_appointments_select();
        $boards_selector = $this->model->get_boards_select();

        $this->view = str_replace('%departments_select%', $departments_selector, $this->view);
        $this->view = str_replace('%appointments_select%', $appointments_selector, $this->view);
        $this->view = str_replace('%boards_select%', $boards_selector, $this->view);
        */

        $all_selectors = $this->model->get_items_selects();

        $this->view = str_replace('%items_selects%', $all_selectors, $this->view);
    }

    // Добавление сотрудника;
    public function add($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;

        // Запускаем метод;
        $this->model->add();
    }

    // ПОлучаем спискок сотрудников когда у нас выбран какой-то отдел или должность;
    public function get_employees($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;

        // Запускаем метод;
        $this->model->get_employees();
    }
}
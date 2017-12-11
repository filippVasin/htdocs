<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_creator extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
        $selector = $this->model->select_one();
        $this->view = str_replace('%creator%', $selector, $this->view);
    }




    public function select_event(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->select_event();
        $this->view = $result;
    }

    public function create_form(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->create_form();
        $this->view = $result;
    }

    public function create_drivers(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->create_drivers();
        $this->view = $result;
    }


    public function button_plus(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->button_plus();
        $this->view = $result;
    }

    public function new_type_select(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->new_type_select();
        $this->view = $result;
    }
    public function save_new_type_select(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->save_new_type_select();
        $this->view = $result;
    }
    public function get_input(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->get_input();
        $this->view = $result;
    }

}
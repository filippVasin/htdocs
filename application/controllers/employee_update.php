<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_employee_update extends Controller{

    public function exec_default(){
        // строим таблицу сотрудников
        $upload_data = $this->model->upload_data();
        $this->view = str_replace('%update_employees_table_box%', $upload_data, $this->view);
    }

    // получаем дерево должностей
    public function load_positions_tree(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->load_positions_tree();
    }

    // меняем должность сотрудника
    public function update_position_yes(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->update_position_yes();
    }


    // увольняем сотрудника
    public function delete_employee_yes(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->delete_employee_yes();
    }

    // получаем ереархию новой должности
    public function load_new_erarch(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->load_new_erarch();
    }
}
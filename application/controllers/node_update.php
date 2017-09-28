<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_node_update extends Controller{

    public function exec_default(){
        // строим таблицу сотрудников
        $upload_data = $this->model->upload_data();
        $this->view = str_replace('%update_node_table_box%', $upload_data, $this->view);
    }

    // получаем дерево должностей
    public function load_positions_tree(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->load_positions_tree();
    }

    // меняем положение узла
    public function update_node_yes(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->update_node_yes();
    }


    // удаление узла
    public function delete_node_yes(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->delete_node_yes();
    }


    // меняем положение узла
    public function load_old_erarch(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $this->model->load_old_erarch();
    }
}
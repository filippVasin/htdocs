<?php

class Controller_editor extends Controller{

    public function exec_default(){
        // строим таблицы
        // Тип
        $table_type = $this->model->table_type();
        $this->view = str_replace('%table_type%', $table_type, $this->view);
        // Нуменклатура
        $table_num = $this->model->table_num();
        $this->view = str_replace('%table_num%', $table_num, $this->view);
        // Сотрудники
        $table_users = $this->model->mix_table();
        $this->view = str_replace('%mix_table%', $table_users, $this->view);
    }


    public function save_popup_input(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->save_popup_input();
        $this->view = $result;
    }

    // карточка сотрудника
    public function employee_card(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->employee_card();
        $this->view = $result;
    }
    // меняем карточку сотрудника
    public function save_employee_card(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->save_employee_card();
        $this->view = $result;
    }
    // получаем карточку user
    public function user_card(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->user_card();
        $this->view = $result;
    }

    // меняем карточку user
    public function save_user_card(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->save_user_card();
        $this->view = $result;
    }

    public function plus_type(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->plus_type();
        $this->view = $result;
    }

    public function plus_directory(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->plus_directory();
        $this->view = $result;
    }

    public function delete_item(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->delete_item();
        $this->view = $result;
    }

    public function select_node_list(){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $this->post_params;
        // Вызываем метод показа всего дерева
        $result = $this->model->select_node_list();
        $this->view = $result;
    }
}
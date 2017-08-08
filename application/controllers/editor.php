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
        $table_employees = $this->model->table_employees();
        $this->view = str_replace('%table_employees%', $table_employees, $this->view);
        // Users
        $table_users = $this->model->table_users();
        $this->view = str_replace('%table_type_user%', $table_users, $this->view);
    }


    public function save_popup_input($post_data){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $post_data;
        // Вызываем метод показа всего дерева
        $this->model->save_popup_input();
    }

    // карточка сотрудника
    public function employee_card($post_data){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $post_data;
        // Вызываем метод показа всего дерева
        $this->model->employee_card();
    }
    // меняем карточку сотрудника
    public function save_employee_card($post_data){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $post_data;
        // Вызываем метод показа всего дерева
        $this->model->save_employee_card();
    }
    // получаем карточку user
    public function user_card($post_data){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $post_data;
        // Вызываем метод показа всего дерева
        $this->model->user_card();
    }

    // меняем карточку user
    public function save_user_card($post_data){
        // Записываем массив с даннми в модель;
        $this->model->post_array = $post_data;
        // Вызываем метод показа всего дерева
        $this->model->save_user_card();
    }
}
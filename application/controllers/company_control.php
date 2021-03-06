<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_company_control extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        // Получаем список компаний из модели;
        $company_list = $this->model->load_company_table();

        // Строим таблицу с компаниями;
        $this->view = str_replace('%company_list%', $company_list, $this->view);
    }

    // Добавление компании;
    public function add(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;

        // Запускаем метод;
        $result = $this->model->add();
        $this->view = $result;

    }

    // Включение управление компании;
    public  function set_company_control(){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $this->post_params;

        // Запускаем метод;
        $result = $this->model->set_company_control();
        $this->view = $result;
    }

    public  function plus_test_users_couple(){

        $this->model->post_array = $this->post_params;

        $result = $this->model->plus_test_users_couple();
        $this->view = $result;
    }

    public  function select_group_companys_item(){

        $result = $this->model->select_group_companys_item();
        $this->view = $result;

    }

    public  function delete_company(){

        $this->model->post_array = $this->post_params;

        $result = $this->model->delete_company();
        $this->view = $result;
    }

}
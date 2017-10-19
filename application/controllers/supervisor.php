<?php

class Controller_supervisor extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
        $html = $this->model->select_list();
        $this->view = str_replace('%select_list%', $html, $this->view);
        $html = $this->model->admin_list();
        $this->view = str_replace('%admin_list%', $html, $this->view);
    }

    public  function select_admin_list(){
        $this->model->select_admin_list();
    }

    public  function select_select_list(){
        $this->model->select_select_list();
    }

    public  function add_item(){
        $this->model->post_array = $this->post_params;
        $this->model->add_item();
    }
    public  function add_observer_item(){
        $this->model->add_observer_item();
    }
    public  function add_observer_item_yes(){
        $this->model->post_array = $this->post_params;
        $this->model->add_observer_item_yes();
    }

    public  function delete_observer_item_yes(){
        $this->model->post_array = $this->post_params;
        $this->model->delete_observer_item_yes();
    }

    public  function delete_company_item_yes(){
        $this->model->post_array = $this->post_params;
        $this->model->delete_company_item_yes();
    }

}
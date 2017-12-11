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
        $result = $this->model->select_admin_list();
        $this->view = $result;
    }

    public  function select_select_list(){
        $result = $this->model->select_select_list();
        $this->view = $result;
    }

    public  function add_item(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->add_item();
        $this->view = $result;
    }
    public  function add_observer_item(){
        $result = $this->model->add_observer_item();
        $this->view = $result;
    }
    public  function add_observer_item_yes(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->add_observer_item_yes();
        $this->view = $result;
    }

    public  function delete_observer_item_yes(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->delete_observer_item_yes();
        $this->view = $result;
    }

    public  function delete_company_item_yes(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->delete_company_item_yes();
        $this->view = $result;
    }

}
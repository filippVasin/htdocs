<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_structure extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
         $selector = $this->model->test();
        $this->view = str_replace('%select%', $selector, $this->view);
    }

    public  function select_dol_list(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->select_dol_list();
        $this->view = $result;
    }

    public  function select_node_list(){
        $result = $this->model->select_node_list();
        $this->view = $result;
    }

    public  function select_kladr_list(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->select_kladr_list();
        $this->view = $result;
    }

    public  function add_item(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->add_item();
        $this->view = $result;
    }

    public  function delete_node(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->delete_node();
        $this->view = $result;
    }

}
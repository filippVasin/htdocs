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
        $this->model->select_dol_list();
    }

    public  function select_node_list(){
        $this->model->select_node_list();
    }

    public  function select_kladr_list(){
        $this->model->post_array = $this->post_params;
        $this->model->select_kladr_list();
    }

    public  function add_item(){
        $this->model->post_array = $this->post_params;
        $this->model->add_item();
    }

}
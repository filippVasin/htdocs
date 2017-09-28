<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_report_step extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
//        $result=$this->model->start();
//        $this->view = str_replace('%forms%', $result, $this->view);
    }

    public function start(){
        $this->model->post_array = $this->post_params;
        $this->model->start();
    }


    // получаем дерево должностей
    public function load_node_docs_tree(){
        $this->model->load_node_docs_tree();
    }

    public function action_history_docs(){
        $this->model->post_array = $this->post_params;
        $this->model->action_history_docs();
    }
}
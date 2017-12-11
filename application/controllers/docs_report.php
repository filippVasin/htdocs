<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_docs_report extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){
        $result = $this->model->start();
        $this->view = str_replace('%forms%', $result, $this->view);

        $date_from = $this->model->date_from();
        $this->view = str_replace('%date_from%', $date_from, $this->view);

        $date_to = $this->model->date_to();
        $this->view = str_replace('%date_to%', $date_to, $this->view);
    }

    // получаем дерево должностей
    public function load_node_docs_tree(){
        $result = $this->model->load_node_docs_tree();
        $this->view = $result;
    }

    public function action_history_docs(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->action_history_docs();
        $this->view = $result;
    }

    public function select()
    {
        $this->model->post_array = $this->post_params;
        $result =  $this->model->select();
        $this->view = $result;
    }
}
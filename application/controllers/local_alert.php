<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_local_alert extends Controller{
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
        $this->model->load_node_docs_tree();
    }

    public function action_history_docs(){
        $this->model->post_array = $this->post_params;
        $this->model->action_history_docs();
    }

    public function select()
    {
        $this->model->post_array = $this->post_params;
        $this->model->select();
    }

    // получаем форму заполнения для стажировочного листа
    public function internship_list(){
        $this->model->internship_list();
    }

    public function get_bus_routes(){
        $this->model->post_array = $this->post_params;
        $this->model->get_bus_routes();
    }

    public function internship_list_edit(){
        $this->model->post_array = $this->post_params;
        $this->model->internship_list_edit();
    }

    public function get_route_buses() {
        $this->model->post_array = $this->post_params;
        $this->model->get_route_buses();
    }

    public function internship_list_edit_plus_route(){
        $this->model->internship_list_edit_plus_route();
    }

    public function inst_save_new_route() {
        $this->model->post_array = $this->post_params;
        $this->model->inst_save_new_route();
    }
    public function internship_list_edit_route() {
        $this->model->post_array = $this->post_params;
        $this->model->internship_list_edit_route();
    }
    public function inst_edit_new_route() {
        $this->model->post_array = $this->post_params;
        $this->model->inst_edit_new_route();
    }
    public function inst_delete_new_route() {
        $this->model->post_array = $this->post_params;
        $this->model->inst_delete_new_route();
    }
    public function edit_instr_list() {
        $this->model->post_array = $this->post_params;
        $this->model->edit_instr_list();
    }

    public function edit_instr_list_save() {
        $this->model->post_array = $this->post_params;
        $this->model->edit_instr_list_save();
    }

}
<?php

class Controller_select_company_control extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
        $html = $this->model->get_company();
        $this->view = str_replace('%company%', $html, $this->view);
    }

    public  function start_company_control(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->start_company_control();
        $this->view = $result;
    }

}
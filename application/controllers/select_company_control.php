<?php

class Controller_select_company_control extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
        $html = $this->model->get_company();
        $this->view = str_replace('%company%', $html, $this->view);
    }


}
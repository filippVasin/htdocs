<?php

class Controller_url_auth extends Controller{

    public function exec_default(){
        $auth_hash = $this->get_params;
        $result = $this->model->start($auth_hash);
        $this->view = $result;
    }
}
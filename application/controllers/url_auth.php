<?php

class Controller_url_auth extends Controller{

    public function exec_default(){
        $auth_hash = $this->get_params;
        $this->model->start($auth_hash);
    }
}
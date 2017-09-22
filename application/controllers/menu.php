<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_menu extends Controller{
    // model, view и pointer - объявлены в родительском классе;

    public function exec_default(){

        $company_buttons = $this->model->company_buttons();
        $this->view = str_replace('%company_buttons%', $company_buttons, $this->view);

        $login_buttons = $this->model->login_buttons();
        $this->view = str_replace('%users_buttons%', $login_buttons, $this->view);

        $role_three = $this->model->role_three();
        $this->view = str_replace('%main%', $role_three, $this->view);

        $exit_login = $this->model->exit_login();
        $this->view = str_replace('%exit_login%', $exit_login, $this->view);

        $page_title = $this->model->page_title();
        $this->view = str_replace('%page_title%', $page_title, $this->view);
    }
}
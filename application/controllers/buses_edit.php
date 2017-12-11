<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_buses_edit extends Controller{

    public function exec_default(){
        $selector = $this->model->bus_list_table();
        $this->view = str_replace('%bus_list%', $selector, $this->view);

        $selector = $this->model->bus_list_drivers_table();
        $this->view = str_replace('%bus_list_drivers%', $selector, $this->view);

        $selector = $this->model->bus_list_owners_table();
        $this->view = str_replace('%bus_list_owners%', $selector, $this->view);

        $selector = $this->model->bus_list_routes_table();
        $this->view = str_replace('%bus_list_routes%', $selector, $this->view);
    }

    public  function bus_edit(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->bus_edit();
        $this->view = $result;
    }

    public  function bus_edit_save(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->bus_edit_save();
        $this->view = $result;
    }

    public  function driver_edit(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->driver_edit();
        $this->view = $result;
    }

    public  function driver_edit_save(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->driver_edit_save();
        $this->view = $result;
    }

    public  function route_edit_save(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->route_edit_save();
        $this->view = $result;
    }

    public  function owner_edit_save(){
        $this->model->post_array = $this->post_params;
        $result = $this->model->owner_edit_save();
        $this->view = $result;
    }

}
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
        $this->model->bus_edit();
    }

    public  function bus_edit_save(){
        $this->model->post_array = $this->post_params;
        $this->model->bus_edit_save();
    }

    public  function driver_edit(){
        $this->model->post_array = $this->post_params;
        $this->model->driver_edit();
    }

    public  function driver_edit_save(){
        $this->model->post_array = $this->post_params;
        $this->model->driver_edit_save();
    }

    public  function route_edit_save(){
        $this->model->post_array = $this->post_params;
        $this->model->route_edit_save();
    }

    public  function owner_edit_save(){
        $this->model->post_array = $this->post_params;
        $this->model->owner_edit_save();
    }



//
//    public  function add_item(){
//        $this->model->post_array = $this->post_params;
//        $this->model->add_item();
//    }
//
//    public  function delete_node(){
//        $this->model->post_array = $this->post_params;
//        $this->model->delete_node();
//    }

}
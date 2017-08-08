<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Controller_structure extends Controller{

    public function exec_default(){
        // запускаем тестовый метод
         $selector = $this->model->test();
        $this->view = str_replace('%select%', $selector, $this->view);
    }




    public function whole_tree(){
        // Вызываем метод показа всего дерева
        $this->model->whole_tree();
    }
    public function tree_down($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;
        // Вызываем метод показа всего дерева
        $this->model->tree_down();
    }
    public function tree_up($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;
        // Вызываем метод показа всего дерева
        $this->model->tree_up();
    }
    public function whole_branch($post_data){
        // Записываем массив с даннми в домель;
        $this->model->post_array = $post_data;
        // Вызываем метод показа всего дерева
        $this->model->whole_branch();
    }

}
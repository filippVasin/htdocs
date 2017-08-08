<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 18:14
 */
class Controller{
    // Включаем общее представление;
    public $view;

    // Включаем общие js для представлений;
    public $view_js;

    // Включаем общею модель;
    public $model;

    // Включаем общий указатель;
    public $pointer;

    public function __construct($viewer_path, $model){
        // Подключаем viewer;
        $viewer_full_path = ROOT_PATH.'/application/viewers/'.$viewer_path.'.php';
        // Проверяем наличие viewer
        if(file_exists($viewer_full_path)){
            $this->view = file_get_contents($viewer_full_path);
        }   else{
            $this->view = '';
        }

        // Подключаем js viewer;
        $viewer_js_path = '<script type="application/javascript" src="/application/_js/'.$viewer_path.'.js"></script>';
        if(file_exists(ROOT_PATH.'/application/_js/'.$viewer_path.'.js')){
            $this->view_js = $viewer_js_path;
        }   else{
            $this->view_js = '';
        }

        // ПРоверяем и подклчюаем стили css viewer;
        $viewer_css_path = '<link rel="stylesheet" href="/application/_css/'.$viewer_path.'.css" type="text/css" />';
        if(file_exists(ROOT_PATH.'/application/_css/'.$viewer_path.'.css')){
            $this->view_js .= $viewer_css_path;
        }

        // Подключаем модель;
        $this->model = $model;
    }
}
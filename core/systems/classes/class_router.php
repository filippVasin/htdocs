<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 14:38
 */
class router{
    // Представление тела страницы;
    public $viewer_result;

    // JS представлений для тела страницы;
    public $viewer_result_js;

    // Представление верзнего меню;
    public $menu_viewer;

    function __construct(){
        // Читаем маршрут;
        $current_route = explode('/', ROUTE);

        // Определяем контроллер;
        $path = isset($current_route[1]) && $current_route[1] != '' ? $current_route[1] : 'main';

        // Определяем метод - если такой есть;
        $method = isset($current_route[2]) && $current_route[2] != '' ? $current_route[2] : 'exec_default';

        // Если нам передали контроллер - подключаем его;
        // ajax_controller - мы не обрабатываем;
        if($path != ''){
            // Проверяем существование модели и контроллера;
            if(file_exists(ROOT_PATH.'/application/controllers/'.$path.'.php') && file_exists(ROOT_PATH.'/application/models/'.$path.'.php')){

                // Если у нас есть и модель и контроллер подключаем модель;
                require_once(ROOT_PATH.'/application/models/'.$path.'.php');
                require_once(ROOT_PATH.'/application/controllers/'.$path.'.php');

                // Создаем объект на основании модели;
                $model_name = 'Model_'.$path;
                $include_model = new $model_name;

                // Создаем обеъкт на оснвоании контроллера и передаем ему модель и изначальное представление;
                $controller_name = 'Controller_'.$path;
                $include_controller = new $controller_name($path, $include_model);

                // Если есть указатель;
                if(isset($pointer) && $pointer != ''){
                    $include_controller->pointer = $pointer;
                }

                // Если есть метод - проверяем наличие метода;
                if($method != ''){
                    if(method_exists($include_controller, $method)){
                        // Если метод есть - выполняем его;
                        $include_controller->$method(isset($_POST) ? $_POST : NULL);
                    }   else{
                        // Если метода нет - выводим ошибку;
                        $this->error_message('ОШИБКА! Указанный метод '.$method.' не найдем в контроллере '.$controller_name, $path);
                    }
                }

                // Загружаем отображение;
                $this->viewer_result = $include_controller->view;

                // Загуржаем JS отображения;
                $this->viewer_result_js = $include_controller->view_js;

            }   else{
                // Выводим сообщение от ошибке;
                $this->error_message('ОШИБКА! Модель или Контроллер - "'.$path.'" - не найдены! Обратитесь в системному администратору');
            }

            // Включаем меню;
            $this->load_menu();

            // Грузим шаблон с представлением;
            $this->show_template();

        }
    }

    private function load_menu(){
        require_once(ROOT_PATH.'/application/models/menu.php');
        require_once(ROOT_PATH.'/application/controllers/menu.php');

        // ПОдклчюаем модель меню;
        $menu_model_name = 'Model_menu';
        $menu_model = new $menu_model_name;

        // Подключаем контроллер меню;
        $menu_controller_name = 'Controller_menu';
        $menu_controller = new $menu_controller_name('menu', $menu_model);

        // Выполняем метод контроллера который корректируем меню исходя из сессии;
        $menu_controller->exec_default();

        // Результат коррекции представления передаем в местную переменную;
        $this->menu_viewer = $menu_controller->view;
    }

    private function error_message($message, $url_postfix = 'error_404'){
        global $hard_mode;

        if($hard_mode == false){
            header("Location: ".URL."/".$url_postfix);
            exit();
        }   else{
            echo $message;
        }
    }

    private function show_template(){
        global $current_template;

        // Включаем представление верзнего меня для шаблона;
        $menu_viewer = $this->menu_viewer;

        // Включаем отображение что шаблон смог его отрисовать;
        $inside_viewer = $this->viewer_result;

        // Включаем отображение js от viewer;
        $viewer_js = $this->viewer_result_js;

        // Подключаем главное представление
        include(ROOT_PATH.'/templates/'.$current_template.'/viewer.php');
    }
}
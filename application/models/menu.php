<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_menu{
    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else(){
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }

        public function page_title(){

        $page_title = "";
        $domain = $_SERVER['REQUEST_URI'];
        switch ($domain) {
            case "/main":
                $page_title = "Главная страница";
                break;
            case "/structure":
                $page_title = "Cтруктура";
                break;
            case "/creator":
                $page_title = "Добавить сотрудника";
                break;
            case "/docs_report":
                $page_title = "Отчёт по документам";
                break;
            case "/report_step":
                $page_title = "Отчёт по сотрудникам";
                break;
            case "/action_list":
                $page_title = "Действия с документами";
                break;
            case "/local_alert":
                $page_title = "Уведомления";
                break;
            case "/company_control":
                $page_title = "Компании";
                break;
            case "/editor":
                $page_title = "Редактор элементов";
                break;
            case "/employee_update":
                $page_title = "Перемещение сотрудников";
                break;
            case "/company_forms":
                $page_title = "Документы компании";
                break;
            case "/period_control":
                $page_title = "Периодичность инструктажей";
                break;
            case "/step_editor":
                $page_title = "Содержание инструктажа";
                break;
            case "/error_404":
                $page_title = "ОШИБКА! Указанная страница не найдена.";
                break;

        }
        return $page_title;
    }


    public function company_buttons(){


        // Есть ли управляемая компания;
        if(isset($_SESSION['control_company']) && $_SESSION['role_id'] == 1){
            $company_buttons = '
            <a href="/items_control" class="attr" name="Управление элементами"><img src="../../templates/simple_template/images/main_icon.svg"><div class="display_none">Управление элементами</div></a>
            <a href="/employees_control" class="attr" name="Сотрудники"><img src="../../templates/simple_template/images/employees.svg"><div class="display_none">Сотрудники</div></a>
            <a href="/documents_download" class="attr" name="Выгрузка документов"><img src="../../templates/simple_template/images/main_icon.svg"><div class="display_none">Выгрузка документов</div></a>
            ';
        }   else{
            $company_buttons = '';
        }

        // Есть ли управляемая компания;
        if( $_SESSION['role_id'] == 4){
            $company_buttons = '
            <li><a href="/main" class="pril_start"><span>Главная страница</span><i class="fa fa-bank"></i> </a></li>
            <li><a href="/structure" class="pril_start"> <span>Cтруктура</span><i class="fa  fa-sitemap"></i> </a></li>
            <li><a href="/creator" class="pril_start"> <span>Добавить сотрудника</span><i class="fa fa-indent"></i> </a></li>
            <li><a href="/docs_report" class="pril_start"> <span>Отчёт по документам</span><i class="fa fa-book"></i> </a></li>
            <li><a href="/report_step" class="pril_start"> <span>Отчёт по сотрудникам</span><i class="fa fa-users"></i> </a></li>
            <li><a href="/company_forms" class="pril_start"> <span>Документы компании</span><i class="fa  fa-files-o"></i></a></li>
            <li><a href="/local_alert" class="pril_start"> <span>Уведомления</span><i class="fa fa-paper-plane"></i></a> </li>
            ';
        }   else{
            $company_buttons = '';
        }



        return $company_buttons;
    }


    public function login_buttons(){
        $login_buttons = '';
        // Состояние авторизации пользователя;
        if(isset($_SESSION['user_id'])){

            if($_SESSION['role_id'] == 1){

                $login_buttons = '<li><a href="/main" class="pril_start"> <span>Главная страница</span><i class="fa fa-bank "></i></a></li>';
                $login_buttons .= '<li><a href="/company_control" class="pril_start"> <span>Компании</span><i class="fa fa-leanpub"></i></a></li>';
                $login_buttons .= '<li><a href="/structure" class="pril_start"> <span>Cтруктура</span><i class="fa fa-sitemap"></i></a></li>';
                $login_buttons .= '<li><a href="/creator" class="pril_start"> <span>Добавить сотрудника</span><i class="fa fa-indent"></i></a></li>';
                $login_buttons .= '<li><a href="/editor" class="pril_start"> <span>Редактор элементов</span><i class="fa fa-edit"></i></a></li>';
                $login_buttons .= '<li><a href="/employee_update" class="pril_start"> <span>Перемещение сотрудников</span><i class="fa fa-arrows"></i></a></li>';
                $login_buttons .= '<li><a href="/company_forms" class="pril_start"> <span>Документы компании</span><i class="fa  fa-files-o"></i></a></li>';
                $login_buttons .= '<li><a href="/action_list" class="pril_start"> <span>Действия с документами</span><i class="fa  fa-newspaper-o"></i> </a></li>';
                $login_buttons .= '<li><a href="/period_control" class="pril_start"> <span>Периодичность инструктажей</span><i class="fa fa-calendar"></i></a></li>';
                $login_buttons .= '<li><a href="/step_editor" class="pril_start"><span>Содержание инструктажа</span><i class="fa fa-calendar-check-o"></i> </a></li>';
//                $login_buttons .= '<li><a href="/node_update"><i class="fa fa-book"></i> <span>Компании</span></a></li>';

            }

            if($_SESSION['role_id'] == 3){
//                $login_buttons = '<a href="/pass_test"><div class="menu_button">Пройти тестирование</div></a>';
            }

        }
        return $login_buttons;
    }

    public function role_three(){

        if ($_SESSION['role_id'] != 3) {
            $role_three = '<li><a href="/main" class="pril_start"> <span>Главная страница</span><i class="fa fa-bank"></i></a></li>';
        } else {
            $role_three = '';
        }
        return $role_three;
    }

    public function exit_login(){

        if(isset($_SESSION['user_id'])){
                $exet_login = '<a href="/exit" >Выход <i class="fa fa-arrow-circle-right"></i></a>';
            } else {
                $exet_login = '<a href="/login" >Вход <i class="fa fa-arrow-circle-right"></i></a>';
            }
        return $exet_login;
    }
}
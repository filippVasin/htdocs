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
        // На уровне контроллера корректируем view меню в зависимости от состояния сессии;
        $login_buttons = '';

        // Есть ли управляемая компания;
        if(isset($_SESSION['control_company']) && $_SESSION['role_id'] == 1){
            $company_buttons = '
            <a href="/items_control"><div class="menu_button">Управление элементами</div></a>
            <a href="/employees_control"><div class="menu_button">Сотрудники</div></a>
            <a href="/documents_download"><div class="menu_button">Выгрузка документов</div></a>
            ';
        }   else{
            $company_buttons = '';
        }

        // Есть ли управляемая компания;
        if( $_SESSION['role_id'] == 4){
            $company_buttons = '

            <a href="/docs_report"><div class="menu_button">Отчёт по документам</div></a>
            <a href="/report_step"><div class="menu_button">Отчёт о сотрудникам</div></a>
            <a href="/action_list"><div class="menu_button">Действия с документами</div></a>
            <a href="/local_alert"><div class="menu_button">Уведомления</div></a>
            ';
        }   else{
            $company_buttons = '';
        }

        $this->view = str_replace('%company_buttons%', $company_buttons, $this->view);

        // Состояние авторизации пользователя;
        if(isset($_SESSION['user_id'])){

            if($_SESSION['role_id'] == 1){
                $login_buttons = '<a href="/company_control"><div class="menu_button">Компании</div></a>';
                $login_buttons .= '<a href="/structure"><div class="menu_button">Организационная структура</div></a>';
                $login_buttons .= '<a href="/creator"><div class="menu_button">Добавить элемент</div></a>';
                $login_buttons .= '<a href="/editor"><div class="menu_button">Редактор элементов</div></a>';
                $login_buttons .= '<a href="/employee_update"><div class="menu_button">Перемещение сотрудников</div></a>';
                $login_buttons .= '<a href="/node_update"><div class="menu_button">Перемещение узлов</div></a>';
                $login_buttons .= '<a href="/company_forms"><div class="menu_button">Документы компании</div></a>';

            }

            if($_SESSION['role_id'] == 3){
//                $login_buttons = '<a href="/pass_test"><div class="menu_button">Пройти тестирование</div></a>';
            }

            $login_buttons .= '<a href="/exit"><div class="menu_button">Выход</div></a>';

        }   else{
            $login_buttons = '
            <a href="/sing_in"><div class="menu_button">Регистрация</div></a>
            <a href="/login"><div class="menu_button">Войти</div></a>
            ';
        }

        $this->view = str_replace('%users_buttons%', $login_buttons, $this->view);
        if($_SESSION['role_id'] == 3){
            $glav ='<a href="/main"><div class="menu_button">Главная страница</div></a>';
            $this->view = str_replace($glav, "", $this->view);
        }



    }
}
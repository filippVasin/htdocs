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



    public function company_buttons(){


        // Есть ли управляемая компания;
        if(isset($_SESSION['control_company']) && $_SESSION['role_id'] == 1){
            $company_buttons = '
            <a href="/items_control"><img src="../../templates/simple_template/images/main_icon.svg"><div class="">Управление элементами</div></a>
            <a href="/employees_control"><img src="../../templates/simple_template/images/employees.svg"><div class="">Сотрудники</div></a>
            <a href="/documents_download"><img src="../../templates/simple_template/images/main_icon.svg"><div class="">Выгрузка документов</div></a>
            ';
        }   else{
            $company_buttons = '';
        }

        // Есть ли управляемая компания;
        if( $_SESSION['role_id'] == 4){
            $company_buttons = '
            <a href="/structure" class="active"><img src="../../templates/simple_template/images/org_str_icon.svg"><div class="">Организационная структура</div></a>
            <a href="/creator"><img src="../../templates/simple_template/images/create_node.svg"><div class="">Добавить элемент</div></a>
            <a href="/docs_report"><img src="../../templates/simple_template/images/report_doc_icon.svg"><div class="">Отчёт по документам</div></a>
            <a href="/report_step"><img src="../../templates/simple_template/images/report_em_icon.svg"><div class="">Отчёт по сотрудникам</div></a>
            <a href="/action_list"><img src="../../templates/simple_template/images/doc_action_icon.svg"><div class="">Действия с документами</div></a>
            <a href="/local_alert"><img src="../../templates/simple_template/images/alarm.svg"><div class="">Уведомления</div></a>
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
                $login_buttons = '<a href="/company_control"><img src="../../templates/simple_template/images/main_icon.svg"><div class="">Компании</div></a>';
                $login_buttons .= '<a href="/structure"><img src="../../templates/simple_template/images/org_str_icon.svg"><div class="">Организационная структура</div></a>';
                $login_buttons .= '<a href="/creator"><img src="../../templates/simple_template/images/create_node.svg"><div class="">Добавить элемент</div></a>';
                $login_buttons .= '<a href="/editor"><img src="../../templates/simple_template/images/main_icon.svg"><div class="">Редактор элементов</div></a>';
                $login_buttons .= '<a href="/employee_update"><img src="../../templates/simple_template/images/main_icon.svg"><div class="">Перемещение сотрудников</div></a>';
                $login_buttons .= '<a href="/node_update"><img src="../../templates/simple_template/images/main_icon.svg"><div class="">Перемещение узлов</div></a>';
                $login_buttons .= '<a href="/company_forms"><img src="../../templates/simple_template/images/company_docs.svg"><div class="">Документы компании</div></a>';

            }

            if($_SESSION['role_id'] == 3){
//                $login_buttons = '<a href="/pass_test"><div class="menu_button">Пройти тестирование</div></a>';
            }

        }
        return $login_buttons;
    }

    public function role_three(){

        if ($_SESSION['role_id'] != 3) {
            $role_three = '<a href="/main"><img src="../../templates/simple_template/images/main_icon.svg"><div class="">Главная страница</div></a>';
        } else {
            $role_three = '';
        }
        return $role_three;
    }

}
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
            <a href="/structure" class="attr" name="Организационная структура"><img src="../../templates/simple_template/images/org_str_icon.svg"><div class="display_none">Организационная структура</div></a>
            <a href="/creator" class="attr" name="Добавить элемент"><img src="../../templates/simple_template/images/create_node.svg"><div class="display_none">Добавить элемент</div></a>
            <a href="/docs_report" class="attr" name="Отчёт по документам"><img src="../../templates/simple_template/images/report_doc_icon.svg"><div class="display_none">Отчёт по документам</div></a>
            <a href="/report_step" class="attr" name="Отчёт по сотрудникам"><img src="../../templates/simple_template/images/report_em_icon.svg"><div class="display_none">Отчёт по сотрудникам</div></a>
            <a href="/action_list" class="attr" name="Действия с документами"><img src="../../templates/simple_template/images/doc_action_icon.svg"><div class="display_none">Действия с документами</div></a>
            <a href="/local_alert" class="attr" name="Уведомления"><img src="../../templates/simple_template/images/alarm.svg"><div class="display_none">Уведомления</div></a>
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
                $login_buttons = '<a href="/company_control" class="attr" name="Компании"><img src="../../templates/simple_template/images/factory.svg"><div class="display_none">Компании</div></a>';
                $login_buttons .= '<a href="/structure" class="attr" name="Организационная структура"><img src="../../templates/simple_template/images/org_str_icon.svg"><div class="display_none">Организационная структура</div></a>';
                $login_buttons .= '<a href="/creator" class="attr" name="Добавить элемент"><img src="../../templates/simple_template/images/create_node.svg"><div class="display_none">Добавить элемент</div></a>';
                $login_buttons .= '<a href="/editor" class="attr" name="Редактор элементов"><img src="../../templates/simple_template/images/font-selection-editor.svg"><div class="display_none">Редактор элементов</div></a>';
                $login_buttons .= '<a href="/employee_update" class="attr" name="Перемещение сотрудников"><img src="../../templates/simple_template/images/user-profile-edition.svg"><div class="display_none">Перемещение сотрудников</div></a>';
                $login_buttons .= '<a href="/node_update" class="attr" name="Перемещение узлов" ><img src="../../templates/simple_template/images/anchor-point.svg"><div class="display_none">Перемещение узлов</div></a>';
                $login_buttons .= '<a href="/company_forms" class="attr"name="Документы компании"><img src="../../templates/simple_template/images/company_docs.svg"><div class="display_none">Документы компании</div></a>';
                $login_buttons .= '<a href="/period_control" class="attr"name="Периодичность инструктажей"><img src="../../templates/simple_template/images/time-left.svg"><div class="display_none">Периодичность инструктажей</div></a>';
                $login_buttons .= '<a href="/step_editor" class="attr"name="Содержание инструктажа"><img src="../../templates/simple_template/images/share.svg"><div class="display_none">Содержание инструктажа</div></a>';

            }

            if($_SESSION['role_id'] == 3){
//                $login_buttons = '<a href="/pass_test"><div class="menu_button">Пройти тестирование</div></a>';
            }

        }
        return $login_buttons;
    }

    public function role_three(){

        if ($_SESSION['role_id'] != 3) {
            $role_three = '<a href="/main" class="attr" name="Главная страница"><img src="../../templates/simple_template/images/main_icon.svg"><div class="display_none">Главная страница</div></a>';
        } else {
            $role_three = '';
        }
        return $role_three;
    }

}
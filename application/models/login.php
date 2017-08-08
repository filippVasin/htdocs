<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_login{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function try_login(){
        global $db;

        $login = $this->post_array['login'];
        $password = $this->post_array['password'];

        $sql = "SELECT `id`, `role_id`, `employee_id` FROM `users` WHERE `name` = '".$login."' AND `password` = '".md5($password)."';";
        $login_data = $db->row($sql);

        $result_array = array();
        $status = 1;
        if($login_data['id'] != '') {
            // Проверяем есть ли под user сотрудник
            if ($login_data['employee_id'] != '') {
                $sql = "SELECT `status`, `id` FROM `employees` WHERE  `id` = '" . $login_data['employee_id'] . "';";
                $status_cher = $db->row($sql);
                if ($status_cher['status'] == 0) {
                    $status = 0;
                }
            }

            // если есть сотрудник и он не уволен
            if ($status == 1) {

                $login_date = date('Y-m-d H:i:s');
                $sql = "UPDATE `users` SET `date_last_login` = '" . $login_date . "' WHERE `id` = '" . $login_data['id'] . "';";
                $db->query($sql);

                $result_array['status'] = 'company';
                $result_array['message'] = 'Вы успешно прошли авторизацию';
//                $result_array['role'] = $login_data['role_id'];

                $_SESSION['user_id'] = $login_data['id'];
                $_SESSION['role_id'] = $login_data['role_id'];
                $_SESSION['employee_id'] = $login_data['employee_id'];

                // Так же, если пользователь определен к какой-то компании, то подключаем ее;
                if ($login_data['employee_id'] != '') {
                    // Определяем компанию и её название;
                    $sql = "SELECT	company.id, company.short_name
                        FROM company, organization_structure, employees_items_node
                        Where employees_items_node.org_str_id = organization_structure.id
                        AND organization_structure.company_id = company.id
                        AND employees_items_node.employe_id = '" . $login_data['employee_id'] . "';";
                    $result = $db->row($sql);

                    $_SESSION['control_company'] = $result["id"];
                    $_SESSION['control_company_name'] = $result['short_name'];
                }

//                //  если пользователь сотрудник
                if ($login_data['role_id'] == 3) {
                    // получаем фамилию и инициалы
                    $employee_name = $db->row_fullname($login_data['employee_id']);
                    $_SESSION['$employee_full_name'] = $employee_name;
                    $result_array['status'] = 'employee'; //посылам на
                }
            } else {
                $result_array['status'] = 'error';
                $result_array['message'] = ' Доступ ограничен!';
            }
        }   else{
            $result_array['status'] = 'error';
            $result_array['message'] = 'Неверный логин или пароль!';
        }
        // Отправили зезультат
        $result = json_encode($result_array, true);
        die($result);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Filipp
 * Date: 08.08.17
 * Time: 16:48
 */

class labro
{

    public function generate_password()
    {
        $arr = array('a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S',
            'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0');
        // Генерируем пароль
        $pass = "";
        $number = 9; // количество символов
        for ($i = 0; $i < $number; $i++) {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }

    // получаем ответственного по инструктажам
    public function bailee($emp)
    {
        global $db;
        if (isset($_SESSION['control_company'])) {
            $control_company = $_SESSION['control_company'];
        } else {
            $control_company = 15;
        }
        $sql = "SELECT ORG_chief.id AS ORG_chief_id,ORG_boss.boss_type, ORG_boss.`level` as level,
                chief_employees.id AS chief_employees_id,
                chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
                    chief_items_control.name AS chief_dol
                FROM (organization_structure, employees_items_node)
                LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
                                                                                    AND
                                                                                  ORG_chief.right_key > organization_structure.right_key
                                                                                  AND
                                                                                  ORG_chief.company_id = " . $control_company . " )
                        LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = " . $control_company . "
                                                                                        AND ORG_boss.left_key > ORG_chief.left_key
                                                                                        AND ORG_boss.right_key < ORG_chief.right_key
                                                                                        AND 	ORG_boss.`level` = (ORG_chief.`level` +1)
                                                                                        AND ORG_boss.boss_type > 1
                                                                                            )
                        LEFT JOIN employees_items_node AS chief_node ON chief_node.org_str_id = ORG_boss.id
                        LEFT JOIN employees AS chief_employees ON chief_employees.id = chief_node.employe_id
                        LEFT JOIN items_control AS  chief_items_control ON chief_items_control.id = ORG_boss.kladr_id

                WHERE employees_items_node.employe_id = " . $emp . "
                AND organization_structure.id = employees_items_node.org_str_id
                AND organization_structure.company_id = " . $control_company . "
                AND chief_employees.id is not NULL
                ORDER BY level DESC, boss_type DESC
                LIMIT 1";
        $boss = $db->row($sql);
        return $boss;
    }


    // олучаем почту сотрудника
    public function employees_email($emp)
    {
        global $db;
        $sql = "SELECT email FROM employees WHERE employees.id=" . $emp;
        $boss = $db->row($sql);
        $email = $boss['email'];
        return $email;
    }

    // создаём url ссылку с хешем и пишим её в таблицу
    public function url_hash($user){
        global $db;
        $today = date("Y-m-d H:i:s");
        $count = 0;
        $hash = "";
        do {
            $hash = substr(md5($user . $today . $count), 0, 9);
            $sql = "SELECT `user_id` FROM `url_hash` WHERE `hash` = '" . $hash . "';";
            $login_data = $db->row($sql);
            // есди такой хеш уже есть - идём на новый круг
            if ($login_data['user_id'] != '') {
                $hash = "";
            }
            ++$count;
        } while ($hash == "");

        $sql = "INSERT INTO `url_hash` (`user_id`, `hash`,`create_date`) VALUES('" . $hash . "','" . $user . "',NOW());";
        $db->query($sql);
        $url_hash = ROOT_PATH . '/url_auth?hash=' . $hash;
        return $url_hash;
    }

    public function get_a_session($user) {
        global $db;
        $status = 1;
        $result_array = array();

        $sql = "SELECT `id`, `role_id`, `employee_id` FROM `users` WHERE `id` = '" . $user . "';";
        $login_data = $db->row($sql);

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
        return $result_array;
    }
}
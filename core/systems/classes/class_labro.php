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
    public function bailee($emp) {
        global $db;

        $control_company = $this->control_company($emp);

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

    public function control_company($emp){
        global $db;
        $sql="SELECT organization_structure.company_id
                FROM employees_items_node,organization_structure
                WHERE organization_structure.id = employees_items_node.org_str_id
                AND employees_items_node.employe_id =". $emp;
        return $db->one($sql);
    }

    // получаем почту сотрудника
    public function employees_email($emp)
    {
        global $db;
        $sql = "SELECT email FROM employees WHERE employees.id=" . $emp;
        $boss = $db->row($sql);
        $email = $boss['email'];
        return $email;
    }

    // получаем юзера по сотруднику
    public function employees_to_user($emp)
    {
        global $db;
        $sql = "SELECT id FROM users WHERE employee_id =" . $emp;
        $boss = $db->row($sql);
        $user_id = $boss['id'];
        return $user_id;
    }

    // создаём url ссылку с хешем и пишим её в таблицу
    public function url_hash($user){
        global $db;
        if($_SERVER['SERVER_NAME'] == "localhost"){
            $host = "http://localhost";
        } else {
            $host = "https://laborpro.ru";
        }
        $today = date("Y-m-d H:i:s");
        $count = 0;
        $hash = "13";
        do {

            $salt = $hash;// посолили
            $hash = md5($user . $today . $count . $salt);// всё закинули
            $hash_one = substr($hash, 0, 14); // разде..
            $hash_two = substr($hash, 17, 15);//..лили
            $hash = $hash_two.$hash_one;// перевернули

            // подаём к столу
            $sql = "SELECT `user_id` FROM `url_hash` WHERE `hash` = '" . $hash . "';";
            $login_data = $db->row($sql);
            // есди такой хеш уже есть - идём на новый круг
            if ($login_data['user_id'] != '') {
                $hash = "";
            }
            ++$count;
        } while ($hash == "");

        $sql = "INSERT INTO `url_hash` (`user_id`, `hash`,`create_date`) VALUES('" . $user . "','" . $hash . "',NOW());";
        $db->query($sql);
        $url_hash = $host . '/url_auth?'.$hash;
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

    public function get_company($org_str) {
        global $db;
        $company = array();
        $sql="Select organization_structure.company_id, org_company.id AS company_org_id,
                items_control.name AS company_name,
                org_boss.id AS boss_org_id,
                boss_kladr.name AS boss_dol,
                employees.surname, employees.name,employees.second_name, employees.email
                FROM organization_structure
                    LEFT JOIN organization_structure AS org_company ON (org_company.left_key < organization_structure.left_key
                                                                                        AND
                                                                                        org_company.right_key > organization_structure.right_key
                                                                                        AND
                                                                                        org_company.items_control_id = 10
                                                                                        AND
                                                                                        org_company.company_id = organization_structure.company_id)
                    LEFT JOIN items_control ON items_control.id = org_company.kladr_id
                    LEFT JOIN organization_structure AS org_boss ON (org_boss.left_key = (org_company.left_key + 1)
                                                                                    AND
                                                                                    org_company.company_id = org_boss.company_id)
                    LEFT JOIN items_control AS boss_kladr ON boss_kladr.id = org_boss.kladr_id
                    LEFT JOIN employees_items_node ON employees_items_node.org_str_id = org_boss.id
                    LEFT JOIN employees ON employees_items_node.employe_id = employees.id
                WHERE  organization_structure.id =".$org_str;
        $result = $db->row($sql);

        $company['company_id'] = $result["company_id"];
        $company['company_org_id'] = $result['company_org_id'];
        $company['company_name'] = $result['company_name'];
        $company['boss_org_id'] = $result['boss_org_id'];
        $company['boss_dol'] = $result['boss_dol'];
        $company['surname'] = $result['surname'];
        $company['name'] = $result['name'];
        $company['second_name'] = $result['second_name'];
        $company['email'] = $result['email'];

        return $company;
    }

    // возвращяем границы обзорной области в зависимости от должности и прав
    public function observer_keys($employees) {
        global $db;

        $keys = array();
        $sql = "SELECT DIR.left_key,DIR.right_key, organization_structure.boss_type, min(bounds.left_key) AS min_left ,max(bounds.right_key) AS max_right
                FROM employees_items_node,organization_structure
                    LEFT JOIN organization_structure AS bounds ON bounds.company_id = organization_structure.company_id
                    LEFT JOIN organization_structure AS DIR ON (DIR.left_key < organization_structure.left_key
													 			AND
													 			DIR.right_key > organization_structure.right_key
													 			AND
																organization_structure.`level` = (DIR.`level` + 1)
																AND
																DIR.company_id = organization_structure.company_id)
                WHERE employees_items_node.employe_id = ". $employees ."
                AND organization_structure.id = employees_items_node.org_str_id";
        $observer = $db->row($sql);

        if($observer['boss_type'] == 1){
            $keys['left'] = 0;
            $keys['right'] = 0;
        }
        if($observer['boss_type'] == 2){
            $keys['left'] = $observer['left_key'];
            $keys['right'] = $observer['right_key'];
        }
        if($observer['boss_type'] == 3 ) {
            $keys['left'] = $observer['min_left'];
            $keys['right'] = $observer['max_right'];
        }


        return $keys;
    }

    public function fact_org_str_id($employees) {
        global $db;

        $sql="SELECT fact_organization_structure.id, fact_organization_structure.boss_type
                FROM fact_organization_structure,organization_structure,employees_items_node
                WHERE employees_items_node.employe_id = ". $employees ."
                AND organization_structure.id = employees_items_node.org_str_id
                AND fact_organization_structure.org_str_id = organization_structure.id";
        $result = $db->row($sql);

        if($result['id']!=""){
            if($result['boss_type'] == 1){
                $fact_org_str_id = 0;
            }
            if($result['boss_type'] == 2) {
                $fact_org_str_id = $result['id'];
            }
            if($result['boss_type'] == 3) {
            $sql = "SELECT FACT.id
                        FROM fact_organization_structure
                            LEFT JOIN fact_organization_structure AS FACT ON (FACT.company_id = fact_organization_structure.company_id
                                                                                                AND
                                                                                                FACT.left_key = 1)
                        WHERE fact_organization_structure.id =". $result['id'];
                $res = $db->row($sql);
                $fact_org_str_id = $res['id'];
            }
        } else {
            $fact_org_str_id = 0;
        }
        return $fact_org_str_id;
    }


    public function get_org_str_id($employees) {
        global $db;
        $sql = "SELECT employees_items_node.*
                FROM employees_items_node
                WHERE employees_items_node.employe_id =".$employees;
        $result = $db->row($sql);
        if($result['id']!=""){
            $org_str_id = $result['org_str_id'];
        } else {
            $org_str_id = 0;
        }
        return $org_str_id;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_company_control{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // Поулчаем список компаний;
    public function load_company_table(){

        if(!(isset($_SESSION['user_id']))){
            header("Location:/login");
        }

        global $db, $elements;



        $html = '';

        $sql = "SELECT * FROM `company` WHERE `status` != 0 AND `author_user_id` = '".$_SESSION['user_id']."';";
        $company_array = $db->all($sql);
        foreach($company_array as $company_item){
            $html .= $elements->company_item($company_item['name'].' ('.$company_item['short_name'].') / '.$company_item['director_surname'].' '.$company_item['director_name'].' '.$company_item['director_second_name'], 'company_'.$company_item['id'], ($company_item['id'] == $_SESSION['control_company'] ? 'on_company' : 'off_company'), '', 'company_id='.$company_item['id']);
        }

        return $html;
    }

    // Добалвяем новую компанию;
    public function add(){
        global $db, $elements;

        $post_data = $this->post_array;

        $name = $post_data['company_name'];
        $short_name = $post_data['company_short_name'];
        $new_company_director_surname = $post_data['new_company_director_surname'];
        $new_company_director_name = $post_data['new_company_director_name'];
        $new_company_director_second_name = $post_data['new_company_director_second_name'];

        $sql = "INSERT INTO `company` (`name`, `short_name`, `author_user_id`, `director_surname`, `director_name`, `director_second_name`)
            VALUES('".$name."', '".$short_name."', '".$_SESSION['user_id']."', '".$new_company_director_surname."', '".$new_company_director_name."', '".$new_company_director_second_name."');";
        $db->query($sql);
        $company_id = mysqli_insert_id($db->link_id);

        $status = 1;
        $type_id = 10;
        $sql = "INSERT INTO `items_control` (`type_id`, `company_id`, `name`, `status`)
            VALUES('". $type_id ."', '". $company_id ."', '". $name ."', '". $status ."');";
        $db->query($sql);
        $kladr_id = mysqli_insert_id($db->link_id);

        $level = 0;
        $left_key = 1;
        $right_key = 2;
        $parent = 0;
        $items_control_id = 10;
        $boss_type = 1;
        $sql = "INSERT INTO `organization_structure` (`level`, `left_key`, `right_key`, `parent`, `company_id`, `items_control_id`, `kladr_id`, `boss_type`)
            VALUES('". $level ."', '". $left_key ."', '". $right_key ."', '".$parent."', '".$company_id."', '".$items_control_id."', '". $kladr_id ."', '".$boss_type."');";
        $db->query($sql);

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Компания '. $name .' успешно добавлена';
        $result_array['new_item'] = $elements->company_item($name.' ('.$short_name.') / '.$new_company_director_surname.' '.$new_company_director_name.' '.$new_company_director_second_name, 'company_'.$company_id, 'off_company', '', 'company_id='.$company_id);

        $result = json_encode($result_array, true);
        die($result);
    }

    // Устанавливаем компанию для упарвления;
    public function set_company_control(){
        global $db;

        $post_data = $this->post_array;

        $company_id = $post_data['company_id'];

        $sql = "SELECT * FROM `company` WHERE `id` = '".$company_id."';";
        $company_data = $db->row($sql);

        $_SESSION['control_company'] = $company_id;
        $_SESSION['control_company_name'] = $company_data['short_name'];

        $result_array = array();
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Включен контроль выбранной компании';

        $result = json_encode($result_array, true);
        die($result);
    }

    // Устанавливаем компанию для упарвления;
    public function plus_test_users_couple(){
        global $db, $labro, $systems;

        $email = $this->post_array['email'];
        $html = "";

        $message =<<<HERH
<html>
            <head>
                            <title>Уведомление о создании аккаунта</title>
                        </head>
                        <body>
		<p>
		Вас приветсвует электронная система проведения инструктажа LaborPRO. <br>
		 Высылаем тестовые аккаунты для изнакомления с нашей системой.
		</p>
 		<br>                <p>Тестированние:</p>
 		                    <br>
                            <p>Логин: %Tes_login%</p>
                            <br>
                            <p>Пароль: %Tes_pass% </p>
<br>
                            <p>Отчётность:</p>
 		                    <br>
                            <p>Логин: %Sel_login%</p>
                            <br>
                            <p>Пароль: %Sel_pass% </p>
                        </body>
                    </html>
HERH;





        // тестировщик
        // создали сотрудника, взяли id
        $sql = "INSERT INTO `employees` (`surname`, `name`, `second_name`, `birthday`, `start_date`, `status`) VALUES ('Тестов', 'Тест', 'Тестович', NOW(), NOW(), '1');";
        $db->query($sql);
        $emp_id = mysqli_insert_id($db->link_id);
        // сотрудника приписали к компании
        $sql = "INSERT INTO `employees_items_node` (`employe_id`, `org_str_id`) VALUES ('". $emp_id ."', '31');";
        $db->query($sql);

        // создали пользователя
        $pass = $labro->generate_password();
        $role_id = 3;
        $surname = "Тестов";
        $sql = "INSERT INTO `users` (`password`, `role_id`,`employee_id`,`full_name`) VALUES('" . md5($pass) . "','" . $role_id . "','" . $emp_id . "','" . $surname . "');";
        $db->query($sql);
        $user_id = mysqli_insert_id($db->link_id);

        // пометили что пользователь - тестировщик
        $sql = "INSERT INTO `user_test` (`user_id`) VALUES('". $user_id ."');";
        $db->query($sql);
        $test_id = mysqli_insert_id($db->link_id);

        // создали логин на основе шаблона и id, записали
        $login = 'Test'.$test_id;
        $sql = "UPDATE `users` SET `name`= '". $login ."'  WHERE  `id`='".$user_id ."'";
        $db->query($sql);

        $message = str_replace('%Tes_login%', $login, $message);
        $message = str_replace('%Tes_pass%', $pass , $message);
        // создали строку для вывода
        $html .='<div class="test_row"><span class="title_test">Для тестов-</span><span class="login">Логин: '. $login .'</span><span class="pass">Пароль: '. $pass .'</span></div>';


        // отчёты
        // создали сотрудника, взяли id
        $sql = "INSERT INTO `employees` (`surname`, `name`, `second_name`, `birthday`, `start_date`, `status`) VALUES ('Селект', 'Тест', 'Тестович', NOW(), NOW(), '1');";
        $db->query($sql);
        $emp_id = mysqli_insert_id($db->link_id);
        // сотрудника приписали к компании
        $sql = "INSERT INTO `employees_items_node` (`employe_id`, `org_str_id`) VALUES ('". $emp_id ."', '31');";
        $db->query($sql);

        // создали пользователя
        $pass = $labro->generate_password();
        $role_id = 4;
        $surname = "Селект";
        $sql = "INSERT INTO `users` (`password`, `role_id`,`employee_id`,`full_name`) VALUES('" . md5($pass) . "','" . $role_id . "','" . $emp_id . "','" . $surname . "');";
        $db->query($sql);
        $user_id = mysqli_insert_id($db->link_id);

        // пометили что пользователь - тестировщик
        $sql = "INSERT INTO `user_test` (`user_id`) VALUES('". $user_id ."');";
        $db->query($sql);
        $test_id = mysqli_insert_id($db->link_id);

        // создали логин на основе шаблона и id, записали
        $login = 'Select'.$test_id;
        $sql = "UPDATE `users` SET `name`= '". $login ."'  WHERE  `id`='".$user_id ."'";
        $db->query($sql);


        $message = str_replace('%Sel_login%', $login, $message);
        $message = str_replace('%Sel_pass%', $pass , $message);
        $html .='<div class="test_row"><span class="title_test">Для отчётов-</span><span class="login">Логин: '. $login .'</span><span class="pass">Пароль: '. $pass .'</span></div>';


        // если была почта
        if($email!=""){
            $send_mailer = $systems->create_mailer_object();
            $send_mailer->From = 'noreply@laborpro.ru';
            $send_mailer->FromName = 'Охрана Труда';
            $send_mailer->addAddress($email);
            $send_mailer->isHTML(true);
            $subject = "Тестовые аккаунты";
            $send_mailer->Subject = $subject;
            $send_mailer->Body = $message;
            $send_mailer->send();
        }


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result_array['message'] = 'Включен контроль выбранной компании';

        $result = json_encode($result_array, true);
        die($result);
    }
}
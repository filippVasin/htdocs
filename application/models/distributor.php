<?php

class Model_distributor{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }


    // Начинаем прохождение тестирования;
    public function main(){

        $action_name = $this->post_array['action_name'];

        switch ($action_name) {
            case "secretary_signature_action":
                $result_array = $this->secretary_signature_action();
                break;
            case "secretary_get_doc_action":
                $result_array = $this->secretary_get_doc_action();
                break;
            case "bailee_action":
                $result_array = $this->bailee_action();
                break;
            case "create_driver":
                $result_array = $this->create_driver();
                break;
            case "probation_actoin":
                $result_array = $this->probation_actoin();
                break;
            case "probation_alert":
                $result_array = $this->probation_alert();
                break;
            case "print_med_form":
                $result_array = $this->print_med_form();
                break;
        }



        $result_array['content'] = $_SESSION['employee_id'];
        $result_array['status'] = 'ok';
        //
        $result = json_encode($result_array, true);
        die($result);
    }




    private function secretary_signature_action(){
        global $db;

        $la_real_form_id = $this->post_array['la_real_form_id'];
        $la_employee = $this->post_array['la_employee'];
        $observer_em = $this->post_array['observer_em'];
        $local_id = $this->post_array['local_id'];

        $doc_status = 11;// документ подписал

        $sql = "UPDATE `local_alerts` SET `date_finish`= NOW() WHERE  `id`=" . $local_id;
        $db->query($sql);

        $sql="SELECT form_status_now.track_form_step_now, form_status_now.track_number_form_id,temps_form_step.son_step
                FROM form_status_now,temps_form_step
                WHERE temps_form_step.id = form_status_now.track_form_step_now
                AND form_status_now.save_temps_file_id =". $la_real_form_id;
        $form_content = $db->row($sql);
        $son_step = $form_content['son_step'];// зашни на дочерний шаг
        $track = $form_content['track_number_form_id'];



        $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $track ."','".  $son_step ."',NOW(),NOW(),'". $observer_em ."','". $doc_status ."');";

        $db->query($sql);

        $sql = "SELECT history_forms.id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $la_real_form_id;
        $form_content_history = $db->row($sql);
        $insert_history = $form_content_history['id'];

        $sql = "INSERT INTO `form_status_now` (`save_temps_file_id`, `history_form_id`, `track_number_form_id`,`track_form_step_now`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $insert_history ."','". $track ."','". $son_step  ."','". $observer_em ."','". $doc_status ."');";
        $db->query($sql);

        $result_array['la_real_form_id'] = $la_real_form_id;
        $result_array['observer_em'] = $observer_em;
        $result_array['la_employee'] = $la_employee;
        $result_array['form_actoin'] = "la_signature";
        $result_array['page'] = "local_alert";
        return $result_array;
    }


    private function secretary_get_doc_action(){
        global $db;

        $la_real_form_id = $this->post_array['la_real_form_id'];
        $la_employee = $this->post_array['la_employee'];
        $observer_em = $this->post_array['observer_em'];
        $local_id = $this->post_array['local_id'];

        $doc_status = 13;// Секретарь получил документ

        $sql = "UPDATE `local_alerts` SET `date_finish`= NOW() WHERE  `id`=" . $local_id;
        $db->query($sql);

        $sql="SELECT form_status_now.track_form_step_now, form_status_now.track_number_form_id,temps_form_step.son_step
                FROM form_status_now,temps_form_step
                WHERE temps_form_step.id = form_status_now.track_form_step_now
                AND form_status_now.save_temps_file_id =". $la_real_form_id;
        $form_content = $db->row($sql);
        $son_step = $form_content['son_step'];// зашни на дочерний шаг
        $track = $form_content['track_number_form_id'];



        $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $track ."','".  $son_step ."',NOW(),NOW(),'". $observer_em ."','". $doc_status ."');";

        $db->query($sql);

        $sql = "SELECT history_forms.id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $la_real_form_id;
        $form_content_history = $db->row($sql);
        $insert_history = $form_content_history['id'];

        $sql = "INSERT INTO `form_status_now` (`save_temps_file_id`, `history_form_id`, `track_number_form_id`,`track_form_step_now`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $insert_history ."','". $track ."','". $son_step  ."','". $observer_em ."','". $doc_status ."');";
        $db->query($sql);

        $result_array['la_real_form_id'] = $la_real_form_id;
        $result_array['observer_em'] = $observer_em;
        $result_array['la_employee'] = $la_employee;
        $result_array['form_actoin'] = "secretary_accept_alert";
        $result_array['page'] = "local_alert";
        return $result_array;
    }


    private function bailee_action(){
        global $db;

        $la_real_form_id = $this->post_array['la_real_form_id'];
        $la_employee = $this->post_array['la_employee'];
        $observer_em = $this->post_array['observer_em'];
        $local_id = $this->post_array['local_id'];

        $doc_status = 16;// документ подписал ответственный

        $sql = "UPDATE `local_alerts` SET `date_finish`= NOW() WHERE  `id`=" . $local_id;
        $db->query($sql);

        $sql="SELECT form_status_now.track_form_step_now, form_status_now.track_number_form_id,temps_form_step.son_step
                FROM form_status_now,temps_form_step
                WHERE temps_form_step.id = form_status_now.track_form_step_now
                AND form_status_now.save_temps_file_id =". $la_real_form_id;
        $form_content = $db->row($sql);
        $son_step = $form_content['son_step'];// зашни на дочерний шаг
        $track = $form_content['track_number_form_id'];



        $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $track ."','".  $son_step ."',NOW(),NOW(),'". $observer_em ."','". $doc_status ."');";

        $db->query($sql);

        $sql = "SELECT history_forms.id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $la_real_form_id;
        $form_content_history = $db->row($sql);
        $insert_history = $form_content_history['id'];

        $sql = "INSERT INTO `form_status_now` (`save_temps_file_id`, `history_form_id`, `track_number_form_id`,`track_form_step_now`,`author_employee_id`,`doc_status_now`) VALUES( '". $la_real_form_id ."','". $insert_history ."','". $track ."','". $son_step  ."','". $observer_em ."','". $doc_status ."');";
        $db->query($sql);

        $result_array['la_real_form_id'] = $la_real_form_id;
        $result_array['observer_em'] = $observer_em;
        $result_array['la_employee'] = $la_employee;
        $result_array['form_actoin'] = "la_signature";
        $result_array['page'] = "local_alert";
        return $result_array;
    }


    private function create_driver(){
        global $db, $labro, $regisrt_temp_mail, $systems;
        $la_real_form_id = $this->post_array['la_real_form_id'];
        $sql = "SELECT * FROM sump_for_employees WHERE sump_for_employees.id =".$la_real_form_id;
        $result = $db->row($sql);

        $result_array = array();
        // получаем данные из POST запроса
        $name = $result['name'];
        $surname = $result['surname'];
        $patronymic = $result['patronymic'];
        $work_start = $result['work_start'];
        $birthday = $result['birthday'];
        $email = $result['email'];
        $id_item = $result['id_item'];
        $company_id = $result['company_id'];
        $dol_id = $result['dol_id'];
        $fio = $surname." ".$name." ".$patronymic;

        $reg_address = $result['reg_address'];
        $driver_categories = $result['category'];
        $driver_number = $result['driver_number'];
        $driver_start = $result['start_date'];
        $driver_end = $result['end_date'];



        if($result['personnel_number']!=""){
            $personnel_number = $this->post_array['personnel_number'];
            $sql = "INSERT INTO `employees` (`personnel_number`,`surname`, `name`, `second_name`,`status`,`email`,`start_date`,`birthday`) VALUES('" . $personnel_number . "','" . $surname . "','" . $name . "','" . $patronymic . "','1','" . $email . "','". $work_start ."','". $birthday ."');";

            $db->query($sql);
        } else {
            $sql = "INSERT INTO `employees` (`surname`, `name`, `second_name`,`status`,`email`,`start_date`,`birthday`) VALUES('" . $surname . "','" . $name . "','" . $patronymic . "','1','" . $email . "','". $work_start ."','". $birthday ."');";

            $db->query($sql);
        }
        $employee_id = mysqli_insert_id($db->link_id);

        $login = $labro->generate_password();
        $pass = $labro->generate_password();
        $role_id = 3;

        $sql = "INSERT INTO `users` (`name`, `password`, `role_id`,`employee_id`,`full_name`) VALUES('" . $login . "','" . md5($pass) . "','" . $role_id . "','" . $employee_id . "','" . $surname . "');";
        $db->query($sql);

        $sql = 'INSERT INTO `employees_items_node` (`employe_id`, `org_str_id`) VALUES("' . $employee_id . '","' . $dol_id . '")';
        $db->query($sql);
        if($reg_address !="") {
            // регистрация
            $sql = 'INSERT INTO `registration_address` (`emp_id`, `address`) VALUES("' . $employee_id . '","' . $reg_address . '")';
            $db->query($sql);
            // водительские права
            $sql = 'INSERT INTO `drivers_license` (`emp_id`, `company_id`, `category`, `license_number`, `start_date`, `end_date`) VALUES("' . $employee_id . '","' . $company_id . '","' . $driver_categories . '","' . $driver_number . '","' . $driver_start . '","' . $driver_end . '")';
            $db->query($sql);
        }
        $subject = "Уведомление";
        $mail_type = "reg";

        $template_mail_id = 1;
        $message = $regisrt_temp_mail;


        $message = str_replace('%fio%', $fio, $message);
        $message = str_replace('%login%', $login, $message);
        $message = str_replace('%pass%', $pass, $message);
        $hash = $labro->url_hash($labro->employees_to_user($employee_id));
        $message = str_replace('%link%', $hash, $message);
//            echo $message;
        $send_mailer = $systems->create_mailer_object();

        $send_mailer->From = 'noreply@laborpro.ru';
        $send_mailer->FromName = 'Охрана Труда';
        $send_mailer->addAddress($email);
        $send_mailer->isHTML(true);

        $send_mailer->Subject = $subject;
        $send_mailer->Body = $message;

        if ($send_mailer->send()) {
            $result_array['content'] = 'Сотрудник добавлен, письмо с паролем отправленно';
            $send_result = 'Письмо отправлено';
            // пишим логи
            $sql = 'INSERT INTO `mails_log` (`employee_id`, `email`,`mail_type`,`template_mail_id`,`send_result`,`send_date`)
                                          VALUES("' . $employee_id .
                '","' . $email .
                '","' . $mail_type .
                '","' . $template_mail_id .
                '","' . $send_result .
                '",NOW())';
            $db->query($sql);

        } else {
            $send_result = 'Ошибка при отправки письма: ' . $send_mailer->ErrorInfo;
            $result_array['content'] = $send_result;
            // пишим логи
            $sql = 'INSERT INTO `mails_log` (`employee_id`, `email`,`mail_type`,`template_mail_id`,`send_result`,`send_date`)
                                          VALUES("' . $employee_id .
                '","' . $email .
                '","' . $mail_type .
                '","' . $template_mail_id .
                '","' . $send_result .
                '",NOW())';
            $db->query($sql);
        }

        $sql = "DELETE FROM `local_alerts` WHERE  `action_type_id`= 17 AND `save_temp_files_id`=". $la_real_form_id;
        $db->query($sql);
        $sql = "UPDATE `sump_for_employees` SET `employee_id`= ". $employee_id ." WHERE  `id`=" . $la_real_form_id;
        $db->query($sql);

        $result_array['employee_id'] = $employee_id;
        $result_array['la_real_form_id'] = $la_real_form_id;

        return $result_array;
    }

    private function probation_actoin(){
        global $db;
        $emp = $this->post_array['emp'];

        $sql = "SELECT * FROM `local_alerts` WHERE `initiator_employee_id` = ".$emp ." AND `action_type_id` = 19";
        $result = $db->row($sql);
        $step_id = $result['step_id'];

        $sql = "UPDATE `local_alerts` SET `date_finish`= NOW() WHERE  `initiator_employee_id`=" . $emp ." AND `action_type_id`= 19";
        $db->query($sql);

        $sql = "INSERT INTO `history_step` (`employee_id`,`step_id`,`data_finish`) VALUES ( ". $emp .", ". $step_id .",NOW())";
        $db->query($sql);

        $sql = "INSERT INTO `history_docs` (`employee_id`,`step_id`,`date_start`,`date_finish`) VALUES ( ". $emp .", ". $step_id .",NOW(),NOW())";
        $db->query($sql);

        $sql= "INSERT INTO `form_status_now` (`track_number_form_id`,`track_form_step_now`, `doc_status_now`, `author_employee_id`, `step_id`) VALUES ('5','37','1', '". $emp ."', '". $step_id ."')";
        $db->query($sql);

        "INSERT INTO `history_forms` (`step_end_time`, `track_form_id`, `track_form_step`, `start_data`, `doc_status_now`, `author_employee_id`) VALUES (NOW(), '7', '37', NOW(), '1','". $emp ."')";
        $db->query($sql);

        $result_array['content'] = "";
        return $result_array;
    }



    private function probation_alert(){
        global $db;
        $emp = $this->post_array['emp'];
        $order = $this->post_array['order'];
        $mentor_id = $this->post_array['mentor_id'];
        $bus_id = $this->post_array['bus_id'];
        $route_id = $this->post_array['route_id'];
        $hours = $this->post_array['hours'];
        $inst_date = $this->post_array['inst_date'];

        $hours_ints = 8;
        $hours_driving = $hours - $hours_ints;
        // подготовка дат к записи в базу
        $inst_date = date_create($inst_date)->Format('Y-m-d');

        $sql= "INSERT INTO `internship_list` (`employee_id`, `order`, `mentor_id`, `bus_id`, `route_id`, `hours_all`, `hours_ints`, `hours_driving`, `date`)
        VALUES ('". $emp ."', '". $order ."', '". $mentor_id ."', '". $bus_id ."', '". $route_id ."', '". $hours ."', '". $hours_ints ."', '". $hours_driving ."', '". $inst_date ."');";
        $db->query($sql);



        $blank = "PATP1_Probationer";
        $result_array['link'] = "/doc_views?". $blank ."&probation&". $emp;

        $sql = "UPDATE `local_alerts` SET `action_type_id`= 19 WHERE  `action_type_id`= 18 AND `initiator_employee_id`=". $emp;
        $db->query($sql);

//        $sql = "DELETE FROM `local_alerts` WHERE  `action_type_id`= 18 AND `initiator_employee_id`=". $emp;
//        $db->query($sql);


        return $result_array;
    }

    private function print_med_form(){
        global $db;
        $file_id = $this->post_array['file_id'];
        $type_emp = "sump";
        $sql = " SELECT medical_organization.referral
            FROM med_org_statistician , medical_organization
            WHERE med_org_statistician.emp_id = ". $file_id ."
            AND med_org_statistician.type_emp ='". $type_emp ."'
            AND medical_organization.id = med_org_statistician.med_id";
        $blank = $db->one($sql);

        $result_array['link'] = "/doc_views?". $blank ."&start_blank&".$file_id;

        return $result_array;
    }


}
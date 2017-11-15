<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_creator
{
    // Данные для обработки POST запросов;
    public $post_array;
    public $employees;

    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    // тестим здесь
    public function select_one()
    {
        global $db, $employees;;

        if(!(isset($_SESSION['control_company']))){
            header("Location:/company_control");
        }

        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.items_control_id AS type_id,
                organization_structure.right_key,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . " GROUP BY id  ORDER BY fio";


        $employees = $db->all($sql);

        $html = '';
        $item_id = 0;
        foreach($employees as $employee){
            if($employee['left_key']==1){
                $html .= '<div>'.  $employee['erarh'].'</div>';
                $item_id = $employee['id'];

            }
        }


        $html .= '<div class ="select_box_item" >';
        $html .= '<select class="target" level="1" style="margin-left: 0px;">';
        $html .= '<option value="" ></option>';
        foreach ($employees as $employee_box) {
            if($employee_box['level'] == 1) {

                $html .= '<option value="' . $employee_box['id'] . '" >' . $employee_box['erarh'] . '</option>';
            }
        }
        $html .= '</select> <div class="button_clear" id="button_clear" level="1"></div><div class="button_plus" level="1" item="'. $item_id .'"></div>';
        $html .= '<div>';
        return $html;


    }


    // Вывод всего дерева;
    public function select_event(){

        global $db;
        $item_id = $this->post_array['select_item_id'];
        $html = '';
        $level = "";

        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.items_control_id AS type_id,
                organization_structure.right_key,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id =" . $_SESSION['control_company'] . " GROUP BY id  ORDER BY fio";

        $employees = $db->all($sql);
        $type = 0;
        //  выясняем level  по полученному id
        foreach($employees as $employee){
            if($employee['id']==$item_id){
                $level =  $employee['level'];
                if($employee['type_id']!=3){
                    $level++;// задаём новый уровень
                    $type = 1;
                } else {
                    $type = 3;
                }
            }
        }

        foreach($employees as $employee_key) {
            if ($item_id == $employee_key['id']) {
                $left = $employee_key['left_key'];
                $right = $employee_key['right_key'];
            }
        }

        if($type== 1){
            $html .= '<div class ="select_box_item">';
            $html .= '<select class="target" level="'. $level .'" style="">';
            $html .= '<option value="" ></option>';
            foreach ($employees as $key => $employee_box) {
                if(($employee_box['level'] == $level) &&($left <= $employee_box['left_key']) && ($right >= $employee_box['right_key'])) {

                    $html .= '<option value="' . $employee_box['id'] . '" >' . $employee_box['erarh'] . '</option>';
                }
            }
            $html .= '</select> <div class="button_clear" level="'. $level .'"></div><div class="button_plus" level="'. $level .'" item="'. $item_id .'"></div>';
            $html .= '<div>';
        } else{
                $html = '<div class="create_form_box">';
                $html.=        '<div title="Фамилиия" class="bef_input"><input type="text" id="form_surname" name="surname"  placeholder="Фамилиия" class="contacts-inp input_form" required=""></div>';
                $html.=        '<div title="Имя" class="bef_input"><input type="text" id="form_name" name="name" placeholder="Имя" class="contacts-inp input_form" required=""></div>';
                $html.=        '<div title="Отчество" class="bef_input"><input type="text" id="form_patronymic" name="patronymic" placeholder="Отчество" class="contacts-inp input_form" required=""></div>';
                $html.=        '<div title="Дата устройства" class="bef_input"><input type="text" id="form_work_start" name="work_start" placeholder="Дата устройства" class="contacts-inp form_work_start_cl input_form form-control pull-right" required=""></div>';
                $html.=        '<div title="Дата рождения" class="bef_input"><input type="text" id="form_birthday"  name="birthday" placeholder="Дата рождения" class="form_birthday_cl contacts-inp input_form form-control pull-right" required=""></div>';
                $html.=        '<div title="Электронная почта" class="bef_input"><input type="text" id="form_email" name="email" placeholder="Электронная почта" class="contacts-inp input_form" required=""></div>';
                $html.=        '<div title="Табельный номер" class="bef_input"><input type="text" id="personnel_number" name="personnel_number" placeholder="Табельный номер(не обязательно)" class="contacts-inp input_form" required=""></div>';
                $html.=        '<input type="text" id="form_id_item" name="id_item" value="'. $item_id .'" required="">';
                $html.=        '<div id="landing_form_offer_one" style="margin-left: 100px;" class="button">Записать</div>';
                $html.=  '</div>';


        }




        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


    // добавляем сотрудника;
    public function create_form() {
        global $db, $systems, $labro, $regisrt_temp_mail;

        // получаем данные из POST запроса
        $name = $this->post_array['name'];
        $surname = $this->post_array['surname'];
        $patronymic = $this->post_array['patronymic'];
        $work_start = $this->post_array['work_start'];
        $birthday = $this->post_array['birthday'];
        $email = $this->post_array['email'];
        $id_item = $this->post_array['id_item'];
        $dol_id = $this->post_array['dol_id'];
        $medical = $this->post_array['medical'];
        $fio = $surname." ".$name." ".$patronymic;
        $result_array = array();

        // подготовка дат к записи в базу
        $work_start = date_create($work_start)->Format('Y-m-d');
        $birthday = date_create($birthday)->Format('Y-m-d');
        // если почта не задана
        if($email == "") {
            // почта структурного подразделения
            $sql = "SELECT org_str_email.email
                    FROM organization_structure
                         LEFT JOIN organization_structure AS mail_org_str ON (mail_org_str.left_key <= organization_structure.left_key
                                                                                                AND
                                                                                                 mail_org_str.right_key >= organization_structure.right_key
                                                                                                 AND
                                                                                                 mail_org_str.company_id = organization_structure.company_id)
                            LEFT JOIN org_str_email ON org_str_email.org_str_id = mail_org_str.id
                    WHERE organization_structure.id = " . $dol_id . "
                    AND org_str_email.id is not NULL
                    ORDER BY mail_org_str.`level` DESC
                    LIMIT 1";
            $email = $db->one($sql);

            if ($_SESSION['employee_id'] == 43) {
                $email = "vasin.filipp@yandex.ru";// Пока Филипп
            }
        }
            if(isset($this->post_array['personnel_number'])){
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

            $subject = "Уведомление";
            $mail_type = "reg";
            // запрашиваем шаблон письма
            $sql="Select *
                  FROM mail_template
                  WHERE mail_template.company_id =". $_SESSION['control_company'] ."
                  AND mail_template.mail_type = '".$mail_type ."'";
            $email_temp = $db->row($sql);

            // данные для логов
            $template_mail_id = $email_temp['id'];

            $message = $regisrt_temp_mail;
            $message = str_replace('%fio%', $fio, $message);
            $message = str_replace('%login%', $login, $message);
            $message = str_replace('%pass%', $pass, $message);
            $hash = $labro->url_hash($labro->employees_to_user($employee_id));
            $message = str_replace('%link%', $hash, $message);
            $send_mailer = $systems->create_mailer_object();

            $send_mailer->From = 'noreply@laborpro.ru';
            $send_mailer->FromName = 'Охрана Труда';
            $send_mailer->addAddress($email);
            $send_mailer->isHTML(true);

            $send_mailer->Subject = $subject;
            $send_mailer->Body = $message;

            if ($send_mailer->send()) {
                $result_array['content'] = 'Сотрудник добавлен, письмо с паролем отправленно';
                $result_array['status'] = "ok";
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
                $result_array['status'] = "error";
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

        // статистика по медецинским организациям
        $type_emp = "employees";
        $med_emp_id = $employee_id;
        $sql="INSERT INTO `med_org_statistician` (`med_id`,`emp_id`,`type_emp`)
              VALUES ('". $medical ."','". $med_emp_id ."','". $type_emp ."');";
        $db->query($sql);
        // выбираем нужное направление на мед.осмотр
        $sql = " SELECT medical_organization.referral
            FROM med_org_statistician , medical_organization
            WHERE med_org_statistician.emp_id = ". $med_emp_id ."
            AND med_org_statistician.type_emp ='". $type_emp ."'
            AND medical_organization.id = med_org_statistician.med_id";
        $blank = $db->one($sql);

       $result_array['link'] = "/doc_views?". $blank ."&start_blank&".$employee_id;
       $result = json_encode($result_array, true);
        die($result);
    }


    public function create_drivers(){
        global $db;

        // получаем данные из POST запроса
        $name = $this->post_array['name'];
        $surname = $this->post_array['surname'];
        $patronymic = $this->post_array['patronymic'];
        $work_start = $this->post_array['work_start'];
        $birthday = $this->post_array['birthday'];
        $email = $this->post_array['email'];
        $id_item = $this->post_array['id_item'];
        $dol_id = $this->post_array['dol_id'];
        $medical = $this->post_array['medical'];

        if(isset($this->post_array['personnel_number'])){
            $personnel_number = $this->post_array['personnel_number'];
        } else {
            $personnel_number = "";
        }

        $reg_address = $this->post_array['reg_address'];
        $categories = $this->post_array['driver_categories'];
        $number = $this->post_array['driver_number'];
        $driver_start = $this->post_array['driver_start'];
        $driver_end = $this->post_array['driver_end'];

        // подготовка дат к записи в базу
        $work_start = date_create($work_start)->Format('Y-m-d');
        $birthday = date_create($birthday)->Format('Y-m-d');
        $driver_start = date_create($driver_start)->Format('Y-m-d');
        $driver_end = date_create($driver_end)->Format('Y-m-d');

        $sql = "SELECT `id` FROM `sump_for_employees` WHERE `name` = '".$name."' AND `surname` = '".$surname."'AND `patronymic` = '".$patronymic."'AND `birthday` = '".$birthday."';";

        $sump_data = $db->row($sql);

        if($sump_data['id'] != '') {
            $result_array['content'] = "Такой человек уже есть в системе";
            $result_array['status'] = "error";
            $result = json_encode($result_array, true);
            die($result);
        }

        // если почта не задана
        if($email == "") {
            // почта структурного подразделения
            $sql = "SELECT org_str_email.email
                    FROM organization_structure
                         LEFT JOIN organization_structure AS mail_org_str ON (mail_org_str.left_key <= organization_structure.left_key
                                                                                                AND
                                                                                                 mail_org_str.right_key >= organization_structure.right_key
                                                                                                 AND
                                                                                                 mail_org_str.company_id = organization_structure.company_id)
                            LEFT JOIN org_str_email ON org_str_email.org_str_id = mail_org_str.id
                    WHERE organization_structure.id = " . $dol_id . "
                    AND org_str_email.id is not NULL
                    ORDER BY mail_org_str.`level` DESC
                    LIMIT 1";
            $email = $db->one($sql);

            if ($_SESSION['employee_id'] == 43) {
                $email = "vasin.filipp@yandex.ru";// Пока Филипп
            }
        }
        $sql="INSERT INTO `sump_for_employees` (`reg_address`,`personnel_number`,`name`,`surname`,`patronymic`,`work_start`,`birthday`,`email`,`id_item`,`company_id`,`category`,`license_number`,`start_date`,`end_date`,`dol_id`,`author_id`,`creator_time`)
              VALUES ('". $reg_address ."','". $personnel_number ."','". $name ."','". $surname ."','". $patronymic ."','". $work_start ."','". $birthday ."','". $email ."','". $id_item ."','". $_SESSION['control_company'] ."','". $categories ."','". $number ."','". $driver_start ."','". $driver_end ."','". $dol_id ."','". $_SESSION['employee_id'] ."', NOW());";

        $db->query($sql);

        $sump_employees_id = mysqli_insert_id($db->link_id);
        $action_type_id = 17;// Секретарь должен получить документ
        //$this->history_insert($action_type_id);

        // узнаём оргструктурную принадлежность вводящего данные
        $sql="SELECT employees_items_node.org_str_id FROM employees_items_node WHERE employees_items_node.employe_id =".  $_SESSION['employee_id'];
        $observer_org_str_id = $db->one($sql);

        $sql = "INSERT INTO `local_alerts` (`observer_org_str_id`, `action_type_id`,`company_id`,`save_temp_files_id`,`date_create`)
                                       VALUES( '" .  $observer_org_str_id.
            "','" . $action_type_id .
            "','" . $_SESSION['control_company'] .
            "','" . $sump_employees_id .
            "',NOW());";
        $db->query($sql);

        // статистика по медецинским организациям
        $type_emp = "sump";
        $med_emp_id = $sump_employees_id;
        $sql="INSERT INTO `med_org_statistician` (`med_id`,`emp_id`,`type_emp`)
              VALUES ('". $medical ."','". $med_emp_id ."','". $type_emp ."');";
        $db->query($sql);
        // выбираем нужное направление на мед.осмотр
       $sql = " SELECT medical_organization.referral
            FROM med_org_statistician , medical_organization
            WHERE med_org_statistician.emp_id = ". $med_emp_id ."
            AND med_org_statistician.type_emp ='". $type_emp ."'
            AND medical_organization.id = med_org_statistician.med_id";
        $blank = $db->one($sql);


        $result_array['link'] = "/doc_views?". $blank ."&start_blank&".$sump_employees_id;
        $result_array['content'] = "Данные добавлены, ожидаем прохождения медосмотра";
        $result_array['status'] = "ok";
        $result = json_encode($result_array, true);
        die($result);
    }

    // добавляем тип
    public function button_plus()
    {
        global $db;

        // получаем данные из POST запроса
        $id_item = $this->post_array['id_item'];
        $sql = "SELECT * FROM items_control_types";
        $employees = $db->all($sql);


        $html = '<div class ="select_box_item_row">';
        $html .= '<div class="select_row"><select class="new_type"  style="">';
        $html .= '<option value="" ></option>';
        $html .= '<option value="new" >добавить новый тип</option>';
        foreach ($employees as $employee_box) {
                $html .= '<option value="' . $employee_box['id'] . '" >' . $employee_box['name'] . '</option>';
        }
        $html .= '</select>';
        $html .= '<select id="news_num"  style="">';
        $html .= '</select> </div>';
        $html .=  '<div class="button" id="save_new_type" parent="'.$id_item . '">Сохранить</div>';
        $html .= '<div>';




        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }










    // добавляем наменклатуру;
    public function new_type_select()
    {
        global $db;


        $select_item_id = $this->post_array['select_item_id'];

        if($select_item_id=="new") {
            $html = '<div>';
            $html .= '<input type="text" id="input_new_type" placeholder="Тип">';
            $html .= '<input type="text" id="input_new_num" placeholder="Наменклатура">';
            $html .= '</div>';
            $result_array['status'] = 'new';
        } else {
            $sql = "SELECT id, name FROM items_control WHERE items_control.type_id = " .$select_item_id ;
            $employees = $db->all($sql);

            $html = '<option value="" ></option>';
            $html .= '<option value="new" >добавить новый пункт</option>';
            foreach ($employees as $employee_box) {
                $html .= '<option value="' . $employee_box['id'] . '" >' . $employee_box['name'] . '</option>';
            }
            $result_array['status'] = 'ok';
        }

        $result_array['content'] = $html;

        $result = json_encode($result_array, true);
        die($result);
    }

    // добавляем наменклатуру;
    public function save_new_type_select()
    {

        global $db;

        $parent = $this->post_array['parent'];
        // новый тип и нуменклатура
        if((isset($this->post_array['input_new_type']))&&(isset($this->post_array['input_new_num']))){
            $input_new_type = $this->post_array['input_new_type'];
            $input_new_num = $this->post_array['input_new_num'];
            $sql = "SELECT items_control.id AS num_id, items_control_types.id AS type_id, items_control.name AS num, items_control_types.name AS type
                    FROM organization_structure
                    LEFT JOIN items_control ON organization_structure.kladr_id = items_control.id
                    LEFT JOIN items_control_types ON organization_structure.items_control_id = items_control_types.id
                    WHERE organization_structure.parent = '". $parent ."'
                    AND items_control.name LIKE '". $input_new_num ."'
                    AND items_control_types.name LIKE '". $input_new_type."'" ;
            $result = $db->row($sql);

            if($result['num_id']!=''){
                $html =  "Данный элемент существует";
            } else {
                // добавляем новый тип и наменклатуру

                $sql = "INSERT INTO `items_control_types` (`name`) VALUES( '". $input_new_type ."');";
                $db->query($sql);
                $sql = "SELECT items_control_types.id
                        FROM items_control_types
                        WHERE items_control_types.name ='". $input_new_type."'";
                $result = $db->row($sql);

                $select_new_type_id = $result['id'];

                $status = 1;
                $sql = "INSERT INTO `items_control` (`type_id`, `company_id`, `name`, `status`) VALUES( '". $select_new_type_id ."','". $_SESSION['control_company'] ."','". $input_new_num ."','". $status ."');";
                $db->query($sql);

                $sql = "SELECT items_control.id
                        FROM items_control
                        WHERE items_control.name = '". $input_new_num ."'
                        AND items_control.type_id =".$select_new_type_id;
                $result = $db->row($sql);

                $item_control_id = $result['id'];

                $html = "Запись прошла успешна";
                $this->InsertNode($parent,$_SESSION['control_company'],$item_control_id,$select_new_type_id,1);
                // запись в папкин бэкапп
                $sql = "SELECT organization_structure.id,items_control.id AS num_id, items_control_types.id AS type_id, items_control.name AS num, items_control_types.name AS type
                    FROM organization_structure
                    LEFT JOIN items_control ON organization_structure.kladr_id = items_control.id
                    LEFT JOIN items_control_types ON organization_structure.items_control_id = items_control_types.id
                    WHERE organization_structure.parent = '". $parent ."'
                    AND items_control.id = '". $item_control_id ."'
                    AND items_control_types.id = ". $select_new_type_id ;

                $result = $db->row($sql);
                $org_id = $result['id'];

                $sql = "INSERT INTO `parent_backup` (`date_update`, `id_org_struct`, `id_parent`) VALUES( NOW(),'". $org_id ."','". $parent ."');";
                $db->query($sql);

            }

        }

        if((isset($this->post_array['select_news_num_id']))&&(isset($this->post_array['select_new_type_id']))){
            $select_news_num_id = $this->post_array['select_news_num_id'];
            $select_new_type_id = $this->post_array['select_new_type_id'];
            $sql = "SELECT items_control.id AS num_id, items_control_types.id AS type_id, items_control.name AS num, items_control_types.name AS type
                    FROM organization_structure
                    LEFT JOIN items_control ON organization_structure.kladr_id = items_control.id
                    LEFT JOIN items_control_types ON organization_structure.items_control_id = items_control_types.id
                    WHERE organization_structure.parent = '". $parent ."'
                    AND items_control.id = '". $select_news_num_id ."'
                    AND items_control_types.id = ". $select_new_type_id ;

            $result = $db->row($sql);

            if($result['num_id']!=''){
                $html =  "Данный элемент существует";
            } else {
                // добавление
                // $data - массив контент, кроме обязательных
                $html = "Запись прошла успешна";
                 //         id родителя, данные, условия
                $item_control_id = $select_news_num_id;
                $this->InsertNode($parent,$_SESSION['control_company'],$item_control_id,$select_new_type_id,1);
               // запись в папкин бэкапп
                $sql = "SELECT organization_structure.id,items_control.id AS num_id, items_control_types.id AS type_id, items_control.name AS num, items_control_types.name AS type
                    FROM organization_structure
                    LEFT JOIN items_control ON organization_structure.kladr_id = items_control.id
                    LEFT JOIN items_control_types ON organization_structure.items_control_id = items_control_types.id
                    WHERE organization_structure.parent = '". $parent ."'
                    AND items_control.id = '". $select_news_num_id ."'
                    AND items_control_types.id = ". $select_new_type_id ;

                $result = $db->row($sql);
                $org_id = $result['id'];

                $sql = "INSERT INTO `parent_backup` (`date_update`, `id_org_struct`, `id_parent`) VALUES( NOW(),'". $org_id ."','". $parent ."');";
                $db->query($sql);
            }

        }
        // новая нуменклатура
        if((isset($this->post_array['select_new_type_id']))&&(isset($this->post_array['input_new_num']))){
            $select_new_type_id = $this->post_array['select_new_type_id'];
            $input_new_num = $this->post_array['input_new_num'];
            $sql = "SELECT items_control.id, items_control.id AS num_id, items_control_types.id AS type_id, items_control.name AS num, items_control_types.name AS type
                    FROM organization_structure
                    LEFT JOIN items_control ON organization_structure.kladr_id = items_control.id
                    LEFT JOIN items_control_types ON organization_structure.items_control_id = items_control_types.id
                    WHERE items_control.name LIKE '". $input_new_num ."'
                    AND items_control_types.id = ". $select_new_type_id ;
//            echo $sql;
            $result = $db->row($sql);

            if($result['num_id']!=''){
                $html =  "Данный элемент существует,<br> выберите из списка нуменклатуры";
            } else {



                // добавляем нуменклатуру
                $status = 1;
                $sql = "INSERT INTO `items_control` (`type_id`, `company_id`, `name`, `status`) VALUES( '". $select_new_type_id ."','". $_SESSION['control_company'] ."','". $input_new_num ."','". $status ."');";
                $db->query($sql);

                $sql = "SELECT items_control.id
                        FROM items_control
                        WHERE items_control.name = '". $input_new_num ."'
                        AND items_control.type_id =".$select_new_type_id;
                $result = $db->row($sql);

                $item_control_id = $result['id'];


                $sql = "SELECT organization_structure.id, items_control_types.name AS type, items_control.name AS dit
                        FROM organization_structure,items_control,items_control_types
                        WHERE organization_structure.id = ". $parent ."
                        AND organization_structure.items_control_id = items_control_types.id
                        AND organization_structure.kladr_id = items_control.id";
                $result = $db->row($sql);

                $parent_dir = $result['type']. " " . $result['dit'] ;


                $html = "Запись ". $input_new_num  ." в ". $parent_dir ." прошла успешна";

//                //         id родителя, данные, условия
                $this->InsertNode($parent,$_SESSION['control_company'],$item_control_id,$select_new_type_id,1);


                // запись в папкин бэкапп
                $sql = "SELECT organization_structure.id,items_control.id AS num_id, items_control_types.id AS type_id, items_control.name AS num, items_control_types.name AS type
                    FROM organization_structure
                    LEFT JOIN items_control ON organization_structure.kladr_id = items_control.id
                    LEFT JOIN items_control_types ON organization_structure.items_control_id = items_control_types.id
                    WHERE organization_structure.parent = '". $parent ."'
                    AND items_control.id = '". $select_news_num_id ."'
                    AND items_control_types.id = ". $select_new_type_id ;

                $result = $db->row($sql);
                $org_id = $result['id'];

                $sql = "INSERT INTO `parent_backup` (`date_update`, `id_org_struct`, `id_parent`) VALUES( NOW(),'". $org_id ."','". $parent ."');";
                $db->query($sql);
            }

        }

        if($html == "Запись прошла успешна"){
            $status = "ok";
        } else {
            $status = "not ok";
        }

        $result_array['status'] = $status;
        $result_array['content'] = $html;
        $result = json_encode($result_array, true);
        die($result);
    }


    public function get_input(){
        global $db;
        $email = "";
        $dol_id = $this->post_array['dol_id'];
        $sql = "SELECT org_str_email.email
                    FROM organization_structure
                         LEFT JOIN organization_structure AS mail_org_str ON (mail_org_str.left_key <= organization_structure.left_key
                                                                                                AND
                                                                                                 mail_org_str.right_key >= organization_structure.right_key
                                                                                                 AND
                                                                                                 mail_org_str.company_id = organization_structure.company_id)
                            LEFT JOIN org_str_email ON org_str_email.org_str_id = mail_org_str.id
                    WHERE organization_structure.id = " . $dol_id . "
                    AND org_str_email.id is not NULL
                    ORDER BY mail_org_str.`level` DESC
                    LIMIT 1";
        $email = $db->one($sql);
        $html = "";
        $result_array['email'] = $email;
        $result_array['status'] = "ok";
        $result_array['content'] = $html;
        $result = json_encode($result_array, true);
        die($result);
    }

    // функция добавление элемента в дерево компании
    private  function InsertNode($new_parent_id,$company_id,$kladr_id,$items_control_id,$boss_type){
        global $db;
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $new_parent_id;
        $result = $db->row($sql);
        $right_key = $result['right_key'];
        $parent_level = $result['level'];

        // добавляем в конец списка

        $sql="UPDATE `organization_structure` SET `left_key` = `left_key` + 2 WHERE `left_key` > {$right_key} AND `company_id` = {$company_id}";
        $db->query($sql);
        $sql="UPDATE `organization_structure` SET `right_key` = `right_key` + 2 WHERE `right_key` >= {$right_key} AND `company_id` = {$company_id}";
        $db->query($sql);
        $sql="INSERT INTO `organization_structure` SET `left_key` = {$right_key},
                                                        `right_key` = {$right_key} + 1,
                                                        `company_id` = {$company_id},
                                                        `kladr_id` = {$kladr_id},
                                                        `items_control_id` = {$items_control_id},
                                                        `boss_type` = {$boss_type},
                                                        `level` = {$parent_level } + 1,
                                                         `parent`={$new_parent_id} ;";

        $db->query($sql);
    }


    private  function driver_inputs(){
        $html = "";
        $html .= '<div title="Адрес регистрации" class="bef_input new_input"><input type="text" id="reg_address" name="reg_address" placeholder="Адрес регистрации" class="contacts-inp input_form" required=""></div>
                 <div title="Категории" class="bef_input new_input"><input type="text" id="driver_categories" name="driver_categories" placeholder="Категории водительского удостоверения" class="contacts-inp input_form" required=""></div>
                 <div title="№ удостоверения" class="bef_input new_input"><input type="text" id="driver_number" name="driver_number" placeholder="№ водительского удостоверения" class="contacts-inp input_form" required=""></div>
                 <div title="Начало действия" class="bef_input new_input"><input type="text" id="driver_start" name="driver_start" placeholder="Начало действия удостоверения" class="contacts-inp input_form" required=""></div>
                 <div title="Срок действия" class="bef_input new_input"><input type="text" id="driver_end" name="driver_end" placeholder="Срок действия удостоверения" class="contacts-inp input_form" required=""></div>';
        return $html;
    }
}
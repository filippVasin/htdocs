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
        global $db, $systems, $elements, $employees;;


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

        $html = '<br><br><br><br><br>';
        $item_id = 0;
        foreach($employees as $employee){
            if($employee['left_key']==1){
                $html .= '<div>'.  $employee['erarh'].'</div><br>';
                $item_id = $employee['id'];

            }
        }


        $html .= '<div class ="select_box_item" >';
        $html .= '<select class="target" level="2" style="margin-left: 0px;">';
        $html .= '<option value="" ></option>';
        foreach ($employees as $employee_box) {
            if($employee_box['level'] == 2) {

                $html .= '<option value="' . $employee_box['id'] . '" >' . $employee_box['erarh'] . '</option>';
            }
        }
        $html .= '</select> <div class="button_clear" level="2"></div><div class="button_plus" level="2" item="'. $item_id .'"></div>';
        $html .= '<div>';
        return $html;


    }


    // Вывод всего дерева;
    public function select_event(){

        global $db, $systems, $elements;
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
                $html.=    '<form class="create_form" method="POST" action="/creator/create_form" id="landing_form_offer_one">';
                $html.=        '<input type="text" id="form_name" name="name" placeholder="Имя" class="contacts-inp" required="">';
                $html.=        '<input type="text" id="form_surname" name="surname" placeholder="Фамилия" class="contacts-inp" required="">';
                $html.=        '<input type="text" id="form_patronymic" name="patronymic" placeholder="Отчество" class="contacts-inp" required="">';
                $html.=        '<input type="text" id="form_work_start" name="work_start" placeholder="Дата устройства" class="contacts-inp form_work_start_cl" required="">';
                $html.=        '<input type="text" id="form_birthday"  name="birthday" placeholder="Дата рождения" class="form_birthday_cl contacts-inp " required="">';
                $html.=        '<input type="text" id="form_email" name="email" placeholder="Электронная почта" class="contacts-inp " required="">';
                $html.=        '<input type="hidden" id="form_id_item" name="id_item" value="'. $item_id .'" required="">';
                $html.=        '<input type="submit" form="landing_form_offer_one"  value="Записать" style="margin-left: 100px;" class="button">';
                $html.=    '</form>';
                $html.=  '</div>';
            // скрипт валидации форм
            $html.=  ' <script> $(function() {$("#form_work_start").mask("99.99.9999", {placeholder: "дд.мм.гггг" }); $("#form_birthday").mask("99.99.9999", {placeholder: "дд.мм.гггг" });});</script>';



        }




        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }


    // добавляем сотрудника;
    public function create_form()
    {
        // подключение БД
        global $db, $systems, $elements, $labro, $mailer;;

        // получаем данные из POST запроса
                $name = $this->post_array['name'];
                $surname = $this->post_array['surname'];
                $patronymic = $this->post_array['patronymic'];
                $work_start = $this->post_array['work_start'];
                $birthday = $this->post_array['birthday'];
                $email = $this->post_array['email'];
                $id_item = $this->post_array['id_item'];
        $fio = $surname." ".$name." ".$patronymic;
        $result_array = array();

        // проверяем есть ли такая почта уже
        $sql="Select *
              FROM employees
              WHERE employees.email ='".$email."'";

        $email_data = $db->row($sql);


        if($email_data['id'] != '') {
            // уже есть такая почта
            $result_array['massege'] = 'Почта занята';
            $result_array['status'] = 'Ошибка';
        } else {
            // почта девственная - продолжаем

            $sql = "INSERT INTO `employees` (`surname`, `name`, `second_name`,`status`,`email`,`start_date`,`birthday`) VALUES('" . $name . "','" . $surname . "','" . $patronymic . "','1','" . $email . "',STR_TO_DATE('". $work_start ."', '%d.%m.%Y'),STR_TO_DATE('". $birthday ."', '%d.%m.%Y'));";
//        echo $sql;
            $db->query($sql);
//        echo mysqli_insert_id($db->link_id); можно и так получать id инкримент

            $sql = "SELECT employees.id, employees.name
                    FROM employees
                    WHERE employees.email ='" . $email . "'";
            $form_content_jj = $db->row($sql);
            // генерируем логин и пароль
            $login = $labro->generate_password();
            $pass = $labro->generate_password();

            $role_id = 3;
            $employee_id = $form_content_jj['id'];
            $sql = "INSERT INTO `users` (`name`, `password`, `role_id`,`employee_id`,`full_name`) VALUES('" . $login . "','" . md5($pass) . "','" . $role_id . "','" . $employee_id . "','" . $surname . "');";
//        echo $sql;
            $db->query($sql);

            $sql = 'INSERT INTO `employees_items_node` (`employe_id`, `org_str_id`) VALUES("' . $employee_id . '","' . $id_item . '")';
            $db->query($sql);

            $subject = "Уведомление";
            $mail_type = "Регистрания";
            // запрашиваем шаблон письма
            $sql="Select *
                  FROM mail_template
                  WHERE mail_template.company_id =". $_SESSION['control_company'] ."
                  AND mail_template.mail_type = '".$mail_type ."'";
            $email_temp = $db->row($sql);

            // данные для логов
            $template_mail_id = $email_temp['id'];

            $path = ROOT_PATH.'/application/templates_mail/'. $email_temp['path'];
            $message = file_get_contents($path);

            $message = str_replace('%fio%', $fio, $message);
            $message = str_replace('%login%', $login, $message);
            $message = str_replace('%pass%', $pass, $message);

//            // отправка письма:
//            $mail = new PHPMailer;
////будем отравлять письмо через СМТП сервер
//            $mail->isSMTP();
////хост
//            $mail->Host = 'smtp.yandex.ru';
////требует ли СМТП сервер авторизацию/идентификацию
//            $mail->SMTPAuth = true;
//// логин от вашей почты
//            $mail->Username = 'labropro2';
//// пароль от почтового ящика
//            $mail->Password = 'Rtyuehe1984';
////указываем способ шифромания сервера
//            $mail->SMTPSecure = 'ssl';
////указываем порт СМТП сервера
//            $mail->Port = '465';

////указываем кодировку для письма
//            $mail->CharSet = 'UTF-8';

//информация от кого отправлено письмо
            $mailer->From = 'labropro2@yandex.ru';
            $mailer->FromName = 'Охрана Труда';
            $mailer->addAddress($email);

            $mailer->isHTML(true);

            $mailer->Subject = $subject;
            $mailer->Body = $message;

            if ($mailer->send()) {
                $result_array['massege'] = 'Письмо отправлено';
                $result_array['status'] = 'ok';
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
                $send_result = 'Ошибка при отправки письма: ' . $mailer->ErrorInfo;
                $result_array['massege'] = $send_result;
                $result_array['status'] = 'Ошибка';
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

            $html = '<div> Данные добавлены </div>';
        }
        $result_array['content'] = $html;
        $result = json_encode($result_array, true);
        die($result);
    }


    // добавляем тип
    public function button_plus()
    {

        global $db, $systems, $elements;

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

        global $db, $systems, $elements;


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

        global $db, $systems, $elements;

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
            print_r($result);
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
                    WHERE organization_structure.parent = '". $parent ."'
                    AND items_control.name LIKE '". $input_new_num ."'
                    AND items_control_types.id = ". $select_new_type_id ;
//            echo $sql;
            $result = $db->row($sql);

            if($result['num_id']!=''){
                $html =  "Данный элемент существует";
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

                $html = "Запись прошла успешна";

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


    // функция добавление элемента в дерево компании
    private  function InsertNode($new_parent_id,$company_id,$kladr_id,$items_control_id,$boss_type){
        global $db;
        $sql = "SELECT *
                FROM organization_structure
                WHERE organization_structure.id=". $new_parent_id;
        $result = $db->row($sql);
//        $left_key = $result['left_key'];
        $right_key = $result['right_key'];
        $parent_level = $result['level'];

        // добавляем в конец списка
        $sql="UPDATE `organization_structure` SET `left_key` = `left_key` + 2 WHERE `left_key` > {$right_key} AND `company_id` = {$company_id};
                UPDATE `organization_structure` SET `right_key` = `right_key` + 2 WHERE `right_key` >= {$right_key} AND `company_id` = {$company_id};
                INSERT INTO `organization_structure` SET `left_key` = {$right_key},
                                                        `right_key` = {$right_key} + 1,
                                                        `company_id` = {$company_id},
                                                        `kladr_id` = {$kladr_id},
                                                        `items_control_id` = {$items_control_id},
                                                        `boss_type` = {$boss_type},
                                                        `level` = {$parent_level } + 1,
                                                         `parent`={$new_parent_id} ;";
        echo $sql;
//        $db->query($sql);
    }

}
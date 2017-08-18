<?php

class Model_forms{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else(){
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }

    public function start(){
        global $db;
        $action_name = $this->post_array['action_name'];
        print_r($_SESSION);
        if($action_name!=""){
         // если пришли не с rover


        } else {


            $sql="SELECT save_temp_files.id AS real_form_id, MAX(history_forms.`step_end_time`), periodicity
            FROM save_temp_files,history_forms,route_control_step
            WHERE
            (save_temp_files.employee_id = " . $_SESSION['employee_id'] . "
            AND save_temp_files.company_temps_id = " . $_SESSION['form_id'] . "
            AND route_control_step.`id`= ". $_SESSION['step_id'] ." )
     		OR
     		(save_temp_files.employee_id = " . $_SESSION['employee_id'] . "
            AND save_temp_files.company_temps_id = " . $_SESSION['form_id'] . "
            AND route_control_step.`id`= ". $_SESSION['step_id'] ."
            AND route_control_step.periodicity is not NULL
            AND now() <  (history_forms.`step_end_time` + INTERVAL route_control_step.periodicity MONTH))";



            $condition_test = $db->row($sql);
            $_SESSION['real_form_id'] = $condition_test['real_form_id'];
            if ($_SESSION['real_form_id'] == "") {
                // нет документа
                //
                $sql = "SELECT form_step_action.action_triger,form_step_action.action_name,track_number_form.id,temps_form_step.id AS temps_form_step_id
                    FROM temps_to_route, track_number_form,temps_form_step,form_step_action
                    WHERE temps_to_route.company_temps_id = " . $_SESSION['form_id'] . "
                    AND track_number_form.id = temps_to_route.track_numder_form_id
                    AND temps_form_step.id = track_number_form.start_step_form
                    AND form_step_action.id = temps_form_step.action_form";
                $condition_form = $db->row($sql);
//            echo $sql . " нет документа<br>";

                $_SESSION['temps_form_track'] = $condition_form['id'];
                $_SESSION['temps_form_step_id'] = $condition_form['temps_form_step_id'];
                $action_name = $condition_form['action_name'];
//                echo $action_name;
            } else {

                // запрашиваем следующий шаг документа
                $sql = "SELECT
                    temps_form_step.son_step AS next_step,
                    form_step_action.action_triger,
                    form_step_action.action_name,
                    temps_form_step.id AS temps_form_step_id,
                    temps_form_step.track AS temps_form_track
                    FROM save_temp_files, form_status_now, temps_form_step, temps_form_step AS steps, form_step_action
                    WHERE form_status_now.save_temps_file_id = " . $_SESSION['real_form_id'] . "
                    AND form_status_now.track_form_step_now = temps_form_step.id
                    AND temps_form_step.son_step = steps.id
                    AND form_step_action.id =  steps.action_form";
//            echo $sql . " есть документ <br>";
                $action_forms = $db->row($sql);
                // получили следующий шаг и экшон;
                $action_name = $action_forms['action_name'];
                $_SESSION['temps_form_step_id'] = $action_forms['next_step'];
                $_SESSION['temps_form_track'] = $action_forms['temps_form_track'];


            }
        }// if($action_name!="")
        // выбираем соответствующий экшон и вызываем его
        switch ($action_name) {
            case "create":
                $result_array = $this->create();
                break;
            case "download":
                $result_array = $this->download();
                break;
            case "open":
                $result_array = $this->open();
                break;
            case "user_pass_form_end":
                $result_array = $this->user_pass_form_end();
                break;
            case "save":
                $result_array = $this->save();
                break;
            case "print":
                $result_array = $this->print_file();
                break;
            case "local_alert":
                $result_array = $this->local_alert();
                break;
            case "email_alert":
                $result_array = $this->email_alert();
                break;
            case "signature":
                $result_array = $this->signature();
                break;
            case "la_signature":
                $result_array = $this->la_signature();
                break;
        }

        $result = json_encode($result_array, true);
        die($result);
    }

    private function create(){
        global $db;
            $sql = "SELECT temp_doc_form.name AS form_name, temp_doc_form.path, type_form.name AS type_name
                    FROM  company_temps
                    LEFT JOIN type_temp ON type_temp.id = company_temps.temp_type_id
                    LEFT JOIN type_form ON type_form.id = type_temp.type_form_id
                    LEFT JOIN temp_doc_form ON temp_doc_form.id = type_temp.temp_form_id
                    WHERE company_temps.id =" . $_SESSION['form_id'];
            $form_content = $db->row($sql);
//            echo $sql ."  -первый<br>";
        $doc_item = $form_content['path'];
        $doc_name = $form_content['form_name'];
//        echo $doc_item;
//        echo $_SESSION['form_id'] . " form<br>";
//        echo $_SESSION['step_id'] . " step<br>";
//        echo $_SESSION['employee_id'] . " employee<br>";
//        echo $_SESSION['real_form_id']. " real_form_id<br>";
//        echo $_SESSION['temps_form_step_id']. " temps_form_step_id<br>";
//        echo $_SESSION['temps_form_track']. " temps_form_track<br>";
            // Ссылку нам вернет подключаемый шаблон;
            $doc_download_url = '';
            $file_name = '';
            // Все глобальные переменные этого метода и $employees_array будут использоваться в подключеннмо файле документа;
            // Далее нам надо подключить щаблон файла который мы будем формировать;

            include(ROOT_PATH.'/application/templates_form/'.$doc_item.'.php');


            // проверка на существоование файла

//        echo $_SESSION['form_id'] . " form<br>";
//        echo $_SESSION['step_id'] . " step<br>";
//        echo $_SESSION['employee_id'] . " employee<br>";
//        echo $_SESSION['real_form_id']. " real_form_id<br>";
//        echo $_SESSION['temps_form_step_id']. " temps_form_step_id<br>";
//        echo $_SESSION['temps_form_track']. " temps_form_track<br>";

            if (file_exists($doc_download_url)) {
//                $result_array['form'] = "Файл $doc_download_url существует";
                $sql = "SELECT save_temp_files.id, save_temp_files.name
                    FROM save_temp_files
                    WHERE save_temp_files.employee_id = ".  $_SESSION['employee_id'] ."
                    AND save_temp_files.company_temps_id =". $_SESSION['form_id'];
                $form_content_jj = $db->row($sql);
//                echo $sql ."  -второй<br>";
                $insert_id = $form_content_jj['id'];
                // записали в историю файла
                $doc_status = 1;
                $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $insert_id ."','". $_SESSION['temps_form_track'] ."','".  $_SESSION['temps_form_step_id'] ."',NOW(),NOW(),'". $_SESSION['employee_id'] ."','". $doc_status ."');";
                $db->query($sql);

                //
                $sql = "SELECT history_forms.id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $insert_id;
                $form_content_history = $db->row($sql);
                $insert_history = $form_content_history['id'];

                $sql = "INSERT INTO `form_status_now` (`save_temps_file_id`, `history_form_id`, `track_number_form_id`,`track_form_step_now`,`author_employee_id`,`doc_status_now`) VALUES( '". $insert_id ."','". $insert_history ."','". $_SESSION['temps_form_track'] ."','".  $_SESSION['temps_form_step_id'] ."','". $_SESSION['employee_id'] ."','". $doc_status ."');";
                $db->query($sql);

            } else {
//                 $result_array['form'] = "Файл $doc_download_url не существует";
                $result_array['status'] = "no";
            }

        $form_actoin = "creater";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['page'] = "creater";
        return $result_array;
    }// create();



    private function print_file(){
        global $db;
        $sql = "SELECT *
                FROM save_temp_files, form_status_now
                WHERE save_temp_files.id = form_status_now.save_temps_file_id
                AND save_temp_files.id =" . $_SESSION['real_form_id'];

        $form_content = $db->row($sql);


//        $doc_status = $this->doc_status($_SESSION['real_form_id']);
        $doc_status = 2;// распечатан
        $this->history_insert($doc_status);

        $doc_item = $form_content['path'];
        $page = file_get_contents($doc_item);
        $page .='<div id="popup_update_select_position">
                    <div class="canvas" style="height: 120px; box-sizing: border-box;    padding-left: 65px; padding-right: 65px;">
                        <div class="popup_context_menu_title"> Документ распечатан успешно?</div>
                            <div class="button" id="popup_update_select_node_yes">Да</div>
                            <div class="button" id="popup_update_select_position_cancel">Отмена</div>
                        </div>
                    </div>
                </div>';
                $form_actoin = "print";
                $result_array['form_actoin'] = $form_actoin;
                $result_array['form_link'] = $doc_item;
        $result_array['page'] = $page;
        return $result_array;
    }// print_file();


    private function open(){
        global $db;
        $sql = "SELECT *
                FROM save_temp_files, form_status_now
                WHERE save_temp_files.id = form_status_now.save_temps_file_id
                AND save_temp_files.id =" . $_SESSION['real_form_id'];

        $form_content = $db->row($sql);


        $doc_status = $this->doc_status($_SESSION['real_form_id']);
        $this->history_insert($doc_status);

        $doc_item = $form_content['path'];
        $page = file_get_contents($doc_item);
        $page .='<div class="button" id="yes_i_read">Я ознакомился с документом</div>';
        $form_actoin = "open";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['form_link'] = $doc_item;
        $result_array['page'] = $page;

        $this->logs_form_file();
        $this->session_clear();

        return $result_array;
    }// open();

    private function download(){
        global $db;
        $sql = "SELECT *
                FROM save_temp_files, form_status_now
                WHERE save_temp_files.id = form_status_now.save_temps_file_id
                AND save_temp_files.id =" . $_SESSION['real_form_id'];

        $form_content = $db->row($sql);

        // Запись начала шага
//        $doc_status = $this->doc_status($_SESSION['real_form_id']);
        $doc_status = 5;// скачан
        $this->history_insert($doc_status);

        $doc_item = $form_content['path'];
//        $page = file_get_contents($doc_item);
        $page ='<div id="popup_update_select_position">
                    <div class="canvas" style="height: 120px; box-sizing: border-box;    padding-left: 65px; padding-right: 65px;">
                        <div class="popup_context_menu_title"> Документ скачался успешно?</div>
                            <div class="button" id="popup_update_select_node_yes">Да</div>
                            <div class="button" id="popup_update_select_position_cancel">Отмена</div>
                        </div>
                    </div>
                </div>';
        $form_actoin = "download";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['form_link'] = $doc_item;
        $result_array['page'] = $page;
        return $result_array;
    }// open();


    // запись истории и состояния файла
    private function logs_form_file(){
        global $db;

        $sql = "SELECT save_temp_files.id, save_temp_files.name
                    FROM save_temp_files
                    WHERE save_temp_files.employee_id = ".  $_SESSION['employee_id'] ."
                    AND save_temp_files.company_temps_id =". $_SESSION['form_id'];
        $form_content_jj = $db->row($sql);

        $insert_id = $form_content_jj['id'];
        $file_name =  $form_content_jj['name'];
        // записали в историю файла
        $sql = "UPDATE `history_forms` SET `step_end_time`=NOW() WHERE  `save_temps_id`=" . $_SESSION['real_form_id'];
        $db->query($sql);

        //
        $sql = "SELECT history_forms.id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $insert_id;
        $form_content_history = $db->row($sql);
        $insert_history = $form_content_history['id'];

        $sql = "UPDATE `form_status_now` SET `track_form_step_now`='" . $_SESSION['temps_form_step_id'] . "',`history_form_id`='" . $insert_history . "',`track_number_form_id`='" . $_SESSION['temps_form_track'] . "',`author_employee_id`='". $_SESSION['employee_id'] ."'  WHERE  `save_temps_file_id`=" . $_SESSION['real_form_id'];
        $db->query($sql);

    }//logs_form_file()

    public function yes(){

        $this->logs_form_file();
        $this->session_clear();
        $result_array['status'] = 'yes';
        $result = json_encode($result_array, true);
        die($result);
    }//

    // отчистка сессии
    private function session_clear(){
        $_SESSION['real_form_id'] = "";
        $_SESSION['temps_form_step_id'] = "";
        $_SESSION['temps_form_track'] = "";
    }


    // получаем статус документа
    private function doc_status($save_file_id){
        global $db;

        $sql = "SELECT form_status_now.doc_status_now AS status_id
                FROM form_status_now
                WHERE  form_status_now.save_temps_file_id = ". $save_file_id;
        $doc_status = $db->row($sql);
        return $doc_status['status_id'];
    }

    // запись о начале шага
    private function history_insert($doc_status){
        global $db;
        $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $_SESSION['real_form_id'] ."','". $_SESSION['temps_form_track'] ."','".  $_SESSION['temps_form_step_id'] ."',NOW(),'". $_SESSION['employee_id'] ."','". $doc_status ."');";
        $db->query($sql);
    }

    private function signature(){
        global $db;
        $sql = "SELECT *
                FROM save_temp_files, form_status_now
                WHERE save_temp_files.id = form_status_now.save_temps_file_id
                AND save_temp_files.id =" . $_SESSION['real_form_id'];

        $form_content = $db->row($sql);

        // Запись начала шага
        $doc_status = 3;// Подписан сотрудником
        $this->history_insert($doc_status);

        $doc_item = $form_content['path'];
        $doc_name = $form_content['name'];
   //     $page = file_get_contents($doc_item);
        $page ='<div id="popup_update_select_position">
                    <div class="canvas" style="height: 120px; box-sizing: border-box;    padding-left: 65px; padding-right: 65px;">
                        <div class="popup_context_menu_title"> Подпишите '. $doc_name .' в 417м кабинете</div>
                            <div class="row">
                                <div class="button" id="popup_update_select_node_yes">Я подписал</div>
                                <div class="button" id="popup_update_select_position_cancel">Я не подписал</div>
                            </div>
                        </div>
                    </div>
                </div>';
        $form_actoin = "signature";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['form_link'] = $doc_item;
        $result_array['page'] = $page;
        return $result_array;
    }// signature();


    private function save()
    {
        global $db;
        $sql = "SELECT *
                FROM save_temp_files, form_status_now
                WHERE save_temp_files.id = form_status_now.save_temps_file_id
                AND save_temp_files.id =" . $_SESSION['real_form_id'];

        $form_content = $db->row($sql);

        // Запись начала шага
        $doc_status = $this->doc_status($_SESSION['real_form_id']);
        $this->history_insert($doc_status);

        $doc_item = $form_content['path'];
        $page = file_get_contents($doc_item);
        $form_actoin = "save";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['page'] = "save";
        $folder_name = $_SERVER['DOCUMENT_ROOT'] . '/application/real_forms/' . md5($page . $_SESSION['real_form_id']);
        if (!is_dir($folder_name)) {
            mkdir($folder_name);

            file_put_contents($folder_name . '/real_form.doc', $page, FILE_APPEND);
            $new_path = 'application/real_forms/' . md5($page . $_SESSION['real_form_id']) . '/real_form.doc';

            // записываем новый путь к файлу
            $sql = "UPDATE `save_temp_files` SET `path`='" . $new_path . "' WHERE  `id`=" . $_SESSION['real_form_id'];

            $db->query($sql);
            $result_array['status_file'] = 'поменяли путь файлу';
            $result_array['status'] = "ok";

        }  else {
            $result_array['status_file'] = 'не поменяли путь файлу';
        }
        // дописываем историю
        $this->logs_form_file();
        $this->session_clear();
        return $result_array;
    }//save

        private function user_pass_form_end(){
            global $db;
            $sql = "SELECT *
                FROM save_temp_files, form_status_now
                WHERE save_temp_files.id = form_status_now.save_temps_file_id
                AND save_temp_files.id =" . $_SESSION['real_form_id'];

            $form_content = $db->row($sql);

            // начало функии
            $sql = "INSERT INTO `pass_test_form_history` (`employee`, `step_id`, `form_id`,`data_finish`) VALUES( '". $_SESSION['employee_id'] ."','". $_SESSION['step_id'] ."','".  $_SESSION['form_id'] ."',NOW());";
            $db->query($sql);


            $sql = "SELECT save_temp_files.id, save_temp_files.name
                    FROM save_temp_files
                    WHERE save_temp_files.employee_id = ".  $_SESSION['employee_id'] ."
                    AND save_temp_files.company_temps_id =". $_SESSION['form_id'];
            $form_content_jj = $db->row($sql);

            $insert_id = $form_content_jj['id'];
            // записали в историю файла
            $doc_status = $this->doc_status($_SESSION['real_form_id']);
            $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $insert_id ."','". $_SESSION['temps_form_track'] ."','".  $_SESSION['temps_form_step_id'] ."',NOW(),NOW(),'". $_SESSION['employee_id'] ."','". $doc_status ."');";
            $db->query($sql);

            $this->logs_form_file();
            $this->session_clear();
            $_SESSION['form_id'] = "";
            $_SESSION['step_id'] = "";

            $form_actoin = "user_pass_form_end";
            $result_array['form_actoin'] = $form_actoin;
            return $result_array;
        }// user_pass_form_end();


    private function email_alert(){
        global $db, $mailer;


        $sql = "SELECT *
                FROM save_temp_files, form_status_now
                WHERE save_temp_files.id = form_status_now.save_temps_file_id
                AND save_temp_files.id =" . $_SESSION['real_form_id'];

        $form_content = $db->row($sql);
        $doc = $form_content['name'];

        // Запись начала шага
        $doc_status = $this->doc_status($_SESSION['real_form_id']);
        $this->history_insert($doc_status);

        $subject = "Уведомление";
        $mail_type = "email_alert";
        // запрашиваем шаблон письма
        $sql="Select *
                  FROM mail_template
                  WHERE mail_template.company_id =". $_SESSION['control_company'] ."
                  AND mail_template.mail_type = '".$mail_type ."'";
        $email_temp = $db->row($sql);

        // данные для логов
        $template_mail_id = $email_temp['id'];

        //тело письма
        $message = $email_temp['template_name'];
        $message = str_replace('%doc%', $doc, $message);

        // получаем почту сотрудника
        $sql="SELECT *
                FROM employees
                WHERE employees.id=".$_SESSION['employee_id'];
        $emails = $db->row($sql);
        $email = $emails['email'];


//        // отправка письма:
//        $mailer = new PHPMailer;
////будем отравлять письмо через СМТП сервер
//        $mailer->isSMTP();
////хост
//        $mailer->Host = 'smtp.yandex.ru';
////требует ли СМТП сервер авторизацию/идентификацию
//        $mailer->SMTPAuth = true;
//// логин от вашей почты
//        $mailer->Username = 'noreply';
//// пароль от почтового ящика
//        $mailer->Password = 'asd8#fIw2)l45Ab@!4Sa3';
////указываем способ шифромания сервера
//        $mailer->SMTPSecure = 'ssl';
////указываем порт СМТП сервера
//        $mailer->Port = '465';
////указываем кодировку для письма
//        $mailer->CharSet = 'UTF-8';
//информация от кого отправлено письмо


        $mailer->From = 'noreply@laborpro.ru';
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
                                          VALUES("' .  $_SESSION['employee_id'] .
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
                                          VALUES("' .  $_SESSION['employee_id'] .
                '","' . $email .
                '","' . $mail_type .
                '","' . $template_mail_id .
                '","' . $send_result .
                '",NOW())';
            $db->query($sql);
        }

        $form_actoin = "email_alert";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['page'] = "email_alert";
        // дописываем историю
        $this->logs_form_file();
        $this->session_clear();
        return $result_array;
    }// email_alert();


    private function local_alert(){
        global $db;

        $sql = "SELECT *
                FROM save_temp_files, form_status_now
                WHERE save_temp_files.id = form_status_now.save_temps_file_id
                AND save_temp_files.id =" . $_SESSION['real_form_id'];
        $form_content = $db->row($sql);
        $doc = $form_content['name'];

        // Запись начала шага
//        $doc_status = $this->doc_status($_SESSION['real_form_id']);
        $doc_status = 4;// Требуется подписать сотрудника
        $this->history_insert($doc_status);

        // запись
        $cron_action_type_id = 3;
        $observer_org_str_id = 27;
        $sql = "INSERT INTO `local_alerts` (`initiator_employee_id`, `observer_org_str_id`, `cron_action_type_id`,`company_id`,`save_temp_files_id`,`step_id`,`date_create`)
                                       VALUES( '" .  $_SESSION['employee_id'] .
                                            "','" . $observer_org_str_id .
                                            "','" . $cron_action_type_id .
                                            "','" . $_SESSION['control_company'] .
                                            "','" . $_SESSION['real_form_id'] .
                                            "','" . $_SESSION['step_id'] .
                                            "',NOW());";
        $db->query($sql);


        $form_actoin = "local_alert";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['page'] = "local_alert";
        // дописываем историю
        $this->logs_form_file();
        $this->session_clear();
        return $result_array;
    }// local_alert();
// экшен для внешних файлов
    private function la_signature(){
        global $db;

        $la_real_form_id = $this->post_array['la_real_form_id'];
        $la_employee = $this->post_array['la_employee'];
        $observer_em = $this->post_array['observer_em'];
        $local_id = $this->post_array['local_id'];

        $doc_status = 3;// документ подписал

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
}
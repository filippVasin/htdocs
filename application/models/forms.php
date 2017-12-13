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

//        print_r($_SESSION);

        $sql = "SELECT  MAX(history_forms.`step_end_time`) AS date_create_old, periodicity,
                (MAX(history_forms.`step_end_time`) + INTERVAL route_control_step.periodicity MONTH) AS date_create_new,
					CASE
                   WHEN (now() <= (MAX(history_forms.`step_end_time`) + INTERVAL route_control_step.periodicity MONTH)) OR (MAX(history_forms.`step_end_time`) AND (route_control_step.periodicity is NUll))
                  THEN save_temp_files.id
                  ELSE NULL
                  END AS real_form_id
                FROM save_temp_files,history_forms,route_control_step
                WHERE save_temp_files.employee_id = " . $_SESSION['employee_id'] . "
                    AND save_temp_files.company_temps_id = " . $_SESSION['form_id'] . "
                    AND route_control_step.`id`= ". $_SESSION['step_id']."
                    AND save_temp_files.id = history_forms.save_temps_id
                    AND history_forms.step_end_time=(SELECT  MAX(step_end_time)
												     FROM save_temp_files,history_forms,route_control_step
												     WHERE save_temp_files.employee_id = " . $_SESSION['employee_id'] . "
                                                            AND save_temp_files.company_temps_id = " . $_SESSION['form_id'] . "
                                                            AND route_control_step.`id`= ". $_SESSION['step_id'] . "
                                                            AND save_temp_files.id = history_forms.save_temps_id )";

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
//                echo $sql;
                $condition_form = $db->row($sql);


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

                $action_forms = $db->row($sql);
                // получили следующий шаг и экшон;
                $action_name = $action_forms['action_name'];
                $_SESSION['temps_form_step_id'] = $action_forms['next_step'];
                $_SESSION['temps_form_track'] = $action_forms['temps_form_track'];

            }
        // выбираем соответствующий экшон и вызываем его
//        echo $action_name;
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
            case "secretary_signature_alert":
                $result_array = $this->secretary_signature_alert();
                break;
            case "push_email":
                $result_array = $this->push_email();
                break;
            case "signature":
                $result_array = $this->signature();
                break;
            case "secretary_get_doc_alert":
                $result_array = $this->secretary_get_doc_alert();
                break;
            case "signature_accept":
                $result_array = $this->signature_accept();
                break;
            case "bailee_alert":
                $result_array = $this->bailee_alert();
                break;
            case "probation_alert":
                $result_array = $this->probation_alert();
                break;
            case "order_for_an_internship":
                $result_array = $this->order_for_an_internship();
                break;
        }

        // Отправили зезультат
        return json_encode($result_array);
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
        $company_id = $_SESSION['control_company'];
        $employee_id = $_SESSION['employee_id'];
        $flag = "";
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
                $sql = "SELECT max(save_temp_files.id) AS id, save_temp_files.name
                    FROM save_temp_files
                    WHERE save_temp_files.employee_id = ".  $_SESSION['employee_id'] ."
                    AND save_temp_files.company_temps_id =". $_SESSION['form_id'];
                $form_content_jj = $db->row($sql);
//                echo $sql ."  -второй<br>";
                $insert_id = $form_content_jj   ['id'];
                // записали в историю файла
                $doc_status = 1;
                $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`, `step_end_time`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES( '". $insert_id ."','". $_SESSION['temps_form_track'] ."','".  $_SESSION['temps_form_step_id'] ."',NOW(),NOW(),'". $_SESSION['employee_id'] ."','". $doc_status ."');";
                $db->query($sql);
//                echo $sql ."  - третий<br>";

                //
                $sql = "SELECT max(history_forms.id) as id
                    FROM history_forms
                    WHERE history_forms.save_temps_id =". $insert_id;
                $form_content_history = $db->row($sql);
                $insert_history = $form_content_history['id'];

                $sql = "INSERT INTO `form_status_now` (`step_id`,`save_temps_file_id`, `history_form_id`, `track_number_form_id`,`track_form_step_now`,`author_employee_id`,`doc_status_now`) VALUES('". $_SESSION['step_id']."','". $insert_id ."','". $insert_history ."','". $_SESSION['temps_form_track'] ."','".  $_SESSION['temps_form_step_id'] ."','". $_SESSION['employee_id'] ."','". $doc_status ."');";
                $db->query($sql);
//                echo $sql ."  - третий<br>";
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
                            <div class="button" style="width: 180px;" id="popup_update_select_node_yes">Да</div>
                            <div class="button" style="width: 180px;" id="popup_update_select_position_cancel">Отмена</div>
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
                            <div class="button" style="min-width: 180px;" id="popup_update_select_node_yes">Да</div>
                            <div class="button" style="min-width: 180px;" id="popup_update_select_position_cancel">Отмена</div>
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
        // Отправили зезультат
        return json_encode($result_array);
    }//

    // отчистка сессии
    private function session_clear(){
        unset($_SESSION['real_form_id']);
        unset($_SESSION['temps_form_step_id']);
        unset($_SESSION['temps_form_track']);
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
        $sql = "INSERT INTO `history_forms` (`save_temps_id`, `track_form_id`, `track_form_step`,`start_data`,`author_employee_id`,`doc_status_now`) VALUES('". $_SESSION['real_form_id'] ."','". $_SESSION['temps_form_track'] ."','".  $_SESSION['temps_form_step_id'] ."',NOW(),'". $_SESSION['employee_id'] ."','". $doc_status ."');";
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

        $table = "";

        if($doc_name == "№3 Журнал инструктажа по пожарной безопасности"){
            $table = $this->table_number_five();
        }
        if($doc_name == "№4 Журнал присвоения I гр по электробезопасности"){
            $table = $this->table_number_three();
        }

        if($doc_name == "№2 Журнал инструктажа на раб месте"){
            $table = $this->table_number_two();
        }

        if($doc_name == "№1 Журнал вводного инструктажа"){
            $table = $this->table_number_one();
        }
        if($doc_name == "№5 Журнал по безопасности дорожного движения"){
            $table = $this->table_number_four();
        }





        $page ='<div id="popup_update_select_position">
                    <div class="canvas" style=" box-sizing: border-box;    padding-left: 65px; padding-right: 65px;">
                        <div class="popup_context_menu_title"> Подпишите '. $doc_name .'</div>
                        '. $table .'
                            <div class="row" style="display: flex; justify-content: center;">
                                <div class="button" style="width: 180px;margin-bottom: 10px;" id="popup_update_select_node_yes">Я подписал</div>
                                <div class="button" style="width: 180px;margin-bottom: 10px;" id="popup_update_select_position_cancel">Я не подписал</div>
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


    private function table_number_five(){
        global $db;
        $today = date("Y-m-d H:i:s");

        $sql="SELECT * FROM company WHERE company.id=". $_SESSION['control_company'];
        $comp = $db->row($sql);
        $company = $comp['name'];

        $sql = "SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio, items_control.name AS dol,
        employees.birthday, drivers_license.category,drivers_license.license_number
        FROM employees,employees_items_node,organization_structure,items_control, drivers_license
        WHERE employees.id = ". $_SESSION['employee_id'] ."
        AND employees.id = employees_items_node.employe_id
        AND organization_structure.id = employees_items_node.org_str_id
        AND organization_structure.kladr_id = items_control.id
        AND employees.id = drivers_license.emp_id
        AND organization_structure.company_id =". $_SESSION['control_company'];

        $sql = "SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio, items_control.name AS dol,
        employees.birthday, drivers_license.category,drivers_license.license_number
        FROM (employees,employees_items_node,organization_structure,items_control)
        LEFT JOIN drivers_license ON  drivers_license.emp_id = employees.id
        WHERE employees.id = ". $_SESSION['employee_id'] ."
        AND employees.id = employees_items_node.employe_id
        AND organization_structure.id = employees_items_node.org_str_id
        AND organization_structure.kladr_id = items_control.id
        AND organization_structure.company_id =". $_SESSION['control_company'];
        $employees = $db->row($sql);
        $fio = $employees['fio'];
        $fioFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $fio);
        $dol = $employees['dol'];
        $birthday = date_create($employees['birthday'])->Format('d-m-Y');
        $category = $employees['category'];
        $license_number = $employees['license_number'];
        $day = date("d-m-Y", strtotime("+14 days"));
        $day_now = date("d-m-Y");
// получаем ответственного по инструктажам
        $sql = "SELECT ORG_chief.id,ORG_boss.boss_type,chief_employees.surname, ORG_boss.`level` as level,
chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
	chief_items_control.name AS chief_dol
FROM (organization_structure, employees_items_node)
LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
																	AND
																  ORG_chief.right_key > organization_structure.right_key
																  AND
																  ORG_chief.company_id = ". $_SESSION['control_company'] ." )
		LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = ". $_SESSION['control_company'] ."
																		AND ORG_boss.left_key > ORG_chief.left_key
																		AND ORG_boss.right_key < ORG_chief.right_key
																		AND 	ORG_boss.`level` = (ORG_chief.`level` +1)
																		AND ORG_boss.boss_type > 1
																			)
		LEFT JOIN employees_items_node AS chief_node ON chief_node.org_str_id = ORG_boss.id
		LEFT JOIN employees AS chief_employees ON chief_employees.id = chief_node.employe_id
		LEFT JOIN items_control AS  chief_items_control ON chief_items_control.id = ORG_boss.kladr_id

WHERE employees_items_node.employe_id = ". $_SESSION['employee_id'] ."
AND organization_structure.id = employees_items_node.org_str_id
AND organization_structure.company_id = ". $_SESSION['control_company']."
AND chief_employees.id is not NULL
ORDER BY level DESC, boss_type DESC
LIMIT 1";
        $boss = $db->row($sql);

        $chief = $boss['chief_surname']." ". $boss['chief_name'] ." ". $boss['chief_second_name'];
        $chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
        $chief_dol = $boss['chief_dol'];


        $table = '<TABLE WIDTH=986 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=62>
	<COL WIDTH=214>
	<COL WIDTH=157>
	<COL WIDTH=156>
	<COL WIDTH=156>
	<COL WIDTH=157>
	<TR VALIGN=TOP>
		<TD WIDTH=62 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>Дата</FONT></P>
		</TD>
		<TD WIDTH=214 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Вид</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>инструктажа</FONT></P>
		</TD>
		<TD WIDTH=157 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Ф.И.О.,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>должность лица,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>проводившего
			инструктаж</FONT></P>
		</TD>
		<TD WIDTH=156 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Ф.И.О.</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>водителя,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>прошедшего
			инструктаж</FONT></P>
		</TD>
		<TD WIDTH=156 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Подпись водителя,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>прошедшего</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>инструктаж</FONT></P>
		</TD>
		<TD WIDTH=157 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Подпись лица,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>проводившего</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>инструктаж</FONT></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=62 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>'. $day_now .'</FONT></P>
		</TD>
		<TD WIDTH=214 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>Первичный</FONT></P>
		</TD>
		<TD WIDTH=157 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>'.$chiefFIO .', '. $chief_dol .'</FONT></P>
		</TD>
		<TD WIDTH=156 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>'. $fio .'</FONT></P>
		</TD>
		<TD WIDTH=156 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2><span class="red">Подписать тут</span></FONT></P>
		</TD>
		<TD WIDTH=157 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2></FONT></P>
		</TD>
	</TR>
	</TABLE>';

        return $table;
    }

    private function table_number_four()
    {
        global $db;

        $today = date("Y-m-d H:i:s");

        $sql="SELECT * FROM company WHERE company.id=". $_SESSION['control_company'];
        $comp = $db->row($sql);
        $company = $comp['name'];

        $sql = "SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio, items_control.name AS dol,
        employees.birthday, drivers_license.category,drivers_license.license_number
        FROM employees,employees_items_node,organization_structure,items_control, drivers_license
        WHERE employees.id = ". $_SESSION['employee_id'] ."
        AND employees.id = employees_items_node.employe_id
        AND organization_structure.id = employees_items_node.org_str_id
        AND organization_structure.kladr_id = items_control.id
        AND employees.id = drivers_license.emp_id
        AND organization_structure.company_id =". $_SESSION['control_company'];

        $sql = "SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio, items_control.name AS dol,
        employees.birthday, drivers_license.category,drivers_license.license_number
        FROM (employees,employees_items_node,organization_structure,items_control)
        LEFT JOIN drivers_license ON  drivers_license.emp_id = employees.id
        WHERE employees.id = ". $_SESSION['employee_id'] ."
        AND employees.id = employees_items_node.employe_id
        AND organization_structure.id = employees_items_node.org_str_id
        AND organization_structure.kladr_id = items_control.id
        AND organization_structure.company_id =". $_SESSION['control_company'];
        $employees = $db->row($sql);
        $fio = $employees['fio'];
        $fioFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $fio);
        $dol = $employees['dol'];
        $birthday = date_create($employees['birthday'])->Format('d-m-Y');
        $category = $employees['category'];
        $license_number = $employees['license_number'];
        $day = date("d-m-Y", strtotime("+14 days"));
        $day_now = date("d-m-Y");
// получаем ответственного по инструктажам
        $sql = "SELECT ORG_chief.id,ORG_boss.boss_type,chief_employees.surname, ORG_boss.`level` as level,
chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
	chief_items_control.name AS chief_dol
FROM (organization_structure, employees_items_node)
LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
																	AND
																  ORG_chief.right_key > organization_structure.right_key
																  AND
																  ORG_chief.company_id = ". $_SESSION['control_company'] ." )
		LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = ". $_SESSION['control_company'] ."
																		AND ORG_boss.left_key > ORG_chief.left_key
																		AND ORG_boss.right_key < ORG_chief.right_key
																		AND 	ORG_boss.`level` = (ORG_chief.`level` +1)
																		AND ORG_boss.boss_type > 1
																			)
		LEFT JOIN employees_items_node AS chief_node ON chief_node.org_str_id = ORG_boss.id
		LEFT JOIN employees AS chief_employees ON chief_employees.id = chief_node.employe_id
		LEFT JOIN items_control AS  chief_items_control ON chief_items_control.id = ORG_boss.kladr_id

WHERE employees_items_node.employe_id = ". $_SESSION['employee_id'] ."
AND organization_structure.id = employees_items_node.org_str_id
AND organization_structure.company_id = ". $_SESSION['control_company']."
AND chief_employees.id is not NULL
ORDER BY level DESC, boss_type DESC
LIMIT 1";
        $boss = $db->row($sql);

        $chief = $boss['chief_surname']." ". $boss['chief_name'] ." ". $boss['chief_second_name'];
        $chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
        $chief_dol = $boss['chief_dol'];


        $table = '<TABLE WIDTH=986 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=62>
	<COL WIDTH=214>
	<COL WIDTH=157>
	<COL WIDTH=156>
	<COL WIDTH=156>
	<COL WIDTH=157>
	<TR VALIGN=TOP>
		<TD WIDTH=62 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>Дата</FONT></P>
		</TD>
		<TD WIDTH=214 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Вид</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>инструктажа</FONT></P>
		</TD>
		<TD WIDTH=157 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Ф.И.О.,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>должность лица,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>проводившего
			инструктаж</FONT></P>
		</TD>
		<TD WIDTH=156 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Ф.И.О.</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>водителя,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>прошедшего
			инструктаж</FONT></P>
		</TD>
		<TD WIDTH=156 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Подпись водителя,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>прошедшего</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>инструктаж</FONT></P>
		</TD>
		<TD WIDTH=157 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>Подпись лица,</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
			<FONT SIZE=2>проводившего</FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>инструктаж</FONT></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=62 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>'. $day_now .'</FONT></P>
		</TD>
		<TD WIDTH=214 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>Первичный</FONT></P>
		</TD>
		<TD WIDTH=157 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>'.$chiefFIO .', '. $chief_dol .'</FONT></P>
		</TD>
		<TD WIDTH=156 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2>'. $fio .'</FONT></P>
		</TD>
		<TD WIDTH=156 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2><span class="red">Подписать тут</span></FONT></P>
		</TD>
		<TD WIDTH=157 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER><FONT SIZE=2></FONT></P>
		</TD>
	</TR>
	</TABLE>';
        return $table;
    }


    private function table_number_three(){
        global $db;

        $sql = "SELECT
	FIO.id,FIO.birthday AS birthday,
	CONCAT_WS (' ', FIO.surname, FIO.name, FIO.second_name) AS 'FIO',
	CONCAT_WS (':', ITEMCONTROL2.name, ITEM2.name) AS 'OTDEl',
	ITEM1.name AS 'DOLGNOST',
	company.name
FROM
		employees AS FIO
	LEFT JOIN
		employees_items_node
		ON
		FIO.id = employees_items_node.employe_id
	LEFT JOIN
		organization_structure AS ORG1
		ON
		ORG1.id = employees_items_node.org_str_id
	LEFT JOIN
		organization_structure AS ORG2
		ON
        (
            ORG1.`left_key` > ORG2.`left_key`
            AND
            ORG1.`right_key` < ORG2.`right_key`
            AND
            (ORG1.`level`-1)= ORG2.`level`
        )

	INNER JOIN
		items_control AS ITEM1
		ON
		ITEM1.id = ORG1.kladr_id
	INNER JOIN
		items_control_types AS ITEMCONTROL1
		ON
		ITEMCONTROL1.id = ITEM1.type_id
	INNER JOIN
		items_control AS ITEM2
		ON
		ITEM2.id = ORG2.kladr_id
	INNER JOIN
		items_control_types AS ITEMCONTROL2
		ON
		ITEMCONTROL2.id = ITEM2.type_id
		LEFT JOIN company ON company.id = ORG1.company_id




WHERE
FIO.id = ". $_SESSION['employee_id'] ."
AND ORG2.company_id = ". $_SESSION['control_company'] ."

ORDER BY
	FIO.id";


//echo $sql;
        $employees = $db->row($sql);
        $table_line = '';



//print_r($employees);
        $company_name = $employees['name'];
        $today = date("Y-m-d H:i:s");


        $fio = $employees['FIO'];
        $dir = $employees['OTDEl'];
        $dol = $employees['DOLGNOST'];
        $yesr = date("Y", strtotime($employees['birthday']));
// дата присвоения
        $appropriation_day = date("d-m-Y");



// получаем ответственного по инструктажам
        $sql = "SELECT ORG_chief.id,ORG_boss.boss_type,chief_employees.surname, ORG_boss.`level` as level,
chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
	chief_items_control.name AS chief_dol
FROM (organization_structure, employees_items_node)
LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
																	AND
																  ORG_chief.right_key > organization_structure.right_key
																  AND
																  ORG_chief.company_id = ". $_SESSION['control_company'] ." )
		LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = ". $_SESSION['control_company'] ."
																		AND ORG_boss.left_key > ORG_chief.left_key
																		AND ORG_boss.right_key < ORG_chief.right_key
																		AND 	ORG_boss.`level` = (ORG_chief.`level` +1)
																		AND ORG_boss.boss_type > 1
																			)
		LEFT JOIN employees_items_node AS chief_node ON chief_node.org_str_id = ORG_boss.id
		LEFT JOIN employees AS chief_employees ON chief_employees.id = chief_node.employe_id
		LEFT JOIN items_control AS  chief_items_control ON chief_items_control.id = ORG_boss.kladr_id

WHERE employees_items_node.employe_id = ". $_SESSION['employee_id'] ."
AND organization_structure.id = employees_items_node.org_str_id
AND organization_structure.company_id = ". $_SESSION['control_company'] ."
AND chief_employees.id is not NULL
ORDER BY level DESC, boss_type DESC
LIMIT 1";
        $boss = $db->row($sql);

        $chief = $boss['chief_surname']." ". $boss['chief_name'] ." ". $boss['chief_second_name'];
        $chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
        $chief_dol = $boss['chief_dol'];

        $table ='<TABLE WIDTH=1001 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=93>
	<COL WIDTH=158>
	<COL WIDTH=63>
	<COL WIDTH=126>
	<COL WIDTH=133>
	<COL WIDTH=168>
	<COL WIDTH=72>
	<COL WIDTH=74>
	<TR>
		<TD ROWSPAN=2 WIDTH=33 HEIGHT=15 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1.50pt solid #000000; border-left: 1.50pt solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in"><BR>
			</P>
			<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Дата</FONT></FONT></P>
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">инструктажа</FONT></FONT></P>
		</TD>
		<TD ROWSPAN=2 WIDTH=178 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1.50pt solid #000000; border-left: 1.50pt solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Фамилия,
			имя, </FONT></FONT>
			</P>
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">отчество
			инструктируемого</FONT></FONT></P>
		</TD>
		<TD ROWSPAN=2 WIDTH=63 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1.50pt solid #000000; border-left: 1.50pt solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in"><BR>
			</P>
			<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Год
			</FONT></FONT>
			</P>
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">рождения</FONT></FONT></P>
		</TD>
		<TD ROWSPAN=2 WIDTH=136 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1.50pt solid #000000; border-left: 1.50pt solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Профессия,
			должность </FONT></FONT>
			</P>
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Courier New, monospace"><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">инструктируемого</FONT></FONT></FONT></P>
		</TD>
		<TD ROWSPAN=2 WIDTH=143 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1.50pt solid #000000; border-left: 1.50pt solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Наименование
			</FONT></FONT>
			</P>
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Courier New, monospace"><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">производственного
			подразделения, в которое направляется
			инструктируемый</FONT></FONT></FONT></P>
		</TD>
		<TD ROWSPAN=2 WIDTH=178 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1.50pt solid #000000; border-left: 1.50pt solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Фамилия,
			инициалы, </FONT></FONT>
			</P>
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">должность
			инструктирующего</FONT></FONT></P>

		</TD>
		<TD COLSPAN=2 WIDTH=170 STYLE="border: 1.50pt solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Подпись</FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=82 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1.50pt solid #000000; border-left: 1.50pt solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Инструктирующего</FONT></FONT></P>
		</TD>
		<TD WIDTH=74 STYLE="border: 1.50pt solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" ALIGN=CENTER><FONT FACE="Times New Roman, serif"><FONT SIZE=1 STYLE="font-size: 8pt">Инструктируемого
			</FONT></FONT>
			</P>
		</TD>
	</TR><TR>
		<TD WIDTH=33 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			'. $appropriation_day .'
			</P>
		</TD>
		<TD WIDTH=178 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			'. $fio .'
			</P>
		</TD>
		<TD WIDTH=63 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER><BR>
			'. $yesr .'
			</P>
		</TD>
		<TD WIDTH=136 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER><BR>
			'. $dol .'
			</P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER><BR>
			'. $dir .'
			</P>
		</TD>
		<TD WIDTH=178 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER><BR>
			'.$chiefFIO .'
			<br>
			'.$chief_dol .'
			</P>
		</TD>
		<TD WIDTH=82 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" ALIGN=CENTER><BR>

			</P>
		</TD>
		<TD WIDTH=74 STYLE="border-top: 1.50pt solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" ALIGN=CENTER><BR>
			<span class="red">Подписать тут</span>
			</P>
		</TD>
	</TR>
</TABLE> ';
        return $table;
    }

    private function table_number_one(){
        global $db;
        $sql = "SELECT
	FIO.id,
	CONCAT_WS (' ', FIO.surname, FIO.name, FIO.second_name) AS 'FIO',
	CONCAT_WS (':', ITEMCONTROL2.name, ITEM2.name) AS 'OTDEl',
	CONCAT_WS (':', ITEMCONTROL1.name, ITEM1.name) AS 'DOLGNOST',
	FIO.birthday

FROM
		employees AS FIO
	LEFT JOIN
		employees_items_node
		ON
		FIO.id = employees_items_node.employe_id
	LEFT JOIN
		organization_structure AS ORG1
		ON
		ORG1.id = employees_items_node.org_str_id
	LEFT JOIN
		organization_structure AS ORG2
		ON
        (
            ORG1.`left_key` > ORG2.`left_key`
            AND
            ORG1.`right_key` < ORG2.`right_key`
            AND
            (ORG1.`level`-1)= ORG2.`level`
        )

	INNER JOIN
		items_control AS ITEM1
		ON
		ITEM1.id = ORG1.kladr_id
	INNER JOIN
		items_control_types AS ITEMCONTROL1
		ON
		ITEMCONTROL1.id = ITEM1.type_id
	INNER JOIN
		items_control AS ITEM2
		ON
		ITEM2.id = ORG2.kladr_id
	INNER JOIN
		items_control_types AS ITEMCONTROL2
		ON
		ITEMCONTROL2.id = ITEM2.type_id
WHERE
	FIO.id = ".$_SESSION['employee_id']."
AND
    ORG2.company_id = ".$_SESSION['control_company']."
ORDER BY
	FIO.id";



//echo $sql;
        $employees = $db->all($sql);
        $table_line = '';
//print_r($employees);
        $company_name = '';
        $today = date("Y-m-d H:i:s");
        foreach($employees as $employee){

            $company_name = $_SESSION['control_company_name'];
            $table_line .= '
                    <tr>
                    <td width="48">
                    ' . date('d.m.Y') . '
                    </td>
                    <td width="192">
                    ' . $employee['FIO'] . '
                    </td>
                    <td width="77">
                        ' . $employee['birthday'] . '
                    </td>
                    <td width="150">
                    ' . str_replace('Должность:', "", $employee['DOLGNOST']) . '
                    </td>
                    <td width="157">
                    ' . $employee['OTDEl'] . '
                    </td>
                    <td width="192">
                    <p>&nbsp;</p>
                    </td>
                    <td width="96">
                    <p>&nbsp;</p>
                    </td>
                    <td width="87">
                    <p>&nbsp;<span class="red">Подписать тут</span></p>
                    </td>
                </tr>
    ';

        }
        $table = '<table style="font-size: 8pt;border-color: black; text-align: center;" border="1" width="999" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td rowspan="2" width="48">
                        Дата инструктажа
                    </td>
                    <td rowspan="2" width="192">
                        Фамилия, имя, отчество инструктируемого
                    </td>
                    <td rowspan="2" width="77">
                        Год рождения
                    </td>
                    <td rowspan="2" width="150">
                        Профессия, должность инструктируемого
                    </td>
                    <td rowspan="2" width="157">
                        Наименование производственного подразделения, в которое направляется инструктируемый
                    </td>
                    <td rowspan="2" width="192">
                        Фамилия, инициалы, должность инструктирующего
                    </td>
                    <td colspan="2" width="183">
                        Подпись
                    </td>
                </tr>
                <tr>
                    <td width="96">
                        Инструктирующего
                    </td>
                    <td width="87">
                        Инструктируемого
                    </td>
                </tr>

                <tr>
                    <td width="48">
                        <b>1</b>
                    </td>
                    <td width="192">
                        <b>2</b>
                    </td>
                    <td width="77">
                        <b>3</b>
                    </td>
                    <td width="150">
                        <b>4</b>
                    </td>
                    <td width="157">
                        <b>5</b>
                    </td>
                    <td width="192">
                        <b>6</b>
                    </td>
                    <td width="96">
                        <b>7</b>
                    </td>
                    <td width="87">
                        <b>8</b>
                    </td>
                </tr>

               '.$table_line.'

                </tbody>
                </table>';

        return $table;
    }


    private function table_number_two(){
        global $db;


        $sql = "SELECT
	FIO.id,FIO.birthday AS birthday,
	CONCAT_WS (' ', FIO.surname, FIO.name, FIO.second_name) AS 'FIO',
	CONCAT_WS (':', ITEMCONTROL2.name, ITEM2.name) AS 'OTDEl',
	ITEM1.name AS 'DOLGNOST',
	company.name
FROM
		employees AS FIO
	LEFT JOIN
		employees_items_node
		ON
		FIO.id = employees_items_node.employe_id
	LEFT JOIN
		organization_structure AS ORG1
		ON
		ORG1.id = employees_items_node.org_str_id
	LEFT JOIN
		organization_structure AS ORG2
		ON
        (
            ORG1.`left_key` > ORG2.`left_key`
            AND
            ORG1.`right_key` < ORG2.`right_key`
            AND
            (ORG1.`level`-1)= ORG2.`level`
        )

	INNER JOIN
		items_control AS ITEM1
		ON
		ITEM1.id = ORG1.kladr_id
	INNER JOIN
		items_control_types AS ITEMCONTROL1
		ON
		ITEMCONTROL1.id = ITEM1.type_id
	INNER JOIN
		items_control AS ITEM2
		ON
		ITEM2.id = ORG2.kladr_id
	INNER JOIN
		items_control_types AS ITEMCONTROL2
		ON
		ITEMCONTROL2.id = ITEM2.type_id
		LEFT JOIN company ON company.id = ORG1.company_id




WHERE
FIO.id =". $_SESSION['employee_id'] ."
AND ORG2.company_id = ". $_SESSION['control_company'] ."

ORDER BY
	FIO.id";


//echo $sql;
        $employees = $db->row($sql);
        $table_line = '';



//print_r($employees);
        $company_name = $employees['name'];
        $today = date("Y-m-d H:i:s");


        $fio = $employees['FIO'];
        $dir = $employees['OTDEl'];
        $dol = $employees['DOLGNOST'];
        $yesr = date("Y", strtotime($employees['birthday']));
// дата присвоения
        $appropriation_day = date("d.m.Y");
        $s_po = $appropriation_day. " ". date('d.m.Y',strtotime( $appropriation_day.'+14 day'));


// получаем ответственного по инструктажам
        $sql = "SELECT ORG_chief.id,ORG_boss.boss_type,chief_employees.surname, ORG_boss.`level` as level,
chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
	chief_items_control.name AS chief_dol
FROM (organization_structure, employees_items_node)
LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
																	AND
																  ORG_chief.right_key > organization_structure.right_key
																  AND
																  ORG_chief.company_id = ". $_SESSION['control_company'] ." )
		LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = ". $_SESSION['control_company'] ."
																		AND ORG_boss.left_key > ORG_chief.left_key
																		AND ORG_boss.right_key < ORG_chief.right_key
																		AND 	ORG_boss.`level` = (ORG_chief.`level` +1)
																		AND ORG_boss.boss_type > 1
																			)
		LEFT JOIN employees_items_node AS chief_node ON chief_node.org_str_id = ORG_boss.id
		LEFT JOIN employees AS chief_employees ON chief_employees.id = chief_node.employe_id
		LEFT JOIN items_control AS  chief_items_control ON chief_items_control.id = ORG_boss.kladr_id

WHERE employees_items_node.employe_id = ". $_SESSION['employee_id'] ."
AND organization_structure.id = employees_items_node.org_str_id
AND organization_structure.company_id = ". $_SESSION['control_company'] ."
AND chief_employees.id is not NULL
ORDER BY level DESC, boss_type DESC
LIMIT 1";
        $boss = $db->row($sql);

        $chief = $boss['chief_surname']." ". $boss['chief_name'] ." ". $boss['chief_second_name'];
        $chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
        $chief_dol = $boss['chief_dol'];

        $table = '<TABLE WIDTH=976 CELLPADDING=2 CELLSPACING=0>
	<COL WIDTH=94>
	<COL WIDTH=165>
	<COL WIDTH=69>
	<COL WIDTH=180>
	<COL WIDTH=217>
	<COL WIDTH=113>
	<COL WIDTH=107>
	<COL WIDTH=113>
	<COL WIDTH=107>
	<COL WIDTH=113>
	<THEAD>
		<TR VALIGN=TOP>
			<TD ROWSPAN=2 WIDTH=44 HEIGHT=27 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.02in; padding-right: 0in">
        <P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Дата</FONT></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=165 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Фамилия, имя,
				отчество инструктируемого</FONT></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=69 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Год рождения</FONT></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=180 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Профессия, должность
				инструктируемого</FONT></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=180 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Вид инструктажа</FONT></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=267 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Фамилия, инициалы,
				должность инструктирующего, допускающего</FONT></P>
			</TD>
			<TD COLSPAN=2 WIDTH=224 STYLE="border: 1px solid #000000; padding: 0.04in 0.02in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Подпись</FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=224 STYLE="border: 1px solid #000000; padding: 0.04in 0.02in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">стажировка на рабочем месте</FONT></P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=113 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Инструктирующего</FONT></P>
			</TD>
			<TD WIDTH=107 STYLE="border: 1px solid #000000; padding: 0.04in 0.02in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Инструктируемого</FONT></P>
			</TD>

			<TD WIDTH=113 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">кол-во смен (с)_(по)</FONT></P>
			</TD>
			<TD WIDTH=107 STYLE="border: 1px solid #000000; padding: 0.04in 0.02in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Стажровку прошел, подпись работника</FONT></P>
			</TD>
			<TD WIDTH=107 STYLE="border: 1px solid #000000; padding: 0.04in 0.02in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
				<FONT FACE="Times New Roman, serif">Знания проверил, работника отпустил</FONT></P>
			</TD>
		</TR>

	</THEAD>
	<THEAD>
		<TR VALIGN=TOP>
			<TD WIDTH=44 HEIGHT=10 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">

				<FONT FACE="Times New Roman, serif">'. $appropriation_day .'</FONT></P>
			</TD>
			<TD WIDTH=165 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">

				<FONT FACE="Times New Roman, serif">'. $fio .'</FONT></P>
			</TD>
			<TD WIDTH=69 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">

				<FONT FACE="Times New Roman, serif">'. $yesr .'</FONT></P>
			</TD>
			<TD WIDTH=180 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">

				<FONT FACE="Times New Roman, serif">'. $dol .'</FONT></P>
			</TD>
			<TD WIDTH=180 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">

				<FONT FACE="Times New Roman, serif">Первичный</FONT></P>
			</TD>
			<TD WIDTH=267 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">

				<FONT FACE="Times New Roman, serif">
            '.$chiefFIO .'
                    <br>
        '.$chief_dol .'</FONT></P>
			</TD>
			<TD WIDTH=113 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">

				<FONT FACE="Times New Roman, serif"></FONT></P>
			</TD>
			<TD WIDTH=107 STYLE="border: 1px solid #000000; padding: 0.04in 0.02in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
                        <span class="red">Подписать тут</span>
				<FONT FACE="Times New Roman, serif"></FONT></P>
			</TD>
			<TD WIDTH=113 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0.04in; padding-bottom: 0.04in; padding-left: 0.02in; padding-right: 0in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
                            '. $s_po .'
				<FONT FACE="Times New Roman, serif"></FONT></P>
			</TD>
			<TD WIDTH=107 STYLE="border: 1px solid #000000; padding: 0.04in 0.02in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">
                        <span class="red">Подписать тут</span>
				<FONT FACE="Times New Roman, serif"></FONT></P>
			</TD>
			<TD WIDTH=107 STYLE="border: 1px solid #000000; padding: 0.04in 0.02in">
				<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="text-indent: 0in; widows: 2; orphans: 2">

				<FONT FACE="Times New Roman, serif"></FONT></P>
			</TD>
		</TR>
	</THEAD>

</TABLE>';
        return $table;
    }


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
            unset($_SESSION['form_id']);
            unset($_SESSION['step_id']);

            $form_actoin = "user_pass_form_end";
            $result_array['form_actoin'] = $form_actoin;
            return $result_array;
        }// user_pass_form_end();


    private function push_email(){
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


    private function secretary_signature_alert(){
        global $db, $labro;
        $observer = $labro->bailee($_SESSION['employee_id']);
        $observer_org_str_id = $observer['ORG_chief_id'];


        $action_type_id = 10;// Подписать у секреторя
        $this->history_insert($action_type_id);

        $sql = "INSERT INTO `local_alerts` (`initiator_employee_id`, `observer_org_str_id`, `action_type_id`,`company_id`,`save_temp_files_id`,`step_id`,`date_create`)
                                       VALUES( '" .  $_SESSION['employee_id'] .
                                            "','" . $observer_org_str_id .
                                            "','" . $action_type_id .
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



    private function secretary_get_doc_alert(){
        global $db, $labro;
        $observer = $labro->bailee($_SESSION['employee_id']);
        $observer_org_str_id = $observer['ORG_chief_id'];

        $action_type_id = 12;// Секретарь должен получить документ
        $this->history_insert($action_type_id);

        $sql = "INSERT INTO `local_alerts` (`initiator_employee_id`, `observer_org_str_id`, `action_type_id`,`company_id`,`save_temp_files_id`,`step_id`,`date_create`)
                                       VALUES( '" .  $_SESSION['employee_id'] .
            "','" . $observer_org_str_id .
            "','" . $action_type_id .
            "','" . $_SESSION['control_company'] .
            "','" . $_SESSION['real_form_id'] .
            "','" . $_SESSION['step_id'] .
            "',NOW());";
        $db->query($sql);


        $form_actoin = "secretary_accept_alert";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['page'] = "secretary_accept_alert";
        // дописываем историю
        $this->logs_form_file();
        $this->session_clear();
        return $result_array;
    }// local_alert();


    private function signature_accept(){
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
                                <div class="button" style="width: 180px;" id="popup_update_select_node_yes">Я подписал</div>
                                <div class="button" style="width: 180px;" id="popup_update_select_position_cancel">Я не подписал</div>
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



    private function bailee_alert(){
        global $db, $labro;
        $observer = $labro->bailee($_SESSION['employee_id']);
        $observer_org_str_id = $observer['ORG_chief_id'];

        $action_type_id = 14;// Подписать ответственному
        $this->history_insert($action_type_id);

        $sql = "INSERT INTO `local_alerts` (`initiator_employee_id`, `observer_org_str_id`, `action_type_id`,`company_id`,`save_temp_files_id`,`step_id`,`date_create`)
                                       VALUES( '" .  $_SESSION['employee_id'] .
            "','" . $observer_org_str_id .
            "','" . $action_type_id .
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

    private function probation_alert(){
        global $db, $labro;
        $observer = $labro->bailee($_SESSION['employee_id']);
        $observer_org_str_id = $observer['ORG_chief_id'];

        $action_type_id = 18;// Подписать ответственному
        $this->history_insert($action_type_id);

        $sql = "INSERT INTO `local_alerts` (`initiator_employee_id`, `observer_org_str_id`, `action_type_id`,`company_id`,`save_temp_files_id`,`step_id`,`date_create`)
                                       VALUES( '" .  $_SESSION['employee_id'] .
            "','" . $observer_org_str_id .
            "','" . $action_type_id .
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
    }



    private function order_for_an_internship(){
        global $db, $labro;
//        $observer = $labro->bailee($_SESSION['employee_id']);
//        $observer_org_str_id = $observer['ORG_chief_id'];

        $action_type_id = 27;// распоряжение о назначении стажировки
//        $this->history_insert($action_type_id);

        $sql = "INSERT INTO `local_alerts` (`initiator_employee_id`, `observer_org_str_id`, `action_type_id`,`company_id`,`save_temp_files_id`,`step_id`,`date_create`)
                                       VALUES( '" .  $_SESSION['employee_id'] .
            "','" . $action_type_id .
            "','" . $_SESSION['control_company'] .
            "','" . $_SESSION['real_form_id'] .
            "','" . $_SESSION['step_id'] .
            "',NOW());";
        $db->query($sql);


        $form_actoin = "local_alert";
        $result_array['form_actoin'] = $form_actoin;
        $result_array['page'] = "local_alert";
        // дописываем историю
//        $this->logs_form_file();
        $this->session_clear();
        return $result_array;
    }
}
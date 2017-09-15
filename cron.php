<?php
// * 1 * * 1-5 sudo /usr/bin/php /var/www/cron.php - прописать в крон файле /etc crontab -e

require_once(__DIR__ . '/core/systems/classes/class_controller.php');
require_once(__DIR__ . '/core/systems/classes/class_elements.php');
require_once(__DIR__ . '/core/systems/classes/class_labro.php');
require_once(__DIR__ . '/core/systems/classes/class_mysql.php');
require_once(__DIR__ . '/core/systems/classes/class_node.php');
require_once(__DIR__ . '/core/systems/classes/class_phpexcel.php');
require_once(__DIR__ . '/core/systems/classes/class_phpmailer.php');
require_once(__DIR__ . '/core/systems/classes/class_router.php');
require_once(__DIR__ . '/core/systems/classes/class_smtp.php');
require_once(__DIR__ . '/core/systems/classes/class_systems.php');
require_once(__DIR__ . '/config.php');
//include('core/systems/core.php');
//include('core/systems/classes/class_systems.php');
//global $systems;
//$sql="Select *
//                  FROM employees
//                  WHERE employees.id = 2";


// Подключаем базу
    $db = new MySQL;
    // ПОдключаемся к базе;
    $db->connect($db_host, $db_name, $db_user, $db_password);
    // Устанавливаем кодировку;
    $db->query("SET NAMES `UTF8`");

// Подключаем почту
    $systems = new systems;

// Подключаем лабор
    $labro = new labro;

// Назначаем компанию
    $control_company = 15;
// Время
$today = date("Y-m-d H:i:s");
// тест
$arrays = "";
// Получаем массив всех сатрудников
$sql="SELECT employees_items_node.employe_id
FROM employees_items_node, organization_structure
WHERE employees_items_node.org_str_id = organization_structure.id
AND organization_structure.company_id =" . $control_company;
$employees_sql = $db->all($sql);
$employees = array();
$arrays .= "сотрудники  <br>";
foreach ($employees_sql as $item) {
        $employees[] = $item['employe_id'];
    $arrays .= $item['employe_id'] . "<br>";;
}

$sql="SELECT ORG_chief.id AS ORG_chief_id,ORG_boss.boss_type, ORG_boss.`level` as level,
                chief_employees.id AS chief_employees_id,
                chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
                    chief_items_control.name AS chief_dol
                FROM (organization_structure, employees_items_node)
                LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
                                                                                    AND
                                                                                  ORG_chief.right_key > organization_structure.right_key
                                                                                  AND
                                                                                  ORG_chief.company_id = 15 )
                        LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = 15
                                                                                        AND ORG_boss.left_key > ORG_chief.left_key
                                                                                        AND ORG_boss.right_key < ORG_chief.right_key
                                                                                        AND 	ORG_boss.`level` = (ORG_chief.`level` +1)
                                                                                        AND ORG_boss.boss_type > 1
                                                                                            )
                        LEFT JOIN employees_items_node AS chief_node ON chief_node.org_str_id = ORG_boss.id
                        LEFT JOIN employees AS chief_employees ON chief_employees.id = chief_node.employe_id
                        LEFT JOIN items_control AS  chief_items_control ON chief_items_control.id = ORG_boss.kladr_id

                WHERE organization_structure.id = employees_items_node.org_str_id
                AND organization_structure.company_id = 15
                AND chief_employees.id is not NULL
                GROUP BY ORG_chief_id
                ORDER BY level DESC, boss_type DESC";
$bailees_sql = $db->all($sql);
// Получаем массив ответственных
$bailees = array();
$arrays .= "ответственные  <br>";
foreach ($bailees_sql as $item) {
    $bailees[] = $item['chief_employees_id'];
    $arrays .= $item['chief_employees_id'] . "<br>";
}

// Получаем массив руководителей
$sql="SELECT employees_items_node.employe_id
FROM employees_items_node, organization_structure
WHERE employees_items_node.org_str_id = organization_structure.id
AND organization_structure.company_id = ". $control_company ."
AND organization_structure.boss_type > 1";
$leaders_sql = $db->all($sql);
$leaders = array();
$arrays .= "руководители <br>";
foreach ($leaders_sql as $item) {
    $leaders[] = $item['employe_id'];
    $arrays .= $item['employe_id'] . "<br>";
}

// Получаем массив секретарей
$sql="SELECT employees_items_node.employe_id
FROM employees_items_node, organization_structure,users
WHERE employees_items_node.org_str_id = organization_structure.id
AND organization_structure.company_id = ". $control_company ."
AND employees_items_node.employe_id = users.employee_id
AND users.role_id = 4";
$secretars_sql = $db->all($sql);
$secretars = array();
$arrays .= "секретари <br>";
foreach ($secretars_sql as $item) {
    $secretars[] = $item['employe_id'];
    $arrays .= $item['employe_id'] . "<br>";
}

// глобальный массив для рассылки
$dispatch = array();
$arrays = "";
foreach ($employees as $item) {
    $dispatch[$item]["email"] = $labro->employees_email($item);
    $dispatch[$item]["emp_id"] = $item;
    $dispatch[$item]["mail_body"] = "";
}

employee_alerts(); // проходим по сотрудникам
secretars_alerts(); // проходим по секретарям
bailees_alerts(); // проходим по наставникам
mails_send(); // отсылаем составленные письма
test_fun();       // кусаем арбуз


function mails_send(){
    global $systems, $today, $dispatch;

    foreach ($dispatch as $item) {
        if( $item["mail_body"] != "") {
            // валидация почты
            if ( is_email($item["email"])) {
                $send_mailer = $systems->create_mailer_object();
                $email = $item["email"];
                $send_mailer->From = 'noreply@laborpro.ru';
                $send_mailer->FromName = "Охрана Труда";
                $send_mailer->addAddress($email);
                $send_mailer->isHTML(true);
                $send_mailer->Subject = "Охрана Труда";
                $send_mailer->Body = $today . "<br>" . $item["mail_body"];
                $send_mailer->send();
            }
        }
    }
}

// валидация почты
function is_email($email) {
    return preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $email);
}

function employee_alerts(){
    global $db, $control_company, $employees, $dispatch;

    $sql="SELECT
/* Вывод даннных */
FORM_CHECK.form_id AS doc_all,
FORM_NOW.doc_status_now,
  employees.id AS EMPLOY, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
   route_control_step.id AS STEP, route_control_step.`periodicity`, history_docs.`id` AS history_docs,history_docs.date_finish,
   /* условный вывод */
  CASE
   WHEN MIN(history_docs.date_start) IS NULL
   THEN 'Не начинал'
   ELSE MIN(history_docs.date_start)
   END AS StartStep,
   CASE
   WHEN MAX(history_docs.date_finish) IS NULL
   THEN 'Не прошел'
   ELSE MAX(history_docs.date_finish)
   END  AS FinishStep,
  items_control.name,
  /* клеем фио */
  org_parent.id AS dir_id, org_parent.left_key, org_parent.right_key, org_parent.level,
   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir,
  route_control_step.step_name AS manual, TempTest.SaveTempID

  FROM (route_control_step,route_doc,employees)
  LEFT JOIN
    history_docs
    /* история документов по шагам */
    ON (history_docs.step_id = route_control_step.id
       AND
       history_docs.employee_id = employees.id)
       /* привязка сотрудника к должности */
       LEFT JOIN employees_items_node ON employees_items_node.employe_id = employees.id
       LEFT JOIN organization_structure ON employees_items_node.org_str_id = organization_structure.id
       LEFT JOIN items_control ON items_control.id = organization_structure.kladr_id
       /* находим родительскузел, должность и тип должности */
     LEFT JOIN organization_structure AS org_parent
     ON (org_parent.left_key < organization_structure.left_key AND org_parent.right_key > organization_structure.right_key
     AND org_parent.level =(organization_structure.level - 1) )
     LEFT JOIN items_control AS item_par ON item_par.id = org_parent.kladr_id
    LEFT JOIN items_control_types ON items_control_types.id = org_parent.items_control_id
     /* узлы с индивидуальными треками */
    LEFT JOIN organization_structure AS TreeOfParents
     ON TreeOfParents.id = route_doc.organization_structure_id
    LEFT JOIN
    /*  получаем id сохранённого файла если он сеть*/
    	(SELECT
			save_temp_files.id AS SaveTempID, history_forms.step_end_time AS TempIdDateStatus, type_form.name AS TempName,
			save_temp_files.employee_id AS TempEmpliD, company_temps.id AS TempCompanyId, step_content.id AS ContentFormId,
			form_step_action.action_name AS ActionName
			FROM
				(save_temp_files, form_status_now, history_forms, type_temp, company_temps, type_form, form_step_action, temps_form_step)
				/* нужны те шаги где есть form_id */
				LEFT JOIN step_content
					ON step_content.form_id = company_temps.id
			WHERE
				save_temp_files.id = form_status_now.save_temps_file_id
				AND
				form_status_now.history_form_id = history_forms.id
				AND
				type_temp.id = company_temps.temp_type_id
				AND
				save_temp_files.company_temps_id = company_temps.id
				AND
				type_form.id = type_temp.temp_form_id
				AND
				temps_form_step.id = form_status_now.track_form_step_now
				AND
				form_step_action.id = temps_form_step.action_form) AS TempTest
				/* приклееваем по совпадению пар сотрудников и шагов */
		ON (TempTest.TempEmpliD=employees.id AND TempTest.ContentFormId = route_control_step.step_content_id)
		LEFT JOIN step_content AS FORM_CHECK ON FORM_CHECK.id = route_control_step.step_content_id
		LEFT JOIN form_status_now AS FORM_NOW ON FORM_NOW.author_employee_id = employees.id
  WHERE
      /* все роуты с треками */
    route_control_step.track_number_id = route_doc.id
    AND
  /* для всех должностей ... */
   (route_doc.item_type_id IS NULL
          OR
          /* ... или по паре должность  - конкретный сотрудник*/
        route_doc.item_type_id IN
          /* Start Ищем ID Должности из таблици employees_item_node для заданного сотрудника employe.id */
          (SELECT EmplOrg.kladr_id
            FROM
              employees AS Empl, employees_items_node AS EmplItem, organization_structure AS EmplOrg
            WHERE
              Empl.id = EmplItem.employe_id
              AND
              EmplItem.org_str_id=EmplOrg.id
              )
    )
    AND
    /* для всех узлов или конкретных узлов по конкретным сотрудникам */
    (route_doc.organization_structure_id IS NULL
   OR
     (organization_structure.left_key >= TreeOfParents.left_key
     AND
     organization_structure.right_key <= TreeOfParents.right_key)
     )
	AND	organization_structure.company_id
   AND
   /* по фирме*/

    route_doc.company_id = ". $control_company ."
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $control_company ."
    		AND org_parent.company_id = ". $control_company ."
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
   GROUP BY EMPLOY, STEP
                 ORDER BY EMPLOY";

    $test_array = $db->all($sql);
    foreach ($employees as $employee) {
        $employee_html = "";
        foreach ($test_array as $test_item) {
            if ($test_item['EMPLOY'] == $employee){
                if($test_item['FinishStep']=="Не прошел") {
                    $employee_html .= $test_item["manual"]. "<br>";
                }
            }
        }
        // запись в масси в для рассылки для соответствующего сотрудника
        if ($employee_html!=""){
            $dispatch[$employee]["mail_body"] .= "<b>Вы не прошли следующие инструктажи:</b><br>";
            $dispatch[$employee]["mail_body"] .= $employee_html;
        }

    }
}

function secretars_alerts(){
    global $db, $control_company,$labro, $secretars, $dispatch;

    $sql="SELECT local_alerts.save_temp_files_id, save_temp_files.name AS file, local_alerts.id,local_alerts.action_type_id,
form_step_action.action_name,form_step_action.user_action_name,
CONCAT_WS (' ',init_em.surname , init_em.name, init_em.second_name) AS fio, local_alerts.step_id,init_em.id AS em_id,
local_alerts.date_create,   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir,
items_control.name AS `position`,document_status_now.name as doc_status, route_control_step.step_name AS manual,
document_status_now.id AS doc_trigger
FROM (local_alerts,employees_items_node, employees AS init_em,
cron_action_type, form_step_action)
LEFT JOIN employees_items_node AS NODE ON NODE.employe_id = local_alerts.initiator_employee_id
LEFT JOIN organization_structure ON organization_structure.id = NODE.org_str_id
LEFT JOIN items_control ON items_control.id = organization_structure.kladr_id
LEFT JOIN organization_structure AS org_parent
ON (org_parent.left_key < organization_structure.left_key AND org_parent.right_key > organization_structure.right_key
    AND org_parent.level =(organization_structure.level - 1) )
LEFT JOIN items_control AS item_par ON item_par.id = org_parent.kladr_id
LEFT JOIN items_control_types ON items_control_types.id = org_parent.items_control_id

LEFT JOIN form_status_now ON form_status_now.save_temps_file_id = local_alerts.save_temp_files_id
LEFT JOIN document_status_now ON document_status_now.id = form_status_now.doc_status_now
LEFT JOIN save_temp_files ON save_temp_files.id = local_alerts.save_temp_files_id
LEFT JOIN route_control_step ON route_control_step.`id`= local_alerts.step_id

WHERE local_alerts.company_id = ". $control_company ."

    AND local_alerts.initiator_employee_id = init_em.id
    AND form_step_action.id = local_alerts.action_type_id
    AND local_alerts.date_finish IS NULL
     GROUP BY local_alerts.id
     ORDER BY em_id";

    $alert_array = $db->all($sql);
    foreach ($secretars as $secretar) {
        $secretar_html = "";
        $emp_id = 0;
        foreach ($alert_array as $alert_item) {
            $date = date_create($alert_item['date_create']);
            if ($alert_item['em_id'] != $emp_id) {
                $emp_id = $alert_item['em_id'];
                $secretar_html .= "<br><b> Сотрудник -" . $alert_item["fio"] . ", " . $alert_item["dir"] . ", " . $alert_item["position"] . " - </b><br>";
            }

            // если надо расписаться у секреторя
            if ($alert_item['action_type_id'] == 10) {
                $secretar_html .= " дожен расписаться в документе - <b>'" . $alert_item['manual'] . "'</b>(". date_format($date, 'd-m-Y') .") <br>";
            }
            // если надо сдать документ
            if ($alert_item['action_type_id'] == 12) {
                $secretar_html .= " дожен сдать документ - <b>'" . $alert_item['manual'] . "'</b>(". date_format($date, 'd-m-Y') .") <br>";
            }
            // если нужна подпись ответственного лица
            if ($alert_item['action_type_id'] == 14) {
                $boss = $labro->bailee($alert_item['em_id']);
                $chief = $boss['chief_surname'] . " " . $boss['chief_name'] . " " . $boss['chief_second_name'];
                $chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
                $chief_dol = $boss['chief_dol'];
                $secretar_html .= " нужна подпись ответственного - <b>" . $chiefFIO . "</b>(" . $chief_dol . "), в документе - <b>'" . $alert_item['manual'] . "'</b>(". date_format($date, 'd-m-Y') .") <br>";
            }

        }
        // запись в масси в для рассылки для соответствующего сотрудника
        if ($secretar_html != "") {
            $dispatch[$secretar]["mail_body"] .= "<br><b>Сегодня надо обработать следующие уведомления:</b><br>";
            $dispatch[$secretar]["mail_body"] .= $secretar_html;
        }
    }

}

function bailees_alerts(){
    global $db, $control_company,$labro, $bailees, $dispatch;

    $sql="SELECT local_alerts.save_temp_files_id, save_temp_files.name AS file, local_alerts.id,local_alerts.action_type_id,
form_step_action.action_name,form_step_action.user_action_name,
CONCAT_WS (' ',init_em.surname , init_em.name, init_em.second_name) AS fio, local_alerts.step_id,init_em.id AS em_id,
local_alerts.date_create,   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir,
items_control.name AS `position`,document_status_now.name as doc_status, route_control_step.step_name AS manual,
document_status_now.id AS doc_trigger
FROM (local_alerts,employees_items_node, employees AS init_em,
cron_action_type, form_step_action)
LEFT JOIN employees_items_node AS NODE ON NODE.employe_id = local_alerts.initiator_employee_id
LEFT JOIN organization_structure ON organization_structure.id = NODE.org_str_id
LEFT JOIN items_control ON items_control.id = organization_structure.kladr_id
LEFT JOIN organization_structure AS org_parent
ON (org_parent.left_key < organization_structure.left_key AND org_parent.right_key > organization_structure.right_key
    AND org_parent.level =(organization_structure.level - 1) )
LEFT JOIN items_control AS item_par ON item_par.id = org_parent.kladr_id
LEFT JOIN items_control_types ON items_control_types.id = org_parent.items_control_id

LEFT JOIN form_status_now ON form_status_now.save_temps_file_id = local_alerts.save_temp_files_id
LEFT JOIN document_status_now ON document_status_now.id = form_status_now.doc_status_now
LEFT JOIN save_temp_files ON save_temp_files.id = local_alerts.save_temp_files_id
LEFT JOIN route_control_step ON route_control_step.`id`= local_alerts.step_id

WHERE local_alerts.company_id = ". $control_company ."

    AND local_alerts.initiator_employee_id = init_em.id
    AND form_step_action.id = local_alerts.action_type_id
    AND local_alerts.date_finish IS NULL
     GROUP BY local_alerts.id
     ORDER BY em_id";

    $alert_array = $db->all($sql);
    foreach ($bailees as $bailee) {
        $bailee_html = "";
        $emp_id = 0;
        // проходим по массиву уведомлений
        foreach ($alert_array as $alert_item) {
            $chief = $labro->bailee($alert_item["em_id"]);
            // если у сотрудника наставник наш персонаж
            if($chief['chief_employees_id'] == $bailee){
                // проверяем надоли чего подписать
                if ($alert_item['action_type_id'] == 14) {
                    // заголовок нового сотрудника
                    if ($alert_item['em_id'] != $emp_id) {
                        $emp_id = $alert_item['em_id'];
                        $bailee_html .= "<b> Сотрудник -" . $alert_item["fio"] . ", " . $alert_item["dir"] . ", " . $alert_item["position"] . " - </b><br>";
                    }
                    // сам документ
                    $date = date_create($alert_item['date_create']);
                    $bailee_html .= "документе - <b>'" . $alert_item['manual'] . "'</b> (". date_format($date, 'd-m-Y') .") <br>";
                }

            }
        }
        // запись в масси в для рассылки для соответствующего сотрудника
        if ($bailee_html != "") {
            $dispatch[$bailee]["mail_body"] .= "<br><b>Вам надо рассписаться в документах следующих сотрудников:</b><br>";
            $dispatch[$bailee]["mail_body"] .= $bailee_html;
            $dispatch[$bailee]["mail_body"] .= "<i>Документы должны находиться у секретаря</i><br>";
        }
    }

}


function test_fun(){
    global $systems, $today, $dispatch;

            $send_mailer = $systems->create_mailer_object();
            $email = "gamanov.d@gmail.com";
            $send_mailer->From = 'noreply@laborpro.ru';
            $send_mailer->FromName = "Охрана Труда";
            $send_mailer->addAddress($email);
            $send_mailer->isHTML(true);
            $send_mailer->Subject = "Охрана Труда";
            $send_mailer->Body = $today . "<br>" . $dispatch[73]['mail_body'];
            $send_mailer->send();

            $send_mailer = $systems->create_mailer_object();
            $email = "vasin.filipp@yandex.ru";
            $send_mailer->From = 'noreply@laborpro.ru';
            $send_mailer->FromName = "Охрана Труда";
            $send_mailer->addAddress($email);
            $send_mailer->isHTML(true);
            $send_mailer->Subject = "Охрана Труда";
            $send_mailer->Body = $today . "<br>" . $dispatch[73]['mail_body'];
            $send_mailer->send();

            $send_mailer = $systems->create_mailer_object();
            $email = "gamanov.d@gmail.com";
            $send_mailer->From = 'noreply@laborpro.ru';
            $send_mailer->FromName = "Охрана Труда";
            $send_mailer->addAddress($email);
            $send_mailer->isHTML(true);
            $send_mailer->Subject = "Охрана Труда";
            $send_mailer->Body = $today . "<br>" . $dispatch[43]['mail_body'];
            $send_mailer->send();

            $send_mailer = $systems->create_mailer_object();
            $email = "vasin.filipp@yandex.ru";
            $send_mailer->From = 'noreply@laborpro.ru';
            $send_mailer->FromName = "Охрана Труда";
            $send_mailer->addAddress($email);
            $send_mailer->isHTML(true);
            $send_mailer->Subject = "Охрана Труда";
            $send_mailer->Body = $today . "<br>" . $dispatch[43]['mail_body'];
            $send_mailer->send();

            $send_mailer = $systems->create_mailer_object();
            $email = "gamanov.d@gmail.com";
            $send_mailer->From = 'noreply@laborpro.ru';
            $send_mailer->FromName = "Охрана Труда";
            $send_mailer->addAddress($email);
            $send_mailer->isHTML(true);
            $send_mailer->Subject = "Охрана Труда";
            $send_mailer->Body = $today . "<br>" . $dispatch[2]['mail_body'];
            $send_mailer->send();

            $send_mailer = $systems->create_mailer_object();
            $email = "vasin.filipp@yandex.ru";
            $send_mailer->From = 'noreply@laborpro.ru';
            $send_mailer->FromName = "Охрана Труда";
            $send_mailer->addAddress($email);
            $send_mailer->isHTML(true);
            $send_mailer->Subject = "Охрана Труда";
            $send_mailer->Body = $today . "<br>" . $dispatch[2]['mail_body'];
            $send_mailer->send();
}


?>
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_dead_end{
// Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else(){
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }



    // тестим здесь
    public function test()
    {

       if($_SESSION['employee_id'] == 2){
           $html = '<div class="button" id="reset_progress" reset_id="' . $_SESSION['employee_id'] . '">Сбросить результаты</div>';
       } else {
           $html = "";
       }

        return $html;
    }

    // тестим здесь
    public function reset_progress()
    {
        global $db;
        $reset_id = $this->post_array['reset_id'];

        $sql = "DELETE FROM `history_docs` WHERE  `employee_id`=" . $reset_id;
        $db->query($sql);

        $sql = "DELETE FROM `history_step` WHERE  `employee_id`=" . $reset_id;
        $db->query($sql);

        // запросили id документа
        $sql = "SELECT save_temp_files.id, save_temp_files.path
                FROM save_temp_files
                WHERE save_temp_files.employee_id =".$reset_id;
        $result = $db->all($sql);
        foreach($result as $item) {
            $save_temps_file_id = $item['id'];
            $file_url = $item['path'];
            // удалили файл
            unlink($file_url);

            $sql = "DELETE FROM `form_status_now` WHERE  `save_temps_file_id`=" . $save_temps_file_id;
            $db->query($sql);
            $sql = "DELETE FROM `history_forms` WHERE  `save_temps_id`=" . $save_temps_file_id;
            $db->query($sql);
        }

        $sql = "DELETE FROM `pass_test_form_history` WHERE  `employee`=" . $reset_id;
        $db->query($sql);
        $sql = "DELETE FROM `save_temp_files` WHERE  `employee_id` =" . $reset_id;
        $db->query($sql);
        $sql = "DELETE FROM `manual_history` WHERE  `employee_id` =" . $reset_id;
        $db->query($sql);


        $html = $reset_id;
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }

    // cron тестим здесь
    public function cron()
    {
        global $db;
        // логи

        $result_status = "Start";
        $cron_task = "cron_start";
        $comment = "Начали работать";
        $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
        $db->query($sql);

//        $this->drop_every_day();
//        $this->transfer_alert();
//        $this->transfer_to_history_alert();

        // формируем список инициаторов и проходим по списку
        $sql="SELECT * FROM cron_every_day GROUP BY cron_every_day.initiator_employee_id";
        $initiators = $db->all($sql);
        // проходим по сообщениям инициатору
//        $this->send_mail_to_initiator($initiators);
        // отчёт по не пройденным тестам
        $observer_emplyoee_id = 69;
        $this->send_report_to_test($observer_emplyoee_id);
        sleep(3);
        // отчёт по сотрудникам
//        $this->send_report($observer_emplyoee_id);

        // логи
        $result_status = "Stop";
        $cron_task = "cron_stop";
        $comment = "Закончили работать";
        $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
        $db->query($sql);


    }


    // отчистка таблицы local_alerts
    private  function transfer_to_history_alert()
    {
        global $db;
        // если есть документ, если есть шаг, если сотрудник не уволен и если действие не завершено
        $sql = "SELECT local_alerts.*
                FROM (employees,route_control_step,local_alerts)
                LEFT JOIN save_temp_files ON save_temp_files.id = local_alerts.save_temp_files_id
                WHERE
					 (local_alerts.initiator_employee_id = employees.id
                AND employees.`status` = 0)
                OR
                (local_alerts.date_finish IS NOT NULL)
                OR
                (route_control_step.id = local_alerts.step_id
                AND route_control_step.track_number_id IS NULL)
                OR
                (save_temp_files.path IS NULL)
                GROUP BY id";

        // перенос утсраевших строк в историю
        $alert_array = $db->all($sql);
        foreach ($alert_array as $key => $alert_item) {
            $sql = "INSERT INTO `alert_history` (`initiator_employee_id`,
                                                  `observer_org_str_id`,
                                                  `cron_action_type_id`,
                                                  `company_id`,
                                                  `save_temp_files_id`,
                                                  `step_id`,
                                                  `date_create`,
                                                  `date_finish`) VALUES (
                                                   '" . $alert_item['initiator_employee_id'] . "',
                                                   '" . $alert_item['observer_org_str_id'] . "',
                                                   '" . $alert_item['cron_action_type_id'] . "',
                                                   '" . $alert_item['company_id'] . "',
                                                   '" . $alert_item['save_temp_files_id'] . "',
                                                   '" . $alert_item['step_id'] . "',
                                                   '" . $alert_item['date_create'] . "',
                                                   '" . $alert_item['date_finish'] . "');";
            $db->query($sql);
            // удаляем перенесённую строку
            $sql="DELETE FROM `local_alerts` WHERE `id`=". $alert_item['id'];
            $db->query($sql);
        }
    }

    // отчистка таблицы
    private  function drop_every_day(){
        global $db;
        $sql="TRUNCATE TABLE `cron_every_day`";
        $db->query($sql);
    }
    // запрос  и перенос данных cron
    private function transfer_alert(){
        global $db;
        // если есть документ, если есть шаг, если сотрудник не уволен и если действие не завершено
        $sql="SELECT local_alerts.*
                FROM local_alerts,employees,route_control_step,save_temp_files
                WHERE local_alerts.initiator_employee_id = employees.id
                AND employees.`status` = 1
                AND local_alerts.date_finish IS NULL
                AND route_control_step.id = local_alerts.step_id
                AND route_control_step.track_number_id IS NOT NULL
                AND save_temp_files.id = local_alerts.save_temp_files_id
                AND save_temp_files.path IS NOT NULL
                GROUP BY id";


        $alert_array = $db->all($sql);
        // переносим оставшийся массив в таблицу cron_every_day
        foreach ($alert_array as $key=>$alert_item) {
            $sql = "INSERT INTO `cron_every_day` (`initiator_employee_id`,
                                                  `observer_org_str_id`,
                                                  `cron_action_type_id`,
                                                  `company_id`,
                                                  `save_temp_files_id`,
                                                  `step_id`,
                                                  `date_create`) VALUES (
                                                   '". $alert_item['initiator_employee_id'] ."',
                                                   '". $alert_item['observer_org_str_id']  ."',
                                                   '". $alert_item['cron_action_type_id']  ."',
                                                   '". $alert_item['company_id']  ."',
                                                   '". $alert_item['save_temp_files_id']  ."',
                                                   '". $alert_item['step_id']  ."',
                                                   '". $alert_item['date_create']  ."');";
                $db->query($sql);
        }
    }


    // отчёт непройденым тестам
    private  function send_report_to_test($observer_emplyoee_id){

        global $db;
        // Создаем объект класса PHPExcel
        $xls = new PHPExcel();
// Устанавливаем индекс активного листа
        $xls->setActiveSheetIndex(0);
// Получаем активный лист
        $sheet = $xls->getActiveSheet();
// Подписываем лист
        $sheet->setTitle('Отчёт по тестам');

// Вставляем текст в ячейку A1
        $sheet->setCellValue("A1", 'Отчёт по тестам');
        $sheet->getStyle('A1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

// Объединяем ячейки
        $sheet->mergeCells('A1:G1');
// Автовыравнивание ширины столбцов
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);

// Выравнивание по горизонтали
        $sheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Заголовок
        $sheet->setCellValueByColumnAndRow(0, 2,'№');
        $sheet->setCellValueByColumnAndRow(1, 2,'Отдел');
        $sheet->setCellValueByColumnAndRow(2, 2,'Должность');
        $sheet->setCellValueByColumnAndRow(3, 2,'ФИО');
        $sheet->setCellValueByColumnAndRow(4, 2,'Наименование Инструкции');
        $sheet->setCellValueByColumnAndRow(5, 2,'Начало прохождения');
        $sheet->setCellValueByColumnAndRow(6, 2,'Окончание прохождения');

        //  размеры шрифта
        $sheet->getStyle('A1')->getFont()->setSize(18);
        $sheet->getStyle('A2')->getFont()->setSize(13);
        $sheet->getStyle('B2')->getFont()->setSize(13);
        $sheet->getStyle('C2')->getFont()->setSize(13);
        $sheet->getStyle('D2')->getFont()->setSize(13);
        $sheet->getStyle('E2')->getFont()->setSize(13);
        $sheet->getStyle('F2')->getFont()->setSize(13);
        $sheet->getStyle('G2')->getFont()->setSize(13);

// Выравнивание заголовка
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(
            PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// устанавливаем бордер ячейкам
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        // какие права имеет получатель
        $sql="SELECT employees.id AS emp_id, employees.email,organization_structure.`company_id`, organization_structure.id AS org_id, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
                    organization_structure.boss_type,
                       CASE
                       WHEN organization_structure.boss_type = 1
                       THEN 'none'
                       WHEN organization_structure.boss_type = 2
                       THEN organization_structure.left_key
                       WHEN organization_structure.boss_type = 3
                       THEN 'all'
                       END  AS `left`,
                       CASE
                       WHEN organization_structure.boss_type = 1
                       THEN 'none'
                       WHEN organization_structure.boss_type = 2
                       THEN organization_structure.right_key
                       WHEN organization_structure.boss_type = 3
                       THEN 'all'
                       END  AS `right`

                    FROM organization_structure, employees, employees_items_node
                    WHERE organization_structure.id = employees_items_node.org_str_id
                    AND employees_items_node.employe_id = employees.id
                    AND employees.id =". $observer_emplyoee_id;

        $observer_data = $db->row($sql);
        $email = $observer_data['email'];
        $left = $observer_data['left'];
        $right = $observer_data['right'];
        $company_id = $observer_data['company_id'];

        $sql="SELECT
/* Вывод даннных */

  employees.id AS EMPLOY, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
   route_control_step.id AS STEP,
   /* условный вывод */
  CASE
   WHEN MIN(history_docs.date_start) IS NULL
   THEN 'Не начинал'
   ELSE MIN(history_docs.date_start)
   END AS StartStep,
   CASE
   WHEN MAX(history_docs.date_finish) IS NULL
   THEN 'Не прошол'
   ELSE MAX(history_docs.date_finish)
   END  AS FinishStep,
  items_control.name,
  /* клеем фио */
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

   AND
   /* по фирме*/
    route_doc.company_id =".$company_id;

        // частичный доступ
        if(($left!='none')&&($left!="all")) {
            $sql .= " AND organization_structure.left_key >= " . $left . "
                AND organization_structure.right_key <= " . $right . "
                AND (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
                 GROUP BY EMPLOY, STEP";
        }

        // полный доступ
        if($left=='all') {
            $sql .= " AND (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
                 GROUP BY EMPLOY, STEP";
        }

        // без доступа
        if($left=='none') {
            $result_status = "error";
            $cron_task = "mail_to_org";
            $comment = "У пользователя нет доступа на получение отчётов - ". $observer_emplyoee_id ;
            $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
            $db->query($sql);
        } else {
            $docs_array = $db->all($sql);
            $coutn = 0;
            $key = 0;
            foreach ($docs_array as $docs_array_item) {
                if ($docs_array_item['FinishStep'] == "Не прошол") {
                    if ($docs_array_item['EMPLOY'] == "") {
                        $sheet->setCellValueByColumnAndRow(0, $key + 3, " ");
                    } else {
                        $sheet->setCellValueByColumnAndRow(0, $key + 3, $docs_array_item['EMPLOY']);
                    }
                    if ($docs_array_item['dir'] == "") {
                        $sheet->setCellValueByColumnAndRow(1, $key + 3, " ");
                    } else {
                        $sheet->setCellValueByColumnAndRow(1, $key + 3, $docs_array_item['dir']);
                    }
                    if ($docs_array_item['name'] == "") {
                        $sheet->setCellValueByColumnAndRow(2, $key + 3, " ");
                    } else {
                        $sheet->setCellValueByColumnAndRow(2, $key + 3, $docs_array_item['name']);
                    }
                    if ($docs_array_item['fio'] == "") {
                        $sheet->setCellValueByColumnAndRow(3, $key + 3, " ");
                    } else {
                        $sheet->setCellValueByColumnAndRow(3, $key + 3, $docs_array_item['fio']);
                    }
                    if ($docs_array_item['manual'] == "") {
                        $sheet->setCellValueByColumnAndRow(4, $key + 3, " ");
                    } else {
                        $sheet->setCellValueByColumnAndRow(4, $key + 3, $docs_array_item['manual']);
                    }
                    if ($docs_array_item['StartStep'] == "") {
                        $sheet->setCellValueByColumnAndRow(5, $key + 3, " ");
                    } else {
                        $sheet->setCellValueByColumnAndRow(5, $key + 3, $docs_array_item['StartStep']);
                    }
                    if ($docs_array_item['FinishStep'] == "") {
                        $sheet->setCellValueByColumnAndRow(6, $key + 3, " ");
                    } else {
                        $sheet->setCellValueByColumnAndRow(6, $key + 3, $docs_array_item['FinishStep']);
                    }


                    $sheet->getStyle('D', $key + 3)->getAlignment()->setWrapText(true);
                    $sheet->getStyle('E', $key + 3)->getAlignment()->setWrapText(true);
                    $sheet->getStyle('G', $key + 3)->getAlignment()->setWrapText(true);
                    $sheet->getStyle('B', $key + 3)->getAlignment()->setWrapText(true);
                    $sheet->getStyle('C', $key + 3)->getAlignment()->setWrapText(true);
                    $sheet->getStyle('D3')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('E3')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('G3')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('C3')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('B3')->getAlignment()->setWrapText(true);
                    $coutn = $key + 3;
                    $key++;
                }
            }
            $sheet->getStyle('A1:G' . $coutn)->applyFromArray($styleArray);

            // Выводим HTTP-заголовк, только для вывода в браузер
//        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
//        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
//        header ( "Cache-Control: no-cache, must-revalidate" );
//        header ( "Pragma: no-cache" );
//        header ( "Content-type: application/vnd.ms-excel" );
//        header ( "Content-Disposition: attachment; filename=matrix.xls" );

            $file_url = 'C:\MAMP\htdocs\application\real_forms\report.xls';
            $objWriter = new PHPExcel_Writer_Excel5($xls);
//                $objWriter->save('php://output');
            $objWriter->save($file_url);
            if($email!="") {
                $this->mail_send($email, "Отчёт по непройденным тестам", "Отчёт", $file_url);
                $result_status = "yes";
                $cron_task = "mail_to_org";
                $comment = "Отчёт по непройденным тестам отправлен пользователю - ". $observer_emplyoee_id ;
                $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
                $db->query($sql);
            } else {
                $result_status = "error";
                $cron_task = "mail_to_org";
                $comment = "Отчёт по непройденным тестам не отправлен, у пользователя нет почты - ". $observer_emplyoee_id ;
                $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
                $db->query($sql);
            }
        }
    }// отчёт по непройденным тестам



    private function send_mail_to_initiator($initiators){
        global $db;

        // проходим по сообщениям инициатору
        $mail_text ="";
        foreach($initiators as $initiator) {
            $sql = "SELECT * FROM cron_every_day
                    WHERE cron_every_day.initiator_employee_id =".$initiator['initiator_employee_id'];
            $local_alerts = $db->all($sql);
            $docs = array();
            foreach ($local_alerts as $key => $local_alert) {
                // собираем список все записи для письма инициатору
                if($local_alert['cron_action_type_id']==2) {
                    $docs[] = $local_alert['save_temp_files_id'];
                }
            }
            // находим почту инициатора, формируем письмо из массива и отправляем:
            $sql="Select *
                          FROM employees
                          WHERE employees.id =".$local_alert['initiator_employee_id'];
            $email_temp = $db->row($sql);
            // не уволин ли сотрудник
            if($email_temp['status']==0){
                $result_status = "error";
                $cron_task = "mail_to_emp";
                $comment = "Сотрудник уволен";
                $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
                $db->query($sql);
                break 1;// переходим к следующему инициатору
            }
            $email = $email_temp['email'];

            $sql= "Select *
           FROM save_temp_files
           WHERE save_temp_files.id IN(".implode(', ', $docs).")";
            echo $sql;
            $sql_docs = $db->all($sql);
            if (empty($sql_docs)) {
                $result_status = "error";
                $cron_task = "mail_to_emp";
                $comment = "Нет файлов";
                $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
                $db->query($sql);
                break 1;// переходим к следующему инициатору
            } else {
                $mail_text .= "Вы должны подписать следующие документы";
                foreach ($sql_docs as $sql_doc) {
                    $mail_text .= $sql_doc['name'];
                }
            }

            $sql="SELECT
                    /* Вывод даннных */

                      employees.id AS EMPLOY, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
                       route_control_step.id AS STEP,
                       /* условный вывод */
                      CASE
                       WHEN MIN(history_docs.date_start) IS NULL
                       THEN 'Не начинал'
                       ELSE MIN(history_docs.date_start)
                       END AS StartStep,
                       CASE
                       WHEN MAX(history_docs.date_finish) IS NULL
                       THEN 'Не прошол'
                       ELSE MAX(history_docs.date_finish)
                       END  AS FinishStep,
                      items_control.name,
                      /* клеем фио */
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

                       AND
                       /* по фирме*/
                        route_doc.company_id = 14
                        AND
                        /* для всех сотрудников или только для конкретного */
                        (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
                        AND employees.id = ". $initiator['initiator_employee_id'] ."

                         GROUP BY EMPLOY, STEP";
            $docs_array = $db->all($sql);
            if($docs_array[0]['id']!="") {
                $mail_text .= "Вы должны пройти следующие тесты: <br>";
                foreach ($docs_array as $docs_array_item) {
                    $mail_text .= $docs_array_item['manual'] . ", <br>";
                }
            }

            sleep(1);
            // если всё норм отпраляем почту инициатору
            $this->mail_send($email,"Невыполненые дела",$mail_text,"");

            $result_status = "yes";
            $cron_task = "mail_to_emp";
            $comment = "Отправили на"." ".$email . " " . $mail_text;
            $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
            $db->query($sql);
        }// перебор всех инициаторов
    }

    // cron тестим здесь
    public function mail_send($email,$mail_subject,$mail_body,$attached_file){
            global $mailer;
//        require_once(ROOT_PATH.'/core/systems/classes/class_phpmailer.php');
////         отправка письма:
//        $mailer = new phpmailer;
////будем отравлять письмо через СМТП сервер
//        $mailer->isSMTP();
////хост
//        $mailer->Host = 'smtp.yandex.ru';
////требует ли СМТП сервер авторизацию/идентификацию
//        $mailer->SMTPAuth = true;
//// логин от вашей почты
//        $mailer->Username = 'noreply@laborpro.ru';
//// пароль от почтового ящика
//        $mailer->Password = 'asd8#fIw2)l45Ab@!4Sa3';
////указываем способ шифромания сервера
//        $mailer->SMTPSecure = 'ssl';
////указываем порт СМТП сервера
//        $mailer->Port = '465';
////указываем кодировку для письма
//        $mailer->CharSet = 'UTF-8';
////информация от кого отправлено письмо



        $mailer->From = 'noreply@laborpro.ru';
        $mailer->FromName = 'Охрана Труда';
        $mailer->addAddress($email);

        $mailer->isHTML(true);

        $mailer->Subject = $mail_subject;
        $mailer->Body = $mail_body;

// прикрепляемый файл:
        if($attached_file!=""){
            $mailer->addAttachment($attached_file);
        }

        $mailer->send();
    }



    // отправляем отчёт прекреплённым с excel файлом
    private function send_report($observer_emplyoee_id)
    {
        global $db;

        // Создаем объект класса PHPExcel
        $xls_two = new PHPExcel();
// Устанавливаем индекс активного листа
        $xls_two->setActiveSheetIndex(0);
// Получаем активный лист
        $sheet = $xls_two->getActiveSheet();
// Подписываем лист
        $sheet->setTitle('Отчёт по документам');

// Вставляем текст в ячейку A1
        $sheet->setCellValue("A1", 'Отчёт по документам');
        $sheet->getStyle('A1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

// Объединяем ячейки
        $sheet->mergeCells('A1:I1');
// Автовыравнивание ширины столбцов
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(18);
        $sheet->getColumnDimension('H')->setWidth(19);
        $sheet->getColumnDimension('I')->setWidth(20);
// Выравнивание по горизонтали
        $sheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Заголовок
        $sheet->setCellValueByColumnAndRow(0, 2,'№');
        $sheet->setCellValueByColumnAndRow(1, 2,'ФИО');
        $sheet->setCellValueByColumnAndRow(2, 2,'Отдел');
        $sheet->setCellValueByColumnAndRow(3, 2,'Должность');
        $sheet->setCellValueByColumnAndRow(4, 2,'Наименование Документа');
        $sheet->setCellValueByColumnAndRow(5, 2,'Тип документа');
        $sheet->setCellValueByColumnAndRow(6, 2,'Действия');
        $sheet->setCellValueByColumnAndRow(7, 2,'Статус документа');
        $sheet->setCellValueByColumnAndRow(8, 2,'Дата изменения');
        //  размеры шрифта
        $sheet->getStyle('A1')->getFont()->setSize(18);
        $sheet->getStyle('A2')->getFont()->setSize(13);
        $sheet->getStyle('B2')->getFont()->setSize(13);
        $sheet->getStyle('C2')->getFont()->setSize(13);
        $sheet->getStyle('D2')->getFont()->setSize(13);
        $sheet->getStyle('E2')->getFont()->setSize(13);
        $sheet->getStyle('F2')->getFont()->setSize(13);
        $sheet->getStyle('G2')->getFont()->setSize(13);
        $sheet->getStyle('H2')->getFont()->setSize(13);
        $sheet->getStyle('I2')->getFont()->setSize(13);
// Выравнивание заголовка
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(
            PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// устанавливаем бордер ячейкам
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        // какие права имеет получатель
        $sql="SELECT employees.id AS emp_id, employees.email, organization_structure.id AS org_id, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
                    organization_structure.boss_type,
                       CASE
                       WHEN organization_structure.boss_type = 1
                       THEN 'none'
                       WHEN organization_structure.boss_type = 2
                       THEN organization_structure.left_key
                       WHEN organization_structure.boss_type = 3
                       THEN 'all'
                       END  AS `left`,
                       CASE
                       WHEN organization_structure.boss_type = 1
                       THEN 'none'
                       WHEN organization_structure.boss_type = 2
                       THEN organization_structure.right_key
                       WHEN organization_structure.boss_type = 3
                       THEN 'all'
                       END  AS `right`

                    FROM organization_structure, employees, employees_items_node
                    WHERE organization_structure.id = employees_items_node.org_str_id
                    AND employees_items_node.employe_id = employees.id
                    AND employees.id =". $observer_emplyoee_id;

        $observer_data = $db->row($sql);
        $email = $observer_data['email'];
        $left = $observer_data['left'];
        $right = $observer_data['right'];

        $sql="SELECT employees.id AS emp,
                organization_structure.id AS org,
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
                items_control.name AS dol,
                PAR.name AS otdel,document_status_now.name AS doc_status, document_status_now.id AS doc_status_id,
                 save_temp_files.id AS file_id ,save_temp_files.employee_id AS Sotrudnik, temp_doc_form.name,
                     form_status_now.id,form_step_action.user_action_name, form_step_action.action_triger, DATE(history_forms.step_end_time)AS step_end_time, temp_doc_form.name,type_form.name as form_type

                FROM  (form_status_now, temps_form_step, form_step_action, history_forms,
                  save_temp_files, company_temps, type_temp, type_form, temp_doc_form, employees)
                 LEFT JOIN employees_items_node ON employees_items_node.employe_id = employees.id
                LEFT JOIN organization_structure ON organization_structure.id = employees_items_node.org_str_id
                LEFT JOIN items_control ON items_control.id = organization_structure.kladr_id
                LEFT JOIN organization_structure AS org_par ON org_par.id = organization_structure.parent
                LEFT JOIN items_control AS PAR ON PAR.id = org_par.kladr_id
                LEFT JOIN document_status_now ON document_status_now.id = form_status_now.doc_status_now
                WHERE
                  temps_form_step.id = form_status_now.track_form_step_now
                  AND
                  form_step_action.id = temps_form_step.action_form
                  AND
                  form_status_now.history_form_id = history_forms.id
                  AND
                  form_status_now.save_temps_file_id = save_temp_files.id
						AND
                  save_temp_files.company_temps_id = company_temps.id

                  AND type_temp.type_form_id = type_form.id

                  AND company_temps.temp_type_id = type_temp.id
                  AND company_temps.company_id =  14
                  AND employees.id = save_temp_files.employee_id";

        // частичный доступ у сотрудика котрый запрашивает отчёт
        if(($left!='none')&&($left!="all")) {
            $sql .= " AND organization_structure.left_key >= " . $left . "
                AND organization_structure.right_key<= " . $right . "
                GROUP BY save_temp_files.id
                                            ORDER BY  emp";
        }

        // полный доступ на данные у сотрудника которые запрашивает отчёт
        if($left=='all') {
            $sql .= " GROUP BY save_temp_files.id
                                            ORDER BY  emp";
        }

        // без доступа, отчёт не показываеи
        if($left=='none') {
            $result_status = "error";
            $cron_task = "mail_to_org";
            $comment = "У пользователя нет доступа на получение отчётов - ". $observer_emplyoee_id ;
            $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
            $db->query($sql);
        } else {


            $docs_array = $db->all($sql);
            $coutn = 0;
            foreach ($docs_array as $key => $docs_array_item) {

                if ($docs_array_item['file_id'] == "") {
                    $sheet->setCellValueByColumnAndRow(0, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(0, $key + 3, $docs_array_item['file_id']);
                }
                if ($docs_array_item['fio'] == "") {
                    $sheet->setCellValueByColumnAndRow(1, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(1, $key + 3, $docs_array_item['fio']);
                }
                if ($docs_array_item['otdel'] == "") {
                    $sheet->setCellValueByColumnAndRow(2, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(2, $key + 3, $docs_array_item['otdel']);
                }
                if ($docs_array_item['dol'] == "") {
                    $sheet->setCellValueByColumnAndRow(3, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(3, $key + 3, $docs_array_item['dol']);
                }
                if ($docs_array_item['name'] == "") {
                    $sheet->setCellValueByColumnAndRow(4, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(4, $key + 3, $docs_array_item['name']);
                }
                if ($docs_array_item['form_type'] == "") {
                    $sheet->setCellValueByColumnAndRow(5, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(5, $key + 3, $docs_array_item['form_type']);
                }
                if ($docs_array_item['user_action_name'] == "") {
                    $sheet->setCellValueByColumnAndRow(6, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(6, $key + 3, $docs_array_item['user_action_name']);
                }
                if ($docs_array_item['doc_status'] == "") {
                    $sheet->setCellValueByColumnAndRow(7, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(7, $key + 3, $docs_array_item['doc_status']);
                }
                if ($docs_array_item['step_end_time'] == "") {
                    $sheet->setCellValueByColumnAndRow(8, $key + 3, " ");
                } else {
                    $sheet->setCellValueByColumnAndRow(8, $key + 3, $docs_array_item['step_end_time']);
                }


                $sheet->getStyle('D', $key + 3)->getAlignment()->setWrapText(true);
                $sheet->getStyle('E', $key + 3)->getAlignment()->setWrapText(true);
                $sheet->getStyle('G', $key + 3)->getAlignment()->setWrapText(true);
                $sheet->getStyle('B', $key + 3)->getAlignment()->setWrapText(true);
                $sheet->getStyle('H', $key + 3)->getAlignment()->setWrapText(true);
                $sheet->getStyle('D3')->getAlignment()->setWrapText(true);
                $sheet->getStyle('E3')->getAlignment()->setWrapText(true);
                $sheet->getStyle('G3')->getAlignment()->setWrapText(true);
                $sheet->getStyle('H3')->getAlignment()->setWrapText(true);
                $sheet->getStyle('B3')->getAlignment()->setWrapText(true);
                $coutn = $key + 3;
            }

            $sheet->getStyle('A1:I' . $coutn)->applyFromArray($styleArray);


            // Выводим HTTP-заголовк, только для вывода в браузер
//        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
//        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
//        header ( "Cache-Control: no-cache, must-revalidate" );
//        header ( "Pragma: no-cache" );
//        header ( "Content-type: application/vnd.ms-excel" );
//        header ( "Content-Disposition: attachment; filename=matrix.xls" );
            $file_url = 'C:\MAMP\htdocs\application\real_forms\report_two.xls';
            $objWriter_two = new PHPExcel_Writer_Excel5($xls_two);
//        $objWriter_two->save('php://output');
            $objWriter_two->save($file_url);

            if($email!="") {
                $this->mail_send($email, "Файл с отчётом", "Отчёт", $file_url);
                $result_status = "yes";
                $cron_task = "mail_to_org";
                $comment = "Отчёт по сотрудникам отправлен пользователю - ". $observer_emplyoee_id ;
                $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
                $db->query($sql);
            } else {
                $result_status = "error";
                $cron_task = "mail_to_org";
                $comment = "Отчёт по сотрудникам не отправлен, у пользователя нет почты - ". $observer_emplyoee_id ;
                $sql = "INSERT INTO `cron_history` (`result_status`, `cron_task`, `cron_date`, `comment`) VALUES( '". $result_status ."','". $cron_task ."',NOW(),'". $comment ."');";
                $db->query($sql);
            }


        }
    }
}
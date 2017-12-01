<?php

class Model_master_report{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }


    // Начинаем прохождение тестирования;
    public function main(){

        $emp_id = $this->post_array['emp_id'];
        $report_type = $this->post_array['report_type'];
        $str_date = $this->post_array['str_date'];
        $str_emp = $this->post_array['str_emp'];
        switch ($report_type) {
            case "test":
                $result_array = $this->test_emp_report($emp_id);
                break;
            case "emp":
                $result_array = $this->emp_emp_report($emp_id);
                break;
            case "doc":
                $result_array = $this->doc_emp_report($emp_id);
                break;
            case "test_doc":
                $result_array = $this->test_emp_report($emp_id);
                $content = '<br><label for="recipient-name" class="control-label">Отчёт по тестам:</label>';
                $content .= $result_array['content'];
                $result_array = $this->doc_emp_report($emp_id);
                $content .='<br><label for="recipient-name" class="control-label">Отчёт по документам:</label>';
                $content .= $result_array['content'];
                $result_array['content'] =  $content;
                break;
            case "fact_test_doc":
                $result_array = $this->fact_test_emp_report($emp_id);
                $content = '<br><label for="recipient-name" class="control-label">Отчёт по тестам:</label>';
                $content .= $result_array['content'];
                $result_array = $this->fact_doc_emp_report($emp_id);
                $content .='<br><label for="recipient-name" class="control-label">Отчёт по документам:</label>';
                $content .= $result_array['content'];
                $result_array['content'] =  $content;
                break;
            case "org_str_tree":
                $result_array = $this->org_str_tree();
                break;
            case "local_alert_journal":
                $result_array = $this->local_alert_journal();
                break;
            case "fact_local_alert_journal":
                $result_array = $this->fact_local_alert_journal();
                break;
            case "calendary_item":
                $result_array = $this->calendary_item($str_date);
                break;
            case "fact_calendary_item":
                $result_array = $this->fact_calendary_item($str_date);
                break;
            case "calendary_item_type_emp":
                $result_array = $this->calendary_item_type_emp($str_emp,$str_date);
                break;
            case "get_calendary_all_event":
                $result_array = $this->get_calendary_all_event($str_date);
                break;
            case "fact_get_calendary_all_event":
                $result_array = $this->fact_get_calendary_all_event($str_date);
                break;
            case "fact_calendary_item_type_emp":
                $result_array = $this->fact_calendary_item_type_emp($str_emp,$str_date);
                break;
        }

        $result_array['status'] = "ok";
        //
        $result = json_encode($result_array, true);
        die($result);
    }




    private function test_emp_report($emp_id){
        global $db;

        $sql ="SELECT
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

    route_doc.company_id = ". $_SESSION['control_company'] ."
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $_SESSION['control_company'] ."
    		AND org_parent.company_id = ". $_SESSION['control_company'] ."
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
    AND employees.id = ". $emp_id ."
    GROUP BY EMPLOY, STEP";


        $docs_array = $db->all($sql);
        $html = "<table id='table_test_emp_report_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <th>Документ</th>
                    <th>Начало</th>
                    <th>Окончание</th>
                </tr>
                </thead>
                <tbody>";
        foreach ($docs_array as $docs_array_item) {

            if($docs_array_item['StartStep'] == "Не начинал"){
                $class_one = "br_color";
            } else {
                $class_one = "";
            }
            if($docs_array_item['FinishStep'] == "Не прошел"){
                $class_two = "br_color";
            } else {
                $class_two = "";
            }
            // проверяем по фильтрам
                    $html .= '<tr>
                        <td>' . $docs_array_item['manual'] . '</td>
                        <td class = "'. $class_one .'" >' . $docs_array_item['StartStep'] . '</td>
                        <td class = "'. $class_two .'" >' . $docs_array_item['FinishStep'] . '</td>
                    </tr>';

        }
        $html .='</tbody> </table>';



        $result_array['content'] = $html;
        return $result_array;
    }


    private function fact_test_emp_report($emp_id){
        global $db;

        $sql ="SELECT
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
       LEFT JOIN fact_organization_structure ON employees_items_node.org_str_id = fact_organization_structure.id
       LEFT JOIN items_control ON items_control.id = fact_organization_structure.kladr_id
       /* находим родительскузел, должность и тип должности */
     LEFT JOIN fact_organization_structure AS org_parent
     ON (org_parent.left_key < fact_organization_structure.left_key AND org_parent.right_key > fact_organization_structure.right_key
     AND org_parent.level =(fact_organization_structure.level - 1) )
     LEFT JOIN items_control AS item_par ON item_par.id = org_parent.kladr_id
    LEFT JOIN items_control_types ON items_control_types.id = org_parent.items_control_id
     /* узлы с индивидуальными треками */
    LEFT JOIN fact_organization_structure AS TreeOfParents
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
              employees AS Empl, employees_items_node AS EmplItem, fact_organization_structure AS EmplOrg
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
     (fact_organization_structure.left_key >= TreeOfParents.left_key
     AND
     fact_organization_structure.right_key <= TreeOfParents.right_key)
     )
	AND	fact_organization_structure.company_id
   AND
   /* по фирме*/

    route_doc.company_id = ". $_SESSION['control_company'] ."
    		AND employees.id = employees_items_node.employe_id
    		AND fact_organization_structure.id = employees_items_node.org_str_id
    		AND fact_organization_structure.company_id = ". $_SESSION['control_company'] ."
    		AND org_parent.company_id = ". $_SESSION['control_company'] ."
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
    AND employees.id = ". $emp_id ."
    GROUP BY EMPLOY, STEP";


        $docs_array = $db->all($sql);
        $html = "<table id='table_test_emp_report_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <th>Документ</th>
                    <th>Начало</th>
                    <th>Окончание</th>
                </tr>
                </thead>
                <tbody>";
        foreach ($docs_array as $docs_array_item) {

            if($docs_array_item['StartStep'] == "Не начинал"){
                $class_one = "br_color";
            } else {
                $class_one = "";
            }
            if($docs_array_item['FinishStep'] == "Не прошел"){
                $class_two = "br_color";
            } else {
                $class_two = "";
            }
            // проверяем по фильтрам
            $html .= '<tr>
                        <td>' . $docs_array_item['manual'] . '</td>
                        <td class = "'. $class_one .'" >' . $docs_array_item['StartStep'] . '</td>
                        <td class = "'. $class_two .'" >' . $docs_array_item['FinishStep'] . '</td>
                    </tr>';

        }
        $html .='</tbody> </table>';



        $result_array['content'] = $html;
        return $result_array;
    }






    private function emp_emp_report($emp_id){
        global $db;

        $sql ="SELECT
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

    route_doc.company_id = ". $_SESSION['control_company'] ."
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $_SESSION['control_company'] ."
    		AND org_parent.company_id = ". $_SESSION['control_company'] ."
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
    AND employees.id = ". $emp_id ."
    GROUP BY EMPLOY, STEP";


        $docs_array = $db->all($sql);
        $html = "";
        foreach ($docs_array as $docs_array_item) {
            // проверяем по фильтрам
            $html .= '<hr><div class="row">
                        <div  class="col-md-4">' . $docs_array_item['manual'] . '</div>
                        <div class="col-md-4">' . $docs_array_item['StartStep'] . '</div>
                        <div  class="col-md-4">' . $docs_array_item['FinishStep'] . '</div>
                    </div>';

        }

        $result_array['content'] = $html;
        return $result_array;
    }

    private function doc_emp_report($emp_id){
        global $db;

        $sql ="SELECT
/* Вывод даннных */
form_status_now.save_temps_file_id AS ID_FILES,
temp_doc_form.name AS name_doc, type_form.name AS type_doc, form_status_now.step_id, form_step_action.user_action_name AS action,
  employees.id AS EMPLOY, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
   route_control_step.id AS STEP, route_control_step.`periodicity`, history_docs.`id` AS history_docs,history_docs.date_finish,
   /* условный вывод */
 	/* чтобы выводить все записи без учёта переодики, оставитьтолько
	MIN(history_docs.date_start) в условии NULL в CASE*/
  CASE
   WHEN (history_docs.date_finish IS NULL)
			OR
			((route_control_step.periodicity is not NULL)
			 	AND
			( NOW() > (history_docs.date_start + INTERVAL route_control_step.periodicity MONTH)))
   THEN 'Ещё не создан'
   ELSE document_status_now.name
   END AS DoC_Status,

  items_control.name AS DOL,document_status_now.id AS doc_status_id,form_step_action.action_triger,
  /* клеем фио */
   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir

  FROM (route_control_step,route_doc,employees)
  LEFT JOIN
    history_docs
    /* история документов по шагам */
    ON (history_docs.step_id = route_control_step.id
       AND
       history_docs.employee_id = employees.id
       /* чтобы выводить все записи без учёта переодики, убрать этот AND*** */
       AND
		 		((route_control_step.periodicity is NULL)
		 		OR
				( NOW() < (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH))
				OR
				( NOW() < (history_docs.date_start + INTERVAL route_control_step.periodicity MONTH)))
       )
       /* достяём докуменны*/
       LEFT JOIN step_content ON step_content.id = route_control_step.step_content_id
       LEFT JOIN company_temps ON step_content.form_id = company_temps.id
		 LEFT JOIN type_temp ON type_temp.id =  company_temps.temp_type_id
		 LEFT JOIN temp_doc_form ON temp_doc_form.id = type_temp.temp_form_id
		 LEFT JOIN type_form ON type_form.id =  type_temp.type_form_id
		 /* пошли за экшенами*/
		 LEFT JOIN form_status_now ON (form_status_now.step_id = route_control_step.id
		 										AND
												 form_status_now.author_employee_id = employees.id)
		 LEFT JOIN temps_form_step ON temps_form_step.id = form_status_now.track_form_step_now
		 LEFT JOIN form_step_action ON form_step_action.id = temps_form_step.action_form
		 LEFT JOIN document_status_now ON document_status_now.id = form_status_now.doc_status_now

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
	AND	organization_structure.company_id
   AND
   /* по фирме*/

    route_doc.company_id = ". $_SESSION['control_company'] ."
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $_SESSION['control_company'] ."
    		AND org_parent.company_id = ". $_SESSION['control_company'] ."
    		/* только те шаги где надо создать документы */
	     AND step_content.form_id is not NULL
   		AND (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
   		AND employees.id =  ". $emp_id ."
   		GROUP BY EMPLOY, STEP, name_doc";



        $docs_array = $db->all($sql);
        $html = "<table id='table_doc_emp_report_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <td>Документ</td>
                    <td>Начало</td>
                    <td>Окончание</td>
                </tr>
                </thead>
                <tbody>";

        foreach ($docs_array as $docs_array_item) {
            if($docs_array_item['DoC_Status']=="Ещё не создан"){
                $class_one = "br_color";
            } else {
                $class_one = "";
            }
            // проверяем по фильтрам
            $html .= '<tr>
                        <td>' . $docs_array_item['name_doc'] . '</td>
                        <td>' . $docs_array_item['action'] . '</td>
                        <td class = "'. $class_one .'" >' . $docs_array_item['DoC_Status'] . '</td>
                    </tr>';

        }
        $html .= '</tbody> </table>';

        $result_array['content'] = $html;
        return $result_array;
    }



    private function fact_doc_emp_report($emp_id){
        global $db;

        $sql ="SELECT
/* Вывод даннных */
form_status_now.save_temps_file_id AS ID_FILES,
temp_doc_form.name AS name_doc, type_form.name AS type_doc, form_status_now.step_id, form_step_action.user_action_name AS action,
  employees.id AS EMPLOY, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
   route_control_step.id AS STEP, route_control_step.`periodicity`, history_docs.`id` AS history_docs,history_docs.date_finish,
   /* условный вывод */
 	/* чтобы выводить все записи без учёта переодики, оставитьтолько
	MIN(history_docs.date_start) в условии NULL в CASE*/
  CASE
   WHEN (history_docs.date_finish IS NULL)
			OR
			((route_control_step.periodicity is not NULL)
			 	AND
			( NOW() > (history_docs.date_start + INTERVAL route_control_step.periodicity MONTH)))
   THEN 'Ещё не создан'
   ELSE document_status_now.name
   END AS DoC_Status,

  items_control.name AS DOL,document_status_now.id AS doc_status_id,form_step_action.action_triger,
  /* клеем фио */
   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir

  FROM (route_control_step,route_doc,employees)
  LEFT JOIN
    history_docs
    /* история документов по шагам */
    ON (history_docs.step_id = route_control_step.id
       AND
       history_docs.employee_id = employees.id
       /* чтобы выводить все записи без учёта переодики, убрать этот AND*** */
       AND
		 		((route_control_step.periodicity is NULL)
		 		OR
				( NOW() < (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH))
				OR
				( NOW() < (history_docs.date_start + INTERVAL route_control_step.periodicity MONTH)))
       )
       /* достяём докуменны*/
       LEFT JOIN step_content ON step_content.id = route_control_step.step_content_id
       LEFT JOIN company_temps ON step_content.form_id = company_temps.id
		 LEFT JOIN type_temp ON type_temp.id =  company_temps.temp_type_id
		 LEFT JOIN temp_doc_form ON temp_doc_form.id = type_temp.temp_form_id
		 LEFT JOIN type_form ON type_form.id =  type_temp.type_form_id
		 /* пошли за экшенами*/
		 LEFT JOIN form_status_now ON (form_status_now.step_id = route_control_step.id
		 										AND
												 form_status_now.author_employee_id = employees.id)
		 LEFT JOIN temps_form_step ON temps_form_step.id = form_status_now.track_form_step_now
		 LEFT JOIN form_step_action ON form_step_action.id = temps_form_step.action_form
		 LEFT JOIN document_status_now ON document_status_now.id = form_status_now.doc_status_now

       /* привязка сотрудника к должности */
       LEFT JOIN employees_items_node ON employees_items_node.employe_id = employees.id
       LEFT JOIN fact_organization_structure ON employees_items_node.org_str_id = fact_organization_structure.id
       LEFT JOIN items_control ON items_control.id = fact_organization_structure.kladr_id
       /* находим родительскузел, должность и тип должности */
     LEFT JOIN fact_organization_structure AS org_parent
     ON (org_parent.left_key < fact_organization_structure.left_key AND org_parent.right_key > fact_organization_structure.right_key
     AND org_parent.level =(fact_organization_structure.level - 1) )
     LEFT JOIN items_control AS item_par ON item_par.id = org_parent.kladr_id
    LEFT JOIN items_control_types ON items_control_types.id = org_parent.items_control_id
     /* узлы с индивидуальными треками */
    LEFT JOIN fact_organization_structure AS TreeOfParents
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
              employees AS Empl, employees_items_node AS EmplItem, fact_organization_structure AS EmplOrg
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
     (fact_organization_structure.left_key >= TreeOfParents.left_key
     AND
     fact_organization_structure.right_key <= TreeOfParents.right_key)
     )
	AND	fact_organization_structure.company_id
   AND
   /* по фирме*/

    route_doc.company_id = ". $_SESSION['control_company'] ."
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $_SESSION['control_company'] ."
    		AND org_parent.company_id = ". $_SESSION['control_company'] ."
    		/* только те шаги где надо создать документы */
	     AND step_content.form_id is not NULL
   		AND (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
   		AND employees.id =  ". $emp_id ."
   		GROUP BY EMPLOY, STEP, name_doc";



        $docs_array = $db->all($sql);
        $html = "<table id='table_doc_emp_report_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <td>Документ</td>
                    <td>Начало</td>
                    <td>Окончание</td>
                </tr>
                </thead>
                <tbody>";

        foreach ($docs_array as $docs_array_item) {
            if($docs_array_item['DoC_Status']=="Ещё не создан"){
                $class_one = "br_color";
            } else {
                $class_one = "";
            }
            // проверяем по фильтрам
            $html .= '<tr>
                        <td>' . $docs_array_item['name_doc'] . '</td>
                        <td>' . $docs_array_item['action'] . '</td>
                        <td class = "'. $class_one .'" >' . $docs_array_item['DoC_Status'] . '</td>
                    </tr>';

        }
        $html .= '</tbody> </table>';

        $result_array['content'] = $html;
        return $result_array;
    }


    public function org_str_tree(){

        global $db;


        $sql="SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                organization_structure.parent,
                organization_structure.items_control_id,
                employees.`status`,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id = " . $_SESSION['control_company'] . "
                AND organization_structure.left_key > 0
                 ORDER BY left_key";


        $tree = $db->all($sql);

        $level_array = array();
        foreach ($tree as $test_item) {
            $level_array[] = $test_item['level'];
        }
        // оставляем все уникальные уровни и сортируем по возрастанию
        $level_array = array_unique($level_array);
        asort($level_array);
        $html='<ul id="tree_main" class="tree">%parent_0%</ul>';
        foreach ($level_array as $level_array_item) {
            foreach($tree as $tree_item) {
                if($tree_item['level'] == $level_array_item) {
                    $parent_id = $tree_item['parent'];
                    $item_html = '<ul class="none">';
                    foreach($tree as $tree_item) {
                        if($tree_item['parent']==$parent_id){

                            $left_key = str_pad($tree_item['left_key'] , 5, "0", STR_PAD_LEFT);
                            $right_key = str_pad($tree_item['right_key'] , 5, "0", STR_PAD_LEFT);
                            $plus_class = "";
                            if($tree_item['items_control_id'] != 3){
                                $plus_class = "pluses";
                            }

                            $item_html .= '<li><div class="tree_item ' .$plus_class .'" level="' . $tree_item['level'] .'" parent="' . $tree_item['parent'] . '"id_item="' . $tree_item['id'] . '"left_key="' . $left_key . '"right_key="' . $right_key . '"  erarh="'. $tree_item['erarh'] .'">' . $tree_item['erarh'] . '</div>';
                            if ($tree_item['fio'] != "") {
                                $item_html .= '<div class="tree_item_fio">' . $tree_item['fio'] . '</div>';
                            }
                            $item_html .= "%parent_".$tree_item['id']."%";;
                            $item_html .= '</li>';
                        }
                    }
                    $item_html .= '</ul>';

                    // вставляем по сгенерированному ключу
                    $anchor = "%parent_".$parent_id."%";
                    $flag   = '<li>';
                    $pos = strpos($item_html, $flag);
                    // если есть что вставить вставляем
                    if ($pos === false) {
                        $html = str_replace($anchor, "", $html);
                    } else {
                        $html = str_replace($anchor, $item_html, $html);
                    }
                }
            }
        }
        // убираем оставшиеся якоря
        foreach($tree as $tree_item) {
            $anchor = "%parent_".$tree_item['id']."%";
            $html = str_replace($anchor, "", $html);
        }
        // убираем "Должность:"
        foreach($tree as $tree_item) {
            $html = str_replace("Должность:", "", $html);
        }
        if($html == '<ul id="tree_main" class="tree">%parent_0%</ul>'){
            $html = "Нет данных";
        }
        $result_array['role'] = $_SESSION['role_id'];
        $result_array['content'] = $html;

        return $result_array;
    }


    private function local_alert_journal(){
        global $db, $labro;
        $search_string = $this->post_array['search_string'];
        $open_action = $this->post_array['open_action'];
        $open_emp = $this->post_array['open_emp'];

        // границы дозволенного
        $keys =  $labro->observer_keys($_SESSION['employee_id']);
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];

        $observer = $labro->get_org_str_id($_SESSION['employee_id']);

        $html = "";

        $sql = "(SELECT local_alerts.observer_org_str_id, local_alerts.save_temp_files_id, save_temp_files.name AS file, local_alerts.id,local_alerts.action_type_id,
                    form_step_action.action_name,form_step_action.user_action_name,
                    CONCAT_WS (' ',init_em.surname , init_em.name, init_em.second_name) AS fio, local_alerts.step_id,init_em.id AS em_id,
                    local_alerts.date_create,   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir,
                    items_control.name AS `position`,document_status_now.name as doc_status, route_control_step.step_name AS manual,
                    document_status_now.id AS doc_trigger
                    FROM (local_alerts,employees_items_node, employees AS init_em,
                    cron_action_type, form_step_action , organization_structure AS bounds)
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

                    WHERE local_alerts.company_id = " . $_SESSION['control_company'] . "

                        AND local_alerts.initiator_employee_id = init_em.id
                        AND form_step_action.id = local_alerts.action_type_id
                        AND local_alerts.date_finish IS NULL
                        AND employees_items_node.employe_id =  local_alerts.initiator_employee_id
                        AND employees_items_node.org_str_id = bounds.id
                        AND
                        (
                            ( organization_structure.left_key > " . $node_left_key . "
                                AND organization_structure.right_key < " . $node_right_key . "
                            )
                            OR local_alerts.observer_org_str_id = ". $observer ."
                        )
                         GROUP BY local_alerts.id   )
     UNION
     (SELECT local_alerts.observer_org_str_id, local_alerts.save_temp_files_id, NULL,NULL, local_alerts.action_type_id,NULL, NULL,CONCAT_WS (' ',sump_for_employees.surname , sump_for_employees.name, sump_for_employees.patronymic) AS fio,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL
		FROM local_alerts, sump_for_employees,organization_structure
		WHERE local_alerts.action_type_id IN (17,18,19)
		AND local_alerts.company_id =  " . $_SESSION['control_company'] . "
		AND sump_for_employees.dol_id = organization_structure.id
      AND
                        (
                            ( organization_structure.left_key > " . $node_left_key . "
                                AND organization_structure.right_key < " . $node_right_key . "
                            )
                            OR local_alerts.observer_org_str_id = ". $observer ."
                        )
		AND sump_for_employees.id = local_alerts.save_temp_files_id)";
        $alert_every_days = $db->all($sql);
        $count = 0;
        foreach ($alert_every_days as $alert_every_day) {
            // подготовка строк к сравнению
            $fio_s = $alert_every_day['fio'];
            $fio_s = mb_strtolower($fio_s);
            $fio_s = str_replace(" ", "", $fio_s);

            $file_s = $alert_every_day['file'];
            $file_s = mb_strtolower($file_s);
            $file_s = str_replace(" ", "", $file_s);

            $search_string = mb_strtolower($search_string);
            $search_string = str_replace(" ", "", $search_string);

            if((mb_stripos($fio_s, $search_string ) !== false ) || (mb_stripos($file_s, $search_string) !== false) || ($search_string == "")) {
                    // если есть запрост на откытие какойто карточки на клиенте и наблюдатель не отдел кадров тогда накидываем спец класс
                if($alert_every_day['em_id'] == $open_emp && $open_emp!="" && $open_action == $alert_every_day['action_type_id'] && $open_action!="" && $alert_every_day['observer_org_str_id'] == $observer && $observer != 166){
                    $open_class = "click_li";
                } else {
                    $open_class = "";
                }

                // лимит
                if ($count < 7) {
                    $html .= '<li class="'. $open_class .'">
                <span class="text alert_row" action_type="' . $alert_every_day['action_type_id'] . '"
                                                    observer_em=' . $_SESSION['employee_id'] . '
                                                    dol="' . $alert_every_day['position'] . '"
                                                    emp="' . $alert_every_day['em_id'] . '"
                                                    doc_trigger="' . $alert_every_day['doc_trigger'] . '"
                                                     dir="' . $alert_every_day['dir'] . '"
                                                     doc="' . $alert_every_day['file'] . '"
                                                     name="' . $alert_every_day['fio'] . '"
                                                     local_id="' . $alert_every_day['id'] . '"
                                                      file_id="' . $alert_every_day['save_temp_files_id'] . '"
                  style=" font-size: 13px;width: 75%;cursor: pointer;">' . $alert_every_day['fio'] . " / " . $alert_every_day['file'] . '</span>
                    <small class="label label-danger" style="line-height: 31px;" ><i class="fa fa-clock-o"></i> ' . date_create($alert_every_day['date_create'])->Format('d-m-Y') . '</small>
                <div class="tools" style="display: none">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>';
                }
                ++$count;
            }
        }


        $result_array['content'] = $html;
        return $result_array;
    }

    private function fact_local_alert_journal(){
        global $db;
        $search_string = $this->post_array['search_string'];

        $html = "";

        $sql = "(SELECT local_alerts.save_temp_files_id, save_temp_files.name AS file, local_alerts.id,local_alerts.action_type_id,
                    form_step_action.action_name,form_step_action.user_action_name,
                    CONCAT_WS (' ',init_em.surname , init_em.name, init_em.second_name) AS fio, local_alerts.step_id,init_em.id AS em_id,
                    local_alerts.date_create,   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir,
                    items_control.name AS `position`,document_status_now.name as doc_status, route_control_step.step_name AS manual,
                    document_status_now.id AS doc_trigger
                    FROM (local_alerts,employees_items_node, employees AS init_em,
                    cron_action_type, form_step_action)
                    LEFT JOIN employees_items_node AS NODE ON NODE.employe_id = local_alerts.initiator_employee_id
                    LEFT JOIN fact_organization_structure ON fact_organization_structure.id = NODE.org_str_id
                    LEFT JOIN items_control ON items_control.id = fact_organization_structure.kladr_id
                    LEFT JOIN fact_organization_structure AS org_parent
                    ON (org_parent.left_key < fact_organization_structure.left_key AND org_parent.right_key > fact_organization_structure.right_key
                        AND org_parent.level =(fact_organization_structure.level - 1) )
                    LEFT JOIN items_control AS item_par ON item_par.id = org_parent.kladr_id
                    LEFT JOIN items_control_types ON items_control_types.id = org_parent.items_control_id

                    LEFT JOIN form_status_now ON form_status_now.save_temps_file_id = local_alerts.save_temp_files_id
                    LEFT JOIN document_status_now ON document_status_now.id = form_status_now.doc_status_now
                    LEFT JOIN save_temp_files ON save_temp_files.id = local_alerts.save_temp_files_id
                    LEFT JOIN route_control_step ON route_control_step.`id`= local_alerts.step_id

                    WHERE local_alerts.company_id = ". $_SESSION['control_company'] ."

                        AND local_alerts.initiator_employee_id = init_em.id
                        AND form_step_action.id = local_alerts.action_type_id
                        AND local_alerts.date_finish IS NULL
                         GROUP BY local_alerts.id ";

        $sql.=" )
     UNION
     (SELECT local_alerts.save_temp_files_id, NULL,NULL, local_alerts.action_type_id,NULL, NULL,CONCAT_WS (' ',sump_for_employees.surname , sump_for_employees.name, sump_for_employees.patronymic) AS fio,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL
		FROM local_alerts, sump_for_employees
		WHERE local_alerts.action_type_id = 17
		AND local_alerts.company_id =  " . $_SESSION['control_company'] . "
		AND sump_for_employees.id = local_alerts.save_temp_files_id )";
        $alert_every_days = $db->all($sql);
        $count = 0;
        foreach ($alert_every_days as $alert_every_day) {
            // подготовка строк к сравнению
            $fio_s = $alert_every_day['fio'];
            $fio_s = mb_strtolower($fio_s);
            $fio_s = str_replace(" ", "", $fio_s);

            $file_s = $alert_every_day['file'];
            $file_s = mb_strtolower($file_s);
            $file_s = str_replace(" ", "", $file_s);

            $search_string = mb_strtolower($search_string);
            $search_string = str_replace(" ", "", $search_string);

            if((mb_stripos($fio_s, $search_string ) !== false ) || (mb_stripos($file_s, $search_string) !== false) || ($search_string == "")) {

                // лимит
                if ($count < 7) {
                    $html .= '<li>
                <!-- todo text -->
                <span class="text alert_row" action_type="' . $alert_every_day['action_type_id'] . '"
                                                    observer_em=' . $_SESSION['employee_id'] . '
                                                    dol="' . $alert_every_day['position'] . '"
                                                    emp="' . $alert_every_day['em_id'] . '"
                                                    doc_trigger="' . $alert_every_day['doc_trigger'] . '"
                                                     dir="' . $alert_every_day['dir'] . '"
                                                     doc="' . $alert_every_day['file'] . '"
                                                     name="' . $alert_every_day['fio'] . '"
                                                     local_id="' . $alert_every_day['id'] . '"
                                                      file_id="' . $alert_every_day['save_temp_files_id'] . '"
                  style=" font-size: 13px;width: 75%;cursor: pointer;">' . $alert_every_day['fio'] . " / " . $alert_every_day['file'] . '</span>
                <!-- Emphasis label -->
                    <small class="label label-danger" style="line-height: 31px;" ><i class="fa fa-clock-o"></i> ' . date_create($alert_every_day['date_create'])->Format('d-m-Y') . '</small>
                <!-- General tools such as edit or delete-->
                <div class="tools" style="display: none">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
            </li>';
                }
                ++$count;
            }
        }


        $result_array['content'] = $html;
        return $result_array;
    }


    private function calendary_item($str_date){
        global $db;
        $today = date("Y-m-d");


        $sql="SELECT
/* Вывод даннных */
route_control_step.track_number_id AS id,
  employees.id AS employee_id,
  route_control_step.id AS ID_STEP,
   employees.start_date as employees_start,
   history_docs.date_finish,
     route_control_step.`periodicity`,
   CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
  route_control_step.step_name
  FROM (route_control_step,route_doc,employees)
  LEFT JOIN
    history_docs
    /* история документов по шагам */
    ON (history_docs.step_id = route_control_step.id
       AND
       history_docs.employee_id = employees.id
       /* чтобы выводить все записи без учёта переодики, убрать этот AND*** */
       AND
		 		((route_control_step.periodicity is NULL)
		 		OR
				( NOW() < (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH))
				OR
				( NOW() < (history_docs.date_start + INTERVAL route_control_step.periodicity MONTH)))
       )
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
	AND	organization_structure.company_id
   AND
   /* по фирме*/

    route_doc.company_id = organization_structure.company_id
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = org_parent.company_id
    		AND org_parent.company_id = " . $_SESSION['control_company'] . "
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
      GROUP BY employee_id, ID_STEP";
        $briefings = $db->all($sql);
        $result_array = array();

        foreach ($briefings as $key=>$briefing) {
            $result_array [$key]['step_name']= $briefing['step_name'];
            $result_array [$key]['id']= $briefing['id'];
            $result_array [$key]['fio']= $briefing['fio'];
            $result_array [$key]['emp']= $briefing['employee_id'];
            $result_array [$key]['start']= $briefing['employees_start'];
            $result_array [$key]['end']= $briefing['employees_start'];
            $result_array [$key]['periodicity']= $briefing['periodicity'];
            $result_array [$key]['data_finish'] = $briefing['date_finish'];
            $result_array [$key]['textColor']= '#fff';

            $periodicity = $briefing['periodicity'];


            // выставляем дату и приводим к одному виду
            $result_array [$key]['start'] = $briefing['employees_start'];
            if($periodicity > 0 ){
                if($briefing['date_finish']){
                    // как много времени прошло с момента прохождения
                    if((strtotime("+".$periodicity." month", strtotime($briefing['date_finish']))) >= (strtotime("-7 day", strtotime($today)))){
                        // если период ещё не закончился
                        $result_array [$key]['start'] = date_create($briefing['date_finish'])->Format('Y-m-d');
                    } else {
                        // если период закончился - назначаем новый срок прохождения
                        $next_data =  (strtotime("+".$periodicity." month", strtotime($briefing['date_finish'])));
                        $result_array [$key]['start'] =  date_create($next_data)->Format('Y-m-d');
                    }
                } else {
                    // сотрудник не проходил с момента трудоустройства
                }
            } else {
                //  если нет периодики и инструктаж пройден
                if($briefing['date_finish']){
                    $result_array [$key]['start'] = date_create($briefing['date_finish'])->Format('Y-m-d');
                }
            }

        }// конец цикла

        // перебираем для схлопывания по дате
        $html = "<table id='calendary_item_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <td><b>Сотрудник</b></td>
                    <td><b>Инструктаж</b></td>
                    <td><b>Дата</b></td>
                </tr>
                </thead>
                <tbody>";

                foreach ($result_array as $item) {
                    if(($item['start'] == $str_date) && ($item['step_name'] !="")){
                        $html .= '<tr>
                        <td>' . $item['fio'] . '</td>
                        <td>' . $item['step_name'] . '</td>
                        <td>' . $item['start'] . '</td>
                    </tr>';
                    }
                }

        $html .= '</tbody> </table>';





        $result_array['content'] = $html;
        return $result_array;
    }



    private function fact_calendary_item($str_date){
        global $db;
        $today = date("Y-m-d");


        $sql="SELECT
/* Вывод даннных */
route_control_step.track_number_id AS id,
  employees.id AS employee_id,
  route_control_step.id AS ID_STEP,
   employees.start_date as employees_start,
   history_docs.date_finish,
     route_control_step.`periodicity`,
   CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
  route_control_step.step_name
  FROM (route_control_step,route_doc,employees)
  LEFT JOIN
    history_docs
    /* история документов по шагам */
    ON (history_docs.step_id = route_control_step.id
       AND
       history_docs.employee_id = employees.id
       /* чтобы выводить все записи без учёта переодики, убрать этот AND*** */
       AND
		 		((route_control_step.periodicity is NULL)
		 		OR
				( NOW() < (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH))
				OR
				( NOW() < (history_docs.date_start + INTERVAL route_control_step.periodicity MONTH)))
       )
       /* привязка сотрудника к должности */
       LEFT JOIN employees_items_node ON employees_items_node.employe_id = employees.id
       LEFT JOIN fact_organization_structure ON employees_items_node.org_str_id = fact_organization_structure.id
       LEFT JOIN items_control ON items_control.id = fact_organization_structure.kladr_id
       /* находим родительскузел, должность и тип должности */
     LEFT JOIN fact_organization_structure AS org_parent
     ON (org_parent.left_key < fact_organization_structure.left_key AND org_parent.right_key > fact_organization_structure.right_key
     AND org_parent.level =(fact_organization_structure.level - 1) )
     LEFT JOIN items_control AS item_par ON item_par.id = org_parent.kladr_id
    LEFT JOIN items_control_types ON items_control_types.id = org_parent.items_control_id
     /* узлы с индивидуальными треками */
    LEFT JOIN fact_organization_structure AS TreeOfParents
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
              employees AS Empl, employees_items_node AS EmplItem, fact_organization_structure AS EmplOrg
            WHERE
              Empl.id = EmplItem.employe_id
              AND
              EmplItem.org_str_id=EmplOrg.id
              )
    )
    AND
    /* для всех узлов или конкретных узлов по конкретным сотрудникам */
    (route_doc.fact_organization_structure IS NULL
   OR
     (fact_organization_structure.left_key >= TreeOfParents.left_key
     AND
     fact_organization_structure.right_key <= TreeOfParents.right_key)
     )
	AND	fact_organization_structure.company_id
   AND
   /* по фирме*/

    route_doc.company_id = fact_organization_structure.company_id
    		AND employees.id = employees_items_node.employe_id
    		AND fact_organization_structure.id = employees_items_node.org_str_id
    		AND fact_organization_structure.company_id = org_parent.company_id
    		AND org_parent.company_id = " . $_SESSION['control_company'] . "
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
      GROUP BY employee_id, ID_STEP";
        $briefings = $db->all($sql);
        $result_array = array();

        foreach ($briefings as $key=>$briefing) {
            $result_array [$key]['step_name']= $briefing['step_name'];
            $result_array [$key]['id']= $briefing['id'];
            $result_array [$key]['fio']= $briefing['fio'];
            $result_array [$key]['emp']= $briefing['employee_id'];
            $result_array [$key]['start']= $briefing['employees_start'];
            $result_array [$key]['end']= $briefing['employees_start'];
            $result_array [$key]['periodicity']= $briefing['periodicity'];
            $result_array [$key]['data_finish'] = $briefing['date_finish'];
            $result_array [$key]['textColor']= '#fff';

            $periodicity = $briefing['periodicity'];


            // выставляем дату и приводим к одному виду
            $result_array [$key]['start'] = $briefing['employees_start'];
            if($periodicity > 0 ){
                if($briefing['date_finish']){
                    // как много времени прошло с момента прохождения
                    if((strtotime("+".$periodicity." month", strtotime($briefing['date_finish']))) >= (strtotime("-7 day", strtotime($today)))){
                        // если период ещё не закончился
                        $result_array [$key]['start'] = date_create($briefing['date_finish'])->Format('Y-m-d');
                    } else {
                        // если период закончился - назначаем новый срок прохождения
                        $next_data =  (strtotime("+".$periodicity." month", strtotime($briefing['date_finish'])));
                        $result_array [$key]['start'] =  date_create($next_data)->Format('Y-m-d');
                    }
                } else {
                    // сотрудник не проходил с момента трудоустройства
                }
            } else {
                //  если нет периодики и инструктаж пройден
                if($briefing['date_finish']){
                    $result_array [$key]['start'] = date_create($briefing['date_finish'])->Format('Y-m-d');
                }
            }

        }// конец цикла

        // перебираем для схлопывания по дате
        $html = "<table id='calendary_item_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <td><b>Сотрудник</b></td>
                    <td><b>Инструктаж</b></td>
                    <td><b>Дата</b></td>
                </tr>
                </thead>
                <tbody>";

        foreach ($result_array as $item) {
            if(($item['start'] == $str_date) && ($item['step_name'] !="")){
                $html .= '<tr>
                        <td>' . $item['fio'] . '</td>
                        <td>' . $item['step_name'] . '</td>
                        <td>' . $item['start'] . '</td>
                    </tr>';
            }
        }

        $html .= '</tbody> </table>';
        $result_array['content'] = $html;
        return $result_array;
    }

    private function calendary_item_type_emp($str_emp,$str_date){
        global $db;
        $today = date("Y-m-d");
        $sql="SELECT route_doc.id,
                      employees.id as employee_id,
                      CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
                      route_control_step.id AS step_id,
                      employees.start_date as employees_start,
                      history_step.data_finish,
                      route_control_step.periodicity,
                      route_control_step.step_name as step_name
                     FROM (employees,organization_structure, employees_items_node)
                         LEFT JOIN route_doc  ON ((route_doc.company_id = organization_structure.company_id)
                                                         AND
                                                         ((route_doc.employee_id = employees.id)
                                                             OR
                                                             (route_doc.item_type_id = organization_structure.kladr_id)
                                                             OR
                                                             (organization_structure.id IN (SELECT org_child.id
                                                                 FROM (organization_structure,route_doc)
                                                                     LEFT JOIN organization_structure AS org_child ON (org_child.left_key >= organization_structure.left_key
                                                                                                                                         AND
                                                                                                                                         org_child.right_key <= organization_structure.right_key
                                                                                                                                         AND
                                                                                                                                         org_child.company_id = organization_structure.company_id)
                                                                 WHERE  organization_structure.id = route_doc.organization_structure_id
                                                                 AND route_doc.company_id = " . $_SESSION['control_company'] . "))))

                                LEFT JOIN route_control_step ON route_control_step.track_number_id = route_doc.id

                          LEFT JOIN history_step ON (history_step.employee_id = employees.id
                                                                 AND
                                                             history_step.step_id = route_control_step.id)

                     WHERE organization_structure.company_id = " . $_SESSION['control_company'] . "
                     AND employees_items_node.employe_id = employees.id
                     AND organization_structure.id = employees_items_node.org_str_id
                     AND route_doc.id is not NULL

                     ORDER BY employee_id";


        $briefings = $db->all($sql);
        $result_array = array();

        foreach ($briefings as $key=>$briefing) {
            $result_array [$key]['step_name']= $briefing['step_name'];
            $result_array [$key]['id']= $briefing['id'];
            $result_array [$key]['fio']= $briefing['fio'];
            $result_array [$key]['emp']= $briefing['employee_id'];
            $result_array [$key]['start']= $briefing['employees_start'];
            $result_array [$key]['end']= $briefing['employees_start'];
            $result_array [$key]['periodicity']= $briefing['periodicity'];
            $result_array [$key]['data_finish'] = $briefing['data_finish'];
            $result_array [$key]['textColor']= '#fff';

            $periodicity = $briefing['periodicity'];


            // выставляем дату и приводим к одному виду
            $result_array [$key]['start'] = $briefing['employees_start'];
            if($periodicity > 0 ){
                if($briefing['data_finish']){
                    // как много времени прошло с момента прохождения
                    if((strtotime("+".$periodicity." month", strtotime($briefing['data_finish']))) >= (strtotime("-7 day", strtotime($today)))){
                        // если период ещё не закончился
                        $result_array [$key]['start'] = date_create($briefing['data_finish'])->Format('Y-m-d');
                    } else {
                        // если период закончился - назначаем новый срок прохождения
                        $next_data =  (strtotime("+".$periodicity." month", strtotime($briefing['data_finish'])));
                        $result_array [$key]['start'] =  date_create($next_data)->Format('Y-m-d');
                    }
                } else {
                    // сотрудник не проходил с момента трудоустройства
                }
            } else {
                //  если нет периодики и инструктаж пройден
                if($briefing['data_finish']){
                    $result_array [$key]['start'] = date_create($briefing['data_finish'])->Format('Y-m-d');
                }
            }

        }// конец цикла

        // перебираем для схлопывания по дате
        $html = "<table id='calendary_item_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <td><b>Сотрудник</b></td>
                    <td><b>Инструктаж</b></td>
                    <td><b>Дата</b></td>
                </tr>
                </thead>
                <tbody>";

        foreach ($result_array as $item) {
            if(($item['emp'] == $str_emp) && ($item['start'] == $str_date) && ($item['step_name'] !="")){
                $html .= '<tr>
                        <td>' . $item['fio'] . '</td>
                        <td>' . $item['step_name'] . '</td>
                        <td>' . $item['start'] . '</td>
                    </tr>';
            }
        }

        $html .= '</tbody> </table>';





        $result_array['content'] = $html;
        return $result_array;
    }



    private function fact_calendary_item_type_emp($str_emp,$str_date){
        global $db;
        $today = date("Y-m-d");
        $sql="SELECT route_doc.id,
                      employees.id as employee_id,
                      CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
                      route_control_step.id AS step_id,
                      employees.start_date as employees_start,
                      history_step.data_finish,
                      route_control_step.periodicity,
                      route_control_step.step_name as step_name
                     FROM (employees,fact_organization_structure, employees_items_node)
                         LEFT JOIN route_doc  ON ((route_doc.company_id = fact_organization_structure.company_id)
                                                         AND
                                                         ((route_doc.employee_id = employees.id)
                                                             OR
                                                             (route_doc.item_type_id = fact_organization_structure.kladr_id)
                                                             OR
                                                             (fact_organization_structure.id IN (SELECT org_child.id
                                                                 FROM (fact_organization_structure,route_doc)
                                                                     LEFT JOIN fact_organization_structure AS org_child ON (org_child.left_key >= fact_organization_structure.left_key
                                                                                                                                         AND
                                                                                                                                         org_child.right_key <= fact_organization_structure.right_key
                                                                                                                                         AND
                                                                                                                                         org_child.company_id = fact_organization_structure.company_id)
                                                                 WHERE  fact_organization_structure.id = route_doc.organization_structure_id
                                                                 AND route_doc.company_id = " . $_SESSION['control_company'] . "))))

                                LEFT JOIN route_control_step ON route_control_step.track_number_id = route_doc.id

                          LEFT JOIN history_step ON (history_step.employee_id = employees.id
                                                                 AND
                                                             history_step.step_id = route_control_step.id)

                     WHERE fact_organization_structure.company_id = " . $_SESSION['control_company'] . "
                     AND employees_items_node.employe_id = employees.id
                     AND fact_organization_structure.id = employees_items_node.org_str_id
                     AND route_doc.id is not NULL

                     ORDER BY employee_id";


        $briefings = $db->all($sql);
        $result_array = array();

        foreach ($briefings as $key=>$briefing) {
            $result_array [$key]['step_name']= $briefing['step_name'];
            $result_array [$key]['id']= $briefing['id'];
            $result_array [$key]['fio']= $briefing['fio'];
            $result_array [$key]['emp']= $briefing['employee_id'];
            $result_array [$key]['start']= $briefing['employees_start'];
            $result_array [$key]['end']= $briefing['employees_start'];
            $result_array [$key]['periodicity']= $briefing['periodicity'];
            $result_array [$key]['data_finish'] = $briefing['data_finish'];
            $result_array [$key]['textColor']= '#fff';

            $periodicity = $briefing['periodicity'];


            // выставляем дату и приводим к одному виду
            $result_array [$key]['start'] = $briefing['employees_start'];
            if($periodicity > 0 ){
                if($briefing['data_finish']){
                    // как много времени прошло с момента прохождения
                    if((strtotime("+".$periodicity." month", strtotime($briefing['data_finish']))) >= (strtotime("-7 day", strtotime($today)))){
                        // если период ещё не закончился
                        $result_array [$key]['start'] = date_create($briefing['data_finish'])->Format('Y-m-d');
                    } else {
                        // если период закончился - назначаем новый срок прохождения
                        $next_data =  (strtotime("+".$periodicity." month", strtotime($briefing['data_finish'])));
                        $result_array [$key]['start'] =  date_create($next_data)->Format('Y-m-d');
                    }
                } else {
                    // сотрудник не проходил с момента трудоустройства
                }
            } else {
                //  если нет периодики и инструктаж пройден
                if($briefing['data_finish']){
                    $result_array [$key]['start'] = date_create($briefing['data_finish'])->Format('Y-m-d');
                }
            }

        }// конец цикла

        // перебираем для схлопывания по дате
        $html = "<table id='calendary_item_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <td><b>Сотрудник</b></td>
                    <td><b>Инструктаж</b></td>
                    <td><b>Дата</b></td>
                </tr>
                </thead>
                <tbody>";

        foreach ($result_array as $item) {
            if(($item['emp'] == $str_emp) && ($item['start'] == $str_date) && ($item['step_name'] !="")){
                $html .= '<tr>
                        <td>' . $item['fio'] . '</td>
                        <td>' . $item['step_name'] . '</td>
                        <td>' . $item['start'] . '</td>
                    </tr>';
            }
        }

        $html .= '</tbody> </table>';
        $result_array['content'] = $html;
        return $result_array;
    }





    private function get_calendary_all_event($str_date){
        global $db,$labro;
        $green = '#00a65a';
        $yellow = '#f39c12';
        $gray = '#a6a6a6';
        $red = '#f44336';
        $blue = "#4285f4";


        // границы обзора
        $keys =  $labro->observer_keys($_SESSION['employee_id']);
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];

        $sql = "SELECT calendar.dataset AS fio,
                    calendar.title ,
                    calendar.`start`
                    FROM calendar,route_control_step,employees_items_node, organization_structure
                    WHERE calendar.company_id = ". $_SESSION['control_company'] ."
                    AND route_control_step.id = calendar.step_id
                    AND calendar.emp_id = employees_items_node.employe_id
                    AND organization_structure.id = employees_items_node.org_str_id
                    AND organization_structure.left_key > ". $node_left_key ."
                    AND organization_structure.right_key < ". $node_right_key ."
                    AND calendar.`start` ='" .$str_date ."'";
        $calendar = $db->all($sql);

        // перебираем для схлопывания по дате
        $html = "<table id='calendary_item_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <td><b>Сотрудник</b></td>
                    <td><b>Инструктаж</b></td>
                    <td><b>Дата</b></td>
                </tr>
                </thead>
                <tbody>";

        foreach ($calendar as $item) {
                $color = $blue;
                $html .= '<tr>
                        <td>' . $item['fio'] . '</td>
                        <td style="color:'. $color .'">' . $item['title'] . '</td>
                        <td>' . $item['start'] . '</td>
                    </tr>';
        }

        $html .= '</tbody> </table>';

        $result_array['content'] = $html;
        return $result_array;
    }


    private function fact_get_calendary_all_event($str_date){
        global $db,$labro;
        $green = '#00a65a';
        $yellow = '#f39c12';
        $gray = '#a6a6a6';
        $red = '#f44336';
        $blue = "#4285f4";


        // границы обзора
        $keys =  $labro->observer_keys($_SESSION['employee_id']);
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];

        $sql = "SELECT calendar.dataset AS fio,
                    calendar.title ,
                    calendar.`start`
                    FROM calendar,route_control_step,employees_items_node, fact_organization_structure
                    WHERE calendar.company_id = ". $_SESSION['control_company'] ."
                    AND route_control_step.id = calendar.step_id
                    AND calendar.emp_id = employees_items_node.employe_id
                    AND fact_organization_structure.id = employees_items_node.org_str_id
                    AND fact_organization_structure.left_key > ". $node_left_key ."
                    AND fact_organization_structure.right_key < ". $node_right_key ."
                    AND calendar.`start` ='" .$str_date ."'";
        $calendar = $db->all($sql);

        // перебираем для схлопывания по дате
        $html = "<table id='calendary_item_popup' class='table table-bordered table-striped'>
                <thead>
                <tr>
                    <td><b>Сотрудник</b></td>
                    <td><b>Инструктаж</b></td>
                    <td><b>Дата</b></td>
                </tr>
                </thead>
                <tbody>";

        foreach ($calendar as $item) {
            $color = $blue;
            $html .= '<tr>
                        <td>' . $item['fio'] . '</td>
                        <td style="color:'. $color .'">' . $item['title'] . '</td>
                        <td>' . $item['start'] . '</td>
                    </tr>';
        }

        $html .= '</tbody> </table>';

        $result_array['content'] = $html;
        return $result_array;
    }
}
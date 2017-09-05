<?php

class Model_docs_report{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct()
    {
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else()
    {
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }

    public function start()
    {
        global $db;
        $left_key = $this->post_array['left_key'];
        $right_key = $this->post_array['right_key'];
        $select_item = $this->post_array['select_item'];
        $select_item_status = $this->post_array['select_item_status'];

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
                    AND employees.id =". $_SESSION['employee_id'];

        $observer_data = $db->row($sql);

        $left = $observer_data['left'];
        $right = $observer_data['right'];


        $sql="SELECT
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
    ";




//        // частичный доступ у сотрудника которые запрашивает отчёт
//        if(($left!='none')&&($left!="all")) {
//            $sql .= " AND organization_structure.left_key >= " . $left . "
//                AND organization_structure.right_key <= " . $right ;
//        }

//        // полный доступ у сотрудника которые запрашивает отчёт
//        if($left=='all') {
//            $sql.=" GROUP BY EMPLOY, STEP, name_doc";
//            // не добавляем фильтры
//        }

//        // без доступа, отчёт не показываем
//        if($left=='none') {
//            // не показываем ничего
//        } else {
//
            // если надо показать документы по всем узлам
            if (($left_key == 0) && ($right_key == 0)) {
                $sql .= " AND organization_structure.left_key >= 1
                            GROUP BY EMPLOY, STEP, name_doc";
            }

            // если надо показать документы по определённому узлу
            if (($left_key != 0) && ($right_key != 0)) {
                $sql .= " AND organization_structure.left_key >= " . $left_key . "
                                    AND organization_structure.right_key <= " . $right_key . "
                                    GROUP BY EMPLOY, STEP, name_doc";
            }

            // если показать с удалёнными сотрудниками
            if (($left_key == 1) && ($right_key == 0)) {
                $sql .= "
                                            GROUP BY EMPLOY, STEP, name_doc";
            }


            $docs_array = $db->all($sql);
            $html = "";
            foreach ($docs_array as $docs_array_item) {
                // проверяем по фильтрам
                if (($docs_array_item['doc_status_id'] == $select_item_status) || ($select_item_status == "") || (($select_item_status == "0") && ($docs_array_item['DoC_Status'] == "Ещё не создан"))) {
                    if (($docs_array_item['action_triger'] == $select_item) || ($select_item == "")) {
                        $html .= '<div class="report_step_row"  file_id="' . $docs_array_item['ID_FILES'] . '" fio="' . $docs_array_item['fio'] . '" dol="' . $docs_array_item['DOL'] . '"  name="' . $docs_array_item['name_doc'] . '">
                        <div  class="number_doc">' . $docs_array_item['ID_FILES'] . '</div>
                        <div  class="fio">' . $docs_array_item['fio'] . '</div>
                        <div class="otdel">' . $docs_array_item['dir'] . '</div>
                        <div class="position">' . $docs_array_item['DOL'] . '</div>
                        <div  class="doc_name">' . $docs_array_item['name_doc'] . '</div>
                        <div  class="doc_type">' . $docs_array_item['type_doc'] . '</div>
                        <div class="action">' . $docs_array_item['action'] . '</div>
                        <div class="status">' . $docs_array_item['DoC_Status'] . '</div>
                        <div  class="status_date">' . $docs_array_item['date_finish'] . '</div>
                    </div>';
                    }
                }
            }

            $sql = "SELECT document_status_now.name, document_status_now.id
                  FROM document_status_now";
            $select_array = $db->all($sql);
            $status_select = "<option value='' >Все статусы</option>";
            $status_select .= "<option value='0' >Ещё не создан</option>";
            foreach ($select_array as $select_array_item) {
                $status_select .= "<option value=" . $select_array_item['id'] . "  >" . $select_array_item['name'] . "</option>";
            }

            $sql = "Select form_step_action.user_action_name, form_step_action.action_triger
                  FROM form_step_action";
            $select_array = $db->all($sql);
            $select = "<option value='' >Все действия</option>";
            foreach ($select_array as $select_array_item) {
                $select .= "<option value=" . $select_array_item['action_triger'] . "  >" . $select_array_item['user_action_name'] . "</option>";
            }
//        }
        $result_array['status_select'] = $status_select;
        $result_array['select'] = $select;
        $result_array['content'] = $html;
        $result = json_encode($result_array, true);
        die($result);
    }


    // запрос на дерево позиций
    public function load_node_docs_tree(){
        global $db;
        $sql = "SELECT
                CONCAT_WS (':', items_control_types.name, items_control.name) AS erarh,
                organization_structure.`level`,
                organization_structure.id,
                organization_structure.left_key,
                organization_structure.right_key,
                items_control_types.id AS type,
                employees_items_node.org_str_id as 'employee',
                CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM organization_structure
                inner join items_control on organization_structure.kladr_id = items_control.id
                inner join items_control_types on organization_structure.items_control_id = items_control_types.id
                left join employees_items_node on employees_items_node.org_str_id = organization_structure.id
                left join employees on employees_items_node.employe_id = employees.id
                Where organization_structure.company_id = ". $_SESSION['control_company'] ."  ORDER BY left_key";

        $employees = $db->all($sql);
        $html = "";

        foreach($employees as $employee){
                $item = str_repeat('&#8195;', $employee['level'] - 1);
                if ($employee['type'] == 3) {
//                    $position = '<div class="position" id_position = "' . $employee[id] . '" parent_id = "' . $parent_id . '" parent_name = "' . $parent_name . '" erarh = "' . $employee['erarh'] . '" >' . $item . $employee['erarh'] . '</div>';
//                    $erarh = "";
                } else {
                    $erarh = $item . $employee['erarh'] . " / ";
                    $html .= '<div class="new_parent" left_key = "' . $employee['left_key'] . '" right_key = "' . $employee['right_key'] . '" new_parent_id = "' . $employee['id'] . '"  new_parent_name = "' . $employee['erarh'] . '" >' . $erarh. '</div>';

                }
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';

        $result = json_encode($result_array, true);
        die($result);
    }




    public function action_history_docs(){
        global $db;
        $file_id = $this->post_array['file_id'];

        $sql ="SELECT history_forms.id , form_step_action.user_action_name,document_status_now.name AS doc_status,
                CASE
                WHEN history_forms.start_data IS NULL
                   THEN 'Не начинал'
                   ELSE history_forms.start_data
                   END  AS start_data,
                CASE
                WHEN history_forms.step_end_time IS NULL
                   THEN 'Не прошол'
                   ELSE history_forms.step_end_time
                   END  AS step_end_time
                FROM (save_temp_files,history_forms,temps_form_step,form_step_action,form_status_now)
                LEFT JOIN document_status_now ON document_status_now.id = history_forms.doc_status_now
                WHERE  save_temp_files.id = history_forms.save_temps_id
                AND temps_form_step.id = history_forms.track_form_step
                AND form_step_action.id = temps_form_step.action_form
                AND history_forms.save_temps_id = save_temp_files.id
                AND save_temp_files.id = ". $file_id ."
                GROUP BY id";
        $action_docs = $db->all($sql);

        $html = "";
        $html.="<div class='row'>
                        <div class='action_popup'>Действие:</div>
                        <div class='status_popup'>Статус:</div>
                        <div class='date_popup'>Дата начала:</div>
                        <div class='date_popup'>Дата завершения:</div>
                        </div>";
        foreach($action_docs as $action_doc){
            $html.="<div class='row'>
                        <div class='action_popup'>".$action_doc['user_action_name'] ."</div>
                        <div class='status_popup'>".$action_doc['doc_status'] ."</div>
                        <div class='date_popup'>".$action_doc['start_data'] ."</div>
                        <div class='date_popup'>".$action_doc['step_end_time'] ."</div>
                        </div>";
        }


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

}
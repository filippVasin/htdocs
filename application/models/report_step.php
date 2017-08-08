<?php

class Model_report_step
{
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
//        echo $sql;
        $observer_data = $db->row($sql);
        $left = $observer_data['left'];
        $right = $observer_data['right'];

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

	AND	organization_structure.company_id
   AND
   /* по фирме*/

    route_doc.company_id = ". $_SESSION['control_company'] ."
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $_SESSION['control_company'] ."
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
    ";

        // частичный доступ
        if(($left!='none')&&($left!="all")) {
            $sql .= " AND organization_structure.left_key >= " . $left . "
                AND organization_structure.right_key <= " . $right ;
        }

        // полный доступ
        if($left=='all') {
            // не добавляем фильтры
        }

        // без доступа
        if($left=='none') {
            // не показываем ничего
        } else {

            // если надо показать документы по всем узлам
            if (($left_key == 0) && ($right_key == 0)) {
                $sql .= " AND organization_structure.left_key >= 1
                           GROUP BY EMPLOY, STEP";
            }

            // если надо показать документы по определённому узлу
            if (($left_key != 0) && ($right_key != 0)) {
                $sql .= " AND organization_structure.left_key >= " . $left_key . "
                                    AND organization_structure.right_key <= " . $right_key . "
                                     GROUP BY EMPLOY, STEP";
            }

            // если показать с удалёнными сотрудниками
            if (($left_key == 1) && ($right_key == 0)) {
                $sql .= " GROUP BY save_temp_files.id
                                            GROUP BY EMPLOY, STEP";
            }


            $docs_array = $db->all($sql);
            $html = "";
            foreach ($docs_array as $docs_array_item) {
                if (($docs_array_item['action_name'] == $select_item) || ($select_item == "")) {
                    if ($docs_array_item['SaveTempID'] != "") {
                        $html .= '<div class="report_step_row docs_report_step_row" file_id="' . $docs_array_item['SaveTempID'] . '"  emp="' . $docs_array_item['EMPLOY'] . '" step="' . $docs_array_item['STEP'] . '" manual="' . $docs_array_item['manual'] . '" dir="' . $docs_array_item['dir'] . '" name="' . $docs_array_item['name'] . '" fio="' . $docs_array_item['fio'] . '">';
                    } else {
                        $html .= '<div class="report_step_row"  emp="' . $docs_array_item['EMPLOY'] . '" step="' . $docs_array_item['STEP'] . '" manual="' . $docs_array_item['manual'] . '" dir="' . $docs_array_item['dir'] . '" name="' . $docs_array_item['name'] . '" fio="' . $docs_array_item['fio'] . '">';
                    }

                    $html .= ' <div  class="number">' . $docs_array_item['EMPLOY'] . '</div>
                        <div  class="otdel">' . $docs_array_item['dir'] . '</div>
                        <div class="position">' . $docs_array_item['name'] . '</div>
                        <div class="fio">' . $docs_array_item['fio'] . '</div>
                        <div  class="manual_name">' . $docs_array_item['manual'] . '</div>
                        <div  class="start_date">' . $docs_array_item['StartStep'] . '</div>
                        <div class="end_date">' . $docs_array_item['FinishStep'] . '</div>
                    </div>';
                }
            }

//        $sql= "Select form_step_action.action_name
//FROM form_step_action";
//        $select_array = $db->all($sql);
//        $select = "<option value='' ></option>";
//        foreach ($select_array as $select_array_item) {
//            $select .= "<option value=" .$select_array_item['action_name'] . "  >".$select_array_item['action_name']."</option>";
//        }


            $select = '  <select class="target " id="node_docs_select" style="float:left;width:200px;margin-top:15px;">
                        <option value=""></option>
                        <option value="">Все</option>
                        <option value="Не начатые">Не начатые</option>
                        <option value="Не законченные">Не законченные</option>
                        <option value="Законченные">Законченные</option>
                    </select>';
        }
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
                Where organization_structure.company_id =14  ORDER BY left_key";


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

        $sql ="SELECT history_forms.id , form_step_action.action_name,
                CASE
                WHEN history_forms.start_data IS NULL
                   THEN 'Не не начинал'
                   ELSE history_forms.start_data
                   END  AS start_data,
                CASE
                WHEN history_forms.step_end_time IS NULL
                   THEN 'Не прошол'
                   ELSE history_forms.step_end_time
                   END  AS step_end_time
                FROM save_temp_files,history_forms,temps_form_step,form_step_action
                WHERE  save_temp_files.id = history_forms.save_temps_id
                AND temps_form_step.id = history_forms.track_form_step
                AND form_step_action.id = temps_form_step.action_form
                AND save_temp_files.id = ".$file_id;
        $action_docs = $db->all($sql);

        $html = "";
        $html.="<div class='row'>
                        <div class='action'>Действие:</div>
                        <div class='date'>Дата начала:</div>
                        <div class='date'>Дата завершения:</div>
                        </div>";
        foreach($action_docs as $action_doc){
            $html.="<div class='row'>
                        <div class='action'>".$action_doc['action_name'] ."</div>
                        <div class='date'>".$action_doc['start_data'] ."</div>
                        <div class='date'>".$action_doc['step_end_time'] ."</div>
                        </div>";
        }


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }


}
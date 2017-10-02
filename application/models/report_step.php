<?php

class Model_report_step{
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

    public function start(){

        global $db;
        $left_key = $this->post_array['left_key'];
        $right_key = $this->post_array['right_key'];
        $select_item = $this->post_array['select_item'];

        if(!isset($_SESSION['select_item'])){
            $_SESSION['select_item'] = "";
        }
        if($_SESSION['select_item'] == "Все"){
            $_SESSION['select_item'] = "";
        }

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

        if(!isset($_SESSION['left_key'])){
            $_SESSION['left_key'] = 0;
        }
        if(!isset($_SESSION['right_key'])){
            $_SESSION['right_key'] = 0;
        }

        $left_key = $_SESSION['left_key'];
        $right_key = $_SESSION['right_key'];

        $sql="SELECT
/* Вывод даннных */

  employees.id AS EMPLOY, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
   route_control_step.id AS STEP, route_control_step.`periodicity`, history_docs.`id` AS history_docs,history_docs.date_finish,
   /* условный вывод */
 	/* чтобы выводить все записи без учёта переодики, оставитьтолько
	MIN(history_docs.date_start) в условии NULL в CASE*/
  CASE
   WHEN (MIN(history_docs.date_start) IS NULL)
			OR
			((route_control_step.periodicity is not NULL)
			 	AND
			( NOW() > (history_docs.date_start + INTERVAL route_control_step.periodicity MONTH)))
   THEN 'Не начинал'
   ELSE MIN(history_docs.date_start)
   END AS StartStep,
  CASE
   WHEN (MAX(history_docs.date_finish) IS NULL)
			OR
			((route_control_step.periodicity is not NULL)
			 	AND
			( NOW() > (history_docs.date_finish + INTERVAL route_control_step.periodicity MONTH)))
   THEN 'Не прошел'
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

    route_doc.company_id = ". $_SESSION['control_company'] ."
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $_SESSION['control_company'] ."
    		AND org_parent.company_id = ". $_SESSION['control_company'] ."
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
    AND ((('". $_SESSION['select_item'] ."' = 'Не начатые' ) AND (history_docs.date_start is Null))
	  			OR
	  			(('". $_SESSION['select_item'] ."' = 'Не законченные' ) AND (history_docs.date_start is not Null) AND (history_docs.date_finish is Null))
	  			OR
	  			(('". $_SESSION['select_item'] ."' = 'Законченные' ) AND (history_docs.date_finish is not Null))
	  			OR
	  			('". $_SESSION['select_item'] ."' = ' ' )
			) ";

        // частичный доступ у сотрудика котрый запрашивает отчёт
        if(($left!='none')&&($left!="all")) {
            $sql .= " AND organization_structure.left_key >= " . $left . "
                AND organization_structure.right_key <= " . $right ;
        }

        // полный доступ на данные у сотрудника которые запрашивает отчёт
        if($left=='all') {
            // не добавляем фильтры
        }

        // без доступа, отчёт не показываеи
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
                        $html .= '<tr class="report_step_row docs_report_step_row" file_id="' . $docs_array_item['SaveTempID'] . '"  emp="' . $docs_array_item['EMPLOY'] . '" step="' . $docs_array_item['STEP'] . '" manual="' . $docs_array_item['manual'] . '" dir="' . $docs_array_item['dir'] . '" name="' . $docs_array_item['name'] . '" fio="' . $docs_array_item['fio'] . '">';
                    } else {
                        $html .= '<tr class="report_step_row"  emp="' . $docs_array_item['EMPLOY'] . '" step="' . $docs_array_item['STEP'] . '" manual="' . $docs_array_item['manual'] . '" dir="' . $docs_array_item['dir'] . '" name="' . $docs_array_item['name'] . '" fio="' . $docs_array_item['fio'] . '">';
                    }

                    $html .= ' <td  >' . $docs_array_item['EMPLOY'] . '</td>
                        <td>' . $docs_array_item['dir'] . '</td>
                        <td>' . $docs_array_item['name'] . '</td>
                        <td>' . $docs_array_item['fio'] . '</td>
                        <td>' . $docs_array_item['manual'] . '</td>
                        <td>' . $docs_array_item['StartStep'] . '</td>
                        <td>' . $docs_array_item['FinishStep'] . '</td>
                    </tr>';
                }
            }
            if($_SESSION['select_item'] == ""){
                $_SESSION['select_item'] = "Все";
            }

            $html.= '  <select class="target " id="node_docs_select" style="float:left;width:200px;margin-top:0px;">
                        <option value=""> '. $_SESSION['select_item'] .'</option>
                        <option value="">Все</option>
                        <option value="Не начатые">Не начатые</option>
                        <option value="Не законченные">Не законченные</option>
                        <option value="Законченные">Законченные</option>
                    </select>';
        }

        return $html;
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


    public function select(){
        $select_item = $this->post_array['select_item'];
        $left_key = $this->post_array['left_key'];
        $right_key = $this->post_array['right_key'];

        $_SESSION['select_item'] = $select_item;
        $_SESSION['left_key'] = $left_key;
        $_SESSION['right_key'] = $right_key;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

}
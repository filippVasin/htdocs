<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_main{
    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else(){
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }

    public function start(){
        global $db;

        if(!(isset($_SESSION['control_company']))){
            return " ";
        }

        $html =<<< HERE
<div id="dashboard">
    <div id="test_report">
        <div class="test_report_title">Прохождение инструктажей</div>
        <div class="metric">
            <div class="test_target"><span id="test_target">%test_target%</span> всего</div>
            <span>/</span>
            <div class="test_fact"><span id="test_fact">%test_fact%</span> пройдено</div>
        </div>
        <div id="test_circle" class="c100 p%test_proc% big %test_color%">
            <span id="test_proc">%test_proc%%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>
    </div>

    <div id="emp_report">
        <div class="emp_report_title">Сотрудники</div>
        <div class="metric">
            <div class="emp_target"><span id="emp_target">%emp_target%</span> всего</div>
            <span>/</span>
            <div class="emp_fact"><span id="emp_fact">%emp_fact%</span> прошли инструктажи</div>
        </div>
        <div id="emp_circle" class="c100 p%emp_proc% %emp_color% big">
            <span id="emp_proc">%emp_proc%%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>
    </div>


</div>
HERE;


//        <div id="doc_report">
//        <div class="doc_report_title">Документы</div>
//        <div class="metric">
//            <div class="doc_target"><span id="doc_target">%doc_target%</span> должно быть</div>
//            <span>/</span>
//            <div class="doc_fact"><span id="doc_fact">%doc_fact%</span> сдано</div>
//        </div>
//        <div id="doc_circle" class="c100 p%doc_proc% %doc_color% big">
//            <span id="doc_proc">%doc_proc%%</span>
//            <div class="slice">
//                <div class="bar"></div>
//                <div class="fill"></div>
//            </div>
//        </div>
//    </div>

        $sql="SELECT
/* Вывод даннных */

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
			AND ((history_docs.date_finish + INTERVAL route_control_step.`periodicity` MONTH) <= now() OR (history_docs.date_finish is NULL))
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $_SESSION['control_company'] ."
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id = employees.id)
    GROUP BY EMPLOY, STEP
    ORDER BY EMPLOY";
        $test_array = $db->all($sql);
        $test_target = 0;
        $test_fact = 0;
        $emp = 0;
        $count_emp = 0;// количество сотрудников
        $count_victory =0;// успешные сотрудники
        $flag = 0;
        foreach ($test_array as $test_item) {

            if($test_item['FinishStep']!='Не прошел'){
                ++$test_fact;
            } else {
                $flag += 1;
            }
            if($test_item['EMPLOY']!= $emp){
                ++$count_victory;
                ++$count_emp;
                $emp = $test_item['EMPLOY'];
                if($flag>0){
                  --$count_victory;
                }
                $flag = 0;
            }
            ++$test_target;
        }
//        if($flag>0){
//            --$count_victory;
//        }



        $test_proc = round($test_fact/$test_target*100);
        $test_color= $this->color($test_proc);

        $html = str_replace('%test_fact%', $test_fact, $html);
        $html = str_replace('%test_target%', $test_target, $html);
        $html = str_replace('%test_proc%', $test_proc, $html);
        $html = str_replace('%test_color%', $test_color, $html);


        $emp_target = $count_emp;
        $emp_fact = $count_victory;
        $emp_proc = round($emp_fact/$emp_target*100);
        $emp_color= $this->color($emp_proc);

        $html = str_replace('%emp_fact%', $emp_fact, $html);
        $html = str_replace('%emp_target%', $emp_target, $html);
        $html = str_replace('%emp_proc%', $emp_proc, $html);
        $html = str_replace('%emp_color%', $emp_color, $html);


        $doc_target = 312;
        $doc_fact = 312;
        $doc_proc = round($doc_fact/$doc_target*100);
        $doc_color= $this->color($doc_proc);

        $html = str_replace('%doc_fact%', $doc_fact, $html);
        $html = str_replace('%doc_target%', $doc_target, $html);
        $html = str_replace('%doc_proc%', $doc_proc, $html);
        $html = str_replace('%doc_color%', $doc_color, $html);


        return $html;
    }

    private function color($proc){

        if($proc < 90){
            $color ='red';
        }
        if($proc >= 90){
            $color ='yellow';
        }
        if($proc == 100){
            $color ='green';
        }
        return $color;
    }
}
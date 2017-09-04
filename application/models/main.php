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

        $node_left_key = $this->post_array['node_left_key'];
        $node_right_key = $this->post_array['node_right_key'];

        if(!(isset($_SESSION['control_company']))){
            $result_array['status'] = "not company";
            $result = json_encode($result_array, true);
            die($result);
        }

        $html =<<< HERE
<div id="control">
        <div class="button" id="look_dep">По отделам</div>
        <div class="button none" id="close_dep">Скрыть всё</div>
        <div class="button" id="look_dep_all">Показать всё</div>
        <div class="button" id="select_node">Выбор подразделения</div>
</div>
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
        <div class="node_report none" id="test_node_report">

            %node_report_test%
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
        <div class="node_report none"  id="emp_node_report">

            %node_report_emp%
        </div>
    </div>

        <div id="doc_report">
        <div class="doc_report_title">Документы</div>
        <div class="metric">
            <div class="doc_target"><span id="doc_target">%doc_target%</span> должно быть</div>
            <span>/</span>
            <div class="doc_fact"><span id="doc_fact">%doc_fact%</span> сдано</div>
        </div>
        <div id="doc_circle" class="c100 p%doc_proc% %doc_color% big">
            <span id="doc_proc">%doc_proc%%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>
        <div class="node_report none" id="doc_node_report">

            %node_report_doc%
        </div>
    </div>
</div>
HERE;




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

    route_doc.company_id = ". $_SESSION['control_company'] ."
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = ". $_SESSION['control_company'] ."
    		AND org_parent.company_id = ". $_SESSION['control_company'] ."
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)
  ";

        if(($node_left_key!="")&&($node_right_key!="")){
            $sql.=" AND org_parent.left_key >= ". $node_left_key ."
                    AND org_parent.right_key <= ". $node_right_key ;
        }
        $sql.="  GROUP BY EMPLOY, STEP
                 ORDER BY EMPLOY";

//        echo $sql;
        $test_array = $db->all($sql);
        $test_target = 0;
        $test_fact = 0;
        $emp = 0;
        $count_emp = 0;// количество сотрудников
        $count_victory =0;// успешные сотрудники
        $doc_count_all = 0;// количество документов всего
//        $doc_count_end = 0; // количество пройденных документов
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
            if($test_item['doc_all']!=""){
                ++$doc_count_all;
            }
        }
//        if($flag>0){
//            --$count_victory;
//        }

         $sql="SELECT *
        FROM form_status_now,employees_items_node,organization_structure
        WHERE form_status_now.doc_status_now>=7
        AND form_status_now.author_employee_id = employees_items_node.employe_id
        AND employees_items_node.org_str_id = organization_structure.id
        AND organization_structure.company_id =". $_SESSION['control_company'];
        $result= $db->all($sql);
        $doc_count_end = 0;
        foreach($result as $item){
            ++$doc_count_end;
        }


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


        $doc_target = $doc_count_all;
        $doc_fact = $doc_count_end;
        $doc_proc = round($doc_fact/$doc_target*100);
        $doc_color= $this->color($doc_proc);

        $html = str_replace('%doc_fact%', $doc_fact, $html);
        $html = str_replace('%doc_target%', $doc_target, $html);
        $html = str_replace('%doc_proc%', $doc_proc, $html);
        $html = str_replace('%doc_color%', $doc_color, $html);


        $dir_array = array();
        foreach ($test_array as $test_item) {
            $dir_array[] = $test_item['dir_id'];
        }

        $dir_array = array_unique($dir_array);

        $node_report_test="";
        $node_report_emp="";
        $node_report_doc ="";
        foreach ($dir_array as $dir_array_item) {
            $test_target = 0;
            $test_fact = 0;
            $count_all_emp = 0;// количество сотрудников
            $count_victory_emp =0;// успешные сотрудники
            $name = "";
            $level = "";
            $left_key = "";
            $right_key = "";
            $emp = 0;
            $flag = 0;
            $doc_count_all = 0;// количество документов всего
            foreach ($test_array as $test_item) {
                if($test_item['dir_id'] == $dir_array_item){
                    if($test_item['FinishStep']!='Не прошел'){
                        ++$test_fact;
                    } else {
                        $flag += 1;
                    }
                    if($test_item['EMPLOY']!= $emp){
                        ++$count_victory_emp;
                        ++$count_all_emp;
                        $emp = $test_item['EMPLOY'];
                        if($flag>0){
                            --$count_victory_emp;
                        }
                        $flag = 0;
                    }
                    if($test_item['doc_all']!=""){
                        ++$doc_count_all;

                    }

                    ++$test_target;
                    $name = $test_item['dir'];
                    $level = $test_item['level'];
                    $left_key = $test_item['left_key'];
                    $right_key = $test_item['right_key'];
                }
            }


            // уровнять по длинне для сравниения на клиете
            $left_key = str_pad($left_key, 3, "0", STR_PAD_LEFT);
            $right_key = str_pad($right_key, 3, "0", STR_PAD_LEFT);

            $test_proc = round($test_fact/$test_target*100);
            $node_report_test .= '<div class="progress-group" level="'. $level .'" left_key="'. $left_key .'" right_key="'. $right_key .'" fact="'. $test_fact .'" target="'. $test_target .'"> ';
            $node_report_test .=     '<div class="progress-text-row"> ';
            $node_report_test .=         '<span class="progress-text">'. $name .'</span>';
            $node_report_test .=         '<span class="progress-number"><b>'. $test_fact .'</b>/'. $test_target .'</span>';
            $node_report_test .=     '</div> ';
            $node_report_test .=     '<div class="progress_line">';
            $node_report_test .=         '<div class="progress-bar progress-bar-aqua" style="width: '.$test_proc.'%"></div>';
            $node_report_test .=     '</div>';
            $node_report_test .= '</div>';
            // сотрудники
            $emp_proc = round($count_victory_emp/$count_all_emp*100);
            $node_report_emp .= '<div class="progress-group" level="'. $level .'" left_key="'. $left_key .'" right_key="'. $right_key .'" fact="'. $count_victory_emp .'" target="'. $count_all_emp .'"> ';
            $node_report_emp .=     '<div class="progress-text-row"> ';
            $node_report_emp .=         '<span class="progress-text">'. $name .'</span>';
            $node_report_emp .=         '<span class="progress-number"><b>'. $count_victory_emp .'</b>/'. $count_all_emp .'</span>';
            $node_report_emp .=     '</div> ';
            $node_report_emp .=     '<div class="progress_line">';
            $node_report_emp .=         '<div class="progress-bar progress-bar-aqua" style="width: '.$emp_proc.'%"></div>';
            $node_report_emp .=     '</div>';
            $node_report_emp .= '</div>';
            // документы

            $sql="SELECT *
                    FROM form_status_now,employees_items_node,organization_structure
                    WHERE form_status_now.doc_status_now>=7
                    AND form_status_now.author_employee_id = employees_items_node.employe_id
                    AND employees_items_node.org_str_id = organization_structure.id
                    AND organization_structure.parent = ". $dir_array_item ."
                    AND organization_structure.company_id =". $_SESSION['control_company'];
            $result= $db->all($sql);
            $doc_count_end = 0;
            foreach($result as $item){
                ++$doc_count_end;
            }

            $emp_doc = round($doc_count_end/$doc_count_all*100);
            $node_report_doc .= '<div class="progress-group" level="'. $level .'" left_key="'. $left_key .'" right_key="'. $right_key .'" fact="'. $doc_count_end .'" target="'. $doc_count_all .'"> ';
            $node_report_doc .=     '<div class="progress-text-row"> ';
            $node_report_doc .=         '<span class="progress-text">'. $name .'</span>';
            $node_report_doc .=         '<span class="progress-number"><b>'. $doc_count_end .'</b>/'. $doc_count_all .'</span>';
            $node_report_doc .=     '</div> ';
            $node_report_doc .=     '<div class="progress_line">';
            $node_report_doc .=         '<div class="progress-bar progress-bar-aqua" style="width: '.$emp_doc.'%"></div>';
            $node_report_doc .=     '</div>';
            $node_report_doc .= '</div>';
        }

        $html = str_replace('%node_report_emp%', $node_report_emp, $html);
        $html = str_replace('%node_report_test%', $node_report_test, $html);
        $html = str_replace('%node_report_doc%', $node_report_doc, $html);

        $result_array['content'] = $html;
        $result_array['status'] = "ok";
        $result = json_encode($result_array, true);
        die($result);
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
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_fact_monitor{
    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else(){
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }

    public function start(){
        global $db,$labro;

//        print_r($_SESSION);

        $node_left_key = $this->post_array['node_left_key'];
        $node_right_key = $this->post_array['node_right_key'];
        // перенапровление если нет подключенной компании
        if(!(isset($_SESSION['control_company']))){
            $result_array['status'] = "not company";
            // Отправили зезультат
            return json_encode($result_array);
        }
        // границы обзора
        $keys =  $labro->observer_keys($_SESSION['employee_id']);
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];



        // шаблон дашборда
        $html =<<< HERE

  <div class="col-lg-4 col-xs-12" style="margin-top: 15px;">

          <div class="info-box open_list_report">
            <span class="info-box-icon  %bg_info_box%"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Запланированно</span>
              <span class="info-box-number">%test_target%</span>
              <span class="info-box-text">событий</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->


          <div class="info-box open_list_report %bg_info_box%">
            <span class="info-box-icon "><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Завершено</span>
              <span class="info-box-number">%test_fact%</span>

              <div class="progress">
                <div class="progress-bar" style="width: %test_proc%%"></div>
              </div>
                  <span class="progress-description">

                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->

          <!-- small box -->
          <div class="small-box open_list_report  %bg_info_box%">
            <div class="inner">
              <h3 style="text-align: center;">
              %test_proc%<sup style="font-size: 20px">%</sup></h3>


              <span class="info-box-text" style="text-align: center;">по компании</span>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#"  class="small-box-footer"  >
              Подробнее <i class="fa fa-arrow-circle-right" ></i>
            </a>
          </div>
<div id="dashboard">


    <div id="test_report"  style="padding-right: 0px; padding-left: 0px;width: 100%;">
        <div class="test_report_title none">Состояние</div>
        <div class="metric none">
            <div class="test_target "><span id="test_target">%test_target%</span> всего</div>
            <span>/</span>
            <div class="test_fact"><span id="test_fact">%test_fact%</span> пройдено</div>
        </div>
        <div id="test_circle" class="c100 p%test_proc% big %test_color% none">
            <span id="test_proc">%test_proc%%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>
        <div class="node_report none " id="test_node_report">

            %node_report_test%

        </div>
    </div>
</div>

</div>
HERE;

        $fact_org_id = $labro->fact_org_str_id($_SESSION['employee_id']);

$sql="(SELECT
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
  fact_org_parent.id AS dir_id,  FACT.left_key, FACT.right_key, FACT.level,
   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir,
  route_control_step.step_name AS manual, TempTest.SaveTempID

  FROM (route_control_step,route_doc,employees, fact_organization_structure)
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
       LEFT JOIN fact_organization_structure AS FACT ON FACT.org_str_id = organization_structure.id
     LEFT JOIN fact_organization_structure AS fact_org_parent
     ON (fact_org_parent.left_key < FACT.left_key AND fact_org_parent.right_key > FACT.right_key
     AND fact_org_parent.level =(FACT.level - 1) )
     LEFT JOIN items_control AS item_par ON item_par.id = fact_org_parent.kladr_id
    LEFT JOIN items_control_types ON items_control_types.id = fact_org_parent.items_control_id
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
    route_doc.company_id = " . $_SESSION['control_company'] . "
    		AND employees.id = employees_items_node.employe_id
    		AND organization_structure.id = employees_items_node.org_str_id
    		AND organization_structure.company_id = " . $_SESSION['control_company'] . "
    		AND fact_org_parent.company_id = " . $_SESSION['control_company'] . "
    		AND organization_structure.id  in (SELECT organization_structure.id
							FROM (fact_organization_structure, organization_structure)
							LEFT JOIN fact_organization_structure AS FACT ON (FACT.left_key <= fact_organization_structure.left_key
																								AND
																								FACT.right_key >= fact_organization_structure.right_key
																								AND
																								FACT.company_id = fact_organization_structure.company_id)
							WHERE fact_organization_structure.org_str_id = organization_structure.id
							AND FACT.id = ". $fact_org_id .")
	     AND
    /* для всех сотрудников или только для конкретного */
    (route_doc.employee_id IS NULL OR route_doc.employee_id =employees.id)";
        // если сработал выбор по отделам
        if(($node_left_key!="")&&($node_right_key!="")){
            $sql.=" AND fact_org_parent.left_key >= ". $node_left_key ."
                    AND fact_org_parent.right_key <= ". $node_right_key ;
        }

        $sql.="  GROUP BY EMPLOY, STEP
                 ORDER BY EMPLOY)";

//        echo $sql;

        $timeSQL = 0;
        $timePHP = 0;

        $startSQL = microtime(true);
        $sqlTwo=" UNION
        (SELECT
                employees_items_node.id AS doc_all,
                employees_items_node.id AS doc_status_now,
                employees_items_node.id AS EMPLOY,
                employees_items_node.id AS fio,
                employees_items_node.id AS STEP,
                employees_items_node.id AS periodicity,
                employees_items_node.id AS history_docs,
                employees_items_node.id AS date_finish,
                employees_items_node.id AS StartStep,
                employees_items_node.id AS FinishStep,
                employees_items_node.id AS name,
                organization_structure.id AS dir_id,
                organization_structure.left_key,
                organization_structure.right_key,
                organization_structure.`level`,
                 CONCAT_WS (' - ',items_control_types.name, items_control.name) AS dir,
                employees_items_node.id  AS manual,
                employees_items_node.id  AS SaveTempID
                    FROM (organization_structure, items_control_types, items_control)
                 LEFT JOIN employees_items_node ON employees_items_node.employe_id = 0
                WHERE items_control.id = organization_structure.kladr_id
                AND organization_structure.items_control_id = items_control_types.id
                AND organization_structure.company_id = " . $_SESSION['control_company'] . "
                AND organization_structure.`level` = 1
                AND organization_structure.items_control_id = 10)
        ";



//        $sql .= $sqlTwo;
//        echo $sql;
        $test_array = $db->all($sql);
        $endSQL = microtime(true) - $startSQL;
        $timeSQL += $endSQL;

        $startPHP = microtime(true);
        $test_target = 0;
        $test_fact = 0;
        $doc_count_all = 0;// количество документов всего

        $flag = 0;
        foreach ($test_array as $test_item) {
            if($test_item['FinishStep']!='Не прошел'){
                ++$test_fact;
            } else {
                $flag += 1;
            }

            ++$test_target;
            if($test_item['doc_all']!=""){
                ++$doc_count_all;
            }
        }

        $endPHP = microtime(true) - $startPHP;
        $timePHP += $endPHP;


        // считаем законьченные документы
        $sql="SELECT *
        FROM form_status_now,employees_items_node,organization_structure
        WHERE form_status_now.doc_status_now>=7
        AND form_status_now.author_employee_id = employees_items_node.employe_id
        AND employees_items_node.org_str_id = organization_structure.id
        AND organization_structure.company_id =". $_SESSION['control_company'];
        $startSQL = microtime(true);
        $result= $db->all($sql);
        $endSQL = microtime(true) - $startSQL;
        $timeSQL += $endSQL;

        $startPHP = microtime(true);
        $doc_count_end = 0;
        foreach($result as $item){
            ++$doc_count_end;
        }

        // наполняем шаблон дашборда (круги)

        $test_target = $test_target + $doc_count_all;
        $test_fact = $test_fact + $doc_count_end;
        $test_proc = round($test_fact/$test_target*100);
        $test_color= $this->color($test_proc);

        $html = str_replace('%test_fact%', $test_fact, $html);
        $html = str_replace('%test_target%', $test_target, $html);
        $html = str_replace('%test_proc%', $test_proc, $html);
        $html = str_replace('%test_color%', $test_color, $html);

        if($test_proc < 90){
            $html = str_replace('%bg_info_box%', "bg-red", $html);
        }
        if($test_proc >= 90 && $test_proc != 100 ){
            $html = str_replace('%bg_info_box%', "bg-yellow", $html);
        }
        if($test_proc == 100){
            $html = str_replace('%bg_info_box%', "bg-green", $html);
        }

        // bg-green, bg-aqua,bg-red,bg-yellow
        // собираем и схлопываем массив отделов до уникальных
        $dir_array = array();
        foreach ($test_array as $test_item) {
            $dir_array[] = $test_item['dir_id'];
        }
        $dir_array = array_unique($dir_array);

        // проход по всем отделам
        $node_report_test="";

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
            $people_proc_target = 0;
            $people_proc_fact = 0;
            $test_fio_html = '<div class="test_fio_table" dir="'. $dir_array_item .'">';


            foreach ($test_array as $test_item) {
                if($test_item['dir_id'] == $dir_array_item){
                    if($test_item['FinishStep']!='Не прошел'){
                        ++$test_fact;
                    } else {
                        $flag += 1;
                    }
                    if($test_item['EMPLOY']!= $emp){
                        // алгоритм подсчёта успешных сотрудников
                        $emp = $test_item['EMPLOY'];
                        ++$count_victory_emp;
                        ++$count_all_emp;
                        if($flag>0){
                            --$count_victory_emp;
                        }
                        $flag = 0;


                        // обработка уровня fio
                        $count_test_fio_target = 0;
                        $count_test_fio_fact = 0;
                        $count_doc_fio_target = 0;
                        $count_doc_fio_fact = 0;
                        foreach($test_array as $fio_item){
                            if($fio_item['EMPLOY'] == $emp){
                                // тесты
                                ++$count_test_fio_target;
                                if($fio_item['FinishStep']!='Не прошел'){
                                    ++$count_test_fio_fact;
                                }

                                // документы
                                if($fio_item['doc_all']){
                                    ++$count_doc_fio_target;
                                    if($fio_item['FinishStep']!='Не прошел'){
                                        ++$count_doc_fio_fact;
                                    }
                                }
                            }
                        }
                        //

                        // собираем элементы - сотрудник
                        $count_test_fio_fact = $count_test_fio_fact + $count_doc_fio_fact;
                        $count_test_fio_target = $count_test_fio_target + $count_doc_fio_target;
                        $fio_test_proc = round($count_test_fio_fact/$count_test_fio_target*100);
                        $test_fio_html .= ' <div class="fio_box none" emp_id="'. $emp .'" dol="'. $test_item['name'] .'"  fio="'. $test_item['fio'] .'" fact="'. $count_test_fio_fact .'" target="'. $count_test_fio_target .'">
                                            <div class="dol_row">'. $test_item['name'] .'</div>
                                            <div class="fio_row">'. $test_item['fio'] .'</div>
                                              <span class="progress-number"><b>'. $count_test_fio_fact .'</b>/'.$count_test_fio_target.'</span>

                                                <div class="progress_line">
                                               <div class="progress-bar progress-bar-aqua" style="width: '. $fio_test_proc .'%"></div>
                                            </div>
                                            <div class="people_report" report_type="test"><img src="../../templates/simple_template/images/list.svg"></div>
                                            </div>';

                        $people_proc_target += $count_test_fio_target;
                        $people_proc_fact += $count_test_fio_fact;
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



            $test_fio_html .='</div>';

            $endPHP = microtime(true) - $startPHP;
            $timePHP += $endPHP;

            // документы
            $sql="SELECT *
                    FROM form_status_now,employees_items_node,organization_structure
                    LEFT JOIN organization_structure AS parent_org ON parent_org.id = ". $dir_array_item ."
                    WHERE form_status_now.author_employee_id = employees_items_node.employe_id
                    AND employees_items_node.org_str_id = organization_structure.id
                    AND organization_structure.left_key >=parent_org.left_key
                    AND organization_structure.right_key <= parent_org.right_key
                    AND form_status_now.step_id is not NULL
                    AND organization_structure.company_id = ". $_SESSION['control_company'];

            $startSQL = microtime(true);
            $result= $db->all($sql);
            $endSQL = microtime(true) - $startSQL;
            $timeSQL += $endSQL;


            $startPHP = microtime(true);
            $doc_count_end = 0;
            foreach($result as $item){
                ++$doc_count_end;
            }


            // уровнять по длинне для сравниения для коректного суммирования на клиете
            $left_key = str_pad($left_key, 3, "0", STR_PAD_LEFT);
            $right_key = str_pad($right_key, 3, "0", STR_PAD_LEFT);

            $people_proc = round($people_proc_fact/$people_proc_target*100);

            $test_fact = $test_fact + $doc_count_end;

            $test_target = $test_target + $doc_count_all;
            $test_proc = round($test_fact/$test_target*100);
            $node_report_test .= '<div class="progress-group" level="'. $level .'" left_key="'. $left_key .'" right_key="'. $right_key .'" fact="'. $test_fact .'" target="'. $test_target .'"> ';
            $node_report_test .=     '<div class="progress-text-row click_area"> ';
            $node_report_test .=         '<span class="progress-text">'. $name .'</span>';
            $node_report_test .=         '<span class="progress-number"><b class="num_fact">'. $test_fact .'</b>/'. $test_target .'</span>';
            $node_report_test .=     '</div> ';
            $node_report_test .=     '<div class="progress_line">';
            $node_report_test .=         '<div class="progress-bar progress-bar-aqua" style="width: '.$test_proc.'%"></div>';
            $node_report_test .=     '</div> <div class="icon"><img src="../../templates/simple_template/images/tasks.svg"></div>';
            $node_report_test .=     '<div class="people none progress-group"><div class="people_title">Сотрудники
                                        <span class="progress-number  progress_number_people"><b >'. $people_proc_fact .'</b>/'. $people_proc_target .'</span>
                                        <div class="progress_line progress_line_people">
                                            <div class="progress-bar progress-bar-aqua" style="width: '.$people_proc.'%">
                                        </div>
                                        </div>
                                      </div>'.$test_fio_html .'</div>';
            $node_report_test .= '</div>';

            $endPHP = microtime(true) - $startPHP;
            $timePHP += $endPHP;
        }


        $html = str_replace('%node_report_test%', $node_report_test, $html);


        $result_array['timePHP'] = $timePHP;
        $result_array['timeSQL'] = $timeSQL;
        $result_array['content'] = $html;
        $result_array['status'] = "ok";
        // Отправили зезультат
        return json_encode($result_array);
    }
    // возвращаем цвет в зависимости от процента
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



    public function journal(){

        global $db,$labro;


        if (!(isset($_SESSION['control_company']))) {
            if ($_SESSION['role_id'] == 1) {
                header("Location:/company_control");
            } else {
                header("Location:/login");
            }


        }

        // границы дозволенного
        $keys =  $labro->observer_keys($_SESSION['employee_id']);
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];

        $html = "";

        $sql = "(SELECT local_alerts.save_temp_files_id, save_temp_files.name AS file, local_alerts.id,local_alerts.action_type_id,
                    form_step_action.action_name,form_step_action.user_action_name,
                    CONCAT_WS (' ',init_em.surname , init_em.name, init_em.second_name) AS fio, local_alerts.step_id,init_em.id AS em_id,
                    local_alerts.date_create,   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir,
                    items_control.name AS `position`,document_status_now.name as doc_status, route_control_step.step_name AS manual,
                    document_status_now.id AS doc_trigger
                    FROM (local_alerts,employees_items_node, employees AS init_em,
                    cron_action_type, form_step_action , fact_organization_structure AS bounds)
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

                    WHERE local_alerts.company_id = " . $_SESSION['control_company'] . "

                        AND local_alerts.initiator_employee_id = init_em.id
                        AND form_step_action.id = local_alerts.action_type_id
                        AND local_alerts.date_finish IS NULL
                        AND employees_items_node.employe_id =  local_alerts.initiator_employee_id
                        AND employees_items_node.org_str_id = bounds.id
                        AND bounds.left_key > ". $node_left_key ."
                        AND bounds.right_key < ". $node_right_key ."
                         GROUP BY local_alerts.id   )
     UNION
     (SELECT local_alerts.save_temp_files_id, NULL,NULL, local_alerts.action_type_id,NULL, NULL,CONCAT_WS (' ',sump_for_employees.surname , sump_for_employees.name, sump_for_employees.patronymic) AS fio,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL
		FROM local_alerts, sump_for_employees,fact_organization_structure
		WHERE local_alerts.action_type_id IN (17,18,19)
		AND local_alerts.company_id =  " . $_SESSION['control_company'] . "
		AND sump_for_employees.dol_id = fact_organization_structure.id
      AND fact_organization_structure.left_key > ". $node_left_key ."
      AND fact_organization_structure.right_key < ". $node_right_key ."
		AND sump_for_employees.id = local_alerts.save_temp_files_id)";
//        echo $sql;
        $alert_every_days = $db->all($sql);
        $count = 0;
        foreach ($alert_every_days as $alert_every_day) {
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

        return $html;



    }
    public function events($get_date){
        global $db;

        $green = '#00a65a';
        $yellow = '#f39c12';
        $gray =  '#a6a6a6';
        $red = '#f44336';
        $blue = "#4285f4";

        $today = date("Y-m-d");


        $sql="SELECT
/* Вывод даннных */
route_control_step.track_number_id AS id,
  employees.id AS employee_id,
  employees.surname,
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
    (route_doc.organization_structure_id IS NULL
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
//            $result_array [$key]['title']= $briefing['step_name'];
            $result_array [$key]['id']= $briefing['id'];
            $result_array [$key]['surname']= $briefing['surname'];
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
                        $next_data =  (strtotime("+".$periodicity." month", strtotime($briefing['data_finish'])));
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

// принимаем гет запрос по датам
        $get_dates = explode('&', $get_date);
        $get_dates_start = str_replace('start=', '', $get_dates[0]);
        $get_dates_end = str_replace('end=', '', $get_dates[1]);


        // массив уникальных дат
        $dir_array = array();
        foreach ($result_array as $item) {
            $dir_array[] = $item['start'];
        }
        $dir_array = array_unique($dir_array);
        // перебираем для схлопывания по дате
        $result_array_two = array();
        $count_two = 0;
        foreach ($dir_array as $date) {
            $count = 0;
            if(($get_dates_start <= $date)&&(($get_dates_end >= $date))) {
                foreach ($result_array as $item) {
                    // создаём для дня один элемент
                    if ($date == $item['start']) {
                        if ($count < 4) {
                            $result_array_two[$count_two + $count]['id'] = $item['id'];
                            $result_array_two[$count_two + $count]['title'] = $item['surname'];
                            $result_array_two[$count_two + $count]['emp'] = $item['emp'];
                            $result_array_two[$count_two + $count]['start'] = $item['start'];
                            $result_array_two[$count_two + $count]['periodicity'] = $item['id'];
                            $result_array_two[$count_two + $count]['textColor'] = '#fff';
                            $result_array_two[$count_two + $count]['type'] = "item";
                            $result_array_two[$count_two + $count]['data_str'] = $item['start'];
                            if ((strtotime("-7 day", strtotime($today))) < (strtotime($date))) {
                                $result_array_two[$count_two + $count]['backgroundColor'] = $blue;
                            }
                            if ((strtotime("-7 day", strtotime($today))) > (strtotime($date))) {
                                $result_array_two[$count_two + $count]['backgroundColor'] = $yellow;
                            }
                            if ((strtotime("-0 day", strtotime($today))) > (strtotime($date))) {
                                $result_array_two[$count_two + $count]['backgroundColor'] = $red;
                            }
                        }
                        if($count >= 4){
                            $result_array_two[$count_two + 3]['backgroundColor'] = $gray;
                            $result_array_two[$count_two + 3]['id'] = $item['id'];
                            $result_array_two[$count_two + 3]['title'] = $count - 3;
                            $result_array_two[$count_two + 3]['emp'] = $item['emp'];
                            $result_array_two[$count_two + 3]['start'] = $item['start'];
                            $result_array_two[$count_two + 3]['periodicity'] = $item['id'];
                            $result_array_two[$count_two + 3]['textColor'] = '#fff';
                            $result_array_two[$count_two + 3]['type'] ="all";
                            $result_array_two[$count_two + 3]['data_str'] = $item['start'];
                        }
                        ++$count;
                    }
                }
                // количество событий в один день
//                $result_array_two[$count_two + $count]['title'] = $count;
                ++$count_two;
            }
        }

        // Отправили зезультат
        return json_encode($result_array_two);
    }

    public function calendar($get_date) {
        global $db, $labro;

        $get_dates = explode('&', $get_date);
        $get_dates_start = str_replace('start=', '', $get_dates[0]);
        $get_dates_end = str_replace('end=', '', $get_dates[1]);

        $green = '#00a65a';
        $yellow = '#f39c12';
        $gray = '#a6a6a6';
        $red = '#f44336';
        $blue = "#4285f4";
        $today = date("Y-m-d");

        // границы дозволенного
        $keys =  $labro->observer_keys($_SESSION['employee_id']);
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];


        $sql = "SELECT calendar.*
                    FROM calendar,employees_items_node, fact_organization_structure
                    WHERE calendar.company_id = " . $_SESSION['control_company'] . "
                    AND calendar.`start` >= '". $get_dates_start ."'
                    AND calendar.`start` <= '". $get_dates_end ."'
                    AND calendar.emp_id = employees_items_node.employe_id
                    AND fact_organization_structure.id = employees_items_node.org_str_id
                    AND fact_organization_structure.left_key > ". $node_left_key ."
                    AND fact_organization_structure.right_key < ". $node_right_key ;
        $calendar = $db->all($sql);

        $dir_array = array();
        foreach ($calendar as $item) {
            $dir_array[] = $item['start'];
        }
        $dir_array = array_unique($dir_array);

        // перебираем для схлопывания по дате
        $result_array = array();
        $key = 0;
        foreach ($dir_array as $date) {
            $count = 0;
            foreach ($calendar as $event) {
                // создаём для дня один элемент
                if ($date == $event['start']) {
                    if($count == 0) {
                        $result_array[$key]['id'] = $key;
                        $result_array[$key]['emp_id'] = $event['emp_id'];
                        $result_array[$key]['start'] = $event['start'];
                        $result_array[$key]['textColor'] = '#fff';
                        $result_array[$key]['allDay'] = 'true';
                        $result_array[$key]['type'] = $event['event_type'];
                        $result_array[$key]['data_str'] = $event['start'];
                        if ((strtotime("-7 day", strtotime($today))) < (strtotime($event['start']))) {
                            $result_array[$key]['backgroundColor'] = $blue;
                        }
                        if ((strtotime("-7 day", strtotime($today))) > (strtotime($event['start']))) {
                            $result_array[$key]['backgroundColor'] = $yellow;
                        }
                        if ((strtotime("-0 day", strtotime($today))) > (strtotime($event['start']))) {
                            $result_array[$key]['backgroundColor'] = $red;
                        }
                    }
                    ++$count;

                }

            }
            $result_array[$key]['title'] = $count . " ";
            ++$key;
        }


        // Отправили зезультат
        return json_encode($result_array);
    }
}
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
        // перенапровление если нет подключенной компании
        if(!(isset($_SESSION['control_company']))){
            $result_array['status'] = "not company";
            $result = json_encode($result_array, true);
            die($result);
        }
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
        // если сработал выбор по отделам
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

        // считаем законьченные документы
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

//        bg-green, bg-aqua,bg-red,bg-yellow
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

                        // собираем элементы - сотрудник
                        $count_test_fio_fact = $count_test_fio_fact + $count_doc_fio_fact;
                        $count_test_fio_target = $count_test_fio_target + $count_doc_fio_target;
                        $fio_test_proc = round($count_test_fio_fact/$count_test_fio_target*100);
                        $test_fio_html .= ' <div class="fio_box none" >
                                            <div class="dol_row">'. $test_item['name'] .'</div>
                                            <div class="fio_row">'. $test_item['fio'] .'</div>
                                              <span class="progress-number"><b>'. $count_test_fio_fact .'</b>/'.$count_test_fio_target.'</span>

                                                <div class="progress_line">
                                               <div class="progress-bar progress-bar-aqua" style="width: '. $fio_test_proc .'%"></div>
                                            </div>
                                            <div class="people_report" report_type="test" emp_id="'. $emp .'" ><img src="../../templates/simple_template/images/list.svg"></div>
                                            </div>';



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
            $result= $db->all($sql);
            $doc_count_end = 0;
            foreach($result as $item){
                ++$doc_count_end;
            }


            // уровнять по длинне для сравниения для коректного суммирования на клиете
            $left_key = str_pad($left_key, 3, "0", STR_PAD_LEFT);
            $right_key = str_pad($right_key, 3, "0", STR_PAD_LEFT);

            $test_fact = $test_fact + $doc_count_end;
            $test_target = $test_target + $doc_count_all;
            $test_proc = round($test_fact/$test_target*100);
            $node_report_test .= '<div class="progress-group" level="'. $level .'" left_key="'. $left_key .'" right_key="'. $right_key .'" fact="'. $test_fact .'" target="'. $test_target .'"> ';
            $node_report_test .=     '<div class="progress-text-row"> ';
            $node_report_test .=         '<span class="progress-text">'. $name .'</span>';
            $node_report_test .=         '<span class="progress-number"><b>'. $test_fact .'</b>/'. $test_target .'</span>';
            $node_report_test .=     '</div> ';
            $node_report_test .=     '<div class="progress_line">';
            $node_report_test .=         '<div class="progress-bar progress-bar-aqua" style="width: '.$test_proc.'%"></div>';
            $node_report_test .=     '</div> <div class="icon"><img src="../../templates/simple_template/images/people.svg"></div>';
            $node_report_test .=     '<div class="people none progress-group"><div class="people_title">Сотрудники</div>'.$test_fio_html .'</div>';
            $node_report_test .= '</div>';


        }


        $html = str_replace('%node_report_test%', $node_report_test, $html);
//        $html = str_replace('%node_report_doc%', $node_report_doc, $html);

        $result_array['content'] = $html;
        $result_array['status'] = "ok";
        $result = json_encode($result_array, true);
        die($result);
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
        global $db;


        if(!(isset($_SESSION['control_company']))){
            if($_SESSION['role_id'] == 1){
                header("Location:/company_control");
            } else {
                header("Location:/login");
            }


        }


        $html = "";

        $sql = "SELECT local_alerts.save_temp_files_id, save_temp_files.name AS file, local_alerts.id,local_alerts.action_type_id,
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

                    WHERE local_alerts.company_id = ". $_SESSION['control_company'] ."

                        AND local_alerts.initiator_employee_id = init_em.id
                        AND form_step_action.id = local_alerts.action_type_id
                        AND local_alerts.date_finish IS NULL
                         GROUP BY local_alerts.id";
          $alert_every_days = $db->all($sql);
          $count = 0;
         foreach ($alert_every_days as $alert_every_day) {
             // лимит
             if($count < 7){
                 $html .='<li>
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
                  style=" font-size: 13px;width: 75%;cursor: pointer;">'. $alert_every_day['fio'] ." / ". $alert_every_day['file'] .'</span>
                <!-- Emphasis label -->
                    <small class="label label-danger" style="line-height: 31px;" ><i class="fa fa-clock-o"></i> '. date_create( $alert_every_day['date_create'])->Format('d-m-Y') .'</small>
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
}
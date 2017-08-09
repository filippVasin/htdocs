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
                  AND company_temps.company_id =  '". $_SESSION['control_company'] ."'
                  AND employees.id = save_temp_files.employee_id";




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
                            GROUP BY save_temp_files.id
                            ORDER BY
                              emp";
            }

            // если надо показать документы по определённому узлу
            if (($left_key != 0) && ($right_key != 0)) {
                $sql .= " AND organization_structure.left_key >= " . $left_key . "
                                    AND organization_structure.right_key <= " . $right_key . "
                                    GROUP BY save_temp_files.id
                                    ORDER BY
                                      emp";
            }

            // если показать с удалёнными сотрудниками
            if (($left_key == 1) && ($right_key == 0)) {
                $sql .= " GROUP BY save_temp_files.id
                                            ORDER BY
                                              emp";
            }


            $docs_array = $db->all($sql);
            $html = "";
            foreach ($docs_array as $docs_array_item) {
                // проверяем по фильтрам
                if (($docs_array_item['doc_status_id'] == $select_item_status) || ($select_item_status == "")) {
                    if (($docs_array_item['action_triger'] == $select_item) || ($select_item == "")) {
                        $html .= '<div class="report_step_row"  file_id="' . $docs_array_item['file_id'] . '" fio="' . $docs_array_item['fio'] . '" dol="' . $docs_array_item['dol'] . '"  name="' . $docs_array_item['name'] . '">
                        <div  class="number_doc">' . $docs_array_item['file_id'] . '</div>
                        <div  class="fio">' . $docs_array_item['fio'] . '</div>
                        <div class="otdel">' . $docs_array_item['otdel'] . '</div>
                        <div class="position">' . $docs_array_item['dol'] . '</div>
                        <div  class="doc_name">' . $docs_array_item['name'] . '</div>
                        <div  class="doc_type">' . $docs_array_item['form_type'] . '</div>
                        <div class="action">' . $docs_array_item['user_action_name'] . '</div>
                        <div class="status">' . $docs_array_item['doc_status'] . '</div>
                        <div  class="status_date">' . $docs_array_item['step_end_time'] . '</div>
                    </div>';
                    }
                }
            }

            $sql = "SELECT document_status_now.name, document_status_now.id
                  FROM document_status_now";
            $select_array = $db->all($sql);
            $status_select = "<option value='' >Все статусы</option>";
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
        }
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

        $sql ="SELECT history_forms.id , form_step_action.user_action_name,document_status_now.name AS doc_status,
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
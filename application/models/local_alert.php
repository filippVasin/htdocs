<?php

class Model_local_alert{
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

        $select_item = $this->post_array['select_item'];
        $select_item_em = $this->post_array['select_item_em'];
        $group = $this->post_array['group'];
        $left_key = $this->post_array['left_key'];
        $right_key = $this->post_array['right_key'];
        $time_from = $this->post_array['time_from'];
        $time_to = $this->post_array['time_to'];

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



// запрашиваем все алерты(документ на подпись)
        $sql = "SELECT local_alerts.save_temp_files_id, save_temp_files.name AS file, local_alerts.id,local_alerts.cron_action_type_id,
CONCAT_WS (' ',init_em.surname , init_em.name, init_em.second_name) AS fio, local_alerts.step_id,init_em.id AS em_id,
local_alerts.date_create,   CONCAT_WS (' - ',items_control_types.name, item_par.name) AS dir,
items_control.name AS `position`,document_status_now.name as doc_status, route_control_step.step_name AS manual,
document_status_now.id AS doc_trigger
FROM (local_alerts,employees_items_node, employees AS init_em,
cron_action_type)
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
AND local_alerts.date_finish IS NULL
AND (local_alerts.cron_action_type_id = 3 OR local_alerts.cron_action_type_id = 4)";

        // если указаны даты выборки
        if ($time_from != "") {
            $sql .= " AND DATE(local_alerts.date_create) >= STR_TO_DATE('". $time_from ."', '%m/%d/%Y %h%i')";
        }
        if ($time_to != "") {
            $sql .= " AND DATE(local_alerts.date_create) <= STR_TO_DATE('". $time_to ."', '%m/%d/%Y %h%i')";
        }


        // если надо показать документы по всем узлам
        if(($left_key == 0)&&($right_key==0)){
            $sql .= " AND organization_structure.left_key >= 1";
        }

        // если надо показать документы по определённому узлу
        if(($left_key != 0)&&($right_key!=0)){
            $sql .= " AND organization_structure.left_key >= ". $left_key."
                                    AND organization_structure.right_key <= " .$right_key;
        }


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
            $html = "Нет доступа";
        } else {
            // упорядочить по сотрудникам
            if ($group == "emp") {
                $sql .= " ORDER BY fio";
            }
            // упорядочить по должности
            if ($group == "pos") {
                $sql .= " ORDER BY position";
            }
            $sql .= " GROUP BY local_alerts.id";
//        echo $sql;
            $alert_every_days = $db->all($sql);

            $html = "";
            $employees = array();
            foreach ($alert_every_days as $key => $alert_every_day) {
                        $html .= '<div class="alert_row" observer_em=' . $_SESSION['employee_id'] . '
                                                    dol="' . $alert_every_day['position'] . '"
                                                    emp="' . $alert_every_day['em_id'] . '"
                                                    doc_trigger="' . $alert_every_day['doc_trigger'] . '"
                                                     dir="' . $alert_every_day['dir'] . '"
                                                     doc="' . $alert_every_day['file'] . '"
                                                     name="' . $alert_every_day['fio'] . '"
                                                     local_id="' . $alert_every_day['id'] . '"
                                                      file_id="' . $alert_every_day['save_temp_files_id'] . '"
                                                      action_type="' . $alert_every_day['cron_action_type_id'] . '">
                        <div  class="number_doc">' . $alert_every_day['id'] . '</div>
                        <div  class="fio">' . $alert_every_day['fio'] . '</div>
                        <div class="otdel">' . $alert_every_day['dir'] . '</div>
                        <div class="position">' . $alert_every_day['position'] . '</div>
                        <div  class="doc_name">' . $alert_every_day['file'] . '</div>
                        <div  class="doc_type">' . $alert_every_day['doc_status'] . '</div>
                        <div class="status">' . $alert_every_day['manual'] . '</div>
                        <div class="status_date">' . $alert_every_day['date_create'] . '</div>
                    </div>';
            }

            $select_em = "<option value='' >Все сотрудники</option>";
            $emp = 0;
            foreach ($alert_every_days as $alert_every_day) {
                if($alert_every_day['em_id'] != $emp) {
                    $select_em .= "<option value='" . $alert_every_day['em_id'] . "'>" . $alert_every_day['fio'] . "</option>";
                    $emp =  $alert_every_day['em_id'];
                }
            }


            $sql = "Select document_status_now.name,document_status_now.id
        FROM document_status_now";
            $select_array = $db->all($sql);
            $select = "<option value='' >Все статусы</option>";
            foreach ($select_array as $select_array_item) {
                $select .= "<option value='" . $select_array_item['id'] . "'>" . $select_array_item['name'] . "</option>";
            }


            $result_array['select'] = $select;
            $result_array['select_em'] = $select_em;

        }
        $result_array['content'] = $html;
        $result = json_encode($result_array, true);
        die($result);
    }


    // запрос на дерево позиций
    public function new_action_name(){
        global $db;
        $trigger = $this->post_array['trigger'];
        $action_name = $this->post_array['action_name'];

        $sql = "UPDATE `form_step_action` SET `user_action_name`= '". $action_name ."'  WHERE  `action_triger`='".$trigger ."'";
        $db->query($sql);




        $html ="";
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }


}
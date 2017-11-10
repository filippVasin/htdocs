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
        global $db,$labro;

//        $select_item_status = $_SESSION['select_item_status_local_alert'];
//        $select_item = $_SESSION['select_item_local_alert'];
        $date_from = $_SESSION['date_from_local_alert'];
        $date_to = $_SESSION['date_to_local_alert'];

        if(!isset($_SESSION['select_item_local_alert'])){
            $_SESSION['select_item_local_alert'] = "";
        }
        if($_SESSION['select_item_local_alert'] == "Все"){
            $_SESSION['select_item_local_alert'] = "";
        }

        // границы дозволенного
        $keys =  $labro->observer_keys();
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];


        if(!isset($_SESSION['left_key_local_alert'])){
            $_SESSION['left_key_local_alert'] = 0;
        }
        if(!isset($_SESSION['right_key_local_alert'])){
            $_SESSION['right_key_local_alert'] = 0;
        }

        $left_key = $_SESSION['left_key_local_alert'];
        $right_key = $_SESSION['right_key_local_alert'];
// запрашиваем все алерты(документ на подпись)
        $sql = "(SELECT local_alerts.save_temp_files_id, save_temp_files.name AS file, local_alerts.id,local_alerts.action_type_id,
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
                        AND bounds.left_key > ". $node_left_key ."
                        AND bounds.right_key < ". $node_right_key ."";

        // если указаны даты выборки
        if ($date_from != "") {
            $sql .= " AND DATE(local_alerts.date_create) >= STR_TO_DATE('". $date_from ."', '%d.%m.%Y')";
        }
        if ($date_to != "") {

            $sql .= " AND DATE(local_alerts.date_create) <= STR_TO_DATE('". $date_to ."', '%d.%m.%Y')";
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


        // без доступа
        if($node_left_key == 0 ) {
            // не показываем ничего
            $html = "Нет доступа";
        } else {

            $sql .= " GROUP BY local_alerts.id";

            $sql .= " )
     UNION
     (SELECT local_alerts.save_temp_files_id, NULL,NULL, local_alerts.action_type_id,NULL, NULL,CONCAT_WS (' ',sump_for_employees.surname , sump_for_employees.name, sump_for_employees.patronymic) AS fio,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL
		FROM local_alerts, sump_for_employees,organization_structure
		WHERE local_alerts.action_type_id = 17
		AND local_alerts.company_id =  " . $_SESSION['control_company'] . "
		AND sump_for_employees.dol_id = organization_structure.id
      AND organization_structure.left_key > ". $node_left_key ."
      AND organization_structure.right_key < ". $node_right_key ."
		AND sump_for_employees.id = local_alerts.save_temp_files_id)";


            $alert_every_days = $db->all($sql);

            $html = "";
            $employees = array();
            foreach ($alert_every_days as $key => $alert_every_day) {
                $html .= '<tr class="alert_row" observer_em=' . $_SESSION['employee_id'] . '
                                                    dol="' . $alert_every_day['position'] . '"
                                                    emp="' . $alert_every_day['em_id'] . '"
                                                    doc_trigger="' . $alert_every_day['doc_trigger'] . '"
                                                     dir="' . $alert_every_day['dir'] . '"
                                                     doc="' . $alert_every_day['file'] . '"
                                                     name="' . $alert_every_day['fio'] . '"
                                                     local_id="' . $alert_every_day['id'] . '"
                                                      file_id="' . $alert_every_day['save_temp_files_id'] . '"
                                                      action_type="' . $alert_every_day['action_type_id'] . '">
                        <td >' . $alert_every_day['id'] . '</td>
                        <td >' . $alert_every_day['fio'] . '</td>
                        <td >' . $alert_every_day['dir'] . '</td>
                        <td >' . $alert_every_day['position'] . '</td>
                        <td >' . $alert_every_day['file'] . '</td>
                        <td >' . $alert_every_day['doc_status'] . '</td>
                        <td >' . $alert_every_day['manual'] . '</td>
                        <td >' . $alert_every_day['date_create'] . '</td>
                    </tr>';
            }

            $select_em = "<option value='' >Все сотрудники</option>";
            $emp = 0;
            foreach ($alert_every_days as $alert_every_day) {
                if ($alert_every_day['em_id'] != $emp) {
                    $select_em .= "<option value='" . $alert_every_day['em_id'] . "'>" . $alert_every_day['fio'] . "</option>";
                    $emp = $alert_every_day['em_id'];
                }
            }


            $sql = "Select document_status_now.name,document_status_now.id
        FROM document_status_now";
            $select_array = $db->all($sql);
            $select = "<option value='' >Все статусы</option>";
            foreach ($select_array as $select_array_item) {
                $select .= "<option value='" . $select_array_item['id'] . "'>" . $select_array_item['name'] . "</option>";
            }

        }

//        return  '<div id="selects">' . $status_select . $select . '</div>'. $html;
        return $html;
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


    public function select(){
        $select_item = $this->post_array['select_item'];
        $left_key = $this->post_array['left_key'];
        $right_key = $this->post_array['right_key'];
        $date_from = $this->post_array['date_from'];
        $date_to = $this->post_array['date_to'];
        $select_item_status = $this->post_array['select_item_status'];

        $_SESSION['select_item_status_local_alert'] = $select_item_status;
        $_SESSION['select_item_local_alert'] = $select_item;
        $_SESSION['left_key_local_alert'] = $left_key;
        $_SESSION['right_key_local_alert'] = $right_key;
        $_SESSION['date_from_local_alert'] = $date_from;
        $_SESSION['date_to_local_alert'] = $date_to;
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

    public function date_from(){
        return $_SESSION['date_from_local_alert'];
    }
    public function date_to(){
        return $_SESSION['date_to_local_alert'];
    }



}
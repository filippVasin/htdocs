<?php

class Model_local_alert
{
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
        global $db, $labro;

//        $select_item_status = $_SESSION['select_item_status_local_alert'];
//        $select_item = $_SESSION['select_item_local_alert'];
        $date_from = $_SESSION['date_from_local_alert'];
        $date_to = $_SESSION['date_to_local_alert'];

        if (!isset($_SESSION['select_item_local_alert'])) {
            $_SESSION['select_item_local_alert'] = "";
        }
        if ($_SESSION['select_item_local_alert'] == "Все") {
            $_SESSION['select_item_local_alert'] = "";
        }

        // границы дозволенного
        $keys = $labro->observer_keys($_SESSION['employee_id']);
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];


        if (!isset($_SESSION['left_key_local_alert'])) {
            $_SESSION['left_key_local_alert'] = 0;
        }
        if (!isset($_SESSION['right_key_local_alert'])) {
            $_SESSION['right_key_local_alert'] = 0;
        }

        $left_key = $_SESSION['left_key_local_alert'];
        $right_key = $_SESSION['right_key_local_alert'];

        $observer = $labro->get_org_str_id($_SESSION['employee_id']);

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
                        AND
                        (
                            ( bounds.left_key > " . $node_left_key . "
                                AND bounds.right_key < " . $node_right_key . "
                            )
                            OR local_alerts.observer_org_str_id = ". $observer ."
                        )";




        // если указаны даты выборки
        if ($date_from != "") {
            $sql .= " AND DATE(local_alerts.date_create) >= STR_TO_DATE('" . $date_from . "', '%d.%m.%Y')";
        }
        if ($date_to != "") {

            $sql .= " AND DATE(local_alerts.date_create) <= STR_TO_DATE('" . $date_to . "', '%d.%m.%Y')";
        }


        // если надо показать документы по всем узлам
        if (($left_key == 0) && ($right_key == 0)) {
            $sql .= " AND organization_structure.left_key >= 1";
        }

        // если надо показать документы по определённому узлу
        if (($left_key != 0) && ($right_key != 0)) {
            $sql .= " AND organization_structure.left_key >= " . $left_key . "
                                    AND organization_structure.right_key <= " . $right_key;
        }




            $sql .= " GROUP BY local_alerts.id";

            $sql .= " )
     UNION
     (SELECT local_alerts.save_temp_files_id, NULL,NULL, local_alerts.action_type_id,NULL, NULL,CONCAT_WS (' ',sump_for_employees.surname , sump_for_employees.name, sump_for_employees.patronymic) AS fio,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL
		FROM local_alerts, sump_for_employees,organization_structure
		WHERE
		local_alerts.action_type_id IN (14,17,18,19)
		AND local_alerts.company_id =  " . $_SESSION['control_company'] . "
		AND sump_for_employees.id = local_alerts.save_temp_files_id
		AND sump_for_employees.dol_id = organization_structure.id
		AND
		(
			( organization_structure.left_key > " . $node_left_key . "
      	AND organization_structure.right_key < " . $node_right_key . "
			)
		OR local_alerts.observer_org_str_id = ". $observer ."
		))";


            $alert_every_days = $db->all($sql);


        // фильтр фактической структуры
        $keys =  $labro->fact_observer_keys($_SESSION['employee_id']);
        $node_left_key = $keys['left'];
        $node_right_key = $keys['right'];
        $sql = "SELECT employees_items_node.employe_id
                    FROM fact_organization_structure, employees_items_node
                    WHERE employees_items_node.fact_org_str_id = fact_organization_structure.id
                    AND fact_organization_structure.left_key >= ". $node_left_key ."
                    AND fact_organization_structure.right_key <= ". $node_right_key ."
                    AND fact_organization_structure.company_id = ". $_SESSION['control_company'];
        $visible_emps = $db->all($sql);

        // удаляем строки с сотрудниками которые не надо показывать конкретному боссу
        $new_arr = array();
        foreach($visible_emps as $emp){
            foreach($alert_every_days as $key=>$cal){
                if($cal['em_id'] == $emp['employe_id']){
                    $new_arr[] = $alert_every_days[$key];
                }
            }
        }
        // обавляем уведомления с неоформленным сотрудником
        foreach($alert_every_days as $key=>$cal){
            if($cal['em_id'] == ""){
                $new_arr[] = $alert_every_days[$key];
            }
        }
        $alert_every_days = $new_arr;

            $html = "";
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



//        return  '<div id="selects">' . $status_select . $select . '</div>'. $html;
        return $html;
    }


    // запрос на дерево позиций
    public function new_action_name(){
        global $db;
        $trigger = $this->post_array['trigger'];
        $action_name = $this->post_array['action_name'];

        $sql = "UPDATE `form_step_action` SET `user_action_name`= '" . $action_name . "'  WHERE  `action_triger`='" . $trigger . "'";
        $db->query($sql);


        $html = "";
        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function select()
    {
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
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function date_from()
    {
        return $_SESSION['date_from_local_alert'];
    }

    public function date_to()
    {
        return $_SESSION['date_to_local_alert'];
    }


    public function internship_list()
    {
        global $db;

        $html = '<label>Номер Приказ:</label>
                     <input class="form-control tab_vs_enter_inst"  id="18_order_number">
                     <label>Дата Приказа:</label>
                     <input class="form-control valid_date tab_vs_enter_inst"  id="18_order_date">
                     <label>Наставник:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_inst"  id="18_mentor">
                                <option value="0"></option>
                                %mentor%
                            </select>
                        </div>

                     <label>Маршрут:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_inst"  id="18_route">
                                <option value="0"></option>
                                %route%
                            </select>
                        </div>
                     <label>Автобус:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_inst"  id="18_bus">
                                <option value="0"></option>
                                %bus%
                            </select>
                        </div>
                     <label>Длительность стажировки:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_inst"  id="18_hours">
                                <option value="0"></option>
                                <option value="16">16 часов</option>
                                <option value="24">24 часа</option>
                                <option value="32">32 часа</option>
                            </select>
                        </div>
                     <label>Дата инструктажа:</label>
                     <input class="form-control valid_date tab_vs_enter_inst"  id="18_inst_date">';

//        <option value="0">Уволен</option>
//        <option value="1">Работает</option>

        // ищим наставников
        $sql = "SELECT employees.id, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM employees,employees_items_node,organization_structure
                WHERE organization_structure.kladr_id = 179
                AND employees_items_node.org_str_id = organization_structure.id
                AND
					 (employees.id = employees_items_node.employe_id
                 OR
                 employees.id = 250)";
        $mentor_array = $db->all($sql);

        $mentor_html = "";
        foreach ($mentor_array as $mentor_item) {
            $mentor_html .= '<option value="' . $mentor_item['id'] . '">' . $mentor_item['fio'] . '</option>';
        }
        $html = str_replace('%mentor%', $mentor_html, $html);

        // ищим автобусы
        $sql = "SELECT * FROM bus_list";
        $bus_array = $db->all($sql);

        $bus_html = "";
        foreach ($bus_array as $bus_item) {
            $bus_html .= '<option value="' . $bus_item['id'] . '">' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
        }
        $html = str_replace('%bus%', $bus_html, $html);


        // ищим маршруты
        $sql = "SELECT * FROM bus_list_routes";
        $route_array = $db->all($sql);

        $route_html = "";
        foreach ($route_array as $route_item) {
            $route_html .= '<option value="' . $route_item['id'] . '">' . $route_item['route_name'] . '</option>';
        }
        $html = str_replace('%route%', $route_html, $html);


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    // получаем маршруты автобуса
    public function get_bus_routes()
    {
        global $db;
        $bus_id = $this->post_array['bus_id'];
        $sql = "SELECT bus_list_routes.*
                FROM bus_vs_route, bus_list_routes
                WHERE bus_list_routes.id = bus_vs_route.route_id
                AND bus_vs_route.bus_id =" . $bus_id;
        $route_array = $db->all($sql);
        $html = '<option value="0"></option>';
        foreach ($route_array as $route_item) {
            $html .= '<option value="' . $route_item['id'] . '">' . $route_item['route_name'] . '</option>';
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    // получаем автобусы на маршруте
    public function get_route_buses()
    {
        global $db;
        $route_id = $this->post_array['route_id'];

        $sql = "SELECT bus_list.*
                FROM bus_vs_route, bus_list
                WHERE bus_list.id = bus_vs_route.bus_id
                AND bus_vs_route.route_id =" . $route_id;
        $bus_array = $db->all($sql);
        $html = '<option value="0"></option>';
        foreach ($bus_array as $bus_item) {
            $html .= '<option value="' . $bus_item['id'] . '">' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    // получаем автобусы на маршруте
    public function internship_list_edit()
    {
        global $db;
        $emp_id = $this->post_array['emp'];

        $sql = "SELECT internship_list.*,CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS mentor_fio,
			CONCAT_WS (' ',EMP.surname , EMP.name, EMP.second_name) AS emp_fio,
            bus_list.brand_of_bus, bus_list.gos_number,
            bus_list_routes.route_name,
            ASS_BUS.brand_of_bus AS assigned_brand_of_bus,
            ASS_BUS.gos_number AS assigned_gos_number
            FROM (internship_list, employees, bus_list,bus_list_routes)
            LEFT JOIN bus_list AS ASS_BUS ON ASS_BUS.id = internship_list.assigned_bus_id
            LEFT JOIN employees AS EMP ON EMP.id = internship_list.employee_id
            WHERE internship_list.mentor_id = employees.id
            AND internship_list.bus_id = bus_list.id
            AND internship_list.route_id = bus_list_routes.id
            AND internship_list.employee_id = " . $emp_id;
        $inst_list = $db->row($sql);


        $html = '<label>Сотрудник: </label>' . $inst_list['emp_fio'] . '
                <label>Номер Приказ: </label>' . $inst_list['order'] . '
                <label>Наставник: </label>' . $inst_list['mentor_fio'] . '
                <label>Маршрут: </label>' . $inst_list['route_name'] . '
                <label>Автобус: </label>' . $inst_list['brand_of_bus'] . " - " . $inst_list['gos_number'] . '
                 <label>Длительность стажировки: </label>' . $inst_list['hours_all'] . ' часа
                 <label>Дата инструктажа: </label> ' . date_create($inst_list['date'])->Format('d.m.Y').'
                <label>Назначить на автобус: </label> ' . $inst_list['assigned_brand_of_bus'] . " - " . $inst_list['assigned_gos_number'] ;

        $table_html = ' <br><br>
                        <table id="table_inst_popup" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Маршрут</th>
                                <th>Автобус</th>
                                <th>Кол-во</th>
                                <th>Наставник</th>
                            </tr>
                            </thead>
                            <tbody id="inst_table_router_rows">
                            %table%
                            </tbody>
                        </table>';

        $sql = "SELECT internship_routes.id,
						  internship_routes.inst_date,
						  internship_routes.end,
						  internship_routes.start,
                    bus_list_routes.route_name,
                    bus_list.brand_of_bus,
                    bus_list.gos_number,
                    CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS mentor_fio,
                    internship_routes.hours_all
                    FROM internship_routes,employees,bus_list,bus_list_routes
                    WHERE internship_routes.route_id = bus_list_routes.id
                    AND internship_routes.bus_id = bus_list.id
                    AND internship_routes.mentor_id = employees.id
                    AND internship_routes.employee_id =" . $emp_id;
        $inst_routes = $db->all($sql);
        $html_route = "";
        foreach ($inst_routes as $inst_route) {
            $html_route .= '<tr class="inst_routs_row" id_routs="' . $inst_route['id'] . '">
                                <td >' . date_create($inst_route['inst_date'])->Format('d.m.Y') . " C " . $inst_route['start'] . " по " . $inst_route['end'] .'</td>
                                <td >' . $inst_route['route_name'] . '</td>
                                <td >' . $inst_route['brand_of_bus'] . ' - ' . $inst_route['gos_number'] . '</td>
                                <td >' . $inst_route['hours_all'] . '</td>
                                <td >' . $inst_route['mentor_fio'] . '</td>
                            </tr>';
        }
        if ($html_route != "") {
            $table_html = str_replace('%table%', $html_route, $table_html);
            $html .= $table_html;
        }

        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function internship_list_edit_plus_route()
    {
        global $db;
        $html = '<label>Наставник:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_plus_route"  id="18_mentor_plus">
                                <option value="0"></option>
                                %mentor%
                            </select>
                        </div>

                     <label>Маршрут:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_plus_route"  id="18_route_plus">
                                <option value="0"></option>
                                %route%
                            </select>
                        </div>
                     <label>Автобус:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_plus_route"  id="18_bus_plus">
                                <option value="0"></option>
                                %bus%
                            </select>
                        </div>
                     <label>Дата, время прохождения стажировки:</label>
                     <input class="form-control valid_date tab_vs_enter_plus_route"  id="18_inst_date_plus">
                     <label>Начало:</label>
                     <input class="form-control tab_vs_enter_plus_route valid_time"  id="18_start_plus">
                     <label>Окончание:</label>
                     <input class="form-control tab_vs_enter_plus_route valid_time"  id="18_end_plus">
                     <label>Количество часов:</label>
                     <input class="form-control tab_vs_enter_plus_route"  id="18_hours_plus">';

        // ищим наставников
        $sql = "SELECT employees.id, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM employees,employees_items_node,organization_structure
                WHERE organization_structure.kladr_id = 179
                AND employees_items_node.org_str_id = organization_structure.id
                AND
					 (employees.id = employees_items_node.employe_id
                 OR
                 employees.id = 250)";
        $mentor_array = $db->all($sql);

        $mentor_html = "";
        foreach ($mentor_array as $mentor_item) {
            $mentor_html .= '<option value="' . $mentor_item['id'] . '">' . $mentor_item['fio'] . '</option>';
        }
        $html = str_replace('%mentor%', $mentor_html, $html);

        // ищим автобусы
        $sql = "SELECT * FROM bus_list";
        $bus_array = $db->all($sql);

        $bus_html = "";
        foreach ($bus_array as $bus_item) {
            $bus_html .= '<option value="' . $bus_item['id'] . '">' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
        }
        $html = str_replace('%bus%', $bus_html, $html);


        // ищим маршруты
        $sql = "SELECT * FROM bus_list_routes";
        $route_array = $db->all($sql);

        $route_html = "";
        foreach ($route_array as $route_item) {
            $route_html .= '<option value="' . $route_item['id'] . '">' . $route_item['route_name'] . '</option>';
        }
        $html = str_replace('%route%', $route_html, $html);


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function inst_save_new_route()
    {
        global $db;
        $emp_id = $this->post_array['emp'];
        $mentor_id = $this->post_array['mentor_id'];
        $bus_id = $this->post_array['bus_id'];
        $route_id = $this->post_array['route_id'];
        $hours = $this->post_array['hours'];
        $inst_date = $this->post_array['inst_date'];
        $start = $this->post_array['start'];
        $end = $this->post_array['end'];

        // подготовка дат к записи в базу
        $inst_date = date_create($inst_date)->Format('Y-m-d');

        $sql = "INSERT INTO `internship_routes` (`employee_id`, `inst_date`, `route_id`, `bus_id`, `mentor_id`, `hours_all`, `start`, `end`)
        VALUES ('" . $emp_id . "', '" . $inst_date . "', '" . $route_id . "', '" . $bus_id . "', '" . $mentor_id . "', '" . $hours . "', '" . $start . "', '" . $end . "')";
        $db->query($sql);


        $sql = "SELECT internship_routes.id,
						  internship_routes.inst_date,
						  internship_routes.end,
						  internship_routes.start,
                    bus_list_routes.route_name,
                    bus_list.brand_of_bus,
                    bus_list.gos_number,
                    CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS mentor_fio,
                    internship_routes.hours_all
                    FROM internship_routes,employees,bus_list,bus_list_routes
                    WHERE internship_routes.route_id = bus_list_routes.id
                    AND internship_routes.bus_id = bus_list.id
                    AND internship_routes.mentor_id = employees.id
                    AND internship_routes.employee_id =" . $emp_id;
        $inst_routes = $db->all($sql);
        $html_route = "";
        foreach ($inst_routes as $inst_route) {
            $html_route .= '<tr class="inst_routs_row" id_routs="' . $inst_route['id'] . '">
                                <td >' . date_create($inst_route['inst_date'])->Format('d.m.Y') . " C " . $inst_route['start'] . " по " . $inst_route['end'] .'</td>
                                <td >' . $inst_route['route_name'] . '</td>
                                <td >' . $inst_route['brand_of_bus'] . ' - ' . $inst_route['gos_number'] . '</td>
                                <td >' . $inst_route['hours_all'] . '</td>
                                <td >' . $inst_route['mentor_fio'] . '</td>
                            </tr>';
        }

        $result_array['content'] = $html_route;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function internship_list_edit_route()
    {
        global $db;
        $inst_routs_edit = $this->post_array['inst_routs_edit'];

        $sql = "SELECT * FROM internship_routes WHERE internship_routes.id =" . $inst_routs_edit;
        $inst_route_row = $db->row($sql);

        $route_id_now = $inst_route_row["route_id"];
        $bus_id_now = $inst_route_row["bus_id"];
        $mentor_id_now = $inst_route_row["mentor_id"];
        $hours_all_now = $inst_route_row["hours_all"];
        $inst_date_now = $inst_route_row["inst_date"];
        $inst_start = $inst_route_row["start"];
        $inst_end = $inst_route_row["end"];

        $html = '<label>Наставник:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_edit_route"  id="18_mentor_edit">
                                <option value="0"></option>
                                %mentor%
                            </select>
                        </div>

                     <label>Маршрут:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_edit_route"  id="18_route_edit">
                                <option value="0"></option>
                                %route%
                            </select>
                        </div>
                     <label>Автобус:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_edit_route"  id="18_bus_edit">
                                <option value="0"></option>
                                %bus%
                            </select>
                        </div>

                     <label>Дата инструктажа:</label>
                     <input class="form-control valid_date tab_vs_enter_edit_route"  id="18_inst_date_edit" value="' . date_create($inst_date_now)->Format('d.m.Y') . '">
                     <label>Начало:</label>
                     <input class="form-control tab_vs_enter_edit_route valid_time"  id="18_start" value="' .  $inst_start.'">
                     <label>Конец:</label>
                     <input class="form-control tab_vs_enter_edit_route valid_time"  id="18_end" value="' .  $inst_end.'">
                     <label>Количество часов:</label>
                     <input class="form-control tab_vs_enter_edit_route"  id="18_hours_edit" value="' . $hours_all_now . '">';

        // ищим наставников
        $sql = "SELECT employees.id, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM employees,employees_items_node,organization_structure
                WHERE organization_structure.kladr_id = 179
                AND employees_items_node.org_str_id = organization_structure.id
                AND
					 (employees.id = employees_items_node.employe_id
                 OR
                 employees.id = 250)";
        $mentor_array = $db->all($sql);

        $mentor_html = "";
        foreach ($mentor_array as $mentor_item) {
            if ($mentor_item['id'] == $mentor_id_now) {
                $mentor_html .= '<option value="' . $mentor_item['id'] . '" selected>' . $mentor_item['fio'] . '</option>';
            } else {
                $mentor_html .= '<option value="' . $mentor_item['id'] . '">' . $mentor_item['fio'] . '</option>';
            }
        }
        $html = str_replace('%mentor%', $mentor_html, $html);

        // ищим автобусы
        $sql = "SELECT * FROM bus_list";
        $bus_array = $db->all($sql);

        $bus_html = "";
        foreach ($bus_array as $bus_item) {
            if ($bus_item['id'] == $bus_id_now) {
                $bus_html .= '<option value="' . $bus_item['id'] . '" selected>' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
            } else {
                $bus_html .= '<option value="' . $bus_item['id'] . '">' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
            }
        }
        $html = str_replace('%bus%', $bus_html, $html);


        // ищим маршруты
        $sql = "SELECT * FROM bus_list_routes";
        $route_array = $db->all($sql);

        $route_html = "";
        foreach ($route_array as $route_item) {
            if ($route_item['id'] == $route_id_now) {
                $route_html .= '<option value="' . $route_item['id'] . '" selected>' . $route_item['route_name'] . '</option>';
            } else {
                $route_html .= '<option value="' . $route_item['id'] . '">' . $route_item['route_name'] . '</option>';
            }

        }
        $html = str_replace('%route%', $route_html, $html);


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function inst_edit_new_route()
    {
        global $db;
        $inst_routs_edit = $this->post_array['inst_routs_edit'];
        $mentor_id = $this->post_array['mentor_id'];
        $bus_id = $this->post_array['bus_id'];
        $route_id = $this->post_array['route_id'];
        $hours = $this->post_array['hours'];
        $inst_date = $this->post_array['inst_date'];
        $start = $this->post_array['start'];
        $end = $this->post_array['end'];

        // подготовка дат к записи в базу
        $inst_date = date_create($inst_date)->Format('Y-m-d');

        $sql = "UPDATE `laborpro`.`internship_routes` SET `inst_date`='" . $inst_date . "',
                                                        `route_id`='" . $route_id . "',
                                                         `bus_id`='" . $bus_id . "',
                                                        `mentor_id`='" . $mentor_id . "',
                                                        `hours_all`='" . $hours . "',
                                                        `start`='" . $start . "',
                                                        `end`='" . $end . "'
                                                          WHERE  `id`=" . $inst_routs_edit;
        $db->query($sql);

        $sql = "SELECT *
                    FROM	internship_routes
                    WHERE internship_routes.id =" . $inst_routs_edit;
        $emp_row = $db->row($sql);
        $emp_id = $emp_row['employee_id'];

        $sql = "SELECT internship_routes.id,
						  internship_routes.inst_date,
						  internship_routes.start,
						  internship_routes.end,
                    bus_list_routes.route_name,
                    bus_list.brand_of_bus,
                    bus_list.gos_number,
                    CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS mentor_fio,
                    internship_routes.hours_all
                    FROM internship_routes,employees,bus_list,bus_list_routes
                    WHERE internship_routes.route_id = bus_list_routes.id
                    AND internship_routes.bus_id = bus_list.id
                    AND internship_routes.mentor_id = employees.id
                    AND internship_routes.employee_id =" . $emp_id;
        $inst_routes = $db->all($sql);
        $html_route = "";
        foreach ($inst_routes as $inst_route) {
            $html_route .= '<tr class="inst_routs_row" id_routs="' . $inst_route['id'] . '">
                                <td >' . date_create($inst_route['inst_date'])->Format('d.m.Y') . " C " . $inst_route['start'] . " по " . $inst_route['end'] . '</td>
                                <td >' . $inst_route['route_nasame'] . '</td>
                                <td >' . $inst_route['brand_of_bus'] . ' - ' . $inst_route['gos_number'] . '</td>
                                <td >' . $inst_route['hours_all'] . '</td>
                                <td >' . $inst_route['mentor_fio'] . '</td>
                            </tr>';
        }

        $result_array['content'] = $html_route;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function inst_delete_new_route()
    {
        global $db;
        $inst_routs_edit = $this->post_array['inst_routs_edit'];

        $sql = "SELECT *
                    FROM	internship_routes
                    WHERE internship_routes.id =" . $inst_routs_edit;
        $emp_row = $db->row($sql);
        $emp_id = $emp_row['employee_id'];

        $sql = "DELETE FROM `internship_routes` WHERE  `id`=" . $inst_routs_edit;
        $db->query($sql);


        $sql = "SELECT internship_routes.id,
						  internship_routes.inst_date,
                    bus_list_routes.route_name,
                    bus_list.brand_of_bus,
                    bus_list.gos_number,
                    CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS mentor_fio,
                    internship_routes.hours_all
                    FROM internship_routes,employees,bus_list,bus_list_routes
                    WHERE internship_routes.route_id = bus_list_routes.id
                    AND internship_routes.bus_id = bus_list.id
                    AND internship_routes.mentor_id = employees.id
                    AND internship_routes.employee_id =" . $emp_id;
        $inst_routes = $db->all($sql);
        $html_route = "";
        foreach ($inst_routes as $inst_route) {
            $html_route .= '<tr class="inst_routs_row" id_routs="' . $inst_route['id'] . '">
                                <td >' . date_create($inst_route['inst_date'])->Format('d.m.Y') . '</td>
                                <td >' . $inst_route['route_name'] . '</td>
                                <td >' . $inst_route['brand_of_bus'] . ' - ' . $inst_route['gos_number'] . '</td>
                                <td >' . $inst_route['hours_all'] . '</td>
                                <td >' . $inst_route['mentor_fio'] . '</td>
                            </tr>';
        }

        $result_array['content'] = $html_route;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function edit_instr_list(){
        global $db;
        $emp = $this->post_array['emp'];

        $sql = "SELECT *
                        FROM internship_list
                        WHERE internship_list.employee_id = " . $emp;
        $inst_route_row = $db->row($sql);
        $order = $inst_route_row["order"];
        $order_arr = explode(" от ", $order);
        $order_number = $order_arr[0];
        $order_date = date_create($order_arr[1])->Format('d.m.Y');

        $bus_id_now = $inst_route_row["bus_id"];
        $mentor_id_now = $inst_route_row["mentor_id"];
        $route_id_now = $inst_route_row["route_id"];
        $hours_all_now = $inst_route_row["hours_all"];
        $date_now = $inst_route_row["date"];
        $assigned_bus_id_now = $inst_route_row["assigned_bus_id"];

        $html = '<label>Номер Приказ:</label>
                     <input class="form-control tab_vs_enter_inst"  id="18_order_number_inst_edit" value="' . $order_number . '">
                     <label>Дата Приказа:</label>
                     <input class="form-control valid_date tab_vs_enter_inst"  id="18_order_date_inst_edit" value="' . $order_date . '">
                     <label>Наставник:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_inst"  id="18_mentor_inst_edit">
                                <option value="0"></option>
                                %mentor%
                            </select>
                        </div>

                     <label>Маршрут:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_inst"  id="18_route_inst_edit">
                                <option value="0"></option>
                                %route%
                            </select>
                        </div>
                     <label>Автобус:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_inst"  id="18_bus_inst_edit">
                                <option value="0"></option>
                                %bus%
                            </select>
                        </div>
                     <label>Длительность стажировки:</label>
                     <input class="form-control valid_date tab_vs_enter_inst"  id="18_hours_inst_edit" value="'. $hours_all_now .'">
                     <label>Дата инструктажа:</label>
                     <input class="form-control valid_date tab_vs_enter_inst"  id="18_inst_date_inst_edit" value="'. $date_now .'">
                     <label>Назначить на автобус:</label>
                        <div class="select_triangle" >
                            <select class="form-control tab_vs_enter_inst"  id="18_ass_bus_inst_edit">
                                <option value="0"></option>
                                %ass_bus%
                            </select>
                        </div>';

//        <option value="0">Уволен</option>
//        <option value="1">Работает</option>

        // ищим наставников
        $sql = "SELECT employees.id, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio
                FROM employees,employees_items_node,organization_structure
                WHERE organization_structure.kladr_id = 179
                AND employees_items_node.org_str_id = organization_structure.id
                AND
					 (employees.id = employees_items_node.employe_id
                 OR
                 employees.id = 250)";
        $mentor_array = $db->all($sql);

        $mentor_html = "";
        foreach ($mentor_array as $mentor_item) {
            if($mentor_id_now == $mentor_item['id']) {
                $mentor_html .= '<option value="' . $mentor_item['id'] . '" selected>' . $mentor_item['fio'] . '</option>';
            } else {
                $mentor_html .= '<option value="' . $mentor_item['id'] . '">' . $mentor_item['fio'] . '</option>';
            }
        }
        $html = str_replace('%mentor%', $mentor_html, $html);

        // ищим автобусы
        $sql = "SELECT * FROM bus_list";
        $bus_array = $db->all($sql);

        $bus_html = "";
        foreach ($bus_array as $bus_item) {
            if($bus_id_now == $bus_item['id']){
                $bus_html .= '<option value="' . $bus_item['id'] . '" selected>' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
            } else {
                $bus_html .= '<option value="' . $bus_item['id'] . '">' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
            }
        }
        $html = str_replace('%bus%', $bus_html, $html);

        foreach ($bus_array as $bus_item) {
            if($assigned_bus_id_now == $bus_item['id']) {
                $bus_html .= '<option value="' . $bus_item['id'] . '" selected>' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
            } else {
                $bus_html .= '<option value="' . $bus_item['id'] . '">' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
            }
        }
        $html = str_replace('%ass_bus%', $bus_html, $html);

        // ищим маршруты
        $sql = "SELECT * FROM bus_list_routes";
        $route_array = $db->all($sql);

        $route_html = "";
        foreach ($route_array as $route_item) {
            if($route_id_now == $route_item['id']){
                $route_html .= '<option value="' . $route_item['id'] . '" selected>' . $route_item['route_name'] . '</option>';
            } else {
                $route_html .= '<option value="' . $route_item['id'] . '">' . $route_item['route_name'] . '</option>';
            }

        }
        $html = str_replace('%route%', $route_html, $html);


        $result_array['content'] = $html;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }
    public function edit_instr_list_save() {
        global $db;
        $emp = $this->post_array['emp'];
        $order = $this->post_array['order'];
        $mentor_id = $this->post_array['mentor_id'];
        $bus_id = $this->post_array['bus_id'];
        $route_id = $this->post_array['route_id'];
        $hours = $this->post_array['hours'];
        $inst_date = $this->post_array['inst_date'];
        $ass_bus_id = $this->post_array['ass_bus_id'];


        $inst_date = date_create($inst_date)->Format('Y.m.d');

        $hours_ints = 8;
        $hours_driving = $hours - $hours_ints;
        $sql="UPDATE `internship_list` SET `order`='". $order ."',
                                            `mentor_id`='". $mentor_id ."',
                                             `bus_id`='". $bus_id ."',
                                             `route_id`='". $route_id ."',
                                              `hours_all`='". $hours ."',
                                              `hours_ints`='". $hours_ints ."',
                                               `hours_driving`='". $hours_driving ."',
                                                `date`='". $inst_date ."',
                                                 `assigned_bus_id`='". $ass_bus_id ."'
                                                  WHERE  `employee_id`=". $emp;
        $db->query($sql);
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }

    public function check_inst_complete(){
        global $db;
        $emp = $this->post_array['emp'];
        $sql = "SELECT *
                    FROM internship_list, internship_routes
                    WHERE internship_list.employee_id = ". $emp ."
                    AND internship_routes.employee_id = internship_list.employee_id
                    AND internship_list.assigned_bus_id > 0
                    LIMIT 1";
        $inst_row = $db->row($sql);
        if($inst_row['id'] !=""){
            $content = "yes";
        } else {
            $content = "no";
        }
        $result_array['content'] = $content;
        $result_array['status'] = 'ok';
        // Отправили зезультат
        return json_encode($result_array);
    }


}
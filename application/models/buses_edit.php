<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_buses_edit{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function bus_list_table(){
        global $db;

        $company = 29;

          $sql = "SELECT *
                  FROM bus_list
                  WHERE bus_list.company_id =".$company;
        $bus_list_arr = $db->all($sql);
        $html_bus_list = "";
        foreach ($bus_list_arr as $key=>$item) {
            $html_bus_list .= '<tr class="bus_row" item_id="' . $item['id'] . '" brand_of_bus="'. $item['brand_of_bus'] .'" gos_number="'. $item['gos_number'] .'">
                                <td >' . ($key + 1) . '</td>
                                <td class="brand_of_bus">' . $item['brand_of_bus'] . '</td>
                                <td class="gos_number">' . $item['gos_number'] .'</td>
                            </tr>';
        }

        return $html_bus_list;
    }

    public function bus_list_drivers_table(){
        global $db;

        $company = 29;

        $sql = "SELECT bus_list_drivers.id, CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
				employees.surname,
				employees.name,
				employees.second_name,
                CONCAT_WS (', ',bus_list_drivers.phone , bus_list_drivers.phone_2) AS phone_all,
                bus_list_drivers.phone,
                bus_list_drivers.phone_2
                FROM bus_list_drivers,employees
                WHERE bus_list_drivers.company_id = ". $company ."
                AND employees.id = bus_list_drivers.employees_id";
        $drivers_arr = $db->all($sql);
        $html_drivers = "";
        foreach ($drivers_arr as $key=>$item) {
            $html_drivers .= '<tr class="driver_row" item_id="' . $item['id'] . '" fio="'. $item['fio'] .'"  phone="'. $item['phone']  .'" phone_2="'. $item['phone_2']  .'"
             surname="'. $item['surname'] .'"  name="'. $item['name'] .'"  second_name="'. $item['second_name'] .'">
                                <td >' . ($key + 1) . '</td>
                                <td class="fio">' . $item['fio'] . '</td>
                                <td class="phone">' . $item['phone_all'] .'</td>
                            </tr>';
        }

        return $html_drivers;
    }

    public function bus_list_owners_table(){
        global $db;

        $company = 29;

        $sql = "SELECT CONCAT_WS (' ',bus_list_owners.surname , bus_list_owners.name, bus_list_owners.patronymic) AS fio,
				bus_list_owners.surname,
				bus_list_owners.name,
				bus_list_owners.patronymic,
                CONCAT_WS (', ',bus_owner_contacts.phone_one , bus_owner_contacts.phone_two) AS phone_all,
                bus_owner_contacts.phone_one,
				bus_owner_contacts.phone_two,
				bus_list_owners.id
                FROM bus_list_owners,bus_owner_contacts
                WHERE bus_list_owners.company_id = ". $company ."
                AND bus_owner_contacts.id = bus_list_owners.contacts";
        $owners_arr = $db->all($sql);
        $html_owners = "";
        foreach ($owners_arr as $key=>$item) {
            $html_owners .= '<tr class="owner_row" item_id="' . $item['id'] . '"   phone_one="'. $item['phone_one']  .'" phone_two="'. $item['phone_two']  .'"
             surname="'. $item['surname'] .'"  name="'. $item['name'] .'"  patronymic="'. $item['patronymic'] .'">
                                <td >' . ($key + 1) . '</td>
                                <td class="fio">' . $item['fio'] . '</td>
                                <td class="phone">' . $item['phone'] .'</td>
                            </tr>';
        }

        return $html_owners;
    }

    public function bus_list_routes_table(){
        global $db;

        $company = 29;

        $sql = "SELECT *
                FROM bus_list_routes
                WHERE bus_list_routes.company_id =".$company;
        $routes_arr = $db->all($sql);
        $html_routes = "";
        foreach ($routes_arr as $key=>$item) {
            $html_routes .= '<tr class="route_row" item_id="' . $item['id'] . '" route_number="'. $item['route_number'] .'" route_name="'. $item['route_name']  .'">
                                <td >' . ($key + 1) . '</td>
                                <td class="route_number">' . $item['route_number'] . '</td>
                                <td class="route_name">' . $item['route_name'] .'</td>
                            </tr>';
        }

        return $html_routes;
    }

    public function bus_edit() {
        global $db;
        $bus_id = $this->post_array['bus_id'];
        $sql = "SELECT * FROM bus_vs_route WHERE bus_vs_route.bus_id =".$bus_id;
        $route_id_now = $db->row($sql);

        // ищим маршруты
        $sql = "SELECT * FROM bus_list_routes";
        $route_array = $db->all($sql);

        $route_html = "";
        foreach ($route_array as $route_item) {
            if($route_id_now['route_id'] == $route_item['id']){
                $route_html .= '<option value="' . $route_item['id'] . '" selected>' . $route_item['route_name'] . '</option>';
            } else {
                $route_html .= '<option value="' . $route_item['id'] . '">' . $route_item['route_name'] . '</option>';
            }
        }

        $result_array['status'] = "ok";
        $result_array['message'] = "";
        $result_array['content'] = $route_html;
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function bus_edit_save(){
        global $db;
        $bus_id = $this->post_array['bus_id'];
        $brand_of_bus = $this->post_array['brand_of_bus'];
        $gos_number = $this->post_array['gos_number'];
        $route = $this->post_array['route'];

        $sql = "UPDATE `bus_vs_route` SET `route_id`='". $route ."' WHERE  `bus_id`=". $bus_id;
        $db->query($sql);

        $sql = "UPDATE `bus_list` SET `brand_of_bus`='". $brand_of_bus ."', `gos_number`='". $gos_number ."' WHERE  `id`=". $bus_id;
        $db->query($sql);

        $result_array['status'] = 'ok';
        $result_array['message'] = "";
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function driver_edit() {
        global $db;
        $driver_id= $this->post_array['driver_id'];

        $sql = "SELECT * FROM bus_vs_driver WHERE bus_vs_driver.driver_id =".$driver_id;
        $route_id_now = $db->row($sql);

        // ищим автобусы
        $sql = "SELECT * FROM bus_list";
        $bus_array = $db->all($sql);

        $bus_html = "";
        foreach ($bus_array as $bus_item) {
            if($route_id_now['bus_id'] == $bus_item['id']){
                $bus_html .= '<option value="' . $bus_item['id'] . '" selected>' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
            } else {
                $bus_html .= '<option value="' . $bus_item['id'] . '">' . $bus_item['brand_of_bus'] . " - " . $bus_item['gos_number'] . '</option>';
            }
        }

        $result_array['status'] = "ok";
        $result_array['message'] = "";
        $result_array['content'] = $bus_html;
        // Отправили зезультат
        return json_encode($result_array);
    }



        public function driver_edit_save(){
            global $db;
            $driver_id = $this->post_array['driver_id'];
            $surname = $this->post_array['surname'];
            $name = $this->post_array['name'];
            $second_name = $this->post_array['second_name'];
            $phone= $this->post_array['phone'];
            $phone_2= $this->post_array['phone_2'];
            $bus= $this->post_array['bus'];

            $sql = "SELECT * FROM bus_list_drivers WHERE bus_list_drivers.id =". $driver_id;
            $emps = $db->row($sql);

            $sql = "UPDATE `employees` SET `surname`='". $surname ."',`name`='". $name ."',`second_name`='". $second_name ."' WHERE  `id`=". $emps['employees_id'];
            $db->query($sql);

            if($phone !=""){
                $sql = "UPDATE `bus_list_drivers` SET `phone`='". $phone ."' WHERE  `id`=". $driver_id;
                $db->query($sql);
            }
            if($phone_2 !=""){
                $sql = "UPDATE `bus_list_drivers` SET  `phone_2`='". $phone_2 ."' WHERE  `id`=". $driver_id;
                $db->query($sql);
            }
            $sql = "UPDATE `bus_vs_driver` SET `bus_id`='". $bus ."' WHERE  `driver_id`=". $driver_id;
            $db->query($sql);

            $result_array['status'] = 'ok';
            $result_array['message'] = "";
            // Отправили зезультат
            return json_encode($result_array);
        }

    public function route_edit_save(){
        global $db;
        $route_id = $this->post_array['route_id'];
        $route_number = $this->post_array['route_number'];
        $route_name = $this->post_array['route_name'];

        $sql = "UPDATE `bus_list_routes` SET `route_number`='". $route_number ."',`route_name`='". $route_name ."' WHERE  `id`=". $route_id;
        $db->query($sql);

        $result_array['status'] = 'ok';
        $result_array['message'] = "";
        // Отправили зезультат
        return json_encode($result_array);
    }


    public function owner_edit_save(){
        global $db;
        $owner_id = $this->post_array['owner_id'];
        $surname = $this->post_array['surname'];
        $name = $this->post_array['name'];
        $second_name = $this->post_array['second_name'];
        $phone = $this->post_array['phone'];
        $phone_2 = $this->post_array['phone_2'];

        $sql = "SELECT * FROM bus_list_owners WHERE `id`=". $owner_id;
        $owners = $db->row($sql);

        $sql = "UPDATE `bus_list_owners` SET `surname`='". $surname ."',`name`='". $name ."', `patronymic`='". $second_name ."' WHERE  `id`=". $owners['contacts'];
        $db->query($sql);

        $sql = "UPDATE `bus_owner_contacts` SET `phone_one`='". $phone ."',`phone_two`='". $phone_2 ."' WHERE  `id`=". $owner_id;
        $db->query($sql);

        $result_array['status'] = 'ok';
        $result_array['message'] = "";
        // Отправили зезультат
        return json_encode($result_array);
    }

}
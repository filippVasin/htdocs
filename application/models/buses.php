<?php

class Model_buses
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

    public function start(){
        global $db;

        $sql="Select
                bus_list.id,
                bus_list.brand_of_bus,
                bus_list.gos_number,
                CONCAT_WS (' ',bus_list_owners.surname , bus_list_owners.name, bus_list_owners.patronymic) AS owner_fio,
                CONCAT_WS (', ',bus_owner_contacts.phone_one , bus_owner_contacts.phone_two, bus_owner_contacts.responsible) AS responsible_fio_and_phone,
                bus_list_drivers.employees_id,
                bus_list_drivers.id AS driver_id,
                CONCAT_WS (', ',CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) , bus_list_drivers.phone, bus_list_drivers.phone_2) AS driver_fio_and_phone,
                bus_list_routes.route_number,
                bus_list_routes.route_name,
                bus_list_routes.company_id
                FROM bus_list,bus_list_drivers,bus_list_owners,bus_owner_contacts,bus_vs_driver,bus_vs_owner,
                bus_vs_route,bus_list_routes,employees
                WHERE bus_list_owners.contacts = bus_owner_contacts.id
                AND bus_list.id = bus_vs_driver.bus_id
                AND bus_list_drivers.id = bus_vs_driver.driver_id
                AND employees.id = bus_list_drivers.employees_id
                AND bus_list_owners.id = bus_vs_owner.owner_id
                AND bus_vs_owner.bus_id = bus_list.id
                AND bus_list_routes.id = bus_vs_route.route_id
                AND bus_vs_route.bus_id = bus_list.id
                ORDER BY route_number";
        $bus_array = $db->all($sql);
        $html = "";
        $route = "";
        $count_bus_to_route = 1; // подсчёт автобусов на марщруте
        // Собираем таблицу маршрутов
        foreach ($bus_array as $bus_item) {
            // определяем новый ли маршрут
//            if($route != $bus_item['route_number']){
//                // если да тогда добавляем заголовок с названием маршрута
//                $html .= '</tr>
//                                <td colspan="7" style="font-weight:700">' . $bus_item['route_name'] . '</td>
//                            </tr>';
//                $route = $bus_item['route_number'];
//                $count_bus_to_route = 1;
//            }

            $html .= '<tr driver_id="'.$bus_item['driver_id'].'" class="bus_row">
                        <td>' . $bus_item['route_name'] . '</td>
                        <td>' . $bus_item['brand_of_bus'] . '</td>
                        <td>' . $bus_item['gos_number'] . '</td>
                        <td>' . $bus_item['owner_fio'] . '</td>
                        <td>' . $bus_item['responsible_fio_and_phone'].'</td>
                        <td>' . $bus_item['driver_fio_and_phone'].'</td>
                    </tr>';

            ++$count_bus_to_route;
        }
        return $html;
    }


    public function bus_row_edit(){
        global $db;
        $driver_id = $this->post_array['driver_id'];
        $sql="Select
                bus_list.id AS bus_id,
                bus_list.brand_of_bus,
                bus_list.gos_number,
                bus_list_owners.id AS owners_id,
                bus_list_owners.surname AS owners_surname,
                bus_list_owners.name AS owners_name,
                bus_list_owners.patronymic AS owners_patronymic,
                bus_owner_contacts.responsible,
                bus_owner_contacts.phone_one AS owner_phone,
                bus_owner_contacts.phone_two AS owner_phone_two,
                bus_list_drivers.id AS driver_id,
                bus_list_drivers.employees_id,
                employees.surname AS employee_surname,
                employees.name AS employee_name,
                employees.second_name AS employee_second_name,
                bus_list_drivers.phone AS driver_phone,
                bus_list_drivers.phone_2 AS driver_phone_two,
                bus_list_routes.id AS route_id,
                bus_list_routes.route_number,
                bus_list_routes.route_name,
                bus_list_routes.company_id
                FROM bus_list,bus_list_drivers,bus_list_owners,bus_owner_contacts,bus_vs_driver,bus_vs_owner,
                bus_vs_route,bus_list_routes,employees
                WHERE bus_list_owners.contacts = bus_owner_contacts.id
                AND bus_list.id = bus_vs_driver.bus_id
                AND bus_list_drivers.id = bus_vs_driver.driver_id
                AND employees.id = bus_list_drivers.employees_id
                AND bus_list_owners.id = bus_vs_owner.owner_id
                AND bus_vs_owner.bus_id = bus_list.id
                AND bus_list_routes.id = bus_vs_route.route_id
                AND bus_vs_route.bus_id = bus_list.id
                AND bus_list_drivers.id =".$driver_id;
        $bus_array = $db->row($sql);

        $result_array['bus_id'] = $bus_array['bus_id'];
        $result_array['brand_of_bus'] = $bus_array['brand_of_bus'];
        $result_array['gos_number'] = $bus_array['gos_number'];
        $result_array['owners_id'] = $bus_array['owners_id'];
        $result_array['owners_surname'] = $bus_array['owners_surname'];
        $result_array['owners_name'] = $bus_array['owners_name'];
        $result_array['owners_patronymic'] = $bus_array['owners_patronymic'];
        $result_array['responsible'] = $bus_array['responsible'];
        $result_array['owner_phone'] = $bus_array['owner_phone'];
        $result_array['owner_phone_two'] = $bus_array['owner_phone_two'];
        $result_array['driver_id'] = $bus_array['driver_id'];
        $result_array['employees_id'] = $bus_array['employees_id'];
        $result_array['employee_surname'] = $bus_array['employee_surname'];
        $result_array['employee_name'] = $bus_array['employee_name'];
        $result_array['employee_second_name'] = $bus_array['employee_second_name'];
        $result_array['driver_phone'] = $bus_array['driver_phone'];
        $result_array['driver_phone_two'] = $bus_array['driver_phone_two'];
        $result_array['route_id'] = $bus_array['route_id'];
        $result_array['route_number'] = $bus_array['route_number'];
        $result_array['route_name'] = $bus_array['route_name'];
        $result_array['company_id'] = $bus_array['company_id'];
        $result_array['message'] = 'ok';
        $result_array['status'] = 'ok';
        $result = json_encode($result_array, true);
        die($result);
    }

}
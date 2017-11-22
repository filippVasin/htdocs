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
                bus_list.brand_of_bus,
                bus_list.gos_number,
                CONCAT_WS (' ',bus_list_owners.surname , bus_list_owners.name, bus_list_owners.patronymic) AS owner_fio,
                CONCAT_WS (', ',bus_owner_contacts.phone_one , bus_owner_contacts.phone_two, bus_owner_contacts.responsible) AS responsible_fio_and_phone,
                bus_list_drivers.employees_id,
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

            $html .= '</tr>
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
}
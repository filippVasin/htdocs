<?php

class Model_drivers{
    // Данные для обработки POST запросов;
    public $post_array;

    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function drivers_table(){
        global $db;
        $kladr_id = 175;// водитель
        $sql = "SELECT employees.id,
                    CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
                    employees.birthday,
                    registration_address.address,
                    drivers_license.category,
                    drivers_license.license_number,
                    drivers_license.end_date
                    FROM (employees, employees_items_node, organization_structure)
                        LEFT JOIN drivers_license ON drivers_license.emp_id = employees.id
                        LEFT JOIN registration_address ON registration_address.emp_id = employees.id
                    WHERE organization_structure.kladr_id = ". $kladr_id ."
                    AND employees_items_node.org_str_id = organization_structure.id
                    AND employees_items_node.employe_id = employees.id";
        $drivers = $db->all($sql);
        $table = "";
        foreach($drivers as $key=>$driver){
            $birthday = date_create($driver['birthday'])->Format('d-m-Y');
            $table .= '<tr class="driver_row" item_id="'. $driver['id'] .'">
                        <td >' . ($key + 1) . '</td>
                        <td >' . $driver['fio'] . '</td>
                        <td >' . $birthday . '</td>
                        <td >' . $driver['address'] . '</td>
                        <td >' . $driver['category'] . '</td>
                        <td >' . $driver['license_number'] . '</td>
                        <td >' . $driver['end_date'] . '</td>
                    </tr>';
        }
        return $table;
    }
}
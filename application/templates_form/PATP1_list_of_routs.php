<?php

$today = date("Y-m-d H:i:s");
$now_day = date("d-m-Y");
$sql="SELECT * FROM company WHERE company.id=". $company_id;
$comp = $db->row($sql);
$company = $comp['name'];


//$kladr_id = 175;// водитель
//$sql = "SELECT employees.id,
//                    CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio,
//                    employees.birthday,
//                    registration_address.address,
//                    drivers_license.category,
//                    drivers_license.license_number,
//                    drivers_license.end_date
//                    FROM (employees, employees_items_node, organization_structure)
//                        LEFT JOIN drivers_license ON drivers_license.emp_id = employees.id
//                        LEFT JOIN registration_address ON registration_address.emp_id = employees.id
//                    WHERE organization_structure.kladr_id = ". $kladr_id ."
//                    AND employees_items_node.org_str_id = organization_structure.id
//                    AND employees_items_node.employe_id = employees.id
//                    AND employees.`status` = 1";
//$drivers = $db->all($sql);
//$table = "";
//foreach($drivers as $key=>$driver){
//    $birthday = date_create($driver['birthday'])->Format('d-m-Y');
//    $table .='<tr>
//		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="63" align="right" valign=top sdval="169" sdnum="1033;0;0"><font size=2>'. ($key + 1) .'</font></td>
//		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $driver['fio'] . '</font></td>
//		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $birthday . '</font></td>
//		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $driver['address'] . '</font></td>
//		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><font size=2>' . $driver['category'] . '</font></td>
//		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $driver['license_number'] . '</font></td>
//		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $driver['end_date'] . '</font></td>
//	</tr>';
//}

$table="";
$sql = "SELECT bus_list_routes.id as route_id, bus_list_routes.route_name,
            bus_list.id as bus_id, bus_list.brand_of_bus, bus_list.gos_number,
            CONCAT_WS (' ',bus_list_owners.surname , bus_list_owners.name, bus_list_owners.patronymic) AS owner_fio,
            CONCAT_WS (', ',bus_owner_contacts.phone_one , bus_owner_contacts.phone_two, bus_owner_contacts.responsible) AS owner_contact,
            CONCAT_WS (',  ',CONCAT_WS (' ',employees.surname, employees.name, employees.second_name), bus_list_drivers.phone, bus_list_drivers.phone_2)  as driver,
            bus_list_drivers.id as drv_id
            FROM bus_list,bus_list_owners, bus_vs_owner,bus_owner_contacts,bus_vs_driver,bus_list_drivers,
            employees, bus_list_routes,bus_vs_route
            WHERE bus_list_owners.id = bus_vs_owner.owner_id
            AND bus_list.id = bus_vs_owner.bus_id
            AND bus_owner_contacts.id = bus_list_owners.contacts
            AND bus_list.id = bus_vs_driver.bus_id
            AND bus_list_drivers.id = bus_vs_driver.driver_id
            AND employees.id = bus_list_drivers.employees_id
            AND bus_list_routes.id = bus_vs_route.route_id
            AND bus_list.id = bus_vs_route.bus_id
            GROUP BY drv_id
            ORDER BY route_id, bus_id";
$data_tables = $db->all($sql);
$route_flag_id = 0;
$bus_flag_id = 0;
$count = 1;
foreach($data_tables as $item){
        // заголовок маршрута
        if($route_flag_id != $item['route_id']){
            $table.= '<tr>
                    <td colspan="6" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-bottom: 10px; padding-top: 10px; text-align: center; font-weight: 700" align="left" valign=top><font size=2>' . $item['route_name'] . '</font></td>
                </tr>';
            $route_flag_id = $item['route_id'];
            $count = 1;
        }
        if($bus_flag_id != $item['bus_id']){
            $driver = "";
            foreach($data_tables as $driver_item){
                if($driver_item['bus_id'] == $item['bus_id']){
                    $driver .= $driver_item['driver']. "<br> ";
                }
            }

            $table .='<tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="48" align="center" valign=top><b>'. $count .'</b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><font size=2>'. $item['brand_of_bus'] .'</font></b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><font size=2>'. $item['gos_number'] .'</font></b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 10px" align="center" valign=top><b>'. $item['owner_fio'] .'</b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 10px" align="center" valign=top><b>'. $item['owner_contact'] .'</b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 10px;" align="center" valign=top><b><font size=2>'. $driver .'</font></b></td>
            </tr>';
            ++$count;
            $bus_flag_id = $item['bus_id'];
        }

}









$result_file =
    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE> ЛИСТОК</TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.1.6.2 (Linux)">
	<META NAME="AUTHOR" CONTENT="ПАТП1">
	<META NAME="CREATED" CONTENT="20171031;60300000000000">
	<META NAME="CHANGEDBY" CONTENT="User">
	<META NAME="CHANGED" CONTENT="20171031;60500000000000">
	<STYLE TYPE="text/css">
	<!--
		@page { margin-right: 0.59in; margin-top: 0.35in; margin-bottom: 0.39in }
		P { margin-bottom: 0.08in; color: #000000; widows: 2; orphans:  2}
		P.western { font-family: "Times New Roman", serif; font-size: 12pt; so-language: ru-RU }
		P.cjk { font-family: "Times New Roman", serif; font-size: 12pt }
		P.ctl { font-family: "Times New Roman", serif; font-size: 12pt; so-language: ar-SA }
	-->
	</STYLE>
</HEAD>
<BODY LANG="en-US" TEXT="#000000" >
<div class="Section1" attr="'. $today .'">
<!-- контент сюда -->
<table cellspacing="0" border="0">
	<colgroup width="30"></colgroup>
	<colgroup width="77"></colgroup>
	<colgroup width="112"></colgroup>
	<colgroup width="130"></colgroup>
	<colgroup width="130"></colgroup>
	<colgroup width="290"></colgroup>
	<tr>
		<td height="20" align="left"><br></td>
		<td align="left"><br></td>
		<td align="left" colspan="4"><b><font size=2>СПИСОК АВТОБУСОВ ООО «НОВОСИБИРСКПРОФСТРОЙ-ПАТП-1»	на    '. $now_day .' г.</font></b></td>
	</tr>

	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="48" align="center" valign=top><b>№</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><font size=2>Марка автобуса</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><font size=2>Номер автобуса</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b>Ф. И. О. хозяина</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b>Телефон хозяина</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><font size=2>Ф. И. О. водителя</font></b></td>
	</tr>
	'.$table.'
	<tr>
		<td height="39" align="left"><br></td>
		<td align="left"><br></td>
		<td align="center"><font size=2>Директор</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
	</tr>
	<tr>
		<td height="16" align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
		<td style="border-top: 1px solid #000000" colspan=2 align="center">(подпись,  Ф.И.О.)</td>
		<td align="left"><br></td>
		<td align="left"><br></td>
	</tr>
</table>
<!-- контент сюда, конец -->
</div>
</BODY>
</HTML>';
$error = "";
$folder_name = $_SERVER['DOCUMENT_ROOT'].'/application/real_forms/'.md5($result_file);
if($flag !="open") {
    if (!is_dir($folder_name)) {
        mkdir($folder_name);

        file_put_contents($folder_name . '/' . $doc_name . '.doc', $result_file, FILE_APPEND);
        $doc_download_url = 'application/real_forms/'.md5($result_file).'/'.$doc_name.'.doc';
        $file_name = $doc_name;

        if($_SESSION['form_id'] !=""){
            $sql = "INSERT INTO `save_temp_files` (`path`, `name`, `employee_id`,`company_temps_id`) VALUES( '" . $doc_download_url . "','" . $file_name . "','" . $employee_id . "','". $_SESSION['form_id'] ."');";
        } else {
            $sql = "INSERT INTO `save_temp_files` (`path`, `name`, `employee_id`) VALUES( '" . $doc_download_url . "','" . $file_name . "','" . $employee_id . "');";
        }
        // записали данные о файле

        $db->query($sql);
//    echo $sql . " insert";


    } else {
        $error = "такой файл уже есть";
    }
} else {
    $page = $result_file;
}


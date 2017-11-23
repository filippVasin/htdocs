<?php

$today = date("Y-m-d H:i:s");

$sql="SELECT * FROM company WHERE company.id=". $company_id;
$comp = $db->row($sql);
$company = $comp['name'];

$sql = "SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio, items_control.name AS dol,
        employees.birthday, drivers_license.category,drivers_license.license_number
        FROM employees,employees_items_node,organization_structure,items_control, drivers_license
        WHERE employees.id = ". $employee_id ."
        AND employees.id = employees_items_node.employe_id
        AND organization_structure.id = employees_items_node.org_str_id
        AND organization_structure.kladr_id = items_control.id
        AND employees.id = drivers_license.emp_id
        AND organization_structure.company_id =". $company_id;


$employees = $db->row($sql);
$fio = $employees['fio'];
$dol = $employees['dol'];
$birthday = date_create($employees['birthday'])->Format('d-m-Y');
$category = $employees['category'];
$license_number = $employees['license_number'];
$day = date("d-m-Y", strtotime("+14 days"));

// получаем ответственного по инструктажам
$sql = "SELECT ORG_chief.id,ORG_boss.boss_type,chief_employees.surname, ORG_boss.`level` as level,
chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
	chief_items_control.name AS chief_dol
FROM (organization_structure, employees_items_node)
LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
																	AND
																  ORG_chief.right_key > organization_structure.right_key
																  AND
																  ORG_chief.company_id = ". $company_id ." )
		LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = ". $company_id ."
																		AND ORG_boss.left_key > ORG_chief.left_key
																		AND ORG_boss.right_key < ORG_chief.right_key
																		AND 	ORG_boss.`level` = (ORG_chief.`level` +1)
																		AND ORG_boss.boss_type > 1
																			)
		LEFT JOIN employees_items_node AS chief_node ON chief_node.org_str_id = ORG_boss.id
		LEFT JOIN employees AS chief_employees ON chief_employees.id = chief_node.employe_id
		LEFT JOIN items_control AS  chief_items_control ON chief_items_control.id = ORG_boss.kladr_id

WHERE employees_items_node.employe_id = ". $employee_id ."
AND organization_structure.id = employees_items_node.org_str_id
AND organization_structure.company_id = ". $company_id."
AND chief_employees.id is not NULL
ORDER BY level DESC, boss_type DESC
LIMIT 1";
$boss = $db->row($sql);

$chief = $boss['chief_surname']." ". $boss['chief_name'] ." ". $boss['chief_second_name'];
$chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
$chief_dol = $boss['chief_dol'];
$fioFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $fio);

$sql="SELECT internship_list.*,CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS mentor_fio,
        bus_list.brand_of_bus, bus_list.gos_number,
        bus_list_routes.route_name,
        ASS_BUS.brand_of_bus AS assigned_brand_of_bus,
        ASS_BUS.gos_number AS assigned_gos_number
        FROM (internship_list, employees, bus_list,bus_list_routes)
        LEFT JOIN bus_list AS ASS_BUS ON ASS_BUS.id = internship_list.assigned_bus_id
        WHERE internship_list.mentor_id = employees.id
        AND internship_list.bus_id = bus_list.id
        AND internship_list.route_id = bus_list_routes.id
        AND internship_list.employee_id =".$employee_id;
$internship_list_row = $db->row($sql);
$order = $internship_list_row['order'];
$mentor_fio = $internship_list_row['mentor_fio'];
$mentorFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $mentor_fio);
$brand_of_bus = $internship_list_row['brand_of_bus'];
$gos_number = $internship_list_row['gos_number'];
$route_name = $internship_list_row['route_name'];
$hours_all = $internship_list_row['hours_all'];
$hours_inst = $internship_list_row['hours_ints'];
$hours_driving = $internship_list_row['hours_driving'];
$inst_date = date_create($internship_list_row['date'])->Format('d.m.Y');
$assigned_brand_of_bus = $internship_list_row['assigned_brand_of_bus'];
$assigned_gos_number = $internship_list_row['assigned_gos_number'];


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
                    AND internship_routes.employee_id =" . $employee_id;
$route_array = $db->all($sql);
$table_routs = "";
foreach ($route_array as $route_item) {
    $table_routs .='<TR VALIGN=TOP>
		<TD WIDTH=100 HEIGHT=27 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
        <P LANG="ru-RU" CLASS="western">
            '. date_create($route_item['inst_date'])->Format('d.m.Y').'
			</P>
		</TD>
		<TD WIDTH=173 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western">
			'.$route_item['route_name'].'
			</P>
		</TD>
		<TD WIDTH=91 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER>
			'.$route_item['brand_of_bus'].'
			</P>
		</TD>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER>
			'.$route_item['hours_all'].'
			</P>
		</TD>
		<TD WIDTH=77 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western">
			'. preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $route_item['mentor_fio']).'
			</P>
		</TD>
		<TD WIDTH=59 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western">
			</P>
		</TD>
	</TR>';
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
<div class="Section1">
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4><B>ЛИСТОК</B></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4><B>ПРОХОЖДЕНИЯ СТАЖИРОВКИ ВОДИТЕЛЕМ</B></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE=" margin-bottom: 0in">
<FONT SIZE=4><B>ТРАНСПОРТНОГО СРЕДСТВА
(АВТОБУСА) № _____</B></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=4>Водитель
</FONT><I><B>'. $fio .'</B></I></P>
<P >Водительское
удостоверение <I><B> '. $license_number .', категории:</B></I><FONT ><I><B>
'.$category .'</P>
<P>Приказом
по <I><B>ООО «Новосибирскпрофстрой-ПАТП-1»</B></I>
<I><B>'. $order .'г., закреплен:</B></I>
за водителем-наставником:<B>'. $mentor_fio .'</B> </P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">На
транспортное средство <FONT SIZE=4><I><B>'. $brand_of_bus .'</B></I></FONT>
<FONT SIZE=4>г.н.   </FONT><FONT SIZE=4><I><B>'. $gos_number .'</B></I></FONT></P>

<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">По
маршруту<SPAN LANG="en-US">'. $route_name .'</SPAN></P>

<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Причина
направления на стажировку <I><B>прием
на работу, ознакомление с
маршрутом					___________________				</B></I></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">	</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Направляется
для прохождения стажировки в объеме:
'. $hours_all .' часов</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">
  <I><B>'. $hours_inst .' часов – инструктаж (вводный,
предрейсовый, сезонный)</B></I></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">
  <I><B>'. $hours_driving .' часов - маршрутная стажировка
(практика)
                          </B></I>
</P>

<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Начальник
отдела кадров_____________________     _________Л.В.
Рыльская___________</P>

<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">'. $chief_dol .'___________________
__________'. $chiefFIO .'________</P>

<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Водитель
прошел инструктаж в количестве
<B> '. $hours_inst .' часов - '. $inst_date .'</B></P>

<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Водитель
ознакомлен с основными маршрутами и
особенностями перевозки пассажиров:							</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">
«______»________________20___г.	__________________
__________________		           <FONT SIZE=1 STYLE="font-size: 8pt">(дата)

        (подпись)                                  (ФИО
водителя)</FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Водитель
наставник____________________
________________'.$mentorFIO.'</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">

<FONT SIZE=1 STYLE="font-size: 8pt">(подпись)

(ФИО)                           </FONT>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Маршрутная
стажировка- '. $hours_driving .' ч.
</P>
<TABLE WIDTH=800 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=100>
	<COL WIDTH=550>
	<COL WIDTH=91>
	<COL WIDTH=52>
	<COL WIDTH=77>
	<COL WIDTH=159>
	<TR VALIGN=TOP>
		<TD WIDTH=100 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western">Дата, время прохождения
			стажировки
			</P>
		</TD>
		<TD WIDTH=173 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western">№ и наименование
			маршрута</P>
		</TD>
		<TD WIDTH=91 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western">Марка и № а/машины
			</P>
		</TD>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western">Кол-во часов</P>
		</TD>
		<TD WIDTH=77 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Ф.И.О.</P>
			<P LANG="ru-RU" CLASS="western">наставника</P>
		</TD>
		<TD WIDTH=59 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western">Подпись</P>
		</TD>
	</TR>
	'. $table_routs .'

</TABLE>

<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Замечания
и предложения  водителя - наставника: допустить
к самостоятельной работе </P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Заключение:
Допустить (не допустить) водителя
<I><B>'. $fioFIO .'</B></I>к самостоятельной
 работе на  <I><B> '. $assigned_brand_of_bus .' </B></I><FONT SIZE=4><I><B>
 </B></I></FONT><FONT SIZE=4>г.н. '. $assigned_gos_number .'
</FONT><FONT SIZE=4><SPAN LANG="en-US"><I><B>_______________________________________________________________________________________</B></I></SPAN></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in">Ответственный
за обеспечение безопасности дорожного
движения в
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><I><B>ООО
«Новосибирскпрофстрой-ПАТП-1»__________________________Е.В.Мухамечин</B></I></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in" attr="'. $today .'"><I><B>«_____»__________________20
     г.</B></I></P>
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


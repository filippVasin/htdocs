<?php

$today = date("Y-m-d H:i:s");

$sql="SELECT * FROM company WHERE company.id=". $_SESSION['control_company'];
$comp = $db->row($sql);
$company = $comp['name'];

$sql="SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio, items_control.name AS dol,
        employees.birthday
        FROM employees,employees_items_node,organization_structure,items_control
        WHERE employees.id = ". $employee_id ."
        AND employees.id = employees_items_node.employe_id
        AND organization_structure.id = employees_items_node.org_str_id
        AND organization_structure.kladr_id = items_control.id
        AND organization_structure.company_id =". $_SESSION['control_company'];

$employees = $db->row($sql);
$fio = $employees['fio'];
$dol = $employees['dol'];
$birthday = date_create($employees['birthday'])->Format('d-m-Y');

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
																  ORG_chief.company_id = ". $_SESSION['control_company'] ." )
		LEFT JOIN organization_structure AS ORG_boss ON ( ORG_boss.company_id = ". $_SESSION['control_company'] ."
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
AND organization_structure.company_id = ". $_SESSION['control_company'] ."
AND chief_employees.id is not NULL
ORDER BY level DESC, boss_type DESC
LIMIT 1";
$boss = $db->row($sql);

$chief = $boss['chief_surname']." ". $boss['chief_name'] ." ". $boss['chief_second_name'];
$chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
$chief_dol = $boss['chief_dol'];
$fioFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $fio);
$result_file =
    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.1.6.2 (Linux)">
	<META NAME="AUTHOR" CONTENT="Антон Хабиров">
	<META NAME="CREATED" CONTENT="20171031;31900000000000">
	<META NAME="CHANGEDBY" CONTENT="User">
	<META NAME="CHANGED" CONTENT="20171031;34400000000000">
	<META NAME="KEYWORDS" CONTENT="стажировка">
	<META NAME="AppVersion" CONTENT="15.0000">
	<META NAME="Company" CONTENT="SPecialiST RePack">
	<META NAME="DocSecurity" CONTENT="0">
	<META NAME="HyperlinksChanged" CONTENT="false">
	<META NAME="LinksUpToDate" CONTENT="false">
	<META NAME="ScaleCrop" CONTENT="false">
	<META NAME="ShareDoc" CONTENT="false">
	<STYLE TYPE="text/css">
	<!--
		@page { margin-left: 0.79in; margin-right: 0.59in; margin-top: 0.79in; margin-bottom: 0.49in }
		P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
		P.western { font-family: "Times New Roman", serif; font-size: 12pt }
		P.cjk { font-size: 12pt }
		A:link { color: #0000ff; so-language: zxx }
	-->
	</STYLE>
</HEAD>
<BODY LANG="ru-RU" LINK="#0000ff" DIR="LTR">
<div class="Section1">
<P CLASS="western" STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<TABLE WIDTH=676 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=50>
	<COL WIDTH=17>
	<COL WIDTH=13>
	<COL WIDTH=5>
	<COL WIDTH=4363>
	<COL WIDTH=5>
	<COL WIDTH=4364>
	<COL WIDTH=5>
	<COL WIDTH=4366>
	<COL WIDTH=4>
	<COL WIDTH=4364>
	<COL WIDTH=14>
	<COL WIDTH=4364>
	<COL WIDTH=24>
	<COL WIDTH=14>
	<COL WIDTH=14>
	<COL WIDTH=15>
	<COL WIDTH=18>
	<COL WIDTH=12>
	<COL WIDTH=108>
	<COL WIDTH=2>
	<COL WIDTH=17>
	<COL WIDTH=40>
	<TBODY>
		<TR>
			<TD COLSPAN=23 WIDTH=662 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=4><B>РАСПОРЯЖЕНИЕ</B></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=23 WIDTH=662 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=3 WIDTH=109 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
			<TD COLSPAN=17 WIDTH=438 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER>'. $company .'<BR>
				</P>
			</TD>
			<TD COLSPAN=3 WIDTH=88 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=23 WIDTH=662 HEIGHT=18 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2 STYLE="font-size: 9pt">(наименование
				организации)</FONT></P>
			</TD>
		</TR>
		<TR VALIGN=BOTTOM>
			<TD COLSPAN=2 WIDTH=81 STYLE="border: none; padding: 0in">
				<P CLASS="western">от</P>
			</TD>

			<TD COLSPAN=2 WIDTH=13 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER>'. $day .'<BR>
				</P>
			</TD>
			<TD WIDTH=14 STYLE="border: none; padding: 0in">
				<P CLASS="western">г.</P>
			</TD>
			<TD COLSPAN=9 WIDTH=315 STYLE="border: none; padding: 0in">
				<P CLASS="western"><SPAN LANG="en-US">+14</SPAN></P>
			</TD>
			<TD WIDTH=17 STYLE="border: none; padding: 0in">
				<P CLASS="western">№</P>
			</TD>
			<TD WIDTH=40 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=11 WIDTH=220 HEIGHT=26 STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
			<TD COLSPAN=8 WIDTH=204 STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
			<TD COLSPAN=4 WIDTH=210 STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=23 WIDTH=662 HEIGHT=3 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-bottom: 0in"><BR>
				</P>
				<P CLASS="western"><B>О допуске к работе</B></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=23 WIDTH=662 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=13 WIDTH=257 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western">Допустить к самостоятельной
				работе</P>
			</TD>
			<TD COLSPAN=10 WIDTH=391 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER>'. $dol .'<BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=13 WIDTH=257 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER>
                    '. $fio .'
				</P>
			</TD>
			<TD COLSPAN=10 WIDTH=391 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2 STYLE="font-size: 9pt">(профессия
				или должность)</FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=23 WIDTH=662 HEIGHT=8 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=23 WIDTH=662 HEIGHT=10 VALIGN=TOP STYLE="border-top: 1px solid #000001; border-bottom: none; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2 STYLE="font-size: 9pt">(Ф.И.О.,
				участок, производство, объект)</FONT></P>
			</TD>
		</TR>
		<TR VALIGN=BOTTOM>
			<TD WIDTH=50 STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-right: -0.08in">с </P>
			</TD>
			<TD COLSPAN=4 WIDTH=71 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER> '. $day .'<BR>
				</P>
			</TD>

			<TD COLSPAN=2 WIDTH=14 STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
			<TD COLSPAN=15 WIDTH=466 STYLE="border: none; padding: 0in">
				<P CLASS="western">г.,  как прошедшего стажировку
				и проверку  теоретических знаний</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=23 WIDTH=662 HEIGHT=9 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
				<P CLASS="western">и приобретенных навыков
				безопасных методов и способов работы.</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=6 WIDTH=154 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-bottom: 0in"><BR>
				</P>
				<P CLASS="western" STYLE="margin-bottom: 0in"><BR>
				</P>
				<P CLASS="western">Руководитель работ</P>
			</TD>
			<TD COLSPAN=9 WIDTH=156 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
			<TD WIDTH=14 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
			<TD COLSPAN=7 WIDTH=297 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=127 HEIGHT=30 STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
			<TD COLSPAN=10 WIDTH=154 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER>                 <FONT SIZE=2 STYLE="font-size: 9pt">(подпись)</FONT></P>
			</TD>
			<TD WIDTH=14 STYLE="border: none; padding: 0in">
				<P CLASS="western">'. $chiefFIO .'<BR>
				</P>
			</TD>
			<TD COLSPAN=8 WIDTH=325 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER>                   <FONT SIZE=2 STYLE="font-size: 9pt">(расшифровка)</FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=10 WIDTH=211 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western">С распоряжением ознакомлен</P>
			</TD>
			<TD COLSPAN=7 WIDTH=155 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
			<TD WIDTH=18 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=236 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #000001; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><A NAME="_GoBack"></A><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=10 WIDTH=211 STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
			<TD COLSPAN=7 WIDTH=155 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2 STYLE="font-size: 9pt">(подпись)</FONT></P>
			</TD>
			<TD WIDTH=18 STYLE="border: none; padding: 0in">
				<P CLASS="western">'. $fioFIO .'<BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=236 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2 STYLE="font-size: 9pt">(расшифровка)</FONT></P>
			</TD>
		</TR>
	</TBODY>
</TABLE>
<P CLASS="western" STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P CLASS="western" ALIGN=JUSTIFY STYLE="text-indent: 0.39in; margin-bottom: 0in; line-height: 100%" attr="'. $today .'">
<BR>
</P>
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
        // записали данные о файле
        $sql = "INSERT INTO `save_temp_files` (`path`, `name`, `employee_id`, `company_temps_id`) VALUES( '" . $doc_download_url . "','" . $file_name . "','" . $_SESSION['employee_id'] . "','" . $_SESSION['form_id'] . "');";
        $db->query($sql);
//    echo $sql . " insert";


    } else {
        $error = "такой файл уже есть";
    }
} else {
    $page = $result_file;
}


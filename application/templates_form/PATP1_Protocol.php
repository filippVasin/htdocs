<?php

$today = date("Y-m-d H:i:s");

$sql="SELECT * FROM company WHERE company.id=". $_SESSION['control_company'];
$comp = $db->row($sql);
$company = $comp['name'];
$company_id = $_SESSION['control_company'];

$sql="SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio, items_control.name AS dol
        FROM employees,employees_items_node,organization_structure,items_control
        WHERE employees.id = ". $employee_id ."
        AND employees.id = employees_items_node.employe_id
        AND organization_structure.id = employees_items_node.org_str_id
        AND organization_structure.kladr_id = items_control.id
        AND organization_structure.company_id =". $company_id;

$employees = $db->row($sql);
$fio = $employees['fio'];
$dol = $employees['dol'];
$day= date_create($today)->Format('d-m-Y');

// получаем ответственного по инструктажам
$sql = "SELECT ORG_chief.id,ORG_boss.boss_type,chief_employees.surname, ORG_boss.`level` as level,
chief_employees.surname AS chief_surname, chief_employees.name AS chief_name, chief_employees.second_name AS chief_second_name,
	chief_items_control.name AS chief_dol
FROM (organization_structure, employees_items_node)
LEFT JOIN organization_structure AS ORG_chief ON (ORG_chief.left_key < organization_structure.left_key
																	AND
																  ORG_chief.right_key > organization_structure.right_key
																  AND
																  ORG_chief.company_id = ".$company_id ." )
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
AND organization_structure.company_id = ". $company_id ."
AND chief_employees.id is not NULL
ORDER BY level DESC, boss_type DESC
LIMIT 1";
$boss = $db->row($sql);

$chief = $boss['chief_surname']." ". $boss['chief_name'] ." ". $boss['chief_second_name'];
$chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
$chief_dol = $boss['chief_dol'];


$sql = "SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS boss_fio
        FROM organization_structure,employees_items_node,employees
        WHERE organization_structure.kladr_id = 69
        AND organization_structure.company_id = ". $company_id ."
        AND employees_items_node.org_str_id = organization_structure.id
        AND employees_items_node.employe_id = employees.id";
$bosses = $db->row($sql);
$boss = $bosses['boss_fio'];
$bossFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $boss);


$result_file =
    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE>Протокол заседания комиссии по проверке знаний требований охраны труда работников;</TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.1.6.2 (Linux)">
	<META NAME="AUTHOR" CONTENT="Антон Хабиров">
	<META NAME="CREATED" CONTENT="20140818;112800000000000">
	<META NAME="CHANGEDBY" CONTENT="User">
	<META NAME="CHANGED" CONTENT="20171031;20600000000000">
	<META NAME="KEYWORDS" CONTENT="Протокол, заседания, комиссии, по, проверке, знаний, требований, охраны, труда, работников">
	<META NAME="AppVersion" CONTENT="15.0000">
	<META NAME="Company" CONTENT="ОАО &quot;Хабаровский Аэропорт&quot;">
	<META NAME="DocSecurity" CONTENT="0">
	<META NAME="HyperlinksChanged" CONTENT="false">
	<META NAME="LinksUpToDate" CONTENT="false">
	<META NAME="ScaleCrop" CONTENT="false">
	<META NAME="ShareDoc" CONTENT="false">
	<STYLE TYPE="text/css">
	<!--
		@page { margin-left: 0.79in; margin-right: 0.59in; margin-top: 0.69in; margin-bottom: 0.59in }
		P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
		P.western { font-family: "Times New Roman", serif; font-size: 12pt }
		P.cjk { font-size: 12pt }
		A:link { color: #0000ff; so-language: zxx }
	-->
	</STYLE>
</HEAD>
<BODY LANG="ru-RU" LINK="#0000ff" DIR="LTR">
<div class="Section1">
<TABLE WIDTH=678 CELLPADDING=7 CELLSPACING=0 STYLE="page-break-before: always">
	<COLGROUP>
		<COL WIDTH=2>
		<COL WIDTH=4358>
		<COL WIDTH=4362>
		<COL WIDTH=4364>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=4365>
		<COL WIDTH=4367>
		<COL WIDTH=4362>
		<COL WIDTH=4367>
		<COL WIDTH=4362>
		<COL WIDTH=4364>
		<COL WIDTH=5>
		<COL WIDTH=62>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=4364>
		<COL WIDTH=4358>
		<COL WIDTH=12>
		<COL WIDTH=4358>
		<COL WIDTH=12>
		<COL WIDTH=4358>
		<COL WIDTH=4360>
		<COL WIDTH=7>
		<COL WIDTH=33>
		<COL WIDTH=39>
		<COL WIDTH=4359>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=90>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=80>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=81>
	</COLGROUP>
	<TBODY>
		<TR>
			<TD COLSPAN=22 WIDTH=367 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER>
				                                  <FONT SIZE=3>Протокол №</FONT></P>
			</TD>
			<TD COLSPAN=4 WIDTH=283 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=3><I>6/17-В</I></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=26 WIDTH=664 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=3>заседания
				комиссии по проверке знаний требований
				охраны труда работников</FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=26 WIDTH=664 HEIGHT=24 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT ><FONT SIZE=3><I>'. $company .'</I></FONT></FONT></P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=26 WIDTH=664 HEIGHT=5 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT SIZE=1 STYLE="font-size: 8pt">(полное
				наименование организации)</FONT></P>
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=BOTTOM>
			<TD COLSPAN=2 WIDTH=5 STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-bottom: 0in"><BR>
				</P>
				<P CLASS="western"><FONT ><FONT SIZE=3>«</FONT></FONT></P>
			</TD>
			<TD COLSPAN=4 WIDTH=24 STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
			'. $day .'
			</TD>
		</TR>
		<TR VALIGN=BOTTOM>
			<TD WIDTH=2 STYLE="border: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
			<TD COLSPAN=6 WIDTH=33 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=5 STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-left: -0.08in"><BR>
				</P>
			</TD>
			<TD COLSPAN=4 WIDTH=99 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
			<TD COLSPAN=3 WIDTH=17 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=RIGHT STYLE="margin-right: -0.04in"><BR>
				</P>
			</TD>
			<TD COLSPAN=3 WIDTH=19 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER STYLE="margin-left: -0.05in"><BR>
				</P>
			</TD>
			<TD COLSPAN=7 WIDTH=405 STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-left: -0.06in"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=26 WIDTH=664 HEIGHT=15 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-top: 0.08in">В соответствии
				с приказом (распоряжением) работодателя
				(руководителя) организации</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=3 WIDTH=11 HEIGHT=1 VALIGN=TOP STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-right: -0.08in"><FONT SIZE=3>от
				</FONT>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=5 VALIGN=TOP STYLE="border: none; padding: 0in">
				02.03.2015 г.
			</TD>
			<TD COLSPAN=5 WIDTH=337 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER STYLE="margin-left: -0.08in"><FONT SIZE=3><I>№2ПЗ-1</I></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=26 WIDTH=664 HEIGHT=6 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=JUSTIFY STYLE="margin-top: 0.08in">комиссия
				в составе:</P>
			</TD>
		</TR>
		<TR VALIGN=BOTTOM>
			<TD COLSPAN=11 WIDTH=96 HEIGHT=5 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=JUSTIFY>председателя</P>
			</TD>
			<TD COLSPAN=15 WIDTH=554 STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western"><FONT><FONT SIZE=3><I>'. $boss .', директор</I></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=11 WIDTH=96 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=JUSTIFY><BR>
				</P>
			</TD>
			<TD COLSPAN=15 WIDTH=554 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=1 STYLE="font-size: 8pt">(Ф.И.О.,
				должность)</FONT></P>
			</TD>
		</TR>
		<TR VALIGN=BOTTOM>
			<TD COLSPAN=11 WIDTH=96 HEIGHT=5 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=JUSTIFY>членов:</P>
			</TD>
			<TD COLSPAN=15 WIDTH=554 STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western"><FONT ><FONT SIZE=3><I>'. $chief .', '. $chief_dol .'</I></FONT></FONT>
				</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=11 WIDTH=96 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=JUSTIFY><BR>
				</P>
			</TD>
			<TD COLSPAN=15 WIDTH=554 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER> <FONT SIZE=1 STYLE="font-size: 8pt">(Ф.И.О.,
				должность)</FONT></P>
			</TD>
		</TR>
		<TR VALIGN=BOTTOM>
			<TD COLSPAN=11 WIDTH=96 HEIGHT=5 STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=JUSTIFY><BR>
				</P>
			</TD>
			<TD COLSPAN=15 WIDTH=554 STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western"><FONT ><FONT SIZE=3><I>Самарин
				Дмитрий Олегович, специалист по охране
				труда</I></FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=11 WIDTH=96 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
				<P CLASS="western" ALIGN=JUSTIFY><BR>
				</P>
			</TD>
			<TD COLSPAN=15 WIDTH=554 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER> <FONT SIZE=1 STYLE="font-size: 8pt">(Ф.И.О.,
				должность)</FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=26 WIDTH=664 HEIGHT=9 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-bottom: 0in"><BR>
				</P>
				<P CLASS="western"><FONT SIZE=3>провела проверку
				знаний требований охраны труда
				работников по:</FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=26 WIDTH=664 HEIGHT=9 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western"><FONT COLOR="#000000"><FONT SIZE=3><I>Программе
				обучения по охране труда для должности </I></FONT></FONT><FONT ><FONT SIZE=3><I>
				'. $dol .'</I></FONT></FONT></P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=26 WIDTH=664 HEIGHT=9 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=1 STYLE="font-size: 8pt">(наименование
				программы обучения по охране труда)</FONT></P>
			</TD>
		</TR>
		<TR VALIGN=BOTTOM>
			<TD COLSPAN=9 WIDTH=68 HEIGHT=9 STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-right: -0.08in"><FONT SIZE=3>в
				объеме</FONT></P>
			</TD>
			<TD COLSPAN=17 WIDTH=582 STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=3><I>20</I></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=9 WIDTH=68 HEIGHT=9 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
				<P CLASS="western" STYLE="margin-right: -0.08in"><BR>
				</P>
			</TD>
			<TD COLSPAN=17 WIDTH=582 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=1 STYLE="font-size: 8pt">(количество
				часов)</FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=26 WIDTH=664 VALIGN=BOTTOM STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
				<P CLASS="western"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=4 WIDTH=21 HEIGHT=5 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER>№ <FONT SIZE=2>п/п</FONT></P>
			</TD>
			<TD COLSPAN=8 WIDTH=137 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2>Ф.И.О.</FONT></P>
			</TD>
			<TD COLSPAN=8 WIDTH=80 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2>Должность</FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=90 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2>Наименование
				подразделения (цех, участок, отдел,
				лаборатория, мастерская и т.д.)</FONT></P>
			</TD>
			<TD WIDTH=90 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2>Результат
				проверки знаний (сдал/не сдал) №
				выданного удостоверения</FONT></P>
			</TD>
			<TD WIDTH=80 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2>Причина
				проверки знаний (очередная, внеочередная
				и т.д.)</FONT></P>
			</TD>
			<TD WIDTH=81 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2>Подпись
				проверяемого</FONT></P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=4 WIDTH=21 HEIGHT=24 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<OL>
					<LI><P ALIGN=CENTER><A NAME="_Hlk482476323"></A><A NAME="_Hlk482475427"></A><A NAME="_Hlk482475516"></A>
					</P>
				</OL>
			</TD>
			<TD COLSPAN=8 WIDTH=137 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western"><FONT<FONT SIZE=2><I>'. $fio .'</I></FONT></FONT></P>
			</TD>
			<TD COLSPAN=8 WIDTH=80 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT><FONT SIZE=2><I>'. $dol .'
				</I></FONT></FONT>
				</P>
			</TD>
			<TD COLSPAN=3 WIDTH=90 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2><I>Основное
				производство</I></FONT></P>
			</TD>
			<TD WIDTH=90 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><FONT SIZE=2><I>Сдал </I></FONT>
				</P>
			</TD>
			<TD WIDTH=80 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western"><FONT SIZE=2><I>Первичный</I></FONT></P>
			</TD>
			<TD WIDTH=81 STYLE="border: 1px solid #00000a; padding: 0in 0.08in">
				<P CLASS="western" ALIGN=CENTER><BR>
				</P>
			</TD>
		</TR>
	</TBODY>

</TABLE>

<TABLE WIDTH=669 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=154>
	<COL WIDTH=487>
	<TR VALIGN=BOTTOM>
		<TD WIDTH=154 HEIGHT=9 STYLE="border: none; padding: 0in">
			<P CLASS="western" ALIGN=JUSTIFY>Председатель комиссии</P>
		</TD>
		<TD WIDTH=487 STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
			<P CLASS="western" ALIGN=CENTER><FONT><FONT SIZE=3><I>'. $bossFIO .'</I></FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=154 HEIGHT=9 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
			<P CLASS="western" ALIGN=JUSTIFY><BR>
			</P>
		</TD>
		<TD WIDTH=487 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P CLASS="western" ALIGN=CENTER><FONT SIZE=1 STYLE="font-size: 8pt">(Ф.И.О.,
			подпись)</FONT></P>
		</TD>
	</TR>
	<TR VALIGN=BOTTOM>
		<TD WIDTH=154 HEIGHT=9 STYLE="border: none; padding: 0in">
			<P CLASS="western" ALIGN=JUSTIFY>Члены комиссии:</P>
		</TD>
		<TD WIDTH=487 STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
			<P CLASS="western" ALIGN=CENTER><FONT ><FONT SIZE=3><I>'. $chiefFIO .'</I></FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=154 HEIGHT=9 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
			<P CLASS="western" ALIGN=JUSTIFY><BR>
			</P>
		</TD>
		<TD WIDTH=487 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P CLASS="western" ALIGN=CENTER>  <FONT SIZE=1 STYLE="font-size: 8pt">(Ф.И.О.,
			подпись)</FONT></P>
		</TD>
	</TR>
	<TR VALIGN=BOTTOM>
		<TD WIDTH=154 HEIGHT=9 STYLE="border: none; padding: 0in">
			<P CLASS="western" ALIGN=JUSTIFY><BR>
			</P>
		</TD>
		<TD WIDTH=487 STYLE="border-top: none; border-bottom: 1px solid #00000a; border-left: none; border-right: none; padding: 0in">
			<P CLASS="western" ALIGN=CENTER><A NAME="_GoBack"></A><FONT ><FONT SIZE=3><I>Самарин
			Д.О.</I></FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=154 HEIGHT=9 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
			<P CLASS="western" ALIGN=JUSTIFY><BR>
			</P>
		</TD>
		<TD WIDTH=487 VALIGN=TOP STYLE="border-top: 1px solid #00000a; border-bottom: none; border-left: none; border-right: none; padding: 0in">
			<P CLASS="western" ALIGN=CENTER> <FONT SIZE=1 STYLE="font-size: 8pt">(Ф.И.О.,
			подпись)</FONT></P>
		</TD>
	</TR>
</TABLE>
<P CLASS="western" STYLE="margin-bottom: 0.14in" attr="'. $today .'"><BR><BR>
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


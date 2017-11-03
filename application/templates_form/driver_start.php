<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.02.2017
 * Time: 23:10
 */

$today = date("Y-m-d H:i:s");

$day= date("d.m.Y");
$sql = "SELECT * FROM items_control WHERE items_control.id = 175";
$dols = $db->row($sql);
$real_dol = $dols['name'];

$sql = "SELECT CONCAT_WS (' ',sump_for_employees.surname , sump_for_employees.name, sump_for_employees.patronymic) AS fio, sump_for_employees.birthday,
sump_for_employees.company_id
FROM sump_for_employees WHERE sump_for_employees.id =". $employee_id;
$employee = $db->row($sql);

$fio = $employee['fio'];
$birthday = $employee['birthday'];
$company = $employee['company_id'];
$dol = "Водитель";

$sql = "SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS boss_fio
        FROM organization_structure,employees_items_node,employees
        WHERE organization_structure.kladr_id = 164
        AND organization_structure.company_id = ". $company ."
        AND employees_items_node.org_str_id = organization_structure.id
        AND employees_items_node.employe_id = employees.id";
$bosses = $db->row($sql);
$boss = $bosses['boss_fio'];
$bossFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $boss);


$result_file =
    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.1.6.2 (Linux)">
	<META NAME="AUTHOR" CONTENT="ПАТП1">
	<META NAME="CREATED" CONTENT="20171030;34500000000000">
	<META NAME="CHANGEDBY" CONTENT="User">
	<META NAME="CHANGED" CONTENT="20171030;34500000000000">
	<STYLE TYPE="text/css">
	<!--
		@page { margin-right: 0.59in; margin-top: 0.79in; margin-bottom: 0.59in }
		P { margin-bottom: 0.08in; direction: ltr; color: #000000; line-height: 115%; widows: 2; orphans: 2 }
		P.western { font-family: "Calibri", sans-serif; font-size: 11pt; so-language: ru-RU }
		P.cjk { font-family: "Calibri", sans-serif; font-size: 11pt }
		P.ctl { font-family: "Calibri", sans-serif; font-size: 11pt; so-language: ar-SA }
		H1 { margin-top: 0.05in; margin-bottom: 0in; direction: ltr; color: #000000; line-height: 100%; text-align: center; widows: 0; orphans: 0; text-decoration: underline; page-break-after: auto }
		H1.western { font-family: "Arial", sans-serif; font-size: 12pt; so-language: ru-RU }
		H1.cjk { font-family: "Times New Roman", serif; font-size: 12pt }
		H1.ctl { font-family: "Arial", sans-serif; font-size: 12pt; so-language: ar-SA }
	-->
	</STYLE>
</HEAD>
<BODY LANG="en-US" TEXT="#000000" DIR="LTR">
<div class="Section1">
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0.14in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=4><U>ООО
«НОВОСИБИРСКПРОФСТРОЙ-ПАТП-1»</U></FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0.14in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=4><U>ОКВЭД
60.21.11</U></FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0.14in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt">Код
ОГРН</FONT></FONT></P>
<TABLE WIDTH=639 CELLPADDING=7 CELLSPACING=0 attr="' .$today . '">
	<COL WIDTH=34>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<TR>
		<TD WIDTH=34 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>1</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>0</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>2</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>5</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>4</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>0</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>1</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>0</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>1</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>5</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>4</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>3</FONT></FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>0</FONT></FONT></P>
		</TD>
	</TR>
</TABLE>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0.14in; line-height: 100%">
<BR><BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0.14in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=4><B>НАПРАВЛЕНИЕ
НА ПРЕДВАРИТЕЛЬНЫЙ (ПЕРИОДИЧЕСКИЙ)</B></FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0.14in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=4><B>МЕДИЦИНСКИЙ
ОСМОТР (ОБСЛЕДОВАНИЕ) № </B></FONT></FONT>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Направляется
 в ООО "Астра-Мед" </FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>1.Ф.И.О. '.  $fio .'</FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>2.Дата
рождения '.date("d.m.Y", strtotime($birthday)) .'</FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>3.Вид
медицинского осмотра: предварительный</FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>4.Поступающий
на работу</FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>5.Наименование
структурного подразделения работодателя -
 основное производство </FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>6.Должность,
профессия: водитель</FONT></FONT></P>
<TABLE WIDTH=639 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=300>
	<COL WIDTH=52>
	<COL WIDTH=242>
	<TR>
		<TD COLSPAN=3 WIDTH=623 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Times New Roman, serif">Наименование
			вредного и (или)  опасных производственных
			факторов*</FONT></P>
		</TD>
	</TR>
	<TR>
		<TD ROWSPAN=4 WIDTH=300 HEIGHT=10 VALIGN=TOP STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in; margin-bottom: 0.14in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>Химические
			факторы</FONT></FONT></P>
			<P LANG="ru-RU" CLASS="western"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Приложение
			№ 1</FONT></FONT></P>
		</TD>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>1.2.1</FONT></FONT></P>
		</TD>
		<TD WIDTH=242 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Азота
			неорганические соединения</FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>1.2.33.1</FONT></FONT></P>
		</TD>
		<TD WIDTH=242 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Алифатические
			одно- и многоатомные, ароматические
			и их производные: этанол, бутан-1-ол,
			бутан-2-ол, бутанол, пропан-1-ол,
			пропан-2-ол, 2-(проп-2-енокси) этанол, 2-Р
			этоксиэтанол, Р бензилкарбинол,
			этан-1,2-диол (этиленгликоль), пропан-2-диол
			(пропиленгликоль) и прочие</FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>1.2.37</FONT></FONT></P>
		</TD>
		<TD WIDTH=242 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Углерода
			оксид</FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>1.2.45</FONT></FONT></P>
		</TD>
		<TD WIDTH=242 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Углеводороды
			алифатические предельные, непредельные,
			циклические</FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD ROWSPAN=3 WIDTH=300 HEIGHT=22 VALIGN=TOP STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Физические
			факторы</FONT></FONT></P>
		</TD>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>3.4.1</FONT></FONT></P>
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>3.4.2</FONT></FONT></P>
		</TD>
		<TD WIDTH=242 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Локальные
			вибрация</FONT></FONT></P>
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Общая
			вибрация</FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>3.7</FONT></FONT></P>
		</TD>
		<TD WIDTH=242 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Инфразвук</FONT></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD WIDTH=52 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=2>Пр.№ 2 27</FONT></FONT></P>
		</TD>
		<TD WIDTH=242 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.17in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2>Управление
			автотранспортными средствами</FONT></FONT></P>
		</TD>
	</TR>
</TABLE>
<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.25in; border-top: none; border-bottom: 1.50pt solid #000000; border-left: none; border-right: none; padding-top: 0in; padding-bottom: 0.01in; padding-left: 0in; padding-right: 0in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=4>Начальник
отдела кадров                                                                       <FONT STYLE="margin-left: 380px;">'. $bossFIO .'</FONT></FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0.14in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt">(Должность
уполномоченного представителя)		подпись				ФИО</FONT></FONT></P>
<br>
<br>
<br>
<br>
<br>
<br>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4><U>ООО «НОВОСИБИРСКПРОФСТРОЙ-ПАТП-1»</U></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4><U>ОКВЭД   49.31.2</U></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=2 STYLE="font-size: 9pt">Код
ОГРН</FONT></P>
<TABLE WIDTH=639 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=34>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<COL WIDTH=35>
	<TR>
		<TD WIDTH=34 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>1</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>0</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>2</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>5</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>4</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>0</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>1</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>0</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>1</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>5</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>4</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>3</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>0</FONT></P>
		</TD>
	</TR>
</TABLE>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-left: 1.97in; text-indent: -1.97in; margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<B>НАПРАВЛЕНИЕ</B></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in"><A NAME="_Hlk475920279"></A>
на обязательное психиатрическое
освидетельствование</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="text-indent: 0.49in; margin-bottom: 0in">
С целью определения соответствия
состояния здоровья работника поручаемой
ему (ей) работе в должности (перечень
выполняемых работ и вредных и (или)
опасных производственных факторов)
прошу провести освидетельствование в
соответствии с постановлением
Правительства РФ от 23.09.2002 № 695 «О
прохождении обязательного психиатрического
освидетельствования работниками,
осуществляющими отдельные виды
деятельности, в том числе деятельность,
связанную с источниками повышенной
опасности (с влиянием вредных веществ
и неблагоприятных производственных
факторов), а также работающими в условиях
повышенной опасности».</P>
<P LANG="ru-RU" CLASS="western"><BR><BR>
</P>
<P LANG="ru-RU" CLASS="western">Направляется
в ООО "Астра-Мед"</P>
<P LANG="ru-RU" CLASS="western">1.Ф.И.О. '. $fio .'</P>
<P LANG="ru-RU" CLASS="western">2.Дата
рождения '. date("d.m.Y", strtotime($birthday)) .'</P>
<P LANG="ru-RU" CLASS="western">3.Должность '. $dol .'</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="text-indent: 0.49in; margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-top: 0.25in; border-top: none; border-bottom: 1.50pt solid #000000; border-left: none; border-right: none; padding-top: 0in; padding-bottom: 0.01in; padding-left: 0in; padding-right: 0in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=4>Начальник
отдела кадров                                                                       <FONT STYLE="margin-left: 380px;">'. $bossFIO .'</FONT></FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0.14in"><FONT FACE="Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt">(Должность
уполномоченного представителя)		подпись				ФИО</FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>

<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">

                        '.$day.'г.</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
МП</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>


<P LANG="ru-RU" ALIGN=RIGHT STYLE="margin-bottom: 0in; line-height: 100%">

</P>
<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%">
               <FONT FACE="Times New Roman, serif"><FONT SIZE=4>УТВЕРЖДАЮ</FONT></FONT></P>
<P LANG="ru-RU" ALIGN=RIGHT STYLE="margin-bottom: 0in; line-height: 100%">

</P>
<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%">
                                        <FONT FACE="Times New Roman, serif"><FONT SIZE=4>Директор
ООО «Новосибирскпрофстрой-ПАТП-1»</FONT></FONT></P>
<P LANG="ru-RU" ALIGN=RIGHT STYLE="margin-bottom: 0in; line-height: 100%">

</P>
<P LANG="ru-RU" ALIGN=RIGHT STYLE="margin-bottom: 0in; line-height: 100%">
                                                        <FONT FACE="Times New Roman, serif"><FONT SIZE=4>Земерова
Г.Н._____________________
                    </FONT></FONT>
</P>
<P LANG="ru-RU" ALIGN=RIGHT STYLE="margin-bottom: 0in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=4>				</FONT></FONT></P>
<P LANG="ru-RU" ALIGN=RIGHT STYLE="margin-bottom: 0in; line-height: 100%">
                                          <FONT FACE="Courier New, monospace"><FONT SIZE=2><FONT FACE="Times New Roman, serif"><FONT SIZE=4>«	»
  ______________ 2017г.</FONT></FONT></FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%">
<FONT FACE="Times New Roman, serif"><FONT SIZE=4>ЛИСТ
СОБЕСЕДОВАНИЯ</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%">     <FONT FACE="Times New Roman, serif"><FONT SIZE=4>В
 ООО «Новосибирскпрофстрой-ПАТП-1»
проведено собеседование с</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%;border-top: none; border-bottom: 0.50pt solid #000000;"><FONT FACE="Courier New, monospace"><FONT SIZE=2><FONT FACE="Times New Roman, serif"><FONT SIZE=4>'.$fio.'</FONT></FONT></FONT></FONT></P>
<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%">
<FONT FACE="Courier New, monospace"><FONT SIZE=2><FONT FACE="Times New Roman, serif"><FONT SIZE=4>
 </FONT></FONT><FONT FACE="Times New Roman, serif">(фамилия,
собственное имя, отчество )</FONT></FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>являющимся
кандидатом для назначения (согласования
назначения) на должность</FONT></FONT></P>
<P LANG="ru-RU" ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 100%; border-top: none; border-bottom: 0.50pt solid #000000;"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>'. $real_dol .'</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%">
               <FONT FACE="Times New Roman, serif"><FONT SIZE=2>
(наименование должности)</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>__________________________________________________________________</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%">
     <FONT FACE="Times New Roman, serif"><FONT SIZE=2>			  (состоял
ли кандидат на должность в резерве)</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Дата
рождения '. date("d.m.Y", strtotime($birthday)) .'</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Образование
__________________________________________________________________</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Последнее
место работы
__________________________________________________________________</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; border-top: none; border-bottom: 1.50pt solid #000000; border-left: none; border-right: none; padding-top: 0in; padding-bottom: 0.01in; padding-left: 0in; padding-right: 0in; line-height: 100%">
<BR>
</P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<TABLE WIDTH=639 CELLPADDING=7 CELLSPACING=0>
	<COL WIDTH=142>
	<COL WIDTH=143>
	<COL WIDTH=143>
	<COL WIDTH=153>
	<TR VALIGN=TOP>
		<TD WIDTH=142 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Должность
			лица, проводившего собеседование</FONT></FONT></P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Дата
			проведения собеседования</FONT></FONT></P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><FONT FACE="Courier New, monospace"><FONT SIZE=2><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Заключение
			по итогам собеседования </FONT></FONT><FONT FACE="Times New Roman, serif">(Согласен,
			не согласен)</FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=153 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" STYLE="margin-bottom: 0in"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Подпись,
			ФИО </FONT></FONT>
			</P>
			<P LANG="ru-RU"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>согласовывающего</FONT></FONT></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=142 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Зам.директора
			эксплуатации</FONT></FONT></P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=153 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=142 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Главный
			инженер</FONT></FONT></P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=153 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=142 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=153 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=142 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=143 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
		<TD WIDTH=153 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU"><BR>
			</P>
		</TD>
	</TR>
</TABLE>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>	</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>			</FONT></FONT></P>

<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=4>Начальник
отдела кадров				Л.В. Рыльская</FONT></FONT></P>


<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<H1 LANG="ru-RU" CLASS="western">Анкета</H1>

<TABLE WIDTH=682 CELLPADDING=7 CELLSPACING=0>
	<COLGROUP>
		<COL WIDTH=13>
		<COL WIDTH=89>
		<COL WIDTH=4357>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=4363>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=4364>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=107>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=23>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=18>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=4360>
		<COL WIDTH=123>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=8>
	</COLGROUP>
	<COLGROUP>
		<COL WIDTH=163>
	</COLGROUP>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=5 WIDTH=134 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=145 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR>Место<BR>для<BR>фотографии<BR></FONT></FONT><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=359 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD WIDTH=13 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>1.</FONT></FONT></P>
			</TD>
			<TD COLSPAN=4 WIDTH=107 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: none; border-right: none; padding: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>Фамилия</FONT></FONT></P>
			</TD>
			<TD COLSPAN=7 WIDTH=518 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=13 STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=4 WIDTH=107 STYLE="border: none; padding: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>Имя</FONT></FONT></P>
			</TD>
			<TD COLSPAN=7 WIDTH=518 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=13 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=4 WIDTH=107 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: none; border-right: none; padding: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>Отчество
				(при наличии)</FONT></FONT></P>
			</TD>
			<TD COLSPAN=7 WIDTH=518 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>2.
				Если изменяли фамилию, имя или отчество,
				то укажите их, а также когда, где и по
				какой причине изменяли</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>3.
				Число, месяц, год и место рождения
				(село, деревня, город, район, область,
				край, республика, страна)</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>4.
				Гражданство (если изменялось,
				указывается когда и по какой причине);
				гражданство другого государства (при
				наличии)</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>5.
				Образование (когда и какие учебные
				заведения окончили, номера документов
				об образовании). Направление подготовки
				или специальность по документу об
				образовании. Квалификация по документу
				об образовании</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>6.
				Сведения об обучении: в аспирантуре
				(адъюнктуре), ординатуре, в форме
				ассистентуры-стажировки (наименование
				образовательной или научной организации,
				год окончания). Ученая степень, ученое
				звание (когда присвоены, номера
				дипломов, аттестатов)</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>7.
				Какими иностранными языками и языками
				народов Российской Федерации владеете
				и в какой степени (читаете и переводите
				со словарем, читаете и можете
				объясняться, владеете свободно)</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>8.
				Сведения о судимости</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>9.
				Сведения о внесении в перечень
				организаций и физических лиц, в
				отношении которых имеются сведения
				об их причастности к экстремистской
				деятельности или терроризму, в
				соответствии с Федеральным законом
				от 7 августа 2001&nbsp;г. №&nbsp;115-ФЗ “О
				противодействии легализации (отмыванию)
				доходов, полученных преступным путем,
				и финансированию терроризма”</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>10.
				Допуск к государственной тайне,
				оформленный за период работы, службы,
				учебы, его форма, номер и дата (если
				имеется)</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>11.
				Сведения о выдаче разрешения органов
				внутренних дел на хранение или хранение
				и ношение гражданского и служебного
				оружия и патронов к нему (кем и когда
				выдавалось)</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="margin-bottom: 0in; widows: 0; orphans: 0">
				<FONT FACE="Arial, sans-serif"><FONT SIZE=2>12. Информация
				о трудовой деятельности (включая
				учебу в высших и средних специальных
				учебных заведениях, военную службу,
				работу по совместительству,
				предпринимательскую деятельность и
				иное).</FONT></FONT></P>
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>При
				заполнении данного пункта указывать
				наименования организаций так, как
				они именовались, военную службу - с
				указанием должности и номера воинской
				части</FONT></FONT></P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=6 WIDTH=256 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>Месяц
				и год<BR><BR></FONT></FONT><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>Должность
				с указанием организации<BR></FONT></FONT><BR>
				</P>
			</TD>
			<TD ROWSPAN=2 WIDTH=163 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>Адрес
				организации</FONT></FONT></P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>поступления</FONT></FONT></P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>увольнения</FONT></FONT></P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=4 WIDTH=125 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=219 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD WIDTH=163 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="margin-bottom: 0in; widows: 0; orphans: 0">
				<FONT FACE="Arial, sans-serif"><FONT SIZE=2>13. Ваши отец,
				мать, братья, сестры и дети, а также
				муж (жена), в том числе бывшие.</FONT></FONT></P>
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>Если
				родственники изменяли фамилию, имя,
				отчество, необходимо также указать
				их прежние фамилию, имя, отчество</FONT></FONT></P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR>Степень
				родства<BR><BR></FONT></FONT><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR>Фамилия,
				имя, отчество (при наличии)<BR></FONT></FONT><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR>Год,
				число, месяц и место рождения<BR></FONT></FONT><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR>Адрес
				регистрации, фактического проживания<BR></FONT></FONT><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR VALIGN=TOP>
			<TD COLSPAN=3 WIDTH=117 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=5 WIDTH=194 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=128 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=2 WIDTH=185 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>14.
				Отношение к воинской обязанности и
				воинское звание</FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR>15.
				Адрес регистрации, фактического
				проживания, контактный номер телефона
				(либо иной вид связи)</FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>16.
				Реквизиты документа, удостоверяющего
				личность</FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR>17.
				Дополнительные сведения (участие в
				деятельности общественных и других
				организаций, другая информация,
				которую желаете сообщить о себе)</FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
	<TBODY>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR><BR><BR>18.
				Мне известно, что сообщение о себе в
				анкете заведомо ложных сведений и
				мое несоответствие квалификационным
				требованиям могут повлечь отказ в
				допуске к выполнению работ,
				непосредственно связанных с обеспечением
				транспортной безопасности<BR><BR></FONT></FONT><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border-top: none; border-bottom: none; border-left: none; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0in; padding-left: 0in; padding-right: 0.08in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0">“<FONT FACE="Arial, sans-serif"><FONT SIZE=2>__”&nbsp;___________________&nbsp;20&nbsp;&nbsp;&nbsp;&nbsp;г.</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: none; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0in; padding-left: 0in; padding-right: 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=RIGHT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: none; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0in; padding-left: 0in; padding-right: 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>(подпись,
				фамилия заявителя)</FONT></FONT></P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=LEFT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border-top: none; border-bottom: none; border-left: none; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0in; padding-left: 0in; padding-right: 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0">“<FONT FACE="Arial, sans-serif"><FONT SIZE=2>__”&nbsp;___________________&nbsp;20&nbsp;&nbsp;&nbsp;&nbsp;г.</FONT></FONT></P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: none; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0in; padding-left: 0in; padding-right: 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD COLSPAN=9 WIDTH=330 STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=RIGHT STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
			<TD COLSPAN=3 WIDTH=322 STYLE="border-top: 1px solid #000000; border-bottom: none; border-left: none; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0in; padding-left: 0in; padding-right: 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>(подпись,
				фамилия работника<BR>кадровой службы)</FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=12 WIDTH=666 VALIGN=TOP STYLE="border-top: none; border-bottom: none; border-left: 1px solid #000000; border-right: 1px solid #000000; padding: 0in 0.08in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD ROWSPAN=2 COLSPAN=2 WIDTH=116 STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
				<P LANG="ru-RU" ALIGN=CENTER STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2><BR><BR>М.П.<BR><BR></FONT></FONT><BR>
				</P>
			</TD>
			<TD COLSPAN=10 WIDTH=536 STYLE="border-top: none; border-bottom: none; border-left: none; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0in; padding-left: 0in; padding-right: 0.08in">
				<P LANG="ru-RU" STYLE="widows: 0; orphans: 0"><FONT FACE="Arial, sans-serif"><FONT SIZE=2>Фотография
				и данные о трудовой деятельности,
				военной службе и об учебе лица,
				принимаемого на работу, непосредственно
				связанную с обеспечением транспортной
				безопасности, или выполняющего такую
				работу, соответствуют документам,
				удостоверяющим личность, записям в
				трудовой книжке, документам об
				образовании и военной службе</FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=10 WIDTH=536 VALIGN=TOP STYLE="border-top: none; border-bottom: 1px solid #000000; border-left: none; border-right: 1px solid #000000; padding-top: 0in; padding-bottom: 0in; padding-left: 0in; padding-right: 0.08in">
				<P LANG="ru-RU" STYLE="widows: 0; orphans: 0"><BR>
				</P>
			</TD>
		</TR>
	</TBODY>
</TABLE>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0.14in"><BR><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0.14in"><BR><BR>
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
        $doc_download_url = 'application/real_forms/' . md5($result_file) . '/' . $doc_name . '.doc';
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



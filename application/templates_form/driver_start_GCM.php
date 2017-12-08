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
$fioFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $fio);
$birthday = $employee['birthday'];
$birthdays = explode('-', $birthday);
$years = $birthdays[0];
$dol = "Водитель";

$doc = $get_data[0];


$sql = "SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS boss_fio
        FROM organization_structure,employees_items_node,employees
        WHERE organization_structure.kladr_id = 164
        AND organization_structure.company_id = ". $company_id ."
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
49.31.2</U></FONT></FONT></P>
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
 в ООО "Городской Центр Медосмотра" </FONT></FONT></P>
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
профессия: '. $real_dol .'</FONT></FONT></P>
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
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=2 STYLE="font-size: 11pt">ООО«НОВОСИБИРСКПРОФСТРОЙ-ПАТП-1»</FONT><FONT SIZE=2 STYLE="font-size: 11pt">
</FONT>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=2 STYLE="font-size: 11pt">630091,
г. Новосибирск, Красный проспект, 65</FONT></P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=2 STYLE="font-size: 11pt">ОГРН
10254010154</FONT><FONT SIZE=2 STYLE="font-size: 11pt"><SPAN LANG="en-US">/</SPAN></FONT><FONT SIZE=2 STYLE="font-size: 11pt">ОКВЭД
  49.31.230 </FONT>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">

</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0.11in; line-height: 106%">
<FONT FACE="CourierNewPSMT, Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 11pt">НАПРАВЛЕНИЕ
НА ПСИХИАТРИЧЕСКОЕ ОСВИДЕТЕЛЬСТВОВАНИЕ</FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 106%">
<FONT SIZE=2 STYLE="font-size: 11pt">в государственное
бюджетном учреждении здравоохранения
Новосибирской области «Государственная
Новосибирская клиническая психиатрическая
больница № 3» по адресу: г. Новосибирск,
ул. Владимировская, 2.</FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 106%">
<FONT SIZE=2 STYLE="font-size: 11pt">По договору №
244</FONT><FONT SIZE=2 STYLE="font-size: 11pt"><SPAN LANG="en-US">/</SPAN></FONT><FONT SIZE=2 STYLE="font-size: 11pt">2017
от  13.11.2017 г.</FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in; line-height: 107%">
<FONT FACE="CourierNewPSMT, Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 11pt">'. $fio .' , '. $years .'
года рождения, </FONT></FONT>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in; line-height: 107%">
<FONT COLOR="#000000">
             </FONT><FONT COLOR="#000000"><FONT FACE="CourierNewPSMT, Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt">(фамилия,
имя, отчество) </FONT></FONT></FONT>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 106%">
<FONT COLOR="#000000"><FONT FACE="CourierNewPSMT, Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 11pt">зарегистрированный(ая)
по адресу: ________________________________________, в
соответствии со ст. 213 Трудового кодекса
Российской Федерации направляется на
психиатрическое освидетельствование
с целью определения соответствия
состояния здоровья поручаемой ему (ей)
работе в должности
<br>
<br>
'. $real_dol .'
<br>
<br>
(перечень выполняемых работ и вредных
и (или) опасных производственных факторов)
Освидетельствование прошу провести в
соответствии с постановлением Совета
Министров - Правительства Российской
Федерации от 28.04.1993 N 377 с дополнениями
и изменениями, утвержденными постановлениями
Правительства РФ от 23.05.1998 N 486, от
31.07.1998 N 866, от 21.07.2000 N 546, постановлением
Правительства РФ от 23.09.2002 N 695.</FONT></FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in; line-height: 107%">
 <FONT FACE="CourierNewPSMT, Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 11pt">По
результатам психиатрического
освидетельствования _______________________</FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 106%">
<FONT COLOR="#000000">
                                                      </FONT><FONT COLOR="#000000"><FONT FACE="CourierNewPSMT, Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 9pt">(фамилия,
инициалы) </FONT></FONT></FONT>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 106%">
<FONT COLOR="#000000"><FONT FACE="CourierNewPSMT, Times New Roman, serif"><FONT SIZE=2 STYLE="font-size: 11pt">решение
комиссии о его (ее) годности (негодности)
к выполнению поручаемой работы прошу
выдать на руки обследуемому.</FONT></FONT></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<FONT SIZE=2 STYLE="font-size: 11pt">Начальник отдела
кадров
         Рыльская Л.В.</FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<FONT SIZE=2 STYLE="font-size: 11pt">+7 (383) 221-07-68</FONT></P>
<DIV TYPE=FOOTER>
	<P LANG="ru-RU" STYLE="margin-right: 0.25in; margin-bottom: 0in"><BR>
	</P>
</DIV>
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
                                          <FONT FACE="Courier New, monospace"><FONT SIZE=2><FONT FACE="Times New Roman, serif"><FONT SIZE=4>«____»
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

<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><FONT FACE="Times New Roman, serif" attr="'.$today .'"><FONT SIZE=4>Начальник
отдела кадров				Л.В. Рыльская</FONT></FONT></P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P LANG="ru-RU" STYLE="margin-bottom: 0in; line-height: 100%"><BR>
</P>
<P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 150%"><A NAME="_GoBack"></A>
<FONT SIZE=4><B>ПАМЯТКА<br></B></FONT>

<FONT SIZE=4><B>по прохождению  профосмотра,
водительской, оружейной комиссии в
               ООО<br> «Городской Центр Медосмотра»</B></FONT></P>

<P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 150%">
<FONT SIZE=4><B>ул. Вокзальная магистраль 1/1,
этаж 2, каб.205</B></FONT></P>
<P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in; line-height: 150%">
<FONT SIZE=4><B>Время работы: пн-пт с 7.30 до 17ч,
в субботу с 8 до 14ч.</B></FONT></P>
<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=4>В нашем
медицинском центре производится
</FONT><FONT SIZE=4><B>предварительная запись на
прохождение медицинского осмотра, по
телефонам 328-01-03, 209-03-01</B></FONT></P>

<P CLASS="western" STYLE="margin-bottom: 0in"><IMG SRC="application/templates_form/converted_file_bff16380_html_d2030b6.png" NAME="Рисунок 1" ALIGN=BOTTOM WIDTH=584 HEIGHT=339 BORDER=0></P>


<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>1.	Пациент,
пришедший на медицинский осмотр, должен
иметь при себе:</FONT></P>
<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>-
направление от организации с указанием
проф. вредности согласно приказу 302н и
профессии, а так же вид осмотра (первичный
или периодический);</FONT></P>
<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>-
паспорт;</FONT></P>
<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>-
результаты ФЛГ (если проходили менее
чем год назад);</FONT></P>
<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>-
необходимые анализы (для сан.книжек:
кал и моча, для проф.осмотра-моча).  </FONT>
</P>

<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>2.	За
сутки до сдачи анализов не есть жирную
и сильно сладкую пищу, не употреблять
алкоголь. За 1 час до ЭКГ – не курить, не
пить кофе/чай.</FONT></P>
<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>При
прохождении осмотра в дневное время
для сдачи анализа (кровь), не кушать за
3ч. Процедурный кабинет работает до 17ч!
Анализы можно сдавать в течение всего
дня!</FONT></P>

<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>3.	При
прохождении любого осмотра или комиссии
с участием офтальмолога, контактные
линзы необходимо снять не менее чем за
12 часов до начала осмотра. </FONT>
</P>

<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>4.	Для
прохождения УЗИ молочных желез (для
женщин старше 40 лет) необходима
предварительная запись по тел. 328-01-03,
209-03-01. </FONT>
</P>
<P CLASS="western" STYLE="margin-bottom: 0in"><FONT SIZE=3>5.	Для
водительской справки, комиссия нарколога
и психиатра с 1 апреля 2014г проводится
только в специализированных диспансерах:
ул.Светлая, 86 и ул.Каинская, 21а. В нашем
медцентре можно получить бланк справки
и пройти осмотр остальных врачей.</FONT></P>

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



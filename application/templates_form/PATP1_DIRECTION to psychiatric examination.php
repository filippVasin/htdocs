<?php

$today = date("Y-m-d H:i:s");

$sql="SELECT * FROM company WHERE company.id=". $_SESSION['control_company'];
$comp = $db->row($sql);
$company = $comp['name'];

$sql="SELECT CONCAT_WS (' ',employees.surname , employees.name, employees.second_name) AS fio, items_control.name AS dol,
        employees.birthday
        FROM employees,employees_items_node,organization_structure,items_control
        WHERE employees.id = ". $_SESSION['employee_id'] ."
        AND employees.id = employees_items_node.employe_id
        AND organization_structure.id = employees_items_node.org_str_id
        AND organization_structure.kladr_id = items_control.id
        AND organization_structure.company_id =". $_SESSION['control_company'];

$employees = $db->row($sql);
$fio = $employees['fio'];
$dol = $employees['dol'];
$birthday = date_create($employees['birthday'])->Format('d-m-Y');


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

WHERE employees_items_node.employe_id = ". $_SESSION['employee_id'] ."
AND organization_structure.id = employees_items_node.org_str_id
AND organization_structure.company_id = ". $_SESSION['control_company'] ."
AND chief_employees.id is not NULL
ORDER BY level DESC, boss_type DESC
LIMIT 1";
$boss = $db->row($sql);

$chief = $boss['chief_surname']." ". $boss['chief_name'] ." ". $boss['chief_second_name'];
$chiefFIO = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $chief);
$chief_dol = $boss['chief_dol'];

$result_file =
    '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.1.6.2 (Linux)">
	<META NAME="AUTHOR" CONTENT="ПАТП1">
	<META NAME="CREATED" CONTENT="20171030;111000000000000">
	<META NAME="CHANGEDBY" CONTENT="Самарин">
	<META NAME="CHANGED" CONTENT="20171030;111000000000000">
	<STYLE TYPE="text/css">
	<!--
		@page { margin-right: 0.59in; margin-top: 0.79in; margin-bottom: 0.79in }
		P { margin-bottom: 0.08in; direction: ltr; color: #000000; widows: 2; orphans: 2 }
		P.western { font-family: "Times New Roman", serif; font-size: 12pt; so-language: ru-RU }
		P.cjk { font-family: "Times New Roman", serif; font-size: 12pt }
		P.ctl { font-family: "Times New Roman", serif; font-size: 12pt; so-language: ar-SA }
		A:link { color: #0563c1 }
	-->
	</STYLE>
</HEAD>
<BODY LANG="en-US" TEXT="#000000" LINK="#0563c1" DIR="LTR">
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
в_______________________________________________________________</P>
<P LANG="ru-RU" CLASS="western"><BR><BR>
</P>
<P LANG="ru-RU" CLASS="western">1.Ф.И.О._____________________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">2.Дата
рождения_______________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">3.Должность__________________________________________________________________</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="text-indent: 0.49in; margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
 _____________________________ _________________
______________________________
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
                           <FONT SIZE=1 STYLE="font-size: 8pt">(должность)
                                              (подпись)
                                         (ФИО)</FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">

                        «____»__________ 20___ г.</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
МП</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4 STYLE="font-size: 16pt"><U>ООО «НПСК-авто»</U></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<U>ОКВЭД   60.21.11</U></P>
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
			<FONT SIZE=2>1</FONT></P>
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
			<FONT SIZE=2>7</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>6</FONT></P>
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
			<FONT SIZE=2>4</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>0</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>7</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>9</FONT></P>
		</TD>
	</TR>
</TABLE>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
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
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
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
в_______________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">1.Ф.И.О._____________________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">2.Дата
рождения_______________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">3.Должность__________________________________________________________________</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="text-indent: 0.49in; margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
 _____________
_______________________________________________________________
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
                                  (подпись)
             (ФИО)</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">

                        «____»__________ 20___ г.</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
Печать учреждения</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4><U>ООО «НОВОСИБИРСКПРОФСТРОЙ-ПАТП-1»</U></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4><U>ОКВЭД   60.21.11</U></FONT></P>
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
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<B>НАПРАВЛЕНИЕ</B></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
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
в_______________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">1.Ф.И.О._____________________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">2.Дата
рождения_______________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">3.Должность__________________________________________________________________</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="text-indent: 0.49in; margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
 _____________
_______________________________________________________________
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
                                  (подпись)
             (ФИО)</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">

                        «____»__________ 20___ г.</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
Печать учреждения</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4><U>ООО «НОВОСИБИРСКПРОФСТРОЙ-ПАТП-2»</U></FONT></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<FONT SIZE=4><U>ОКВЭД   60.21.11</U></FONT></P>
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
			<FONT SIZE=2>5</FONT></P>
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
			<FONT SIZE=2>2</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>0</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>0</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>8</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>2</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>8</FONT></P>
		</TD>
		<TD WIDTH=35 STYLE="border: 1px solid #000000; padding: 0in 0.08in">
			<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.08in">
			<FONT SIZE=2>7</FONT></P>
		</TD>
	</TR>
</TABLE>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
<B>НАПРАВЛЕНИЕ</B></P>
<P LANG="ru-RU" CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in">
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
в_______________________________________________________________</P>
<P LANG="ru-RU" CLASS="western">1.Ф.И.О. '. $fio .'</P>
<P LANG="ru-RU" CLASS="western">2.Дата
рождения '. $birthday .'</P>
<P LANG="ru-RU" CLASS="western">3.Должность '. $dol .'</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="text-indent: 0.49in; margin-bottom: 0in">
<BR>

</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
<BR>
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
 _____________
_______________________________________________________________
</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
                                  (подпись)
             (ФИО)</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">

                        «____»__________ 20___ г.</P>
<P LANG="ru-RU" CLASS="western" ALIGN=JUSTIFY STYLE="margin-bottom: 0in">
Печать учреждения</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<P LANG="ru-RU" CLASS="western" STYLE="margin-bottom: 0in" attr="'. $today .'"><BR>
</P>
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


<?php

$today = date("Y-m-d H:i:s");
$now_day = date("d-m-Y");
$sql="SELECT * FROM company WHERE company.id=". $company_id;
$comp = $db->row($sql);
$company = $comp['name'];


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
    $table .='<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="63" align="right" valign=top sdval="169" sdnum="1033;0;0"><font size=2>'. ($key + 1) .'</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $driver['fio'] . '</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $birthday . '</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $driver['address'] . '</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><font size=2>' . $driver['category'] . '</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $driver['license_number'] . '</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top><font size=2>' . $driver['end_date'] . '</font></td>
	</tr>';
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
	<colgroup width="197"></colgroup>
	<colgroup width="72"></colgroup>
	<colgroup width="177"></colgroup>
	<colgroup width="112"></colgroup>
	<colgroup width="87"></colgroup>
	<colgroup width="80"></colgroup>
	<tr>
		<td height="20" align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
		<td align="left" colspan="2"><b><font size=2>СПИСОК</font></b></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
	</tr>
	<tr>
		<td height="20" align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><font size=2>водителей</font></td>
		<td style="border-bottom: 1px solid #000000; text-align: center" align="left" colspan="2"><font size=2>  ООО &quot;Новосибирскпрофстрой ПАТП-1&quot;</font></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
	</tr>
	<tr>
		<td height="21" align="left"><br></td>
		<td align="center"><b><font size=3><br></font></b></td>
		<td align="left"><br></td>
		<td align="left" valign=top colspan="2">(наименование предприятия)</td>
		<td align="left"><br></td>
		<td align="left"><br></td>
	</tr>
	<tr>
		<td height="18" align="left"><br></td>
		<td align="left"><br></td>
		<td align="left" colspan="2"><font size=2>по состоянию на   '. $now_day .'</font></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
	</tr>
	<tr>
		<td height="25" align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
		<td align="left"><br></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="48" align="center" valign=top><b>№</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><font size=2>ФИО</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><font size=2>Дата<br>рождения</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b>Адрес по <br>регистрации</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b>Категория водит.<br>удостоверения</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><font size=2>№ водит.<br>удостоверения</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b>Срок действия<br>вод.удостоверения</b></td>
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


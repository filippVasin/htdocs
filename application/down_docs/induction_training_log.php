<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.02.2017
 * Time: 23:10
 */

$sql = "SELECT
	FIO.id,
	CONCAT_WS (' ', FIO.surname, FIO.name, FIO.second_name) AS 'FIO',
	CONCAT_WS (':', ITEMCONTROL2.name, ITEM2.name) AS 'OTDEl',
	CONCAT_WS (':', ITEMCONTROL1.name, ITEM1.name) AS 'DOLGNOST',
	FIO.birthday

FROM
		employees AS FIO
	LEFT JOIN
		employees_items_node
		ON
		FIO.id = employees_items_node.employe_id
	LEFT JOIN
		organization_structure AS ORG1
		ON
		ORG1.id = employees_items_node.org_str_id
	LEFT JOIN
		organization_structure AS ORG2
		ON
        (
            ORG1.`left_key` > ORG2.`left_key`
            AND
            ORG1.`right_key` < ORG2.`right_key`
            AND
            (ORG1.`level`-1)= ORG2.`level`
        )

	INNER JOIN
		items_control AS ITEM1
		ON
		ITEM1.id = ORG1.kladr_id
	INNER JOIN
		items_control_types AS ITEMCONTROL1
		ON
		ITEMCONTROL1.id = ITEM1.type_id
	INNER JOIN
		items_control AS ITEM2
		ON
		ITEM2.id = ORG2.kladr_id
	INNER JOIN
		items_control_types AS ITEMCONTROL2
		ON
		ITEMCONTROL2.id = ITEM2.type_id
WHERE
	FIO.id IN (".implode(', ', $employees_array).")
AND
    ORG2.company_id = ".$_SESSION['control_company']."
ORDER BY
	FIO.id";



//echo $sql;
$employees = $db->all($sql);
$table_line = '';
//print_r($employees);
$company_name = '';

foreach($employees as $employee){

            $company_name = $_SESSION['control_company_name'];
            $table_line .= '
                    <tr>
                    <td width="48">
                    ' . date('d.m.Y') . '
                    </td>
                    <td width="192">
                    ' . $employee['FIO'] . '
                    </td>
                    <td width="77">
                    ' . $systems->get_local_date_time($employee['birthday']) . '
                    </td>
                    <td width="150">
                    ' . str_replace('Должность:', "", $employee['DOLGNOST']) . '
                    </td>
                    <td width="157">
                    ' . $employee['OTDEl'] . '
                    </td>
                    <td width="192">
                    <p>&nbsp;</p>
                    </td>
                    <td width="96">
                    <p>&nbsp;</p>
                    </td>
                    <td width="87">
                    <p>&nbsp;</p>
                    </td>
                </tr>
    ';



}

//$employee_array = explode(';', $employee['items']);
//$employee['items'] = '';



//header('Content-type: application/vnd.ms-word');
//header("Content-Disposition: attachment; Filename = \"Вводный инструктаж журнал.doc\"");

$result_file =
    '<!DOCTYPE html>
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Вводный инструктаж журнал</title>
        <style>
                @page Section1 {
                    size:841.9pt 595.3pt; /* Размер бумаги */
                    mso-page-orientation: landscape; /* Ориентация*/
                    margin:3.0cm 2.0cm 42.5pt 2.0cm; /* Отступы*/
                    mso-header-margin:35.4pt; /* Расположение верхнего колонтитула */
                    mso-footer-margin:35.4pt; /* Расположение нижнего колонтитула */
                    mso-paper-source:0; /* Источникбумаги*/
                }
                div.Section1 {
                    page:Section1;
                }
        </style>
        </head>
        <body>
            <div class="Section1">
                <div align="center">НАИМЕНОВАНИЕ ОРГАНИЗАЦИИ <b>'.$company_name.'</b></div>
                <br>
                <div align="center">СТРУКТУРНОЕ ПОДРАЗДЕЛЕНИЕ___________________________________________</div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div style="font-size: 65px; font-weight: bold" align="center">ЖУРНАЛ</div><br>
                <br>
                <div style="font-size: 25px;" align="center">РЕГИСТРАЦИИ ВВОДНОГО ИНСТРУКТАЖА</div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div style="font-size: 15px;" align="right">Начат_________________'.date('Y').'г.</div>
                <div style="font-size: 15px;" align="right">Окончен_______________'.date('Y').'г.</div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <table style="font-size: 8pt;border-color: black; text-align: center;" border="1" width="999" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td rowspan="2" width="48">
                        Дата инструктажа
                    </td>
                    <td rowspan="2" width="192">
                        Фамилия, имя, отчество инструктируемого
                    </td>
                    <td rowspan="2" width="77">
                        Год рождения
                    </td>
                    <td rowspan="2" width="150">
                        Профессия, должность инструктируемого
                    </td>
                    <td rowspan="2" width="157">
                        Наименование производственного подразделения, в которое направляется инструктируемый
                    </td>
                    <td rowspan="2" width="192">
                        Фамилия, инициалы, должность инструктирующего
                    </td>
                    <td colspan="2" width="183">
                        Подпись
                    </td>
                </tr>
                <tr>
                    <td width="96">
                        Инструктирующего
                    </td>
                    <td width="87">
                        Инструктируемого
                    </td>
                </tr>

                <tr>
                    <td width="48">
                        <b>1</b>
                    </td>
                    <td width="192">
                        <b>2</b>
                    </td>
                    <td width="77">
                        <b>3</b>
                    </td>
                    <td width="150">
                        <b>4</b>
                    </td>
                    <td width="157">
                        <b>5</b>
                    </td>
                    <td width="192">
                        <b>6</b>
                    </td>
                    <td width="96">
                        <b>7</b>
                    </td>
                    <td width="87">
                        <b>8</b>
                    </td>
                </tr>

               '.$table_line.'

                </tbody>
                </table>
            </div>

        </body>
        </html>';

$folder_name = $_SERVER['DOCUMENT_ROOT'].'/temp_downloads/'.md5($result_file);
if(!is_dir($folder_name)){
    mkdir($folder_name);
}

file_put_contents($folder_name.'/induction_training_log.doc', $result_file, FILE_APPEND);

$doc_download_url = '/temp_downloads/'.md5($result_file).'/induction_training_log.doc';
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.02.2017
 * Time: 9:25
 */

$sql = "
            SELECT CONCAT_WS(' ', `company`.`director_surname`, `company`.`director_name`, `company`.`director_second_name`) AS `director_fio`, `company`.`name` AS `company_name`
            FROM `employees`, `employees_items_node`, `items_control`, `company`
            WHERE `employees`.`id` IN (".implode(', ', $employees_array).")
            AND `employees`.`id` = `employees_items_node`.`employe_id`
            AND `employees_items_node`.`item_id` = `items_control`.`id`
            AND `employees`.`status` != 0
        ";
$employees_data = $db->row($sql);

$company_name = $employees_data['company_name'];
$director_fio = $employees_data['director_fio'];

$result_file = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>Untitled Document</title>
<style type=\"text/css\">
<!--
div.MsoNormal {mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:\"\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Calibri\",sans-serif;
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";}
li.MsoNormal {mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:\"\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Calibri\",sans-serif;
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";}
p.MsoNormal {mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:\"\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Calibri\",sans-serif;
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";}
span.SpellE {mso-style-name:\"\";
	mso-spl-e:yes;}
-->
</style>
</head>

<body>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal'><span class=\"SpellE\"><b style='mso-bidi-font-weight:
normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-ansi-language:UK' lang=\"uk\" xml:lang=\"uk\">Должностная</span></b></span><b style='mso-bidi-font-weight:
normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-ansi-language:UK' lang=\"uk\" xml:lang=\"uk\"> <span class=\"SpellE\">инструкция</span> бухгалтера
        <o:p></o:p>
</span></b></p>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\">
  <o:p>&nbsp;</o:p>
</span></b></p>
<p class=\"MsoNormal\" align=\"right\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:right;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:UK' lang=\"uk\" xml:lang=\"uk\">УТВЕРЖДАЮ:
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"right\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:right;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:UK' lang=\"uk\" xml:lang=\"uk\">
  <o:p>&nbsp;</o:p>
</span></p>
<p class=\"MsoNormal\" align=\"right\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:right;line-height:normal;tab-stops:212.65pt 8.0cm'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK' lang=\"uk\" xml:lang=\"uk\">Директор ".$company_name."
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal;tab-stops:212.65pt 8.0cm'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK' lang=\"uk\" xml:lang=\"uk\"><span
style='mso-spacerun:yes'>                                                                                     </span></span><span style='font-size:10.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-ansi-language:UK' lang=\"uk\" xml:lang=\"uk\">(<span class=\"SpellE\">наименование</span> <span
class=\"SpellE\">организации</span>)
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal;tab-stops:212.65pt 8.0cm'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK' lang=\"uk\" xml:lang=\"uk\">
  <o:p>&nbsp;</o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal;tab-stops:212.65pt 8.0cm'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK' lang=\"uk\" xml:lang=\"uk\"><span
style='mso-spacerun:yes'>                                                      </span><span style='mso-spacerun:yes'>                  </span>_______<span
style='mso-spacerun:yes'>   </span>".$director_fio."
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal;tab-stops:212.65pt 8.0cm'><span
style='font-size:10.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK' lang=\"uk\" xml:lang=\"uk\"><span style='mso-spacerun:yes'>                                             </span>(<span class=\"SpellE\">подпись</span>)<span
style='mso-spacerun:yes'>                    </span>(ФИО)
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\">
  <o:p>&nbsp;</o:p>
</span></b></p>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\"><span style='mso-spacerun:yes'>                              </span></span></b><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\"><span style='mso-spacerun:yes'> </span><span
style='mso-spacerun:yes'>                                                          </span>«<span
style='mso-spacerun:yes'>  </span>» ______________________ ".date('Y')." г.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\">
  <o:p>&nbsp;</o:p>
</span></b></p>
<p class=\"MsoNormal\" align=\"center\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
auto;text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\">І.</span></b><b style='mso-bidi-font-weight:normal'><span style='font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif'> Общие положения
        <o:p></o:p>
</span></b></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal;tab-stops:11.0cm 326.05pt'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif'>1. Бухгалтер
  принадлежит к профессиональной категории «специалисты».
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>2. Бухгалтер назначается на должность и
  освобождается от нее приказом директора организации в установленном порядке
  согласно действующему трудовому законодательству по представлению главного
  бухгалтера.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>3. Бухгалтер подчиняется непосредственно
  главному бухгалтеру или руководителю соответствующего подразделения главной
  бухгалтерии.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>4. При отсутствии бухгалтера его
  обязанности исполняет лицо, назначенное в установленном порядке, о чем указано
  в приказе по организации.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>5. На должность бухгалтера назначается
  лицо, имеющее:
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal;background:white'><span style='font-size:
11.5pt;font-family:&quot;Times New Roman&quot;,serif;color:black'>5.1. Бухгалтер I
  категории: высшее профессиональное (экономическое) образование и стаж работы в
  должности бухгалтера II категории не менее 3 лет.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal;background:white'><span style='font-size:
11.5pt;font-family:&quot;Times New Roman&quot;,serif;color:black'>5.2. Бухгалтер II
  категории: высшее профессиональное (экономическое) образование без предъявления
  требований к стажу работы или среднее профессиональное (экономическое)
  образование и стаж работы в должности бухгалтера не менее 3 лет.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal;background:white'><span style='font-size:
11.5pt;font-family:&quot;Times New Roman&quot;,serif;color:black'>5.3. Бухгалтер: среднее
  профессиональное (экономическое) образование без предъявления требований к
  стажу работы или специальную подготовку по установленной программе и стаж
  работы по учету и контролю не менее 3 лет.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>6. Бухгалтер должен знать:
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>- законодательные акты, ведомственные
  нормативно-правовые акты, распоряжения, приказы и другие материалы по
  организации бухгалтерского учета;
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>- стандарты, образцы и формы документов,
  принятых в организации, особенности их составления, систематизации, обработки и
  хранения;
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>- план и корреспонденцию счетов;
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>- организацию документооборота по участкам
  бухгалтерского учета;
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>- порядок отражения на счетах
  бухгалтерского учета операций, связанных с движением основных и денежных
  средств, товарно-материальных ценностей;
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>- законодательство о труде;
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>-<span style='mso-spacerun:yes'>  </span>правила и нормы охраны труда, технику безопасности, в том числе
  пожарную;
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>- правила эксплуатации вычислительной
  техники;
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>- данную должностную инструкцию.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
auto;text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\">ІІ.</span></b><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif'> Должностные
  обязанности бухгалтера
        <o:p></o:p>
</span></b></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>Бухгалтер выполняет следующие обязанности:
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>1. Ведет бухгалтерский учет имущества,
  обязательств и хозяйственных операций (учет основных средств,
  товарно-материальных ценностей, реализации продукции, движения денежных
  средств, затрат на производство и т.п.).
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>2. Принимает, контролирует и
  подготавливает к счетной обработке первичную документацию.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>3. Отражает на счетах бухгалтерского учета
  операции, которые связаны с движением основных и денежных средств,
  товарно-материальных ценностей.
  <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>4. Оформляет и предоставляет в банк
  платежные поручения.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>5. Разрабатывает план счетов, формы
  документов для оформления хозяйственных и других операций, по которым не
  предусмотрены типовые формы.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>6. Осуществляет начисление и перечисление
  налогов и сборов в бюджеты различного уровня, страховых взносов в социальные
  фонды, заработной платы работников, других видов выплат.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>7. Участвует в анализе
  хозяйственно-финансовой деятельности организации и разработке мероприятий по
  рационализации использования ресурсов.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>8. Обеспечивает достоверной бухгалтерской
  информацией руководителя организации, инвесторов, аудиторов и других лиц,
  имеющих право на ее получение.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>9. Систематизирует данные по участкам
  бухгалтерского учета для составления отчетности.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>10. Принимает участие в инвентаризации
  денежных средств и товарно-материальных ценностей.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>11. Занимается формированием, ведением и
  хранением документации по бухгалтерскому учету.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>12. Выполняет распоряжения
  непосредственного руководителя.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
auto;text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\">ІІІ.</span></b><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif'> Права
        <o:p></o:p>
</span></b></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>Бухгалтер имеет право:
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>1. Участвовать в обсуждении вопросов,
  входящих в его должностные обязанности.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>2. Запрашивать материалы и документы,
  необходимые для решения поставленных задач.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>3. Сообщать своему непосредственному
  руководителю выявленные в процессе работы недостатки и вносить предложения по
  их устранению.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>4. Получать содействие руководства
  организации в исполнении своих должностных обязанностей.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
auto;text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
UK'
lang=\"uk\" xml:lang=\"uk\">І</span></b><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
EN-US' lang=\"EN-US\" xml:lang=\"EN-US\">V</span></b><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif'>. Ответственность
        <o:p></o:p>
</span></b></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>Бухгалтер несет ответственность за:
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>1. Невыполнение или выполнение не в полном
  объеме своих должностных обязанностей.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>2. Несоблюдение распоряжений, инструкций и
  приказов непосредственного руководителя или администрации организации.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>3. Нарушение Правил внутреннего трудового
  распорядка организации, трудовой дисциплины или техники безопасности.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>4. Распространение конфиденциальной
  информации, разглашение служебной и коммерческой тайны.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>5. Причинение материального ущерба (в
  рамках законодательства РФ).
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" align=\"center\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
auto;text-align:center;line-height:normal'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-ansi-language:EN-US'
lang=\"EN-US\" xml:lang=\"EN-US\">V</span></b><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif'>. Условия работы
        <o:p></o:p>
</span></b></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>1. Условия работы бухгалтера определяются
  Правилами внутреннего трудового распорядка организации.
      <o:p></o:p>
</span></p>
<p class=\"MsoNormal\" style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;line-height:normal'><span style='font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif'>2. Бухгалтер может направляться в командировки
  (в том числе местного значения) при возникновении производственной
  необходимости.
      <o:p></o:p>
</span></p>
</body>
</html>

";


$folder_name = $_SERVER['DOCUMENT_ROOT'].'/temp_downloads/'.md5($result_file);
if(!is_dir($folder_name)){
    mkdir($folder_name);
}

file_put_contents($folder_name.'/job_description_accountant_guide.doc', $result_file, FILE_APPEND);

$doc_download_url = '/temp_downloads/'.md5($result_file).'/job_description_accountant_guide.doc';

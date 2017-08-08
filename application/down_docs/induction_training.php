<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.02.2017
 * Time: 1:03
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

header('Content-type: application/vnd.ms-word');
header("Content-Disposition: attachment; Filename = \"Справочник.doc\"");

$result_file = "
<html xmlns:v=\"urn:schemas-microsoft-com:vml\"
xmlns:o=\"urn:schemas-microsoft-com:office:office\"
xmlns:w=\"urn:schemas-microsoft-com:office:word\"
xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\"
xmlns=\"http://www.w3.org/TR/REC-html40\">

<head>
<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">
<meta name=ProgId content=Word.Document>
<meta name=Generator content=\"Microsoft Word 15\">
<meta name=Originator content=\"Microsoft Word 15\">
<title>Программа вводного инструктажа</title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Duron 600</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>root</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>82</o:TotalTime>
  <o:Created>2017-02-15T20:54:00Z</o:Created>
  <o:LastSaved>2017-02-15T20:54:00Z</o:LastSaved>
  <o:Pages>16</o:Pages>
  <o:Words>8298</o:Words>
  <o:Characters>47299</o:Characters>
  <o:Lines>394</o:Lines>
  <o:Paragraphs>110</o:Paragraphs>
  <o:CharactersWithSpaces>55487</o:CharactersWithSpaces>
  <o:Version>16.00</o:Version>
 </o:DocumentProperties>
 <o:OfficeDocumentSettings>
  <o:TargetScreenSize>800x600</o:TargetScreenSize>
 </o:OfficeDocumentSettings>
</xml><![endif]-->
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:AutoHyphenation/>
  <w:HyphenationZone>17</w:HyphenationZone>
  <w:DrawingGridHorizontalSpacing>6 пт</w:DrawingGridHorizontalSpacing>
  <w:DrawingGridVerticalSpacing>8,15 пт</w:DrawingGridVerticalSpacing>
  <w:DisplayHorizontalDrawingGridEvery>0</w:DisplayHorizontalDrawingGridEvery>
  <w:DisplayVerticalDrawingGridEvery>2</w:DisplayVerticalDrawingGridEvery>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>RU</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:SelectEntireFieldWithStartOrEnd/>
   <w:UseWord2002TableStyleRules/>
   <w:UseWord2010TableStyleRules/>
   <w:DontUseIndentAsNumberingTabStop/>
   <w:FELineBreak11/>
   <w:WW11IndentRules/>
   <w:DontAutofitConstrainedTables/>
   <w:AutofitLikeWW11/>
   <w:HangulWidthLikeWW11/>
   <w:UseNormalStyleForList/>
   <w:DontVertAlignCellWithSp/>
   <w:DontBreakConstrainedForcedTables/>
   <w:DontVertAlignInTxbx/>
   <w:Word11KerningPairs/>
   <w:CachedColBalance/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
  <m:mathPr>
   <m:mathFont m:val=\"Cambria Math\"/>
   <m:brkBin m:val=\"before\"/>
   <m:brkBinSub m:val=\"&#45;-\"/>
   <m:smallFrac m:val=\"off\"/>
   <m:dispDef/>
   <m:lMargin m:val=\"0\"/>
   <m:rMargin m:val=\"0\"/>
   <m:defJc m:val=\"centerGroup\"/>
   <m:wrapIndent m:val=\"1440\"/>
   <m:intLim m:val=\"subSup\"/>
   <m:naryLim m:val=\"undOvr\"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState=\"false\" DefUnhideWhenUsed=\"false\"
  DefSemiHidden=\"false\" DefQFormat=\"false\" DefPriority=\"99\"
  LatentStyleCount=\"371\">
  <w:LsdException Locked=\"false\" Priority=\"0\" QFormat=\"true\" Name=\"Normal\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 7\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 8\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 9\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 5\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 6\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 7\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 8\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index 9\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 7\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 8\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"toc 9\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Normal Indent\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"footnote text\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"annotation text\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"header\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"footer\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"index heading\"/>
  <w:LsdException Locked=\"false\" Priority=\"35\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"caption\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"table of figures\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"envelope address\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"envelope return\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"footnote reference\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"annotation reference\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"line number\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"page number\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"endnote reference\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"endnote text\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"table of authorities\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"macro\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"toa heading\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Bullet\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Number\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List 5\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Bullet 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Bullet 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Bullet 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Bullet 5\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Number 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Number 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Number 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Number 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"10\" QFormat=\"true\" Name=\"Title\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Closing\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Signature\"/>
  <w:LsdException Locked=\"false\" Priority=\"0\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"Default Paragraph Font\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Body Text\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Body Text Indent\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Continue\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Continue 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Continue 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Continue 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"List Continue 5\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Message Header\"/>
  <w:LsdException Locked=\"false\" Priority=\"11\" QFormat=\"true\" Name=\"Subtitle\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Salutation\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Date\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Body Text First Indent\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Body Text First Indent 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Note Heading\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Body Text 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Body Text 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Body Text Indent 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Body Text Indent 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Block Text\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Hyperlink\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"FollowedHyperlink\"/>
  <w:LsdException Locked=\"false\" Priority=\"22\" QFormat=\"true\" Name=\"Strong\"/>
  <w:LsdException Locked=\"false\" Priority=\"20\" QFormat=\"true\" Name=\"Emphasis\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Document Map\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Plain Text\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"E-mail Signature\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Top of Form\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Bottom of Form\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Normal (Web)\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Acronym\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Address\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Cite\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Code\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Definition\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Keyboard\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Preformatted\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Sample\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Typewriter\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"HTML Variable\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Normal Table\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"annotation subject\"/>
  <w:LsdException Locked=\"false\" Priority=\"0\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"No List\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Outline List 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Outline List 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Outline List 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Simple 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Simple 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Simple 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Classic 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Classic 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Classic 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Classic 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Colorful 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Colorful 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Colorful 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Columns 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Columns 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Columns 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Columns 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Columns 5\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Grid 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Grid 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Grid 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Grid 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Grid 5\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Grid 6\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Grid 7\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Grid 8\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table List 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table List 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table List 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table List 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table List 5\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table List 6\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table List 7\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table List 8\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table 3D effects 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table 3D effects 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table 3D effects 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Contemporary\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Elegant\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Professional\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Subtle 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Subtle 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Web 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Web 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Web 3\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Balloon Text\"/>
  <w:LsdException Locked=\"false\" Priority=\"59\" Name=\"Table Grid\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"Table Theme\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Placeholder Text\"/>
  <w:LsdException Locked=\"false\" Priority=\"1\" QFormat=\"true\" Name=\"No Spacing\"/>
  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading\"/>
  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List\"/>
  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid\"/>
  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List\"/>
  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading\"/>
  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List\"/>
  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid\"/>
  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 1\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Revision\"/>
  <w:LsdException Locked=\"false\" Priority=\"34\" QFormat=\"true\"
   Name=\"List Paragraph\"/>
  <w:LsdException Locked=\"false\" Priority=\"29\" QFormat=\"true\" Name=\"Quote\"/>
  <w:LsdException Locked=\"false\" Priority=\"30\" QFormat=\"true\"
   Name=\"Intense Quote\"/>
  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"19\" QFormat=\"true\"
   Name=\"Subtle Emphasis\"/>
  <w:LsdException Locked=\"false\" Priority=\"21\" QFormat=\"true\"
   Name=\"Intense Emphasis\"/>
  <w:LsdException Locked=\"false\" Priority=\"31\" QFormat=\"true\"
   Name=\"Subtle Reference\"/>
  <w:LsdException Locked=\"false\" Priority=\"32\" QFormat=\"true\"
   Name=\"Intense Reference\"/>
  <w:LsdException Locked=\"false\" Priority=\"33\" QFormat=\"true\" Name=\"Book Title\"/>
  <w:LsdException Locked=\"false\" Priority=\"37\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"Bibliography\"/>
  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"TOC Heading\"/>
  <w:LsdException Locked=\"false\" Priority=\"41\" Name=\"Plain Table 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"42\" Name=\"Plain Table 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"43\" Name=\"Plain Table 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"44\" Name=\"Plain Table 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"45\" Name=\"Plain Table 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"40\" Name=\"Grid Table Light\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"Grid Table 1 Light\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"Grid Table 6 Colorful\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"Grid Table 7 Colorful\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"Grid Table 1 Light Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"Grid Table 6 Colorful Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"Grid Table 7 Colorful Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"Grid Table 1 Light Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"Grid Table 6 Colorful Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"Grid Table 7 Colorful Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"Grid Table 1 Light Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"Grid Table 6 Colorful Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"Grid Table 7 Colorful Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"Grid Table 1 Light Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"Grid Table 6 Colorful Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"Grid Table 7 Colorful Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"Grid Table 1 Light Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"Grid Table 6 Colorful Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"Grid Table 7 Colorful Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"Grid Table 1 Light Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"Grid Table 6 Colorful Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"Grid Table 7 Colorful Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"List Table 1 Light\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"List Table 6 Colorful\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"List Table 7 Colorful\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"List Table 1 Light Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"List Table 6 Colorful Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"List Table 7 Colorful Accent 1\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"List Table 1 Light Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"List Table 6 Colorful Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"List Table 7 Colorful Accent 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"List Table 1 Light Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"List Table 6 Colorful Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"List Table 7 Colorful Accent 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"List Table 1 Light Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"List Table 6 Colorful Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"List Table 7 Colorful Accent 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"List Table 1 Light Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"List Table 6 Colorful Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"List Table 7 Colorful Accent 5\"/>
  <w:LsdException Locked=\"false\" Priority=\"46\"
   Name=\"List Table 1 Light Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"51\"
   Name=\"List Table 6 Colorful Accent 6\"/>
  <w:LsdException Locked=\"false\" Priority=\"52\"
   Name=\"List Table 7 Colorful Accent 6\"/>
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:\"Cambria Math\";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:204;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-536870145 1107305727 0 0 415 0;}
@font-face
	{font-family:TimesET;
	mso-font-alt:\"Times New Roman\";
	mso-font-charset:0;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:647 0 0 0 31 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:\"\";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:TimesET;
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";}
h1
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-next:Обычный;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:1;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-font-kerning:0pt;}
h2
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-next:Обычный;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:1.0cm;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:2;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-bidi-font-weight:normal;
	font-style:italic;
	mso-bidi-font-style:normal;}
h3
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-next:Обычный;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:3;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-bidi-font-weight:normal;
	font-style:italic;
	mso-bidi-font-style:normal;}
h4
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-next:Обычный;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:4;
	font-size:12.0pt;
	font-family:TimesET;}
h5
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-next:Обычный;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:5;
	font-size:10.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:TimesET;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 233.85pt right 467.75pt;
	font-size:12.0pt;
	font-family:TimesET;
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";}
p.MsoTitle, li.MsoTitle, div.MsoTitle
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:12.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-align:center;
	text-indent:36.0pt;
	mso-pagination:none;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:16.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	mso-font-kerning:14.0pt;
	font-weight:bold;
	mso-bidi-font-weight:normal;}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{mso-style-unhide:no;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	text-align:justify;
	text-indent:36.0pt;
	mso-pagination:none;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:14.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";}
p.MsoBodyText2, li.MsoBodyText2, div.MsoBodyText2
	{mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:TimesET;
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	color:black;
	layout-grid-mode:line;}
span.a
	{mso-style-name:\"Гипертекстовая ссылка\";
	mso-style-unhide:no;
	mso-style-parent:\"\";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	color:green;
	text-decoration:underline;
	text-underline:single;}
p.a0, li.a0, div.a0
	{mso-style-name:\"Заголовок статьи\";
	mso-style-unhide:no;
	mso-style-next:Обычный;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:80.6pt;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-44.6pt;
	mso-pagination:none;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:10.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";}
span.SpellE
	{mso-style-name:\"\";
	mso-spl-e:yes;}
span.GramE
	{mso-style-name:\"\";
	mso-gram-e:yes;}
@page WordSection1
	{size:21.0cm 842.0pt;
	margin:1.0cm 42.55pt 2.0cm 2.0cm;
	mso-header-margin:35.45pt;
	mso-footer-margin:35.45pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:\"Обычная таблица\";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:\"\";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:\"Times New Roman\",serif;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext=\"edit\" spidmax=\"1026\"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext=\"edit\">
  <o:idmap v:ext=\"edit\" data=\"1\"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=RU style='tab-interval:35.4pt'>

<div class=WordSection1>

<p class=MsoNormal align=center style='text-align:center;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><b style='mso-bidi-font-weight:
normal'><u><span style='font-size:16.0pt;font-family:\"Times New Roman\",serif'><o:p><span
 style='text-decoration:none'>&nbsp;</span></o:p></span></u></b></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:16.0pt;
font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt;
font-family:\"Times New Roman\",serif'>Утверждаю:<o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt;
font-family:\"Times New Roman\",serif'>Директор ".$company_name."<o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt;
font-family:\"Times New Roman\",serif'>_________<span>".$director_fio."</span><o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt;
font-family:\"Times New Roman\",serif'>«_<span class=GramE>_»_</span>________".date('Y')."<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center;text-indent:35.45pt;
mso-pagination:none;mso-layout-grid-align:none;text-autospace:none'><span
style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<h3 align=right style='text-align:right'><span style='font-weight:normal;
font-style:normal'><o:p>&nbsp;</o:p></span></h3>

<h3 style='text-align:justify'><span style='font-weight:normal'><span
style='mso-tab-count:7'>                                                                                   </span><o:p></o:p></span></h3>

<h3 align=left style='text-align:left;tab-stops:center 233.85pt left 328.5pt'><span
style='font-weight:normal;font-style:normal'><span style='mso-tab-count:1'>                                                    </span></span><span
style='font-style:normal'>ВВОДНЫЙ ИНСТРУКТАЖ<span style='mso-tab-count:1'>     </span><o:p></o:p></span></h3>

<h3><span style='font-style:normal'>ПО ОХРАНЕ <span class=GramE>ТРУДА<span
style='mso-spacerun:yes'>  </span>ДЛЯ</span> ПОСТУПАЮЩИХ НА РАБОТУ</span></h3>

<h3 style='text-align:justify'><span style='font-weight:normal'><span
style='mso-spacerun:yes'> </span><o:p></o:p></span></h3>

<h3 style='text-align:justify'><span style='font-weight:normal'><span
style='mso-spacerun:yes'>            </span></span><span style='font-style:
normal'>Назначение инструктажа<o:p></o:p></span></h3>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'>Вводный
инструктаж по охране труда проводят со всеми вновь принимаемыми на <span
class=GramE>работу<span style='mso-spacerun:yes'>  </span>независимо</span> от
их образования, стажа работы по данной профессии или должности, с временными
работниками, командированными, учащимися и студентами, прибывшими на
производственное обучение или на практику.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>При вводном инструктаже
вновь поступающему работнику даются знания для сознательного отношения к
выполнению правил и инструкций по охране труда, технике безопасности
производственной санитарии, пожарной и <span class=GramE>электробезопасности</span>
и другие.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>Каждый имеет право на труд в
условиях, отвечающих требованиям безопасности и гигиены, на вознаграждение за
труд без какой бы то ни было дискриминации и не ниже установленного федеральным
законом минимального размера оплаты труда, а также право на защиту от безработицы
(ч.3 ст.37 Конституция РФ).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>Охрана и укрепление здоровья
людей — дело первостепенной важности. Проблемы здоровья должны рассматривать с
широких социальных позиций. Оно определяется, прежде всего, условиями труда и
быта, уровнем благосостояния.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><b
style='mso-bidi-font-weight:normal'><span style='font-family:\"Times New Roman\",serif'>Каждый
работник имеет право на:<o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>заключение, изменение и расторжение
трудового договора в порядке и на условиях, которые установлены Трудовым
кодексом РФ, иными федеральными законами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>предоставление ему работы,
обусловленной трудовым договором;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>рабочее место, соответствующее
государственным нормативным требованиям охраны труда и условиям,
предусмотренным коллективным договором;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>своевременную и в полном объеме
выплату заработной платы в соответствии со своей квалификацией, сложностью
труда, количеством и качеством выполненной работы;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>отдых, обеспечиваемый установлением
нормальной продолжительности рабочего времени, сокращенного рабочего времени
для отдельных профессий и категорий работников, предоставлением еженедельных
выходных дней, нерабочих праздничных дней, оплачиваемых ежегодных отпусков;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>полную достоверную информацию об
условиях труда и требованиях охраны труда на рабочем месте;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>профессиональную подготовку,
переподготовку и повышение своей квалификации в порядке, установленном Трудовым
кодексом РФ, иными федеральными законами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>объединение, включая право на
создание профессиональных союзов и вступление в них для защиты своих трудовых
прав, свобод и законных интересов;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>участие в управлении организацией в
предусмотренных Трудовым кодексом РФ, иными федеральными законами и
коллективным договором формах;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>ведение коллективных переговоров и
заключение коллективных договоров и соглашений через своих представителей, а
также на информацию о выполнении коллективного договора, соглашений;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>защиту своих трудовых прав, свобод
и законных интересов всеми не запрещенными законом способами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>разрешение индивидуальных и
коллективных трудовых споров, включая право на забастовку, в порядке,
установленном Трудовым кодексом РФ, иными федеральными законами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>возмещение вреда, причиненного ему
в связи с исполнением трудовых обязанностей, и компенсацию морального вреда в
порядке, установленном Трудовым кодексом РФ, иными федеральными законами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>обязательное социальное страхование
в случаях, предусмотренных федеральными законами.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><b style='mso-bidi-font-weight:
normal'><span style='font-family:\"Times New Roman\",serif'>Работник обязан:<o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>добросовестно исполнять свои
трудовые обязанности, возложенные на него трудовым договором;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>соблюдать правила внутреннего
трудового распорядка;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>соблюдать трудовую дисциплину;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>выполнять установленные нормы
труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>соблюдать требования по охране
труда и обеспечению безопасности труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>бережно относиться к имуществу
работодателя (в том числе к имуществу третьих лиц, находящемуся у работодателя,
если работодатель несет ответственность за сохранность этого имущества) и
других работников;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:24.25pt'><span
style='font-family:\"Times New Roman\",serif'>незамедлительно сообщить
работодателю либо непосредственному руководителю о возникновении ситуации,
представляющей угрозу жизни и здоровью людей, сохранности имущества работодателя
(в том числе имущества <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:24.25pt'><span
style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<p class=a0><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
font-family:\"Times New Roman\",serif'>Основные права и обязанности работодателя.<o:p></o:p></span></b></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Работодатель
имеет право:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>заключать, изменять и расторгать
трудовые договоры с работниками в порядке и на условиях, которые установлены
Трудовым кодексом РФ, иными федеральными законами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>вести коллективные переговоры и
заключать коллективные договоры;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>поощрять работников за
добросовестный эффективный труд;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>требовать от работников исполнения
ими трудовых обязанностей и бережного отношения к имуществу работодателя (в том
числе к имуществу третьих лиц, находящемуся у работодателя, если работодатель
несет ответственность за сохранность этого имущества) и других работников,
соблюдения правил внутреннего трудового распорядка;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>привлекать работников к
дисциплинарной и материальной ответственности в порядке, установленном Трудовым
кодексом РФ, иными федеральными законами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'>принимать
локальные нормативные акты (за исключением работодателей - физических лиц, не являющихся
индивидуальными предпринимателями);<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>создавать объединения работодателей
в целях представительства и защиты своих интересов и вступать в них.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Работодатель обязан:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>соблюдать трудовое законодательство
и иные нормативные правовые акты, содержащие нормы трудового права, локальные
нормативные акты, условия коллективного договора, соглашений и трудовых
договоров;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>предоставлять работникам работу,
обусловленную трудовым договором;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>обеспечивать безопасность и условия
труда, соответствующие государственным нормативным требованиям охраны труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>обеспечивать работников
оборудованием, инструментами, технической документацией и иными средствами,
необходимыми для исполнения ими трудовых обязанностей;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'>обеспечивать
работникам равную оплату за труд равной ценности;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>выплачивать в полном размере
причитающуюся работникам заработную плату в сроки, установленные в соответствии
с Трудовым кодексом РФ, коллективным договором, правилами внутреннего трудового
распорядка, трудовыми договорами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>вести коллективные переговоры, а
также заключать коллективный договор в порядке, установленном Трудовым кодексом
РФ;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>предоставлять представителям
работников полную и достоверную информацию, необходимую для заключения
коллективного договора, соглашения и контроля за их выполнением;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>знакомить работников под роспись с
принимаемыми локальными нормативными актами, непосредственно связанными с их
трудовой деятельностью;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>своевременно выполнять предписания
федерального органа исполнительной власти, уполномоченного на проведение
государственного надзора и контроля за соблюдением трудового законодательства и
иных нормативных правовых актов, содержащих нормы трудового права, других
федеральных органов исполнительной власти, осуществляющих функции по контролю и
надзору в установленной сфере деятельности, уплачивать штрафы, наложенные за
нарушения трудового законодательства и иных нормативных правовых актов,
содержащих нормы трудового права;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>рассматривать представления
соответствующих профсоюзных органов, иных избранных работниками представителей
о выявленных нарушениях трудового законодательства и иных актов, содержащих
нормы трудового права, принимать меры по устранению выявленных нарушений и
сообщать о принятых мерах указанным органам и представителям;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>создавать условия, обеспечивающие
участие работников в управлении организацией в предусмотренных Трудовым
кодексом РФ, иными федеральными законами и коллективным договором формах;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>обеспечивать бытовые нужды
работников, связанные с исполнением ими трудовых обязанностей;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>осуществлять обязательное социальное
страхование работников в порядке, установленном федеральными законами;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>возмещать вред, причиненный
работникам в связи с исполнением ими трудовых обязанностей, а также
компенсировать моральный вред в порядке и на условиях, которые установлены
Трудовым кодексом РФ, другими федеральными законами и иными нормативными
правовыми актами Российской Федерации;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:24.25pt'><span
style='font-family:\"Times New Roman\",serif'>исполнять иные обязанности,
предусмотренные трудовым законодательством и иными нормативными правовыми
актами, содержащими нормы трудового права, коллективным договором,
соглашениями, локальными нормативными актами и трудовыми договорами.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
0cm'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
mso-bidi-font-size:10.0pt'><span style='mso-spacerun:yes'>           
</span>Трудовой договор.</span></b><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black;display:none;mso-hide:
all'>#G0</span><span style='font-family:\"Times New Roman\",serif;color:black'>Трудовой
договор - соглашение между работодателем и работником, в соответствии с которым
работодатель обязуется предоставить работнику работу по обусловленной трудовой
функции, обеспечить условия труда, предусмотренные трудовым законодательством и
иными нормативными правовыми актами, содержащими нормы трудового права,
коллективным договором, соглашениями, локальными нормативными актами и данным
соглашением, своевременно и в полном размере выплачивать работнику заработную
плату, а работник обязуется лично выполнять определенную этим соглашением
трудовую функцию, соблюдать правила внутреннего трудового распорядка,
действующие у данного работодателя<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Сторонами
трудового договора являются работодатель и работник</span><span
style='font-family:\"Times New Roman\",serif'> (ст.56 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:30.0pt'><span
style='font-family:\"Times New Roman\",serif;color:black'><span
style='mso-spacerun:yes'> </span><span style='display:none;mso-hide:all'>#G0</span>
Запрещается необоснованный отказ в заключение трудового договора. <span
style='display:none;mso-hide:all'>#M12293 0 901987635 25828 77 4294961338
23977398 24254 3277815455 788611968 2303522048</span> <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>Какое бы то ни было
прямое или косвенное ограничение прав или установление прямых или косвенных
преимуществ при заключении трудового договора в зависимости от пола, расы,
цвета кожи, национальности, языка, происхождения, имущественного, социального и
должностного положения, возраста, места жительства (в том числе наличия или
отсутствия регистрации по месту жительства или пребывания), а также других
обстоятельств, не связанных с деловыми качествами работников, не допускается,
за исключением случаев, предусмотренных федеральным законом. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>Запрещается отказывать
в заключение трудового договора женщинам по мотивам, связанным с беременностью
или наличием детей. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>Запрещается отказывать
в заключение трудового договора работникам, приглашенным в письменной форме на
работу в порядке перевода от другого работодателя, в течение одного месяца со
дня увольнения с прежнего места работы. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>По требованию лица,
которому отказано в заключении трудового договора, работодатель обязан сообщить
причину отказа в письменной форме.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>Отказ в заключении
трудового договора может быть обжалован в суд </span><span style='font-family:
\"Times New Roman\",serif'>(ст. 64 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>   </span><span
style='mso-tab-count:1'>         </span><span style='mso-spacerun:yes'> </span></span><span
style='font-family:\"Times New Roman\",serif;color:black;display:none;mso-hide:
all'>#G0</span><span style='font-family:\"Times New Roman\",serif;color:black'>Трудовые
договоры могут заключаться:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>1) на неопределенный
срок;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>2) на определенный срок
не более пяти лет (срочный трудовой договор), если иной срок не установлен
Трудовым кодексом РФ и иными федеральными законами.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>Срочный трудовой
договор заключается, когда трудовые отношения не могут быть установлены на
неопределенный срок с учетом характера предстоящей работы или условий ее выполнения,
а именно в случаях, предусмотренных <span style='display:none;mso-hide:all'>#M12293
0 901987635 0 0 0 0 0 0 0 3420396262</span>частью первой статьи 59<span
style='display:none;mso-hide:all'>#S</span> Трудового кодекса РФ. В случаях,
предусмотренных <span style='display:none;mso-hide:all'>#M12293 1 901987635
4294960712 528892270 3881244557 1704669911 1351449073 3618173640 769747360
1948749373</span>частью второй статьи 59<span style='display:none;mso-hide:
all'>#S</span> Трудового кодекса РФ, срочный трудовой договор может заключаться
по соглашению сторон трудового договора без учета характера предстоящей работы
и условий ее выполнения. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>Если в трудовом
договоре не оговорен срок его действия, то договор считается заключенным на
неопределенный срок. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>В случае, когда ни одна
из сторон не потребовала расторжения срочного трудового договора в связи с
истечением срока его действия и работник продолжает работу после истечения
срока действия трудового договора, условие о срочном характере трудового
договора утрачивает силу и трудовой договор считается заключенным на
неопределенный срок. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black'>Трудовой договор,
заключенный на определенный срок при отсутствии достаточных к тому оснований,
установленных судом, считается заключенным на неопределенный срок. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;color:black'>Запрещается заключение срочных трудовых
договоров в целях уклонения от предоставления прав и гарантий, предусмотренных
для работников, с которыми заключается трудовой договор на неопределенный срок </span><span
style='font-size:12.0pt'>(ст.58 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Прием на работу оформляется
приказом (распоряжением) работодателя, изданным на основании заключенного
трудового договора. Содержание приказа (распоряжения) работодателя должно
соответствовать условиям заключенного трудового договора.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Приказ (распоряжение) работодателя
о приеме на работу объявляется работнику под роспись в трехдневный срок со дня
фактического начала работы. По требованию работника работодатель обязан выдать
ему надлежаще заверенную копию указанного приказа (распоряжения).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>При приеме на работу (до подписания
трудового договора) работодатель обязан ознакомить работника под роспись с
правилами внутреннего трудового распорядка, иными локальными нормативными
актами, непосредственно связанными с трудовой деятельностью работника,
коллективным договором <span style='color:black;layout-grid-mode:line'>(ст. 68
Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>При заключении трудового договора в
нем по соглашению сторон может быть предусмотрено условие об испытании
работника в целях проверки его соответствия поручаемой работе.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Отсутствие в трудовом договоре
условия об испытании означает, что работник принят на работу без испытания. В
случае, когда работник фактически допущен к работе без оформления трудового
договора (часть вторая статьи 67 Трудового кодекса РФ), условие об испытании может
быть включено в трудовой договор, только если стороны оформили его в виде
отдельного соглашения до начала работы.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>В период испытания на работника
распространяются положения трудового законодательства и иных нормативных
правовых актов, содержащих нормы трудового права, коллективного договора,
соглашений, локальных нормативных актов.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><a name=\"sub_7004\"><span
style='font-family:\"Times New Roman\",serif'>Испытание при приеме на работу </span></a><span
class=GramE><span style='mso-bookmark:sub_7004'><span style='font-family:\"Times New Roman\",serif'>не
устанавливается</span></span></span><span style='mso-bookmark:sub_7004'><span
style='font-family:\"Times New Roman\",serif'> для:<o:p></o:p></span></span></p>

<span style='mso-bookmark:sub_7004'></span>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>лиц, избранных по конкурсу на
замещение соответствующей должности, проведенному в порядке, установленном
трудовым законодательством и иными нормативными правовыми актами, содержащими
нормы трудового права;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>беременных
женщин и женщин, имеющих детей в возрасте до полутора лет;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>лиц,
не достигших возраста восемнадцати лет;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>лиц, окончивших имеющие
государственную аккредитацию образовательные учреждения начального, среднего и
высшего профессионального образования и впервые поступающих на работу по
полученной специальности в течение одного года со дня окончания образовательного
учреждения;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>лиц,
избранных на выборную должность на оплачиваемую работу;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>лиц, приглашенных на работу в
порядке перевода от другого работодателя по согласованию между работодателями;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>лиц,
заключающих трудовой договор на срок до двух месяцев;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>иных лиц в случаях, предусмотренных
настоящим Кодексом, иными федеральными законами, коллективным договором.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Срок испытания не может превышать
трех месяцев, а для руководителей организаций и их заместителей, главных
бухгалтеров и их заместителей, руководителей филиалов, представительств или
иных обособленных структурных подразделений организаций - шести месяцев, если
иное не установлено федеральным законом.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>При
заключении трудового договора на срок от двух до шести месяцев испытание не
может превышать двух недель.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>В
срок испытания не засчитываются период временной нетрудоспособности работника и
другие периоды, когда он фактически отсутствовал на работе.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>При неудовлетворительном результате
испытания работодатель имеет право до истечения срока испытания расторгнуть
трудовой договор с работником, предупредив его об этом в письменной форме не
позднее, чем за три дня с указанием причин, послуживших основанием для
признания этого работника не выдержавшим испытание. Решение работодателя
работник имеет право обжаловать в суд.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>При неудовлетворительном результате
испытания расторжение трудового договора производится без учета мнения
соответствующего профсоюзного органа и без выплаты выходного пособия.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Если срок испытания истек, а
работник продолжает работу, то он считается выдержавшим испытание и последующее
расторжение трудового договора допускается только на общих основаниях.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Если в период испытания работник
придет к выводу, что предложенная ему работа не является для него подходящей,
то он имеет право расторгнуть трудовой договор по собственному желанию,
предупредив об этом работодателя в письменной форме за три <span class=GramE>дня<span
style='mso-spacerun:yes'>  </span><span style='color:black;layout-grid-mode:
line'>(</span></span><span style='color:black;layout-grid-mode:line'>ст. 71 Трудового
кодекса РФ).</span><span style='layout-grid-mode:line'><o:p></o:p></span></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Основаниями
прекращения трудового договора являются:<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>1)
соглашение сторон (статья 78 Трудового кодекса РФ);<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>2) истечение срока трудового
договора (статья 79 Трудового кодекса РФ), за исключением случаев, когда
трудовые отношения фактически продолжаются и ни одна из сторон не потребовала
их прекращения;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>3)
расторжение трудового договора по инициативе работника (статья 80 Трудового кодекса
РФ);<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>4) расторжение трудового договора
по инициативе работодателя (статьи 71 и 81 Трудового кодекса РФ);<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>5) перевод работника по его просьбе
или с его согласия на работу к другому работодателю или переход на выборную
работу (должность);<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>6)
отказ работника от продолжения работы в связи со сменой собственника имущества
организации, с изменением подведомственности (подчиненности) организации либо
ее реорганизацией (статья 75 Трудового кодекса РФ);<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>7) отказ работника от продолжения
работы в связи с изменением определенных сторонами условий трудового договора
(часть четвертая статьи 79 Трудового кодекса РФ);<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>8)
отказ работника от перевода на другую работу, необходимого ему в соответствии с
медицинским заключением, выданным в порядке, установленном федеральными законами
и иными нормативными правовыми актами Российской Федерации, либо отсутствие у
работодателя соответствующей работы (части третья и четвертая статьи 73 Трудового
кодекса РФ);<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>9)
отказ работника от перевода на работу в другую местность вместе с работодателем
(часть первая статьи 72.1 Трудового кодекса РФ);<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>10) обстоятельства, не зависящие от
воли сторон (статья 83 Трудового кодекса РФ);<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>11)
нарушение установленных настоящим Кодексом или иным федеральным законом правил
заключения трудового договора, если это нарушение исключает возможность продолжения
работы (статья 84 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Трудовой
договор может быть прекращен и по другим основаниям, предусмотренным настоящим
Кодексом и иными федеральными законами.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Трудовой
договор может быть в любое время расторгнут по соглашению сторон трудового
договора<span style='color:black;layout-grid-mode:line'> (ст. 78 Трудового
кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Срочный трудовой договор
прекращается с истечением срока его действия. О прекращении трудового договора
в связи с истечением срока его действия работник должен быть предупрежден в
письменной форме не менее чем за три календарных дня до увольнения, за исключением
случаев, когда истекает срок действия срочного трудового договора, заключенного
на время исполнения обязанностей отсутствующего работника.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Трудовой договор, заключенный на
время выполнения определенной работы, прекращается по завершении этой работы.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Трудовой договор, заключенный на
время исполнения обязанностей отсутствующего работника, прекращается с выходом
этого работника на работу.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Трудовой договор, заключенный для
выполнения сезонных работ в течение определенного периода (сезона),
прекращается по окончании этого периода (сезона) (ст.79 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Работник имеет право расторгнуть
трудовой договор, предупредив об этом работодателя в письменной форме не
позднее чем за две недели, если иной срок не установлен настоящим Кодексом или
иным федеральным законом. Течение указанного срока начинается на следующий день
после получения работодателем заявления работника об увольнении.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>По соглашению между работником и
работодателем трудовой договор может быть расторгнут и до истечения срока
предупреждения об увольнении.<o:p></o:p></span></p>

<p class=MsoBodyText2 style='text-indent:35.4pt'><span style='font-size:12.0pt;
font-family:\"Times New Roman\",serif'>В случаях, когда заявление работника об
увольнении по его инициативе (по собственному желанию) обусловлено
невозможностью продолжения им работы (зачисление в образовательное учреждение,
выход на пенсию и другие случаи), а также в случаях установленного нарушения
работодателем трудового законодательства и иных нормативных правовых актов,
содержащих нормы трудового права, локальных нормативных актов, условий
коллективного договора, соглашения или трудового договора работодатель обязан
расторгнуть трудовой договор в срок, указанный в заявлении работника (ст. 80
Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'>Рабочее время.<span style='mso-spacerun:yes'>   </span><o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>Нормальная продолжительность
рабочего времени не может превышать 40 часов в неделю (ст. 91 Трудового кодекса
РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Продолжительность
рабочего дня или смены, непосредственно предшествующих нерабочему праздничному
дню, уменьшается на один час.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>В
непрерывно действующих организациях и на отдельных видах работ, где невозможно
уменьшение продолжительности работы (смены) в предпраздничный день, переработка
компенсируется предоставлением работнику дополнительного времени отдыха или, с
согласия работника, оплатой по нормам, установленным для сверхурочной работы.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Накануне
выходных дней продолжительность работы при шестидневной рабочей неделе не может
превышать пяти часов (ст. 95 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'>Время отдыха.<o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black;layout-grid-mode:line'>В
течение рабочего дня (смены) <span class=GramE>работнику<span
style='mso-spacerun:yes'>  </span>должен</span><span style='mso-spacerun:yes'> 
</span>быть<span style='mso-spacerun:yes'>  </span>предоставлен перерыв для отдыха
и питания продолжительностью не более двух часов и<span
style='mso-spacerun:yes'>  </span>не менее 30 минут, который в рабочее время не
включается.</span><span style='font-family:\"Times New Roman\",serif;layout-grid-mode:
line'><o:p></o:p></span></p>

<p class=MsoBodyText2><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif'><span
style='mso-spacerun:yes'>    </span><span style='mso-spacerun:yes'> </span><span
style='mso-tab-count:1'>       </span>Время предоставления <span class=GramE>перерыва<span
style='mso-spacerun:yes'>  </span>и</span><span style='mso-spacerun:yes'> 
</span>его<span style='mso-spacerun:yes'>  </span>конкретная<span
style='mso-spacerun:yes'>  </span>продолжительность устанавливаются правилами
внутреннего<span style='mso-spacerun:yes'>  </span>трудового<span
style='mso-spacerun:yes'>  </span>распорядка<span style='mso-spacerun:yes'> 
</span>или по соглашению между работником и работодателем.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><span style='mso-spacerun:yes'>    </span><span
style='mso-tab-count:1'>        </span><span
style='mso-spacerun:yes'> </span>На работах, где <span class=GramE>по<span
style='mso-spacerun:yes'>  </span>условиям</span><span
style='mso-spacerun:yes'>  </span>производства<span style='mso-spacerun:yes'> 
</span>(работы)<span style='mso-spacerun:yes'>  </span>предоставление перерыва
для отдыха и питания невозможно, работодатель обязан<span
style='mso-spacerun:yes'>  </span>обеспечить работнику возможность отдыха и
приема<span style='mso-spacerun:yes'>  </span>пищи<span
style='mso-spacerun:yes'>  </span>в<span style='mso-spacerun:yes'> 
</span>рабочее<span style='mso-spacerun:yes'>  </span>время.<span
style='mso-spacerun:yes'>   </span>Перечень таких работ, а также <span
class=GramE>места<span style='mso-spacerun:yes'>  </span>для</span><span
style='mso-spacerun:yes'>  </span>отдыха<span style='mso-spacerun:yes'> 
</span>и<span style='mso-spacerun:yes'>  </span>приема<span
style='mso-spacerun:yes'>  </span>пищи<span style='mso-spacerun:yes'> 
</span>устанавливаются правилами внутреннего трудового распорядка организации
(ст. 108 Трудового кодекса РФ). </span><span style='font-family:\"Times New Roman\",serif'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif;color:black;layout-grid-mode:line'>Продолжительность
еженедельного непрерывного <span class=GramE>отдыха<span
style='mso-spacerun:yes'>  </span>не</span><span style='mso-spacerun:yes'> 
</span>может<span style='mso-spacerun:yes'>  </span>быть менее 42 часов (ст.
110 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoBodyText2 style='text-indent:35.4pt'><span style='font-size:12.0pt;
font-family:\"Times New Roman\",serif'>Всем<span style='mso-spacerun:yes'>  
</span>работникам<span style='mso-spacerun:yes'>   </span>предоставляются<span
style='mso-spacerun:yes'>   </span>выходные<span style='mso-spacerun:yes'>  
</span>дни<span class=GramE><span style='mso-spacerun:yes'>   </span>(</span>еженедельный
непрерывный <span style='mso-spacerun:yes'>  </span>отдых).<span
style='mso-spacerun:yes'>   </span>При<span style='mso-spacerun:yes'>  
</span>пятидневной<span style='mso-spacerun:yes'>   </span>рабочей<span
style='mso-spacerun:yes'>   </span>неделе<span style='mso-spacerun:yes'>  
</span>работникам предоставляются два <span class=GramE>выходных<span
style='mso-spacerun:yes'>  </span>дня</span><span style='mso-spacerun:yes'> 
</span>в<span style='mso-spacerun:yes'>  </span>неделю,<span
style='mso-spacerun:yes'>  </span>при<span style='mso-spacerun:yes'> 
</span>шестидневной<span style='mso-spacerun:yes'>  </span>рабочей неделе -
один выходной день.<b><o:p></o:p></b></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>    </span><span
style='mso-tab-count:1'>        </span>Общим выходным днем является
воскресенье. Второй <span class=GramE>выходной<span style='mso-spacerun:yes'> 
</span>день</span><span style='mso-spacerun:yes'>  </span>при пятидневной рабочей
неделе<span style='mso-spacerun:yes'>  </span>устанавливается<span
style='mso-spacerun:yes'>  </span>коллективным<span style='mso-spacerun:yes'> 
</span>договором<span style='mso-spacerun:yes'>  </span>или правилами
внутреннего трудового распорядка организации. Оба <span class=GramE>выходных<span
style='mso-spacerun:yes'>  </span>дня</span> предоставляются, как правило,
подряд.</span><span style='font-family:\"Times New Roman\",serif;layout-grid-mode:
line'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:18.0pt'><span
style='font-family:\"Times New Roman\",serif;color:black;layout-grid-mode:line'><span
style='mso-spacerun:yes'>  </span><span style='mso-tab-count:1'>    </span>У <span
class=GramE>работодателей,<span style='mso-spacerun:yes'>  </span>приостановка</span><span
style='mso-spacerun:yes'>  </span>работы<span style='mso-spacerun:yes'> 
</span>в<span style='mso-spacerun:yes'>  </span>которых<span
style='mso-spacerun:yes'>  </span>в<span style='mso-spacerun:yes'> 
</span>выходные<span style='mso-spacerun:yes'>  </span>дни невозможна по<span
style='mso-spacerun:yes'>  </span>производственно-техническим<span
style='mso-spacerun:yes'>  </span>и<span style='mso-spacerun:yes'> 
</span>организационным<span style='mso-spacerun:yes'>  </span>условиям,
выходные дни предоставляются в различные<span style='mso-spacerun:yes'> 
</span>дни<span style='mso-spacerun:yes'>  </span>недели<span
style='mso-spacerun:yes'>  </span>поочередно<span style='mso-spacerun:yes'> 
</span>каждой группе работников<span style='mso-spacerun:yes'> 
</span>согласно<span style='mso-spacerun:yes'>  </span>правилам<span
style='mso-spacerun:yes'>  </span>внутреннего<span style='mso-spacerun:yes'> 
</span>трудового<span style='mso-spacerun:yes'>  </span>распорядка организации
(ст. 111 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Работа в выходные и нерабочие
праздничные дни запрещается, за исключением случаев, предусмотренных настоящим
Кодексом.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Привлечение работников к работе в
выходные и нерабочие праздничные дни производится с их письменного согласия в
случае необходимости выполнения заранее непредвиденных работ, от срочного
выполнения которых зависит в дальнейшем нормальная работа организации в целом
или ее отдельных структурных подразделений, индивидуального предпринимателя.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Привлечение работников к работе в
выходные и нерабочие праздничные дни без их согласия допускается в следующих
случаях:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>1) для предотвращения катастрофы,
производственной аварии либо устранения последствий катастрофы,
производственной аварии или стихийного бедствия;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>2) для предотвращения несчастных
случаев, уничтожения или порчи имущества работодателя, государственного или
муниципального имущества;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>3) для выполнения работ,
необходимость которых обусловлена введением чрезвычайного или военного
положения, а также неотложных работ в условиях чрезвычайных обстоятельств, то
есть в случае бедствия или угрозы бедствия (пожары, наводнения, голод, землетрясения,
эпидемии или эпизоотии) и в иных случаях, ставящих под угрозу жизнь или
нормальные жизненные условия всего населения или его части.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><a
name=\"sub_1133\"><span style='font-family:\"Times New Roman\",serif'>Привлечение к
работе в выходные и нерабочие праздничные дни творческих работников средств
массовой информации, организаций кинематографии, теле- и </span></a><span
class=SpellE><span style='mso-bookmark:sub_1133'><span style='font-family:\"Times New Roman\",serif'>видеосъемочных</span></span></span><span
style='mso-bookmark:sub_1133'><span style='font-family:\"Times New Roman\",serif'>
коллективов, театров, театральных и концертных организаций, цирков и иных лиц,
участвующих в создании и (или) исполнении (экспонировании) произведений,
профессиональных спортсменов в соответствии с перечнями работ, профессий,
должностей этих работников, утверждаемыми Правительством Российской Федерации с
учетом мнения Российской трехсторонней комиссии по регулированию социально-трудовых
отношений, допускается в порядке, устанавливаемом коллективным договором,
локальным нормативным актом, трудовым договором.<o:p></o:p></span></span></p>

<span style='mso-bookmark:sub_1133'></span>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>В других случаях привлечение к
работе в выходные и нерабочие праздничные дни допускается с письменного
согласия работника и с учетом мнения выборного органа первичной профсоюзной
организации.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>В нерабочие праздничные дни
допускается производство работ, приостановка которых невозможна по
производственно-техническим условиям (непрерывно действующие организации),
работ, вызываемых необходимостью обслуживания населения, а также неотложных ремонтных
и погрузочно-разгрузочных работ.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><a
name=\"sub_11301\"><span style='font-family:\"Times New Roman\",serif'>Привлечение
к работе в выходные и нерабочие праздничные дни инвалидов, женщин, имеющих
детей в возрасте до трех лет, допускается только при условии, если это не
запрещено им по состоянию здоровья в соответствии с медицинским заключением,
выданным в порядке, установленном федеральными законами и иными нормативными
правовыми актами Российской Федерации. При этом инвалиды, женщины, имеющие
детей в возрасте до трех лет, должны быть под роспись ознакомлены со своим
правом отказаться от работы в выходной или нерабочий праздничный день.<o:p></o:p></span></a></p>

<span style='mso-bookmark:sub_11301'></span>

<p class=MsoBodyText2 style='text-indent:35.4pt'><span style='font-size:12.0pt;
font-family:\"Times New Roman\",serif'>Привлечение работников к работе в выходные
и нерабочие праздничные дни производится по письменному распоряжению
работодателя (ст. 113 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Нерабочими
праздничными днями в Российской Федерации являются:<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>1,
2, 3, 4 и 5 января - Новогодние каникулы;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>7
января - Рождество Христово;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>23
февраля - День защитника Отечества;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>8
марта - Международный женский день;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>1
мая - Праздник Весны и Труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>9
мая - День Победы;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>12
июня - День России;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>4
ноября - День народного единства.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>При совпадении выходного и
нерабочего праздничного дней выходной день переносится на следующий <span
class=GramE>после праздничного рабочий день</span>.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Работникам, за исключением работников,
получающих оклад (должностной оклад), за нерабочие праздничные дни, в которые
они не привлекались к работе, выплачивается дополнительное вознаграждение.
Размер и порядок выплаты указанного вознаграждения определяются коллективным
договором, соглашениями, локальным нормативным актом, принимаемым с учетом
мнения выборного органа первичной профсоюзной организации, трудовым договором.
Суммы расходов на выплату дополнительного вознаграждения за нерабочие
праздничные дни относятся к расходам на оплату труда в полном размере.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Наличие в календарном месяце
нерабочих праздничных дней не является основанием для снижения заработной платы
работникам, получающим оклад (должностной оклад).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>В целях рационального использования
работниками выходных и нерабочих праздничных дней Правительство Российской
Федерации вправе переносить выходные дни на другие дни. При этом нормативный
правовой акт Правительства Российской Федерации о переносе выходных дней на
другие дни в очередном календарном году подлежит официальному опубликованию не
позднее чем за месяц до наступления соответствующего календарного года. Принятие
нормативных правовых актов о переносе выходных дней на другие дни в течение
календарного года допускается при условии официального опубликования указанных
актов не позднее чем за два месяца до календарной даты устанавливаемого
выходного дня <span style='color:black;layout-grid-mode:line'>(ст. 112
Трудового кодекса РФ).</span><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:48.0pt'><span
style='font-family:\"Times New Roman\",serif;color:black;layout-grid-mode:line'>Ежегодный
основной <span class=GramE>оплачиваемый<span style='mso-spacerun:yes'> 
</span>отпуск</span><span style='mso-spacerun:yes'> 
</span>предоставляется<span style='mso-spacerun:yes'>  </span>работникам
продолжительностью 28 календарных дней.</span><span style='font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'> </span><span
style='mso-tab-count:1'>           </span><span style='mso-spacerun:yes'>   
</span>Ежегодный основной оплачиваемый отпуск <span class=GramE>продолжительностью<span
style='mso-spacerun:yes'>  </span>более</span><span style='mso-spacerun:yes'> 
</span>28 календарных дней (удлиненный основной отпуск) предоставляется<span
style='mso-spacerun:yes'>  </span>работникам<span style='mso-spacerun:yes'> 
</span>в соответствии с Трудовым Кодексом РФ и иными федеральными законами (ст.
115 Трудового кодекса).<o:p></o:p></span></p>

<h4 style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><span style='mso-spacerun:yes'>  </span><span
style='mso-tab-count:1'>          </span><span
style='mso-spacerun:yes'>  </span></span><span class=GramE><span
style='font-family:\"Times New Roman\",serif;layout-grid-mode:line;font-weight:
normal'>Ежегодные<span style='mso-spacerun:yes'>  </span>дополнительные</span></span><span
style='font-family:\"Times New Roman\",serif;layout-grid-mode:line;font-weight:
normal'><span style='mso-spacerun:yes'>   </span>оплачиваемые <span
style='mso-spacerun:yes'>  </span>отпуска<span style='mso-spacerun:yes'>  
</span>предоставляются работникам, занятым на работах с<span
style='mso-spacerun:yes'>  </span>вредными<span style='mso-spacerun:yes'> 
</span>и<span style='mso-spacerun:yes'>  </span>(или)<span
style='mso-spacerun:yes'>  </span>опасными<span style='mso-spacerun:yes'> 
</span>условиями труда,<span style='mso-spacerun:yes'>  </span>работникам,<span
style='mso-spacerun:yes'>  </span>имеющим<span style='mso-spacerun:yes'> 
</span>особый<span style='mso-spacerun:yes'>  </span>характер<span
style='mso-spacerun:yes'>   </span>работы,<span style='mso-spacerun:yes'>  
</span>работникам<span style='mso-spacerun:yes'>   </span>с ненормированным
рабочим днем, работникам, работающим в<span style='mso-spacerun:yes'> 
</span>районах<span style='mso-spacerun:yes'>  </span>Крайнего Севера и
приравненных<span style='mso-spacerun:yes'>  </span>к<span
style='mso-spacerun:yes'>  </span>ним<span style='mso-spacerun:yes'> 
</span>местностях,<span style='mso-spacerun:yes'>  </span>а<span
style='mso-spacerun:yes'>  </span>также<span style='mso-spacerun:yes'> 
</span>в<span style='mso-spacerun:yes'>  </span>других<span
style='mso-spacerun:yes'>  </span>случаях, предусмотренных </span><span
style='font-family:\"Times New Roman\",serif;font-weight:normal;mso-bidi-font-weight:
bold'>Трудовым кодексом</span><span style='font-family:\"Times New Roman\",serif'>
</span><span style='font-family:\"Times New Roman\",serif;layout-grid-mode:line;
font-weight:normal'>РФ и иными федеральными законами.<o:p></o:p></span></h4>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>   </span><span
style='mso-tab-count:1'>         </span><span
style='mso-spacerun:yes'> </span>Работодатели<span style='mso-spacerun:yes'>  
</span>с<span style='mso-spacerun:yes'>   </span>учетом<span
style='mso-spacerun:yes'>   </span>своих<span style='mso-spacerun:yes'>  
</span>производственных<span style='mso-spacerun:yes'>   </span>и<span
style='mso-spacerun:yes'>   </span>финансовых </span><span style='font-family:
\"Times New Roman\",serif;layout-grid-mode:line'>возможностей могут <span
class=GramE>самостоятельно<span style='mso-spacerun:yes'>  </span>устанавливать</span><span
style='mso-spacerun:yes'>  </span>дополнительные<span
style='mso-spacerun:yes'>  </span>отпуска для работников, если иное не предусмотрено
Трудовым Кодексом РФ и иными федеральными законами. Порядок <span class=GramE>и<span
style='mso-spacerun:yes'>  </span>условия</span><span
style='mso-spacerun:yes'>  </span>предоставления<span
style='mso-spacerun:yes'>  </span>этих<span style='mso-spacerun:yes'> 
</span>отпусков<span style='mso-spacerun:yes'>   </span>определяются<span
style='mso-spacerun:yes'>   </span>коллективными договорами или локальными
нормативными актами, которые принимаются с учетом мнения выборного органа
первичной профсоюзной организации (ст. 116 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'><span
style='mso-spacerun:yes'>   </span><span style='mso-tab-count:1'>         </span><span
style='mso-spacerun:yes'>  </span><span style='color:black;layout-grid-mode:
line'>Оплачиваемый отпуск должен предоставляться работнику ежегодно. Право на
использование отпуска за первый год работы <span class=GramE>возникает<span
style='mso-spacerun:yes'>  </span>у</span><span style='mso-spacerun:yes'> 
</span>работника<span style='mso-spacerun:yes'>  </span>по истечении шести
месяцев его непрерывной работы у<span style='mso-spacerun:yes'>  </span>данного
работодателя.<span style='mso-spacerun:yes'>  </span>По соглашению сторон
оплачиваемый отпуск работнику может быть предоставлен и до истечения шести месяцев.</span><span
style='layout-grid-mode:line'><o:p></o:p></span></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>  </span><span
style='mso-tab-count:1'>          </span><span
style='mso-spacerun:yes'>   </span>До истечения шести месяцев непрерывной
работы оплачиваемый отпуск по заявлению работника должен быть предоставлен:</span><span
style='font-family:\"Times New Roman\",serif;layout-grid-mode:line'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>  </span><span
style='mso-tab-count:1'>          </span><span class=GramE>женщинам<span
style='mso-spacerun:yes'>  </span>-</span><span style='mso-spacerun:yes'>  
</span>перед<span style='mso-spacerun:yes'>   </span>отпуском<span
style='mso-spacerun:yes'>   </span>по<span style='mso-spacerun:yes'>  
</span>беременности<span style='mso-spacerun:yes'>   </span>и<span
style='mso-spacerun:yes'>   </span>родам<span style='mso-spacerun:yes'>  
</span>или непосредственно после него;</span><span style='font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>     </span><span
style='mso-tab-count:1'>       </span>работникам в возрасте до восемнадцати
лет;</span><span style='font-family:\"Times New Roman\",serif;layout-grid-mode:
line'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>  </span><span
style='mso-tab-count:1'>          </span>работникам, усыновившим ребенка
(детей) в возрасте до трех месяцев;</span><span style='font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><o:p></o:p></span></p>

<p class=MsoBodyText2><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif'><span
style='mso-spacerun:yes'>    </span><span style='mso-tab-count:1'>        </span><span
style='mso-spacerun:yes'> </span>в других случаях, предусмотренных федеральными
законами.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>    </span><span
style='mso-tab-count:1'>        </span>Отпуск за второй и последующие годы
работы <span class=GramE>может<span style='mso-spacerun:yes'> 
</span>предоставляться</span><span style='mso-spacerun:yes'>  </span>в любое
время рабочего года в соответствии<span style='mso-spacerun:yes'> 
</span>с<span style='mso-spacerun:yes'>  </span>очередностью<span
style='mso-spacerun:yes'>  </span>предоставления ежегодных оплачиваемых отпусков,
установленной у данного работодателя (ст. 122 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'>Охрана труда.<o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Обязанности по обеспечению
безопасных условий и охраны труда возлагаются на работодателя.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Работодатель обязан обеспечить:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>безопасность работников при
эксплуатации зданий, сооружений, оборудования, осуществлении технологических
процессов, а также применяемых в производстве инструментов, сырья и материалов;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>применение сертифицированных
средств индивидуальной и коллективной защиты работников;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>соответствующие требованиям охраны
труда условия труда на каждом рабочем месте;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>режим труда и отдыха работников в
соответствии с трудовым законодательством и иными нормативными правовыми
актами, содержащими нормы трудового права;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>приобретение и выдачу за счет
собственных средств сертифицированных специальной одежды, специальной обуви и
других средств индивидуальной защиты, смывающих и обезвреживающих средств в
соответствии с установленными нормами работникам, занятым на работах с вредными
и (или) опасными условиями труда, а также на работах, выполняемых в особых температурных
условиях или связанных с загрязнением;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>обучение безопасным методам и <span
class=GramE>приемам выполнения работ</span> и оказанию первой помощи
пострадавшим на производстве, проведение инструктажа по охране труда,
стажировки на рабочем месте и проверки знания требований охраны труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>недопущение к работе лиц, не
прошедших в установленном порядке обучение и инструктаж по охране труда,
стажировку и проверку знаний требований охраны труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'>организацию
контроля за состоянием условий труда на рабочих местах, а также за правильностью
применения работниками средств индивидуальной и коллективной защиты;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'>проведение
аттестации рабочих мест по условиям труда с последующей сертификацией организации
работ по охране труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>в случаях, предусмотренных трудовым
законодательством и иными нормативными правовыми актами, содержащими нормы
трудового права, организовывать проведение за счет собственных средств
обязательных предварительных (при поступлении на работу) и периодических (в
течение трудовой деятельности) медицинских осмотров (обследований),
обязательных психиатрических освидетельствований работников, внеочередных
медицинских осмотров (обследований), обязательных психиатрических
освидетельствований работников по их просьбам в соответствии с медицинскими
рекомендациями с сохранением за ними места работы (должности) и среднего
заработка на время прохождения указанных медицинских осмотров (обследований),
обязательных психиатрических освидетельствований;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>недопущение работников к исполнению
ими трудовых обязанностей без прохождения обязательных медицинских осмотров
(обследований), обязательных психиатрических освидетельствований, а также в
случае медицинских противопоказаний;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>информирование работников об
условиях и охране труда на рабочих местах, о риске повреждения здоровья и <span
class=GramE>полагающихся им компенсациях</span> и средствах индивидуальной защиты;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>предоставление федеральным органам
исполнительной власти, осуществляющим функции по выработке государственной
политики и нормативно-правовому регулированию в сфере труда, федеральным
органам исполнительной власти, уполномоченным на проведение государственного
надзора и контроля за соблюдением трудового законодательства и иных нормативных
правовых актов, содержащих нормы трудового права, другим федеральным органам исполнительной
власти, осуществляющим функции по контролю и надзору в установленной сфере
деятельности, органам исполнительной власти субъектов Российской Федерации в
области охраны труда, органам профсоюзного контроля за соблюдением трудового
законодательства и иных актов, содержащих нормы трудового права, информации и
документов, необходимых для осуществления ими своих полномочий;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>принятие мер по предотвращению
аварийных ситуаций, сохранению жизни и здоровья работников при возникновении таких
ситуаций, в том числе по оказанию пострадавшим первой помощи;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>расследование и учет в
установленном Трудовым кодексом РФ, другими федеральными законами и иными
нормативными правовыми актами Российской Федерации порядке несчастных случаев
на производстве и профессиональных заболеваний;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>санитарно-бытовое и
лечебно-профилактическое обслуживание работников в соответствии с требованиями
охраны труда, а также доставку работников, заболевших на рабочем месте, в
медицинскую организацию в случае необходимости оказания им неотложной медицинской
помощи;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>беспрепятственный допуск
должностных лиц федеральных органов исполнительной власти, уполномоченных на
проведение государственного надзора и контроля, органов Фонда социального
страхования Российской Федерации, а также представителей органов общественного
контроля в целях проведения проверок условий и охраны труда и расследования
несчастных случаев на производстве и профессиональных заболеваний;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'>выполнение
предписаний должностных лиц федеральных органов исполнительной власти,
уполномоченных на проведение государственного надзора и контроля, и
рассмотрение представлений органов общественного контроля в установленные
Трудовым Кодексом РФ, иными федеральными законами сроки;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>обязательное социальное страхование
работников от несчастных случаев на производстве и профессиональных
заболеваний;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>ознакомление работников с
требованиями охраны труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>разработку и утверждение правил и
инструкций по охране труда для работников с учетом мнения выборного органа
первичной профсоюзной организации или иного уполномоченного работниками органа
в порядке, установленном статьей 372 Трудового кодекса РФ для принятия локальных
нормативных актов;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>наличие комплекта нормативных
правовых актов, содержащих требования охраны труда в соответствии со спецификой
своей деятельности<span style='color:black;layout-grid-mode:line'> (ст. 212
Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Работник
обязан:<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>соблюдать
требования охраны труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>правильно
применять средства индивидуальной и коллективной защиты;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>проходить обучение безопасным
методам и <span class=GramE>приемам выполнения работ</span> и оказанию первой
помощи пострадавшим на производстве, инструктаж по охране труда, стажировку на
рабочем месте, проверку знаний требований охраны труда;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>немедленно извещать своего
непосредственного или вышестоящего руководителя о любой ситуации, угрожающей
жизни и здоровью людей, о каждом несчастном случае, происшедшем на
производстве, или об ухудшении состояния своего здоровья, в том числе о
проявлении признаков острого профессионального заболевания (отравления);<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>проходить обязательные
предварительные (при поступлении на работу) и периодические (в течение трудовой
деятельности) медицинские осмотры (обследования), а также проходить внеочередные
медицинские осмотры (обследования) по направлению работодателя в случаях,
предусмотренных настоящим Кодексом и иными федеральными законами<span
style='color:black;layout-grid-mode:line'> (ст. 214 Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif;
color:black;layout-grid-mode:line'><span style='mso-spacerun:yes'>    </span><span
style='mso-tab-count:1'>        </span><span style='mso-spacerun:yes'> </span></span><a
name=\"sub_2156\"><span style='font-family:\"Times New Roman\",serif'>Машины,
механизмы и другое производственное оборудование, транспортные средства,
технологические процессы, материалы и химические вещества, средства
индивидуальной и коллективной защиты работников, в том числе иностранного
производства, должны соответствовать государственным нормативным требованиям
охраны труда и иметь декларацию о соответствии и (или) сертификат соответствия.<o:p></o:p></span></a></p>

<span style='mso-bookmark:sub_2156'></span>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Проекты строительства и
реконструкции производственных объектов, машин, механизмов и другого
производственного оборудования, технологических процессов должны соответствовать
государственным нормативным требованиям охраны труда.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Запрещаются строительство,
реконструкция, техническое переоснащение производственных объектов,
производство и внедрение новой техники, внедрение новых технологий без
заключений государственной экспертизы условий труда о соответствии указанных в
части второй настоящей статьи проектов государственным нормативным требованиям
охраны труда.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Новые или реконструируемые производственные
объекты не могут быть приняты в эксплуатацию без заключений соответствующих
федеральных органов исполнительной власти, осуществляющих функции по контролю и
надзору в установленной сфере деятельности.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Запрещаются применение в
производстве вредных или опасных веществ, материалов, продукции, товаров и
оказание услуг, для которых не разработаны методики и средства метрологического
контроля и токсикологическая (санитарно-гигиеническая, медико-биологическая)
оценка которых не проводилась.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>В случае использования новых или не
применявшихся у работодателя ранее вредных или опасных веществ он обязан до
начала использования указанных веществ разработать и согласовать с
соответствующими федеральными органами исполнительной власти, осуществляющими
функции по контролю и надзору в установленной сфере деятельности, меры по
сохранению жизни и здоровья работников<span style='layout-grid-mode:line'> (ст.
215 Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Все работники, в том числе
руководители организаций, а также работодатели - индивидуальные
предприниматели, обязаны проходить обучение по охране труда и проверку знания
требований охраны труда в порядке, установленном Правительством Российской Федерации
с учетом мнения Российской трехсторонней комиссии по регулированию социально-трудовых
отношений.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Для всех поступающих на работу лиц,
а также для работников, переводимых на другую работу, работодатель или
уполномоченное им лицо обязаны проводить инструктаж по охране труда,
организовывать обучение безопасным методам и приемам выполнения работ и
оказания первой помощи пострадавшим.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Работодатель обеспечивает обучение
лиц, поступающих на работу с вредными и (или) опасными условиями труда,
безопасным методам и приемам выполнения работ со стажировкой на рабочем месте и
сдачей экзаменов и проведение их периодического обучения по охране труда и
проверку знаний требований охраны труда в период работы <span style='color:
black;layout-grid-mode:line'><span style='mso-spacerun:yes'> </span><span
class=GramE><span style='mso-spacerun:yes'>   </span>(</span>ст. 225 Трудового
кодекса РФ).</span><span style='layout-grid-mode:line'><o:p></o:p></span></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'>Охрана труда женщин.</span></b><span style='font-size:12.0pt;
mso-bidi-font-size:10.0pt'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Ограничивается применение труда
женщин на тяжелых работах и работах с вредными и (или) опасными условиями
труда, а также на подземных работах, за исключением нефизических работ или
работ по санитарному и бытовому обслуживанию.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Запрещается применение труда женщин
на работах, связанных с подъемом и перемещением вручную тяжестей, превышающих
предельно допустимые для них нормы.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Перечни производств, работ и
должностей с вредными и (или) опасными условиями труда, на которых
ограничивается применение труда женщин, и предельно допустимые нормы нагрузок
для женщин при подъеме и перемещении тяжестей вручную утверждаются в порядке,
установленном Правительством Российской Федерации с учетом мнения Российской
трехсторонней комиссии по регулированию социально-трудовых <span class=GramE>отношений
<span style='color:black;layout-grid-mode:line'><span
style='mso-spacerun:yes'> </span>(</span></span><span style='color:black;
layout-grid-mode:line'>ст. 253 Трудового кодекса РФ). <o:p></o:p></span></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
35.45pt;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>Постановлением
Совета Министров - Правительства Российской Федерации от 6.02.1993 г. №105, утверждены
нормы предельно допустимых нагрузок для женщин при подъеме и перемещении
тяжестей вручную.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><span
style='mso-tab-count:1'>            </span>Нормы предельно допустимых нагрузок
для женщин при подъеме и <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>перемещении
тяжестей вручную:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
 style='margin-left:5.4pt;border-collapse:collapse;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=302 valign=top style='width:8.0cm;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>Характер работы<o:p></o:p></span></p>
  </td>
  <td width=106 valign=top style='width:79.2pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .75pt;mso-border-alt:
  solid windowtext .75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>Предельно допустимая масса груза<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=302 valign=top style='width:8.0cm;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .75pt;mso-border-alt:
  solid windowtext .75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>Подъем и перемещение тяжестей при чередовании с другой работой (до 2
  раза в час)<o:p></o:p></span></p>
  </td>
  <td width=106 valign=top style='width:79.2pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .75pt;mso-border-left-alt:solid windowtext .75pt;
  mso-border-alt:solid windowtext .75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>10 кг<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=302 valign=top style='width:8.0cm;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:none;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .75pt;mso-border-top-alt:solid windowtext .75pt;mso-border-left-alt:
  solid windowtext .75pt;mso-border-right-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>Подъем и перемещение тяжестей постоянно в течение рабочей смены<o:p></o:p></span></p>
  </td>
  <td width=106 valign=top style='width:79.2pt;border:none;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .75pt;mso-border-left-alt:solid windowtext .75pt;
  mso-border-top-alt:solid windowtext .75pt;mso-border-left-alt:solid windowtext .75pt;
  mso-border-right-alt:solid windowtext .75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'><o:p>&nbsp;</o:p></span></p>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>7 кг<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=302 valign=top style='width:8.0cm;border:solid windowtext 1.0pt;
  border-bottom:none;mso-border-top-alt:solid windowtext .75pt;mso-border-left-alt:
  solid windowtext .75pt;mso-border-right-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>Величина динамической работы, совершаемой в течение каждого часа
  рабочей смены, не должна превышать:<o:p></o:p></span></p>
  </td>
  <td width=106 valign=top style='width:79.2pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=302 valign=top style='width:8.0cm;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:none;border-right:solid windowtext 1.0pt;mso-border-left-alt:
  solid windowtext .75pt;mso-border-right-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>с рабочей поверхности<o:p></o:p></span></p>
  </td>
  <td width=106 valign=top style='width:79.2pt;border:none;border-right:solid windowtext 1.0pt;
  mso-border-right-alt:solid windowtext .75pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>1750 <span class=SpellE>кгм</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;mso-yfti-lastrow:yes'>
  <td width=302 valign=top style='width:8.0cm;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .75pt;mso-border-bottom-alt:
  solid windowtext .75pt;mso-border-right-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>с пола<o:p></o:p></span></p>
  </td>
  <td width=106 valign=top style='width:79.2pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .75pt;mso-border-right-alt:solid windowtext .75pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-indent:0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:
  10.0pt'>875 <span class=SpellE>кгм</span><o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><span
style='mso-tab-count:1'>            </span><i style='mso-bidi-font-style:normal'>Примечания:
</i>1. В массу поднимаемого и перемещаемого груза включается масса тары и
упаковки.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><span
style='mso-tab-count:1'>            </span>2. при перемещении грузов на
тележках или контейнерах прилагаемое усилие не должно превышать 10 кг.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
0cm;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
35.45pt;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>Учитывая
физические особенности женщин, интересы охраны материнства и детства, роль <span
class=GramE>женщин<span style='mso-spacerun:yes'>  </span>в</span> семье
Трудовой кодекс РФ устанавливает специальные нормы по охране труда.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Запрещаются направление в служебные
командировки, привлечение к сверхурочной работе, работе в ночное время,
выходные и нерабочие праздничные дни беременных женщин.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Направление в служебные
командировки, привлечение к сверхурочной работе, работе в ночное время,
выходные и нерабочие праздничные дни женщин, имеющих детей в возрасте до трех
лет, допускаются только с их письменного согласия и при условии, что это не
запрещено им в соответствии с медицинским заключением, выданным в порядке,
установленном федеральными законами и иными нормативными правовыми актами Российской
Федерации. При этом женщины, имеющие детей в возрасте до трех лет, должны быть
ознакомлены в письменной форме со своим правом отказаться от направления в
служебную командировку, привлечения к сверхурочной работе, работе в ночное
время, выходные и нерабочие праздничные дни.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Гарантии, предусмотренные частью
второй настоящей статьи, предоставляются также матерям и отцам, воспитывающим
без супруга (супруги) детей в возрасте до пяти лет, работникам, имеющим
детей-инвалидов, и работникам, осуществляющим уход за больными членами их семей
в соответствии с медицинским заключением.<span style='mso-spacerun:yes'> 
</span>(ст.96, 99, 259 Трудового кодекса РФ).<span style='mso-no-proof:yes'><o:p></o:p></span></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Женщинам по их заявлению и на
основании выданного в установленном порядке листка нетрудоспособности
предоставляются отпуска по беременности и родам продолжительностью 70 (в случае
многоплодной беременности - 84) календарных дней до родов и 70 (в случае
осложненных родов - 86, при рождении двух или более детей - 110) календарных
дней после родов с выплатой пособия по государственному социальному страхованию
в установленном федеральными законами размере.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Отпуск
по беременности и родам исчисляется суммарно и предоставляется женщине
полностью независимо от числа дней, фактически использованных ею до <span
class=GramE>родов.<span style='layout-grid-mode:line'>(</span></span><span
style='layout-grid-mode:line'>ст. 255 Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
35.45pt;tab-stops:0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>Особое
внимание трудовое законодательство уделяет охране труда беременных женщин,
матерей, кормящих грудью и женщин, имеющих детей в возрасте до 3 лет.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>По заявлению женщины ей
предоставляется отпуск по уходу за ребенком до достижения им возраста трех лет.
Порядок и сроки выплаты пособия по государственному социальному страхованию в
период указанного отпуска определяются федеральными законами.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Отпуска по уходу за ребенком могут
быть использованы полностью или по частям также отцом ребенка, бабушкой, дедом,
другим родственником или опекуном, фактически осуществляющим уход за ребенком.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>По заявлению женщины или лиц,
указанных в части второй настоящей статьи, во время нахождения в отпусках по
уходу за ребенком они могут работать на условиях неполного рабочего времени или
на дому с сохранением права на получение пособия по государственному социальному
страхованию.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>На период отпуска по уходу за
ребенком за работником сохраняется место работы (должность).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><a
name=\"sub_2567\"><span style='font-family:\"Times New Roman\",serif'>Отпуска по
уходу за ребенком засчитываются в общий и непрерывный трудовой стаж, а также в
стаж работы по специальности (за исключением случаев досрочного назначения трудовой
пенсии по старости)</span></a><span style='font-family:\"Times New Roman\",serif'>
(ст.256 Трудового кодекса РФ). <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>Запрещается отказывать
женщинам в приеме на работу<span
style='mso-spacerun:yes'>                                                                                                     
</span><span
style='mso-spacerun:yes'>                                                                                      </span>по
мотивам, связанным с беременностью или наличием детей. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Расторжение трудового договора по
инициативе работодателя с беременными женщинами не допускается, за исключением
случаев ликвидации организации либо прекращения деятельности индивидуальным
предпринимателем.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>В случае истечения срочного
трудового договора в период беременности женщины работодатель обязан по ее
письменному заявлению и при предоставлении медицинской справки, подтверждающей
состояние беременности, продлить срок действия трудового договора до окончания
беременности. Женщина, срок действия трудового договора с которой был продлен
до окончания беременности, обязана по запросу работодателя, но не чаще чем один
раз в три месяца, предоставлять медицинскую справку, подтверждающую состояние
беременности. Если при этом женщина фактически продолжает работать после
окончания беременности, то работодатель имеет право расторгнуть трудовой
договор с ней в связи с истечением срока его действия в течение недели со дня,
когда работодатель узнал или должен был узнать о факте окончания беременности.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Допускается увольнение женщины в
связи с истечением срока трудового договора в период ее беременности, если
трудовой договор был заключен на время исполнения обязанностей отсутствующего
работника и невозможно с письменного согласия женщины перевести ее до окончания
беременности на другую имеющуюся у работодателя работу (как вакантную должность
или работу, соответствующую квалификации женщины, так и вакантную нижестоящую
должность или нижеоплачиваемую работу), которую женщина может выполнять с
учетом ее состояния здоровья. При этом работодатель обязан предлагать ей все
отвечающие указанным требованиям вакансии, имеющиеся у него в данной местности.
Предлагать вакансии в других местностях работодатель обязан, если это
предусмотрено коллективным договором, соглашениями, трудовым договором.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Расторжение трудового договора с
женщинами, имеющими детей в возрасте до трех лет, одинокими матерями,
воспитывающими ребенка в возрасте до четырнадцати лет (ребенка-инвалида до
восемнадцати лет), другими лицами, воспитывающими указанных детей без матери,
по инициативе работодателя не допускается (за исключением увольнения по
основаниям, предусмотренным пунктами 1, 5-8, 10 или 11 части первой статьи 81 <span
class=GramE>или<span style='mso-spacerun:yes'>  </span>пунктом</span> 2 статьи
336 Трудового кодекса РФ) (ст. 64, 261 Трудового кодекса РФ). <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'>Правила внутреннего трудового распорядка.<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:12.0pt'>Трудовой <span class=GramE>распорядок<span
style='mso-spacerun:yes'>  </span>на</span> предприятиях, учреждениях,
организациях определяется правилами внутреннего трудового распорядка. Правила
внутреннего трудового распорядка утверждаются работодателем с учетом мнения
представительного органа работников в порядке, установленном статьей 372
Трудового кодекса РФ для принятия локальных нормативных актов. Правила
внутреннего трудового распорядка, как правило, являются приложением к коллективному
договору (ст. 189, 190 Трудового кодекса РФ).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Работодатель поощряет работников,
добросовестно исполняющих трудовые обязанности (объявляет благодарность, выдает
премию, награждает ценным подарком, почетной грамотой, представляет к званию
лучшего по профессии).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Другие виды поощрений работников за
труд определяются коллективным договором или правилами внутреннего трудового
распорядка, а также уставами и положениями о дисциплине. За особые трудовые
заслуги перед обществом и государством работники могут быть представлены к
государственным наградам<span style='color:black;layout-grid-mode:line'> (ст.
191 Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>За
совершение дисциплинарного проступка, то есть неисполнение или ненадлежащее
исполнение работником по его вине возложенных на него трудовых обязанностей,
работодатель имеет право применить следующие дисциплинарные взыскания:<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>1)
замечание;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>2)
выговор;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>3)
увольнение по соответствующим основаниям.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Федеральными
законами, уставами <span class=GramE>и<span style='mso-spacerun:yes'> 
</span>положениями</span> о дисциплине (часть пятая статьи 189 Трудового
Кодекса РФ) для отдельных категорий работников могут быть предусмотрены также и
другие дисциплинарные взыскания.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>К дисциплинарным взысканиям, в
частности, относится увольнение работника по основаниям, предусмотренным
пунктами 5, 6, 9 или 10 части первой статьи 81 или пунктом 1 статьи 336
Трудового кодекса РФ, а также пунктом 7 или 8 части первой статьи 81 Трудового
кодекса РФ в случаях, когда виновные действия, дающие основания для утраты
доверия, либо соответственно аморальный проступок совершены работником по месту
работы и в связи с исполнением им трудовых обязанностей.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Не допускается применение
дисциплинарных взысканий, не предусмотренных федеральными законами, уставами и
положениями о дисциплине.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>При наложении дисциплинарного
взыскания должны учитываться тяжесть совершенного проступка и обстоятельства,
при которых он был совершен<span style='color:black;layout-grid-mode:line'>
(ст. 192 Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>До применения дисциплинарного
взыскания работодатель должен затребовать от работника письменное объяснение.
Если по истечении двух рабочих дней указанное объяснение работником не
предоставлено, то составляется соответствующий акт.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Непредставление работником
объяснения не является препятствием для применения дисциплинарного взыскания.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Дисциплинарное взыскание
применяется не позднее одного месяца со дня обнаружения проступка, не считая
времени болезни работника, пребывания его в отпуске, а также времени, необходимого
на учет мнения представительного органа работников.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Дисциплинарное взыскание не может быть
применено позднее шести месяцев со дня совершения проступка, а по результатам
ревизии, проверки финансово-хозяйственной деятельности или аудиторской проверки
- позднее двух лет со дня его совершения. В указанные сроки не включается время
производства по уголовному делу.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>За каждый дисциплинарный проступок
может быть применено только одно дисциплинарное взыскание.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Приказ (распоряжение) работодателя
о применении дисциплинарного взыскания объявляется работнику под роспись в
течение трех рабочих дней со дня его издания, не считая времени отсутствия
работника на работе. Если работник отказывается ознакомиться с указанным
приказом (распоряжением) под роспись, то составляется соответствующий акт.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.4pt'><span
style='font-family:\"Times New Roman\",serif'>Дисциплинарное взыскание может быть
обжаловано работником в государственную инспекцию труда и (или) органы по
рассмотрению индивидуальных трудовых споров<span style='color:black;layout-grid-mode:
line'> (ст. 193 Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Если
в течение года со дня применения дисциплинарного взыскания работник не будет
подвергнут новому дисциплинарному взысканию, то он считается не имеющим
дисциплинарного взыскания.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:35.4pt'><span style='font-family:\"Times New Roman\",serif'>Работодатель
до истечения года со дня применения дисциплинарного взыскания имеет право снять
его с работника по собственной инициативе, просьбе самого работника, ходатайству
его непосредственного руководителя или представительного органа работников<span
style='color:black;layout-grid-mode:line'> (ст. 194 Трудового кодекса РФ).<o:p></o:p></span></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:36.0pt;margin-bottom:.0001pt;text-indent:0cm'><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'>Основные опасные и вредные производственные факторы.<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
35.45pt'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>На человека в
процессе его трудовой деятельности могут воздействовать опасные (вызывающие
травмы) и вредные (вызывающие заболевания) производственные факторы. Опасные и
вредные производственные факторы (ГОСТ 12. 0. 003-74) подразделяются на четыре
группы: физические, химические, биологические и психофизиологические.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
mso-bidi-font-size:10.0pt'>К опасным физическим факторам относятся:</span></b><span
style='font-size:12.0pt;mso-bidi-font-size:10.0pt'> движущиеся машины и
механизмы; различные подъемно-транспортные устройства и перемещаемые грузы;
незащищенные подвижные элементы производственного оборудования (приводные и
передаточные механизмы, режущие инструменты, вращающиеся и перемещающиеся
приспособления и др.);<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>отлетающие частицы
обрабатываемого материала и инструмента, электрический ток, повышенная
температура поверхностей оборудования и обрабатываемых материалов и т.д.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
mso-bidi-font-size:10.0pt'>Вредными для здоровья физическими факторами
являются:</span></b><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>
повышенная или пониженная температура воздуха рабочей зоны; высокие влажность и
скорость движения воздуха; повышенные уровни шума, вибрации, ультразвука и
различных излучений - тепловых, ионизирующих, электромагнитных, инфракрасных и
др. К вредным физическим факторам относятся также запыленность и загазованность
воздуха рабочей зоны; недостаточная освещенность рабочих мест, проходов и
проездов; повышенная яркость света и пульсация светового потока.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
mso-bidi-font-size:10.0pt'>Химические опасные и вредные производственные
факторы по характеру действия на организм человека подразделяются на следующие
подгруппы:</span></b><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>
общетоксические, раздражающие, сенсибилизирующие (вызывающие аллергические
заболевания), канцерогенные (вызывающие развитие опухолей), <span class=SpellE>мутогенные</span>
(действующие на половые клетки организма). В эту группу входят многочисленные
пары и газы: пары бензола и толуола, окись углерода, сернистый ангидрид, окислы
азота, аэрозоли свинца и др., токсичные пыли, образующиеся, например, <span
class=GramE>при<span style='mso-spacerun:yes'>  </span>обработке</span>
резанием бериллия, свинцовистых бронз и латуней и некоторых пластмасс с
вредными наполнителями. К этой группе относятся агрессивные жидкости (кислоты,
щелочи), которые могут причинить химические ожоги кожного покрова при
соприкосновении с ними.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
mso-bidi-font-size:10.0pt'>К биологическим опасным и вредным производственным
факторам относятся</span></b><span style='font-size:12.0pt;mso-bidi-font-size:
10.0pt'> микроорганизмы (бактерии, вирусы и др.) и <span class=SpellE>макроорганизмы</span>
(растения и животные), воздействие которых на работающих вызывает травмы или заболевания.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm'><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
mso-bidi-font-size:10.0pt'>К психофизиологическим опасным и вредным
производственным факторам относятся</span></b><span style='font-size:12.0pt;
mso-bidi-font-size:10.0pt'> физические перегрузки (статические и динамические)
и нервно-психические перегрузки (умственное перенапряжение, перенапряжение
анализаторов слуха, зрения и др.).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm'><span style='font-size:12.0pt;mso-bidi-font-size:10.0pt'>Основными
опасными и вредными производственными факторами на рабочих местах могут явиться
недостаточная освещенность на рабочем месте и несоблюдение правил пользования ПЭВМ.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>При <span class=GramE>работе<span
style='mso-spacerun:yes'>  </span>на</span> ПЭВМ могут возникнуть следующие
опасные факторы:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>электрический ток, который может
протекать через тело человека в случае его прикосновения к открытым токоведущим
частям <span class=GramE>или<span style='mso-spacerun:yes'> 
</span>электрооборудованию</span> и электропроводам с нарушенной изоляцией;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>вращающиеся и движущиеся части
устройств;<b style='mso-bidi-font-weight:normal'><o:p></o:p></b></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>взрыв трубки кинескопа
видеомонитора;<b style='mso-bidi-font-weight:normal'><o:p></o:p></b></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>возгорание устройств.<b
style='mso-bidi-font-weight:normal'><o:p></o:p></b></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>Неблагоприятные факторы,
возникающие при эксплуатации ПЭВМ:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>1) <span class=SpellE>эргонометрические</span>;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>2) неионизирующие электромагнитные
излучения;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>Электромагнитное излучение
распространяется во всех направлениях и оказывает воздействие не только на
пользователей ПЭВМ, но и на окружающих.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>3) рентгеновское излучение;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>4) микроклимат производственных
помещений;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>5) температура воздуха (теплый
период года);<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>6) относительная влажность воздуха
в холодный и теплый период года; <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>7)<span style='mso-spacerun:yes'> 
</span>скорость <span class=GramE>движения<span style='mso-spacerun:yes'> 
</span>воздуха</span> (холодный период года).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>Естественное освещение должно
осуществляться через <span class=SpellE>светопроемы</span>, ориентированные на
север и северо-восток.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>При эксплуатации ПЭВМ должны быть <span
class=GramE>соблюдены<span style='mso-spacerun:yes'>  </span>следующие</span>
требования электробезопасности.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>При эксплуатации ПЭВМ должны быть
соблюдены следующие требования пожарной безопасности.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>В целях обеспечения нормальных <span
class=GramE>условий<span style='mso-spacerun:yes'>  </span>труда</span> должны
быть обеспечены следующие требования по организации рабочего места пользователя
ПЭВМ:<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>площадь на одно рабочее место
должна составлять не менее 6,0 кв. м, а объем - не менее 20 куб. м;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt'><span
style='font-family:\"Times New Roman\",serif'>расположение рабочих мест в
подвальных помещениях не допускается.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:1.0cm'><span
style='font-family:\"Times New Roman\",serif'>К непосредственной работе на ПЭВМ
допускаются лица, не имеющие медицинских противопоказаний.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:1.0cm'><span
style='font-family:\"Times New Roman\",serif'><span style='mso-spacerun:yes'> 
</span>Женщины со времени установления беременности и в период кормления
ребенка грудью к выполнению всех видов работ, связанных с использованием ПЭВМ,
не допускаются.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:1.0cm'><span
style='font-family:\"Times New Roman\",serif'>Трудоустройство беременных женщин
следует осуществлять в соответствии с &quot;Гигиеническими рекомендациями по
рациональному трудоустройству беременных женщин&quot; (утверждены <span
class=SpellE>Госсанэпидемнадзором</span> России от 21.12.93 г.).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'><span
style='mso-spacerun:yes'>                                                                                                                              
</span><span
style='mso-spacerun:yes'>                                                                           </span><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;line-height:150%;mso-pagination:
none'><span style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></p>

</div>

</body>

</html>

";

$folder_name = $_SERVER['DOCUMENT_ROOT'].'/temp_downloads/'.md5($result_file);
if(!is_dir($folder_name)){
    mkdir($folder_name);
}

file_put_contents($folder_name.'/induction_training.doc', $result_file, FILE_APPEND);

$doc_download_url = '/temp_downloads/'.md5($result_file).'/induction_training.doc';


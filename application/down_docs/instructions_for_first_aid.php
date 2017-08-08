<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.02.2017
 * Time: 10:01
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

$img1 = 'image002.png';
$img2 = 'image003.png';

$result_file = "
<html xmlns:v=\"urn:schemas-microsoft-com:vml\"
xmlns:o=\"urn:schemas-microsoft-com:office:office\"
xmlns:w=\"urn:schemas-microsoft-com:office:word\"
xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\"
xmlns:st1=\"urn:schemas-microsoft-com:office:smarttags\"
xmlns=\"http://www.w3.org/TR/REC-html40\">

<head>
<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">
<meta name=ProgId content=Word.Document>
<meta name=Generator content=\"Microsoft Word 15\">
<meta name=Originator content=\"Microsoft Word 15\">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]--><o:SmartTagType
 namespaceuri=\"urn:schemas-microsoft-com:office:smarttags\"
 name=\"metricconverter\"/>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Чиженкова</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>root</o:LastAuthor>
  <o:Revision>3</o:Revision>
  <o:TotalTime>1</o:TotalTime>
  <o:LastPrinted>2012-10-31T05:10:00Z</o:LastPrinted>
  <o:Created>2017-02-16T05:55:00Z</o:Created>
  <o:LastSaved>2017-02-16T05:55:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>9927</o:Words>
  <o:Characters>56586</o:Characters>
  <o:Lines>471</o:Lines>
  <o:Paragraphs>132</o:Paragraphs>
  <o:CharactersWithSpaces>66381</o:CharactersWithSpaces>
  <o:Version>16.00</o:Version>
 </o:DocumentProperties>
 <o:OfficeDocumentSettings>
  <o:RelyOnVML/>
  <o:AllowPNG/>
 </o:OfficeDocumentSettings>
</xml><![endif]-->

<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:DrawingGridHorizontalSpacing>5,5 пт</w:DrawingGridHorizontalSpacing>
  <w:DisplayHorizontalDrawingGridEvery>2</w:DisplayHorizontalDrawingGridEvery>
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
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:UseWord2010TableStyleRules/>
   <w:DontGrowAutofit/>
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
  <m:mathPr>
   <m:mathFont m:val=\"Cambria Math\"/>
   <m:brkBin m:val=\"before\"/>
   <m:brkBinSub m:val=\"&#45;-\"/>
   <m:smallFrac/>
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
  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 2\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 3\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 4\"/>
  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 5\"/>
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
  <w:LsdException Locked=\"false\" Priority=\"1\" SemiHidden=\"true\"
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
  <w:LsdException Locked=\"false\" Priority=\"0\" SemiHidden=\"true\"
   UnhideWhenUsed=\"true\" Name=\"Plain Text\"/>
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
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   Name=\"No List\"/>
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
</xml><![endif]--><!--[if !mso]><object
 classid=\"clsid:38481807-CA0E-42D2-BF39-B33AF135CC4D\" id=ieooui></object>
<style>
st1\:*{behavior:url(#ieooui) }
</style>
<![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;
	mso-font-charset:2;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:0 268435456 0 0 -2147483648 0;}
@font-face
	{font-family:\"Cambria Math\";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:204;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-536870145 1107305727 0 0 415 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:204;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-536859905 -1073732485 9 0 511 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:204;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520081665 -1073717157 41 0 66047 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:\"\";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-priority:99;
	mso-style-link:\"Верхний колонтитул Знак\";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:widow-orphan;
	tab-stops:center 233.85pt right 467.75pt;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-priority:99;
	mso-style-link:\"Нижний колонтитул Знак\";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:widow-orphan;
	tab-stops:center 233.85pt right 467.75pt;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-link:\"Основной текст Знак1\";
	margin-top:33.0pt;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:0cm;
	margin-bottom:.0001pt;
	text-indent:-17.0pt;
	line-height:12.95pt;
	mso-line-height-rule:exactly;
	mso-pagination:widow-orphan;
	background:white;
	font-size:10.5pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoBodyTextIndent, li.MsoBodyTextIndent, div.MsoBodyTextIndent
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:\"Основной текст с отступом Знак\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:14.15pt;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoBodyText2, li.MsoBodyText2, div.MsoBodyText2
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:\"Основной текст 2 Знак\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	text-align:center;
	line-height:200%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoBodyText3, li.MsoBodyText3, div.MsoBodyText3
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:\"Основной текст 3 Знак\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoBodyTextIndent2, li.MsoBodyTextIndent2, div.MsoBodyTextIndent2
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:\"Основной текст с отступом 2 Знак\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:14.15pt;
	text-align:center;
	line-height:200%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
a:link, span.MsoHyperlink
	{mso-style-priority:99;
	mso-style-parent:\"\";
	color:blue;
	text-decoration:underline;
	text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
	{mso-style-noshow:yes;
	mso-style-priority:99;
	color:#954F72;
	mso-themecolor:followedhyperlink;
	text-decoration:underline;
	text-underline:single;}
p.MsoPlainText, li.MsoPlainText, div.MsoPlainText
	{mso-style-unhide:no;
	mso-style-link:\"Текст Знак\";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:\"Courier New\";
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:\"Текст выноски Знак\";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:\"Tahoma\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
span.1
	{mso-style-name:\"Основной текст Знак1\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:\"Основной текст\";
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	font-family:\"Times New Roman\",serif;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	background:white;}
span.a
	{mso-style-name:\"Основной текст Знак\";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;}
span.Bodytext5
	{mso-style-name:\"Body text \(5\)_\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:\"Body text \(5\)\";
	mso-ansi-font-size:11.5pt;
	mso-bidi-font-size:11.5pt;
	font-family:\"Times New Roman\",serif;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	background:white;
	font-style:italic;}
span.BodytextTahoma
	{mso-style-name:\"Body text + Tahoma\,11\,5 pt3\,Spacing 0 pt2\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:\"\";
	mso-ansi-font-size:11.5pt;
	mso-bidi-font-size:11.5pt;
	font-family:\"Tahoma\",sans-serif;
	mso-ascii-font-family:Tahoma;
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:Tahoma;
	letter-spacing:-.5pt;
	background:white;}
span.Bodytext512
	{mso-style-name:\"Body text \(5\) + 12\,5 pt2\,Spacing 0 pt1\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:\"\";
	mso-ansi-font-size:12.5pt;
	mso-bidi-font-size:12.5pt;
	font-family:\"Times New Roman\",serif;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	letter-spacing:-.5pt;
	background:white;
	font-style:italic;}
p.Bodytext50, li.Bodytext50, div.Bodytext50
	{mso-style-name:\"Body text \(5\)\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-link:\"Body text \(5\)_\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:12.0pt;
	margin-left:0cm;
	text-indent:-17.0pt;
	line-height:12.0pt;
	mso-pagination:widow-orphan;
	background:white;
	font-size:11.5pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;
	font-style:italic;}
span.Bodytext11
	{mso-style-name:\"Body text + 11\,5 pt1\,Italic1\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:\"\";
	mso-ansi-font-size:11.5pt;
	mso-bidi-font-size:11.5pt;
	font-family:\"Times New Roman\",serif;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	letter-spacing:0pt;
	background:white;
	font-style:italic;}
span.Bodytext2
	{mso-style-name:\"Body text \(2\)_\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:\"Body text \(2\)1\";
	mso-ansi-font-size:19.0pt;
	mso-bidi-font-size:19.0pt;
	font-family:\"Times New Roman\",serif;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	background:white;
	font-weight:bold;
	font-style:italic;}
p.Bodytext21, li.Bodytext21, div.Bodytext21
	{mso-style-name:\"Body text \(2\)1\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-link:\"Body text \(2\)_\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:33.0pt;
	margin-left:0cm;
	mso-line-height-alt:12.0pt;
	mso-pagination:widow-orphan;
	background:white;
	font-size:19.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;
	font-weight:bold;
	font-style:italic;}
span.a0
	{mso-style-name:\"Верхний колонтитул Знак\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:\"Верхний колонтитул\";}
span.a1
	{mso-style-name:\"Нижний колонтитул Знак\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:\"Нижний колонтитул\";}
span.a2
	{mso-style-name:\"Текст Знак\";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:Текст;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Courier New\";
	mso-ascii-font-family:\"Courier New\";
	mso-fareast-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Courier New\";
	mso-bidi-font-family:\"Times New Roman\";
	mso-fareast-language:RU;}
p.ConsPlusCell, li.ConsPlusCell, div.ConsPlusCell
	{mso-style-name:ConsPlusCell;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:\"\";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:10.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-fareast-language:EN-US;}
span.a3
	{mso-style-name:\"Основной текст с отступом Знак\";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:\"Основной текст с отступом\";}
span.2
	{mso-style-name:\"Основной текст с отступом 2 Знак\";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:\"Основной текст с отступом 2\";}
span.20
	{mso-style-name:\"Основной текст 2 Знак\";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:\"Основной текст 2\";}
span.3
	{mso-style-name:\"Основной текст 3 Знак\";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:\"Основной текст 3\";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;}
span.a4
	{mso-style-name:\"Текст выноски Знак\";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:\"Текст выноски\";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;
	font-family:\"Tahoma\",sans-serif;
	mso-ascii-font-family:Tahoma;
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:Tahoma;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	mso-ascii-font-family:Arial;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Arial;
	mso-bidi-font-family:Arial;}
 /* Page Definitions */
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:2.0cm 1.0cm 2.0cm 70.9pt;
	mso-header-margin:35.45pt;
	mso-footer-margin:35.45pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:1;
	mso-list-template-ids:1596379456;}
@list l0:level1
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level2
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level3
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level4
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level5
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level6
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level7
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level8
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l0:level9
	{mso-level-text:\"1\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1
	{mso-list-id:3;
	mso-list-template-ids:-1240011384;}
@list l1:level1
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1:level2
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1:level3
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1:level4
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1:level5
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1:level6
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1:level7
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1:level8
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l1:level9
	{mso-level-start-at:2;
	mso-level-text:\"1\.8\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2
	{mso-list-id:5;
	mso-list-template-ids:-588455070;}
@list l2:level1
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2:level2
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2:level3
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2:level4
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2:level5
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2:level6
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2:level7
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2:level8
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l2:level9
	{mso-level-text:\"1\.9\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3
	{mso-list-id:7;
	mso-list-template-ids:695124780;}
@list l3:level1
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3:level2
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3:level3
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3:level4
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3:level5
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3:level6
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3:level7
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3:level8
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l3:level9
	{mso-level-text:\"1\.10\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4
	{mso-list-id:9;
	mso-list-template-ids:1749074364;}
@list l4:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	font-family:Symbol;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4:level2
	{mso-level-number-format:bullet;
	mso-level-text:•;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4:level3
	{mso-level-number-format:bullet;
	mso-level-text:•;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4:level4
	{mso-level-number-format:bullet;
	mso-level-text:•;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4:level5
	{mso-level-number-format:bullet;
	mso-level-text:•;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4:level6
	{mso-level-number-format:bullet;
	mso-level-text:•;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4:level7
	{mso-level-number-format:bullet;
	mso-level-text:•;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4:level8
	{mso-level-number-format:bullet;
	mso-level-text:•;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l4:level9
	{mso-level-number-format:bullet;
	mso-level-text:•;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5
	{mso-list-id:11;
	mso-list-template-ids:1295038548;}
@list l5:level1
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5:level2
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5:level3
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5:level4
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5:level5
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5:level6
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5:level7
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5:level8
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l5:level9
	{mso-level-text:\"2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6
	{mso-list-id:13;
	mso-list-template-ids:364274394;}
@list l6:level1
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6:level2
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6:level3
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6:level4
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6:level5
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6:level6
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6:level7
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6:level8
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l6:level9
	{mso-level-text:\"2\.2\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7
	{mso-list-id:15;
	mso-list-template-ids:-1252105480;}
@list l7:level1
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7:level2
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7:level3
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7:level4
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7:level5
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7:level6
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7:level7
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7:level8
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l7:level9
	{mso-level-text:\"3\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8
	{mso-list-id:17;
	mso-list-template-ids:2080404968;}
@list l8:level1
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8:level2
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8:level3
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8:level4
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8:level5
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8:level6
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8:level7
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8:level8
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l8:level9
	{mso-level-text:\"3\.11\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9
	{mso-list-id:19;
	mso-list-template-ids:-1159584308;}
@list l9:level1
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9:level2
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9:level3
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9:level4
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9:level5
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9:level6
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9:level7
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9:level8
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l9:level9
	{mso-level-text:\"3\.12\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10
	{mso-list-id:21;
	mso-list-template-ids:641923936;}
@list l10:level1
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10:level2
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10:level3
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10:level4
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10:level5
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10:level6
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10:level7
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10:level8
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l10:level9
	{mso-level-text:\"4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11
	{mso-list-id:23;
	mso-list-template-ids:1722860436;}
@list l11:level1
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11:level2
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11:level3
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11:level4
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11:level5
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11:level6
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11:level7
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11:level8
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l11:level9
	{mso-level-text:\"4\.4\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12
	{mso-list-id:25;
	mso-list-template-ids:1376277088;}
@list l12:level1
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:\"Arial\",sans-serif;
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12:level2
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12:level3
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12:level4
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12:level5
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12:level6
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12:level7
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12:level8
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l12:level9
	{mso-level-text:\"5\.%1\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:10.5pt;
	mso-ascii-font-family:\"Times New Roman\";
	mso-hansi-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";
	font-variant:normal !important;
	color:black;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-width:100%;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;}
@list l13
	{mso-list-id:36201342;
	mso-list-template-ids:1444436840;}
@list l13:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:33.0pt;
	text-indent:-33.0pt;}
@list l13:level2
	{mso-level-start-at:10;
	mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:62.5pt;
	text-indent:-36.0pt;}
@list l13:level3
	{mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:89.0pt;
	text-indent:-36.0pt;}
@list l13:level4
	{mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.5pt;
	text-indent:-54.0pt;}
@list l13:level5
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:160.0pt;
	text-indent:-54.0pt;}
@list l13:level6
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:204.5pt;
	text-indent:-72.0pt;}
@list l13:level7
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:231.0pt;
	text-indent:-72.0pt;}
@list l13:level8
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:275.5pt;
	text-indent:-90.0pt;}
@list l13:level9
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:302.0pt;
	text-indent:-90.0pt;}
@list l14
	{mso-list-id:90013099;
	mso-list-type:hybrid;
	mso-list-template-ids:-696513748 68747265 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l14:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:78.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;
	color:windowtext;}
@list l14:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:114.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l14:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:150.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l14:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:186.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l14:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:222.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l14:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:258.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l14:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:294.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l14:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:330.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l14:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:366.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l15
	{mso-list-id:499152973;
	mso-list-template-ids:-243790376;}
@list l15:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:33.0pt;
	text-indent:-33.0pt;}
@list l15:level2
	{mso-level-start-at:10;
	mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l15:level3
	{mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l15:level4
	{mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l15:level5
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l15:level6
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l15:level7
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l15:level8
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-90.0pt;}
@list l15:level9
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-90.0pt;}
@list l16
	{mso-list-id:764153435;
	mso-list-type:hybrid;
	mso-list-template-ids:-828974098 1644078974 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l16:level1
	{mso-level-number-format:image;
	list-style-image:url(\"Инструкция%20по%20оказанию%20первой%20помощи.files/image001.png\");
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:78.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;
	color:windowtext;}
@list l16:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:114.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l16:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:150.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l16:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:186.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l16:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:222.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l16:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:258.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l16:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:294.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l16:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:330.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l16:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:366.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l17
	{mso-list-id:1332877175;
	mso-list-template-ids:-626130430;}
@list l17:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:33.0pt;
	text-indent:-33.0pt;}
@list l17:level2
	{mso-level-start-at:10;
	mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-36.0pt;}
@list l17:level3
	{mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-36.0pt;}
@list l17:level4
	{mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:108.0pt;
	text-indent:-54.0pt;}
@list l17:level5
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:126.0pt;
	text-indent:-54.0pt;}
@list l17:level6
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:162.0pt;
	text-indent:-72.0pt;}
@list l17:level7
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:180.0pt;
	text-indent:-72.0pt;}
@list l17:level8
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:216.0pt;
	text-indent:-90.0pt;}
@list l17:level9
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:234.0pt;
	text-indent:-90.0pt;}
@list l18
	{mso-list-id:1389843102;
	mso-list-type:hybrid;
	mso-list-template-ids:1504099890 1644078974 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l18:level1
	{mso-level-number-format:image;
	list-style-image:url(\"Инструкция%20по%20оказанию%20первой%20помощи.files/image001.png\");
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:78.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;
	color:windowtext;}
@list l18:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:114.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l18:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:150.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l18:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:186.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l18:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:222.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l18:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:258.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l18:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:294.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l18:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:330.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l18:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:366.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l19
	{mso-list-id:1576426943;
	mso-list-type:hybrid;
	mso-list-template-ids:-1034645118 68747273 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l19:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F076;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:74.75pt;
	text-indent:-18.0pt;
	font-family:Wingdings;
	color:windowtext;}
@list l19:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:114.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l19:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:150.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l19:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:186.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l19:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:222.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l19:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:258.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l19:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:294.55pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l19:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:330.55pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l19:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:366.55pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l20
	{mso-list-id:1724325598;
	mso-list-template-ids:-949612028;}
@list l20:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l20:level2
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-36.0pt;
	font-family:Symbol;}
@list l20:level3
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-36.0pt;}
@list l20:level4
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-54.0pt;}
@list l20:level5
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-54.0pt;}
@list l20:level6
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-72.0pt;}
@list l20:level7
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-72.0pt;}
@list l20:level8
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:108.0pt;
	text-indent:-90.0pt;}
@list l20:level9
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:108.0pt;
	text-indent:-90.0pt;}
@list l21
	{mso-list-id:1897154962;
	mso-list-template-ids:-1804677986;}
@list l21:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	mso-ansi-font-weight:bold;}
@list l21:level2
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-36.0pt;}
@list l21:level3
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:78.55pt;
	text-indent:-36.0pt;}
@list l21:level4
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-54.0pt;}
@list l21:level5
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-54.0pt;}
@list l21:level6
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-72.0pt;}
@list l21:level7
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-72.0pt;}
@list l21:level8
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:108.0pt;
	text-indent:-90.0pt;}
@list l21:level9
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:108.0pt;
	text-indent:-90.0pt;}
@list l22
	{mso-list-id:1959681574;
	mso-list-template-ids:677791366;}
@list l22:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:27.0pt;
	text-indent:-27.0pt;}
@list l22:level2
	{mso-level-start-at:9;
	mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l22:level3
	{mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l22:level4
	{mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l22:level5
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l22:level6
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l22:level7
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l22:level8
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-90.0pt;}
@list l22:level9
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-90.0pt;}
@list l23
	{mso-list-id:2136019437;
	mso-list-template-ids:1012571006;}
@list l23:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:153.0pt;
	text-indent:-18.0pt;}
@list l23:level2
	{mso-level-start-at:8;
	mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:171.0pt;
	text-indent:-36.0pt;}
@list l23:level3
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:171.0pt;
	text-indent:-36.0pt;}
@list l23:level4
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.0pt;
	text-indent:-54.0pt;}
@list l23:level5
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.0pt;
	text-indent:-54.0pt;}
@list l23:level6
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:207.0pt;
	text-indent:-72.0pt;}
@list l23:level7
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:207.0pt;
	text-indent:-72.0pt;}
@list l23:level8
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.0pt;
	text-indent:-90.0pt;}
@list l23:level9
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.0pt;
	text-indent:-90.0pt;}
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
	mso-style-priority:99;
	mso-style-parent:\"\";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:\"Arial\",sans-serif;}
table.MsoTableGrid
	{mso-style-name:\"Сетка таблицы\";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:\"Arial\",sans-serif;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext=\"edit\" spidmax=\"1026\"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext=\"edit\">
  <o:idmap v:ext=\"edit\" data=\"1\"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=RU link=blue vlink=\"#954F72\" style='tab-interval:35.45pt'>

<div class=WordSection1>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:16.0pt;
font-family:\"Times New Roman\",serif;mso-fareast-font-family:\"Times New Roman\";
mso-fareast-language:RU'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt;
font-family:\"Times New Roman\",serif;mso-fareast-font-family:\"Times New Roman\";
mso-fareast-language:RU'>Утверждаю:<o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt;
font-family:\"Times New Roman\",serif;mso-fareast-font-family:\"Times New Roman\";
mso-fareast-language:RU'>Директор ".$company_name."<o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt;
font-family:\"Times New Roman\",serif;mso-fareast-font-family:\"Times New Roman\";
mso-fareast-language:RU'>_________<span>".$director_fio."</span>.<o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt;
font-family:\"Times New Roman\",serif;mso-fareast-font-family:\"Times New Roman\";
mso-fareast-language:RU'>«__»_________".date('Y')."<o:p></o:p></span></p>

<p class=MsoNormal style='mso-pagination:none;mso-layout-grid-align:none;
text-autospace:none'><b style='mso-bidi-font-weight:normal'><span
style='font-size:16.0pt;font-family:\"Times New Roman\",serif;mso-fareast-font-family:
\"Times New Roman\";mso-fareast-language:RU'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='mso-pagination:none;mso-layout-grid-align:none;
text-autospace:none'><b style='mso-bidi-font-weight:normal'><span
style='font-size:14.0pt;font-family:\"Times New Roman\",serif;mso-fareast-font-family:
\"Times New Roman\";mso-fareast-language:RU'>Инструкция № 10</span></b><b
style='mso-bidi-font-weight:normal'><span style='font-size:16.0pt;font-family:
\"Times New Roman\",serif;mso-fareast-font-family:\"Times New Roman\";mso-fareast-language:
RU'><br>
</span></b><b style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;
font-family:\"Times New Roman\",serif'>ИНСТРУКЦИЯ ПО ОКАЗАНИЮ ПЕРВОЙ
(ДОВРАЧЕБНОЙ) ПОМОЩИ<o:p></o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:\"Times New Roman\",serif'>ПОСТРАДАВШИМ ПРИ
НЕСЧАСТНЫХ СЛУЧАЯХ НА ПРОИЗВОДСТВЕ<o:p></o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;font-family:\"Times New Roman\",serif'><o:p>&nbsp;</o:p></span></b></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ОБЩИЕ ТРЕБОВАНИЯ ОХРАНЫ ТРУДА<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:1.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
13.2pt;line-height:115%;mso-list:l0 level1 lfo1;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
color:black'><span style='mso-list:Ignore'>1.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Первая
медицинская помощь представляет собой комплекс срочных мероприятий, проводимых
при несчастных случаях и внезапных заболеваниях, направленных на прекращение
действия повреждающего фактора, на устранение явлений, угрожающих жиз­ни, на
облегчение страданий и подготовку пострадавшего к от­правке в лечебное
учреждение. Первая медицинская помощь — это простейшие медицинские действия,
выполняемые непосред­ственно на месте происшествия в кратчайшие сроки после
травмы. Она оказывается, как правило, не медиками, а работниками, на­ходящимися
в момент происшествия непосредственно на месте происшествия или вблизи от него,
Считается оптимальным сроком оказания первой медицинской помощи — 30 минут
после травмы<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:1.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
13.2pt;line-height:115%;mso-list:l0 level1 lfo1;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
color:black'><span style='mso-list:Ignore'>1.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Оказывающему
помощь необходимо придерживаться следующих рекомендаций:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>освободить
пострадавшего от дальнейшего воздействия на него опасного производственного
фактора (электрического тока, химических веществ, воды и др.), оценить
состояние пострадавшего, при необходимости вынести на свежий воздух, освободить
от стесняющей дыхание одежды;<span style='mso-spacerun:yes'>  </span><o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>определить характер
и степень повреждения, для чего обнажить поврежденную часть тела или снять с
пострадавшего всю одежду. Раздевание и одевание пострадавшего должны произво­дить
осторожно, не вызывать болезненных ощущений или повтор­ного повреждения; <o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>выполнить необходимые
мероприятия по спасению постра­давшего в порядке срочности (восстановить
проходимость дыха­тельных путей, в случае необходимости провести искусственное
дыхание, наружный массаж сердца, остановить кровотечение, им­мобилизовать место
перелома, наложить повязку и т. п.);<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:1.0pt;margin-right:0cm;margin-bottom:0cm;
margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:13.2pt;
mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;layout-grid-mode:line'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
line'>поддержать основные жизненные функции пострадавшего до прибытия
медицинского работника;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:2.0pt;margin-right:0cm;margin-bottom:0cm;
margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:13.2pt;
mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;layout-grid-mode:line'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
line'>вызвать медицинских работников либо принять меры для транспортировки
пострадавшего в ближайшее лечебное учреж­дение.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:1.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
13.2pt;line-height:115%;mso-list:l0 level1 lfo1;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
color:black'><span style='mso-list:Ignore'>1.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Оказывающий
помощь должен знать:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>основы работы в
экстремальных условиях;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>основные признаки
нарушений жизненно важных функций<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>организма человека;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>правила, методы,
приемы оказания первой медицинской, реа­нимационной помощи применительно к
особенностям конкретного несчастного случая, конкретного человека;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>основные способы
переноски и эвакуации пострадавших.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:1.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
13.2pt;line-height:115%;mso-list:l0 level1 lfo1;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
color:black'><span style='mso-list:Ignore'>1.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Оказывающий
помощь должен уметь:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>быстро и правильно
оценивать ситуацию, ориентироваться<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>в экстремальных
условиях (в том числе: в электроустановках, на воде и пр.);<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>оценивать состояние
пострадавшего, диагностировать вид, особенности поражения (травмы);<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>определять вид
необходимой первой медицинской помощи, последовательность проведения
соответствующих мероприятий,<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>контролировать их
эффективность, при необходимости — осущест­влять коррекцию мероприятий;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>правильно
осуществлять весь комплекс экстренной реанима­ционной помощи, контролировать
эффективность, корректировать<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>реанимационные
мероприятия с учетом состояния пострадавше­го;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>временно
останавливать кровотечение путем наложения жгу­та, давящей повязки, пальцевого
прижатия сосуда;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>выполнять
искусственное дыхание «изо рта в рот» («изо рта в нос») и закрытый массаж
сердца и оценивать их эффективность;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>накладывать повязки,
косынки, транспортные шины при пе­реломах костей скелета, тяжелых ушибах;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>иммобилизовать
поврежденную часть тела при переломе костей, тяжелом ушибе, термическом
поражении;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>оказывать помощь при
поражениях электрическим током, в том числе, в экстремальных условиях;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>оказывать помощь при
тепловом и солнечных ударах, утоп­лении, остром отравлении, рвоте,
бессознательном состоянии;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>использовать
подручные средства при оказании первой ме­дицинской помощи, при переносе,
погрузке, транспортировке по­страдавшего;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>определять
необходимость вызова скорой медицинской по­мощи, медицинского работника;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>эвакуировать
пострадавшего попутным (неприспособленным) транспортом;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:13.2pt;
line-height:108%;mso-list:l14 level1 lfo23;tab-stops:1.0cm'><![if !supportLists]><span
style='font-size:12.0pt;line-height:108%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;layout-grid-mode:line'><span
style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:108%;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>пользоваться
аптечкой первой помощи.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:1.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
13.2pt;line-height:115%;mso-list:l0 level1 lfo1;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
color:black'><span style='mso-list:Ignore'>1.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>В
зависимости от воздействующего фактора травмы подразделяются на механические
(раны, ушибы, разрывы внутрен­них органов, переломы костей, вывихи), физические
(ожоги, тепловой удар, обморожения, поражения электрическим током или мол­нией,
лучевая болезнь и др.), химические (воздействия кислот, ще­лочей, отравляющих
веществ), биологические (воздействие бактериальных токсинов), психические (испуг,
шок и др.). В зависимос­ти от вида травмы пользуются определенным набором мер,
на­правленных на спасение, жизни и здоровья пострадавшего.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:42.55pt'><b style='mso-bidi-font-weight:
normal'><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'>Требования<o:p></o:p></span></b></p>

<p class=MsoNormal style='text-indent:42.55pt'><b style='mso-bidi-font-weight:
normal'><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'>к комплектации изделиями медицинского назначения аптечек<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:6.0pt;text-indent:42.55pt'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:
\"Times New Roman\",serif;layout-grid-mode:line'>для оказания первой помощи
работникам</span></b><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><o:p></o:p></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=678
 style='width:508.65pt;border-collapse:collapse;border:none;mso-border-alt:
 solid windowtext .5pt;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
 mso-border-insideh:.5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <thead>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;page-break-inside:avoid'>
   <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;mso-border-alt:
   solid windowtext .5pt;background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
   style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
   line'>№ п/п<o:p></o:p></span></b></p>
   </td>
   <td width=261 style='width:196.1pt;border:solid windowtext 1.0pt;border-left:
   none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
   background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
   style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
   line'>Наименование изделий медицинского назначения<o:p></o:p></span></b></p>
   </td>
   <td width=161 style='width:120.5pt;border:solid windowtext 1.0pt;border-left:
   none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
   background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
   style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
   line'>Нормативный документ<o:p></o:p></span></b></p>
   </td>
   <td width=123 style='width:92.15pt;border:solid windowtext 1.0pt;border-left:
   none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
   background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
   style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
   line'>Форма выпуска<o:p></o:p></span></b></p>
   <p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
   style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
   line'>(размеры)<o:p></o:p></span></b></p>
   </td>
   <td width=85 style='width:63.8pt;border:solid windowtext 1.0pt;border-left:
   none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
   background:#BFBFBF;padding:0cm 5.4pt 0cm 5.4pt'>
   <p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
   style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
   line'>Кол-во<o:p></o:p></span></b></p>
   <p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
   style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
   line'>(шт., уп.)<o:p></o:p></span></b></p>
   </td>
  </tr>
 </thead>
 <tr style='mso-yfti-irow:1;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.<o:p></o:p></span></p>
  </td>
  <td width=630 colspan=4 valign=top style='width:472.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=ConsPlusCell><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif'>Изделия
  медицинского назначения для временной остановки наружного кровотечения и
  перевязки ран<span style='layout-grid-mode:line'><o:p></o:p></span></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.1.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Жгут
  кровоостанавливающий<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.2.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Бинт
  марлевый медицинский<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 1172-93<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>5 м. х 5 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.3.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Бинт
  марлевый медицинский нестерильный<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 1172-93<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>5 м. х 10 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.4.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Бинт
  марлевый медицинский нестерильный<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 1172-93<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>7 м. х 14 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.5.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Бинт
  марлевый медицинский стерильный<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 1172-93<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>5 м. х 7 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.6.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Бинт
  марлевый медицинский стерильный<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 1172-93<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>5 м. х 10 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>2 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.7.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Бинт
  марлевый медицинский стерильный<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 1172-93<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>7 м. х 14 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>2 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.8.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Пакет
  перевязочный медицинский индивидуальный стерильный с герметичной оболочкой<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 1179-93<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.9.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Салфетки
  марлевые медицинские стерильные<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 16427-93<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>не менее <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>16 х 14 см. № 10<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 уп.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.10.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Лейкопластырь
  бактерицидный<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>не менее <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>4 см. х 10 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>2 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.11.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Лейкопластырь
  бактерицидный<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>не менее <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1,9 см. х 7,2 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>10 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1.12.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Лейкопластырь
  рулонный<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>не менее <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 см. х 250 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>2.<o:p></o:p></span></p>
  </td>
  <td width=630 colspan=4 valign=top style='width:472.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Изделия
  медицинского назначения для проведения сердечно-легочной реанимации<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>2.1.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Устройство
  для проведения искусственного дыхания «Рот – Устройство - Рот» или карманная
  маска для искусственной реанимации легких «Рот - маска»<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>3.<o:p></o:p></span></p>
  </td>
  <td width=630 colspan=4 valign=top style='width:472.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Прочие
  изделия медицинского назначения<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>3.1.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Ножницы для
  разрезания повязок по Листеру<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 21239-93 <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>(ИСО 7741-86)<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>3.2.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Салфетки
  антисептические из бумажного текстилеподобного материала стерильные спиртовые<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>не менее <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>12,5 х 11,0 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>5 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>3.3.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Перчатки
  медицинские нестерильные смотровые<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99 ГОСТ Р 52238-2004 ГОСТ Р
  52239-2004 ГОСТ 3-88<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>размер не менее М<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>2 пары<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>3.4.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Маска
  нестерильная трехслойная из нетканого материала с резинками или с завязками<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>2 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>3.5.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Покрывало
  спасательное изотермическое<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ Р ИСО 10993-99 ГОСТ Р 50444-92<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>не менее <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>160 х 210 см.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>4.<o:p></o:p></span></p>
  </td>
  <td width=630 colspan=4 valign=top style='width:472.55pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Прочие
  средства<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>4.1.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Английские
  булавки стальные со спиралью<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 9389-75<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>не менее <o:p></o:p></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>38 мм.<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>3 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:24;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>4.2.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Рекомендации
  с пиктограммами по использованию изделий медицинского назначения аптечки для
  оказания первой помощи работникам<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:25;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>4.3.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Футляр или
  сумка санитарная<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:26;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>4.4.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Блокнот
  отрывной для записей<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 18510-87<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>формат не менее А7<o:p></o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:27;mso-yfti-lastrow:yes;page-break-inside:avoid'>
  <td width=48 style='width:36.1pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>4.5.<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:196.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=left style='text-align:left'><span style='font-size:
  12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:line'>Авторучка<o:p></o:p></span></p>
  </td>
  <td width=161 style='width:120.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>ГОСТ 28937-91<o:p></o:p></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=85 style='width:63.8pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
  layout-grid-mode:line'>1 шт.<o:p></o:p></span></p>
  </td>
 </tr>
</table>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:0cm;
line-height:115%;background:transparent'><span style='font-size:12.0pt;
line-height:115%'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ОСВОБОЖДЕНИЕ ОТ ДЕЙСТВИЙ ЭЛЕКТРИЧЕСКОГО ТОКА<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>При поражении электрическим током
необходимо как можно скорее освободить пострадавшего от действия тока, так как
от продолжительности этого действия зависит тяжесть электротравмы.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Прикосновение к токоведущим частям,
находящимся под напряжением, вызывает в большинстве случаев непроизвольное судорожное
сокращение мышц и общее возбуждение, которое может привести к нарушению и даже
к полному прекращению деятельности органов дыхания и кровообращения. Если
пострадавший держит провод руками, его пальцы так сильно сжимаются, что
высвободить провод из его рук становится невозможным. Поэтому первым действием
оказывающего помощь должно быть немедленное отключение той части
электроустановки, которой касается пострадавший. Отключение производится с
помощью выключателей, рубильника или другого отключающего аппарата, а также путем
снятия или вывертывания предохранителей (пробок), разъема штепсельного
соединения.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Если пострадавший находится на
высоте, то отключение установки и тем самым освобождение от тока может вызвать
его падение. В этом случае необходимо принять меры, предупреждающие падение
пострадавшего или обеспечивающие его безопасность.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>При отключении электроустановки может
одновременно погаснуть электрический свет. В связи с этим при отсутствии
дневного освещения необходимо заботиться об освещении от другого источника (включить
аварийное освещение, аккумуляторные фонари и т. п.) с учетом взрывоопасности и
пожароопасности помещения, не задерживая отключения электроустановки и оказания
помощи пострадавшему.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Если отключить установку достаточно
быстро нельзя, необходимо принять иные меры к освобождению пострадавшего от
действия тока. Во всех случаях оказывающий помощь не должен прикасаться к
пострадавшему без надлежащих мер предосторожности, так как это опасно для
жизни. Он должен следить и за тем, чтобы самому не оказаться в контакте с
токоведущей частью и под напряжением шага. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Напряжение до 1000 В<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.6.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Для
отделения пострадавшего от токоведущих частей или провода напряжением до 1000 В
следует воспользоваться канатом, палкой, доской или каким-либо другим сухим
предметом, не проводящим электрический ток, можно также оттянуть его за одежду
(если она сухая и отступает от тела), например, за полы пиджака или пальто, за
воротник, избегая при этом соприкосновения с окружающими металлическими
предметами и частями тела пострадавшего, не прикрытыми одеждой. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.6.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Оттаскивая
пострадавшего за ноги, оказывающий помощь не должен касаться его обуви или
одежды без хорошей изоляции своих рук, так как обувь и одежда могут быть сырыми
и являться проводниками электрического тока.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.6.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Для
изоляции рук оказывающий помощь, должен одеть диэлектрические перчатки или
обмотать руку шарфом, надеть на нее суконную фуражку, натянуть на руку рукав,
пиджака или пальто, накинуть на пострадавшего резиновый коврик, прорезиненную
материю (плащ) или просто сухую материю. Можно также изолировать себя, встав на
резиновый коврик, сухую доску или какую-либо не проводящую электрический ток
подстилку, сверток одежды и т. п. При отделении пострадавшего от токоведущих
частей рекомендуется действовать одной рукой, держа вторую в кармане или за
спиной.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.6.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
электрический ток проходит в землю через пострадавшего и он судорожно сжимает в
руке один токоведущий элемент (например, провод), проще прервать ток, отделив
пострадавшего от земли (подсунуть под него сухую доску, либо оттянуть ноги от земли
веревкой, либо оттащить за одежду), соблюдая при этом указанные выше меры
предосторожности как по отношению к самому себе, так и по отношению к
пострадавшему. Можно также перерубить провода топором с сухой деревянной
рукояткой или перекусить их инструментом с изолированными рукоятками (кусачками,
пассатижами и т. п.). Перерубать и перекусывать провода необходимо пофазно, т.
е. каждый провод в отдельности, при этом рекомендуется стоять по возможности на
сухих досках, деревянной лестнице и т. п. Можно воспользоваться и неизолированным
инструментом, обернув его рукоятку сухой материей.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Напряжение выше 1000 В.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.7.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Для
отделения пострадавшего от токоведущей части, находящейся под напряжением выше
1000 В, следует надеть диэлектрические перчатки и боты и действовать штангой
или изолирующими клещами, рассчитанными на соответствующее напряжение; при этом
надо помнить об опасности напряжения шага, если токоведущая часть (провод и т.
п.) лежит на земле, и после освобождения пострадавшего от действия тока
необходимо вынести его из опасной зоны. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.7.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>На
линиях электропередачи, когда нельзя быстро отключить их от пунктов питания,
для освобождения пострадавшего, если он касается проводов, следует произвести
замыкание проводов накоротко, набросив на них гибкий неизолированный провод.
Провод должен иметь достаточное сечение, чтобы он не перегорел при прохождении
через него тока короткого замыкания.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Перед тем как произвести наброс, один
конец провода надо заземлить (присоединить его к заземленной металлической
опоре и др.).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.9.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Для удобства наброса на свободный
конец проводника желательно прикрепить груз. Набрасывать проводник надо так,
чтобы он не коснулся людей, в том числе, оказывающего помощь и пострадавшего.
Если пострадавший касается одного провода, то достаточно заземлить только этот
провод.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Первая
помощь пострадавшему от электрического тока.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>После
освобождения пострадавшего от действия электрического тока необходимо оценить
его состояние. Признаки, по которым можно быстро определить состояние
пострадавшего, следующие:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'> </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>сознание: ясное, отсутствует,
нарушено (пострадавший заторможен, возбужден);<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'> </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>цвет кожных покровов и видимых
слизистых (губ, глаз): розовые, синюшные, бледные;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'> </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>дыхание: нормальное, отсутствует,
нарушено (неправильное, поверхностное, хрипящее);<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'> </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>пульс на сонной артерии: хорошо
определяется (ритм правильный или неправильный), плохо определяется,
отсутствует;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'> </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>зрачки: узкие, широкие.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
определенных навыках, владея собой, оказывающий помощь в течение одной минуты
способен оценить состояние пострадавшего и решить, в каком объеме и порядке
следует оказывать ему помощь.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;background:transparent'><span style='font-size:12.0pt;
line-height:115%'>Цвет кожных покровов и наличие дыхания (по подъему и
опусканию грудной клетки) оценивают визуально. Нельзя тратить драгоценное время
на прикладывание ко рту и носу зеркала, блестящих металлических предметов. Об
утрате сознания также, как правило, судят визуально, и, чтобы окончательно
убедиться в его отсутствии, можно обратиться к пострадавшему с вопросом о
самочувствии.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Пульс
на сонной артерии прощупывают подушечками второго, третьего и четвертого
пальцев руки, располагая их вдоль шеи между кадыком (адамово яблоко) и
кивательной мышцей и слегка прижимая к позвоночнику. Приемы определения пульса
на сонной артерии очень легко отработать на себе или на своих близких.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Ширину
зрачков при закрытых глазах определяют следующим образом: подушечки указательных
пальцев кладут на верхние веки обоих глаз и, слегка придавливая их к глазному
яблоку, поднимают вверх. При этом глазная щель открывается и на белом фоне
видна округлая радужка, а в центре ее округлой формы черные зрачки, состояние
которых (узкие или широкие) оценивают по тому, какую площадь радужки они
занимают.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Как
правило, степень нарушения сознания, цвет кожных покровов и состояние дыхания
можно оценить одновременно с прощупыванием пульса, что отнимает не более 1 мин.
Осмотр зрачков удается провести за несколько секунд.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
у пострадавшего отсутствуют сознание, дыхание, пульс, кожный покров синюшный, а
зрачки широкие (<st1:metricconverter ProductID=\"0,5 см\" w:st=\"on\">0,5 см</st1:metricconverter>
в диаметре), можно считать, что он находится в состоянии клинической смерти и
немедленно приступать к оживлению организма с помощью искусственного дыхания по
способу «изо рта в рот» или «изо рта в нос» и наружного массажа сердца. Не
следует раздевать пострадавшего, теряя драгоценные секунды.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
пострадавший дышит очень редко и судорожно, но у него прощупывается пульс,
необходимо сразу же начать делать искусственное дыхание. Не обязательно, чтобы
при проведении искусственного дыхания пострадавший находился в горизонтальном
положении.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Приступив
к оживлению, нужно позаботиться о вызове врача или скорой медицинской помощи.
Это должен сделать не оказывающий помощь, который не может прервать ее
оказание, а кто-то другой.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.9.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
пострадавший в сознании, но до этого был в обмороке или находился в бессознательном
состоянии, но с сохранившимися устойчивыми дыханием и пульсом, его следует уложить
на подстилку, например, из одежды; расстегнуть одежду, стесняющую дыхание;
создать приток свежего воздуха; согреть тело, если холодно; обеспечить
прохладу, если жарко; создать полный покой, непрерывно наблюдая за пульсом и
дыханием; удалить лишних людей.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.10.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
пострадавший находится в бессознательном состоянии, необходимо наблюдать за его
дыханием и в случае нарушения дыхания из-за западания языка выдвинуть нижнюю
челюсть вперед, взявшись пальцами за ее углы, и поддержать ее в таком
положении, пока не прекратится западание языка.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.11.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
возникновении у пострадавшего рвоты необходимо повернуть его голову и плечи
налево для удаления рвотных масс. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.12.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Ни
в коем случае нельзя позволять пострадавшему двигаться, а тем более продолжать
работу, так как отсутствие видимых тяжелых повреждений от электрического тока
или других причин (падение и т. п.) еще не исключает возможности последующего
ухудшения его состояния.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.13.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Переносить
пострадавшего в другое место следует только в тех случаях, когда ему или лицу,
оказывающему помощь, продолжает угрожать опасность или когда оказание помощи на
месте невозможно (например, на опоре).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.10.14.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Ни
в коем случае нельзя зарывать пострадавшего в землю, так как это принесет только
вред и приведет к потере дорогих для его спасения минут.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>2.11.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
поражении молнией оказывается та же помощь, что при поражении электрическим
током.<o:p></o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПРИЕМЫ ИСКУССТВЕННОГО ДЫХАНИЯ<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:10.0pt;text-indent:42.55pt'><span
style='font-size:12.0pt;font-family:\"Times New Roman\",serif;mso-fareast-language:
RU;mso-no-proof:yes'><img_del src=\"".$img1."\"></span><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt'><span
style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
line'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-indent:42.55pt'><span style='font-size:12.0pt;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>1. очищение рта;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:42.55pt;line-height:133%'><span
style='font-size:12.0pt;line-height:133%;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'>2. положение головы пострадавшего при проведении искус­ственного
дыхания;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:42.55pt;line-height:108%'><span
style='font-size:12.0pt;line-height:108%;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'>3. проведение искусственного дыхания по способу «изо рта
в рот»;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:42.55pt;line-height:133%'><span
style='font-size:12.0pt;line-height:133%;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'>4. проведение искусственного дыхания по способу «изо рта
в нос».<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
133%'><span style='font-size:12.0pt;line-height:133%;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПРОВЕДЕНИЕ НАРУЖНОГО МАССАЖА СЕРДЦА<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-top:10.0pt;text-indent:42.55pt'><img_del src=\"".$img2."\"></span><span style='font-size:12.0pt;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:2.0pt;text-indent:42.55pt'><span
style='font-size:12.0pt;font-family:\"Times New Roman\",serif;layout-grid-mode:
line'>1. место расположения рук;<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:42.55pt'><span style='font-size:12.0pt;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'>2. положение
оказывающего помощь.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:42.55pt'><span style='font-size:12.0pt;
font-family:\"Times New Roman\",serif;layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt;line-height:
108%'><span style='font-size:12.0pt;line-height:108%;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'>В случае невозможности вызова врача на место происшествия
необходимо обеспечить транспортировку пострадавшего в ближайшее лечебное
учреждение. Перевозить пострадавшего можно только при удовлетворительном
дыхании и устойчивом пульсе. Если состояние пострадавшего не позволяет его
транспортировать, необходимо продолжать оказывать помощь.<o:p></o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ РАНЕНИИ<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>5.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Всякая рана легко может загрязниться
микробами, находящимися на ранящем предмете, на коже пострадавшего, а также в
пыли, земле, на руках оказывающего помощь и на грязном перевязочном материале.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>5.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>При оказании помощи необходимо
соблюдать следующие правила:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>нельзя промывать рану водой или даже
каким-либо лекарственным веществом, засыпать порошком и смазывать мазями, так
как это препятствует ее заживлению, способствует занесению в нее грязи с
поверхности кожи и вызывает нагноение;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>нельзя убирать из раны песок, землю,
камешки и т. п., так как удалить таким образом все, что загрязняет рану,
невозможно. Нужно осторожно снять грязь вокруг раны, очищая кожу от ее краев
наружу, чтобы не загрязнять рану; очищенный участок вокруг раны нужно смазать
настойкой йода перед наложением повязки;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>нельзя удалять из раны сгустки крови,
инородные тела, так как это может вызвать сильное кровотечение;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>нельзя заматывать рану изоляционной
лентой или накладывать на рану паутину во избежание заражения столбняком.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>5.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Для оказания первой помощи при
ранении необходимо вскрыть имеющийся в аптечке (сумке) индивидуальный пакет в
соответствии с наставлением, напечатанным на его обертке. При наложении повязки
нельзя касаться руками той ее части, которая должна быть наложена
непосредственно на рану,<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>5.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Если индивидуального пакета
почему-либо не оказалось, то для перевязки можно использовать чистый носовой
платок, чистую ткань и т. п. Накладывать вату непосредственно на рану нельзя.
Если из раны выпадает какая-либо ткань или орган (мозг, кишечник), то повязку
накладывают сверху, ни в коем случае не пытаясь вправлять эту ткань или орган
внутрь раны.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>5.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Оказывающий помощь при ранениях
должен вымыть руки или смазать пальцы настойкой йода и касаться к самой ране
даже вымытыми руками не допускается.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>5.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Если рана загрязнена землей,
необходимо срочно обратиться к врачу для введения противостолбнячной сыворотки.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:0cm;
line-height:115%;background:transparent'><span style='font-size:12.0pt;
line-height:115%'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:line;
font-style:normal;mso-bidi-font-style:italic'><span style='mso-list:Ignore'>6.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></b><![endif]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;font-style:normal;mso-bidi-font-style:italic'>ПЕРВАЯ ПОМОЩЬ ПРИ
КРОВОТЕЧЕНИИ<span style='layout-grid-mode:line'><o:p></o:p></span></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>6.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Кровотечения, при которых кровь
вытекает из раны или естественных отверстий тела наружу, принято называть
наружными. Кровотечения, при которых кровь скапливается в полостях тела,
называют внутренними. Среди наружных кровотечений чаще всего наблюдаются
кровотечения из ран, а именно:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>капиллярное - при поверхностных
ранах, при этом кровь из раны вытекает каплями;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>венозное - при более глубоких ранах,
например, резаных, колотых, происходит обильное вытекание крови темно-красного
цвета;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>артериальное - при глубоких рубленых,
колотых ранах; артериальная кровь ярко красного цвета бьет струёй из поврежденных
артерий, в которых она находится под большим давлением;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>смешанное - в тех случаях, когда в
ране кровоточат вены и артерии, чаще всего такое кровотечение наблюдается при
глубоких ранах.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>6.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Для остановки кровотечения повязкой
необходимо:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>поднять раненую конечность;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>закрыть кровоточащую рану
перевязочным материалом (из пакета), сложенным в комочек, и придавить сверху,
не касаясь пальцами самой раны;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>в таком положении, не отпуская
пальцев, держать 4-5 минут. Если кровотечение остановится, то, не снимая
наложенного материала, поверх него наложить еще одну подушечку из другого пакета
или кусок ваты и забинтовать раненое место с небольшим нажимом, чтобы не
нарушать кровообращения поврежденной конечности. При бинтовании руки или ноги
витки бинта должны идти снизу вверх - от пальцев к туловищу;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>при сильном кровотечении, если его
невозможно остановить давящей повязкой, следует сдавить кровеносные сосуды, питающие
раненую область пальцами, жгутом или закруткой, либо согнуть конечности в
суставах. Во всех случаях при большом кровотечении необходимо срочно вызвать
врача и указать ему точное время наложения жгута (закрутки).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>6.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Кровотечения из внутренних органов
представляют большую опасность для жизни. Внутреннее кровотечение распознается
по резкой бледности лица, слабости, очень частому пульсу, одышке,
головокружению, сильной жажде и обморочному состоянию. В этих случаях
необходимо срочно вызвать врача, а до его прихода создать пострадавшему полный
покой. Нельзя давать ему пить, если есть подозрение на ранение органов брюшной
полости.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>6.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>На место травмы необходимо положить
холод (резиновый пузырь со льдом, снегом или холодной водой, холодные примочки
и т. п.).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>6.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Остановка кровотечения пальцами.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.5.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Быстро
остановить кровотечение можно, прижав пальцами кровоточащий сосуд к подлежащей
кости выше раны (ближе к туловищу). Придавливать пальцами кровоточащий сосуд
следует достаточно сильно.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.5.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Кровотечение из
ран останавливают:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на нижней части лица - прижатием
челюстной артерии к краю нижней челюсти;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на виске и лбу - прижатием височной
артерии впереди козелка уха;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на затылке - прижатием затылочной
артерии;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на голове и шее - прижатием сонной
артерии к шейным позвонкам;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на подмышечной впадине и плече
(вблизи плечевого сустава) - прижатием подключичной артерии к кости в подключичной
ямке;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на предплечье - прижатием подмышечной
и плечевой артерии посередине плеча с внутренней стороны;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на кистях и пальцах рук - прижатием
артерий (лучевой и локтевой) в нижней трети предплечья у кисти;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на бедре - прижатием бедренной
артерии в паху к костям таза;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на голени - прижатием бедренной
артерии в середине бедра или подколенной артерии;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>на стопе <span
style='mso-spacerun:yes'> </span>прижатием тыльной артерии стопы или задней
большеберцовой.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.5.3.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Остановка
кровотечения из конечности может быть произведена сгибанием ее в суставах, если
нет перелома костей этой конечности. У пострадавшего следует быстро засучить
рукава или брюки и, сделав комок из любой материи, вложить его в ямку, образующуюся
при сгибании сустава, расположенного выше места ранения; затем сильно, до
отказа, согнуть сустав над этим комком. При этом сдавливается проходящая в
сгибе артерия, подающая кровь к ране. В таком положении сгиба ноги или руки
надо связывать или привязывать к туловищу пострадавшего.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>6.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Остановка кровотечения жгутом или
закруткой.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Когда сгибание
в суставе применять невозможно (например, при одновременном переломе костей той
же конечности), то при сильном кровотечении следует перетянуть всю конечность,
накладывая жгут.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>В качестве
жгута лучше всего использовать какую-либо упругую растягивающуюся ткань,
резиновую трубку, подтяжки и т. п. Перед наложением жгута конечность (руку или
ногу) нужно подтянуть.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.3.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Если у
оказывающего помощь нет помощника, то предварительное прижатие артерии пальцами
можно поручить самому пострадавшему.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.4.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Жгуты
накладывают на ближайшую к туловищу часть плеча или бедра. Место, на которое
накладывают жгут, должно быть обернуто чем-либо мягким, например, несколькими
слоями бинта или куском марли, чтобы не прищемить кожу. Можно накладывать жгут
поверх рукава или брюк.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.5.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Прежде чем
наложить жгут, его следует растянуть, а затем туго забинтовать им конечность,
не оставляя между оборотами жгута не покрытых им участков кожи.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.6.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Перетягивание
жгутом конечности не должно быть чрезмерным, так как при этом могут быть
стянуты и пострадать нервы; натягивать жгут нужно только до прекращения
кровотечения. Если кровотечение полностью не прекратилось, следует наложить
дополнительно (более туго) несколько оборотов жгута.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.7.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Правильность
наложения жгута проверяют по пульсу. Если его биение прощупывается, то жгут
наложен неправильно, его нужно снять и наложить снова.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.8.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Держать
наложенный жгут больше 1,5-2,0 ч не допускается, так как это может привести к
омертвению обескровленной конечности.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.9.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Боль, которую
причиняет наложенный жгут, бывает очень сильной, в силу чего иногда приходится
на время снимать жгут. В этих случаях перед тем, как снять жгут, необходимо
прижать пальцами артерию, по которой идет кровь к ране, и дать пострадавшему отдохнуть
от боли, а конечности - получить некоторый приток крови. После этого жгут
накладывают снова. Распускать жгут следует постепенно и медленно. Даже если
пострадавший может выдержать боль от жгута, все равно через час его следует
снять на 10-15 мин.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;tab-stops:63.8pt;background:transparent'><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При отсутствии
под рукой ленты перетянуть конечность можно закруткой, сделанной из
нерастягивающегося материала: галстука, пояса, скрученного платка или
полотенца, веревки, ремня и т. п.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.10.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Материал, из
которого делается закрутка, обводится вокруг поднятой конечности, покрытой
чем-либо мягким (например, несколькими слоями бинта), и связывается узлом по наружной
стороне конечности. В этот узел или под него продевается какой-либо предмет в
виде палочки, который закручивается до прекращения кровотечения. Закрутив до
необходимой степени палочку, ее закрепляют так, чтобы она не смогла
самопроизвольно раскрутиться.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>6.6.11.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>После наложения
жгута или закрутки необходимо написать записку с указанием времени их наложения
или вложить ее в повязку под бинт или жгут. Можно сделать надпись на коже
поврежденной конечности.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>6.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>При кровотечении из носа
пострадавшего следует усадить, наклонить голову вперед, подставив под стекающую
кровь какую-либо емкость, расстегнуть ему ворот, положить на переносицу
холодную примочку, ввести в нос кусок ваты или марли, смоченной 3%-ным
раствором перекиси водорода, сжать пальцами крылья носа на 4 - 5 минут.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>6.8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>При кровотечении изо рта (кровавой
рвоте) пострадавшего следует уложить и срочно вызвать врача.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:36.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:
0cm;line-height:115%;background:transparent'><span style='font-size:12.0pt;
line-height:115%'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ ОЖОГАХ<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>7.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Ожоги бывают: термические - вызванные
огнем, паром, горячими предметами и веществами; химические - кислотами и
щелочами и электрические - воздействием электрического тока или электрической
дуги,<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>7.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>По глубине поражения все ожоги
делятся на четыре степени:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>первая - покраснение и отек кожи;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>вторая - водяные пузыри;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>третья - омертвление поверхностных и
глубоких слоев кожи;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>четвертая - обугливание кожи,
поражение мышц, сухожилий и костей.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>7.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Термические и электрические ожоги.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.3.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Если на
пострадавшем загорелась одежда, нужно быстро набросить на него пальто, любую
плотную ткань или сбить пламя водой.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.3.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Нельзя бежать в
горящей одежде, так как ветер, раздувая пламя, увеличит и усилит ожог.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.3.3.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При оказании
помощи пострадавшему во избежание заражения нельзя касаться обожженных участков
кожи или смазывать их мазями, жирами, маслами, вазелином, присыпать питьевой
содой, крахмалом и т. п. Нельзя вскрывать пузыри, удалять приставшую к
обожженному месту мастику, канифоль или другие смолистые вещества, так как,
удаляя их, легко можно содрать обожженную кожу и, тем самым, создать
благоприятные условия для заражения раны.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.3.4.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При небольших
по площади ожогах первой или второй степени нужно наложить на обожженный
участок кожи стерильную повязку.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.3.5.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Одежду и обувь
с обожженного места нельзя срывать, а необходимо разрезать ножницами и
осторожно снять. Если обгоревшие куски одежды прилипли к обожженному участку
тела, то поверх них следует наложить стерильную повязку и направить
пострадавшего в лечебное учреждение.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.3.6.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При тяжелых и
обширных ожогах пострадавшего необходимо завернуть в чистую простыню или ткань,
не раздевая его, укрыть потеплее, напоить теплым чаем и создать покой до прибытия
врача.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.3.7.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Обожженное лицо
необходимо закрыть стерильной марлей.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.3.8.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При ожогах глаз
следует делать холодные примочки из раствора борной кислоты (половина чайной
ложки кислоты на стакан воды) и немедленно направить пострадавшего к врачу.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>7.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Химические ожоги. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При химических
ожогах глубина повреждения тканей в значительной степени зависит от
длительности воздействия химического вещества. Важно как можно скорее уменьшить
концентрацию химического вещества и время его воздействия. Для этого пораженное
место сразу же промывают большим количеством проточной холодной воды из-под
крана, из резинового шланга или ведра в течение 15-20 мин.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Если кислота
или щелочь попали на кожу через одежду, то сначала ее надо смыть водой с
одежды, после чего промыть кожу,<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.3.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При попадании
на тело человека серной кислоты в виде твердого вещества необходимо ее удалить
сухой ватой или кусочком ткани, а затем пораженное место тщательно промыть
водой.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.4.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При химическом
ожоге полностью смыть химические вещества водой не удается. Поэтому после промывания
пораженное место необходимо обработать соответствующими нейтрализующими
растворами, используемыми в виде примочек (повязок).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.5.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Дальнейшая
помощь при химических ожогах оказывается так же, как и при термических.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.6.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При ожоге
кислотой делаются примочки (повязки) раствором питьевой соды (одна чайная ложка
соды на стакан воды).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.7.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При попадании
кислоты в виде жидкости, паров или газов в глаза или полость рта необходимо
промыть их большим количеством воды, а затем раствором питьевой соды (половина
чайной ложки на стакан воды).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.8.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При ожоге кожи
щелочью делаются примочки (повязки) раствором борной кислоты (одна чайная ложка
на стакан воды) или слабым раствором уксусной кислоты (одна чайная ложка
столового уксуса на стакан воды).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.9.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При попадании
брызг щелочи или паров в глаза и полость рта необходимо промыть пораженные
места большим количеством воды, а затем раствором борной кислоты (половина чайной
ложки кислоты на стакан воды).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.10.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Если в глаз
попали твердые кусочки химического вещества, то сначала их нужно удалить
влажным тампоном, так как при промывании глаз они могут поранить слизистую
оболочку и вызвать дополнительную травму.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.11.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При попадании
кислоты или щелочи в пищевод необходимо срочно вызвать врача. До его прихода
следует удалить слюну и слизь изо рта пострадавшего, уложить его и тепло
укрыть, а на живот для ослабления боли положить холод.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.12.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Если у
пострадавшего появились признаки удушья, необходимо делать ему искусственное
дыхание по способу «изо рта в нос», так как слизистая оболочка рта обожжена.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.13.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Нельзя
промывать желудок водой, вызывая рвоту, либо нейтрализовать попавшую в пищевод
кислоту или щелочь, уменьшая ее прижигающее действие. Хороший эффект оказывает
прием внутрь молока, яичного белка, растительного масла, растворенного
крахмала.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>7.4.14.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При
значительных ожогах кожи, а также при попадании кислоты или щелочи в глаза
пострадавшего после оказания первой помощи следует сразу же отправить в
лечебное учреждение.<o:p></o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ ОБМОРОЖЕНИИ<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>8.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Повреждение тканей в результате
воздействия низкой температуры называется обморожением. Причины обморожения
различны, и при соответствующих условиях (длительное воздействие холода, ветер,
повышенная влажность, тесная или мокрая обувь, неподвижное положение, плохое
общее состояние пострадавшего - болезнь, истощение, алкогольное опьянение,
кровопотери и т. д.) обморожение может наступить даже при температуре 3-7°С. Более
подвержены обморожению пальцы, кисти, стопы, уши, нос.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>8.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Первая помощь заключается в
немедленном согревании пострадавшего, особенно обмороженной части тела, для
чего пострадавшего надо как можно быстрее перевести в теплое помещение. Прежде
всего необходимо согреть обмороженную часть тела, восстановить в ней
кровообращение. Наиболее эффективно и безопасно это достигается, если
обмороженную конечность поместить в тепловую ванну с температурой 20°С. За 20 -
30 мин. температуру воды постепенно увеличивают до 40°С; при этом конечность
тщательно отмывают мылом от загрязнений.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>8.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>После ванны (согревания) поврежденные
участки надо высушить (протереть), закрыть стерильной повязкой и тепло укрыть.
Нельзя смазывать их жиром и мазями, так как это значительно затрудняет
последующую первичную обработку. Обмороженные участки тела нельзя растирать
снегом, так как при этом усиливается охлаждение, а льдинки ранят кожу, что
способствует инфицированию (заражению) зоны обморожения; нельзя растирать
обмороженные места также варежкой, суконкой, носовым платком.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>8.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Можно производить массаж чистыми
руками, начиная от периферии к туловищу.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>8.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>При обморожении ограниченных участков
тела (нос, уши) их можно согреть с помощью тепла рук оказывающего первую помощь.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>8.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Большое значение при оказании первой
помощи имеют мероприятия по общему согреванию пострадавшего. Ему дают горячий
кофе, чай, молоко.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>8.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Быстрейшая доставка пострадавшего в
медицинское учреждение является также первой помощью. Если первая помощь не
была оказана до прибытия санитарного транспорта, то ее следует оказать в машине
во время транспортировки пострадавшего. При транспортировке следует принять все
меры к предотвращению его повторного охлаждения.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:0cm;
line-height:115%;background:transparent'><span style='font-size:12.0pt;
line-height:115%'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>9.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ ПЕРЕЛОМАХ, ВЫВИХАХ,<span
style='mso-spacerun:yes'>                                                              
</span>УШИБАХ И РАСТЯЖЕНИИ СВЯЗОК<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>При переломах, вывихах, растяжении
связок и других травмах пострадавший испытывает острую боль, резко усиливающуюся
при попытке изменить положение поврежденной части тела. Иногда сразу бросается
в глаза неестественное положение конечности и искривление ее (при переломе) в
необычном месте.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Самым главным моментом в оказании
первой помощи как при открытом переломе (после остановки кровотечения и наложения
стерильной повязки), так и при закрытом является иммобилизация (создание покоя)
поврежденной конечности. Это значительно уменьшает боль и предотвращает
дальнейшее смещение костных осколков. Для иммобилизации используются готовые
шины, а также палка, доска, линейка, кусок фанеры и т, п.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>При закрытом переломе не следует
снимать с пострадавшего одежду - шину нужно накладывать поверх нее.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>К месту травмы необходимо
прикладывать холод (резиновый пузырь со льдом, снегом, холодной водой, холодные
примочки и т. п.) для уменьшения боли.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Повреждение головы.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.5.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При падении,
ударе возможны переломы черепа (признаки: кровотечение из ушей и рта,
бессознательное состояние) или сотрясение мозга (признаки: головная боль,
тошнота, рвота, потеря сознания).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.5.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Первая помощь
при этом состоит в следующем:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>пострадавшего необходимо уложить на
спину, на голову наложить тугую повязку (при наличии раны стерильную) и
положить холод, обеспечить полный покой до прибытия врача.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.5.3.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>У
пострадавшего, находящегося в бессознательном состоянии, может быть рвота. В
этом случае следует повернуть его голову на левую сторону. Может наступить
также удушье вследствие западания языка. В такой ситуации необходимо выдвинуть
нижнюю челюсть пострадавшего вперед и поддерживать ее в таком же положении, как
при проведении искусственного дыхания.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Повреждение позвоночника. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.6.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Признаки:
резкая боль в позвоночнике, невозможность согнуть спину и повернуться.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.6.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Первая помощь
должна сводиться к следующему:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>осторожно, не поднимая пострадавшего,
подсунуть под его спину широкую доску, дверь, снятую с петель, или повернуть
пострадавшего лицом вниз и следить, чтобы при переворачивании его туловище не
прогибалось во избежание повреждения спинного мозга. Транспортировать на доске
лицом вниз.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Перелом костей таза. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.7.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Признаки: боль
при ощупывании таза, боль в паху, в области крестца, невозможность поднять
выпрямленную ногу.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.7.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Помощь
заключается в следующем: <o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:
Symbol'><span style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>под
спину пострадавшего необходимо подсунуть широкую доску, уложить его в положение
«лягушка», т. е. согнуть его ноги в коленях и развести в стороны, а стопы
сдвинуть вместе, под колени подложить валик из одежды. Нельзя поворачивать
пострадавшего на бок, сажать и ставить на ноги (во избежание повреждения
внутренних органов).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Перелом и вывих ключицы. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>9.8.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Признаки: боль в области ключицы, усиливающаяся при
попытке движения плечевым суставом, явно выраженная припухлость. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>9.8.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Первая помощь такова: <o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l20 level2 lfo24;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:
Symbol'><span style='mso-list:Ignore'>·<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>положить
в подмышечную впадину с поврежденной стороны небольшой комок ваты, прибинтовать
к туловищу руку, согнутую в локте под прямым углом, подвесить руку к шее
косынкой или бинтом. Бинтовать следует от больной руки на спину.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.9.<span style='font:7.0pt \"Times New Roman\"'>&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>Перелом и вывих костей конечности.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.9.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Признаки: боль
в кости, неестественная форма конечности, подвижность на месте, где нет
сустава, искривление (при наличии перелома со смещением костных отломков) и
припухлость.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.9.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Для оказания
первой помощи несущественно, перелом или вывих у пострадавшего, так как во всех
случаях необходимо обеспечить полную неподвижность поврежденной конечности.
Нельзя пытаться самим вправить вывих, сделать это может только врач. Наиболее
спокойное положение конечности или другой части тела необходимо создать также
во время доставки пострадавшего в лечебное учреждение,<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.9.3.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При наложении
шины следует обеспечить неподвижность, по крайней мере, двух суставов - одного
выше, другого ниже места перелома, а при переломе крупных костей - даже трех.
Центр шины должен находиться у места перелома. Шинная повязка не должна
сдавливать крупные сосуды, нервы и выступы костей. Лучше обернуть шину мягкой
тканью и обмотать бинтом. Фиксируют шину бинтом, косынкой поясным ремнем и т.
п. При отсутствии шины следует прибинтовать поврежденную верхнюю конечность к
туловищу, а поврежденную нижнюю конечность - к здоровой.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.9.4.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При переломе и
вывихе плечевой кости шины надо накладывать на согнутую в локтевом суставе
руку. При повреждении верхней части шина должна захватывать два сустава - плечевой
и локтевой, а при переломе нижнего конца плечевой кости - лучезапястный на
косынке или бинте к шее.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.9.5.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При переломе и
вывихе предплечья шину (шириной с ладонь) следует накладывать от локтевого
сустава до кончиков пальцев, вложив в ладонь пострадавшего плотный комок из
ваты, бинта, который пострадавший как бы держит в кулаке. При отсутствии шин
руку можно подвесить на косынке к шее или на поле пиджака. Если рука (при
вывихе) отстает от туловища, между рукой и туловищем следует положить что-либо,
мягкое (например, сверток из одежды).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.9.6.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При переломе и
вывихе костей кисти и пальцев рук кисть следует прибинтовать к широкой (шириной
с ладонь) шине так, чтобы она начиналась с середины предплечья, а кончалась у
конца пальцев. В ладонь поврежденной руки предварительно должен быть вложен
комок ваты, бинт и т. п., чтобы пальцы были несколько согнуты. Руку подвесить
на косынке или бинте к шее.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.9.7.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При переломе
или вывихе бедренной кости нужно укрепить больную ногу шиной с наружной стороны
так, чтобы один конец шины доходил до подмышки, а другой достигал пятки. Вторую
шину накладывают на внутреннюю поверхность поврежденной ноги от промежности до
пятки. Этим достигается полный покой всей нижней конечности. Шины следует
накладывать по возможности не приподнимая ногу, а придерживая ее на месте, и
прибинтовать в нескольких местах (к туловищу, бедру, голени), но не рядом и не
в месте перелома. Проталкивать бинт под поясницу, колено и пятку нужно
палочкой.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:63.8pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>9.9.8.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При переломе
или вывихе кистей голени фиксируются коленный и голеностопный суставы.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.10.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Перелом
ребер. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>9.10.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Признаки: боль при дыхании, кашле и движении. При
оказании помощи необходимо туго забинтовать грудь или стянуть ее полотенцем во
время выдоха.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:14.2pt;line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.11.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Ушибы.
<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>9.11.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Признаки: припухлость, боль при прикосновении к месту
ушиба. К месту ушиба нужно приложить холод, а затем наложить тугую повязку. Не
следует смазывать ушибленное место настойкой йода, растирать и накладывать
согревающий компресс, так как это лишь усиливает боль.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:14.2pt;line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>9.12.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Сдавливание
тяжестью.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>9.12.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>После освобождения пострадавшего из-под тяжести
необходимо туго забинтовать и приподнять поврежденную конечность, подложив под
нее валик из одежды. Поверх бинта положить холод для уменьшения всасывания
токсических веществ, образующихся при распаде поврежденных тканей. При переломе
конечности следует наложить шину.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>9.12.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Если у пострадавшего отсутствуют дыхание и пульс, необходимо
сразу же начать делать искусственное дыхание и массаж сердца.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>9.12.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Растяжение связок чаще всего бывает в голеностоп­ном и
лучезапястном суставах. Признаки: резкая боль в суставе, припухлость. Помощь
заключается в тугом бинтовании, обеспечении покоя поврежденного участка,
прикладывании холода. Поврежденная нога должна быть приподнята, поврежденная
рука - подвешена на косынке.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
133%'><span style='font-size:12.0pt;line-height:133%;font-family:\"Times New Roman\",serif;
layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:0cm;margin-left:36.0pt;margin-bottom:.0001pt;text-align:center;
text-indent:-18.0pt;line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>10.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ ПОПАДАНИИ ИНОРОДНЫХ ТЕЛ В ГЛАЗ<o:p></o:p></span></b></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:6.0pt;margin-left:36.0pt;text-align:center;text-indent:0cm;
line-height:115%;background:transparent'><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ИЛИ ПОД КОЖУ<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>10.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
попадании инородного тела под кожу (или под ноготь) удалять его можно лишь в
том случае, если есть уверенность, что это можно сделать легко и полностью. При
малейшем затруднении следует обратиться к врачу. После удаления инородного тела
необходимо смазать место ранения настойкой йода и наложить повязку.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>10.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Инородные
тела, попавшие в глаз, лучше всего удалять промыванием струёй воды из стакана,
с ватки или марли, с помощью питьевого фонтанчика, направляя струю от наружного
угла глаза (от виска) к внутреннему (к носу). Тереть глаз не следует.<o:p></o:p></span></p>

<p class=MsoNormal style='text-indent:42.55pt;line-height:133%'><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
133%;font-family:\"Times New Roman\",serif;layout-grid-mode:line'><o:p>&nbsp;</o:p></span></b></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>11.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ ОБМОРОКЕ. <span
style='mso-spacerun:yes'>                                                                                </span>ТЕПЛОВОМ
И СОЛНЕЧНЫХ УДАРАХ И ОТРАВЛЕНИЯХ<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>11.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>В
предобморочном состоянии (жалобы на головокружение, тошноту, стеснение в груди,
недостаток воздуха, потемнение в глазах) пострадавшего следует уложить, опустив
голову несколько ниже туловища, так как при обмороке происходит внезапный отлив
крови от мозга. Необходимо расстегнуть одежду пострадавшего, стесняющую
дыхание, обеспечить приток свежего воздуха, дать ему выпить холодной воды,
давать нюхать нашатырный спирт. Класть на голову холодные примочки и лед не
следует. Лицо и грудь можно смочить холодной водой. Так же следует поступать,
если обморок уже наступил.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>11.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
тепловом и солнечном ударах происходит прилив крови к мозгу, в результате чего
пострадавший чувствует внезапную слабость, головную боль, возникает рвота, его
дыхание становится поверхностным. Помощь заключается в следующем: пострадавшего
необходимо вывести или вынести из жаркого помещения или удалить с солнцепека в тень,
прохладное помещение, обеспечив приток свежего воздуха. Его следует уложить
так, чтобы голова была выше туловища, расстегнуть одежду, стесняющую дыхание,
положить на голову лед или делать холодные примочки, смочить грудь холодной
водой, давать нюхать нашатырный спирт. Если пострадавший в сознании, нужно дать
ему выпить 15-20 капель настойки валерианы на одну треть стакана воды.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>11.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
дыхание прекратилось или очень слабое и пульс не прощупывается, необходимо
сразу же начать делать искусственное дыхание и массаж сердца и срочно вызвать
врача.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>11.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
отравлении газами, в том числе: угарным, ацетиленом, природным газом, парами бензина
и т. п., появляются головная боль, «стук в висках», «звон в ушах», общая
слабость, головокружение, усиленное сердцебиение, тошнота и рвота.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>11.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
сильном отравлении наступают сонливость, апатия, безразличие, а при очень
сильном отравлении - возбужденное состояние с беспорядочными движениями, потеря
и задержка дыхания, расширение зрачков.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>11.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
всех отравлениях следует немедленно вывести или вынести пострадавшего из
отравленной зоны, расстегнуть одежду, стесняющую дыхание, обеспечить приток свежего
воздуха, уложить его, приподнять ноги, укрыть потеплее, давать нюхать
нашатырный спирт.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>11.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>У
пострадавшего, находящегося в бессознательном состоянии, может быть рвота,
поэтому необходимо повернуть голову в сторону.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;tab-stops:42.55pt;background:transparent'><span
style='font-size:12.0pt;line-height:115%'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>12.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ СПАСЕНИИ УТОПАЮЩЕГО<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Основное
правило при спасении утопающего - действовать обдуманно, спокойно и осторожно.
Прежде всего, при виде утопающего следует быстро разобраться в обстановке. Во
всех случаях надо попытаться сообщить утопающему, что его положение замечено и
ему оказывается помощь. Это ободряет и придает силы пострадавшему.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
возможно, то нужно подать утопающему или уставшему при плавании шест или конец
одежды, с помощью которых подтянуть его к берегу, лодке, или же бросить ему
подручный плавающий спасательный предмет, либо специальную спасательную принадлежность.
Бросать спасательный предмет следует так, чтобы не ударить утопающего. Если
этих предметов нет или применение их не обеспечивает спасение утопающего или
уставшего человека, необходимо плыть к нему на помощь.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Оказывающий
помощь должен сам не только хорошо плавать, но и знать приемы транспортировки
пострадавшего, уметь освобождаться от его захватов, делать искусственное
дыхание и наружный массаж сердца.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
массовых несчастных случаях нужно стараться помочь каждому утопающему в отдельности.
Спасать вплавь одновременно нескольких человек невозможно.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
необходимости немедленно прыгнуть в воду для оказания помощи утопающему следует
снять одежду и обувь. Прыгать с берега в местах, где неизвестны грунт и
глубина, следует ногами вперед. Место для прыжка выбирать так, чтобы использовать
силу течения.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
падении в воду в одежде на большом расстоянии от берега нужно стараться снять
как можно больше одежды и обувь.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
низкой температуре воды или от переутомления могут наступить судороги в
икроножных, бедренных мышцах или мышцах пальцев. При судорогах в икрах
рекомендуется, плывя на спине, вынуть из воды ногу, которую свела судорога, и
потянуть на себя пальцы. При судороге мышц бедра помогает сильное сгибание ноги
в колене, причем следует прижимать ступню руками к тыльной стороне бедра, при
судороге мышц пальцев руки нужно сжать руку в кулак и, вытянув ее из воды,
сильно встряхнуть.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Помощь
уставшему при плавании человеку можно оказать следующим образом: оказывающий
помощь должен подставить свои плечи под кисти вытянутых рук уставшего человека
и транспортировать его, плывя стилем «брасс». Хорошо, если уставший человек
сможет грести ногами в такт движениям оказывающего помощь. Необходимо следить,
чтобы руки уставшего не соскользнули с плеч оказывающего помощь.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.9.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Помощь
утопающему необходимо оказать сзади, защищаясь, от его захвата. Для
освобождения от захватов утопающего есть несколько приемов:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>если утопающий охватил оказывающего
помощь за туловище или за шею спереди, нужно, одной рукой удерживая его за поясницу,
ладонью другой руки упереться в подбородок утопающему, пальцами зажать ему нос
и сильно толкнуть в подбородок. В крайнем случае, оказывающему помощь нужно
упереться коленом в низ живота утопающему и с силой оттолкнуться от него;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>если утопающий схватил оказывающего
помощь за шею сзади, нужно одной рукой захватить кисть руки утопающего, а
другой - подтолкнуть локоть этой руки. Затем оказывающий помощь должен резко
перебросить руку утопающего через свою голову и, не освобождая руки, повернуть
утопающего к себе спиной и буксировать его к берегу;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>если утопающий схватил оказывающего
помощь за кисти рук, нужно сжать их в кулаки и сделать сильный рывок наружу, одновременно
подтянув ноги к животу, упереться в грудь утопающего и оттолкнуться от него;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>если утопающий схватил оказывающего
помощь за ногу, то для освобождения нужно одной рукой прижать его голову к
себе, а другой захватить его подбородок и повернуть от себя.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.10.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
сзади подплыть к утопающему не удается, следует в нескольких метрах от него
нырнуть и, подплыв сбоку, одной рукой оттолкнуть его колено, а другой захватить
ногу, рывком за эту ногу повернуть его спиной к себе и буксировать к берегу.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.11.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
пострадавший лежит на дне водоема лицом вверх, оказывающий помощь должен нырнуть
и подняться к нему со стороны головы; если он лежит лицом вниз - подплыть к
нему со стороны ног. И в этом, и в другом случае оказывающий помощь должен
взять пострадавшего под мышки, приподнять, затем сильно оттолкнуться ногами от
грунта, всплыть с ним на поверхность и буксировать к берегу.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.12.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Буксировать
утопающего можно несколькими способами:<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>способ «за голову». Для этого
оказывающий помощь дол­жен перевести утопающего в положение на спину;
поддерживая его в таком положении, обхватить его лицо ладонями - большими<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>пальцами за щеки, а мизинцами - под
нижнюю челюсть, закрывая уши и держа лицо над водой. Плыть нужно на спине;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>способ &quot;за руки». Для этого
оказывающий помощь должен подплыть к утопающему сзади, стянуть его локти назад
за спину и прижимая к себе, плыть к берегу вольным стилем;<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l20 level2 lfo24;tab-stops:1.0cm;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>·<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%'>способ «под руки». Для этого
оказывающий помощь должен подплыть к утопающему сзади, быстро подсунуть свою
правую (ле­вую) под его правую (левую) руку и взять утопающего за другую руку
выше локтя. Затем следует прижать утопающего к себе и плыть к берегу на боку.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.13.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Для
буксировки пострадавшего, находящегося без сознания, оказывающий помощь должен
плыть на боку и тянуть пострадавшего за волосы или воротник одежды.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.14.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
всех способах буксировки утопающего необходимо, чтобы его нос и рот находились
над поверхностью воды.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.15.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
спасении утопающего с лодки ее следует подводить к нему кормой или носом, но не
бортом, брать утопающего в лодку всегда с кормы или носа, так как при
вытаскивании через борт лодка может опрокинуться. Не всегда следует брать
утопающего в лодку, если второй человек, оказывающий помощь, может удержать его
с кормы.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.16.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
в лодке находится только один человек, лучше не прыгать в воду, так как
неуправляемую лодку легко может отнести. Отправляясь на лодке спасать утопающего
без специальных спасательных принадлежностей, следует захватить с собой шест,
палку и т. п., чтобы подать утопающему, если он не потерял сознание.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.17.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Помощь
пострадавшему должна быть оказана сразу же после того, как его извлекли из
воды. Если пострадавший находится в бессознательном состоянии (бледен, пульс
едва прощупывается или отсутствует, дыхание отсутствует или очень слабое),
следует немедленно приступить к его оживлению и одновременно послать за врачом.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.18.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Если
есть необходимость, прежде чем начать искусственное дыхание нужно открыть рот и
очистить его от ила, песка, водорослей и слизи платком или рубашкой. Затем
необходимо приступить к проведению искусственного дыхания. Тратить время на
удаление воды из нижних дыхательных путей не следует. Если у пострадавшего нет
пульса на сонной артерии и расширены зрачки, необходимо сразу же начать
наружный массаж сердца. Искусственное дыхание и наружный массаж сердца нужно
делать до появления у пострадавшего устойчивого самостоятельного дыхания или до
передачи его медицинскому персоналу. При наличии помощников они в это время
должны растирать и согревать тело пострадавшего. Для опорожнения растянутого
желудка от воды и воздуха пострадавшего следует уложить на бок и надавить ему
на верхнюю часть живота или, положив его вниз лицом и обхватив туловище руками
в области живота, поднимать вверх, выдавливая воду («складывая» пострадавшего).
Эти мероприятия нужно вы­полнять быстро.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>12.19.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Когда
пострадавший начнет дышать, ему необходимо давать нюхать нашатырный спирт, дать
выпить 15-20 капель настойки валерианы (на полстакана воды), переодеть в сухое
белье, укрыть потеплее, дать крепкого чая и предоставить полный покой до
прибытия медицинского персонала.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:14.2pt;margin-bottom:.0001pt;text-align:justify;text-indent:
0cm;line-height:115%;tab-stops:49.65pt;background:transparent'><span
style='font-size:12.0pt;line-height:115%'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>13.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ УКУСАХ ЖИВОТНЫХ<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>13.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
всяком укусе, даже если укусившее животное на вид совершенно здорово,
необходимо кожу вокруг раны и царапин, на­несенных животным, смазать настойкой
йода и наложить стерильную повязку. Пострадавшего следует направить в лечебное
учреждение для проведения курса прививок против бешенства.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>13.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>К
врачу можно направить и лиц, которым слюна бешеного жи­вотного попала на кожу,
в нос, в глаза или рот.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>13.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Укусы
змей и ядовитых насекомых.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:70.9pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>13.3.1.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>При укусе
ядовитых змей и насекомых появляются головокружение, рвота, тошнота, сухость и
горький вкус во рту, учащенный пульс, сердцебиение, одышка и сонливость. В
особо тяжелых случаях могут отмечаться судороги, потеря сознания и остановка
дыхания.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:70.9pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>13.3.2.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>В местах укуса
возникает жгучая боль, кожа краснеет, отекает. Помощь при укусах заключается в
следующем. Пострадавшего необходимо уложить, чтобы замедлить распространение
яда. Укушенной руке или ноге необходимо создать покой, прибинтовать к ней шину,
доску, палку и т. п., а если таких предметов не окажется, можно прибинтовать
руку к туловищу, а ногу - к другой, здоровой ноге. Поскольку отек вокруг места
укуса будет увеличиваться, повязку необходимо время от времени ослаблять, чтобы
она не врезалась в тело. Только при укусе кобры в первые минуты следует
наложить жгут или закрутку выше места укуса.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:70.9pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>13.3.3.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Пострадавшему
следует дать большое количество питья (лучше горячего чая), 15-20 капель
настойки валерианы на полстакана воды.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:1.0cm;
line-height:115%;mso-list:l21 level3 lfo15;tab-stops:70.9pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\";
layout-grid-mode:line'><span style='mso-list:Ignore'>13.3.4.<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:12.0pt;line-height:115%;layout-grid-mode:line'>Ни в коем
случае нельзя прижигать место укуса, делать разрезы, перетягивать пораженную
руку или ногу жгутом, давать пострадавшему алкоголь, отсасывать яд из раны и т.
п. Пострадавшего необходимо отправить в лечебное учреждение. Нести и везти его
нужно в положении лежа.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:78.55pt;margin-bottom:.0001pt;text-align:justify;text-indent:
0cm;line-height:115%;background:transparent'><span style='font-size:12.0pt;
line-height:115%;layout-grid-mode:line'><o:p>&nbsp;</o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>14.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРВАЯ ПОМОЩЬ ПРИ ПОПАДАНИИ ИНОРОДНОГО ТЕЛА <span
style='mso-spacerun:yes'>                                                          </span>В
ДЫХАТЕЛЬНОЕ ГОРЛО</span></b><span style='font-size:12.0pt;line-height:115%;
font-style:normal;mso-bidi-font-style:italic'><o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>14.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
попадании инородного тела (например, куска пищи) в дыхательное горло пострадавшего,
у которого имеются признаки удушья, но сознание сохранено, необходимо как можно
быстрее обратиться за помощью к врачу. Какие-либо сжатия или удары в
межлопаточную область опасны из-за возможности возникновения полной закупорки
дыхательных путей. Удаление инородного тела при частичной закупорке дыхательного
горла возможно при кашле или сплевывании.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>14.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
установлении факта попадания инородного тела в дыхательное горло пострадавшего,
находящегося в сознании или без него, при резко выраженной синюшности лица,
неэффективности кашля и полной закупорке (при этом кашель отсутствует) любая
процедура, которая может показаться эффективной, всегда оправдана, так как
является «актом отчаяния». При этом пострадавшему наносят три-пять коротких
ударов кистью в межлопаточную область при наклоненной вперед голове или в
положении лежа на животе. Если это не поможет, охватывают стоящего пострадавшего
сзади так, чтобы кисти оказывающего помощь сцепились в области между мечевидным
отростком и пупком и производят несколько (три-пять) быстрых надавливаний на
живот пострадавшего. Можно выполнять подобную процедуру и в положении пострадавшего
лежа на спине: располагая ладони кистей между пупком и мечевидным отростком,
энергично надавливают (3-5 раз) на живот.<o:p></o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>15.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>ПЕРЕНОСКА И ПЕРЕВОЗКА ПОСТРАДАВШЕГО<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
несчастном случае необходимо не только немедленно оказать пострадавшему первую
помощь, но быстро и правильно доставить его в ближайшее лечебное учреждение.
Нарушение правил переноски и перевозки пострадавшего может принести ему
непоправимый вред.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
поднимании, переноске и перевозке пострадавшего нужно следить, чтобы он
находился в удобном положении и не трясти его. При переноске на руках
оказывающие помощь должны идти не в ногу. Поднимать и класть пострадавшего на
носилки необходимо согласованно, лучше по команде. Брать пострадавшего нужно со
здоровой стороны, при этом оказывающие помощь должны стоять на одном и том же
колене и так подсовывать руки под голову, спину, ноги и ягодицы, чтобы пальцы
показывались с другой стороны пострадавшего. Надо стараться приподнять его с
земли, чтобы кто-либо поставил носилки под него. Это важно при переломах, в
этих случаях необходимо, чтобы кто-нибудь поддерживал место перелома.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Для
переноски пострадавшего с поврежденным поз­воночником на полотнище носилок
необходимо положить доску, а поверх нее одежду, пострадавший должен лежать на
спине. При отсутствии доски пострадавшего необходимо класть на носилки на
живот.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
переломе нижней челюсти, если пострадавший задыхается, нужно класть его лицом
вниз.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
травме живота пострадавшего следует положить на спину, согнув его ноги в
коленях. Под колени нужно подложить валик из одежды.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Пострадавшего
с повреждением грудной клетки следует переносить в полусидячем положении,
положив ему под спину одежду.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>По
ровному месту пострадавшего нужно нести ногами вперед, при подъеме в гору или
по лестнице - головой вперед. Чтобы не придавать носилкам наклонного положения,
оказывающие помощь, находящиеся ниже, должны приподнять носилки.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Чтобы
предупредить толчки и не качать носилки, оказывающие помощь должны идти не в
ногу с несколько согнутыми коленями, возможно меньше поднимая ноги. Во время
переноски на носилках следует наблюдать за пострадавшим, за состоянием
наложенных повязок и шин. При длительной переноске нужно менять положение
пострадавшего, поправлять его изголовье, подложенную одежду, утолять жажду (но
не при травме живота), защищать от непогоды и холода.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.9.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Снимая
пострадавшего с носилок, следует поступать так же, как и при укладывании на
носилки. При переноске носилок с пострадавшим на большие расстояния оказывающие
помощь должны нести их на лямках, привязанных к ручкам носилок, перекинув лямки
через шею.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:49.65pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>15.10.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>При
перевозке тяжело пострадавшего лучше положить его (не перекладывая) в повозку
или машину на тех же носилках, подстелив под них сено, траву. Везти
пострадавшего следует осторожно, избегая тряски.<o:p></o:p></span></p>

<p class=Bodytext50 align=center style='margin-top:12.0pt;margin-right:0cm;
margin-bottom:7.3pt;margin-left:36.0pt;text-align:center;text-indent:-18.0pt;
line-height:115%;mso-list:l21 level1 lfo15;background:transparent'><![if !supportLists]><b
style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;line-height:
115%;mso-fareast-font-family:\"Times New Roman\";font-style:normal;mso-bidi-font-style:
italic'><span style='mso-list:Ignore'>16.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;
</span></span></span></b><![endif]><b style='mso-bidi-font-weight:normal'><span
style='font-size:12.0pt;line-height:115%;font-style:normal;mso-bidi-font-style:
italic'>СПОСОБЫ ОЖИВЛЕНИЯ ОРГАНИЗМА ПРИ КЛИНИЧЕСКОЙ СМЕРТИ<o:p></o:p></span></b></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>16.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Искусственное
дыхание.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Искусственное дыхание производится в тех случаях, когда
пострадавший не дышит или дышит очень плохо (редко, судорожно, как бы со
всхлипыванием), а также, если его дыхание постоянно ухудшается независимо от
того, чем это вызвано: поражением электрическим током, отравлением, утоплением
и т. д.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Наиболее эффективным способом искусственного дыхания
является способ &quot;изо рта в рот» или «изо рта в нос», так как при этом
обеспечивается поступление достаточного объема воздуха в легкие пострадавшего.
Способ «изо рта в рот» или «изо рта в нос» относится к способам искусственного
дыхания по методу вдувания, при котором выдыхаемый оказывающим помощь воздух
насильно подается в дыхательные пути пострадавшего. Установлено, что выдыхаемый
человеком воздух физиологически пригоден для дыхания пострадавшего в течение
длительного времени. Вдувание воздуха можно производить через марлю, платок,
специальное приспособление - «воздуховод».<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Этот способ искусственного дыхания позволяет легко
контролировать поступление воздуха в легкие пострадавшего по расширению грудной
клетки после вдувания и последующему сжиманию ее в результате пассивного
выдоха. <o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Для проведения искусственного дыхания пострадавшего
следует уложить на спину, расстегнуть стесняющую дыхание одежду.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Прежде чем начать искусственное дыхание, необходимо, в
первую очередь, обеспечить проходимость верхних дыхательных путей, которые в
положении на спине при бессознательном состоянии всегда закрыты запавшим
языком. Кроме того, в полости рта может находиться инородное содержимое
(рвотные массы, соскользнувшие протезы, песок, ил, трава, если человек тонул, и
т. д.), которое необходимо удалить пальцем, обернутым платком (тканью или
бинтом). После этого оказывающий помощь располагается сбоку от головы
пострадавшего, а ладонью другой руки надавливает на его лоб, максимально
запрокидывая голову. При этом корень языка поднимается и освобождается вход в
гортань, а рот пострадавшего открывается. Оказывающий помощь наклоняется к лицу
пострадавшего, делает глубокий вдох открытым ртом, полностью плотно охватывает
губами открытый рот пострадавшего и делает энергичный выдох, с некоторым
усилием вдувая воздух в его рот; одновременно он закрывает нос пострадавшего
щекой или пальцами руки, находящейся на лбу. При этом надо наблюдать за грудной
клеткой пострадавшего, которая поднимается. Как только грудная стенка
поднялась, нагнетание воздуха приостанавливают, оказывающий помощь поворачивает
лицо в сторону, происходит пассивный выдох у пострадавшего.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Если у пострадавшего легко определяется пульс и
необходимо только проводить искусственное дыхание, то интервал между
искусственными вдохами должен составлять 5 сек. (12 дыхательных циклов в
минуту).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Кроме расширения грудной клетки, хорошим показателем
эффективности искусственного дыхания может служить порозовение кожных, покровов
и слизистых, а также выход больного из бессознательного состояния и появление у
него самостоятельного дыхания.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>При проведении искусственного дыхания оказывающий помощь
должен следить за тем, чтобы воздух не попал в желудок пострадавшего. При
попадании воздуха в желудок, о чем свидетельствует вздутие живота &quot;под
ложечкой», осторожно надавливают ладонью на живот между грудиной и пупком. При
этом может возникнуть рвота, тогда необходимо повернуть голову и плечи
пострадавшего набок, чтобы очистить его рот и глотку.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.9.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Если после вдувания воздуха грудная клетка не расправляется,
необходимо выдвинуть нижнюю челюсть пострадавшего вперед. Для этого четырьмя
пальцами обеих рук захватывают нижнюю челюсть сзади за углы и, опираясь
большими пальцами в ее край ниже углов рта, оттягивают и выдвигают челюсть
вперед так, чтобы нижние зубы стояли впереди верхних.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.10.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Если челюсти пострадавшего плотно стиснуты и открыт рот
не удается, следует проводить искусственное дыхание «изо рта в нос».<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.11.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>При отсутствии самостоятельного дыхания и наличии пульса
искусственное дыхание можно выполнять и в положении сидя или вертикальном, если
несчастный случай произошел в люльке, на опоре или мачте. При этом как можно больше
запрокидывают голову пострадавшего назад или выдвигают нижнюю челюсть.
Остальные приемы те же.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.12.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Маленьким детям вдувают воздух одновременно в рот и в
нос, охватывая своим ртом и нос ребенка. Чем меньше ребенок, тем меньше ему
нужно воздуха для вдоха и тем чаще следует производить вдувание по сравнению со
взрослым человеком (до 15 - 18 раз в минуту). Поэтому вдувание должно быть не
полным и менее резким, чтобы не повредить дыхательные пути пострадавшего.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.1.13.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Прекращают искусственное дыхание после восстановления у
пострадавшего достаточно глубокого и ритмичного самостоятельного дыхания.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>16.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>В
случае отсутствия не только дыхания, но и пульса на сонной артерии, делают
подряд два искусственных вдоха и приступают к наружному массажу сердца.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin-top:0cm;margin-right:1.0pt;margin-bottom:
0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:14.2pt;
line-height:115%;mso-list:l21 level2 lfo15;tab-stops:42.55pt;background:transparent'><![if !supportLists]><span
style='font-size:12.0pt;line-height:115%;mso-fareast-font-family:\"Times New Roman\"'><span
style='mso-list:Ignore'>16.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%'>Наружный
массаж сердца.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>При поражении электрическим током может наступить не
только остановка дыхания, но и прекратиться кровообращение, когда сердце не
обеспечивает циркуляцию крови по сосудам. В этом случае одного искусственного
дыхания при оказании помощи недостаточно, так как кислород из легких не может
переноситься кровью к другим органам и тканям, необходимо возобновить
кровообращение искусственным путем.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.2.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Сердце у человека расположено в грудной клетке между грудиной
и позвоночником. Грудина - подвижная плоская кость. В положении человека на
спине на твердой поверхности позвоночник является жестким неподвижным
основанием. Если надавливать на грудину, то сердце будет сжиматься между
грудиной и позвоночником, и из его полостей кровь будет выжиматься в сосуды.
Если надавливать на грудину толчкообразными движениями, то кровь будет
выталкиваться из полостей сердца почти также, как это происходит при его естественном
сокращении. Это называется наружным (непрямым, закрытым) массажем сердца, при
котором искусственно восстанавливается кровообращение. Таким образом, при
сочетании искусственного дыхания с наружным массажем сердца имитируются функции
дыхания и кровообращения.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.3.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Комплекс этих мероприятий называется реанимацией (т.е.
оживлением), а мероприятия - реанимационными.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.4.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Показанием к проведению реанимационных мероприятий
является остановка сердечной деятельности, для которой характерно сочетание
следующих признаков: появление бледности или синюшности кожных покровов, потеря
сознания, отсутствие пульса на сонной артерии, прекращение дыхания или
судорожные неправильные вдохи. При остановке сердца, не теряя ни секунды,
пострадавшего надо уложить на ровное жесткое основание: скамью, пол, в крайнем
случае, положить под спину доску (никаких ва­ликов под плечи и шею подкладывать
нельзя).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.5.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Если помощь оказывает один человек, он располагается
сбоку от пострадавшего и, наклонившись, делает два быстрых энергичных вдувания
(по способу «изо рта в рот» или «изо рта в нос»), затем поднимается, оставаясь
на той же стороне от пострадавшего, ладонь одной руки кладет на нижнюю половину
грудины (отступив на два пальца выше от ее нижнего края), а пальцы приподнимает.
Ладонь второй руки кладет поверх первой поперек или вдоль и надавливает,
помогая наклоном своего корпуса. Руки при надавливании должны быть выпрямлены в
локтевых суставах.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.6.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Надавливание следует производить быстрыми толчками, так,
чтобы смещать грудину на 4-5 см, продолжительность надавливания не более 0,5 с.
интервал между отдельными надавливаниями 0,5 с.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.7.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>В паузах руки с грудины не снимают.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.8.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Если оживление проводит один человек, то на каждые два
вдувания он производит 15 надавливаний на грудину. За 1 мин. необходимо сделать
не менее 60 надавливаний и 12 вдуваний, т. е. выполнить 72 манипуляции, поэтому
темп реанимационных меро­приятий должен быть высоким. Опыт показывает, что
наибольшее количество времени теряется при выполнении искусственного дыхания:
нельзя затягивать вдувание - как только грудная клетка пострадавшего
расширилась, вдувание прекращают.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.9.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>При участии в реанимации двух человек соотношение
«дыхание — массаж» составляет 1:5. Во время искусственного вдоха пострадавшего
тот, кто делает массаж сердца, надавливание не производит, так как усилия,
развиваемые при надавливании, значительно больше, чем при вдувании
(надавливание при вдувании приводит к безрезультатности искусственного дыхания,
а следовательно, реанимационных мероприятий).<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.10.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Если реанимационные мероприятия проводятся правильно,
кожные покровы розовеют, зрачки сужаются, самостоятельное дыхание
восстанавливается. Пульс на сонной артерии во время массажа должен хорошо
прощупываться, если его определяет другой человек. После того, как восстановится
сердечная деятельность и будет хорошо определяться пульс, массаж сердца немедленно
прекращают, продолжая искусственное дыхание при слабом дыхании пострадавшего и,
стараясь, чтобы естественный и искусственный вдохи совпадали. При восстановлении
полного самостоятельного дыхания искусственное дыхание также прекращают. Если
сердечная деятельность или самостоятельное дыхание еще не восстановились, но
реанимационные мероприятия эффективны, то их можно прекратить только при передаче
пострадавшего в руки медицинского работника. При неэффективности искусственного
дыхания и закрытого массажа сердца (кожные покровы синюшно-фиолетовые, зрачки
широкие, пульс на артериях во время массажа не определяется) реанимацию
прекращают через 30 минут.<o:p></o:p></span></p>

<p class=MsoBodyText style='margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:1.0cm;line-height:115%;mso-list:l21 level3 lfo15;tab-stops:42.55pt;
background:transparent'><![if !supportLists]><span style='font-size:12.0pt;
line-height:115%;mso-fareast-font-family:\"Times New Roman\";layout-grid-mode:
line'><span style='mso-list:Ignore'>16.3.11.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:12.0pt;line-height:115%;
layout-grid-mode:line'>Реанимационные мероприятия у детей до 12 лет имеют
особенности. Детям от года до 12 лет массаж сердца производят одной рукой и в
минуту делают от 70 до 100 надавливаний в зависимости от возраста, детям до
года - от 100 до 120 надавливаний в минуту двумя пальцами (вторым и третьим) на
середину грудины. При проведении искусственного дыхания детям одновременно
охватывают рот и нос. Объем вдоха необходимо соразмерять с возрастом ребенка.
Новорожденному достаточно объема воздуха, находящегося в полости рта у
взрослого.<o:p></o:p></span></p>

</div>

</body>

</html>

";


$folder_name = $_SERVER['DOCUMENT_ROOT'].'/temp_downloads/'.md5($result_file);
if(!is_dir($folder_name)){
    mkdir($folder_name);
}

file_put_contents($folder_name.'/instructions_for_first_aid.doc', $result_file, FILE_APPEND);


$zip = new ZipArchive();
$filename = $folder_name."/instructions_for_first_aid.zip";

$zip->open($filename, ZipArchive::CREATE);

$zip->addFile($folder_name.'/instructions_for_first_aid.doc', 'instructions_for_first_aid.doc');
$zip->addFile($_SERVER['DOCUMENT_ROOT'].'/templates/simple_template/images/instructions_for_first_aid/image002.png', 'image002.png');
$zip->addFile($_SERVER['DOCUMENT_ROOT'].'/templates/simple_template/images/instructions_for_first_aid/image003.png', 'image003.png');

$zip->close();


$doc_download_url = '/temp_downloads/'.md5($result_file).'/instructions_for_first_aid.zip';
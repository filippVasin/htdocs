<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.02.2017
 * Time: 9:37
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
<title>УТВЕРЖДАЮ</title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Elena</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>root</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>346</o:TotalTime>
  <o:LastPrinted>2014-02-14T04:29:00Z</o:LastPrinted>
  <o:Created>2017-02-16T05:33:00Z</o:Created>
  <o:LastSaved>2017-02-16T05:33:00Z</o:LastSaved>
  <o:Pages>5</o:Pages>
  <o:Words>1632</o:Words>
  <o:Characters>9306</o:Characters>
  <o:Company>Home</o:Company>
  <o:Lines>77</o:Lines>
  <o:Paragraphs>21</o:Paragraphs>
  <o:CharactersWithSpaces>10917</o:CharactersWithSpaces>
  <o:Version>16.00</o:Version>
 </o:DocumentProperties>
 <o:OfficeDocumentSettings>
  <o:TargetScreenSize>800x600</o:TargetScreenSize>
 </o:OfficeDocumentSettings>
</xml><![endif]-->
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:SpellingState>Clean</w:SpellingState>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:DrawingGridHorizontalSpacing>6 пт</w:DrawingGridHorizontalSpacing>
  <w:DisplayHorizontalDrawingGridEvery>2</w:DisplayHorizontalDrawingGridEvery>
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
  DefSemiHidden=\"false\" DefQFormat=\"false\" LatentStyleCount=\"371\">
  <w:LsdException Locked=\"false\" QFormat=\"true\" Name=\"Normal\"/>
  <w:LsdException Locked=\"false\" QFormat=\"true\" Name=\"heading 1\"/>
  <w:LsdException Locked=\"false\" QFormat=\"true\" Name=\"heading 2\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   QFormat=\"true\" Name=\"heading 3\"/>
  <w:LsdException Locked=\"false\" QFormat=\"true\" Name=\"heading 4\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   QFormat=\"true\" Name=\"heading 5\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   QFormat=\"true\" Name=\"heading 6\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   QFormat=\"true\" Name=\"heading 7\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   QFormat=\"true\" Name=\"heading 8\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   QFormat=\"true\" Name=\"heading 9\"/>
  <w:LsdException Locked=\"false\" Priority=\"99\" Name=\"header\"/>
  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"
   QFormat=\"true\" Name=\"caption\"/>
  <w:LsdException Locked=\"false\" QFormat=\"true\" Name=\"Title\"/>
  <w:LsdException Locked=\"false\" QFormat=\"true\" Name=\"Subtitle\"/>
  <w:LsdException Locked=\"false\" QFormat=\"true\" Name=\"Strong\"/>
  <w:LsdException Locked=\"false\" Priority=\"20\" QFormat=\"true\" Name=\"Emphasis\"/>
  <w:LsdException Locked=\"false\" Priority=\"99\" Name=\"Plain Text\"/>
  <w:LsdException Locked=\"false\" Priority=\"99\" SemiHidden=\"true\"
   Name=\"Placeholder Text\"/>
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
  <w:LsdException Locked=\"false\" Priority=\"99\" SemiHidden=\"true\" Name=\"Revision\"/>
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
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";}
h2
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-next:Обычный;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:2;
	font-size:12.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Times New Roman\",serif;
	font-weight:normal;}
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
	mso-bidi-font-size:16.0pt;
	font-family:\"Times New Roman\",serif;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-link:\"Верхний колонтитул Знак\";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 233.85pt right 467.75pt;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";
	mso-ansi-language:X-NONE;
	mso-fareast-language:X-NONE;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 233.85pt right 467.75pt;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";}
p.MsoCaption, li.MsoCaption, div.MsoCaption
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-next:Обычный;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	text-indent:1.0cm;
	mso-pagination:none;
	text-autospace:none;
	font-size:12.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:\"Times New Roman\";
	font-weight:bold;}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{mso-style-unhide:no;
	mso-style-link:\"Основной текст Знак\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";
	mso-ansi-language:X-NONE;
	mso-fareast-language:X-NONE;}
p.MsoBodyTextIndent, li.MsoBodyTextIndent, div.MsoBodyTextIndent
	{mso-style-unhide:no;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:14.15pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";
	mso-ansi-language:EN-US;}
p.MsoBodyText2, li.MsoBodyText2, div.MsoBodyText2
	{mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:14.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";
	font-weight:bold;
	mso-bidi-font-weight:normal;}
p.MsoBodyTextIndent2, li.MsoBodyTextIndent2, div.MsoBodyTextIndent2
	{mso-style-unhide:no;
	mso-style-link:\"Основной текст с отступом 2 Знак\";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:14.15pt;
	line-height:200%;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";}
a:link, span.MsoHyperlink
	{mso-style-parent:\"\";
	color:blue;
	text-decoration:underline;
	text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
	{mso-style-unhide:no;
	color:#954F72;
	mso-themecolor:followedhyperlink;
	text-decoration:underline;
	text-underline:single;}
p.MsoDocumentMap, li.MsoDocumentMap, div.MsoDocumentMap
	{mso-style-noshow:yes;
	mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	background:navy;
	font-size:10.0pt;
	font-family:\"Tahoma\",sans-serif;
	mso-fareast-font-family:\"Times New Roman\";}
p.MsoPlainText, li.MsoPlainText, div.MsoPlainText
	{mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-link:\"Текст Знак\";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:\"Courier New\";
	mso-fareast-font-family:\"Times New Roman\";
	mso-bidi-font-family:\"Times New Roman\";}
p.MsoNoSpacing, li.MsoNoSpacing, div.MsoNoSpacing
	{mso-style-priority:1;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:\"\";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:\"Calibri\",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:\"Times New Roman\";
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
	mso-pagination:widow-orphan;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:14.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";
	color:black;}
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
	mso-pagination:widow-orphan;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:14.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";
	color:black;}
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
	mso-pagination:widow-orphan;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:14.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";
	color:black;}
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
	mso-pagination:widow-orphan;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:14.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";
	color:black;}
span.a
	{mso-style-name:\"Основной текст Знак\";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:\"Основной текст\";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;}
span.a0
	{mso-style-name:\"Верхний колонтитул Знак\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:\"Верхний колонтитул\";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;}
span.2
	{mso-style-name:\"Основной текст с отступом 2 Знак\";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:\"Основной текст с отступом 2\";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;}
p.21, li.21, div.21
	{mso-style-name:\"Основной текст 21\";
	mso-style-priority:99;
	mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	mso-pagination:widow-orphan;
	text-autospace:none;
	font-size:12.0pt;
	font-family:\"Times New Roman\",serif;
	mso-fareast-font-family:\"Times New Roman\";}
span.a1
	{mso-style-name:\"Текст Знак\";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:\"\";
	mso-style-link:Текст;
	font-family:\"Courier New\";
	mso-ascii-font-family:\"Courier New\";
	mso-hansi-font-family:\"Courier New\";}
p.ConsTitle, li.ConsTitle, div.ConsTitle
	{mso-style-name:ConsTitle;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:\"\";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:none;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:8.0pt;
	font-family:\"Arial\",sans-serif;
	mso-fareast-font-family:\"Times New Roman\";
	font-weight:bold;}
 /* Page Definitions */
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:56.75pt 28.3pt 56.75pt 70.9pt;
	mso-header-margin:35.45pt;
	mso-footer-margin:35.45pt;
	mso-title-page:yes;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:28147193;
	mso-list-type:hybrid;
	mso-list-template-ids:873130990 68747279 68747289 68747291 68747279 68747289 68747291 68747279 68747289 68747291;}
@list l0:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:100.35pt;
	text-indent:-18.0pt;}
@list l0:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.35pt;
	text-indent:-18.0pt;}
@list l0:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:172.35pt;
	text-indent:-9.0pt;}
@list l0:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:208.35pt;
	text-indent:-18.0pt;}
@list l0:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:244.35pt;
	text-indent:-18.0pt;}
@list l0:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:280.35pt;
	text-indent:-9.0pt;}
@list l0:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:316.35pt;
	text-indent:-18.0pt;}
@list l0:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:352.35pt;
	text-indent:-18.0pt;}
@list l0:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:388.35pt;
	text-indent:-9.0pt;}
@list l1
	{mso-list-id:36975413;
	mso-list-type:hybrid;
	mso-list-template-ids:-1979121816 -519680218 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l1:level1
	{mso-level-number-format:bullet;
	mso-level-text:-;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Times New Roman\",serif;}
@list l1:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l1:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l1:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l1:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l1:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l1:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l1:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l1:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l2
	{mso-list-id:84153290;
	mso-list-type:hybrid;
	mso-list-template-ids:-1222885044 68747279 68747289 68747291 68747279 68747289 68747291 68747279 68747289 68747291;}
@list l2:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l2:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l2:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l2:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l3
	{mso-list-id:221064349;
	mso-list-type:hybrid;
	mso-list-template-ids:1995756934 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l3:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l3:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l3:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l3:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l3:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l3:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l3:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l3:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l3:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l4
	{mso-list-id:249395312;
	mso-list-type:hybrid;
	mso-list-template-ids:1895229066 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l4:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:71.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l4:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:107.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l4:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:143.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l4:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:179.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l4:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:215.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l4:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:251.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l4:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:287.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l4:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:323.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l4:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:359.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l5
	{mso-list-id:254022820;
	mso-list-type:hybrid;
	mso-list-template-ids:493246372 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l5:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:71.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l5:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:107.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l5:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:143.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l5:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:179.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l5:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:215.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l5:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:251.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l5:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:287.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l5:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:323.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l5:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:359.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l6
	{mso-list-id:375274430;
	mso-list-type:hybrid;
	mso-list-template-ids:1254161518 -519680218 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l6:level1
	{mso-level-number-format:bullet;
	mso-level-text:-;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Times New Roman\",serif;}
@list l6:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l6:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l6:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l6:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l6:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l6:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l6:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l6:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l7
	{mso-list-id:469052619;
	mso-list-type:hybrid;
	mso-list-template-ids:1454909264 -519680218 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l7:level1
	{mso-level-number-format:bullet;
	mso-level-text:-;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Times New Roman\",serif;}
@list l7:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l7:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l7:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l7:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l7:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l7:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l7:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l7:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l8
	{mso-list-id:594168638;
	mso-list-type:hybrid;
	mso-list-template-ids:-1459697340 -519680218 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l8:level1
	{mso-level-number-format:bullet;
	mso-level-text:-;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Times New Roman\",serif;}
@list l8:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l8:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l8:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l8:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l8:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l8:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l8:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l8:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l9
	{mso-list-id:611741768;
	mso-list-type:hybrid;
	mso-list-template-ids:1772914086 -1872054618 -1989910612 -1329666510 -1186417096 278928628 1106401264 528542488 -1359037360 -625447272;}
@list l9:level1
	{mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l9:level2
	{mso-level-start-at:0;
	mso-level-number-format:none;
	mso-level-text:\"\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;}
@list l9:level3
	{mso-level-start-at:0;
	mso-level-number-format:none;
	mso-level-text:\"\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;}
@list l9:level4
	{mso-level-start-at:0;
	mso-level-number-format:none;
	mso-level-text:\"\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;}
@list l9:level5
	{mso-level-start-at:0;
	mso-level-number-format:none;
	mso-level-text:\"\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;}
@list l9:level6
	{mso-level-start-at:0;
	mso-level-number-format:none;
	mso-level-text:\"\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;}
@list l9:level7
	{mso-level-start-at:0;
	mso-level-number-format:none;
	mso-level-text:\"\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;}
@list l9:level8
	{mso-level-start-at:0;
	mso-level-number-format:none;
	mso-level-text:\"\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;}
@list l9:level9
	{mso-level-start-at:0;
	mso-level-number-format:none;
	mso-level-text:\"\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:0cm;
	text-indent:0cm;}
@list l10
	{mso-list-id:775905482;
	mso-list-type:hybrid;
	mso-list-template-ids:-667776210 68747279 68747289 68747291 68747279 68747289 68747291 68747279 68747289 68747291;}
@list l10:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l10:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l10:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l10:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l10:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l10:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l10:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l10:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l10:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l11
	{mso-list-id:782959612;
	mso-list-template-ids:-93935708;}
@list l11:level1
	{mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:18.0pt;
	text-indent:-18.0pt;}
@list l11:level2
	{mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:18.0pt;
	text-indent:-18.0pt;}
@list l11:level3
	{mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l11:level4
	{mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l11:level5
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:54.0pt;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l11:level6
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:54.0pt;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l11:level7
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l11:level8
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l11:level9
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:90.0pt;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-90.0pt;}
@list l12
	{mso-list-id:844590953;
	mso-list-type:hybrid;
	mso-list-template-ids:-874600110 -519680218 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l12:level1
	{mso-level-number-format:bullet;
	mso-level-text:-;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Times New Roman\",serif;}
@list l12:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l12:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l12:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l12:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l12:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l12:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l12:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l12:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l13
	{mso-list-id:883950587;
	mso-list-type:hybrid;
	mso-list-template-ids:-1248172768 -483910238 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l13:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0BE;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:100.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l13:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l13:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:172.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l13:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:208.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l13:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:244.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l13:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:280.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l13:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:316.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l13:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:352.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l13:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:388.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l14
	{mso-list-id:909072595;
	mso-list-template-ids:-1331117458;}
@list l14:level1
	{mso-level-start-at:3;
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:18.0pt;
	text-indent:-18.0pt;}
@list l14:level2
	{mso-level-start-at:4;
	mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:18.0pt;
	text-indent:-18.0pt;}
@list l14:level3
	{mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l14:level4
	{mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l14:level5
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:54.0pt;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l14:level6
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:54.0pt;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l14:level7
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l14:level8
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l14:level9
	{mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:90.0pt;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-90.0pt;}
@list l15
	{mso-list-id:975186238;
	mso-list-type:hybrid;
	mso-list-template-ids:-1222574818 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l15:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:64.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l15:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:100.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l15:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l15:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:172.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l15:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:208.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l15:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:244.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l15:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:280.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l15:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:316.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l15:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:352.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l16
	{mso-list-id:1058169601;
	mso-list-template-ids:-868829850;}
@list l16:level1
	{mso-level-tab-stop:18.0pt;
	mso-level-number-position:left;
	margin-left:18.0pt;
	text-indent:-18.0pt;}
@list l16:level2
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.\";
	mso-level-tab-stop:21.0pt;
	mso-level-number-position:left;
	margin-left:21.0pt;
	text-indent:-21.0pt;}
@list l16:level3
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.\";
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l16:level4
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.\";
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	margin-left:36.0pt;
	text-indent:-36.0pt;}
@list l16:level5
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.\";
	mso-level-tab-stop:54.0pt;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l16:level6
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.\";
	mso-level-tab-stop:54.0pt;
	mso-level-number-position:left;
	margin-left:54.0pt;
	text-indent:-54.0pt;}
@list l16:level7
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.\";
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l16:level8
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.\";
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	margin-left:72.0pt;
	text-indent:-72.0pt;}
@list l16:level9
	{mso-level-legal-format:yes;
	mso-level-text:\"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.\";
	mso-level-tab-stop:90.0pt;
	mso-level-number-position:left;
	margin-left:90.0pt;
	text-indent:-90.0pt;}
@list l17
	{mso-list-id:1099789321;
	mso-list-type:hybrid;
	mso-list-template-ids:755025824 -519680218 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l17:level1
	{mso-level-number-format:bullet;
	mso-level-text:-;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Times New Roman\",serif;}
@list l17:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l17:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l17:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l17:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l17:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l17:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l17:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l17:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l18
	{mso-list-id:1127897204;
	mso-list-type:hybrid;
	mso-list-template-ids:1778004010 -483910238 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l18:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0BE;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:64.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l18:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:100.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l18:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l18:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:172.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l18:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:208.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l18:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:244.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l18:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:280.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l18:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:316.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l18:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:352.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l19
	{mso-list-id:1282495082;
	mso-list-type:hybrid;
	mso-list-template-ids:148268110 -519680218 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l19:level1
	{mso-level-number-format:bullet;
	mso-level-text:-;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Times New Roman\",serif;}
@list l19:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l19:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l19:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l19:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l19:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l19:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l19:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l19:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l20
	{mso-list-id:1319454827;
	mso-list-type:hybrid;
	mso-list-template-ids:-98400174 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l20:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l20:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l20:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l20:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l20:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l20:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l20:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l20:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l20:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l21
	{mso-list-id:1358502089;
	mso-list-type:hybrid;
	mso-list-template-ids:6955902 -483910238 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l21:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F0BE;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:64.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l21:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:100.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l21:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l21:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:172.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l21:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:208.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l21:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:244.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l21:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:280.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l21:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:316.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l21:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:352.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l22
	{mso-list-id:1381588774;
	mso-list-type:hybrid;
	mso-list-template-ids:618274286 468487350 68747289 68747291 68747279 68747289 68747291 68747279 68747289 68747291;}
@list l22:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l22:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l22:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l22:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l22:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l22:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l22:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l22:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l22:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l23
	{mso-list-id:1603756575;
	mso-list-type:hybrid;
	mso-list-template-ids:492074252 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l23:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:100.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l23:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l23:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:172.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l23:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:208.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l23:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:244.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l23:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:280.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l23:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:316.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l23:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:352.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l23:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:388.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l24
	{mso-list-id:1623925046;
	mso-list-type:hybrid;
	mso-list-template-ids:-1078953860 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l24:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:100.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l24:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l24:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:172.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l24:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:208.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l24:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:244.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l24:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:280.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l24:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:316.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l24:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:352.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l24:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:388.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l25
	{mso-list-id:1858619586;
	mso-list-type:hybrid;
	mso-list-template-ids:-330274236 -519680218 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l25:level1
	{mso-level-number-format:bullet;
	mso-level-text:-;
	mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Times New Roman\",serif;}
@list l25:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l25:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l25:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l25:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l25:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l25:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l25:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l25:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l26
	{mso-list-id:1865710007;
	mso-list-type:hybrid;
	mso-list-template-ids:1648111892 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l26:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l26:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l26:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l26:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l26:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l26:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l26:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l26:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l26:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l27
	{mso-list-id:1881936042;
	mso-list-type:hybrid;
	mso-list-template-ids:461693854 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l27:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:71.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l27:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:107.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l27:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:143.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l27:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:179.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l27:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:215.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l27:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:251.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l27:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:287.45pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l27:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:323.45pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";}
@list l27:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:359.45pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l28
	{mso-list-id:2090804803;
	mso-list-type:hybrid;
	mso-list-template-ids:811528922 68747279 68747289 68747291 68747279 68747289 68747291 68747279 68747289 68747291;}
@list l28:level1
	{mso-level-tab-stop:36.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l28:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l28:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:108.0pt;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l28:level4
	{mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l28:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l28:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:216.0pt;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l28:level7
	{mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l28:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l28:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:324.0pt;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l29
	{mso-list-id:2100173973;
	mso-list-type:hybrid;
	mso-list-template-ids:1563750324 -1459469818 68747267 68747269 68747265 68747267 68747269 68747265 68747267 68747269;}
@list l29:level1
	{mso-level-number-format:bullet;
	mso-level-text:\F02D;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:64.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l29:level2
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:100.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";
	mso-bidi-font-family:\"Times New Roman\";}
@list l29:level3
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:136.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l29:level4
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:172.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l29:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:208.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";
	mso-bidi-font-family:\"Times New Roman\";}
@list l29:level6
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:244.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
@list l29:level7
	{mso-level-number-format:bullet;
	mso-level-text:\F0B7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:280.35pt;
	text-indent:-18.0pt;
	font-family:Symbol;}
@list l29:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:316.35pt;
	text-indent:-18.0pt;
	font-family:\"Courier New\";
	mso-bidi-font-family:\"Times New Roman\";}
@list l29:level9
	{mso-level-number-format:bullet;
	mso-level-text:\F0A7;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:352.35pt;
	text-indent:-18.0pt;
	font-family:Wingdings;}
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
table.MsoTableGrid
	{mso-style-name:\"Сетка таблицы\";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
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
	font-family:\"Times New Roman\",serif;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext=\"edit\" spidmax=\"1026\"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext=\"edit\">
  <o:idmap v:ext=\"edit\" data=\"1\"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=RU link=blue vlink=\"#954F72\" style='tab-interval:35.4pt'>

<div class=WordSection1>

<p class=MsoNormal align=center style='text-align:center;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><b style='mso-bidi-font-weight:
normal'><u><span style='font-size:16.0pt'><o:p><span style='text-decoration:
 none'>&nbsp;</span></o:p></span></u></b></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:16.0pt'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>Утверждаю:<o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>Директор ".$company_name."<o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>_________<span>".$director_fio."</span><o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><span style='font-size:14.0pt'>«__»_________".date('Y')."<o:p></o:p></span></p>

<p class=MsoNormal align=center style='text-align:center;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><b style='mso-bidi-font-weight:
normal'><span style='font-size:16.0pt'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center;mso-pagination:none;
mso-layout-grid-align:none;text-autospace:none'><b style='mso-bidi-font-weight:
normal'><span style='font-size:16.0pt'>Инструкция<br>
<span style='mso-spacerun:yes'> </span>по охране труда для работников офиса <o:p></o:p></span></b></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<h2 align=center style='margin-top:0cm;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:center;text-indent:0cm;mso-list:l10 level1 lfo29;
tab-stops:14.2pt'><![if !supportLists]><b><span style='mso-bidi-font-size:12.0pt;
layout-grid-mode:line'><span style='mso-list:Ignore'>1.<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b><span style='mso-bidi-font-size:12.0pt;
layout-grid-mode:line'>ОБЩИЕ ТРЕБОВАНИЯ ОХРАНЫ ТРУДА<o:p></o:p></span></b></h2>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt'>1.1. За нарушение требований настоящей инструкции,
относящихся к выполняемой им работе, работник несет ответственность в
соответствии с действующими трудовым, уголовным и административным
законодательствами Российской Федерации.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt;tab-stops:262.25pt'><span
style='font-size:14.0pt;mso-no-proof:yes'>1.2.</span><span style='font-size:
14.0pt'> Работник допускается к самостоятельной работе после прохождения:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>вводного инструктажа по охране труда;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>обучения по охране труда и
проверки знаний требований охраны труда</span><span style='font-size:14.0pt'>;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>проверки знаний правил электробезопасности с
присвоением<span style='mso-no-proof:yes'> необходимой </span>квалификационной
группы допуска;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>вводного противопожарного инструктажа;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>проверки знания настоящей инструкции. <o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt;mso-no-proof:yes'>1.3.</span><span style='font-size:
14.0pt'> Работник обязан выполнять должностные обязанности, работать по зада­нию
своего руководителя, соблюдать правила внутреннего трудового распорядка, выпол­нять
требования охраны труда, бережно относиться к имуществу.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt'>1.4. Работник должен:<o:p></o:p></span></p>

<p class=MsoBodyTextIndent2 style='margin:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:0cm;line-height:normal;mso-list:l29 level1 lfo22;
tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>знать опасные и вредные производственные факторы,
проявляющиеся на его рабочем месте;<o:p></o:p></span></p>

<p class=MsoBodyTextIndent2 style='margin:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:0cm;line-height:normal;mso-list:l29 level1 lfo22;
tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>знать и уметь применять меры предосторожности и
средства защиты (в том числе индивидуальной) от опасных и вредных
производственных факторов;<o:p></o:p></span></p>

<p class=21 style='margin-left:0cm;text-indent:0cm;mso-list:l29 level1 lfo22;
tab-stops:14.2pt'><![if !supportLists]><span style='font-size:14.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol'><span
style='mso-list:Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:14.0pt'>знать инструкции
по эксплуатации применяемого оборудования, оргтехники;<o:p></o:p></span></p>

<p class=21 style='margin-left:0cm;text-indent:0cm;mso-list:l29 level1 lfo22;
tab-stops:14.2pt'><![if !supportLists]><span style='font-size:14.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol'><span
style='mso-list:Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:14.0pt'>знать места
подключения токоприемников, коммутирующие устройства, а также уметь определять
их исправное состояние и уметь отключать их в аварийных ситуациях;<o:p></o:p></span></p>

<p class=21 style='margin-left:0cm;text-indent:0cm;mso-list:l29 level1 lfo22;
tab-stops:0cm 14.2pt'><![if !supportLists]><span style='font-size:14.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol'><span
style='mso-list:Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:14.0pt'>знать пути
эвакуации персонала и действия в случае возникновения аварийных ситуаций;<o:p></o:p></span></p>

<p class=21 style='margin-left:0cm;text-indent:0cm;mso-list:l29 level1 lfo22;
tab-stops:0cm 14.2pt'><![if !supportLists]><span style='font-size:14.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol'><span
style='mso-list:Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:14.0pt'>знать места нахождения
средств пожаротушения и уметь их применять;<o:p></o:p></span></p>

<p class=21 style='margin-left:0cm;text-indent:0cm;mso-list:l29 level1 lfo22;
tab-stops:14.2pt'><![if !supportLists]><span style='font-size:14.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol'><span
style='mso-list:Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-size:14.0pt'>знать и уметь
оказывать доврачебную помощь пострадавшим;<o:p></o:p></span></p>

<p class=21 style='margin-left:0cm;text-indent:0cm;mso-list:l29 level1 lfo22;
tab-stops:14.2pt'><![if !supportLists]><span style='font-size:14.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;
mso-bidi-font-weight:bold'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>соблюдать правила личной
гигиены;<o:p></o:p></span></p>

<p class=21 style='margin-left:0cm;text-indent:0cm;mso-list:l29 level1 lfo22;
tab-stops:14.2pt'><![if !supportLists]><span style='font-size:14.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;
mso-bidi-font-weight:bold'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>использовать в работе только
по прямому назначению и только исправные мебель, приспособления, средства
оргтехники и другое оборудование рабочего места;<o:p></o:p></span></p>

<p class=21 style='margin-left:0cm;text-indent:0cm;mso-list:l29 level1 lfo22;
tab-stops:14.2pt'><![if !supportLists]><span style='font-size:14.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;
mso-bidi-font-weight:bold'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>не допускать нахождение на
своем рабочем месте посторонних предметов, мешающих работе.<o:p></o:p></span></p>

<p class=21 style='text-indent:14.2pt'><span style='font-size:14.0pt'>1.5. В
зависимости от условий работ, на рабочем месте, могут проявляться различные
опасные и вредные производственные факторы.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt'>1.5.1. При эксплуатации персонального компьютера на работника
могут оказы­вать действие следующие опасные производственные факторы:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>электромагнитное излучение;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>повышенная яркость светового изображения;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>напряжения в электрической цепи, замыкание которой
может произойти через тело человека;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>напряжение зрения, внимания, длительные статические
нагрузки.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt;tab-stops:49.65pt'><span
style='font-size:14.0pt'>1.5.2. При эксплуатации электрооборудования опасным
производственным фактором является электрический ток. Предельно допустимая
величина переменного тока 0,3 мА. При увеличении тока до<span style='mso-no-proof:
yes'> 0,6-1,6</span> мА человек начинает ощущать его воздействие.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt;tab-stops:49.65pt'><span
style='font-size:14.0pt'>Виды поражения электротоком:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>электрический удар (паралич сердца и дыхания);<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>термический ожог (электроожог);<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>технические повреждения;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>электроофтальмия (воспаление глаз вследствие действия
электротока).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt;tab-stops:42.55pt'><span
style='font-size:14.0pt'>1.5.3. Также на работника могут воздействовать
следующие опасные и вредные производственные факторы:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>нервно-психические и
эмоциональные перегрузки;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>падения предметов с высоты
(со шкафов, полок);<b><o:p></o:p></b></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol'><span style='mso-list:Ignore'>-<span
style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt'>шероховатая или острая поверхность оборудования,
инструмента, оргтехники;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt'>1.5.4. Информация об опасных и вредных
производственных факторах, возникающих при эксплуатации другого оборудования,
содержится в инструкциях по их эксплуатации.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt'>1.6. <span style='mso-bidi-font-weight:bold'>Средствами
защиты работника являются:<o:p></o:p></span></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt;text-autospace:none'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>защитная изоляция проводов и
кабелей, токоведущих частей оборудования и частей оборудования, которые могут
оказаться под напряжением.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>Для работы на <em><span
style='background:white;font-style:normal'>персональных электронных
вычислительных машинах</span></em></span><span style='font-size:14.0pt;
color:#444444;background:white'> </span><span style='font-size:14.0pt;
background:white'>(далее – </span><span style='font-size:14.0pt;mso-bidi-font-weight:
bold'>ПЭВМ) рекомендуется использование специальных спектральных очков.<o:p></o:p></span></p>

<h2 align=center style='margin-top:12.0pt;text-align:center;text-indent:1.0cm'><b><span
style='font-size:14.0pt;layout-grid-mode:line;mso-bidi-font-style:italic'>2. ТРЕБОВАНИЯ
ОХРАНЫ ТРУДА ПЕРЕД НАЧАЛОМ РАБОТЫ<o:p></o:p></span></b></h2>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt;mso-no-proof:yes'>2.1.</span><span style='font-size:
14.0pt'> Каждый работник перед началом работы обязан: <o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l29 level1 lfo22;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>убрать с рабочего места
посторонние предметы и предметы, не требующиеся для выполнения текущей работы
(коробки, сумки, папки, книги и т.п.);<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l20 level1 lfo23;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>убедиться внешним осмотром в
отсутствии механических повреждений шнуров электропитания и корпусов средств
оргтехники, а также в отсутствии механических повреждений электропроводки и
других кабелей, электророзеток, электровыключателей, светильников,
кондиционеров и другого оборудования;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l20 level1 lfo23;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>проверить: исправна и удобно
ли расположена мебель, удобно ли размещены оборудование рабочего места и
необходимые для работы материалы на рабочем столе, свободны ли подходы к
рабочим местам;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l20 level1 lfo23;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>в случае обнаружения
повреждений и неисправностей ПЭВМ, периферийных устройств, средств оргтехники,
мебели, приспособлений, электропроводки и других кабелей, электророзеток,
электровыключателей, светильников, кондиционеров и другого оборудования не
включать оборудование, не приступать к работе, вызвать технический персонал и
сообщить об этом своему непосредственному руководителю;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l20 level1 lfo23;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>проверить, достаточно ли
освещено рабочее место. При недостаточной освещенности необходимо организовать
местное освещение, причем расположить светильники местного освещения так, чтобы
при выполнении работы источник света не слепил глаза как самому работающему,
так и окружающим;<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt'>2.2. Убедиться в безопасности выполнения работ, только
после этого можно приступать к выполнению работ.<o:p></o:p></span></p>

<h2 align=center style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:center;text-indent:1.0cm'><b><span style='font-size:
14.0pt;layout-grid-mode:line;mso-bidi-font-style:italic'>3. ТРЕБОВАНИЯ ОХРАНЫ
ТРУДА ВО ВРЕМЯ РАБОТЫ<o:p></o:p></span></b></h2>

<p class=MsoNormal style='margin-top:6.0pt;text-indent:14.2pt'><span
style='font-size:14.0pt'>3.1. Каждый работник во время работы обязан: <o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>содержать в порядке и
чистоте рабочее место, не допускать загромождения его документами;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>содержать свободными проходы
к рабочим местам, не загромождать оборудование предметами, которые снижают
теплоотдачу средств оргтехники и другого оборудования;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>следить за исправностью
средств оргтехники и другого оборудования, соблюдать правила их эксплуатации и
инструкции по охране труда для соответствующих видов работ;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>при длительном отсутствии на
рабочем месте отключать от электросети средства оргтехники и другое
оборудование за исключением оборудования, определенного для круглосуточной
работы (сетевые серверы и т.д.);<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>быть внимательным, не
отвлекаться и не отвлекать других;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>в случае замятия листа
(ленты) бумаги в устройствах вывода на печать перед извлечением листа (ленты)
остановить процесс и отключить устройство от электросети, вызвать технический
персонал или сообщить об этом своему непосредственному руководителю;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>отключать средства
оргтехники и другое оборудование от электросети, только держась за вилку
штепсельного соединителя;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>не допускать натягивания,
скручивания, перегиба и пережима шнуров электропитания оборудования, проводов и
кабелей, не допускать нахождения на них каких-либо предметов и соприкосновения
их с нагретыми поверхностями;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>во время установленных
перерывов в работе выполнять рекомендованные упражнения для глаз, кистей рук;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l5 level1 lfo24;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>не допускать попадания влаги
на поверхность ПЭВМ, периферийных устройств и другого оборудования. Не
протирать влажной или мокрой ветошью оборудование, которое находится под
электрическим напряжением.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;text-indent:14.2pt;tab-stops:42.55pt'><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>3.2. Во время работы не
допускается:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l26 level1 lfo25;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>прикасаться к движущимся
частям средств оргтехники и другого оборудования;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l26 level1 lfo25;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>работать при недостаточной
освещенности рабочего места;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l26 level1 lfo25;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>касаться элементов средств
оргтехники и другого оборудования влажными руками;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l26 level1 lfo25;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>переключать интерфейсные
кабели, вскрывать корпуса средств оргтехники и другого оборудования и
самостоятельно производить их ремонт.<o:p></o:p></span></p>

<h2 align=center style='margin-top:12.0pt;text-align:center;text-indent:1.0cm'><b><span
style='font-size:14.0pt;layout-grid-mode:line;mso-bidi-font-style:italic'>4<a
name=OCRUncertain019>.</a> ТРЕБОВАНИЯ ОХРАНЫ ТРУДА В АВАРИЙНЫХ СИТУАЦИЯХ<o:p></o:p></span></b></h2>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>4.1. Работник при
возникновении аварийных ситуаций обязан:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>немедленно прекратить
работу, отключить от электросети средства оргтехники и прочее
электрооборудование и сообщить о возникновении аварийной ситуации и ее характере
непосредственному руководителю, а в его отсутствие старшему руководителю; при
необходимости покинуть опасную зону;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>под руководством
непосредственного руководителя принять участие в ликвидации создавшейся
аварийной ситуации, если это не представляет угрозы для здоровья или жизни </span><span
style='font-size:14.0pt'>работников<span style='mso-bidi-font-weight:bold'>;<o:p></o:p></span></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>в случае возникновения
нарушений в работе средств оргтехники или другого оборудования, а также при
возникновении нарушений в работе электросети (запах гари, посторонний шум
при<span style='mso-spacerun:yes'>  </span>работе средств оргтехники и другого
оборудования или ощущения действия электрического тока при прикосновении к их
корпусам, мигание светильников и т.д.) отключить средства оргтехники и другое
оборудование от электросети, вызвать технический персонал и сообщить об этом
своему непосредственному руководителю;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>в случае обнаружения
неисправностей мебели и приспособлений прекратить их использование, вызвать
технический персонал и сообщить об этом своему непосредственному руководителю;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>при временном прекращении
подачи электроэнергии отключить от электросети средства оргтехники и прочее
электрооборудование;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>не приступать к работе до
полного устранения повреждений и неисправностей средств оргтехники и
оборудования рабочего места или устранения аварийной ситуации;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>при возникновении пожара
необходимо прекратить работу, вызвать пожарную охрану, отключить средства
оргтехники и прочее оборудование от электросети, оповестить о пожаре
находящихся поблизости людей, принять меры к эвакуации людей из опасной зоны и
принять участие в тушении пожара имеющимися первичными средствами
пожаротушения, а при невозможности ликвидировать пожар покинуть опасную зону,
действуя согласно инструкциям по пожарной безопасности и планам эвакуации;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>тушение очага пожара
производить с помощью порошковых или углекислотных огнетушителей с обязательным
использованием средств индивидуальной защиты;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>при несчастных случаях с
другими </span><span style='font-size:14.0pt'>работниками<span
style='mso-bidi-font-weight:bold'> оказать пострадавшему первую помощь, помочь
доставить его в здравпункт или ближайшее медицинское учреждение, при
необходимости вызвать медицинских работников на место происшествия;<o:p></o:p></span></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>немедленно сообщить своему
непосредственному руководителю о происшедшем с работником или по его вине
несчастном случае, а также о любом несчастном случае с участием других работников
своей или сторонней организации, свидетелем, которого был </span><span
style='font-size:14.0pt'>работник<span style='mso-bidi-font-weight:bold'>;<o:p></o:p></span></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>принять меры для сохранения
обстановки несчастного случая, если это не сопряжено с опасностью для жизни и
здоровья людей;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>при расследовании
несчастного случая </span><span style='font-size:14.0pt'>работник<span
style='mso-bidi-font-weight:bold'> должен сообщить все известные ему
обстоятельства происшедшего случая;<o:p></o:p></span></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>при совершении
террористических актов или угрозе их совершения действовать в соответствии с
рекомендациями по безопасности при чрезвычайных ситуациях, действующими в
организации;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-left:0cm;text-align:justify;text-indent:0cm;
mso-list:l4 level1 lfo26;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>в случае обнаружения в
служебных помещениях нарушений требований безопасности труда, которые не могут
быть устранены собственными силами, а также в случае возникновения угрозы жизни
или здоровью самого </span><span style='font-size:14.0pt'>работника<span
style='mso-bidi-font-weight:bold'> или других </span>работников <span
style='mso-bidi-font-weight:bold'>сообщить об этом своему непосредственному
руководителю, приостановить работу и покинуть опасную зону.<o:p></o:p></span></span></p>

<h2 align=center style='margin-top:12.0pt;text-align:center;text-indent:1.0cm'><b><span
style='font-size:14.0pt;layout-grid-mode:line;mso-bidi-font-style:italic'>5.
ТРЕБОВАНИЯ ОХРАНЫ ТРУДА ПО ОКОНЧАНИИ РАБОТЫ<o:p></o:p></span></b></h2>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify;text-indent:14.2pt'><span
style='font-size:14.0pt'>5.1. После окончания работы необходимо:<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:1.0pt;margin-right:0cm;margin-bottom:0cm;
margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:0cm;
mso-list:l27 level1 lfo27;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>отключить от электросети
средства оргтехники и другое оборудование, за исключением оборудования, которое
определено для круглосуточной работы (факс, сетевые серверы и т.д.);<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:1.0pt;margin-right:0cm;margin-bottom:0cm;
margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:0cm;
mso-list:l27 level1 lfo27;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>привести в порядок рабочее
место, обращая особое внимание на его противопожарное состояние;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:1.0pt;margin-right:0cm;margin-bottom:0cm;
margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:0cm;
mso-list:l27 level1 lfo27;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>закрыть окна;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:1.0pt;margin-right:0cm;margin-bottom:0cm;
margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:0cm;
mso-list:l27 level1 lfo27;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>выключить светильники;<o:p></o:p></span></p>

<p class=MsoNormal style='margin-top:1.0pt;margin-right:0cm;margin-bottom:0cm;
margin-left:0cm;margin-bottom:.0001pt;text-align:justify;text-indent:0cm;
mso-list:l27 level1 lfo27;tab-stops:14.2pt'><![if !supportLists]><span
style='font-size:14.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold'><span style='mso-list:
Ignore'>-<span style='font:7.0pt \"Times New Roman\"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
style='font-size:14.0pt;mso-bidi-font-weight:bold'>обо всех недостатках,
обнаруженных во время работы, проинформировать своего непосредственного
руководителя.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify;tab-stops:14.2pt'><o:p>&nbsp;</o:p></p>

<p class=MsoNormal style='text-align:justify;text-indent:1.0cm'><o:p>&nbsp;</o:p></p>

<p class=MsoNormal style='text-align:justify;text-indent:1.0cm'><o:p>&nbsp;</o:p></p>

</div>

</body>

</html>
";

$folder_name = $_SERVER['DOCUMENT_ROOT'].'/temp_downloads/'.md5($result_file);
if(!is_dir($folder_name)){
    mkdir($folder_name);
}

file_put_contents($folder_name.'/instruction_on_labor_protection_office.doc', $result_file, FILE_APPEND);

$doc_download_url = '/temp_downloads/'.md5($result_file).'/instruction_on_labor_protection_office.doc';
<?php

include("../include/conn.php");
include("../include/pageclass.php");
if ($action == "del") {
$sql_1 = "delete from {$db_prefix}mails1 where id='".$id ."'";
$db ->query($sql_1);
header("location:sendmail.php?pageno={$pageno}");
exit();
}
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD><body>



<TABLE cellSpacing=5 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD id=test1 vAlign=top colSpan=2>
<TABLE class=Table_xt cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
<TR><TD colSpan=5>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>区域管理</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR><TD vAlign=top bgColor=#d4e8fa colSpan=5>
</TD></TR>
<TR><TD vAlign=top bgColor=#ffffff colSpan=5>
<TABLE borderColor=#ffffff cellSpacing=1 cellPadding=1 width="100%" align=center bgColor=#d4e8fa border=1>
<TBODY>
<TR bgColor=#f2f9fd>
<TD vAlign=center bgColor=#cfddf0>
<STYLE type=text/css>.UltraWebGrid1-ic {PADDING-LEFT: 5px; FONT-SIZE: 8pt; FONT-FAMILY: Tahoma; BACKGROUND-COLOR: white}
.UltraWebGrid1-aic {PADDING-LEFT: 5px; FONT-SIZE: 8pt; FONT-FAMILY: Tahoma; BACKGROUND-COLOR: #f6fafd}
.UltraWebGrid1-sic {BORDER-RIGHT: #fff7dd 1px solid; BORDER-TOP: #fff7dd 1px solid; BORDER-LEFT: #fff7dd 1px solid; BORDER-BOTTOM: #fff7dd 1px solid; BACKGROUND-COLOR: #fff7dd}
.UltraWebGrid1-0-ic {PADDING-LEFT: 5px; FONT-SIZE: 8pt; FONT-FAMILY: Tahoma; BACKGROUND-COLOR: white}
.UltraWebGrid1-0-aic {PADDING-LEFT: 5px; FONT-SIZE: 8pt; FONT-FAMILY: Tahoma; BACKGROUND-COLOR: #f6fafd}
.UltraWebGrid1-hc {PADDING-RIGHT: 3px; PADDING-LEFT: 3px; FONT-WEIGHT: bold; FONT-SIZE: 8pt; VERTICAL-ALIGN: middle; PADDING-TOP: 3px; FONT-FAMILY: Tahoma; BACKGROUND-COLOR: #cfddf0; TEXT-ALIGN: center}
.UltraWebGrid1-shc {BORDER-RIGHT: #fff7dd 1px solid; BORDER-TOP: #fff7dd 1px solid; PADDING-LEFT: 5px; FONT-WEIGHT: bold; FONT-SIZE: 8pt; VERTICAL-ALIGN: middle; BORDER-LEFT: #fff7dd 1px solid; BORDER-BOTTOM: #fff7dd 1px solid; FONT-FAMILY: Tahoma; BACKGROUND-COLOR: #fff7dd; TEXT-ALIGN: center}
.UltraWebGrid1-rlc {PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; VERTICAL-ALIGN: middle; PADDING-TOP: 0px; BACKGROUND-COLOR: white; TEXT-ALIGN: center}
</STYLE>
<INPUT id=UltraWebGrid1 type=hidden name=UltraWebGrid1>
<TABLE
id=UltraWebGrid1_main
style="TABLE-LAYOUT: fixed; OVERFLOW: hidden; WIDTH: 100%; FONT-FAMILY: Verdana"
cellPadding=0
border=0>

<TR>
<TD style="WIDTH: 100%">
<TABLE
id=UltraWebGrid1_main
style="TABLE-LAYOUT: fixed; OVERFLOW: hidden; WIDTH: 100%; FONT-FAMILY: Verdana"
cellPadding=0
border=0>
<TR>
<TD style="WIDTH: 100%">
<DIV id=UltraWebGrid1_div hideFocus
style="OVERFLOW-X: scroll; OVERFLOW: hidden; WIDTH: 100%"
tabIndex=0>
<TABLE
style="WIDTH: 100%"
cellSpacing=1 cellPadding=1 border=0 bandNo="0">
<COLGROUP>
<COL>
<COL>
<COL>
<COL>
<COL>
</COLGROUP>
<THEAD>
<TR>
<TH class=UltraWebGrid1-hc id=UltraWebGrid1c_0_0 columnNo="0"><NOBR>编号</NOBR></TH>
<TH class=UltraWebGrid1-hc id=UltraWebGrid1c_0_0 columnNo="0"><NOBR>省编号</NOBR></TH>
<TH class=UltraWebGrid1-hc id=UltraWebGrid1c_0_1 columnNo="1"><NOBR>省份名称</NOBR></TH>
<TH class=UltraWebGrid1-hc id=UltraWebGrid1c_0_4 columnNo="4"><NOBR>操作</NOBR></TH>
</TR></THEAD>

<input type="hidden" name="chknum" value="0">
';
$pagesize = 20;
$pageno = getparam("pageno");
if ($pageno <1) $pageno = 1;
$sqlc = "select * from {$db_prefix}province where 1 ";
$filter = "";
if ($filter != '') $sqlc .= $filter;
$rs = $db ->get_one($sqlc);
$recnum = $rs['c'];
$pagenum = ceil($recnum / $pagesize);
if ($pageno >$pagenum) $pageno = intval($pagenum);
if ($pageno <1) $pageno = 1;
$bgpos = $pagesize * ($pageno-1);
$sql = "select * from {$db_prefix}province where 1";
if ($filter != '') $sql .= $filter;
$sql .= " order by id asc limit ".$bgpos .",".$pagesize;
$result = $db ->query($sql);
if ($db ->num_rows($result) >0) {
while ($rs = $db ->fetch_array($result)) {
;echo '<TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
<TD  id=UltraWebGrid1rc_0_0  level="0_0"><NOBR>';echo $rs["id"];echo '</NOBR></TD>
<TD  id=UltraWebGrid1rc_0_0  level="0_0"><NOBR>';echo $rs["provinceID"];echo '</NOBR></TD>
<TD  id=UltraWebGrid1rc_0_1  level="0_1"><NOBR>';echo $rs["province"];echo '</NOBR></TD>
<TD  id=UltraWebGrid1rc_0_4  level="0_4"><NOBR><a href="mail1view.php?id=';echo $rs["id"];echo '">查看</a>|<a href="?action=del&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定删除?\');">删除</a></NOBR></TD>
</TR>
';
}
}else {
;echo '<TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
<TD  id=UltraWebGrid1rc_0_0  level="0_0"><NOBR></NOBR></TD>
<TD  id=UltraWebGrid1rc_0_1  level="0_1"><NOBR></NOBR></TD>
<TD  id=UltraWebGrid1rc_0_2  level="0_2"><NOBR></NOBR></TD>
<TD  id=UltraWebGrid1rc_0_3  level="0_3">&nbsp;</TD>
<TD  id=UltraWebGrid1rc_0_3  level="0_3">&nbsp;</TD>
<TD  id=UltraWebGrid1rc_0_3  level="0_3"><NOBR></NOBR></TD>
<TD  id=UltraWebGrid1rc_0_4  level="0_4">&nbsp;</TD>
<TD  id=UltraWebGrid1rc_0_4  level="0_4"><NOBR></NOBR></TD>
</TR>
  ';
}
$db ->free_result($result);
;echo '



</TABLE>
</DIV>
</TD></TR></TABLE>
</TD></TR></TABLE>
</TD></TR></TBODY></TABLE>
<TABLE width="100%" cellPadding="0" cellSpacing="0" id="Table7">
  <TR>
    <TD vAlign="middle" width="20" bgColor="#d4e8fa">&nbsp;</TD>
    <TD vAlign="middle" width="40" bgColor="#d4e8fa">&nbsp;</TD>
    <TD vAlign="middle" width="50%" bgColor="#d4e8fa">共<span id="lbRecordSum" style="font-family:Microsoft Sans Serif;">';echo $recnum;echo '</span>&nbsp;条记录&nbsp;&nbsp; 第<span id="lbPCurrent" style="font-family:Microsoft Sans Serif;">';echo $pageno;echo '</span>&nbsp;页 / 共<span id="lbPSum" style="font-family:Microsoft Sans Serif;">';echo $pagenum;echo '</span>&nbsp;页</TD>
    <TD vAlign="middle" noWrap align="right" width="300" bgColor="#d4e8fa"><input type="image" name="first" id="first" src="/skin/default/datalist/btnFrist.gif" alt="首页" border="0" onclick="location.href=\'';echo allparam();echo '1\'" />
        <input type="image" name="prev" id="prev" src="/skin/default/datalist/btnPrev.gif" alt="上页" border="0" onclick="location.href=\'';echo allparam();echo '';echo $pageno-1;echo '\'"/>
        <input type="image" name="next" id="next" src="/skin/default/datalist/btnNext.gif" alt="下页" border="0" onclick="location.href=\'';echo allparam();echo '';echo $pageno +1;echo '\'"/>
        <input type="image" name="last" id="last" src="/skin/default/datalist/btnLast.gif" alt="尾页" border="0" onclick="location.href=\'';echo allparam();echo '';echo $pagenum;echo '\'" />
    </TD>
    <TD vAlign="middle" align="center" bgColor="#d4e8fa"><form name="frmpage" method="get" action="">
        ';
$posts = $_POST;
$gets = $_GET;
$result = array_merge($posts,$gets);
foreach($result as $key =>$value) {
;echo '        <input type="hidden" name="';echo $key;echo '" value="';echo $value;echo '" />
        ';
}
;echo '        <input name="pageno" type="text" id="pageno" class="inputCN" style="border-color:SteelBlue;border-width:1px;border-style:Solid;height:18px;width:25px;" />
        <input type="image" name="go" id="go" src="/skin/default/datalist/btnGo.gif" alt="定位" border="0" onclick=""  />
    </form></TD>
  </TR>
</TABLE>
</TD>
</TR></TBODY></TABLE>
</TD></TR></TBODY></TABLE>
</form>
</body>
</html>
'
?>
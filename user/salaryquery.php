<?php

include("../include/conn_2.php");
include("../include/function.php");
include("../include/rate.php");
include("../include/pageclass.php");
include("../include/rank.php");
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>奖金查询</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {font-size: 12px}
.STYLE3 {font-size: 12px; font-weight: bold; }
.STYLE4 {
	color: #03515d;
	font-size: 12px;
}
-->
</style>

<script>
var  highlightcolor=\'#c1ebff\';
//此处clickcolor只能用win系统颜色代码才能成功,如果用#xxxxxx的代码就不行,还没搞清楚为什么:(
var  clickcolor=\'#51b2f6\';
function  changeto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=highlightcolor&&source.id!="nc"&&cs[1].style.backgroundColor!=clickcolor)
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=highlightcolor;
}
}
function  changeback(){
if  (event.fromElement.contains(event.toElement)||source.contains(event.toElement)||source.id=="nc")
return
if  (event.toElement!=source&&cs[1].style.backgroundColor!=clickcolor)
//source.style.backgroundColor=originalcolor
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}

function  clickto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=clickcolor&&source.id!="nc")
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=clickcolor;
}
else
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}
</script>
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</head>

<body>
<TABLE width="90%" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt style="margin:0 auto;">
    <TBODY>
      <TR>
        <TD width="100%" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD><strong>日奖金累计查询</strong><strong>';if(!empty($stime2)) echo "(至".$stime2.")";;echo '</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
			<tr>
			<td align="center" colspan="7" height="22">
			<form name="form2" method="post" action="?action1=query">
			起:
		      <input name="stime1" type="text" id="stime1" size="10" onClick="new WdatePicker()">止:
              <input name="stime2" type="text" id="stime2" size="10" onClick="new WdatePicker()"><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">
			  </form>
			  </td>
			</tr>
            <TR>
			  ';foreach($salaryprice as $k=>$v){;echo '              <td align="center" background="images/bg.gif" bgcolor="#FFFFFF">';echo $k;;echo '</td>
              ';};echo '			  ';foreach($salaryfee as $k=>$v){;echo '              <td align="center" background="images/bg.gif" bgcolor="#FFFFFF">';echo $k;;echo '</td>
              ';};echo '              <TD align="center" background="images/bg.gif" valign="middle" bgColor="#FBFDFF"><span class="STYLE1">实得奖金</span></TD>
		    </TR>
			';
if(!empty($stime2)){
$t_time2=strtotime($stime2);
$sql="select * from {$db_prefix}periods where 1 and endtime<='$t_time2' and state>=1 order by id desc ";
$t_rs=$db->get_one($sql);
;echo '			<TR>
			 ';$cm=0;foreach($salaryprice as $k=>$v){;echo '			  <TD align="center" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){
echo $c=getoutcomespan3($t_rs["endtime"],$v,$_SESSION["glo_username"]);
$cm+=$c;
};echo '</TD>
              ';};echo '			  ';foreach ($salaryfee as $k=>$v){;echo '			   <TD align="center" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){
echo $c=getoutcomespan3($t_rs["endtime"],$v,$_SESSION["glo_username"]);
$cm-=$c;
};echo '</TD>
			  ';};echo '			  <TD align="center" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){echo $cm;};echo '</TD>
		    </TR>';};echo '        </table></TD>
      </TR>
</TABLE>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" background="images/tab_05.gif">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">奖金查询</span></td>
              </tr>
            </table></td>
            <td width="54%">&nbsp;</td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_07.gif" width="16" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onmouseout="changeback()">
          <tr>
			<td width="3%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             期数</span>
            </div></td>
			<!--<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             开始时间</span>
            </div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             结束时间</span>
            </div></td>-->
			';foreach($salaryprice as $k=>$v){;echo '             <td  width="6%" align="center" background="images/bg.gif" bgcolor="#FFFFFF">';echo $k;;echo '</td>
			 ';};echo '			 ';foreach($salaryfee as $k=>$v){;echo '             <td  width="6%" align="center" background="images/bg.gif" bgcolor="#FFFFFF">';echo $k;;echo '</td>
			 ';};echo '             <td width="8%" height="22" align="center" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             实得奖金</span>
            </div></td>
          </tr>
          ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(a.id) as c from {$db_prefix}jsrec a,{$db_prefix}periods b where a.periods=b.periods and a.username='".$_SESSION["glo_username"]."' and b.state>=1 and b.display=0 ";
$filter="";
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select a.*,b.begintime,b.endtime,b.state from {$db_prefix}jsrec a,{$db_prefix}periods b where a.periods=b.periods and a.username='".$_SESSION["glo_username"]."' and b.state>=1  and b.display=0  ";
if ($filter!='') $sql.=$filter;
$sql.=" order by a.id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$total_p=0;
foreach ($salaryprice as $k=>$v){
$total_p+=$rs[$v];
}
foreach ($salaryfee as $k=>$v){
$total_p-=$rs[$v];
}
$total=$total_p;
;echo '          <tr>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["periods"];echo '</div>
            </div></td>
		    <!--<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo date("Y-m-d",$rs["begintime"]);echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo date("Y-m-d",$rs["endtime"]);echo '</div>
            </div></td>-->
			';foreach($salaryprice as $k=>$v){;echo '			<td align="center" bgcolor="#FFFFFF">';echo $rs[$v];echo '</td>
			';};echo '			';foreach($salaryfee as $k=>$v){;echo '			<td align="center" bgcolor="#FFFFFF">';echo $rs[$v];echo '</td>
			';};echo '			<td height="20" align="center" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $total;;echo '</div>
            </div></td>
		 </tr>
          ';
}
}
$db->free_result($result);
;echo '        </table></td>
        <td width="8" background="images/tab_15.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" background="images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="35"><img src="images/tab_18.gif" width="12" height="35" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="STYLE4">&nbsp;&nbsp;共<span id="lbRecordSum" style="font-family:Microsoft Sans Serif;">';echo $recnum;echo '</span>&nbsp;条记录&nbsp;&nbsp; 第<span id="lbPCurrent" style="font-family:Microsoft Sans Serif;">';echo $pageno;echo '</span>&nbsp;页 / 共<span id="lbPSum" style="font-family:Microsoft Sans Serif;">';echo $pagenum;echo '</span>&nbsp;页</td>
            <td>
                     <form name="frmpage" method="get" action="">
            <table border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="40"><img src="images/first.gif" width="37" height="15"  onClick="location.href=\'';echo allparam();echo '1\'"/></td>
                  <td width="45"><img src="images/back.gif" width="43" height="15"  onClick="location.href=\'';echo allparam();echo '';echo $pageno-1;echo '\'" /></td>
                  <td width="45"><img src="images/next.gif" width="43" height="15"  onClick="location.href=\'';echo allparam();echo '';echo $pageno+1;echo '\'"/></td>
                  <td width="40"><img src="images/last.gif" width="37" height="15"   onClick="location.href=\'';echo allparam();echo '';echo $pagenum;echo '\'" /></td>
                  <td width="100"><div align="center"><span class="STYLE1">转到第

';
$posts=$_POST;
$gets=$_GET;
$result = array_merge($posts,$gets);
foreach($result as $key=>$value){
;echo '                <input type="hidden" name="';echo $key;echo '" value="';echo $value;echo '" />
                ';
}
;echo '                    <input name="pageno" type="text" size="4" style="height:12px; width:20px; border:1px solid #999999;" />
                    页 </span></div></td>
                  <td width="40"><input  type="image" src="images/go.gif" width="37" height="15" /></td>
                </tr>
            </table>
            </form>
            </td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
';
?>
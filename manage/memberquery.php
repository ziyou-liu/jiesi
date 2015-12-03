<?php

include("../include/conn.php");include("../include/function.php");
include("../include/pageclass.php");
include("../include/rank.php");
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
if(!empty($action1)){
$totime=strtotime($sstime2);
$sql="select * from {$db_prefix}periods where '".strtotime($sstime2)."'>=begintime and '$totime'<=endtime and state>=1";
$top_res=$db->get_one($sql);
if(empty($top_res)||empty($sstime2)){
$hint="您所查询的日期没有结算，或是记录不存在！";
;echo '	<script>alert(\'';echo $hint;;echo '\');location.href=\'memberquery.php?action=';echo $action;;echo '&stime1=';echo $stime1;;echo '&stime2=';echo $stime2;;echo '\';</script>
	 ';exit();
}
}
if(!empty($action)){
$totime=strtotime($stime2);
$sql="select * from {$db_prefix}periods where '".strtotime($stime2)."'>=begintime and '$totime'<=endtime and state>=1";
$top_res=$db->get_one($sql);
if(empty($top_res)||empty($stime2)){
$hint="您所查询的日期没有结算，或是记录不存在！";
;echo '	<script>alert(\'';echo $hint;;echo '\');location.href=\'memberquery.php?action1=';echo $action1;;echo '&sstime2=';echo $sstime2;;echo '\';</script>
	 ';exit();
}
}
function getusernum($rank,$timelimit,$timelimit1){
global $db,$db_prefix;
$c=0;
if($rank!="11"){
$sql="select count(id) from {$db_prefix}users where regtime>='$timelimit' and regtime<='$timelimit1' and rank='$rank' ";
}else{
$sql="select count(id) from {$db_prefix}users where regtime>='$timelimit' and regtime<='$timelimit1' ";
}
$rs=$db->get_one($sql);
$c=$rs["count(id)"];
return $c;
}
function getusernum2($rank,$timelimit1){
global $db,$db_prefix;
$c=0;
if($rank!="11"){
$sql="select count(id) from {$db_prefix}users where regtime<='$timelimit1' and rank='$rank' ";
}else{
$sql="select count(id) from {$db_prefix}users where regtime<='$timelimit1' ";
}
$rs=$db->get_one($sql);
$c=$rs["count(id)"];
return $c;
}
;echo '
<title>无标题文档</title>
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
<!--
<form name="form2" method="post" action="?action1=query">
 <input type="hidden" name="action" value="';echo $action;;echo '">
 <input type="hidden" name="stime1" value="';echo $stime1;;echo '">
 <input type="hidden" name="stime2" value="';echo $stime2;;echo '">
  <TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="600" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>会员总数查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>			   
              <TD width="21%" align="right" valign="middle" bgColor="#FBFDFF" >请选择日期:
              <input name="sstime2" type="text" id="sstime2" size="10" onClick="new WdatePicker()"></TD>			
			  <TD width="36%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">
		      </TD>
            </TR>
        </table></TD>
      </TR>
  </TABLE>
</form>
 <TABLE width="100%" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="100%" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>初始化至查询日总额统计';if(!empty($sstime2)) echo "(至".$sstime2.")";;echo '</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
			 ';foreach($rankary as $key=>$val){;echo '			 <TD align="right" valign="middle" bgColor="#FBFDFF">';echo $val."总人数";;echo '</TD>
			 ';};echo '			  <TD align="right" valign="middle" bgColor="#FBFDFF">公司总会员数</TD>
            </TR>
			<TR>
			';$total=0;
foreach($rankary as $key=>$val){;echo '			  <TD align="right" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){echo $aa=getusernum2($key,strtotime($sstime2)+24*60*60);$total=$total+$aa;};echo '</TD>
			';};echo '  
			  <TD align="right" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){echo $total;};echo '</TD>
            </TR>
        </table></TD>
      </TR>
</TABLE>
-->  
  <form name="form2" method="post" action="?action=query">
  <input type="hidden" name="action1" value="';echo $action1;;echo '">
  <input type="hidden" name="sstime2" value="';echo $sstime2;;echo '">
  <TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="600" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>会员数量查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
			   <TD width="18%" align="right" valign="middle" bgColor="#FBFDFF" >起:
		      <input name="stime1" type="text" id="stime1" size="10" onClick="new WdatePicker()"></TD>
              <TD width="21%" align="right" valign="middle" bgColor="#FBFDFF" >止:
              <input name="stime2" type="text" id="stime2" size="10" onClick="new WdatePicker()"></TD>			 
			  <TD width="36%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">
		      </TD>
            </TR>
        </table></TD>
      </TR>
  </TABLE>
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" background="images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">查询结果</span>
				';
if(!empty($action)){echo "(".$stime1."---".$stime2.")";}
;echo '				</td>
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onMouseOut="changeback()">
          <tr>
		    <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">期数</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">起</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">止</span></div></td>
			';
foreach($rankary as $key2=>$value2){
;echo '            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $value2;;echo '</span></div></td>
			';};echo '           
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">
			<span class="STYLE1"> 当期总人数
</span> </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">
			<span class="STYLE1"> 至本结算周期总人数</span> </div></td>
          </tr>
		  ';
if(!empty($action)){
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}periods where 1";
$filter="";
if ($action=="query"){
if (trim($stime1)!="") $filter.=" and endtime>='".strtotime($stime1)."'";
if (trim($stime2)!="") $filter.=" and begintime<='".(strtotime($stime2))."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}periods where 1";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$time1="";$time2="";
$sql="select * from {$db_prefix}periods where periods='".$rs["periods"]."' ";
$rs2=$db->get_one($sql);
if(!empty($rs2)){
$time1=$rs2["begintime"];$time2=$rs2["endtime"]+24*60*60;
}
;echo '          <tr>
		   <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo $rs["periods"];};echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo date("Y-m-d",$time1);};echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo date("Y-m-d",$time2-24*60*60);};echo '</div>
            </div></td>
           ';
foreach($rankary as $key2=>$value2){
;echo '            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo getusernum($key2,$time1,$time2);};echo '</div>
            </div></td>
			';};echo '			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo getusernum('11',$time1,$time2);};echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';$sql="select count(id) from {$db_prefix}users where confirmtime<='$time2' and state=1 ";$result2=$db->get_one($sql);echo $result2["count(id)"];echo '</div>
            </div></td>
          </tr>
		   ';}}};echo '        </table></td>
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
            <td><form name="frmpage" method="get" action="">
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
            </form></td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
';
?>
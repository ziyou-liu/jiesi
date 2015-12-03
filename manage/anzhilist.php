<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");
include("../include/pageclass.php");
include("../include/periodscls.php");
include("../include/function.php");
include("../include/rank.php");
include("../include/clearing.php");
if($action=='query'){
if($periodsq!='') $periods=$periodsq;else $periods=getperiods3();
}else{
$periods=getperiods3();
}
$sql="select * from {$db_prefix}periods where periods='".$periods."'";
$rs=$db->get_one($sql);
$timelimit=$rs["begintime"];$timelimit1=$rs["endtime"]+24*60*60;$timelimit2=$rs["endtime"];
$jsfloer1=" and confirmtime>='".$timelimit."' and confirmtime<='".$timelimit1."'";
function getremain($username,$pos){
global $db,$db_prefix,$glo_rank_1,$periods;
$sql="select * from {$db_prefix}jsrec where username='$username' and periods='$periods' ";
$result=$db->get_one($sql);
if($pos==1) return $result["leftsy"];else return $result["rightsy"];
}
function getusertimepv($username){
global $db,$db_prefix,$timelimit,$timelimit2;
if(!empty($timelimit2)&&!empty($timelimit)){
$sql="select sum(num_2) as c from {$db_prefix}tdpv where username='".$username."' and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0";
$result=$db->get_one($sql);
return $result["c"];
}else return;
}
function getspanpv($username){
global $db,$db_prefix,$timelimit2;
if(!empty($timelimit2)){
$sql="select sum(num_2) as c from {$db_prefix}tdpv where username='".$username."' and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0";
$result=$db->get_one($sql);
return $result["c"];
}else{
return;
}
}
;echo '<title>无标题文档</title>
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
<form name="form2" method="post" action="?action=query">
  <TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="700" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
               <TD align="right" valign="middle" bgColor="#FBFDFF" >期数
			    <input name="periodsq" type="text" id="periodsq">
			  </td>
			  <TD align="right" valign="middle" bgColor="#FBFDFF" >会员编号
			    <input name="username" type="text" id="username">
			  </td>
               <TD align="right" valign="middle" bgColor="#FBFDFF" >接点人
			    <input name="prename" type="text" id="prename">
			  </td>
			   <TD valign="middle" bgColor="#FBFDFF" >
			  <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">              </TD>
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
                <td width="3%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="97%" class="STYLE1"><span class="STYLE3">安置网业绩列表</span></td>
              </tr>
            </table></td>
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
            <td width="6%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
              期数</span>
            </div></td>
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">级别</span></div></td>
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">左区新增</span></div></td>
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">右区新增</span></div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">左区累计</div></td>
        <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">右区累计</div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">左区剩余</div></td>
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">右区剩余</div></td>
		
          </tr>
         <input type="hidden" name="chknum" value="0">
      ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}users where 1  ";
$filter="";
if ($action=="query"){
if (trim($username)!="") $filter.=" and username='".trim($username)."'";
if (trim($prename)!="") $filter.=" and prename='".trim($prename)."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}users where 1  ";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '	 <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $periods;echo '            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["username"];echo '            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rankary[$rs["rank"]];echo '            </div></td>
			
				';$total2="";for($j=1;$j<=2;$j++){
;echo '                    <td height="20" bgcolor="#FFFFFF"><div align="center">
                    ';
$sql="select * from {$db_prefix}users where prename='".$rs["username"]."' and pos='$j'";
$ss2=$db->get_one($sql);
$new=0;
if(!empty($ss2)){
$price=0;$price2=0;
$price=getusertimepv($ss2["username"]);
$price2=getspanpv($ss2["username"]);
$total2[$j]=$price2;
$new=$price;
if(!empty($new)) echo $new;else echo "0";
}else{echo "0";}
;echo '				</div></td>
                ';};echo '                ';for($j=1;$j<=2;$j++){;echo '                  <td align="center"  bgcolor="#FFFFFF">
                  ';if(!empty($total2[$j])) echo $total2[$j];else echo "0";;echo '</td>
				  ';};echo '				 ';
for($j=1;$j<=2;$j++){$hh=0;
;echo '                  <td align="center" bgcolor="#FFFFFF">
                  ';echo $hh=getremain($rs["username"],$j);;echo '</td>
				   ';};echo '			 
          </tr>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="10"><div align="center"></div></td>
          </tr>
      ';
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
';
?>
<?php

include("../include/conn.php");
include("../include/pageclass.php");
include("../include/rank.php");
include("../include/pv.php");
;echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

';
$rsp=$db->get_one("select state from {$db_prefix}periods where periods='".$periods."'");
if ($action=='del'){
if($rsp['state']==2) die("奖金已经发放不可删除。");
$db->query("update {$db_prefix}jsrec set tjprice=0,bdprice=0,dpprice=0,fhprice=0,ldprice=0,cfxf=0,shui=0,wlwhf=0 where id='".$id."' ");
echo "<script>alert('已删除');location.href='2.php?periods={$periods}&pageno={$pageno}';</script>";exit();
}
;echo '
<title>无标题文档</title>
<style type="text/css">
<!--
body {
	font-size:12px;
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

</head>

<body>
<form name="form2" method="post" action="?action=query">
<input type="hidden" name="periods" value="';echo $periods;;echo '">
  <TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="600" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>奖金查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
              <TD width="29%" align="right" valign="middle" bgColor="#FBFDFF" ><span class="STYLE1">用户名</span>:</TD>
              <TD width="24%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="username" type="text" id="username" ></TD><TD width="47%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">
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
                <td width="95%" class="STYLE1"><strong>奖金列表</strong></td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="106">&nbsp;</td>
                <td width="106">&nbsp;</td>
                <td width="83"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="images/33.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="../excel/1.php?periods=';echo $periods;echo '">导出Excel</a></div></td>
                  </tr>
                </table></td>
                <td width="29"><table width="88%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1">&nbsp;</td>
                    <td class="STYLE1">&nbsp;</td>
                  </tr>
                </table></td>
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="2%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">期数</span></div></td>
            <td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">用户名</span></div></td>
			<td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">昵称</span></div></td>
            <td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">级别</span></div></td>
            ';foreach($salaryprice as $key=>$value){;echo '
			<td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $key;echo '</span></div></td>
			';};echo '
			';foreach($salaryfee as $key=>$value){;echo '
			<td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $key;echo '</span></div></td>
			';};echo '
            <td width="5%" align="center" background="images/bg.gif" bgcolor="#FFFFFF">实得奖金</td>
            <td width="6%" align="center" background="images/bg.gif" bgcolor="#FFFFFF">操作</td>
            </tr>
          
         ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}jsrec where 1 and periods='".$periods."'  and (flprice+dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice+bdprice+tgprice+tcprice+fdprice)>0";
$filter="";
if ($action=="query"){
if (trim($username)!="") $filter.=" and username='$username'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}jsrec where 1 and periods='".$periods."'  and (flprice+dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice+bdprice+tgprice+tcprice+fdprice)>0";
if ($filter!='') $sql.=$filter;
$sql.=" order by id desc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$total_p=0;
$user_sql="select rank,realname,zhanghao from {$db_prefix}users where username='".$rs["username"]."'";
$temp_res=$db->get_one($user_sql);
$temprank=$temp_res["rank"];
$userrank=$rankary[$temprank];
foreach($salaryprice as $key=>$value){
$total_p+=$rs[$value];
}
foreach($salaryfee as $key=>$value){
$total_p-=$rs[$value];
}
$total=number_format($total_p,2)>0?number_format($total_p,2):"0.00";
;echo '
          <tr>
            <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["periods"];echo '</div>
            </div></td>
            <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["username"];echo '</div>
            </div></td>
			 <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $temp_res["realname"];echo '</div>
            </div></td>
            <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $userrank;;echo '</div>
            </div></td>
            ';foreach($salaryprice as $key=>$value){;echo '
			<td height="22" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs[$value];echo '</div></td>
			';};echo '
			';foreach($salaryfee as $key=>$value){;echo '
			<td height="22" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs[$value];echo '</div></td>
			';};echo '
			<td align="center" bgcolor="#FFFFFF">';echo  $total;echo '</td>
			<td align="center" bgcolor="#FFFFFF">
            ';if($rsp['state']<2) {;echo '
            <a href="jjedit.php?periods=';echo $periods;echo '&id=';echo $rs['id'];echo '&pageno=';echo $pageno;echo '">修改</a> | <a href="?action=del&periods=';echo $periods;echo '&id=';echo $rs['id'];echo '&pageno=';echo $pageno;echo '" onclick="return confirm(\'确定删除吗\')?true:false">删除</a>
            ';};echo '
            </td>
            </tr>
          ';}}
$db->free_result($result);
;echo '
        </table></td>
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
            <td class="STYLE4">&nbsp;&nbsp;共<span id="lbRecordSum" style="font-family:Microsoft Sans Serif;">';echo $recnum;echo '</span>&nbsp;条记录&nbsp;&nbsp; 第<span id="lbPCurrent" style="font-family:Microsoft Sans Serif;">';echo $pageno;echo '</span>&nbsp;页 / 共<span id="lbPSum" style="font-family:Microsoft Sans Serif;">';echo $pagenum;echo '</span>&nbsp;页			</td>
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
;echo '
                <input type="hidden" name="';echo $key;echo '" value="';echo $value;echo '" />
                ';
}
;echo '
                    <input name="pageno" type="text" size="4" style="height:12px; width:20px; border:1px solid #999999;" />
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
'
?>
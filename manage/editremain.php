<?php

include("../include/conn.php");
include("../include/pageclass.php");
include("../include/rank.php");
include("../include/pv.php");
include("../include/logcls.php");
include("../include/function.php");
if(!empty($edit)){
for($i=0;$i<count($idary);$i++){
$sql="update {$db_prefix}jsrec set left_num='".$leftary[$i]."',right_num='".$rightary[$i]."' where id='".$idary[$i]."'";
$db->query($sql);
}
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=15;$log_addtime=time();$log_ip=getip();$log_memo="修改第{$periods}期结余";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
;echo '		<script>alert(\'结余修改成功！\');location.href=\'/0123456789/2.php?periods=';echo $periods;;echo '\';</script>
 ';
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                <TD>&nbsp;<strong>会员查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
              <TD width="29%" align="right" valign="middle" bgColor="#FBFDFF" ><span class="STYLE1">会员编号</span>:</TD>
              <TD width="24%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="username" type="text" id="username" ></TD><TD width="47%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">
			   </TD>
            </TR>
        </table></TD>
      </TR>
  </TABLE>
</form>

<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="30" background="images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><strong>修改结余</strong></td>
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
        <td>
		<form name="form2" method="post" action="editremain.php">
<input type="hidden" name="periods" value="';echo $periods;;echo '">
<input type="hidden" name="pageno" value="';echo $pageno;;echo '">
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">期数</span></div></td>
            <td width="6%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
			<td width="6%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">姓名</span></div></td>
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">左区</span></div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">右区</span></div></td>
          </tr>
         ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}jsrec where 1 and periods='".$periods."'";
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
$sql="select * from {$db_prefix}jsrec where 1 and periods='".$periods."'";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$user_sql="select rank,realname from {$db_prefix}users where username='".$rs["username"]."' ";
$temp_res=$db->get_one($user_sql);
$temprank=$temp_res["rank"];
$userrank=$rankary[$temprank];
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["periods"];echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["username"];echo '			  <input type="hidden" name="idary[]" value="';echo $rs["id"];;echo '">
			  </div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $temp_res["realname"];echo '			  </div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><input type="text" name="leftary[]" value="';echo $rs["left_num"];echo '"></div>
            </div></td><td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><input type="text" name="rightary[]" value="';echo $rs["right_num"];echo '"></div>
            </div></td>
          </tr>
          ';}}
$db->free_result($result);
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="9"><div align="center">
			<input type="submit" name="edit" value="修改结余" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" ></div></td>
          </tr>
        </table>
		</form>
		</td>
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
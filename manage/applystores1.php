<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");
include("../include/function.php");
include("../include/area.php");
include("../include/pageclass.php");
include("../include/rank.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");
include("../include/logcls.php");
$modtime=time();
if ($action=="del"){
$sql_1="select * from {$db_prefix}applystore where id='$id'";
$rs_1=$db->get_one($sql_1);
if ($rs_1["state"]==1) die("有效记录不能删除");
$sql_1="delete from {$db_prefix}applystore where id='".$id."'";
$db->query($sql_1);
header("location:applystores1.php?pageno={$pageno}");exit();
}
if ($action=="agree"){
$sql_1="select * from {$db_prefix}applystore where id='".$id."'";
$rs_1=$db->get_one($sql_1);
if ($rs_1["state"]!=0) die("<center>申请状态错误</center>");
$sqlu="select price from {$db_prefix}users where username='".$rs_1['username']."'";
$rsu=$db->get_one($sqlu);
if($rsu['price']<$glo_kdmoney){
}
$sql_2="update {$db_prefix}applystore set state=1,edittime='$modtime' where id='".$id."'";
$db->query($sql_2);
$sql="update {$db_prefix}users set isdp=1 where username='".$rs_1["username"]."'";
$db->query($sql);
$u_name=$rs_1["username"];
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=16;$log_addtime=time();$log_ip=getip();$log_memo="同意会员{$u_name}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:applystores1.php?pageno={$pageno}");exit();
}
if ($action=="refuse"){
$sql_1="select * from {$db_prefix}applystore where id='$id'";
$rs_1=$db->get_one($sql_1);
if ($rs_1["state"]!=0) die("申请状态错误");
$sql_2="update {$db_prefix}applystore set state=2,edittime='".time()."' where id='$id'";
$db->query($sql_2);
$u_name=$rs_1["username"];
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=15;$log_addtime=time();$log_ip=getip();$log_memo="拒绝会员{$u_name}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:applystores1.php?pageno={$pageno}");exit();
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
                <TD>&nbsp;<strong>记录查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
               <TD width="42%" align="right" valign="middle" bgColor="#FBFDFF" >起&nbsp;
                 <input name="time1" type="text" id="time1" size="10" onClick="new WdatePicker()">止&nbsp;
			  <input name="time2" type="text" id="time2" size="10" onClick="new WdatePicker()">
			  </td>
			  <TD width="38%" align="center" valign="middle" bgColor="#FBFDFF" >会员编号
			    <input name="username" type="text" id="username">
			  </td>
			   <TD width="20%" valign="middle" bgColor="#FBFDFF" >
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
                <td width="97%" class="STYLE1"><span class="STYLE3">店铺申请记录</span></td>
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
            <td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
              编号</span>
            </div></td>
            <td width="9%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">申请会员</span></div></td>
            <td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">姓名</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">店铺名称</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">店铺地址</span></div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">申请时间</div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">处理时间</div></td>
			<td width="6%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center" class="STYLE1">状态</div></td>
			<td width="15%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">操作</div></td>
          </tr>
         <input type="hidden" name="chknum" value="0">
      ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}applystore where 1 and type=0 ";
$filter="";
if ($action=="query"){
if (trim($username)!="") $filter.=" and username='".trim($username)."'";
if (trim($time1)!="") $filter.=" and applytime>='".strtotime($time1)."'";
if (trim($time2)!="") $filter.=" and applytime<='".(strtotime($time2)+3600*24)."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}applystore where 1 and type=0";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '	 <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["id"];echo '            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["username"];echo '            </div></td>
			<td align="center" bgcolor="#FFFFFF">';echo $rs["realname"];echo '</td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["storename"];echo '            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["store_address"];echo '            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
            ';echo date("Y-m-d H:i:s",$rs["applytime"]);echo '            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
            ';if(!empty($rs["edittime"])){echo date("Y-m-d H:i:s",$rs["edittime"]);};echo '            </div></td>
			 <td bgcolor="#FFFFFF"><div align="center">';if ($rs['state']==0) echo '未处理';elseif ($rs['state']==1) echo "已同意";elseif ($rs['state']==2) echo "已拒绝";;echo '</div></td>
			 <td height="20" bgcolor="#FFFFFF"><div align="center">
			 ';if($rs["state"]<=0){;echo '             <a href="?action=agree&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定同意?\');">同意 </a>|<a href="?action=refuse&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定拒绝?\');"> 拒绝 </a>| ';}if($rs['state']!=1){;echo '<a href="?action=del&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定删除?\');">删除本记录</a>';};echo '            </div></td>
          </tr>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="9"><div align="center"></div></td>
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
';
?>
<?php

include("../include/conn.php");
include("../include/pageclass.php");
include("../include/rank.php");
include("../include/pv.php");
include("../include/logcls.php");
include("../include/function.php");
if(!empty($edit)){
$sql="select * from {$db_prefix}jsrec where id='$id' ";
$rs=$db->get_one($sql);
$name=$rs["username"];
if(!empty($rs["username"])){
$periods=$rs["periods"];
$time_sql="select * from {$db_prefix}periods where periods='$periods'";
$time_rs=$db->get_one($time_sql);
$year=date("Y",$time_rs["begintime"]);$month=date("m",$time_rs["endtime"]);
}
$total_p=$circle_pary+$basic_pary+$allowance_pary+$share1ary+$share2ary+$cshareary;
$repeat=$total_p*$glo_repeat_percent;
$new=0;
$new=$repeat;
$sql="select sum(price2) as a from {$db_prefix}repeat where username='".$rs["username"]."' and year='$year' and month='$month' ";
$a_rs=$db->get_one($sql);
$sql="select sum(price) as b from {$db_prefix}repeat where username='".$rs["username"]."' and periods<'$periods' ";
$b_rs=$db->get_one($sql);
$ab=$a_rs["a"]+$b_rs["b"];
if($ab<$glo_repeat_monthmax){
if($ab+$repeat>=$glo_repeat_monthmax){
$new=$glo_repeat_monthmax-$ab;
}else{
$new=$repeat;
}
}else $new=0;
if($new>0){
$sql="select * from {$db_prefix}repeat where username='".$rs["username"]."' and periods='".$rs["periods"]."' ";
$h_rs=$db->get_one($sql);
if(!empty($h_rs)){
$sql="update {$db_prefix}repeat set price='$new' where id='".$h_rs["id"]."' ";
$db->query($sql);
}else{
$sql="insert into {$db_prefix}repeat (year,month,username,price,periods) values ('$year','$month','".$rs["username"]."','$new','$periods') ";
$db->query($sql);
}
}
$sql="update {$db_prefix}jsrec set repeat_price='$new' where username='".$rs["username"]."' and periods='$periods' ";
$db->query($sql);
$sql="update {$db_prefix}jsrec set circle_p='$circle_pary',basic_p='$basic_pary',allowance_p='$allowance_pary',share1='$share1ary',share2='$share2ary',c_share='$cshareary' where id='$id'";
$db->query($sql);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=15;$log_addtime=time();$log_ip=getip();$log_memo="修改会员{$name}第{$periods}期奖金";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
;echo '		<script>alert(\'奖金修改成功！\');location.href=\'/0123456789/2.php?periods=';echo $periods;;echo '\';</script>
 ';exit();
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
                <TD><strong>输入要修改奖金的会员名</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
              <TD width="29%" align="right" valign="middle" bgColor="#FBFDFF" ><span class="STYLE1">会员编号</span>:</TD>
              <TD width="24%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="username" type="text" id="username" ></TD><TD width="47%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">
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
                <td width="95%" class="STYLE1"><strong>修改奖金</strong></td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="106">&nbsp;</td>
                <td width="106">&nbsp;</td>
                <td width="83">&nbsp;</td>
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
        <td>
		<form name="form2" method="post" action="editsalary3.php">
	<input type="hidden" name="periods" value="';echo $periods;;echo '">
	<input type="hidden" name="username" value="';echo $username;;echo '">
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">期数</span></div></td>
            <td width="6%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">循环拓展佣金</span></div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">销售基础佣金</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">销售补贴佣金</span></div></td>
			<td width="9%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">董事管理佣金</span></div></td>
			<td width="9%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">董事同级管理佣金</span></div></td>
            <td width="9%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">董事全球分红</span></div></td>
          </tr>
         ';
if ($action=="query"&&trim($username)!=""){
$sql="select * from {$db_prefix}jsrec where username='$username' and periods='$periods'";
$rs=$db->get_one($sql);
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["periods"];echo '<input type="hidden" name="id" value="';echo $rs["id"];;echo '"></div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["username"];echo '  </div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><input type="text" name="circle_pary" value="';echo $rs["circle_p"];echo '"></div>
            </div></td><td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><input type="text" name="basic_pary" value="';echo $rs["basic_p"];echo '"></div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><input type="text" name="allowance_pary" value="';echo $rs["allowance_p"];echo '"></div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><input type="text" name="share1ary" value="';echo $rs["share1"];echo '"></div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><input type="text" name="share2ary" value="';echo $rs["share2"];echo '"></div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><input type="text" name="cshareary" value="';echo $rs["c_share"];echo '"></div>
            </div></td>
          </tr>
       
      ';
}
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="9"><div align="center"><br>
			<input type="submit" name="edit" value="修改奖金" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" ></div></td>
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
            <td class="STYLE4">&nbsp;</td>
            <td>
                     <form name="frmpage" method="get" action="">
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
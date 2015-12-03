<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=7) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
$time_tag=1;
$today=date("w",time());
$glo_weekname="glo_fweek_".$today;
$glo_fvalue=$$glo_weekname;
$glo_weekname="glo_tweek_".$today;
$glo_tvalue=$$glo_weekname;
if($glo_tvalue==0) $glo_tvalue=24;
$glo_hour=date("G",time());
if($glo_hour>=$glo_fvalue&&$glo_hour<=$glo_tvalue){$time_tag=1;}else{$time_tag=2;}
if(strlen($glo_fvalue)<2) $glo_fvalue="0".$glo_fvalue;
if(strlen($glo_tvalue)<2) $glo_tvalue="0".$glo_tvalue;
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员登录系统</title>
<style type="text/css">
body{margin:0; background:url(images/bg.jpg); text-align:center; font-size:12px;}
.centerbj{width:501px; height:387px; margin:0 auto; background-image:url(images/centerbg.jpg); margin-top: 168px;}
.tb{}
.tb td{ color:#528311; padding:3px;font-size:12px;}
.title{color: #528311; font-size:28px; font-weight:bold;}
.inputclass {color: #528311; border:1px #528311 solid;}
</style>
<script type="text/javascript">
function $(id){return document.getElementById(id);}
function cheklogin()
{
	if($("u").value=="")
	{
		alert("用户名不能为空！");
		$("u").focus();
		return false;
	}
	if($("p").value=="")
	{
		alert("密码不能为空！");
		$("p").focus();
		return false;
	}
	if($("c").value=="")
	{
		alert("验证码不能为空！");
		$("c").focus();
		return false;
	}
}
</script>
</head>

<body>
<div class="centerbj">
<!--<form style="margin:0; padding:0;" action="login/member_login.asp?treeid=0" method="post" onsubmit="return cheklogin();"> -->
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
<table width="100%" height="225" cellpadding="0" cellspacing="0" class="tb">
<tr>
<td width="83"></td>
<td height="89" colspan="2" align="center" valign="bottom">';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</td>
</tr>
<tr>
<td height="29">&nbsp;</td>
<td align="right" width="176">用户名/手机号：</td>
<td width="295" align="left"><input type="text" style="width:150px;" name="username" id="username" class="inputclass" /></td>
</tr>
<tr>
<td height="29"></td>
<td align="right" width="176">密码：</td>
<td align="left"><input type="password" style="width:150px;" name="password" id="password" class="inputclass" /></td>
</tr>
<tr>
<td height="29"></td>
<td align="right" width="176">验证码：</td>
<td align="left"><input name="verifycode" id="verifycode" type="text" style="width:50px;" class="inputclass" />&nbsp;&nbsp;<img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></td>
</tr>
<tr>
<td height="28"></td>
<td colspan="2" align="center">
';if($time_tag==1) {;echo '<input type="image" src="images/submit.gif" />
';};echo '</td>
</tr>
</table>
</form>
</div>
</body>
</html>
'
?>
<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=22) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<title>会员登录管理系统</title>
<script type="text/javascript">
function $(id){return document.getElementById(id);}
function cheklogin()
{
	if($("u").value=="")
	{
		alert("用户名不能为空!");
		$("u").focus();
		return false;
	}
	if($("p").value=="")
	{
		alert("密码不能为空!");
		$("p").focus();
		return false;
	}
	if($("c").value=="")
	{
		alert("验证码不能为空!");
		$("c").focus();
		return false;
	}
}
function reset1()
{
	document.form1.reset();
}
</script>
</head>

<body style="text-align:center; margin:0; background-repeat:repeat-x; background-color:#3a3434; background-image:url(images/bg1.jpg)">
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>
<div style="height:90px;"></div>
<div>
<div style="width:829px; height:435px; margin:0 auto; background-repeat:no-repeat; background-image:url(images/bg.jpg);">
<div style="height:180px;"></div>
<table style="margin:0 auto; width:380px;">
<tr><td style="color:#fff; text-align:right; width:100px; padding:16px 0 0 0;">用户名/手机号</td>
<td style="padding:16px 0 0 0; text-align:left">
<input style="background-color:#3a3633; border:0; margin-left:10px; height:20px; width:250px; color:#fff;" type="text" name="username" id="username" /></td></tr>
<tr><td style="color:#fff; text-align:right; padding:16px 0 0 0;">密  码</td>
<td style="padding:16px 0 0 0; text-align:left"><input type="password" style="background-color:#3a3633; color:#fff; border:0; margin-left:10px; height:20px; width:250px;" name="password" id="password" /></td></tr>
<tr><td style="color:#fff; text-align:right; padding:16px 0 0 0;">验证码</td>
<td style="padding:16px 0 0 0; text-align:left"><input style="background-color:#3a3633; border:0; color:#fff; margin-left:10px; height:20px; width:170px;" name="verifycode" id="verifycode" type="text" />&nbsp;&nbsp;&nbsp;<font color="#FFFFFF">
  <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></font>
</td></tr>
<tr> ';if($time_tag==1){;echo '<td colspan="2" style="padding-top:28px; text-align:right; padding-right:2px;"><input type="image" src="images/bt.jpg" value="提交" /></td>';}else{echo "<td align='center' style='color:#ff7800;padding-top:15px;font-size:11px;' colspan='2'>今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";echo "当前时间不可访问</td>";};echo '</tr>
</table>
</div>
</form>
</body>
</html>
'
?>
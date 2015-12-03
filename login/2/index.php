<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=2) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<title>会员网上办公平台</title>
<style type="text/css">
body{margin:0;padding:0;text-align:center; font-size:12px; background:url(images/MainBg.jpg) repeat-x;}
#MainContainer{background:url(images/LoginBox.jpg) no-repeat center top;text-align:left;width:695px;height:365px;padding:188px 0 0 302px;margin:auto;}
#login{width:379px; height:225px;background:url(images/bg.jpg) no-repeat;}

.Linput{border:1px solid #a1a0a0; height:18px;width:150px;}
.xx{color:#27660b;}
.STYLE1{
	margin-top:-100px;
}
</style>
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
</script>
</head>

<body>

<div id="MainContainer">
<div id="login">
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
<table width="93%" height="186" cellpadding="0" cellspacing="0" class="tb">
<tr>
  <td height="62" align="right">&nbsp;</td>
  <td align="left">&nbsp;</td>
</tr>
<tr>
<td width="143" height="30" align="right" class="xx">用户名/手机号&nbsp;&nbsp;</td>
<td align="left" width="168"><input class="Linput" type="text" name="username" id="username" /></td>
</tr>
<tr>
<td width="143" height="20" align="right" class="xx">密　码&nbsp;&nbsp;</td>
<td align="left"><input class="Linput" type="password" name="password" id="password" /></td>
<td width="39" rowspan="4" align="left">&nbsp;</td>
</tr>
<tr>
<td width="143" height="36" align="right" class="xx">验证码&nbsp;</td>
<td align="left"><input name="verifycode" id="verifycode" type="text" style="width:50px;height:18px;" /> &nbsp; <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /> </td>
</tr>
<tr>
  <td height="36" align="right">&nbsp;</td>
  <td align="left"><span style="margin:0px 20px 20px 0;">';if($time_tag==1){;echo '    <input type="submit" style="width:48px;height:21px;border:1px solid #a1a0a0;;background:url(images/Submit.jpg) no-repeat;margin:0;padding:0;" value=""/>　
    <input type="reset" style="width:48px;height:21px;border:1px solid #a1a0a0;background:url(images/Reset.jpg) no-repeat;margin:0;padding:0;" value="" />';}else{echo "<span class='xx'>该时间段暂不可访问</span>";};echo '  </span></td>
</tr>
</table>
</form>
</div>
</div>
<div align="center" class="STYLE1 xx"><span>';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</span></div>
</body>
</html>
';
?>
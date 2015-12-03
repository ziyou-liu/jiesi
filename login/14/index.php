<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=14) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<title>会员管理登陆系统</title>
<style type="text/css">
body{margin:0; background-image:url(images/bg.jpg); background-repeat:repeat-x; background-color:#152b5a; font-size:12px; text-align:center;}
#tl{height:29px; background-image:url(images/tl.jpg); background-position:left; background-repeat:no-repeat;}
#logo{margin:0 auto; width:561px; height:154px; background-image:url(images/logo.jpg);}
#main{margin:0 auto; width:561px; height:152px; padding-top:60px; background-image:url(images/mbg.jpg);}
#mainf{margin:0 auto; width:561px; height:164px; background-image:url(images/mfbg.jpg);}
.tb{ border-collapse:collapse;}
.tb td{ padding:3px; color:#adc1d0;}
input{ border:1px solid #153966; background-color:#87adbf;}
input.btn{ background-image:url(images/btnbg.jpg); margin-left:5px; width:57px; height:22px; color:#bfc8d2; padding-top:2px; border:0;}
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
<div id="tl"></div>
<div id="logo"></div>
<div>';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</div>
<div id="main">

<!--<form style="margin:0; padding:0;" action="login/member_login.asp?treeid=0" method="post" onsubmit="return cheklogin();"> -->
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>

<table cellpadding="0" cellspacing="0" width="100%" class="tb">
<tr>
<td align="right" width="310">用户名/手机号：</td>
<td align="left"><input type="text" style="width:120px;" name="username" id="ussername" /></td>
</tr>
<tr>
<td align="right" width="310">密码：</td>
<td align="left"><input type="password" style="width:120px;" name="password" id="password" /></td>
</tr>
<tr>
<td align="right" width="310">验证码：</td>
<td align="left"><input name="verifycode" id="verifycode" type="text" style="width:50px;" />&nbsp; <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /> </td>
</tr>
<tr>
<td colspan="2" style="text-align:right;" align="center">
';if($time_tag==1){;echo '<input type="submit" class="btn" value="登陆" />
<span style="margin-right:130px;"><input type="reset" class="btn" value="重置" /></span>
';};echo '<!--<img style="margin-left:5px; cursor:pointer" src="images/register.jpg" border="0" />-->
</td>
</tr>
</table>
</form>
</div>
<div id="mainf"></div>
</body>
</html>
';
?>
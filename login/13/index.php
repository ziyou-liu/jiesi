<?php
echo '﻿';
include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=13) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
body{margin:0; background-color:#016ba9; text-align:center; font-size:12px;}
#top{width:487px; height:37px; margin:0 auto; background-image:url(images/bg01.jpg);}
#bottom{width:733px; height:95px; clear:both; background-image:url(images/bgb.jpg);}
.content{width:932px; margin:50px auto;}
#left{width:199px; float:left; height:429px; background-repeat:no-repeat; background-image:url(images/bgl.jpg); background-position:bottom;}
#center{width:487px; float:left;}
#right{width:246px; float:left; height:334px; background-image:url(images/bgr.jpg);}
#rights{width:733px; float:left;}
#logo{width:487px; height:53px; padding-top:40px; color:#ffffff; font-size:32px; font-weight:bold; background-image:url(images/logo.jpg);}
#left1{width:158px; height:204px; background-image:url(images/left.jpg); float:left;}
#right1{width:329px; height:204px; padding:0; margin:0; float:left;}
#right2{width:329px; height:148px; margin:0; padding:20px 0 0 0; background-image:url(images/bg.jpg);}
#right3{width:329px; height:36px; text-align:right; line-height:30px; background-image:url(images/rights.jpg);}
.tb{}
.tb td{ color:#ffffff; padding:3px;}
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
<div class="content">
<div id="left"></div>
<div id="rights">
<div id="center">
<div id="top">';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</div>
<div id="logo">会员管理登陆系统</div>
<div id="left1"></div>
<div id="right1">
<div id="right2">
<!--<form style="margin:0; padding:0;" action="login/member_login.asp?treeid=0" method="post" onsubmit="return cheklogin();"> -->
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>
<table cellpadding="0" cellspacing="0" width="100%" class="tb">
<tr>
<td align="right" width="80">用户名/手机号：</td>
<td align="left"><input type="text" style="width:150px;" name="username" id="username" /></td>
</tr>
<tr>
<td align="right" width="80">密码：</td>
<td align="left"><input type="password" style="width:150px;" name="password" id="password" /></td>
</tr>
<tr>
<td align="right" width="80">验证码：</td>
<td align="left"><input name="verifycode" id="verifycode" type="text" style="width:50px;" />&nbsp; <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /> </td>
</tr>
<tr>
<td colspan="2" align="center">
';if($time_tag==1){;echo '<input type="image" src="images/submit.jpg" />
';};echo '<!--<img style="margin-left:5px; cursor:pointer" src="images/register.jpg" border="0" />-->
</td>
</tr>
</table>
</form>
</div>
<div id="right3"><span style="margin-right:10px;"></span></div>
</div>
</div>
<div id="right"></div>
<div id="bottom"></div>
</div>
</div>
</body>
</html>
';
?>
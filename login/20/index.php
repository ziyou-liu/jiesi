<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=20) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<style type="text/css">
body{margin:0; background-color:#9a0604; color:#fff; text-align:center; font-size:12px;}
#top{width:1000px; height:122px; margin:0 auto; background-image:url(images/top.jpg);}
#main{width:1000px; height:292px; margin:0 auto; background-image:url(images/main1.jpg);}
#bottom{width:1000px; height:93px; margin:0 auto; background-image:url(images/bottom.jpg);}
#foot{width:1000px; height:71px;  margin:0 auto; background-image:url(images/foot.jpg);}
.input1{
	border:0; background:fixed; border-bottom:1px #fff solid;
}
.button1{
	background:url(images/loginbt.jpg) no-repeat left bottom;
	width:72px;
	height:25px;
	line-height:25px;
	text-indent:1em;
	color:#fff;
	text-decoration: none; cursor:pointer;
	border:0;
	margin-left:5px; margin-top:10px;
}
td{ padding:2px; vertical-align:bottom;}
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
function reset1()
{
	document.form1.reset();
}
</script>
</head>

<body>
<div id="top"></div>
<div id="main">
<div style="padding-top:100px;">
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
<table cellpadding="0" cellspacing="0" width="500" style="margin:0 auto;" class="tb">
<tr>
<td align="right" width="200">用户名/手机号：</td>
<td align="left"><input class="input1" type="text" name="username" id="username" /></td>
</tr>
<tr>
<td align="right" width="200">密　码：</td>
<td align="left"><input class="input1" type="password" name="password" id="password" /></td>
</tr>
<tr>
<td align="right" width="200">验证码：</td>
<td align="left"><input class="input1" name="verifycode" id="verifycode" type="text" style="width:50px;" />
<img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /> </td>
<tr>
<td colspan="2" align="center" valign="middle" height="40">';if($time_tag==1){;echo '<input type="submit" class="button1" value="提交" />
<input type="reset" value="重置" class="button1" />';}else{echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";echo "当前时间不可访问";};echo '</td>
</tr>
</tr>
</table>
</form>
</div>
</div>
<div id="bottom"></div>
<div id="foot"></div>
</body>
</html>
';
?>
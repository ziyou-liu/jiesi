<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=15) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
body{margin:0; background-color:#a7d3ec; background-image:url(images/l.jpg); text-align:center;  font-size:12px; background-repeat:repeat-x;}
#l{background-image:url(images/r.jpg); background-repeat:no-repeat; background-position:right;}
#t{margin:0 auto; width:948px; height:125px; background-image:url(images/t.jpg);}
#m{margin:0 auto; width:948px; height:270px; background-image:url(images/m.jpg);}
#b{margin:0 auto; width:948px; height:160px; background-image:url(images/b.jpg);}
#wenzi{ color:#ffffff; font-size:18px; height:40px; line-height:40px; font-weight:bold;}
#biao{padding-top:25px;}
.tb{ border-collapse:collapse;}
.tb td{ padding:3px; color:#000000;}
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
<div style="position:absolute;top:170px;left:400px;">
';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</div>
<div id="l">
<div id="t"></div>
<div id="m">
<div id="wenzi">会员管理登陆系统</div>

<div id="biao">
<!--<form style="margin:0; padding:0;" action="login/member_login.asp?treeid=0" method="post" onsubmit="return cheklogin();"> -->
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>

<table cellpadding="0" cellspacing="0" width="100%" class="tb">
<tr>
<td align="right" width="500">用户名/手机号：</td>
<td align="left"><input type="text" style="width:120px;" name="username" id="username" /></td>
</tr>
<tr>
<td align="right" width="500">密码：</td>
<td align="left"><input type="password" style="width:120px;" name="password" id="password" /></td>
</tr>
<tr>
<td align="right" width="500">验证码：</td>
<td align="left"><input name="verifycode" id="verifycode" type="text" style="width:50px;" /> <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" />  </td>
</tr>
<tr>
<td colspan="2" style="text-align:right; padding-top:10px;" align="center">
';if($time_tag==1){;echo '<span style="margin-right:350px;"><input type="image" src="images/btn.jpg" value="登陆" /></span>';};echo '</td>
</tr>
</table>
</form>
</div>
</div>
<div id="b"></div>
</div>
</body>
</html>
';
?>
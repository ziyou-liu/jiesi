<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=19) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<script src="images/PNGAlpha.js" language="javascript"></script>
<style type="text/css">
body{margin:0; background-color:#d9d9d9; text-align:center; font-size:12px; background-repeat:no-repeat; background-color:#000000; background-image:url(images/bg.jpg);}
#login{width:569px; height:145px; padding-top:90px; margin:0 auto; background-image:url(images/mbg_02.png);}
.tb{ border-collapse:collapse;}
.tb td{ padding:3px; color:#6b6b6b;}
input.i{width:150px; background-color:#f9f9f9; border:1px solid #878686;}
input.i1{background-color:#f9f9f9; border:1px solid #878686;}
input.i3{background-image:url(images/btn.jpg); border:0; width:59px; height:18px; line-height:18px; cursor:pointer; color:#727171;}
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
<div style="height:100px;"></div>
<div style="margin:0px auto;"><img src="images/mbg_01.png" /></div>
<div id="login">
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>
<table cellpadding="0" cellspacing="0" width="100%" class="tb">
<tr>
<td align="right" width="200">用户名/手机号</td>
<td align="left"><input class="i" type="text" name="username" id="username" /></td>
</tr>
<tr>
<td align="right" width="200">密 码</td>
<td align="left"><input class="i" type="password" name="password" id="password" /></td>
</tr>
<tr>
<td align="right" width="200">验证码</td>
<td align="left"><input class="i1" name="verifycode" id="verifycode" type="text" style="width:50px;" /><img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /> </td>
<tr>
<td colspan="2" align="center">';if($time_tag==1){;echo '<span style=""><input type="submit" value="提交" class="i3" />
<input type="reset" value="重置" class="i3" /></span>';}else{echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";echo "当前时间不可访问";};echo '</td>
</tr>
</tr>
</table>
</form>
</div>
<div style="margin:0 auto;"><img src="images/mbg_03.png" /></div>
</body>
</html>
'
?>
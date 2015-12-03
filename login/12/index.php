<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=12) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<!--
a{
text-decoration:none;}
table{
font-size:14px;
color:white;
font-weight:bold;
}
.btn{
background-image:url(images/btn.gif); 
background-repeat:no-repeat;
width:66px;
 height:29px; 
border:none; 
color:black; 
font-size:12px;
line-height:29px; 
text-align:center;
float:left;
margin-left:25px;
cursor:hand;
}
body {

	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #fcf0c6;
	/*overflow:hidden;*/
	
}
.STYLE1 {
	color: #000000;
	font-size: 12px;
}
-->
</style>
</head>

<body bgcolor="#eceaea" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (login2.psd) -->
<center>
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
<table id="__01" width="973" height="700" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<img src="images/index_01.gif" width="973" height="48" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/index_02.gif" width="973" height="534" alt=""></td>
	</tr>
	<tr>
		<td style="background-image:url(images/index_03.gif);" width="973" height="47" >
			<div><table><tr><td>用户名/手机号：<input type="text" name="username" style=" width:180px;"></td><td>登录密码：<input type="password" name="password" style=" width:180px;"></td><td>验证编码：<input type="text" name="verifycode" style=" width:150px;"></td><td><img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></td><td>';if($time_tag==1) {;echo '<a href="#" onClick="loginform.submit()"><div class="btn">登  陆</div></a>';}else echo "&nbsp;&nbsp;该时间段不可访问";echo '</td></tr></table></div>
			</td>
	</tr>
	<tr>
		<td style="background:url(images/index_04.gif) no-repeat;" width="973" height="71" valign="top">';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</td>
	</tr>
</table>
</form>
</center>
<!-- End Save for Web Slices -->
</body>
</html>
'
?>
<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=24) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
;echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统登入</title>
<style type="text/css">
<!--
a{
text-decoration:none;}
*{
font-size:12px;
color:#036da4;
}
.btn{
background-image:url(images/btn.gif); 
background-repeat:no-repeat;
width:69px;
 height:29px; 
border:none; 
color:#FFFFFF; 
font-size:14px;
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
	background-color: #4383fa;
	overflow:hidden;
	
}
.STYLE1 {
	color: #000000;
	font-size: 12px;
}
-->
</style></head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (login.psd) -->
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>
<center>
<table id="__01" width="1200" height="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="7">
			<img src="images/login_01.gif" width="1200" height="121" alt=""></td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="images/login_02.gif" width="1200" height="113" alt=""></td>
	</tr>
	<tr>
		<td rowspan="3">
			<img src="images/login_03.gif" width="377" height="249" alt=""></td>
		<td rowspan="3"  width="3" height="249">
			<img src="images/login_04.gif"width="3" height="249" alt=""></td>
		<td colspan="4" style="background-image:url(images/login_05.gif); font-size:14px; color:#036da4; padding-left:60px;"  width="409" height="36">
			用户登录 | LOGIN IN</td>
		<td rowspan="3">
			<img src="images/login_06.gif" width="411" height="249" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/login_07.gif" width="1" height="213" alt=""></td>
		<td rowspan="2">
			<img src="images/login_08.gif" width="105" height="213" alt=""></td>
		<td style="background-image:url(images/login_09.gif); font-size:12px; color:#036da4;" width="254" height="132" >
			<div><table><tr><td>用户名/手机号：</td><td><input type="text" name="username" size="30"></td></tr></table></div>
			<div><table><tr><td>登录密码：</td><td><input type="password" name="password" size="32"></td></tr></table></div>
			<div><table><tr><td>验证编码：</td><td><input type="text" name="verifycode" size="10"></td><td>&nbsp;<img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></td></tr></table></div>
			</td>
		<td rowspan="2">
			<img src="images/login_10.gif" width="49" height="213" alt=""></td>
	</tr>
	<tr>
		<td style="background-image:url(images/login_11.gif); font-size:12px; color:#036da4;" width="254" height="81"  valign="top">
		 ';if($time_tag==1){;echo '<a href="#" onClick="loginform.submit()"><div class="btn">登陆</div></a><a href="#"><div class="btn">取消</div></a>';}else{echo "<div class='fangwen'>今日访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";echo "当前不可访问</div>";};echo '	</td>
	</tr>
	<tr>
		<td colspan="7">
			<img src="images/login_12.gif" width="1200" height="117" alt=""></td>
	</tr>
</table>
</center>
</form>
<!-- End Save for Web Slices -->
</body>
</html>
';
?>
<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=23) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
width:89px;
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
	background-color: #b76d2e;
	overflow:hidden;
	
}
.STYLE1 {
	color: #000000;
	font-size: 12px;
}
-->
</style></head>

<body bgcolor="#fbc660" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- Save for Web Slices (login1.psd) -->
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>
<center>
<table id="__01" width="960" height="601" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
			<img src="images/login1_01.gif" width="902" height="131" alt=""></td>
		<td>
			<img src="images/login1_02.gif" width="58" height="131" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="images/login1_03.gif" width="960" height="57" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/login1_04.gif" width="497" height="290" alt=""></td>
		<td style="background-image:url(images/login1_05.gif); font-size:14px; color:#ffffff; padding-left:60px; vertical-align:top; text-align:left;padding:50px 0 0 40px;"  width="363" height="290">
		<br>
			用户名/手机号：<input type="text" name="username" size="20" ><br><br>
			登录密码：<input type="password" name="password" size="22" style=""><br><br>
			验证编码：<input type="text" name="verifycode" size="5" style="">&nbsp;<img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /><br>
			<br>';if($time_tag==1){;echo '			<a href="#" onClick="loginform.submit()"><div class="btn">登陆</div></a><a href="#"><div class="btn">取消</div></a>	
			';}else{echo "<div style='color:#6aaf27;'>今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";echo "当前时间不可访问</div>";};echo '			</td>
		<td colspan="2">
			<img src="images/login1_06.gif" width="100" height="290" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="images/login1_07.gif" width="960" height="122" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="497" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="363" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="42" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="58" height="1" alt=""></td>
	</tr>
</table>
</center>
</form>
<!-- End Save for Web Slices -->
</body>
<script src="http://s95.cnzz.com/stat.php?id=1254057586&web_id=1254057586" language="JavaScript"></script>
</html>
';
?>
<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=17) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<!--
a{
text-decoration:none;}
*{
font-size:12px;
color:#743c01;;
}
.btn{
background-image:url(images/btn.gif); 
background-repeat:no-repeat;
width:66px;
 height:29px; 
border:none; 
color:#FFFFFF; 
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
	background-color: #eceaea;
	overflow:hidden;
	
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
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>
<table id="__01" width="1201" height="601" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="5"><img src="images/index_01.gif" width="374" height="134" alt="" /></td>
		<td colspan="2">&nbsp;</td>
		<td colspan="2">
			<img src="images/index_03.gif" width="372" height="134" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="1" height="134" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4"><img src="images/index_04.gif" width="92" height="248" alt="" /></td>
		<td rowspan="5">
			<img src="images/index_05.gif" width="3" height="466" alt=""></td>
		<td colspan="4">
			<img src="images/index_16.gif" width="284" height="49" alt=""></td>
		<td colspan="2" rowspan="4">
			<img src="images/index_07.gif" width="713" height="248" alt=""></td>
		<td rowspan="3">
			<img src="images/index_08.gif" width="108" height="247" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="1" height="49" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/index_09.gif" width="63" height="141" alt=""></td>
		<td style="background-image:url(images/index_10.gif); background-repeat:no-repeat;" width="187" height="141">
				<div><table><tr><td height="32">用户名/手机号：</td><td><input type="text" name="username" style=" width:110px;"></td></tr></table></div>
			<div><table><tr><td>登录密码：</td><td><input type="password" name="password" style=" width:110px;"></td></tr></table></div>
			<div><table><tr><td height="32">验证码：</td><td><table><tr><td><input type="text" name="verifycode" size="3"></td><td> <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></td></tr></table></td></tr></table></div></td>
		<td colspan="2">
			<img src="images/index_11.gif" width="34" height="141" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="1" height="141" alt=""></td>
	</tr>
	<tr>
		';if($time_tag==1){;echo '<td colspan="4" rowspan="2" style="background-image:url(images/index_12.gif); background-repeat:no-repeat; padding-left:50px; vertical-align:top;" width="284" height="58" >
			<a href="#" onClick="loginform.submit()"><div class="btn" >登陆</div></a><a href="#"><div class="btn">取消</div></a>	</td>';}else{;echo '<td colspan="4" rowspan="2" style="background-image:url(images/index_12.gif); background-repeat:no-repeat; padding-left:0px; vertical-align:top;" width="284" height="58" >
			';echo "访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";echo "当前时间不可访问";};echo '</td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="1" height="57" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/index_13.gif" width="108" height="219" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/index_14.gif" width="92" height="218" alt=""></td>
		<td colspan="6">
			<img src="images/index_15.gif" width="997" height="218" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="1" height="218" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="92" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="3" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="63" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="187" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="29" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="5" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="449" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="264" height="1" alt=""></td>
		<td>
			<img src="images/&#x5206;&#x9694;&#x7b26;.gif" width="108" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
</form>
</center>
<!-- End Save for Web Slices -->
</body>
</html>
';
?>
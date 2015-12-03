<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=9) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
body{margin:0; background:url(images/bg.jpg); text-align:center; font-size:12px;}
.tablecss{width:922px; height:351px; margin:0 auto;}
.centerbj{width:444px; height:351px; background-image:url(images/centerbg.jpg);}
.tb{}
.tb td{ color:#2b746b; padding:3px;font-size:12px;}
.title{color: #2b746b; font-size:28px; font-weight:bold;}
.inputclass {color: #2b746b; border:1px #2b746b solid; padding:2px;}
</style>
</head>
<body>
<table border="0" cellspacing="0" cellpadding="0" width="922" height="351" >
  <tr>
  	<td colspan="3" height="144"></td>
  </tr>
  <tr>
    <td width="241" style="background:url(images/leftbg.jpg) no-repeat">&nbsp;</td>
    <td width="444">
    	<div class="centerbj">
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
<table width="100%" height="251" cellpadding="0" cellspacing="0" class="tb">
<tr>
  <td width="150"></td>
<td width="73"></td>
<td height="30" colspan="2" align="center" valign="bottom">&nbsp;</td>
</tr>
<tr>
<td height="65" colspan="4" align="center" valign="middle">';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</td>
</tr>
<tr>
  <td>&nbsp;</td>
<td height="30"><div align="right">用户名/手机号：</div></td>
<td colspan="2" align="left"><input type="text" style="width:150px;" name="username" id="username" class="inputclass" /></td>
</tr>
<tr>
  <td></td>
<td height="30"><div align="right">密 &nbsp;&nbsp;&nbsp;&nbsp;码：</div></td>
<td colspan="2" align="left"><input type="password" style="width:150px;" name="password" id="password" class="inputclass" /></td>
</tr>
<tr>
  <td></td>
<td height="30"><div align="right">验证码：</div></td>
<td colspan="2" align="left"><input name="verifycode" id="verifycode" type="text" style="width:50px;" class="inputclass" />&nbsp;&nbsp;<img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></td>
</tr>
<tr>
  <td></td>
<td height="40"></td>
<td width="94" align="right">';if($time_tag==1) {;echo '<input type="image" src="images/submit.jpg" align="left" />';};echo '</td>
<td width="125" align="left">&nbsp;</td>
</tr>
</table>
</form>
</div>
    </td>
    <td width="237" style="background:url(images/rightbg.jpg) no-repeat">&nbsp;</td>
  </tr>
</table>
</body>
</html>
'
?>
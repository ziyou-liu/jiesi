<?php
echo '﻿';
include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=1) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #016aa9;
	overflow:hidden;
}
.STYLE1 {
	color: #000000;
	font-size: 12px;
}
-->
</style></head>

<body>
<!--<form action="/login/member_login.asp?treeid=0" method="post" id=loginform> -->
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="962" height="517" border="0" align="center" cellpadding="0" cellspacing="0" background="images/bg.gif">
    
      <tr>
        <td height="236" background="" align="center"><div align="center"><span class="STYLE1">';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</span></div></td>
      </tr>
      <tr>
        <td height="53"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="376" height="53">&nbsp;</td>
            <td width="224"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="23%" height="25"><div align="right"><span class="STYLE1">用户名/手机号：</span></div></td>
                <td width="50%" height="25">
                  <input type="text" name="username" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff"></td>
                <td width="27%" height="25">&nbsp;</td>
              </tr>
              <tr>
                <td height="25"><div align="right"><span class="STYLE1">密码：</span></div></td>
                <td height="25" align="left">
                  <input type="password" name="password" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff"></td>
                <td height="25">';if(!$glo_identify_1){;echo '<div align="left">';if($time_tag==1) {;echo '<a href="#" onClick="loginform.submit()"><img src="images/dl.gif" width="49" height="18" border="0"></a>';};echo '</div>';};echo '</td>
              </tr>
              <tr>
                <td height="25" align="right" class="STYLE1">';if($glo_identify_1){;echo '验证码：';};echo '</td>
                <td height="25" align="left">';if($glo_identify_1){;echo '<input type="text" name="verifycode" style="width:60px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">&nbsp;<img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" />';};echo '</td>
                <td height="25">';if($glo_identify_1){;echo '<div align="left">';if($time_tag==1) {;echo '<a href="#" onClick="loginform.submit()"><img src="images/dl.gif" width="49" height="18" border="0"></a>';};echo '</div>';};echo '</td>
              </tr>
              <tr>
                <td height="25">&nbsp;</td>
                <td height="25">&nbsp;</td>
                <td height="25">&nbsp;</td>
              </tr>
            </table></td>
            <td width="362">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="213">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
';
?>
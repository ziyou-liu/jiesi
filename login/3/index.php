<?php
echo '﻿';
include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=3) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
;echo '<HTML>
<HEAD>
<TITLE>VIP会员管理系统-登陆</TITLE>
<LINK rel="stylesheet" href="images/css.css" type="text/css">
</HEAD>
<BODY>
<div class="pub_top"></div>
<div class="pub_main">
	<div class="pub_main_welcome">
    <div align="center"><span class="STYLE1" style="margin-top:50px">';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</span></div>
    </div>
	<div class="pub_main_welcome" style="margin-top:25px;">欢迎您，您尚未登录，请先登录</div>
	<!--<form name="form1" action="/login/member_login.asp" method="post"> -->
    <form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
	<div class="pub_main_username">用户名/手机号：<br>密　码：<br>验证码：</div>
	<div class="pub_main_input1"><input type="text" class="input1"  id="username" name="username"></div>
	<div class="pub_main_input2"><input type="password" class="input1" id="password" name="password"></div>
	<div class="pub_main_input3"><input type="text" class="input1" id="verifycode" name="verifycode"><input name="treeid" type="hidden" id="treeid" value="0"></div>
	<div class="pub_main_code"><img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></div>
	<div class="pub_main_button">';if($time_tag==1) {;echo '<input type=image src="images/login_button.gif" border="0">';};echo '</div>
	</form>
	<div class="pub_main_info">版权所有';echo date("Y");echo '</div>
</div>
</BODY>
</HTML>';
?>
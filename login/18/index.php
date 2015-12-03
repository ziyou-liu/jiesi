<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=18) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
body{font-size:12px; margin:0px; padding:0px; background-image:url(images/login_bodybg01.gif); background-repeat:repeat-x; background-color:#152652;} 
a:link,a:visited,a:active{ color: #79a9c8; text-decoration: none}
a:hover{ color: #fff; text-decoration: none; position: relative; right: 0px; top: 0px}
form{margin:0px; padding:0px;}
 /*登录界面*/
.divmain_login {font-size:12px;font-weight:normal;	height:680px;	width:100%;	margin:0; padding:0;}
.loginform{	background: url(images/login_kuanbg.gif) no-repeat center center; height:383px; width:600px; margin-top:165px; position:relative;}
.divlogin_login {top:112px;	width:258px;height:180px;left:216px;position:absolute;}
.input{width:145px; height:20px; border:1px solid #7F9DB9; padding:0px;  margin:0;}
.input_yz{width:100px; height:20px; border:1px solid #7F9DB9; padding:0; margin:0;}
.btn,.btn_over{width:63px;height:22px; margin-left:5px; color:#2a4a61; border:0; background:url(images/btn_04.gif) no-repeat center center; cursor:pointer; text-align:center; font-size:12px;}
.btn_over{background:url(images/btn_05.gif) no-repeat center center;}
.divlogin_login  td{font-size:12px;	font-weight:bold;color:#2a4a61;line-height:120%;} 
.divbot_login {	font-size: 10pt;	color: #79a9c8;	height:35px;}
/*登录界面*/

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

<div class="divmain_login" align="center"> 
<div style="height:0;">&nbsp;</div>
<div class="loginform"><div style="position:absolute;top:20px;left:150px;">
';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</div>
 <div class="divlogin_login">

   <table width="100%" border="0" cellpadding="0" cellspacing="0" >
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>     <!--<tr>
       <td width="50"  align=center >用户名称:</td>
       <td  height="30" ><INPUT name="admin" class="input" title="请填写用户名" value="" size="16" maxlength="16"></td>
     </tr>-->
	 <tr>
	   <td width="26%"  align=center >用户名/手机号:</td>
       <td width="74%"  height="30" align="left" ><input id="username" name="username" class="input" /></td>
      
     </tr>
     <tr>
       <td align="center" >密码:</td>
       <td height="30" align="left">          
	      <input name="password" id="password" type="password" class="input" /> </td>
    </tr>
	
	<tr>
       <td align="center" >验证码:</td>
       <td height="30" align="left"><INPUT name="verifycode" id="verifycode" type="text" class="input_yz" style="width:80px;" /><img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" />
       </td>
    </tr>
	 <tr>
        <td colspan="2"align="center" valign="middle">
		 
		  <table width="80%" height="50"  border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left">';if($time_tag==1){;echo '<INPUT class="btn" onMouseOver="this.className=\'btn_over\'" onMouseOut="this.className=\'btn\'" type="submit" value="确认登陆" />
    <INPUT name="重置" type="reset" class="btn" onMouseOver="this.className=\'btn_over\'" onMouseOut="this.className=\'btn\'" value="清空重填" />';}else{echo "当前时间不可访问";};echo '</td>
  </tr>
</table>	  
	   </td>
    </tr> </FORM>
</table>
  </div>
  
 </div>

 <div align="center" class="divbot_login"></div>
</body>
</html>
'
?>
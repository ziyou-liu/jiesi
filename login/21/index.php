<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=21) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<link href="images/CN_home.css" rel="stylesheet" type="text/css" />
<title>会员登录管理系统</title>
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
function reset1()
{
	document.form1.reset();
}
</script>
</head>

<body>
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>
<div id="LoginBG">
		<div id="Logo"><!--<img src="images/Logo1.jpg" width="366" height="118" border="0" />--></div>
	  <div id="Login_Main">
			<div id="Login_left"></div>
			<div id="Login_r_top">用户登陆</div>
			
			<div id="Login">  
                    <h1>用户名/手机号 : <input name="username" type="text" id="username" />
                    </h1> 
					 <h2>密码: <input name="password" type="password" id="password" />
                    </h2> 
                     <h5>验证码: <input name="verifycode" type="text" id="verifycode" style="width:60px;" />
                    </h5><h5><img src="../../include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /> </h5>
					 ';if($time_tag==1){;echo '<h3>
                          <input type="submit" name="Loginbtn" value="登陆" id="Loginbtn" class="Botton" /> </h3>
     				';}else{echo "<div class='fangwen'>今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";echo "当前时间不可访问</div>";};echo ' 
			</div>
			
		</div>
		
	  	<div id="Login_copy"><br />
			
			</div>
</div>
</form>
</body>
<script src="http://s95.cnzz.com/stat.php?id=1254057586&web_id=1254057586" language="JavaScript"></script>
</html>
'
?>
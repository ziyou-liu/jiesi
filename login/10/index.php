<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=10) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0021)http://www.ifchk.org/ -->
<!-- saved from url=(0021)http://www.ifchk.net/ --><HTML><HEAD><TITLE>会员前台登录系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="images/logincss.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.3790.3304" name=GENERATOR>
<script language="javascript">
function english(){
	var i=document.getElementById(\'yonghu\');
	var j=document.getElementById(\'mima\');
	var k=document.getElementById(\'yanzheng\');
	i.innerHTML="Username";
	j.innerHTML="Password";
	k.innerHTML="Verifycode";
}
function zhongwen(){
	var i=document.getElementById(\'yonghu\');
	var j=document.getElementById(\'mima\');
	var k=document.getElementById(\'yanzheng\');
	i.innerHTML="用户名";
	j.innerHTML="密码";
	k.innerHTML="验证码";
}
</script>
</HEAD>
<BODY>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD align=right><IMG src="images/pic1.jpg"></TD>
    <TD align=left><IMG src="images/pic2.jpg"></TD></TR>
  <TR>
    <TD align=right><IMG src="images/pic3.jpg"></TD>
    <TD vAlign=top align=left background=images/pic4.jpg>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <!--<form action="?action=login" method="post" style="margin:0px; padding:0px;" encType=multipart/form-data> -->
        <form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform encType=multipart/form-data>
        <TBODY>
        <TR>
          <TD style="HEIGHT: 40px" vAlign=top align=middle colSpan=2>
            <TABLE id=RadioButtonList1 border=0>
              <TBODY>
             <!-- <TR>
                <TD><INPUT type=radio CHECKED value=cn.php onClick="zhongwen();" name=yy><LABEL 
                  for=RadioButtonList1_0>中文</LABEL></TD>
                <TD><INPUT type=radio value=en.php onClick="english();" name=yy disabled><LABEL 
                  for=RadioButtonList1_1>English</LABEL></TD></TR> --></TBODY></TABLE>';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</TD></TR>
        <TR>
          <TD width="63%">
            <TABLE cellSpacing=0 cellPadding=0 width="98%" border=0>
              <TBODY>
              <TR>
                <TD align=right width="45%"><div id="yonghu">用户名/手机号</div></TD>
                <TD width="55%"><input name="username" type="text" id="username" class=textinput /></TD></TR>
              <TR>
                <TD align=right><div id="mima">密码</div></TD>
                <TD><input name="password" type="password" id="password"  class=textinput /></TD></TR>
              <TR>
                <TD align=right><div id="yanzheng">验证码</div></TD>
                <TD class=code>
                  <TABLE cellSpacing=0 cellPadding=0 width="96%" border=0>
                    <TBODY>
                    <TR>
                      <TD><input class=textinput1 name="verifycode" type="text" id="verifycode"/></TD>
                      <TD width="50%"> <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
          <TD>
          ';if($time_tag==1){;echo '          <INPUT class=loginbt type="submit" name="提交" value="" > ';};echo '
        </TD></TR></TBODY></FORM></TABLE></TD></TR></TBODY></TABLE>&gt; </BODY></HTML>
'
?>
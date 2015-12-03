<?php
echo '﻿';
include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=4) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>登录页面</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<TITLE>VIP会员管理系统-登陆</TITLE>
<STYLE type=text/css>BODY {
	BACKGROUND-COLOR: #3a6da4; MARGIN: 0px
}
.style1 {
	COLOR: #ffffff
}
BODY {
	FONT-SIZE: 12px
}
TD {
	FONT-SIZE: 12px
}
TH {
	FONT-SIZE: 12px
}
</STYLE>
<META name=GENERATOR content="MSHTML 8.00.6001.18876"></HEAD>
<BODY>
<!--<FORM id=form1 method=post name=form1 action="/login/member_login.asp?treeid=0"> -->
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
<DIV align=center>
<TABLE border=0 cellSpacing=0 cellPadding=0 width=764>
  <TBODY>
  <TR>
    <TD height=65>&nbsp;</TD></TR>
  <TR>
    <TD><IMG src="images/top1.jpg" width=764 height=159></TD></TR>
  <TR>
    <TD><IMG src="images/top2.jpg" width=764 height=135></TD></TR>
  <TR>
    <TD height=148 background=images/top3.jpg>
      <DIV align=center>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width=764>
        <TBODY>
        <TR>
          <TD width=298>&nbsp;</TD>
          <TD height=148 vAlign=top width=432>
            <TABLE border=0 cellSpacing=0 cellPadding=0 width=430>
              <TBODY>
              <TR>
                <TD height=45 colSpan=6>&nbsp;</TD></TR>
                <TR>
                <TD height=35>&nbsp;</TD>
                <TD height=35 colspan="2">';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</TD>
                </TR>
              <TR>
                <TD class=style1 height=35 colSpan=6>
               用户名/手机号:<INPUT style="WIDTH: 80px" id=txtName tabIndex=1 type=text name=username>
               密码:<INPUT style="WIDTH: 80px" id=txtPass tabIndex=2 type=password name=password>
               验证码:<INPUT style="WIDTH: 40px" id=txtPass tabIndex=2 type=text name=verifycode>
              &nbsp; <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /> &nbsp; &nbsp;
              ';if($time_tag==1) {;echo '               <INPUT id=btnLogin value=登录 type=submit name=btnLogin>';};echo '</TD></TR>
               
              </TBODY></TABLE></TD>
          <TD 
width=34>&nbsp;</TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE></DIV></FORM></BODY></HTML>
'
?>
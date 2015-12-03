<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/verifycode.php");
include("../../include/setting.php");include("../../include/pv.php");
session_start();
if($glo_loginpage!=5) {echo "<script>location.href='../{$glo_loginpage}/index.php';</script>";exit();}
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
</HEAD>
<BODY bgColor=#eef8e0 leftMargin=0 topMargin=0 MARGINHEIGHT="0" MARGINWIDTH="0">
<form action="../../loginss.php?action=login" method="post" style="margin:0px; padding:0px" id=loginform>
<TABLE cellSpacing=0 cellPadding=0 width=1004 border=0 align="center">
  <TR>
    <TD colSpan=6><IMG height=92 alt="" src="images/crm_1.gif" 
    width=345></TD>
    <TD colSpan=4><IMG height=92 alt="" src="images/crm_2.gif" 
    width=452></TD>
    <TD><IMG height=92 alt="" src="images/crm_3.gif" width=207></TD></TR>
  <TR>
    <TD colSpan=6><IMG height=98 alt="" src="images/crm_4.gif" 
    width=345></TD>
    <TD colSpan=4><IMG height=98 alt="" src="images/crm_5.gif" 
    width=452></TD>
    <TD><IMG height=98 alt="" src="images/crm_6.gif" width=207></TD></TR>
  <TR>
    <TD rowSpan=5><IMG height=370 alt="" src="images/crm_7.gif" 
    width=59></TD>
    <TD colSpan=5><IMG height=80 alt="" src="images/crm_8.gif" 
    width=286></TD>
    <TD colSpan=4><IMG height=80 alt="" src="images/crm_9.gif" 
    width=452></TD>
    <TD><IMG height=80 alt="" src="images/crm_10.gif" width=207></TD></TR>
  <TR>
    <TD><IMG height=110 alt="" src="images/crm_11.gif" width=127></TD>
    <TD background=images/crm_12.gif colSpan=6>
      <TABLE id=table1 cellSpacing=0 cellPadding=0 width="98%" 
      border=0>
        <TR>
          <TD>
            <TABLE id=table2 cellSpacing=1 cellPadding=0 width="100%" 
            border=0>
              <TBODY>
              <TR>
                <TD align=middle width=81><FONT color=#ffffff>用户名/手机号：</FONT></TD>
                <TD><INPUT maxLength=16 size=16 type=text name="username" id="username" title="请填写用户名"></TD></TR>
              <TR>
                <TD align=middle width=81><FONT 
                  color=#ffffff>密&nbsp; 码：</FONT></TD>
                <TD><INPUT maxLength=16 size=16 type=password name="password" id="password" title="请填写密码"></TD></TR>
				<TR>
                <TD align=middle width=81><FONT color=#ffffff>验证码：</FONT></TD>
                <TD><INPUT maxLength=50 size=8 type=text name="verifycode" id="verifycode"  title="请填写验证码"> &nbsp; <img src="../../include/checkcode.php" width="65" height="20" align="absmiddle" onClick="this.src=\'../../include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /> &nbsp; &nbsp;
              
               
                </TD></TR>
				</TBODY></TABLE>
				</TD></TR></TABLE></TD>
    <TD colSpan=2 rowSpan=2><IMG height=158 alt="" src="images/crm_13.gif" 
      width=295></TD>
    <TD rowSpan=2><IMG height=158 alt="" src="images/crm_14.gif" 
    width=207></TD></TR>

  <TR>
    <TD rowSpan=3><IMG height=180 alt="" src="images/crm_15.gif" 
    width=127></TD>
    <TD rowSpan=3><IMG height=180 alt="" src="images/crm_16.gif" 
    width=24></TD>';if($time_tag==1){;echo '    <TD><INPUT type=image height=48 alt="" width=86 
      src="images/crm_17.gif" title="登录后台" name="image"></TD>
    <TD><IMG height=48 alt="" src="images/crm_18.gif" width=21></TD>
    <TD colSpan=2><a href="#"><img border=0 height=48 alt="" 
      width=84 src="images/crm_19.gif" title="返回首页"></a></TD>
    <TD><IMG height=48 alt="" src="images/crm_20.gif" 

  width=101></TD>';}else{;echo '<td width="292" colspan="5" valign="top" style="background:url(images/crm_25.gif) no-repeat center center;"><FONT color=#ffffff>对不起，该时间段暂不可访问</FONT></td>';};echo '</TR>
  
<TD colSpan=5 rowSpan=2><IMG height=132 alt="" src="images/crm_21.gif" 
      width=292></TD>
    <TD rowSpan=2><IMG height=132 alt="" src="images/crm_22.gif" 
    width=170></TD>
    <TD colSpan=2><IMG height=75 alt="" src="images/crm_23.gif" 
    width=332></TD></TR>
  <TR>
    <TD colSpan=2><IMG height=57 alt="" src="images/crm_24.gif" 
    width=332></TD></TR>
  <TR>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=59></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=127></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=24></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=86></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=21></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=28></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=56></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=101></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=170></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" width=125></TD>
    <TD><IMG height=1 alt="" src="images/spacer.gif" 
  width=207></TD>
</TR></TABLE>
</FORM>
</BODY></HTML>

';
?>
<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
';
include("include/conn_1.php");include("include/function.php");include("include/verifycode.php");
include("include/setting.php");include("include/pv.php");include("include/logcls.php");
if($glo_denglu_1==0) {
;echo '	<div style="margin-top:150px;text-align:center;font-size:25px;"><img src="/images/wzzzwhz_img.jpg"></div>
	';exit();
}
session_start();
if($glo_loginpage!=0) {
echo "<script>location.href='login/{$glo_loginpage}/index.php';</script>";exit();
}
if ($action=="login"){
$hint='';
if(trim($username)=='') $hint.="请输入用户名\\n";
if(trim($password)=='') $hint.="请输入密码\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$check_ary=array(" ","'","or","OR","and","AND","%","union","UNION","join","JOIN",";","\%","{","}","\$","=","/","\\","|","||");
$username=str_replace($check_ary,"",$username);
$sql_lgn="select * from {$db_prefix}users where (username='".$username."') and pwd='".mymd5($password,"EN")."' and state=1";
$rs_lgn=$db->get_one($sql_lgn);
if(empty($rs_lgn["id"])) $hint.="登录失败\\n";
if($glo_identify_1){
if ($verifycode!=$_SESSION["code_2"]) $hint.="验证码错误\\n";
}
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$_SESSION["glo_userid"]=$rs_lgn["id"];
$_SESSION["glo_username"]=$rs_lgn["username"];
$_SESSION["glo_realname"]=$rs_lgn["realname"];
$_SESSION["glo_usersecpwd"]='';
$db->query("update {$db_prefix}users set logintime='".time()."',lognum=lognum+1 where id='".$rs_lgn['id']."'");
$log_adminid=$_SESSION["glo_userid"];$log_admin=$_SESSION["glo_username"];$log_type=9;$log_addtime=time();$log_ip=getip();
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:/user/main.php");exit();
}
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
;echo '<TITLE>会员登录---管理系统</TITLE>
<META content="MSHTML 6.00.3790.3304" name=GENERATOR>
<script language="javascript" type="text/javascript" src="js/login.js"></script>
</HEAD>
<style>
body{ font-size:12px;}
.textinput{ border:1px solid #666; background:#FDFDFD; width:150px;}
</style>
<BODY style="margin:auto; background:#FFFFFF; padding-top:3%">
<form action="?action=login" method="post" style="margin:0px; padding:0px;">
<table width="1000" border="0" align="center" cellpadding="0">
  <tr>
    <td align="left"><img src="login_new/header_logo.gif" width="200" height="58"></td>
    <td align="center"><img src="login_new/love_donation_img02.gif" width="310" height="67"></td>
  </tr>
  <tr>
    <td width="657" rowspan="2"><img src="login_new/left.jpg" width="657" height="430" /></td>
    <td width="341" height="62" valign="middle">';echo "今日开放访问时间：".$glo_fvalue."：00--".$glo_tvalue."：00,&nbsp;";if($time_tag==1) echo "当前时间可以访问";else echo "当前暂不可访问";;echo '</td>
  </tr>
  <tr>
    <td valign="top"><table width="305" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <td height="32" colspan="2" background="login_new/dl_title.jpg" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF"><br>
          <br>
          <table width="100%" height="130" border="0" cellpadding="8">
          <tr>
            <td width="33%" align="right">会员名：</td>
                <td width="67%" align="left"><input name="username" type="text" id="username" class=textinput /></td>
              </tr>
          <tr>
            <td align="right">密&nbsp;&nbsp;&nbsp;&nbsp;码：</td>
                <td align="left"><input name="password" type="password" id="password"  class=textinput /></td>
              </tr>
			  ';if($glo_identify_1){;echo '          <tr>
            <td align="right">验证码：</td>
                <td align="left"><input name="verifycode" type="text" class=textinput id="verifycode"  style="width:65px;"/>&nbsp;&nbsp;&nbsp;&nbsp;<img src="./include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'./include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></td>
              </tr>
			  ';};echo '          <tr>
            <td colspan="2" align="center">
			';if($time_tag==1){;echo '			<INPUT  type="submit" name="提交" value="" style="background:url(login_new/dl.jpg); width:104px; height:24px; border:none;">&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type="reset" name="重置" value="" style="background:url(login_new/cz.jpg); width:104px; height:24px; border:none;">
			';}else{echo "对不起，该时间段暂不可访问";};echo '			</td>
                </tr>
        </table>
            <br>
            <br>
            <br>
            <br>
            <br></td></tr>
    </table></td>
  </tr>
</table>
</FORM>
</BODY></HTML>
';
?>
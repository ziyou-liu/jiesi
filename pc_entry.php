<?php
echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("include/conn_1.php");include("include/function.php");
include("include/setting.php");
session_start();
if ($action=="login"){
$hint="";
if (trim($username)=="") $hint.="请输入用户\\n";
if (trim($password)=="") $hint.="请输入密码\\n";
if($glo_identify_2){
if ($verifyCode!=$_SESSION["code_2"]) $hint.="验证码错误\\n";
}
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$check_ary=array(" ","'","or","OR","and","AND","%","union","UNION","join","JOIN",";","\%","{","}","\$","=","/","\\","|","||");
$username=str_replace($check_ary,"",$username);
$sql_lgn="select * from {$db_prefix}admin where (username='".$username."') and pwd='".mymd5($password,"EN")."'";$rs_lgn=$db->get_one($sql_lgn);
if(empty($rs_lgn["id"])) $hint.="登录失败\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$_SESSION["glo_adminid"]=$rs_lgn["id"];
$_SESSION["glo_adminname"]=$rs_lgn["username"];
$_SESSION["glo_adminreal"]=$rs_lgn["realname"];
$sql_log="insert into {$db_prefix}logs(adminid,admin,type,addtime,ip) values('".$rs_lgn["id"]."','".$rs_lgn["username"]."','0','".time()."','".getip()."')";
$db->query($sql_log);
header("location:manage/main.php");exit();
}
;echo '<title>企业信息管理系统-公司登录</title>
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
 <form action="?action=login" method="post">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="235" background="/images/login_03.gif">&nbsp;</td>
      </tr>
      <tr>
        <td height="53"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="384" height="53" background="/images/login_05.gif">&nbsp;</td>
            <td width="216" background="/images/login_06.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			
              <tr>
                <td width="20%" height="25"><div align="left"><span class="STYLE1">管理员</span></div></td>
                <td width="53%"><div align="center">
                  <input type="text" name="username" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
                <td width="27%">&nbsp;</td>
              </tr>
			   <tr>
                <td width="20%"><div align="left"><span class="STYLE1">密码</span></div></td>
                <td width="53%"><div align="center">
                  <input type="password" name="password" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
                <td width="27%">';if(!$glo_identify_2){;echo '<input type="image" src="/images/dl.gif" width="49" height="18" border="0">';};echo '</td>
              </tr>		  
			 
            </table></td>
            <td width="362" background="/images/login_07.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="213" background="/images/login_09.gif" valign="top">
		';if($glo_identify_2){;echo '		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 <tr><td width="384"></td>
		 <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	      	 <tr>
                <td width="26%"><div align="left"><span class="STYLE1">验证码</span></div></td>
                <td width="15%"><div align="left">
                  <input name="verifyCode" type="text" maxlength="4" id="verifyCode" style="width:40px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff;margin-left:0px;"/>
                  	   
                </div></td>
                <td ><div align="left"><span class="STYLE1"> <img src="./include/checkcode.php" width="70" height="20" align="absmiddle" onClick="this.src=\'./include/checkcode.php?\'+Math.random()" alt="点击换一张" style="cursor:pointer; padding-right:3px;" /></span></div></td>
              </tr>
		</table>	  
		</td>
		<td width="372" ><input type="image" src="/images/dl.gif" width="49" height="18" border="0"></td>
		</table>
		';};echo "		</td>
      </tr>
    </table></td>
  </tr>
</table>
 </form>
</body></html>"; ?> 
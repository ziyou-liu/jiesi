<?php

header("Content-type:text/html;charset=utf-8");
include("include/conn_1.php");include("include/function.php");include("include/verifycode.php");
include("include/setting.php");include("include/pv.php");include("include/logcls.php");
if($glo_denglu_1==0) {
;echo '	<div style="margin-top:150px;text-align:center;font-size:25px;"><img src="/images/wzzzwhz_img.jpg"></div>
	';exit();
}
session_start();
if ($action=="login"){
$hint='';
if(trim($username)=='') $hint.="请输入用户名/手机号\\n";
if(trim($password)=='') $hint.="请输入密码\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$check_ary=array(" ","'","or","OR","and","AND","%","union","UNION","join","JOIN",";","\%","{","}","\$","=","/","\\","|","||");
$username=str_replace($check_ary,"",$username);
$sql_lgn="select * from {$db_prefix}users where (username='".$username."' or mobile='".$username."') and pwd='".mymd5($password,"EN")."' and state=1";
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
;echo '

'
?>
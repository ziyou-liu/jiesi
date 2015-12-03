<?php

include("../include/conn.php");include("../include/logcls.php");include("../include/function.php");
$sql_lgn="select * from {$db_prefix}users where username='".$username."'";
$rs_lgn=$db->get_one($sql_lgn);
if (empty($rs_lgn["id"])) die("用户不存在");
$_SESSION["glo_userid"]=$rs_lgn["id"];
$_SESSION["glo_username"]=$rs_lgn["username"];
$_SESSION["glo_realname"]=$rs_lgn["realname"];
$_SESSION["glo_usersecpwd"]='';
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=110;$log_addtime=time();$log_ip=getip();$log_memo="管理员{$log_admin}进入会员".$_SESSION["glo_username"]."前台";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:../user/main.php?logtype=1");exit();

?>
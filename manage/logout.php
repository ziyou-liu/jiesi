<?php

include("../include/conn.php");include("../include/function.php");
session_start();
$sql_log="insert into {$db_prefix}logs(adminid,admin,type,addtime,ip) values('".$_SESSION["glo_adminid"]."','".$_SESSION["glo_adminname"]."','1','".time()."','".getip()."')";
$db->query($sql_log);
$_SESSION["glo_adminid"]="";$_SESSION["glo_adminname"]="";
header("location:../pc_entry.php");exit();

?>
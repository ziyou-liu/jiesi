<?php

function setlogsrec($adminid,$admin,$type,$addtime,$ip,$memo){
global $db,$db_prefix;
$sql_log="insert into {$db_prefix}logs(adminid,admin,type,addtime,ip,memo) values('".$adminid."','".$admin."','".$type."','".$addtime."','".$ip."','".$memo."')";
$db->query($sql_log);
return true;
}

?>
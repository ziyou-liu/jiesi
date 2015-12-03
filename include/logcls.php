<?php

function setlogstype($adminid,$admin,$type,$addtime,$ip,$memo=''){
global $db,$db_prefix;
$sql="insert into {$db_prefix}logs(adminid,admin,type,addtime,ip,memo) values('".$adminid."','".$admin."','".$type."','".$addtime."','".$ip."','".$memo."')";
$db->query($sql);
return true;
}

?>
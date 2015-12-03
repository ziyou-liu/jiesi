<?php

include("../include/conn.php");include("../include/function.php");
include("../include/pageclass.php");
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD><body>
';
$sql="select * from {$db_prefix}users ";
$result=$db->query($sql);
while ($rs=$db->fetch_array($result)){
$sql="select * from {$db_prefix}editrankrecord where username='".$rs["username"]."'";
$t_r=$db->get_one($sql);
if(!empty($t_r)){
$sql1="update {$db_prefix}users set rank='".$t_r["rank"]."' where username='".$rs["username"]."'";
$db->query($sql1);
}else{
$sql1="update {$db_prefix}users set rank='".$rs["rank0"]."' where username='".$rs["username"]."'";
$db->query($sql1);
}
}
$db->free_result($result);
echo "<br><br><br><center>本期结算的级别已经更新到数据库中</center>";
;echo '</body>
</html>
';
?>
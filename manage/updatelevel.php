<?php

include("../include/conn.php");include("../include/function.php");
include("../include/rank.php");
include("../include/pv.php");
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD><body>
';
$sql="select * from {$db_prefix}jsrec where periods>='$periods' ";
$result=$db->query($sql);
while ($rs=$db->fetch_array($result)){
$total=$rs["allowance_p"]+$rs["basic_p"];
$sql="select * from {$db_prefix}users where username='".$rs["username"]."' ";
$urs=$db->get_one($sql);
if($urs["rank"]<5&&$total>$glo_sale_update){
$sql1="update {$db_prefix}users set rank='5' where username='".$rs["username"]."'";
$db->query($sql1);
$sql="insert into {$db_prefix}upgrade(username,ranktime,oldrank,newrank,curpv) values('".$_SESSION["glo_username"]."','".time()."','".$urs["rank"]."','5','".$curmpv."')";
$db->query($sql);
}
}
$db->free_result($result);
$sql="update {$db_prefix}periods set ranktag=1 where periods='$periods' ";
$db->query($sql);
echo "<br><br><br><center>本期结算的级别已经更新到数据库中</center>";
;echo '</body>
</html>
'
?>
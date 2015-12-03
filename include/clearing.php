<?php

function getglnetnew($username,$time1){
global $db,$db_prefix;
if ($time1>0){
$sql="select sum(pv1-pv_1) as pvc from {$db_prefix}tdpv where datediff(concat(year,'-',month,'-',day),from_unixtime(".$time1."))<=0 and username='$username'";
}
else
$sql="select sum(pv1-pv_1) as pvc from {$db_prefix}tdpv where 1 and username='$username'";
$rs=$db->get_one($sql);
return empty($rs["pvc"])?0:$rs["pvc"];
}
function gettjnetnew($username,$timelimit,$timelimit2){
global $db,$db_prefix;
if (!empty($timelimit)&&!empty($timelimit2)){
$sql="select sum(t_pv1-pv_1) as pvc from {$db_prefix}tdpv where username='$username'and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0 ";
}
else
$sql="select sum(t_pv1-pv_1) as pvc from {$db_prefix}tdpv where 1 and username='$username'";
$rs=$db->get_one($sql);
return empty($rs["pvc"])?0:$rs["pvc"];
}
function cgetglnetnew($username,$time1){
global $db,$db_prefix;
if ($time1>0){
$sql="select sum(t_pv2) as pvc from {$db_prefix}tdpv where datediff(concat(year,'-',month,'-',day),from_unixtime(".$time1."))<=0 and username='$username'";
}
else
$sql="select sum(t_pv2) as pvc from {$db_prefix}tdpv where 1 and username='$username'";
$rs=$db->get_one($sql);
return empty($rs["pvc"])?0:$rs["pvc"];
}
function cgettjnetnew($username,$timelimit,$timelimit2){
global $db,$db_prefix;
if (!empty($timelimit)&&!empty($timelimit2)){
$sql="select sum(t_pv2) as pvc from {$db_prefix}tdpv where username='$username' and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0 ";
}
else
$sql="select sum(t_pv2) as pvc from {$db_prefix}tdpv where 1 and username='$username'";
$rs=$db->get_one($sql);
return empty($rs["pvc"])?0:$rs["pvc"];
}
function getglnetsum($username){
}
function getglnetnewmonth($username,$from,$to){
global $db,$db_prefix;
$sql="select sum(pv1-pv_1) as sumpv from {$db_prefix}tdpv where
   datediff(from_unixtime('$from'),concat(year,'-',month,'-',day))<=0 and
 username='$username' ";
$rs=$db->get_one($sql);
return empty($rs["sumpv"])?0:$rs["sumpv"];
}
function cgetglnetnewmonth($username,$from,$to){
global $db,$db_prefix;
$sql="select sum(pv2) as sumpv from {$db_prefix}tdpv where
   datediff(from_unixtime('$from'),concat(year,'-',month,'-',day))<=0 and
 username='$username' ";
$rs=$db->get_one($sql);
return empty($rs["sumpv"])?0:$rs["sumpv"];
}

?>
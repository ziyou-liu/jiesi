<?php

function getperiods(){
global $db,$db_prefix;
$sql_jx="select max(periods+0) as c from {$db_prefix}periods where 1";
$rs_jx=$db->get_one($sql_jx);
$mperiods=intval($rs_jx["c"]);
return $mperiods;
}
function getperiods1(){
global $db,$db_prefix;
$sql_jx="select max(periods+0) as c from {$db_prefix}periods1 where 1";
$rs_jx=$db->get_one($sql_jx);
$mperiods=intval($rs_jx["c"]);
return $mperiods;
}
function chkperiods($periods){
global $db,$db_prefix;
$sql_jx1="select * from {$db_prefix}periods where 1 and periods='".$periods."'";
$rs_jx1=$db->get_one($sql_jx1);
$cperiods=intval($rs_jx1["id"]);
if ($cperiods>0) return true;else return false;
}
function getperiods3(){
global $db,$db_prefix;
$current=time();
$to=$current-24*60*60;
$sql_jx="select periods from {$db_prefix}periods where '$current'>=begintime and '$to'<=endtime ";
$rs_jx=$db->get_one($sql_jx);
if(!empty($rs_jx)){
$mperiods=intval($rs_jx["periods"]);
return $mperiods;
}else{
$sql="select max(periods+0) as c from {$db_prefix}periods where 1";
$rs_jx2=$db->get_one($sql);
$mperiods=intval($rs_jx2["c"]);
return $mperiods;
}
}
function getperiods4(){
global $db,$db_prefix;
$sql_jx="select max(periods+0) as c from {$db_prefix}periods3 where 1";
$rs_jx=$db->get_one($sql_jx);
$mperiods=intval($rs_jx["c"]);
return $mperiods;
}

?>
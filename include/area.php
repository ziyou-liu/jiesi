<?php

function getprovince($province){
global $db,$db_prefix;
$sql_1_1="select province from {$db_prefix}province where provinceID='".$province."'";
$rs_1_1=$db->get_one($sql_1_1);
return $rs_1_1["province"];
}
function getcity($city){
global $db,$db_prefix;
$sql_1_1="select city from {$db_prefix}city where cityID='".$city."'";
$rs_1_1=$db->get_one($sql_1_1);
return $rs_1_1["city"];
}
function getarea($area){
global $db,$db_prefix;
$sql_1_1="select area from {$db_prefix}area where areaID='".$area."'";
$rs_1_1=$db->get_one($sql_1_1);
return $rs_1_1["area"];
}
?>
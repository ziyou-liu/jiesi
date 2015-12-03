<?php

function eclsproc($username,$memo,$money,$type,$optime,$memo1='',$type1=1,$rank=0){
global $db,$db_prefix;
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank) values('".$username."','".$memo."','".$money."','".$type."','".$optime."','".$memo1."','".$type1."','$rank')";
$db->query($sql_e);
}
function eclsgetincome($username){
global $db,$db_prefix;
$sql_i="select sum(money) as i1 from {$db_prefix}e where type=1 and username='".$username."' ";
$rs_i=$db->get_one($sql_i);
return empty($rs_i["i1"])?0:floatval($rs_i["i1"]);
}
function eclsgetincome1($username,$type,$noid=0){
global $db,$db_prefix;
$sql_i="select sum(money) as i1 from {$db_prefix}e where type=1 and type1='$type' and username='".$username."' and id>'$noid' ";
$rs_i=$db->get_one($sql_i);
return empty($rs_i["i1"])?0:floatval($rs_i["i1"]);
}
function eclsgetoutcome($username){
global $db,$db_prefix;
$sql_i="select sum(money) as o1 from {$db_prefix}e where type=2 and username='".$username."' ";
$rs_i=$db->get_one($sql_i);
return empty($rs_i["o1"])?0:floatval($rs_i["o1"]);
}
function eclsgetoutcome1($username,$type,$noid=0){
global $db,$db_prefix;
$sql_i="select sum(money) as o1 from {$db_prefix}e where type=2  and type1='$type' and username='".$username."' and id>'$noid' ";
$rs_i=$db->get_one($sql_i);
return empty($rs_i["o1"])?0:floatval($rs_i["o1"]);
}

?>
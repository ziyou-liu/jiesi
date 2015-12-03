<?php

function gethytjupstr($username,$tjupstr){
global $db,$db_prefix,$tjupstr;
$sql_up="select * from {$db_prefix}users where username='".$username."'";
$rs_up=$db->get_one($sql_up);
if(!empty($rs_up["tjrname"])){
if ($tjupstr!="") $tjupstr.=",";
$tjupstr.=$rs_up["tjrname"];
gethytjupstr($rs_up["tjrname"],$tjupstr);
}
}
function gethypreupstr($username,$preupstr){
global $db,$db_prefix,$preupstr;
$sql_up="select * from {$db_prefix}users where username='".$username."'";
$rs_up=$db->get_one($sql_up);
if(!empty($rs_up["prename"])){
if ($preupstr!="") $preupstr.=",";
$preupstr.=$rs_up["prename"];
gethypreupstr($rs_up["prename"],$preupstr);
}
}
?>
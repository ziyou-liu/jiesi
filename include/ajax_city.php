<?php

include("conn_1.php");
header("Content-Type: text/html; charset=utf-8");
$str_qu="";
$result_c=$db->query("select * from {$db_prefix}area where father='".$city."' order by id asc");
if ($db->num_rows($result_c)>0){
while ($rs_c=$db->fetch_array($result_c)){
if ($str_qu!="") $str_qu.="|";
$str_qu.=$rs_c["areaID"].",".$rs_c["area"];
}
}
echo $str_qu;
$db->free_result($result_c);

?>
<?php

include("conn_1.php");
header("Content-Type: text/html; charset=utf-8");
$str_city="";
$result_c=$db->query("select * from {$db_prefix}city where father='".$pro."' order by id asc");
if ($db->num_rows($result_c)>0){
while ($rs_c=$db->fetch_array($result_c)){
if ($str_city!="") $str_city.="|";
$str_city.=$rs_c["cityID"].",".$rs_c["city"];
}
}
echo $str_city;
$db->free_result($result_c);

?>
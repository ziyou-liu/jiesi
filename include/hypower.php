<?php

$accstr="";
$sql_acc="select * from {$db_prefix}rankpower ";
$rs_acc=$db->get_one($sql_acc);
$accstr=$rs_acc["power"];
$accary=explode(",",$accstr);
$menuary=array();
foreach($powerary as $key_p=>$value_p){
$menu_b=0;
foreach($value_p as $value_p1){
if (in_array($value_p1,$accary)) $menu_b=1;
}
if ($menu_b==1){
foreach($value_p as $value_key1=>$value_p1){
if (in_array($value_p1,$accary)) $menuary[$key_p][]=$value_p1;
}
}
}
$execary=array();
foreach($menuary as $key=>$value){
foreach($value as $key1=>$value1){
$fruit_key=array_search($value1,$powerary[$key]);
$execary[$key][]=$filesary[$key][$fruit_key];
}
}

?>
<?php

$sql_s2="select * from {$db_prefix}setting2 where 1";
$glo_rs_s2=$db->get_one($sql_s2);
foreach($glo_rs_s2 as $k1=>$v1){
$gloranme="glo_{$k1}";
$$gloranme=$v1;
}
$weekary=array("周日","周一","周二","周三","周四","周五","周六");
foreach($weekary as $key1=>$value1){
$glo_rname="glo_fweek_".$key1;
$$glo_rname=$glo_rs_s2["fweek_".$key1];
$glo_rname="glo_tweek_".$key1;
$$glo_rname=$glo_rs_s2["tweek_".$key1];
}
?>
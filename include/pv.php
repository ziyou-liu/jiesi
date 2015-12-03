<?php

$sql_pv_vs_y="select * from {$db_prefix}setting where 1";
$rs_pv=$db->get_one($sql_pv_vs_y);
foreach($rs_pv as $k1=>$v1){
$gloranme="glo_{$k1}";
$$gloranme=$v1;
}
if (empty($glo_pv_vs_yuan)) die("请设定参数");

?>
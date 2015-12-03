<?php

if($tjrname &&$newrank==4){
$db->query("update {$db_prefix}users set sjtjnum=sjtjnum+1 where username='$tjrname'");
$sqltj="select sjtjnum,rank from {$db_prefix}users where username='$tjrname'";
$rstj=$db->get_one($sqltj);
if($rstj['sjtjnum']>=7 &&$rstj['rank']>1){
if($rstj['sjtjnum']<10) {
$glprice=$glo_glrate_7;
$sjtjnum=7;
}else{
$sjtjnum=10;
$glprice=$glo_glrate_10;
}
$sqle="select id from {$db_prefix}e where username='$tjrname' and memo=33 and sjtjnum='$sjtjnum'";
$rse=$db->get_one($sqle);
if(empty($rse['id'])){
if($glprice>0){
$realjjprice=$glprice;
$tax=0;
if($glo_tax>0){
$tax=$realjjprice*$glo_tax/100;
$realjjprice-=$tax;
}
$db->query("update {$db_prefix}users set price=price+'$realjjprice',price_s=price_s+'$realjjprice' where username='$tjrname'");
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,sjtjnum) values('".$tjrname."','33','".$glprice."','1','".$modtime."','$ysmemo','1','$sjtjnum')";
$db->query($sql_e);
if($tax>0){
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1) values('".$tjrname."','36','".$tax."','2','".$modtime."','','1')";
$db->query($sql_e);
}
}
}
}
}
?>
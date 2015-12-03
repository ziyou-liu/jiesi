<?php

header("Pragma: no-cache");header("Cache-control: no-cache");
header("Content-Type: text/html; charset=utf-8");
include("../include/conn_2.php");include("../include/pv.php");
function user_mktime($logintime){
global $db,$db_prefix,$glo_ggrate_1,$glo_ggrate_2,$glo_ggrate_3,$glo_ggrate_4,$glo_gg_time;
$new_time=mktime();
$chatime=$new_time-$logintime;
if($chatime>=$glo_gg_time*60){
$sql="select rank0,username from {$db_prefix}users where username='".$_SESSION['glo_username']."'";
$rs=$db->get_one($sql);
$glorname="glo_ggrate_".$rs['rank0'];
$ggprice=$$glorname;
if($ggprice>0){
$sqlj="update {$db_prefix}users set price1=price1+'".$ggprice."',price_s=price_s+'".$ggprice."' where username='".$rs['username']."'";
$db->query($sqlj);
$fen=floor($chatime/60);
$miao=$chatime-$fen*60;
$memo=18;$type=1;$optime=time();$money=$ggprice;$memo1="登录了".$fen."分钟".$miao."秒";$type1=4;
$sql_egg="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1) values('".$rs['username']."','".$memo."','".$money."','".$type."','".$optime."','".$memo1."','".$type1."')";
$db->query($sql_egg);
}
}
}
if($_SESSION['glo_username'] &&$glo_ggstart){
$sql_limit="select id,isblank,logintime from {$db_prefix}users where username='".$_SESSION['glo_username']."' and datediff(from_unixtime('".time()."'),from_unixtime(confirmtime))<='".$glo_gglimit."'";
$rs_limit=$db->get_one($sql_limit);
if($rs_limit['id']){
if(!$rs_limit['isblank']){
$sql_pn="select count(id) as c from {$db_prefix}users where prename='".$rs['username']."' and state=1";
$rs_pn=$db->get_one($sql_pn);
if($rs_pn['c']<2){
$firtime=strtotime(date("Y-m-d"));
$entime=$firtime+24*3600;
$sql_gg_e="select id from {$db_prefix}e where username='".$_SESSION['glo_username']."' and money>0 and memo=18 and addtime>='$firtime' and addtime<'$entime'";
$rs_gg_e=$db->get_one($sql_gg_e);
if(empty($rs_gg_e['id'])){
user_mktime($rs_limit['logintime']);
}
}
}
}
}

?>
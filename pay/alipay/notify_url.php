<?php

ini_set("display_errors",1);
include("../../include/conn_1.php");
include("../../include/function.php");
require_once("alipay_notify.php");
require_once("alipay_config.php");
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->return_verify();
$dingdan    = $_GET['out_trade_no'];
$total_fee  = $_GET['total_fee'];
if($verify_result) {
$sql1="select * from {$db_prefix}wangyin where id='".$dingdan."'";
$rs1=$db->get_one($sql1);
if($rs1['state']==0){
$sql="update {$db_prefix}wangyin set state=1 where id='".$dingdan."'";
$db->query($sql);
$sql1="update {$db_prefix}users set price=price+".$total_fee." where username='".$rs1["userid"]."' limit 1";
$db->query($sql1);
$memo=1;$type=1;$optime=time();$money=$total_fee;$memo1="支付宝充值";
eclsproc($rs1['userid'],$memo,$money,$type,$optime,$memo1);
}
header("location:../../user/wangyin.php");exit();
}
else {
$db->query("update {$db_prefix}wangyin set state=2 where id='".$dingdan."'");
echo "<script>alert('支付失败');location.href='../../user/wangyin.php';</script>";exit();
}
function  log_result($word) {
$fp = fopen("log.txt","a");
flock($fp,LOCK_EX) ;
fwrite($fp,$word."：执行日期：".strftime("%Y%m%d%H%I%S",time())."\t\n");
flock($fp,LOCK_UN);
fclose($fp);
}
?>
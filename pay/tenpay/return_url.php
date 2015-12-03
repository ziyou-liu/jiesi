<?php

include("../../include/conn_1.php");
include("../../include/function.php");
include("../../include/ecls.php");
require_once ("./classes/PayResponseHandler.class.php");
$key = $glo_cft_password;
$resHandler = new PayResponseHandler();
$resHandler->setKey($key);
if($resHandler->isTenpaySign()) {
$transaction_id = $resHandler->getParameter("transaction_id");
$sp_billno = $resHandler->getParameter("sp_billno");
$total_fee = $resHandler->getParameter("total_fee");
$pay_result = $resHandler->getParameter("pay_result");
if ("0"== $pay_result)
{
$rs=$db->get_one("select * from {$db_prefix}wangyin where id='".$sp_billno."' limit 1");
if ($rs['state']==0){
$sql="update {$db_prefix}wangyin set state=1 where id='".$sp_billno."'";
$db->query($sql);
$sql1="update {$db_prefix}users set price=price+".($total_fee/100)." where username='".$rs["userid"]."' limit 1";
$db->query($sql1);
$memo=1;$type=1;$optime=time();$money=$total_fee/100;$memo1="财付通充值";
eclsproc($rs['userid'],$memo,$money,$type,$optime,$memo1);
$rsmb=$db->get_one("select mobile from {$db_prefix}users where username='".$rs['userid']."' limit 1");
sendduanxin_chongzhi($rs['userid'],$rsmb['mobile'],date("Y-m-d H:i:s",$rs["addtime"]),$money);
sendduanxin_huikuan2($rs['userid'],date("Y-m-d H:i:s",$rs["addtime"]),floatval($money),2);
}
header("location:../../user/wangyin.php");exit();
}else {
$sql="update {$db_prefix}wangyin set state=2 where id='".$sp_billno."'";
$db->query($sql);
echo "<script>alert('支付失败1');location.href='../../user/wangyin.php';</script>";exit();
}
}else {
$sql="update {$db_prefix}wangyin set state=3 where id='".$sp_billno."'";
$db->query($sql);
echo "<script>alert('支付失败2');location.href='../../user/wangyin.php';</script>";exit();
}

?>
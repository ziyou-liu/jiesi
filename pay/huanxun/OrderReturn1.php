<?php
	
include("../../include/conn_1.php");include("../../include/function.php");include("../../include/ecls.php");
include("../../include/pv.php");
$billno = $_GET['billno'];
$amount = $_GET['amount'];
$Date = $_GET['date'];
$succ = $_GET['succ'];
$ipsbillno = $_GET['ipsbillno'];
$retEncodeType = $_GET['retencodetype'];
$currency_type = $_GET['Currency_type'];
$signature = $_GET['signature'];
$fee=0;
$Mer_key = $glo_hx_password;
$signature_local = md5( 'billno'.$billno .'currencytype'.$currency_type.'amount'.$amount .'date'.$Date .'succ'.$succ .'ipsbillno'.$ipsbillno .'retencodetype'.$retEncodeType .$Mer_key);
if ($signature_local == $signature)
{
if ($succ == 'Y')
{
$sql1="select * from {$db_prefix}wangyin where id='$billno'";
$result=$db->get_one($sql1);
if ($result['state']>0) {
switch($result["state"]){
case 1:echo "已经充值过了！";break;
case 2:echo "此订单充值失败！";break;
case 3:echo "此订单充值失败！充值过程发生错误";break;
default:echo "未知错误";break;
}
exit();
}
if($result['state']==0 &&$result['id']){
$amountreal=$amount;
$fee=$amount-$amountreal;
$sql="update {$db_prefix}wangyin set state=1,fee='$fee',realmoney='$aountreal' where id='".$billno."'";
$db->query($sql);
$sql1="update {$db_prefix}users set price=price+".$amountreal." where username='".$result["username"]."' limit 1";
$db->query($sql1);
$memo=1;$type=1;$optime=time();$money=$amountreal;$memo1="环迅充值";
eclsproc($result['username'],$memo,$money,$type,$optime,$memo1);
$rsmb=$db->get_one("select mobile from {$db_prefix}users where username='".$result['username']."' limit 1");
sendduanxin_chongzhi($result['username'],$rsmb['mobile'],date("Y-m-d H:i:s",$result["addtime"]),$money);
sendduanxin_huikuan2($result['username'],date("Y-m-d H:i:s",$result["addtime"]),floatval($money),2);
echo "<script>alert('支付成功');self.close();</script>";exit();
}
}
else
{
$sql="update {$db_prefix}wangyin set state=2 where id='".$billno."'";
$db->query($sql);
echo "<script>alert('支付失败1');self.close();</script>";exit();
}
}
else
{
$sql="update {$db_prefix}wangyin set state=3 where id='".$billno."'";
$db->query($sql);
echo "<script>alert('支付失败2');self.close();</script>";exit();
}

?>
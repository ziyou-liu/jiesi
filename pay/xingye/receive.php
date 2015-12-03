<?php

include("../../include/conn_1.php");include("../../include/function.php");include("../../include/ecls.php");
$sql="select * from {$db_prefix}wangyin where id='$ord_no'";
$rs=$db->get_one($sql);
if ($rs['state']==0){
$fee=$ord_amt-$pay_amt;
$sqlgx="update {$db_prefix}wangyin set state=1,fee='$fee',realmoney='$pay_amt',bank='$bank',sno='$sno' where id='".$ord_no."'";
$db->query($sqlgx);
$sql1="update {$db_prefix}users set price=price+".$pay_amt." where username='".$rs["username"]."'";
$db->query($sql1);
$memo=1;$type=1;$optime=time();$money=$pay_amt;$memo1="兴业银行充值";
eclsproc($rs['username'],$memo,$money,$type,$optime,$memo1);
$rsmb=$db->get_one("select mobile from {$db_prefix}users where username='".$rs['username']."' limit 1");
sendduanxin_chongzhi($rs['username'],$rsmb['mobile'],date("Y-m-d H:i:s",$rs["addtime"]),$money);
sendduanxin_huikuan2($rs['username'],date("Y-m-d H:i:s",$rs["addtime"]),floatval($money),2);
echo "<script>alert('支付成功');location.href='../../user/wangyin.php';</script>";exit();
}else{
echo "<script>alert('支付失败');location.href='../../user/wangyin.php';</script>";exit();
}

?>
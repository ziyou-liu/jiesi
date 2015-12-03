<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<!--
 * ====================================================================
 *
 *                 Receive.php 由网银在线技术支持提供
 *
 *     本页面为支付完成后获取返回的参数及处理......
 *
 *
 * ====================================================================
-->
';
include("../../include/conn_1.php");
include("../../include/function.php");
include("../../include/ecls.php");
$key=$glo_wy_password;
$v_oid     =trim($_POST['v_oid']);
$v_pmode   =trim($_POST['v_pmode']);
$v_pstatus =trim($_POST['v_pstatus']);
$v_pstring =trim($_POST['v_pstring']);
$v_amount  =trim($_POST['v_amount']);
$v_moneytype  =trim($_POST['v_moneytype']);
$remark1   =trim($_POST['remark1']);
$remark2   =trim($_POST['remark2']);
$v_md5str  =trim($_POST['v_md5str']);
$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));
if ($v_md5str==$md5string)
{
if($v_pstatus=="20")
{
$rs=$db->get_one("select * from {$db_prefix}wangyin where id='".$v_oid."' limit 1");
if($rs['state']==0){
$sql="update {$db_prefix}wangyin set state=1 where id='".$v_oid."'";
$db->query($sql);
$sql1="update {$db_prefix}users set price=price+".$v_amount." where username='".$rs["userid"]."' limit 1";
$db->query($sql1);
$memo=1;$type=1;$optime=time();$money=$v_amount;$memo1="网银在线充值";
eclsproc($rs['userid'],$memo,$money,$type,$optime,$memo1);
$rsmb=$db->get_one("select mobile from {$db_prefix}users where username='".$rs['userid']."' limit 1");
sendduanxin_chongzhi($rs['userid'],$rsmb['mobile'],date("Y-m-d H:i:s",$rs["addtime"]),$money);
sendduanxin_huikuan2($rs['userid'],date("Y-m-d H:i:s",$rs["addtime"]),floatval($money),2);
}
header("location:../../user/wangyin.php");exit();
}else{
$db->query("update {$db_prefix}wangyin set state=2 where id='$v_oid'");
echo "<script>alert('支付失败1');location.href='../../user/wangyin.php';</script>";exit();
}
}else{
$db->query("update {$db_prefix}wangyin set state=3 where id='$v_oid'");
echo "<script>alert('支付失败2');location.href='../../user/wangyin.php';</script>";exit();
}
;echo '
'
?>
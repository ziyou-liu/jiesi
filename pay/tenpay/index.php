<?php

include("../../include/conn_2.php");
include("../../include/function.php");
$sqlj="select * from {$db_prefix}wangyin where id='".$v_oid."'";
$rsj=$db->get_one($sqlj);
$jd_memo="会员".$_SESSION['glo_username']."财付通充值";
$payuser = $_SESSION['glo_username'];
$price = $rsj['money'];
require_once ("classes/PayRequestHandler.class.php");
$price *= 100;
$bargainor_id = $glo_cft_username;
$key = $glo_cft_password;
$return_url = $glo_cft_url.'/pay/tenpay/return_url.php';
$strDate = date("Ymd");
$strTime = date("His");
$randNum = rand(1000,9999);
$strReq = $strTime .$randNum;
$sp_billno = $v_oid;
$transaction_id = $bargainor_id .$strDate .$strReq;
$total_fee = $price;
$desc = $jd_memo;
$reqHandler = new PayRequestHandler();
$reqHandler->init();
$reqHandler->setKey($key);
$reqHandler->setParameter("bargainor_id",$bargainor_id);
$reqHandler->setParameter("sp_billno",$sp_billno);
$reqHandler->setParameter("transaction_id",$transaction_id);
$reqHandler->setParameter("total_fee",$total_fee);
$reqHandler->setParameter("return_url",$return_url);
$reqHandler->setParameter("desc",$jd_memo);
$reqHandler->setParameter("spbill_create_ip",$_SERVER['REMOTE_ADDR']);
$reqUrl = $reqHandler->getRequestURL();
echo "<script>location.href='".$reqUrl."';</script>";
;echo '财付通充值<br />
在线充值的时候请不要关闭页面！充值成功后页面自动跳转......
';
?>
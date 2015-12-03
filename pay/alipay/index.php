<?php
echo '支付宝充值<br />
在线充值的时候请不要关闭页面！充值成功后页面自动跳转..
';
include("../../include/conn_2.php");
include("../../include/function.php");
require_once("alipay_service.php");
require_once("alipay_config.php");
$sqlj="select a.*,b.email,b.mobile from {$db_prefix}wangyin a,{$db_prefix}users b where a.id='".$v_oid."' and a.userid=b.username";
$rsj=$db->get_one($sqlj);
$jd_title="账户充值";
$jd_memo="会员".$_SESSION['glo_username']."支付宝充值";
$jd_price=$rsj['money'];
$jd_show_url=$show_url."/user/wangyin.php";
$parameter = array(
"_input_charset"=>$_input_charset,
"body"=>$jd_memo,
"notify_url"=>$notify_url,
"out_trade_no"=>$v_oid,
"partner"=>$partner,
"payment_type"=>"1",
"return_url"=>$return_url,
"seller_email"=>$seller_email,
"service"=>"create_direct_pay_by_user",
"show_url"=>$jd_show_url,
"subject"=>$jd_title,
"total_fee"=>$jd_price          
);
$alipay = new alipay_service($parameter,$security_code,$sign_type);
$link=$alipay->create_url();
echo "<script>location.href='".$link."';</script>";
;echo '
'
?>
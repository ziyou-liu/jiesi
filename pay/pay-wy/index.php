<?php
echo '<!--
 * ====================================================================
 *
 *                Send.php 由网银在线技术支持提供
 *
 *  本页面接收来自上页所有订单信息,并提交支付表单信息到网线在线支付平台....
 *
 *
 * ====================================================================
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
';
include("../../include/conn_2.php");
include("../../include/function.php");
;echo '<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>网银在线支付接口</title>

<link href="css/index.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="javascript:document.E_FORM.submit()">
网银在线正在充值

';
$v_mid = $glo_wy_username;
$v_url = $glo_cft_url.'/pay/pay-wy/Receive.php';
$key   = $glo_wy_password;
if(trim($_GET['v_oid'])<>"")					
{
$v_oid = trim($_GET['v_oid']);
}
else
{
echo "<script>alert('订单错误');locacton.href='".$glo_cft_url."/user/wangyin.php';</script>";exit();
}
$sqlj="select a.*,b.email,b.mobile from {$db_prefix}wangyin a,{$db_prefix}users b where a.id='".$v_oid."' and a.userid=b.username";
$rsj=$db->get_one($sqlj);
$jd_title="账户充值";
$jd_memo="网银在线充值";
$jd_price=$rsj['money'];
$v_amount =$jd_price;
$v_moneytype = "CNY";
$text = $jd_price.$v_moneytype.$v_oid.$v_mid.$v_url.$key;
$v_md5info = strtoupper(md5($text));
$remark1 = trim($jd_title);
$remark2 = trim($jd_memo);
$v_rcvname   = $_SESSION['glo_userid']  ;
$v_rcvaddr   = trim($_POST['v_rcvaddr'])  ;
$v_rcvtel    = trim($_POST['v_rcvtel'])   ;
$v_rcvpost   = $rsj['email']  ;
$v_rcvemail  = trim($_POST['v_rcvemail']) ;
$v_rcvmobile = $rsj['mobile'];
$v_ordername   = trim($_POST['v_ordername'])  ;
$v_orderaddr   = trim($_POST['v_orderaddr'])  ;
$v_ordertel    = trim($_POST['v_ordertel'])   ;
$v_orderpost   = trim($_POST['v_orderpost'])  ;
$v_orderemail  = trim($_POST['v_orderemail']) ;
$v_ordermobile = trim($_POST['v_ordermobile']);
;echo '
<!--以下信息为标准的 HTML 格式 + ASP 语言 拼凑而成的 网银在线 支付接口标准演示页面 无需修改-->

<form method="post" name="E_FORM" action="https://pay3.chinabank.com.cn/PayGate" target="_self">
	<input type="hidden" name="v_mid"         value="';echo $v_mid;;echo '">
	<input type="hidden" name="v_oid"         value="';echo $v_oid;;echo '">
	<input type="hidden" name="v_amount"      value="';echo $jd_price;;echo '">
	<input type="hidden" name="v_moneytype"   value="';echo $v_moneytype;;echo '">
	<input type="hidden" name="v_url"         value="';echo $v_url;;echo '">
	<input type="hidden" name="v_md5info"     value="';echo $v_md5info;;echo '">

 <!--以下几项项为网上支付完成后，随支付反馈信息一同传给信息接收页 -->

	<input type="hidden" name="remark1"       value="';echo $remark1;;echo '">
	<input type="hidden" name="remark2"       value="';echo $remark2;;echo '">



<!--以下几项只是用来记录客户信息，可以不用，不影响支付 -->
	<input type="hidden" name="v_rcvname"      value="';echo $v_rcvname;;echo '">
	<input type="hidden" name="v_rcvtel"       value="';echo $v_rcvtel;;echo '">
	<input type="hidden" name="v_rcvpost"      value="';echo $v_rcvpost;;echo '">
	<input type="hidden" name="v_rcvaddr"      value="';echo $v_rcvaddr;;echo '">
	<input type="hidden" name="v_rcvemail"     value="';echo $v_rcvemail;;echo '">
	<input type="hidden" name="v_rcvmobile"    value="';echo $v_rcvmobile;;echo '">

	<input type="hidden" name="v_ordername"    value="';echo $v_ordername;;echo '">
	<input type="hidden" name="v_ordertel"     value="';echo $v_ordertel;;echo '">
	<input type="hidden" name="v_orderpost"    value="';echo $v_orderpost;;echo '">
	<input type="hidden" name="v_orderaddr"    value="';echo $v_orderaddr;;echo '">
	<input type="hidden" name="v_ordermobile"  value="';echo $v_ordermobile;;echo '">
	<input type="hidden" name="v_orderemail"   value="';echo $v_orderemail;;echo '">

</form>

</body>
</html>
';
?>
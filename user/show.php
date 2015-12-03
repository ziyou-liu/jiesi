<?php
echo '<html>
	<head>
		<title>快钱支付结果</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" >
		<link rel="stylesheet" href="/images/datalist.css" type="text/css">
	</head>
<BODY>
';
include("../include/conn_1.php");
$orderId=trim($_REQUEST['orderId']);
$orderAmount=trim($_REQUEST['orderAmount']*0.01);
$msg=trim($_REQUEST['msg']);
$bankid=trim($_REQUEST['bankId']);
$ext1=trim($_REQUEST['ext1']);
if($msg==1){
$msg="充值成功！";
}else{
if($msg==2) $msg="金额不符,充值失败";
if($msg==3) $msg="密钥不符,充值失败";
}
;echo '	<div align="center">
		<table width="259" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" >
			<tr bgcolor="#FFFFFF">
				<td width="80">支付方式:</td>
				<td >快钱[99bill]</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td >订单编号:</td>
				<td >';echo $orderId;;echo '</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td>订单金额:</td>
				<td>';echo $orderAmount."积分";;echo '</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td>支付结果:</td>
				<td>';echo $msg;;echo '</td>
			</tr>
			 ';
if($msg==1){
$pagename=$ext1.".php";
;echo '			<tr>
				<td colspan="2"><a href="';echo $pagename;;echo '"><u>继续操作</u></a></td>
			</tr>
            ';};echo '			<tr>
				<td></td>
				<td></td>
			</tr>
	  </table>
	</div>

</BODY>
</HTML>';
?>
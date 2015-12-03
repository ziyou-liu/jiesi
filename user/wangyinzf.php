<?php

include_once('../include/conn_1.php');
include_once('../include/pv.php');
include("../include/pageclass.php");
include_once('../include/function.php');
include_once('../include/rank.php');
include("../include/secpwd.php");
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="stylesheet" href="/images/datalist3.css" type="text/css">
<style type="text/css">
<!--
.numberonetd{
	text-align:left;line-height:22px;background:url(images/bg.gif);padding:0 0 0 10px;font-weight:bold;
}
.lefttd{
	text-align:right;background:#FBFDFF;vertical-align:middle;width:30%;height:38px;padding-right:5px;
}
.righttd{
	text-align:left;background:#FBFDFF;vertical-align:middle;width:70%;height:38px;padding-left:5px;
}
.style1{color:#ff0000;}
#banklist td{
	border:0px;
}
-->
</style>
';
$sqlu="select bdmoney,rank,state from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rsu=$db->get_one($sqlu);
if ($_GET["action"]=="pay"){
$hint="";$modtime=time();
foreach($_POST as $key=>$value) {
$$key=$value;
}
$money_preg="/^[0-9.]+$/";
if (!preg_match($money_preg,$money) ||$money==0){
$hint.="订单金额不对\\n";
}
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$paytype=2;
if($paytype==2){
$sql="insert into {$db_prefix}wangyin(username,realname,money,addtime,state,type,paytype,pd_frpid) values('".$_SESSION['glo_username']."','".$_SESSION['glo_realname']."','".$money."','".$modtime."','0','1','$paytype','$pd_FrpId')";
$db->query($sql);
$bill99_orderid=$db->insert_id();
switch($paytype){
case 1:$payurl="alipay";break;
case 2:$payurl="huanxun";break;
case 3:$payurl="99bill";break;
case 4:$payurl="pay-wy";break;
case 5:$payurl="tenpay";break;
case 6:$payurl="xingye";break;
case 7:$payurl="biipay";break;
}
echo "<script>location.href='../pay/{$payurl}/index.php?v_oid=".$bill99_orderid."';</script>";exit();
}else{
echo "<script>location.href='wangyinzf.php';</script>";exit();
}
}
;echo '<script language="javascript" type="text/javascript" src="../jQuery/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../jQuery/jquery.alerts4.js"></script>
<link rel="stylesheet" href="../jQuery/jquery.alerts.css" type="text/css">
<script language="javascript">
function paychk(frm){
	if (frm.money.value == ""){
		alert("请输入支付金额！")
		frm.money.focus();
		return false;
	}
	var reg=/^[0-9]+.?[0-9]{0,2}$/;
	if(reg.test(frm.money.value)==false){
		alert("存款金额必须是数字,最多只能有2位小数")
		frm.money.focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div id="toubu">当前位置：财务管理&gt;&gt;在线充值</div>

<form action="wangyinzf.php?action=pay" method="post" target="_blank"  onsubmit="return paychk(this)">
<input type="hidden" name=\'username\' value="';echo $_SESSION['glo_username'];;echo '" />
<table width="80%" border="0" cellpadding="2" cellspacing="0" class="tablebg">
	<TR>
	  <TD class="lefttd">金额:</TD>
	  <TD class="righttd">
	  ';
$define=100;
;echo '	  <input name="money" type="text" onkeyup="if(isNaN(value))execCommand(\'undo\')" value="';echo $define;;echo '" size="10" onafterpaste="if(isNaN(value))execCommand(\'undo\')" /> 元
	  </TD>
	</TR>
</table>
	<div style="clear:both;height:26px;text-align:center;margin-top:15px;">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="下一步" name="but">
	</div>
</form>

</body>
</html>'
?>
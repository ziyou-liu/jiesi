<?php

include("../../include/conn_2.php");include("../../include/function.php");
$sql="select * from {$db_prefix}wangyin where id='$v_oid'";
$rs=$db->get_one($sql);
$ip=getip();
$curdate=date("Ymd",$modtime);
$str="servicecib.netpay.b2cver01mrch_no{$glo_xy_username}ord_no{$v_oid}ord_date{$curdate}curCNYord_amt{$rs['money']}{$glo_xy_password}";
$mac=strtoupper(md5($str));
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>兴业银行</title>
<style type="text/css">
td{
	font-size:12px;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="https://payment.cib.com.cn/payment/entry.action">
  <table width="957px" border="0" align="center">
    <tr>
      <td colspan="2"><img src="images/topbg.png" width="957" height="73" /></td>
    </tr>
    <tr>
      <td align="right">金额：</td>
      <td height="50"><label>
       ';echo $rs['money'];echo '<input name="ord_amt" type="hidden" value="';echo $rs['money'];echo '" />
      元 </label></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="确定充值" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="service" type="hidden" id="service" value="cib.netpay.b2c" />
      <input name="ver" type="hidden" id="ver" value="01" />
      <input name="mrch_no" type="hidden" id="mrch_no" value="';echo $glo_xy_username;echo '" />
      <input name="ord_no" type="hidden" id="ord_no" value="';echo $v_oid;echo '" />
      <input name="ord_date" type="hidden" id="ord_date" value="';echo $curdate;echo '" />
      <input name="cur" type="hidden" id="cur" value="CNY" />
      <input name="mac" type="hidden" id="mac" value="';echo $mac;echo '" /></td>
    </tr>
  </table>
</form>
</body>
</html>
';
?>
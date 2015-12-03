<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");
if ($mod=="s"){
$hint="";
if (empty($price)) $hint.="请输入金额\\n";
if ($price<=0) $hint.="充值金额不得小于0\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$addtime=time();
$orderTime=date('YmdHis',$addtime);
$sql="insert into {$db_prefix}usermoney (username,addtime,money) values ('".$_SESSION["glo_username"]."','$addtime','$price')";
$db->query($sql);
$orderAmount=$price;
$orderId=$db->insert_id();
$productName="充值";
$payerName=$_SESSION["glo_username"];
$ext1=$ext1;
$sql="select bank from {$db_prefix}users where username='".$_SESSION["glo_username"]."' ";
$result=$db->get_one($sql);
switch($result["bank"]){
case "农行":
$bankId="ABC";
break;
case "工行";
$bankId="ICBC";
break;
case "建行";
$bankId="CCB";
break;
}
;echo '	<script language="javascript">
	window.location.href="send.php?payerName=';echo $payerName;;echo '&productName=';echo urlencode($productName);;echo '&orderId=';echo $orderId;;echo '&orderAmount=';echo $orderAmount;;echo '&ext1=';echo $ext1;;echo '&bankId=';echo $bankId;;echo '";
	</script>
	';
}
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$u_rs=$db->get_one($sql);
;echo '<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>
<form name="form1" method="post" action="moneyin.php"><input type="hidden" name="mod" value="s">
<input type="hidden" name="ext1" value="';echo $ext1;;echo '">
<br>

<TABLE width="350" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="350" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>充值中心</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="38%" align="right" valign="middle" bgColor="#FBFDFF" >充值金额:</TD>
	  <TD width="62%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="price" type="text" id="price" size="10">元</TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定充值" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
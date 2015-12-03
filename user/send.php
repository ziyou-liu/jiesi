<?php

SESSION_start();
if (empty($_SESSION["glo_username"])){
header("location:../login.php");exit();
}
$productName=iconv("utf-8","gb2312",$productName);
$merchantAcctId="1001758488801";
$key="XQ6HWQMXZHSUMTU2";
$inputCharset="3";
$pageUrl="";
$bgUrl="http://2.9885.net/user/receive.php";
$version="v2.0";
$language="1";
$signType="1";
$payerContactType="1";
$payerContact="";
$orderAmount=$orderAmount*100;
$orderTime=date('YmdHis');
$productNum="1";
$productId="";
$productDesc="";
$ext2="";
$payType="10";
$redoFlag="0";
$pid="";
$signMsgVal=appendParam($signMsgVal,"inputCharset",$inputCharset);
$signMsgVal=appendParam($signMsgVal,"pageUrl",$pageUrl);
$signMsgVal=appendParam($signMsgVal,"bgUrl",$bgUrl);
$signMsgVal=appendParam($signMsgVal,"version",$version);
$signMsgVal=appendParam($signMsgVal,"language",$language);
$signMsgVal=appendParam($signMsgVal,"signType",$signType);
$signMsgVal=appendParam($signMsgVal,"merchantAcctId",$merchantAcctId);
$signMsgVal=appendParam($signMsgVal,"payerName",$payerName);
$signMsgVal=appendParam($signMsgVal,"payerContactType",$payerContactType);
$signMsgVal=appendParam($signMsgVal,"payerContact",$payerContact);
$signMsgVal=appendParam($signMsgVal,"orderId",$orderId);
$signMsgVal=appendParam($signMsgVal,"orderAmount",$orderAmount);
$signMsgVal=appendParam($signMsgVal,"orderTime",$orderTime);
$signMsgVal=appendParam($signMsgVal,"productName",$productName);
$signMsgVal=appendParam($signMsgVal,"productNum",$productNum);
$signMsgVal=appendParam($signMsgVal,"productId",$productId);
$signMsgVal=appendParam($signMsgVal,"productDesc",$productDesc);
$signMsgVal=appendParam($signMsgVal,"ext1",$ext1);
$signMsgVal=appendParam($signMsgVal,"ext2",$ext2);
$signMsgVal=appendParam($signMsgVal,"payType",$payType);
$signMsgVal=appendParam($signMsgVal,"bankId",$bankId);
$signMsgVal=appendParam($signMsgVal,"redoFlag",$redoFlag);
$signMsgVal=appendParam($signMsgVal,"pid",$pid);
$signMsgVal=appendParam($signMsgVal,"key",$key);
$signMsg= strtoupper(md5($signMsgVal));
Function appendParam($returnStr,$paramId,$paramValue){
if($returnStr!=""){
if($paramValue!=""){
$returnStr.="&".$paramId."=".$paramValue;
}
}else{
If($paramValue!=""){
$returnStr=$paramId."=".$paramValue;
}
}
return $returnStr;
}
;echo '
<!doctype html public "-//w3c//dtd html 4.0 transitional//en" >
<html>
	<head>
	<link rel="stylesheet" href="/images/datalist.css" type="text/css">
		<title>Ê¹ÓÃ¿ìÇ®Ö§¸¶</title>
		<meta http-equiv="content-type" content="text/html; charset=gb2312" >
	</head>

<BODY><br><br>

	<div align="center">
		<table width="259" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" >
			<tr bgcolor="#FFFFFF">
				<td width="80">Ö§¸¶·½Ê½:</td>
				<td >¿ìÇ®[99bill]</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td >¶©µ¥±àºÅ:</td>
				<td >';echo $orderId;;echo '</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td>¶©µ¥½ð¶î:</td>
				<td>';echo $orderAmount*0.01;;echo '</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td>Ö§¸¶ÈË:</td>
				<td>';echo $payerName;;echo '</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td>ÉÌÆ·Ãû³Æ:</td>
				<td>';echo $productName;;echo '</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
	  </table>
	</div>

	<div align="center" style="font-size=12px;font-weight: bold;color=red;">
		<form name="kqPay" method="post" action="https://www.99bill.com/gateway/recvMerchantInfoAction.htm" target="_blank">
			<input type="hidden" name="inputCharset" value="';echo $inputCharset;;echo '"/>
			<input type="hidden" name="bgUrl" value="';echo $bgUrl;;echo '"/>
			<input type="hidden" name="pageUrl" value="';echo $pageUrl;;echo '"/>
			<input type="hidden" name="version" value="';echo $version;;echo '"/>
			<input type="hidden" name="language" value="';echo $language;;echo '"/>
			<input type="hidden" name="signType" value="';echo $signType;;echo '"/>
			<input type="hidden" name="signMsg" value="';echo $signMsg;;echo '"/>
			<input type="hidden" name="merchantAcctId" value="';echo $merchantAcctId;;echo '"/>
			<input type="hidden" name="payerName" value="';echo $payerName;;echo '"/>
			<input type="hidden" name="payerContactType" value="';echo $payerContactType;;echo '"/>
			<input type="hidden" name="payerContact" value="';echo $payerContact;;echo '"/>
			<input type="hidden" name="orderId" value="';echo $orderId;;echo '"/>
			<input type="hidden" name="orderAmount" value="';echo $orderAmount;;echo '"/>
			<input type="hidden" name="orderTime" value="';echo $orderTime;;echo '"/>
			<input type="hidden" name="productName" value="';echo $productName;;echo '"/>
			<input type="hidden" name="productNum" value="';echo $productNum;;echo '"/>
			<input type="hidden" name="productId" value="';echo $productId;;echo '"/>
			<input type="hidden" name="productDesc" value="';echo $productDesc;;echo '"/>
			<input type="hidden" name="ext1" value="';echo $ext1;;echo '"/>
			<input type="hidden" name="ext2" value="';echo $ext2;;echo '"/>
			<input type="hidden" name="payType" value="';echo $payType;;echo '"/>
			<input type="hidden" name="bankId" value="';echo $bankId;;echo '"/>
			<input type="hidden" name="redoFlag" value="';echo $redoFlag;;echo '"/>
			<input type="hidden" name="pid" value="';echo $pid;;echo '"/>		<br>	
<input type="submit" name="submit" value="Ìá½»" class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'">
		</form>
	</div>

</BODY>
</HTML>';
?>
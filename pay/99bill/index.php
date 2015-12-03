<?php

include("../../include/conn_2.php");
include("../../include/function.php");
$sql_bill="select a.*,b.mobile,b.email from {$db_prefix}wangyin a,{$db_prefix}users b where a.userid=b.username and a.id='".$v_oid."' limit 1";
$rs_bill=$db->get_one($sql_bill);
$bill99_payerName=$rs_bill["userid"];
$bill99_mobile=$rs_bill["mobile"];
$bill99_email=$rs_bill["email"];
$bill99_money=$rs_bill["money"];
$bill99_time=$rs_bill["addtime"];
$merchantAcctId=$glo_bill99_username;
$key=$glo_bill99_password;
$inputCharset="1";
$pageUrl="";
$bgUrl=$glo_cft_url."/pay/99bill/receive.php";
$version="v2.0";
$language="1";
$signType="1";
$payerName=$bill99_payerName;
$payerContactType="1";
$payerContact=$bill99_email;
$orderId=$v_oid;
$orderAmount=$bill99_money*100;
$orderTime=date('YmdHis',$bill99_time);
$productName="电子账户充值";
$productNum="1";
$productId="电子币";
$productDesc="1电子币=1元；";
$ext1="";
$ext2="";
$payType="00";
$bankId="";
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
function appendParam($returnStr,$paramId,$paramValue){
if($returnStr!=""){
if($paramValue!=""){
$returnStr.="&".$paramId."=".$paramValue;
}
}else{
if($paramValue!=""){
$returnStr=$paramId."=".$paramValue;
}
}
return $returnStr;
}
;echo '
<!doctype html public "-//w3c//dtd html 4.0 transitional//en" >
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" >
		<title>使用快钱支付</title>
		
		<link href="../skin/css.css" rel="stylesheet" type="text/css" />
	    <style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
	color: #3366CC;
}
td{
	font-size: 12px;
}
-->
        </style>
	</head>
	
<BODY>
	
<TABLE cellSpacing=5 cellPadding=0 width="600" border=0 align="center">
  <TBODY>
	<TR>
      <TD id=test1 vAlign=top>
	  <img src="../../images/bill99.jpg" border="0">
	  <table class="Table_xt" cellspacing="0" cellpadding="0" width="100%" border="0">
        <tbody>
          <tr>
            <td valign="top" bgcolor="#d4e8fa"><table bordercolor=#ffffff cellspacing=0 cellpadding=1 width="100%" align=center bgcolor=#d4e8fa border=1>
              <tbody id="tr_1" style="display:">
			  	
               
                <tr bgcolor="#f2f9fd">
                <td width="50%"  height="30" align="right"><strong>商品名称:</strong></td>
                <td width="50%"  height="30">';echo $productName;;echo '</td>
	        </tr>
			<tr bgcolor="#f2f9fd">
				<td  height="30" align="right"><strong>支付方式:</strong></td>
				<td height="30" >快钱</td>
			</tr>
			<tr bgcolor="#f2f9fd">
				<td height="30" align="right" ><strong>订单编号:</strong></td>
				<td height="30" >';echo $orderId;;echo '</td>
			</tr>
			<tr bgcolor="#f2f9fd">
				<td height="30" align="right"><strong>订单金额:</strong></td>
				<td height="30">';echo $orderAmount/100;;echo '元</td>
			</tr>
			
            <tr bgcolor="#f2f9fd">
				<td height="30" align="center" colspan="2"><div align="center" style="font-size=12px;font-weight: bold;color=red;">
		<form name="kqPay" method="post" target="_self" action="https://www.99bill.com/gateway/recvMerchantInfoAction.htm">
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
			<input type="hidden" name="pid" value="';echo $pid;;echo '"/>
			<input type="submit" name="submit" value="提交" class="button_text" onMouseDown="this.className=\'button_onmousedown\'"  onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'">	<input type="button" name="submit1" value="返回" class="button_text" onMouseDown="this.className=\'button_onmousedown\'"  onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="history.back();">			
		</form>		
	</div></td>
			</tr>          
            </table> 
              </td>
          </tr>
        </tbody>
      </table></td>
	</TR>
  </tbody>
</table>
</BODY>
</HTML>';
?>
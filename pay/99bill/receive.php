<?php

include("../../include/conn_1.php");
include("../../include/function.php");
include("../../include/ecls.php");
$merchantAcctId=trim($_REQUEST['merchantAcctId']);
$key=$glo_bill99_password;
$version=trim($_REQUEST['version']);
$language=trim($_REQUEST['language']);
$signType=trim($_REQUEST['signType']);
$payType=trim($_REQUEST['payType']);
$bankId=trim($_REQUEST['bankId']);
$orderId=trim($_REQUEST['orderId']);
$orderTime=trim($_REQUEST['orderTime']);
$orderAmount=trim($_REQUEST['orderAmount']);
$dealId=trim($_REQUEST['dealId']);
$bankDealId=trim($_REQUEST['bankDealId']);
$dealTime=trim($_REQUEST['dealTime']);
$payAmount=trim($_REQUEST['payAmount']);
$fee=trim($_REQUEST['fee']);
$ext1=trim($_REQUEST['ext1']);
$ext2=trim($_REQUEST['ext2']);
$payResult=trim($_REQUEST['payResult']);
$errCode=trim($_REQUEST['errCode']);
$signMsg=trim($_REQUEST['signMsg']);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"merchantAcctId",$merchantAcctId);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"version",$version);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"language",$language);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"signType",$signType);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"payType",$payType);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"bankId",$bankId);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"orderId",$orderId);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"orderTime",$orderTime);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"orderAmount",$orderAmount);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"dealId",$dealId);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"bankDealId",$bankDealId);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"dealTime",$dealTime);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"payAmount",$payAmount);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"fee",$fee);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"ext1",$ext1);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"ext2",$ext2);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"payResult",$payResult);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"errCode",$errCode);
$merchantSignMsgVal=appendParam($merchantSignMsgVal,"key",$key);
$merchantSignMsg= md5($merchantSignMsgVal);
$rtnOk=0;
$rtnUrl="";
if(strtoupper($signMsg)==strtoupper($merchantSignMsg)){
switch($payResult){
case "10":
$sql="select * from {$db_prefix}wangyin where id='".$orderId."' limit 1";
$rs=$db->get_one($sql);
if($rs['state']==0){
$sql="update {$db_prefix}wangyin set state=1 where id='".$orderId."'";
$db->query($sql);
$sql1="update {$db_prefix}users set price=price+".($payAmount/100)." where username='".$rs["userid"]."' limit 1";
$db->query($sql1);
$memo=1;$type=1;$optime=time();$money=floatval($payAmount/100);$memo1="快钱充值";
eclsproc($rs['userid'],$memo,$money,$type,$optime,$memo1);
$rsmb=$db->get_one("select mobile from {$db_prefix}users where username='".$rs['userid']."' limit 1");
sendduanxin_chongzhi($rs['userid'],$rsmb['mobile'],date("Y-m-d H:i:s",$rs["addtime"]),$money);
sendduanxin_huikuan2($rs['userid'],date("Y-m-d H:i:s",$rs["addtime"]),floatval($money),2);
}
$rtnOk=1;
$rtnUrl=$glo_cft_url."/user/wangyin.php";
break;
default:
$rtnOk=1;
$rtnUrl=$glo_cft_url."/user/wangyin.php";
break;
}
}else{
$rtnOk=1;
$rtnUrl=$glo_cft_url."/user/wangyin.php";
}
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
;echo '<result>';echo $rtnOk;;echo '</result><redirecturl>';echo $rtnUrl;;echo '</redirecturl>';
?>
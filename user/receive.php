<?php

include("../include/config_bill.php");include("../include/db_mysql.class2.php");
$db=new db_mysql;
$db->connect($dbhost,$dbuser,$dbpwd,$dbname,$pconnect = 0);
$merchantAcctId=trim($_REQUEST['merchantAcctId']);
$key="XQ6HWQMXZHSUMTU2";
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
$payAmount=$payAmount*0.01;
$fee=$fee*0.01;
if(strtoupper($signMsg)==strtoupper($merchantSignMsg)){
switch($payResult){
case "10":
$orderAmount=$orderAmount*0.01;
$state=1;
$sql="select username from {$db_prefix}usermoney where id='$orderId' ";
$result=$db->get_one($sql);
$sql="update {$db_prefix}users set price=price+'".floatval($orderAmount)."' where username='".$result["username"]."'";
$db->query($sql);
$year=substr($dealTime,0,4);
$month=substr($dealTime,4,2);
$day=substr($dealTime,6,2);
$hon=substr($dealTime,8,2);
$min=substr($dealTime,10,2);
$second=substr($dealTime,12,2);
$optime=mktime($hon,$min,$second,$month,$day,$year);
$memo=1;$type=1;$money=$orderAmount;$memo1="id (".$orderId.")";
eclsproc(trim($result["username"]),$memo,$money,$type,$optime,$memo1);
$rtnOk=1;
$rtnUrl="http://2.9885.net/user/show.php?msg=1";
break;
default:
$state=2;
$rtnOk=1;
$rtnUrl="http://2.9885.net/user/show.php?msg=2";
break;
}
}Else{
$state=2;
$rtnOk=1;
$rtnUrl="http://2.9885.net/user/show.php?msg=3";
}
if(!empty($orderId)){
$sql="update {$db_prefix}usermoney set state='$state',bank='$bankId',fee='$fee',payAmount='$payAmount',dealid='$dealId',confirmtime='$dealTime' where id='$orderId' ";
$db->query($sql);
}
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
function eclsproc($username,$memo,$money,$type,$optime,$memo1){
global $db,$db_prefix;
$sql_e="insert into {$db_prefix}e(username,memo,money,type,addtime,memo1) values('".$username."','".$memo."','".$money."','".$type."','".$optime."','".$memo1."')";
$db->query($sql_e);
}
;echo '<result>';echo $rtnOk;;echo '</result><redirecturl>';echo $rtnUrl;;echo '</redirecturl>';
?>
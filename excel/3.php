<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
';
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"excel_3.xls\"");
include("../include/conn_1.php");include("../include/function.php");
include("../include/pv.php");
;echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table
style="WIDTH: 100%"
cellspacing="0" cellpadding="1" border="1" bandno="0">
   
  <tr><th bgcolor="#000000"><font color="#FFFFFF">编号</font></th>
  	<th bgcolor="#000000"><font color="#FFFFFF">会员编号</font></th>
      <th bgcolor="#000000"><font color="#FFFFFF">收款方姓名</font></th>
       <th bgcolor="#000000"><font color="#FFFFFF">提现银行</font></th>
      <th bgcolor="#000000"><font color="#FFFFFF">银行账号</font></th>
      <th bgcolor="#000000"><font color="#FFFFFF">金额</font></th>
	  <th bgcolor="#000000"><font color="#FFFFFF">手续费</font></th>
	  <th bgcolor="#000000"><font color="#FFFFFF">实际金额</font></th>
      <th bgcolor="#000000"><font color="#FFFFFF">申请时间</font></th>
      <th bgcolor="#000000"><font color="#FFFFFF">状态</font></th>
    </tr>
  ';
$sql="select * from {$db_prefix}cashes where 1 ";
$filter="";
if ($action=="query"){
if (trim($time1)!="") $filter.=" and addtime>='".timestr2unix($time1)."'";
if (trim($time2)!="") $filter.=" and addtime<='".(timestr2unix($time2)+3600*24)."'";
if (trim($username)!="") $filter.=" and username='$username'";
if (trim($state)!="all") $filter.=" and state='$state'";
}
$sql.=$filter;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while ($rs=$db->fetch_array($result)){
;echo '  <tr style="BACKGROUND-COLOR:#ffffff"  height="22" level="0">
     <td>';echo $rs["id"];echo '</td>
     <td>';echo $rs["username"];echo '</td>
    <td>';echo $rs["huzhu"];echo '</td>
    <td>';echo $rs["bank"];echo '</td>
    <td><div style="vnd.ms-excel.numberformat:@">';echo $rs["zhanghao"];echo '</div></td>
    <td>';echo $rs["price"];echo '</td>
	<td>';if($rs['state']==0) echo $sxf=$rs["price"]*$glo_withdraw_fee/100;else echo $rs['fee'];;echo '</td>
	<td>';if($rs['state']==0) echo $rs['price']-$sxf;else echo $rs["price"]-$rs['fee'];;echo '</td>
    <td>';echo date("Y-m-d",$rs["addtime"]);echo '</td>
   <td >';echo getcashstate($rs["state"]);echo '</td>
  </tr>
  ';
}
}
$db->free_result($result);
;echo '</table>
</body>
</html>
';
?>
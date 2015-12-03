<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");include("../include/area.php");
include("../include/pageclass.php");include("../include/orderstate.php");
include("../include/logs.php");
if (!empty($send)){
$modtime=time();$hint="";
$sql="select * from {$db_prefix}orders where id='".$id."'";
$rs=$db->get_one($sql);
if($rs["state"]!=1) die("<center>订单状态错误</center>");
$sql_1="select * from {$db_prefix}orders1 where orderid='".$id."'";
$result_1=$db->query($sql_1);
while ($rs_1=$db->fetch_array($result_1)){
$sql="select * from {$db_prefix}product where id='".$rs_1["productid"]."'";
$p_rs=$db->get_one($sql);
if($p_rs["num"]<$rs_1["num"]){
$hint.=$p_rs['productname']."库存不足\\n";
}
}
$db->free_result($result_1);
if($hint!="") {
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_1="select * from {$db_prefix}orders1 where orderid='".$id."'";
$result_1=$db->query($sql_1);
while ($rs_1=$db->fetch_array($result_1)){
$sql_2="insert into {$db_prefix}cks(productid,productname,num,addtime,orderid) values('".$rs_1["productid"]."','".$rs_1["productname"]."','".$rs_1["num"]."','".$modtime."','".$id."')";
$db->query($sql_2);
$sql_3="update {$db_prefix}product set num=num-".intval($rs_1["num"])." where id='".$rs_1["productid"]."'";
$db->query($sql_3);
$productname=$rs_1["productname"];
}
$db->free_result($result_1);
$sql1="update {$db_prefix}orders set state=2,fahuotime='$modtime' where id='$id' ";
$db->query($sql1);
$sql2="update {$db_prefix}orders1 set state=2 where orderid='$id' ";
$db->query($sql2);
$sql="insert into {$db_prefix}logistics (orderid,companyid,log_no,memo,address,tel,mobile,state,sendtime,receiver,postcode) values ('$id','$companyid','$log_no','$memo','$address','$tel','$mobile','1','$modtime','$receiver','$postcode')";
$db->query($sql);
$adminid=$_SESSION["glo_adminid"];$admin=$_SESSION["glo_adminname"];$type=14;$addtime=time();$ip=getip();$memo="管理员{$admin}发货,订单编号{$id}";
setlogsrec($adminid,$admin,$type,$addtime,$ip,$memo);
header("location:orders.php?pageno={$pageno}");exit();
}
$order_sql="select * from {$db_prefix}orders where id='$id' ";
$order_result=$db->get_one($order_sql);
$order_username=$order_result["username"];
$user_sql="select * from {$db_prefix}users where username='$order_username' ";
$u_res=$db->get_one($user_sql);
;echo '<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
<script>
function frmchk(frm){
	if (frm.companyid.value=="")
	{
		alert("请选择物流公司");
		frm.companyid.focus();
		return false;
	}
	if (frm.log_no.value=="")
	{
		alert("请输入物流单号");
		frm.log_no.focus();
		return false;
	}
}
</script>
</HEAD><body>
<TABLE cellSpacing=5 cellPadding=0 width="50%" border=0 align="center">
  <TBODY>
  <TR>
    <TD id=test1 vAlign=top colSpan=2>
<TABLE class=Table_xt cellSpacing=0 cellPadding=0 width="100%" border=0>
<TBODY>
<TR><TD colSpan=5>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD background="images/tab_05.gif" height=23>&nbsp;<B>发货</B></TD>
</TR></TBODY></TABLE>
</TD></TR>

<TR><TD vAlign="top" bgColor="#ffffff" colSpan="5">
 <form action="';print "$PHP_SELFT";;echo '" method="post" onSubmit="return frmchk(this);">
 <input type="hidden" name="id" value="';print "$id";;echo '">
 <input type="hidden" name="from" value="';print "$from";;echo '">
  <TABLE borderColor="#ffffff" cellSpacing=1 cellPadding=1 width="100%" align=center bgColor=#d4e8fa border=1>
<TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
<TD width="24%">订单编号:</TD>
<TD width="76%">';echo $id;;echo '</TD>
</tr>
<TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
<TD>会员编号:</TD>
<TD>';echo $order_username;;echo '</TD>
</tr>
       <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >详细收货地址:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >
     ';$address=getprovince($u_res["province"])."-".getcity($u_res["city"])."-".getarea($u_res["area"]).$u_res["address"];echo $address;;echo '	 <input type="hidden" name="address" value="';echo $address;;echo '">
	 </TD>
	  </TR>
     <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $u_res["receiver"];;echo '	  <input type="hidden" name="receiver" value="';echo $u_res["receiver"];;echo '"></TD>
	 </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人联系手机:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $u_res["mobile"];;echo '	  <input type="hidden" name="mobile" value="';echo $u_res["mobile"];;echo '">
	  </TD>
	  </TR>
   <!-- <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人联系座机:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $u_res["phone"];;echo '	  <input type="hidden" name="tel" value="';echo $u_res["phone"];;echo '">
	  </TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $u_res["postcode"];;echo '	  <input type="hidden" name="postcode" value="';echo $u_res["postcode"];;echo '">
	  </TD>
	  </TR>-->
	<TR height=22 style="BACKGROUND-COLOR:#ffffff">
	<TD>物流:</TD>
	<TD level="0_3">
	<select name="companyid" id="companyid">
	<option value="">请选择</option>
	';
$sql="select * from {$db_prefix}logcom order by company ";
$c_res=$db->query($sql);
while($crs=$db->fetch_array($c_res)){
$cname=$crs["company"];
$cid=$crs["id"];;echo '	<option value="';echo $cid;;echo '">';echo $cname;;echo '</option>
  ';};echo '	</select>
	<span class="style1">*</span></TD>
	</tr>
	<TR height=22 style="BACKGROUND-COLOR:#ffffff">
	<TD>物流单号:</TD>
	<TD level="0_3"><input type="text" name="log_no" id="log_no"><span class="style1">*</span></TD>
	</tr>
	<TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
	<TD>备注:</TD>
	<TD><textarea name="memo" rows="4" cols="40"></textarea></TD>
	</TR>
	<TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
	<TD colspan="2" align="right" background="images/tab_19.gif"><input type="submit" class="button_text" name="send" value="确定发货" onClick="return confirm(\'确定发货吗?\\r一旦发货将扣除库存数量\')"></TD>
	</TR>
  </TABLE>
  </form>
</TD>
</TR></TBODY></TABLE>
</TD></TR></TBODY></TABLE>
</body>
</html>
'
?>
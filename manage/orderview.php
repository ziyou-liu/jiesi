<?php

include("../include/conn.php");include("../include/function.php");
include("../include/area.php");
include("../include/rank.php");
include("../include/pv.php");
$sql="select * from {$db_prefix}orders where id='".$id."'";
$rs=$db->get_one($sql);
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD><body>
<form name="form1" method="post" action="">

<br>
<TABLE width="500" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="500" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>订单查看</strong>&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="50%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >订单编号:</TD>
	  <TD width="50%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $id;;echo ' </TD>
	  </TR>
	<TR>
	  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >订购会员:</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo ' </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["realname"];echo ' </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >订单时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d H:i:s",$rs["addtime"]);echo ' </TD>
	  </TR>
      ';if($rs['state']>=1){;echo '      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >付款时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d H:i:s",$rs["zftime"]);echo ' </TD>
	  </TR>
      ';};echo '      ';if($rs['state']>=2){;echo '      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >发货时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d H:i:s",$rs["fahuotime"]);echo ' </TD>
	  </TR>
      ';};echo '      ';if($rs['state']>=3){;echo '      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收货时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d H:i:s",$rs["shouhuotime"]);echo ' </TD>
	  </TR>
      ';};echo '	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >状态:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo getorderstate($rs["state"]);echo ' </TD>
	  </TR>
	<TR align="center">
	  <TD height="38" colspan="2" valign="middle" bgColor="#FBFDFF" >产品列表</TD>
	  </TR>
	<TR>
	  <TD height="38" colspan="2" align="right" valign="middle" bgColor="#FBFDFF" ><table width="100%"  border="0" cellpadding="3" cellspacing="1"  bgcolor="#000000">
	  <tbody bgcolor="#FFFFFF">
        <tr>
          <td>产品编号</td>
          <td>产品名</td>
          <td>数量</td>
          <td>单价</td>
        </tr>
		';
$sql1="select * from {$db_prefix}orders1 where orderid='".$id."'";
$result1=$db->query($sql1);
while ($rs1=$db->fetch_array($result1)){
;echo '        <tr>
          <td>';echo $rs1["productid"];echo '</td>
          <td>';echo $rs1["productname"];echo '</td>
          <td>';echo $rs1["num"];echo '</td>
          <td>';echo $rs1["price"];echo '</td>
        </tr>
		';
}
$db->free_result($result1);
;echo '		</tbody>
      </table></TD>
	  </TR>
	<TR>
	  <TD height="38" align="right" valign="middle" bgColor="#FBFDFF" >总价格:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["price"];echo ' </TD>
	</TR>
	<TR>
	  <TD height="38" align="right" valign="middle" bgColor="#FBFDFF" >折扣:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo ($rs["zhekou"]*10)."折";;echo ' </TD>
	</TR>
	<TR>
	  <TD height="38" align="right" valign="middle" bgColor="#FBFDFF" >实际支付:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["price"]*$rs["zhekou"];echo ' </TD>
	</TR>
	';
$sql="select * from {$db_prefix}logistics where orderid='$id'";
$u_res=$db->get_one($sql);
if(!empty($u_res)){
$sql="select * from {$db_prefix}logcom where id='".$u_res["companyid"]."'";
$trs=$db->get_one($sql);
;echo '	 <TR height=22 style="BACKGROUND-COLOR:#ffffff">
	<TD>发货时间:</TD>
	<TD level="0_3">';echo date("Y-m-d",$u_res["sendtime"]);;echo '	</TD>
	</tr>
	<TR height=22 style="BACKGROUND-COLOR:#ffffff">
	<TD>物流公司:</TD>
	<TD level="0_3">';echo $trs["company"];;echo '	</TD>
	</tr>
	<TR height=22 style="BACKGROUND-COLOR:#ffffff">
	<TD>物流单号:</TD>
	<TD level="0_3">';echo $u_res["log_no"];;echo '</TD>
	</tr>
	<TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
	<TD>备注:</TD>
	<TD>';echo $u_res["memo"];;echo '</TD>
	</TR>
	 <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >详细收货地址:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >
     ';echo $u_res["address"];;echo '	 </TD>
	  </TR>
     <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $u_res["receiver"];;echo '	  </TD>
	 </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人联系手机:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $u_res["mobile"];;echo '	 
	  </TD>
	  </TR>
   <!-- <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人联系座机:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $u_res["tel"];;echo '	
	  </TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $u_res["postcode"];;echo '	
	  </TD>
	</TR>-->
	';};echo '	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	  <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="导出信息" name="but" onClick="javascript:location.href=\'../excel/7.php?id=';echo $id;;echo '\'">
	  &nbsp; &nbsp; &nbsp;
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" name="but" onClick="history.back();">	  </TD>
	  </TR>
 
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
<?php

include("../include/conn_2.php");include("../include/function.php");
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
<TD width=213 height=23>&nbsp;<strong>订单查看</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="50%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >订购会员:</TD>
	  <TD width="50%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo ' </TD>
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
          <td width="18%">产品编号</td>
          <td width="29%">产品名</td>
          <td width="18%">数量</td>
          <td width="10%">单价</td>
		  <!--<td width="19%">pv</td>-->
        </tr>
		';
$sql1="select * from {$db_prefix}orders1 where orderid='".$id."'";
$result1=$db->query($sql1);
while ($rs1=$db->fetch_array($result1)){
;echo '        <tr>
          <td>';echo $rs1["productid"];echo '</td>
          <td>';echo $rs1["productname"];echo '</td>
          <td>';echo $rs1["num"];echo '</td>
          <td>';echo $rs1["price"];;echo '</td>
		 <!--<td>';
;echo '</td>-->
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
	<!--<TR>
	  <TD height="38" align="right" valign="middle" bgColor="#FBFDFF" >总pv:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["pv"];echo ' </TD>
	</TR>-->
	<TR>
	  <TD height="38" align="right" valign="middle" bgColor="#FBFDFF" >折扣:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo ($rs["zhekou"]*10)."折";;echo ' </TD>
	</TR>
	<TR>
	  <TD height="38" align="right" valign="middle" bgColor="#FBFDFF" >实际支付:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["price"]*$rs["zhekou"];echo ' </TD>
	</TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" name="but" onClick="history.back();">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
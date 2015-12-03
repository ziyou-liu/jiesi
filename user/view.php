<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn_2.php");include("../include/function.php");
session_start();
$modtime=time();
$sql1="select * from {$db_prefix}logistics where orderid='".$id."'";
$rs1=$db->get_one($sql1);
$sql="select * from {$db_prefix}logcom where id='".$rs1["companyid"]."'";
$rs=$db->get_one($sql);
;echo '<body>
<form name="form1" method="post" action="" >
<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;物流详情</TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR height=22 style="BACKGROUND-COLOR:#ffffff">
	<TD width="28%">发货时间:</TD>
	<TD width="72%" level="0_3">';echo date("Y-m-d H:i:s",$rs1["sendtime"]);;echo '	</TD>
	</tr>
	<TR height=22 style="BACKGROUND-COLOR:#ffffff">
	<TD>物流公司:</TD>
	<TD level="0_3">';echo $rs["company"];;echo '	</TD>
	</tr>
	<TR height=22 style="BACKGROUND-COLOR:#ffffff">
	<TD>物流单号:</TD>
	<TD level="0_3">';echo $rs1["log_no"];;echo '</TD>
	</tr>
	<TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
	<TD>备注:</TD>
	<TD>';echo $rs1["memo"];;echo '</TD>
	</TR>
	 <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >详细收货地址:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >
     ';echo $rs1["address"];;echo '	 </TD>
	  </TR>
     <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs1["receiver"];;echo '	  </TD>
	 </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人联系手机:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs1["mobile"];;echo '	 
	  </TD>
	  </TR>
  <!--  <TR>
	  <TD valign="middle" bgColor="#FBFDFF" >收货人联系座机:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs1["tel"];;echo '	
	  </TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs1["postcode"];;echo '	
	  </TD>
	</TR>-->
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif" >
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" name="but" onClick="javascript:location.href=\'orderlst.php?pageno=';echo $pageno;;echo '\'">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>
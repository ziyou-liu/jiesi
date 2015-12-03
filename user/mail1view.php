<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");
$sql="select * from {$db_prefix}mails1 where id='".$id."'";
$rs=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="">

<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>发件内容查看</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="41%" align="right" valign="middle" bgColor="#FBFDFF" >收件人:</TD>
	  <TD width="59%" height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["tousername"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收件人名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["torealname"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收件人类型:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo ($rs["totype"]==1)?"管理员":"会员";echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >标题:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["title"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >内容</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["content"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d",$rs["addtime"]);echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >状态:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo ($rs["state"]==1)?"成功":"失败"
;echo '</TD>
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
</body></html>';
?>
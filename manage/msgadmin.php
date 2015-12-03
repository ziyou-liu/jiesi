<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/clear.php");
include 'func.inc';
$outmsg = "";
$rmFee = "";
$ret = $smsObject->GetRemainFee($username,$password,&$rmFee);
;echo '</HEAD><body>
<form name="form1" method="post" action="">

<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>您的短信余额为</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR></TR>
	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >';echo $rmFee;;echo '</TD>
	  </TR>
	<TR>
	  <TD align="center" valign="middle" background="images/tab_19.gif">&nbsp;</TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
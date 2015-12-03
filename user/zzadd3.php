<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");include("../include/ecls.php");
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs22=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="moneyzz.php">
<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>Transfer of e-currency ---Complete!</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	 <TR>
	  <TD width="32%" align="center" vAlign=middle bgColor="#FBFDFF" >Congratulations！Sucessfully transfered！</TD>
	</TR>
	<TR>
	  <TD  rowspan="1" align="center" vAlign=middle bgColor="#FBFDFF" >Balance：';echo $rs22["price"];echo '</TD>
	</TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">&nbsp;&nbsp;&nbsp;
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="Ok" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>';
?>
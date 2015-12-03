<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");
if ($action=="changepass"){
$hint="";
if (trim($pwd1)=="") $hint.="请输入密码\\n";
if ($pwd2!=$pwd1) $hint.="两次密码不一致\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql="update {$db_prefix}admin set pwd='".mymd5($pwd1,"EN")."' where id='".$_SESSION["glo_adminid"]."'";
$db->query($sql);
echo "<script>alert('密码已修改');location.href='changepass.php';</script>";exit();
}
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=changepass">

<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>密码修改</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >管理员:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $_SESSION["glo_adminname"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd1" type="password" id="pwd1"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd2" type="password" id="pwd2"></TD>
	  </TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");
session_start();
if ($action=="secpwd"){
$hint="";
if($pwd1=='') $hint="请输入密码\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_1="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' and pwd1='".mymd5($pwd1,"EN")."'";
$rs_1=$db->get_one($sql_1);
if (empty($rs_1["id"])){
echo "<script>alert('二级密码确认失败');history.back();</script>";exit();
}
$_SESSION["glo_usersecpwd"]=$rs_1["pwd1"];
$fromurl1=str_replace('>','&',$fromurl1);
header("location:{$fromurl1}");exit();
}
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=secpwd">

<br>
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4 background="../user/images/tab_05.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>二级密码确认</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >二级密码:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="pwd1" type="password" id="pwd1"></TD>
	  </TR>
	<TR>
	  <TD  background="../manage/images/tab_19.gif" colspan="2" align="center" valign="middle">
		<input type=\'hidden\' name=\'fromurl1\' value="';echo $fromurl;;echo '"/>
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确认" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>
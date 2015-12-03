<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");
if ($action=="smssetting"){
$sql="update {$db_prefix}smssetting set sms_username='".trim($_POST["sms_username"])."',sms_password='".$_POST["sms_password"]."',sms_kqbt='".$_POST["sms_kqbt"]."'";
$db->query($sql);
echo "<script>alert('设定成功');location.href='smssetting.php';</script>";exit();
}
$sql="select * from {$db_prefix}smssetting where 1";
$rs=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=smssetting">
<TABLE width="500" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="96%" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD>&nbsp;<strong>短信设定</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >短信是否开启:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><label>
	    <input name="sms_kqbt" type="checkbox" id="sms_kqbt" value="1" ';if ($rs["sms_kqbt"]==1) echo "checked";echo '>
	    开启</label></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >短信会员编号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="sms_username" type="text" id="sms_username" value="';echo $rs["sms_username"];echo '"></TD>
	  </TR>
	<TR>
	  <TD width="36%" align="right" valign="middle" bgColor="#FBFDFF" >短信密码:</TD>
	  <TD width="64%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="sms_password" type="text" id="sms_password" value="';echo $rs["sms_password"];echo '"></TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
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
<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
$modtime=time();
if ($action=="add"){
$sql="select * from {$db_prefix}bankadmin where bank='$bank' ";
$rs=$db->get_one($sql);
if(!empty($rs)){
die("银行名已存在，请勿重复添加！");
}
$sql="insert into {$db_prefix}bankadmin (bank) values('$bank')";
$db->query($sql);
header("location:bankadmin.php");exit();
}
if ($action=="edit1"){
$sql="select * from {$db_prefix}bankadmin where bank='$bank' and id<>'$id' ";
$rs=$db->get_one($sql);
if(!empty($rs)){
die("银行名已存在，请勿重复添加！");
}
$sql="select bank from {$db_prefix}bankadmin where id='$id' ";
$srs=$db->get_one($sql);
if($srs["bank"]!=trim($bank)){
$sql="update {$db_prefix}users set bank='$bank' where bank='".$srs["bank"]."'";
$db->query($sql);
$sql2="update {$db_prefix}bankadmin set bank='$bank' where id='$id'";
$db->query($sql2);
}
header("location:bankadmin.php?pageno={$pageno}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}bankadmin where id='".$id."'";
$rs1=$db->get_one($sql1);
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
;echo '<script>
function frmchk(frm){
	if (frm.bank.value=="")
	{
		alert("请输入银行名称");
		frm.bank.focus();
		return false;
	}
}
</script>
<body>
<form name="form1" method="post" action="addbank.php?action=';echo $action_1;echo '" onSubmit="return frmchk(this);">
<input type="hidden" name="id" value="';echo $id;;echo '">
<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>银行';echo $actionstr;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >银行名称:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="bank" type="text" id="bank" size="40" value="';echo $rs1["bank"];echo '"></TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif" >
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="';echo $actionstr;echo '" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
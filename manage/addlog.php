<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
session_start();
$modtime=time();
if ($action=="add"){
$sql="insert into {$db_prefix}logcom (company,address,tel,contact,url,addtime) values('$company','$address','$tel','$contact','$url','$modtime')";
$db->query($sql);
header("location:logistics.php");exit();
}
if ($action=="edit1"){
$sql2="update {$db_prefix}logcom set company='$company',address='$address',tel='$tel',contact='$contact',url='$url' where id='".$id."'";
$db->query($sql2);
header("location:logistics.php?pageno={$pageno}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}logcom where id='".$id."'";
$rs1=$db->get_one($sql1);
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
;echo '<script>
function frmchk(frm){
	if (frm.company.value=="")
	{
		alert("请输入公司名称");
		frm.company.focus();
		return false;
	}
}
</script>
<body>
<form name="form1" method="post" action="addlog.php?action=';echo $action_1;echo '" onSubmit="return frmchk(this);">
<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>物流公司';echo $actionstr;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >公司名称:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="company" type="text" id="company" size="40" value="';echo $rs1["company"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >地址:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="address" type="text" id="address" value="';echo $rs1["address"];echo '" size="40"></TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><input type="hidden" name="id" value="';echo $id;echo '">
        <input type="hidden" name="pageno" value="';echo $pageno;echo '">
        联系人:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="contact" type="text" id="contact" value="';echo $rs1["contact"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >
        联系电话:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="tel" type="text" id="tel" value="';echo $rs1["tel"];echo '"></TD>
	  </TR>  
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >网址:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="url" type="text" id="url" value="';echo $rs1["url"];echo '" size="40"></TD>
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
</body></html>';
?>
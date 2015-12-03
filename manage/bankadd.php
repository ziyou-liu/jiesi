<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
session_start();
if ($action=="add"){
$sql="insert into {$db_prefix}bank(bank,zhanghao,huzhu,addtime) values('".trim($bank)."','".trim($zhanghao)."','".trim($huzhu)."','".time()."')";
$db->query($sql);
header("location:banks.php");exit();
}
if ($action=="edit1"){
$sql2="update {$db_prefix}bank set bank='".trim($bank)."',zhanghao='".$zhanghao."',huzhu='".trim($huzhu)."' where id='".$id."'";
$db->query($sql2);
header("location:banks.php?pageno={$pageno}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}bank where id='".$id."'";
$rs1=$db->get_one($sql1);
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
;echo '<body>
<form name="form1" method="post" action="?action=';echo $action_1;echo '">

<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>银行账号';echo $actionstr;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><input type="hidden" name="id" value="';echo $id;echo '">
        <input type="hidden" name="pageno" value="';echo $pageno;echo '">
        户主:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="huzhu" type="text" id="huzhu" value="';echo $rs1["huzhu"];echo '"></TD>
	  </TR>
      <TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >银行:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >
	  <input name="bank" type="text" id="bank" value="';echo $rs1["bank"];echo '">
	 </TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >账号:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="zhanghao" type="text" id="zhanghao" value="';echo $rs1["zhanghao"];echo '" size="35"></TD>
	  </TR>
	
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="';echo $actionstr;echo '" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>
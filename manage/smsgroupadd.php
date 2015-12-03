<?php

include("../include/conn.php");include("../include/function.php");
session_start();
if ($action=="add"){
$sql="insert into {$db_prefix}smsgroup(groupname,nums,addtime) values('".trim($groupname)."','0','".time()."')";
$db->query($sql);
header("location:smsgroup.php");exit();
}
if ($action=="edit1"){
$sql2="update {$db_prefix}smsgroup set groupname='".trim($groupname)."' where id='".$id."'";
$db->query($sql2);
$sql2="update {$db_prefix}smsgroupuser set groupname='".trim($groupname)."' where groupid='".$id."'";
$db->query($sql2);
header("location:smsgroup.php?pageno={$pageno}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}smsgroup where id='".$id."'";
$rs1=$db->get_one($sql1);
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
<body>
<form name="form1" method="post" action="?action=';echo $action_1;echo '">
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY><TR><TD bgColor=#d4d0c8 height=3></TD></TR></TBODY></TABLE>
<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"background="images/bg.gif"><TBODY><TR>
<TD >&nbsp;<strong>短信分组';echo $actionstr;echo '</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >分组名称:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="groupname" type="text" id="groupname" size="40" value="';echo $rs1["groupname"];echo '"></TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">	  
	    <input type="hidden" name="id" value="';echo $id;echo '">
        <input type="hidden" name="pageno" value="';echo $pageno;echo '">
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
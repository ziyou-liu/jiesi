<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
session_start();
if ($action=="add"){
$sql="insert into {$db_prefix}announce(title,content,addtime,adminid,admin) values('".trim($title)."','".addslashes($content)."','".time()."','".$_SESSION["glo_adminid"]."','".$_SESSION["glo_adminname"]."')";
$db->query($sql);
header("location:announces.php");exit();
}
if ($action=="edit1"){
$sql2="update {$db_prefix}announce set title='".trim($title)."',content='".addslashes($content)."',adminid='".$_SESSION["glo_adminid"]."',admin='".$_SESSION["glo_adminname"]."' where id='".$id."'";
$db->query($sql2);
header("location:announces.php?pageno={$pageno}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}announce where id='".$id."'";
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
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23 background="images/tab_05.gif">&nbsp;<strong>公告';echo $actionstr;echo '</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="15%" align="right" vAlign=middle bgColor="#FBFDFF" >标题:</TD>
	  <TD width="79%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="title" type="text" id="title" size="40" value="';echo $rs1["title"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><input type="hidden" name="id" value="';echo $id;echo '">
        <input type="hidden" name="pageno" value="';echo $pageno;echo '">
        内容:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><textarea name="content" cols="50" rows="10" id="content" style="display:None;">';echo stripslashes($rs1["content"]);echo '</textarea>
	  <IFRAME id=memo_Frame  src="../fckeditor/editor/fckeditor.html?InstanceName=content&Toolbar=Basic" frameBorder=0 width=90% scrolling=no height=350></IFRAME>
	  </TD>
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
<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
session_start();
$sql1="select * from {$db_prefix}jjplan where id=1";
$rs1=$db->get_one($sql1);
if ($action=="add"){
if($rs1['id']){
$sql2="update {$db_prefix}jjplan set content='".trim($content)."' where id=1";
$db->query($sql2);
}else{
$db->query("insert into {$db_prefix}jjplan(content) values('".trim($content)."')");
}
echo "<script>alert('修改成功');history.back();</script>";exit();
}
$actionstr="修改";
$action_1="add";
;echo '<body>
<form name="form1" method="post" action="?action=';echo $action_1;echo '">

<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23 background="images/tab_05.gif">&nbsp;<strong>奖金计划';echo $actionstr;echo '</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><input type="hidden" name="id" value="';echo $id;echo '">
        <input type="hidden" name="pageno" value="';echo $pageno;echo '">
        内容:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><textarea name="content" style="display:none;"  id="content">';echo $rs1["content"];echo '</textarea><IFRAME id=memo_Frame  src="/fckeditor/editor/fckeditor.html?InstanceName=content&Toolbar=Basic" frameBorder=0 width=100% scrolling=no height=450></IFRAME></TD>
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
</body></html>';
?>
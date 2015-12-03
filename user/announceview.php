<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn_2.php");include("../include/function.php");
$sql="select * from {$db_prefix}announce where id='".$id."'";
$rs=$db->get_one($sql);
;echo '<body>
<form name="form1" method="post" action="">

<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23 background="images/tab_05.gif">&nbsp;<strong>公告查看</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >标题:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["title"];echo '</TD>
	</TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >        内容:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo stripslashes($rs["content"]);echo '</TD>
	</TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif" >
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" name="but" onClick="history.back();">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
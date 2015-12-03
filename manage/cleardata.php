<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/clear.php");
if ($action=="cleardata"){
$sqlary=explode(";",$sql_cleartxt);
foreach($sqlary as $value){
if(!empty($value)){
$db->query($value);
}
}
$sql="update {$db_prefix}product set num=0";
$db->query($sql);
die("<center>初始化数据已经成功</center>");
}
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=cleardata">

<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>初始化数据</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR></TR>
	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >为了便于测试，执行此操作后部分数据将被清除</TD>
	  </TR>
	<TR>
	  <TD align="center" valign="middle" background="images/tab_19.gif">
	  <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="初始化数据" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
<?php

include("../include/conn.php");
if($action=='edit'){
$sql="update ".$db_prefix."productsort set name='".$name."' where id='".$id."'";
$db->query("update ".$db_prefix."productsort set name='".$name."' where id='".$id."'");
$db->query("update {$db_prefix}product set category='$name' where categoryid='$id' ");
header("location:category.php");exit();
}
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD><body>
<form name="form1" method="post" action="category4.php?action=edit">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>商品分类</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" ><input name="id" type="hidden" value="';echo $id;echo '" />父类:</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';
$sql="select * from ".$db_prefix."productsort where id='".$id."' ";
$rs2=$db->get_one($sql);
$path=$rs2['path'];
$pname=$rs2['name'];
$sql="select * from ".$db_prefix."productsort where find_in_set(id,'".$path."')";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
if (empty($class))
$class.=$rs['name'];
else
$class.="——".$rs['name'];
}
$db->free_result($result);
echo $class;
;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >名称:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="name" type="text"  value="';echo $pname;echo '"/></TD>
	</TR>
	
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="修改" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>
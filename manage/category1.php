<?php

include("../include/conn.php");
$time=time();
if($action=='add'){
if (empty($parent)){
$type=$isshops;
$topid=0;$path=0;$depth=0;$last=1;
$rs=$db->get_one("select count(id) as c from ".$db_prefix."productsort");
$orders=$rs['c']+1;
}else{
$rs=$db->get_one("select * from ".$db_prefix."productsort where id='".$parent."' limit 1");
$topid=$rs['topid'];
$path=$rs['path'].",".$parent;
$depth=$rs['depth']+1;
$last=1;
$type=$rs['type'];
$orders=$rs['orders'];
$rs1=$db->get_one("select max(orders) as c from ".$db_prefix."productsort where find_in_set('".$parent."',path)");
if (empty($rs1['c'])) $orders=$orders+1;
else $orders=$rs1['c']+1;
}
$db->query("update ".$db_prefix."productsort set orders=orders+1 where orders>='".$orders."'");
$db->query("update ".$db_prefix."productsort set last=0 where parentid='".$parent."'");
$db->query("insert into ".$db_prefix."productsort(topid,parentid,name,path,orders,depth,last,time,type) values('".$topid."','".$parent."','".trim($name)."','".$path."','".$orders."','".$depth."','".$last."','".$time."','".$type."')");
if ($topid==0){
$theid=$db->insert_id();
$db->query("update ".$db_prefix."productsort set topid='".$theid."' where id='".$theid."'");
}
header("location:category.php");exit();
}
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD><body>
<form name="form1" method="post" action="category1.php?action=add">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>产品分类添加</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="42%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" ><input name="parent" type="hidden" value="';echo $parent;echo '" />父类:</TD>
	  <TD width="58%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';
if ($parent==""||empty($parent) ||!isset($parent)){
$class="添加一级分类";
}else{
$rs=$db->get_one("select * from ".$db_prefix."productsort where id='".$parent."' limit 1");
$path=$rs['path'];
$pname=$rs['name'];
$sql="select * from ".$db_prefix."productsort where find_in_set(id,'".$path."')";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
if (empty($class))
$class.=$rs['name'];
else
$class.="——".$rs['name'];
}
$class.="——".$pname;
$db->free_result($result);
}
echo $class;
;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >名称:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="name" type="text" /></TD>
	</TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="添加" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>
<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
$modtime=time();
if ($action=="add"){
$sql="select * from {$db_prefix}province where provinceID='$provinceid' or province='$province'";
$res=$db->get_one($sql);
if(!empty($res)){$hint="省份编号或省份名称已存在，请勿重复添加!";}
$temp=substr($provinceid,-1,4);
if($temp!="0000"){$hine="省份编号末四位必须为零！";}
if(!empty($hint)){
;echo '	<script>alert(\'';echo $hint;;echo '\');location.href=\'addprovince.php\';</script>
	';
}
$sql="insert into {$db_prefix}province (province,provinceID) values('$province','$provinceid')";
$db->query($sql);
header("location:areaadmin.php?pageno={$pageno}");exit();
}
if ($action=="edit1"){
$sql2="update {$db_prefix}province set province='$province' where id='".$id."'";
$db->query($sql2);
header("location:areaadmin.php?pageno={$pageno}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}province where id='".$id."'";
$rs1=$db->get_one($sql1);
}else{
$sql21="select provinceID from {$db_prefix}province order by provinceID desc ";
$rs21=$db->get_one($sql21);
if(!empty($rs21)){
$proid=$rs21["provinceID"]+10000;
}else{
$proid=110000;
}
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
;echo '<script>
function frmchk(frm){
	if (frm.company.value=="")
	{
		alert("请输入省份名称");
		frm.company.focus();
		return false;
	}
}
</script>
<body>
<form name="form1" method="post" action="addprovince.php?action=';echo $action_1;echo '" onSubmit="return frmchk(this);">
<input type="hidden" name="id" value="';echo $id;;echo '">
<input type="hidden" name="pageno" value="';echo $pageno;;echo '">
<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>省份';echo $actionstr;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
     <TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >省份编号:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >
	  ';if(empty($rs1["provinceID"])){;echo '	  <input name="provinceid" type="text" id="provinceid" size="6" value="';echo $proid;echo '">
	  ';}else{;echo '	  <input name="provinceid" type="text" id="provinceid" size="6" value="';echo $rs1["provinceID"];echo '" readonly="true">
	  ';};echo ' <span class="style1">*</span> (省份编号后四位必须为零，且编号唯一)
	  </TD>
	</TR>  
	<TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >省份名称:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="province" type="text" id="province" size="40" value="';echo $rs1["province"];echo '"></TD>
	  </TR>  
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif" >
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" name="but" onClick="javascript:location.href=\'areaadmin.php\'">	
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
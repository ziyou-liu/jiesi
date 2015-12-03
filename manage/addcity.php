<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
$modtime=time();
if ($action=="add"){
$sql="select * from {$db_prefix}city where cityID='$cityid' or city='$city'";
$res=$db->get_one($sql);
if(!empty($res)){$hint="市编号已存在，请勿重复添加!";}
$temp=substr($cityid,-1,2);
if($temp!="00"){$hine="市编号末四位必须为零！";}
if(!empty($hint)){
;echo '	<script>alert(\'';echo $hint;;echo '\');location.href=\'cityadmin.php?pageno=';echo $pageno;;echo '&provinceid=';echo $provinceid;;echo '\';</script>
	';
}
$sql="insert into {$db_prefix}city (city,father,cityID) values('$city','$provinceid','$cityid')";
$db->query($sql);
header("location:cityadmin.php?pageno={$pageno}&provinceid={$provinceid}");exit();
}
if ($action=="edit1"){
$sql2="update {$db_prefix}city set city='$city' where id='".$id."'";
$db->query($sql2);
header("location:cityadmin.php?pageno={$pageno}&provinceid={$provinceid}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}city where id='".$id."'";
$rs1=$db->get_one($sql1);
}else{
$sql21="select cityID from {$db_prefix}city where father='$provinceid' order by cityID desc ";
$rs21=$db->get_one($sql21);
if(!empty($rs21)){
$proid=$rs21["cityID"]+100;
}else{
$proid=$provinceid+100;
}
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
$psql="select * from {$db_prefix}province where provinceID='$provinceid' ";
$pres=$db->get_one($psql);
;echo '<script>
function frmchk(frm){
	if (frm.city.value=="")
	{
		alert("请输入市");
		frm.city.focus();
		return false;
	}
}
</script>
<body>
<form name="form1" method="post" action="addcity.php?action=';echo $action_1;echo '" onSubmit="return frmchk(this);">
<input type="hidden" name="id" value="';echo $id;;echo '">
<input type="hidden" name="provinceid" value="';echo $provinceid;;echo '">
<input type="hidden" name="pageno" value="';echo $pageno;;echo '">
<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>市';echo $actionstr;echo '</strong>&gt;&gt;<a href="cityadmin.php?pageno=';echo $pageno;;echo '&provinceid=';echo $provinceid;;echo '">返回';echo $pres["province"];;echo '的市列表</a> </TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
     <TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >市编号:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >
	  ';if(empty($rs1["cityID"])){;echo '	  <input name="cityid" type="text" id="cityid" size="6" value="';echo $proid;;echo '" readonly="true">
	  ';}else{;echo '	  <input name="cityid" type="text" id="cityid" size="6" value="';echo $rs1["cityID"];echo '" readonly="true">
	  ';};echo '</TD>
	</TR>  
	<TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >市名:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="city" type="text" id="city" size="40" value="';echo $rs1["city"];echo '"></TD>
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
</body></html>'
?>
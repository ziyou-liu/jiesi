<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
$modtime=time();
if ($action=="add"){
$sql="select * from {$db_prefix}area where areaID='$areaid' or area='$area'";
$res=$db->get_one($sql);
if(!empty($res)){$hint="县区编号或县区名已存在，请勿重复添加!";}
if(!empty($hint)){
;echo '	<script>alert(\'';echo $hint;;echo '\');location.href=\'stateadmin.php?pageno=';echo $pageno;;echo '&provinceid=';echo $provinceid;;echo '&cityid=';echo $cityid;;echo '\';</script>
	';
}
$sql="insert into {$db_prefix}area (area,father,areaID) values('$area','$cityid','$areaid')";
$db->query($sql);
header("location:stateadmin.php?pageno={$pageno}&provinceid={$provinceid}&cityid={$cityid}");exit();
}
if ($action=="edit1"){
$sql2="update {$db_prefix}area set area='$area' where id='".$id."'";
$db->query($sql2);
header("location:stateadmin.php?pageno={$pageno}&provinceid={$provinceid}&cityid={$cityid}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}area where id='".$id."'";
$rs1=$db->get_one($sql1);
}else{
$sql21="select areaID from {$db_prefix}area where father='$cityid' order by areaID desc ";
$rs21=$db->get_one($sql21);
if(!empty($rs21)){
$proid=$rs21["areaID"]+1;
}else{
$proid=$cityid+1;
}
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
$psql="select * from {$db_prefix}province where provinceID='$provinceid' ";
$pres=$db->get_one($psql);
$rsql="select * from {$db_prefix}city where cityID='$cityid' ";
$rres=$db->get_one($rsql);
;echo '<script>
function frmchk(frm){
	if (frm.area.value=="")
	{
		alert("请输入县区名");
		frm.area.focus();
		return false;
	}
}
</script>
<body>
<form name="form1" method="post" action="addarea.php?action=';echo $action_1;echo '" onSubmit="return frmchk(this);">
<input type="hidden" name="id" value="';echo $id;;echo '">
<input type="hidden" name="provinceid" value="';echo $provinceid;;echo '">
<input type="hidden" name="pageno" value="';echo $pageno;;echo '">
<input type="hidden" name="cityid" value="';echo $cityid;;echo '">
<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>县区';echo $actionstr;echo '</strong>&gt;&gt;返回<a href="cityadmin.php?provinceid=';echo $provinceid;;echo '">';echo $pres["province"];;echo '</a>-<a href="stateadmin.php?pageno=';echo $pageno;;echo '&provinceid=';echo $provinceid;;echo '&cityid=';echo $cityid;;echo '">';echo $rres["city"];;echo '</a>的县区列表</a> </TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
     <TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >县区编号:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >
	  ';if(empty($rs1["areaID"])){;echo '	  <input name="areaid" type="text" id="areaid" size="6" value="';echo $proid;;echo '" readonly="true">
	  ';}else{;echo '	  <input name="areaid" type="text" id="areaid" size="6" value="';echo $rs1["areaID"];echo '" readonly="true">
	  ';};echo '</TD>
	</TR>  
	<TR>
	  <TD width="31%" align="right" vAlign=middle bgColor="#FBFDFF" >县区名:</TD>
	  <TD width="69%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="area" type="text" id="area" size="40" value="';echo $rs1["area"];echo '"></TD>
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
<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
if ($action=="add"){
$hint="";
if(trim($username)=='') $hint.="请输入管理员帐号\\n";
if(trim($pwd1)=='') $hint.="密码不能为空\\n";
if($pwd1!=$pwd2) $hint.="两次密码不一致\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk="select * from {$db_prefix}admin where username='".trim($username)."'";
$rs_chk=$db->get_one($sql_chk);
if (!empty($rs_chk["id"])) die("同名的管理员已经存在");
$sql_d="select * from {$db_prefix}department where id='".$_POST['departmentid']."'";
$rs_d=$db->get_one($sql_d);
$department=$rs_d["department"];
$sql="insert into {$db_prefix}admin(username,realname,pwd,departmentid,department,mobile,addtime) values('".trim($username)."','".trim($realname)."','".mymd5($pwd1,"EN")."','".$_POST['departmentid']."','".$department."','".trim($mobile)."','".time()."')";
$db->query($sql);
header("location:managers.php");exit();
}
if ($action=="edit1"){
$hint="";
if(trim($username)=='') $hint.="请输入管理员帐号\\n";
if(trim($pwd1)=='') $hint.="密码不能为空\\n";
if($pwd1!=$pwd2) $hint.="两次密码不一致\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk="select * from {$db_prefix}admin where username='".trim($username)."' and id<>'".$id."'";
$rs_chk=$db->get_one($sql_chk);
if (!empty($rs_chk["id"])) die("同名的管理员已经存在");
$sql_d="select * from {$db_prefix}department where id='".$_POST['departmentid']."'";
$rs_d=$db->get_one($sql_d);
$department=$rs_d["department"];
$sql2="update {$db_prefix}admin set username='".trim($username)."',realname='".trim($realname)."',pwd='".mymd5($pwd1,"EN")."',departmentid='".$_POST['departmentid']."',department='".$department."',mobile='".trim($mobile)."' where id='".$id."'";
$db->query($sql2);
header("location:managers.php?pageno={$pageno}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}admin where id='".$id."'";
$rs1=$db->get_one($sql1);
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
;echo '<body>
<form name="form1" method="post" action="?action=';echo $action_1;echo '">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>管理员';echo $actionstr;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >管理员帐号:</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="username" type="text" id="username" value="';echo $rs1["username"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd1" type="password" id="pwd1" value="';echo mymd5($rs1["pwd"],"DE");echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd2" type="password" id="pwd2" value="';echo mymd5($rs1["pwd"],"DE");echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="realname" type="text" id="realname" value="';echo $rs1["realname"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >所属部门:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="departmentid" id="departmentid">
	  ';
$sql_dpt="select * from {$db_prefix}department where 1";
$result_dpt=$db->query($sql_dpt);
while ($rs_dpt=$db->fetch_array($result_dpt)){
echo "<option value='".$rs_dpt["id"]."'";
if($rs_dpt["id"]==$rs1["departmentid"]) echo " selected";
echo ">".$rs_dpt["department"]."</option>";
}
$db->free_result($result_dpt);
;echo '	    </select></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >手机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="mobile" type="text" id="mobile" value="';echo $rs1["mobile"];echo '">
	    <input type="hidden" name="id" value="';echo $id;echo '">
	    <input type="hidden" name="pageno" value="';echo $pageno;echo '"></TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="';echo $actionstr;echo '" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>';
?>
<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");
if (empty($usernamequery)){
$sql="select * from {$db_prefix}users where ifnull(prename,'')='' and ifnull(tjrname,'')=''";
$rs=$db->get_one($sql);
$usernamequery=$rs["username"];
}
$sql="select * from {$db_prefix}users where username='".$usernamequery."'";
$rs=$db->get_one($sql);
if (empty($rs["id"])) die("查询用户不存在");
;echo '</HEAD><body>
<form name="form1" method="post" action="">

<br>
<TABLE width="800" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="800" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>推荐网络</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR align="center">
	  <TD height="20"  rowspan="1" vAlign=middle bgColor="#d4e8fa" >会员编号</TD>
	  <TD  rowspan="1" vAlign=middle bgColor="#d4e8fa" >姓名</TD>
	  <TD  rowspan="1" vAlign=middle bgColor="#d4e8fa" >性别</TD>
	  <TD  rowspan="1" vAlign=middle bgColor="#d4e8fa" >级别</TD>
	  <TD  rowspan="1" vAlign=middle bgColor="#d4e8fa" >是否店铺</TD>
	  <TD  rowspan="1" vAlign=middle bgColor="#d4e8fa" >地址</TD>
	  </TR>
	';
$sql="select * from {$db_prefix}users where tjrname='".$usernamequery."'";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while ($rs=$db->fetch_array($result)){
;echo '	<TR>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ><a href="?usernamequery=';echo $rs["username"];echo '">';echo $rs["username"];echo '</a></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';echo $rs["realname"];echo '</TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';echo $rs["sex"];echo '</TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';echo getuserrank($rs["rank"]);echo '</TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';echo ($rs["isdp"]==1)?"是":"否";;echo '</TD>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" >';echo $rs["address"];echo '</TD>
	  </TR>
	';
}
}else{
;echo '	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >&nbsp;</TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >&nbsp;</TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >&nbsp;</TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >&nbsp;</TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >&nbsp;</TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >&nbsp;</TD>
	  </TR>
	';
}
$db->free_result($result);
;echo '    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>
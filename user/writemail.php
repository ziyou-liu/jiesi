<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");
if ($action=="send"){
$hint="";
if (trim($username)=="") $hint.="请输入收件人\\n";
if (trim($title)=="") $hint.="请输入标题\\n";
if (trim($content)=="") $hint.="请输入内容\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
if ($totype==0){
$sql="select * from {$db_prefix}users where username='".trim($username)."'";
}else{
$sql="select * from {$db_prefix}admin where username='".trim($username)."'";
}
$rs=$db->get_one($sql);
if (empty($rs["id"])) die("没有找到收件人");
$sql1="insert into {$db_prefix}mails(username,realname,title,content,fromusername,fromrealname,fromtype,addtime,state) values('".$rs["username"]."','".$rs["realname"]."','".trim($title)."','".$content."','".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."',0,'".time()."','1')";
$db->query($sql1);
$sql2="insert into {$db_prefix}mails1(username,realname,title,content,tousername,torealname,totype,addtime,state) values('".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','".trim($title)."','".$content."','".$rs["username"]."','".$rs["realname"]."','".$totype."','".time()."','1')";
$db->query($sql2);
echo "<script>alert('邮件已经发送!');location.href='sendmail.php';</script>";exit();
}
if ($action=="reply"){
if (empty($id)) die("缺少参数");
$sql_r="select * from {$db_prefix}mails where id='".$id."'";
$rs_r=$db->get_one($sql_r);
$mailfromusername=$rs_r["fromusername"];
$mailfromtype=$rs_r["fromtype"];
}
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=send">

<br>
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>写邮件</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="23%" align="right" valign="middle" bgColor="#FBFDFF" >收件人:</TD>
	  <TD width="77%" height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <input type="hidden" name="totype" value="1">
	  <select name="username">
        ';
$sql1="select * from {$db_prefix}admin where 1 ";
$result1=$db->query($sql1);
while ($rs1=$db->fetch_array($result1)){
;echo '        <option value="';echo $rs1["username"];echo '" ';if($mailfromusername==$rs1["username"]) echo "selected";;echo ' >';echo "&nbsp;".$rs1["username"];echo '</option>
        ';
}
$db->free_result($result1);
;echo '      </select></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >标题:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="title" type="text" id="title" size="50"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >内容:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><textarea name="content" cols="60" rows="10" id="content"></textarea></TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="发送" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
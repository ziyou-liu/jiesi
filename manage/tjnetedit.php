<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");include("../include/logcls.php");
include("../0123456789/1_s.php");
if($action=="netedit"){
$modtime=time();$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
$hint="";
if (trim($username)=="") $hint.="请输入会员编号\\n";
if (trim($tousername)=="") $hint.="请输入新上级推荐会员\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql1="select * from {$db_prefix}users where username='".trim($username)."'";
$rs1=$db->get_one($sql1);
if (empty($rs1["id"])) die("您输入的会员编号不存在");
$sql2="select * from {$db_prefix}users where username='".trim($tousername)."' and state=1";
$rs2=$db->get_one($sql2);
if (empty($rs2["id"])) die("您输入的推荐会员不存在");
$sql14="select * from {$db_prefix}users where tjrname='".trim($username)."'";
$rs4=$db->get_one($sql14);
$sql22="select * from {$db_prefix}jsrec where username='$username' and periods in (select periods from {$db_prefix}periods where state>=1)";
$rss22=$db->get_one($sql22);
if(!empty($rss22)){
}
$tjnetupstr="";
gettjnetupstr($rs2['username']);
if($tjnetupstr!=''){
$tjnetary=explode(",",$tjnetupstr);
if(in_array($rs1['username'],$tjnetary)){
echo "<script>alert('不能移动到自己的推荐网体下');history.back();</script>";exit();
}
}
$oldtjrname=$rs1["tjrname"];
$tjbdpv=$rs1["pv_team_regp"];
if($tjbdpv>0){
$tjnetupstr="";
gettjnetupstr(trim($oldtjrname));
$tjnetary=explode(",",$tjnetupstr);
if($tjnetupstr!=""){
foreach($tjnetary as $u=>$u1){
updatetjnetusertdpv2($u1,-$tjbdpv);
updatetjnettdpv($year,$month,$day,$u1,-$tjbdpv);
}
}
$tjnetupstr="";
gettjnetupstr(trim($tousername));
$tjnetary=explode(",",$tjnetupstr);
if($tjnetupstr!=""){
foreach($tjnetary as $u=>$u1){
updatetjnetusertdpv2($u1,$tjbdpv);
updatetjnettdpv($year,$month,$day,$u1,$tjbdpv);
}
}
}
$sql3="update {$db_prefix}users set tjrname='".trim($tousername)."' where username='".trim($username)."'";
$db->query($sql3);
$db->query("update {$db_prefix}users set tjnum=tjnum+1 where username='".trim($tousername)."'");
$db->query("update {$db_prefix}users set tjnum=tjnum-1 where username='".trim($oldtjrname)."'");
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=4;$log_addtime=time();$log_ip=getip();$log_memo="移动{$username}推荐网体到{$tousername}，原推荐人{$oldtjrname}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
echo "<script>alert('推荐网体修改成功');location.href='tjnetedit.php';</script>";exit();
}
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=netedit">

<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>推荐网体修改</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="43%" align="right" valign="middle" bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="57%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="username" type="text" id="username"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >新上级推荐会员编号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="tousername" type="text" id="tousername"></TD>
	  </TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>
<?php
echo '<HTML><HEAD><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title></title>
<link rel="stylesheet" href="/images/datalist.css" type="text/css">

<style type="text/css">
<!--
.memo{
	color:red;
}
-->
</style>
';
include("../include/conn_2.php");include("../include/function.php");
include("../include/secpwd.php");
include("../include/rank.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");
include("../include/logcls.php");
include("../include/net.php");include("../include/area.php");
$modtime=time();
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' ";
$rs=$db->get_one($sql);
if($rs['rank']!=3) die("操作有误");
if($rs['gudong']) {echo "<script>alert('您已经是股东了');location.href='welcome.php';</script>";exit();}
if ($action=="apply"){
$hint="";
$now=time();
$sql_s="select id from {$db_prefix}gudong where username='".$_SESSION["glo_username"]."' and state=0";
$rs_s=$db->get_one($sql_s);
if($rs_s['id']){
echo "<script>alert(\"您提交的申请暂未审核，请不要重复提交\");history.back();</script>";exit();
}
$sql="insert into {$db_prefix}gudong (username,realname,applytime,state) values ('".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','$now','0')";
$db->query($sql);
echo "<script>alert(\"您的申请已提交，请等待管理员审核\");</script>";
}
;echo '</HEAD><body bgcolor="#FFFFFF">
<form name="form1" method="post" action="applygudong.php">
<input type="hidden" name="action" value="apply">
<TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="650" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23>&nbsp;<strong>股东申请</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="50%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >申请会员:</TD>
	  <TD width="50%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $_SESSION["glo_username"];echo '</TD>
	</TR> 
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="申请" name="but">	  </TD>
	  </TR>
    </table>
	</TD>
  </TR>
</TABLE>
</form>
</body></html>';
?>
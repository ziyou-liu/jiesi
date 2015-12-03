<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<style type="text/css">
<!--
.memo{
	color:red;
}
-->
</style>
';
include("../include/conn.php");include("../include/pos.php");include("../include/function.php");
include("../0123456789/1_s.php");include("../include/ecls.php");include("../include/rank.php");
include("../include/setting.php");
include("../include/logcls.php");
include("../include/net.php");
if(!empty($edit)){
$modtime=time();
$sql="select * from {$db_prefix}users where id='$id' ";
$rr=$db->get_one($sql);
$tjrname=$rr["tjrname"];
$prename=$rr["prename"];
if($glo_sjkoumoney==1 ||$glo_sjleijipv==1){
if($newrank<=$oldrank){
echo "<script>alert('升级操作有误！');history.back();</script>";exit();
}
}elseif($newrank==$oldrank){
echo "<script>alert('升级操作有误！');history.back();</script>";exit();
}
$glo_rname="glo_member_".$newrank;
$bdmoney=$$glo_rname;
$glo_rname="glo_num_".$newrank;
$bdnum=$$glo_rname;
$glo_rname_o="glo_member_".$oldrank;
$o_bdmoney=$$glo_rname_o;
$glo_rname_o="glo_num_".$oldrank;
$o_bdnum=$$glo_rname_o;
$span_num=$bdnum-$o_bdnum;
$span_bdmoney=$bdmoney-$o_bdmoney;
if($glo_sjkoumoney==1){
if($rr["price"]>=$span_bdmoney){
$sql="update {$db_prefix}users set price=price-'$span_bdmoney' where username='".$rr["username"]."'";
$db->query($sql);
$memo=16;$type=2;$optime=$modtime;$memo1='后台修改';
eclsproc($rr["username"],$memo,$span_bdmoney,$type,$optime,$memo1);
}else{
$hint="该会员没有足够的电子货币！请先补足电子货币后再升级.";
echo "<script>alert('".$hint."');history.back();</script>";
exit();
}
}
if ($glo_sjleijipv==1){
$sql="update {$db_prefix}users set bdmoney=bdmoney+'$span_bdmoney',bdnum=bdnum+'$span_num',bdnum_team=bdnum_team+'$span_num',pv_reg=pv_reg+'$span_bdmoney',pv_team_reg=pv_team_reg+'$span_bdmoney',pv_team_regp=pv_team_regp+'$span_bdmoney' where username='".$rr["username"]."'";
$db->query($sql);
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
editpv($year,$month,$day,trim($rr["username"]),$span_bdmoney,$span_num);
if(trim($prename)){
$glnetupstr="";
getglnetupstr(trim($prename));
$glnetary=explode(",",$glnetupstr);
foreach($glnetary as $u=>$u1){
updateglnetusertdpv2($u1,$span_bdmoney,$span_num);
updateglnettdpv($year,$month,$day,$u1,$span_bdmoney,$span_num);
}
}
if(trim($tjrname)){
$tjnetupstr="";
gettjnetupstr(trim($tjrname));
$tjnetary=explode(",",$tjnetupstr);
foreach($tjnetary as $u=>$u1){
updatetjnetusertdpv2($u1,$span_bdmoney);
updatetjnettdpv($year,$month,$day,$u1,$span_bdmoney);
}
}
$db->query("update {$db_prefix}users set tjbdnum=tjbdnum+'$span_num' where username='".trim($tjrname)."' limit 1");
}
if($glo_sjkoumoney ||$glo_sjleijipv){
$ysmemo="后台修改".$rr['username']."级别";
}
$db->query("update {$db_prefix}users set rank='$newrank' where username='".$rr['username']."'");
$sql="insert into {$db_prefix}editrankrecord (username,oldrank,rank,edittime,operator,type,applytime,isapproved,sjkoumoney,sjleijipv,state) values ('".$rr["username"]."','$oldrank','$newrank','$modtime','".$_SESSION["glo_adminname"]."','1','$modtime','1','$glo_sjkoumoney','$glo_sjleijipv',1)";
$db->query($sql);
$username=$rr["username"];
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=13;$log_addtime=time();$log_ip=getip();$log_memo="{$log_admin}修改{$username}级别";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:editrecord.php?pageno={$pageno}");exit();
}
$sql="select * from {$db_prefix}users where id='$id' ";
$rs=$db->get_one($sql);
;echo '<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>
<form name="form1" method="post" action="editrank.php">
<input type="hidden" name="id" value="';echo $id;;echo '">
<input type="hidden" name="oldrank" value="';echo $rs["rank"];;echo '">
<TABLE width="521" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="521" colSpan=4  background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>会员级别修改</strong></TD>
<TD>&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="49%" align="right" valign="middle" bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="51%" height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["username"];;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["realname"];;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >当前级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rankary[$rs["rank"]];;echo '</TD>
	  </TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >选择级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <select name="newrank" id="newrank">
		';
foreach($rankary as $key_1=>$value_1){
echo "<option value='{$key_1}' >{$value_1}</option>";
}
;echo '	    </select>  	    </TD>
	  </TR>
 	<TR>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" class="memo" colspan="2">说明:';if($glo_sjkoumoney) echo "1.升级补差扣电子货币,";else echo "1.免费升级,";if($glo_sjleijipv) echo "升级补差累计业绩";else echo "升级不累计业绩";;echo '<br>2.如需修改升级方式，请到《系统管理》--《奖金参数设定》--最下方的《其他》进行设定</TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle"  background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="edit"  /> </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
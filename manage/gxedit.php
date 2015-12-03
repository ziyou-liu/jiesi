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
function updatexh($username,$temp){
global $db,$db_prefix;
$sqlx="select xh from {$db_prefix}users where username='$username'";
$rsx=$db->get_one($sqlx);
$xh=$rsx['xh']+1;
$sql="select id,username from {$db_prefix}users where ".$temp."='$username'";
$rs=$db->get_one($sql);
if(!empty($rs['id'])){
$db->query("update {$db_prefix}users set xh='".$xh."' where id='".$rs['id']."'");
updatexh($rs['username'],$temp);
}
}
if(!empty($edit)){
$modtime=time();
$hint='';
$sql="select tjnet,username from {$db_prefix}users where id='$id'";
$rs=$db->get_one($sql);
if($newrank=='') $hint.="请选择新网\\n";
elseif($rs['tjnet']==$newrank)$hint="不能再同一个网内调整\\n";
if($hint!=''){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$temp="timepre".$newrank;
if(trim($upusername)!=''){
$sqlu="select id,tjnet,xh from {$db_prefix}users where username='".trim($upusername)."'";
$rsu=$db->get_one($sqlu);
if(empty($rsu['id']))$hint='输入的上级会员不存在\\n';
elseif($rsu['tjnet']!=$newrank)$hint="输入的上级会员不在".$tcnameary[$newrank]."网内";
if($hint!=''){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sqlxj="select id from {$db_prefix}users where ".$temp."='".trim($upusername)."' and tjnet='$newrank'";
$rsxj=$db->get_one($sqlxj);
if(!empty($rsxj['id'])){
$db->query("update {$db_prefix}users set ".$temp."='".$rs['username']."' where id='".$rsxj['id']."'");
}
$db->query("update {$db_prefix}users set ".$temp."='".trim($upusername)."',tjnet='$newrank',confirmtime".$newrank."='$modtime' where id='$id'");
updatexh(trim($upusername),$temp);
}else{
$xh=0;$timepre='';
$sqld="select id,xh,username from {$db_prefix}users where tjnet='$newrank' order by xh desc limit 1";
$rsd=$db->get_one($sqld);
if(!empty($rsd['id'])) {
$xh=$rsd['xh']+1;$timepre=$rsd['username'];
}
$db->query("update {$db_prefix}users set ".$temp."='".$timepre."',tjnet='$newrank',xh='$xh',confirmtime".$newrank."='$modtime' where id='$id'");
}
$sql_in="insert into {$db_prefix}tjpan (username,tjnet,newtjnet,addtime,memo,admin) values('".$rs['username']."','".$rs['tjnet']."','$newrank','".time()."','".trim($upusername)."','".$_SESSION["glo_adminname"]."')";
$db->query($sql_in);
$username=$rs["username"];
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=12;$log_addtime=time();$log_ip=getip();$log_memo="{$log_admin}修改{$username}共享排网";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:gxnetrec.php");exit();
}
$sql="select * from {$db_prefix}users where id='$id' ";
$rs=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="gxedit.php">
<input type="hidden" name="id" value="';echo $id;;echo '">
<input type="hidden" name="oldrank" value="';echo $rs["tjnet"];;echo '">
<TABLE width="521" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="521" colSpan=4  background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>会员共享排网修改</strong></TD>
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
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >当前排网:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $tcnameary[$rs["tjnet"]];;echo '</TD>
	  </TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >新排网:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  ';if($rs['tjnet']<7){;echo '	  <select name="newrank" id="newrank">
		';
foreach($tcnameary as $key_1=>$value_1){
if($key_1>$rs['tjnet']){
echo "<option value='{$key_1}' >{$value_1}</option>";
}
}
;echo '	    </select>  
		';}else{;echo '		您已进入最高排网
		';};echo '		</TD>
	  </TR>
	 <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >上级会员:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input type="text" name="upusername" value=\'\' /><span class="hint">选填</span></TD>
	  </TR>
 	<TR>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" class="memo" colspan="2">说明:1.填写上级会员，执行中间插入操作<br>2.不填写，默认插入到新网的最后<br>3.只允许朝更高网调整,请谨慎操作</TD>
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
</body></html>';
?>
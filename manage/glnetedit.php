<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/pos.php");include("../include/function.php");include("../include/logcls.php");
include("../0123456789/1_s.php");
$modtime=time();$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
if ($action=="netedit"){
$hint="";
if (trim($username)=="") $hint.="请输入会员编号\\n";
if (trim($tousername)=="") $hint.="请输入新接点人编号\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql1="select * from {$db_prefix}users where username='".trim($username)."'";
$rs1=$db->get_one($sql1);
if (empty($rs1["id"])) die("<center>您输入的会员编号不存在</center>");
$sql2="select * from {$db_prefix}users where username='".trim($tousername)."' and state=1";
$rs2=$db->get_one($sql2);
if (empty($rs2["id"])) die("<center>您输入的接点人不存在</center>");
$sql3="select * from {$db_prefix}users where prename='".trim($tousername)."' and pos='$pos'";
$rs3=$db->get_one($sql3);
if (!empty($rs3["id"])) die("<center>接点人的".$posary[$pos]."区已被占用</center>");
$sql14="select * from {$db_prefix}users where prename='".trim($username)."'";
$rs4=$db->get_one($sql14);
$yjbool=false;
$sql22="select * from {$db_prefix}jsrec where username='$username' and periods in (select periods from {$db_prefix}periods where state>=1)";
$rss22=$db->get_one($sql22);
if(!empty($rss22)){
$yjbool=true;
}
$hystate=$rs1["state"];
$oldprename=$rs1["prename"];
$glnetupstr="";
getglnetupstr($rs2['username']);
if($glnetupstr!=''){
$glnetary=explode(",",$glnetupstr);
if(in_array($rs1['username'],$glnetary)){
echo "<script>alert('不能移动到自己的安置网体下');history.back();</script>";exit();
}
}
$glnetupstr="";
getglnetupstr(trim($oldprename));
$oldglnetary=explode(",",$glnetupstr);
if($rs1['confirmtime']<$rs2['confirmtime']){
$regyear1=date('Y',$rs1['confirmtime']);
$regmonth1=date('n',$rs1['confirmtime']);
$regday1=date('j',$rs1['confirmtime']);
$regyear2=date('Y',$rs2['confirmtime']);
$regmonth2=date('n',$rs2['confirmtime']);
$regday2=date('j',$rs2['confirmtime']);
if(!($regyear1==$regyear2 &&$regmonth1==$regmonth2 &&$regday1==$regday2)){
}
}
if(!$yjbool){
$sqlyj="select pv1,num_2,year,month,day from {$db_prefix}tdpv where username='".trim($username)."'";
$result=$db->query($sqlyj);
if($db->num_rows($result)>0){
while($rsyj=$db->fetch_array($result)){
$year=$rsyj['year'];$month=$rsyj['month'];$day=$rsyj['day'];
$bdpv=$rsyj['pv1'];$bdnum=$rsyj['num_2'];
if($bdpv>0||$bdnum>0){
foreach($glnetary as $u=>$u1){
updateglnetusertdpv2($u1,$bdpv,$bdnum);
updateglnettdpv($year,$month,$day,$u1,$bdpv,$bdnum,$rsyj['type']);
}
foreach($oldglnetary as $u=>$u1){
updateglnetusertdpv2($u1,-$bdpv,-$bdnum);
updateglnettdpv($year,$month,$day,$u1,-$bdpv,-$bdnum,$rsyj['type']);
}
}
}
}
}
$sql5="select gldept from {$db_prefix}users where username='$oldprename'";
$rs5=$db->get_one($sql5);
$gldept=$rs5['gldept']-$rs2['gldept'];
$sql7="update {$db_prefix}users set prename='".trim($tousername)."',pos='$pos',gldept=gldept-'$gldept' where username='".trim($username)."'";
$db->query($sql7);
$db->query("update {$db_prefix}users set gldept=gldept-'".$gldept."' where find_in_set(".$rs1['id'].",glstr)>0");
$sqlgx="select glstr from {$db_prefix}users where username='".$tousername."'";
$rsgx=$db->get_one($sqlgx);
if($rsgx['glstr']) $glstr=$rsgx['glstr'].",".$rs2['id'];else $glstr=$rs2['id'];
$sqlgx1="update {$db_prefix}users set glstr='".trim($glstr)."' where username='".trim($username)."'";
$db->query($sqlgx1);
$sqlxj="select * from {$db_prefix}users where find_in_set('".$rs1['id']."',glstr)>0";
$resultxj=$db->query($sqlxj);
while($rsxj=$db->fetch_array($resultxj)){
$glnetupstr="";$newglstr='';
getglnetupstr($rsxj['prename']);
$glnetary=explode(",",$glnetupstr);
foreach($glnetary as $u=>$u1){
$sqlt="select id from {$db_prefix}users where username='$u1'";
$rst=$db->get_one($sqlt);
if($newglstr!='') $newglstr=$rst['id'].','.$newglstr;else $newglstr=$rst['id'];
}
$sqlgx1="update {$db_prefix}users set glstr='".trim($newglstr)."' where id='".$rsxj['id']."'";
$db->query($sqlgx1);
}
$db->free_result($resultxj);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=3;$log_addtime=time();$log_ip=getip();$log_memo="移动{$username}安置网体到{$tousername}，原接点人{$oldprename}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
echo "<script>alert('安置网体修改成功');location.href='glnetedit.php';</script>";exit();
}
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=netedit" >

<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>安置网体修改</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="42%" align="right" valign="middle" bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="58%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="username" type="text" id="username"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >新接点人编号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="tousername" type="text" id="tousername"></TD>
	  </TR>
	<TR align="right">
	  <TD height="38" valign="middle" bgColor="#FBFDFF" >区位:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	    <script language="javascript">
	   function changepos(){
	     var tmp=document.getElementById("pos").value;
		 if(tmp=="other"){
		 document.getElementById("dispos").style.display="";
		 }else{
		document.getElementById("dispos").style.display="none";
		 }
	   }
	  </script>
	  <select name="pos" onChange="changepos()" id="pos">
        ';
foreach($posary as $key=>$value){echo "<option value='".$key."'";
if ($pos==$key) echo " selected";
echo ">".$value."区</option>";}
;echo '      </select>
	  <span style="display:none;" id="dispos">
	  <input type="text" name="pos2" size="3" id="pos2">
	  </span>
	  </TD>
	</TR>
	<TR align="center">
	  <TD height="38" colspan="2" valign="middle" bgColor="#FBFDFF" ><p>说明:已参与结算的会员不移动网体业绩</p>
	    </TD>
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
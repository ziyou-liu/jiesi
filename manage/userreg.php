<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");
include("../include/pos.php");
include("../include/rank.php");
include("../include/pv.php");
include("../include/function.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");
include("../include/logcls.php");
include("../include/setting.php");
$sql="select count(id) as c from {$db_prefix}users where 1";
$rs=$db->get_one($sql);
if (floatval($rs["c"])==0){header("location:compreg.php");exit();}
$modtime=time();
function getrand() {
for($i=0;$i<6;$i++){
$string.=rand(0,9);
}
return "cn".$string;
}
function getusername($tmp_username) {
global $db,$db_prefix;
$sql="select * from {$db_prefix}users where username='$tmp_username' ";
$result=$db->get_one($sql);
if(!empty($result)){
$name=getrand();
getusername($name);
}else return $tmp_username;
}
$tmp_username=getrand();
$t_username=getusername($tmp_username);
function getreguserpos($prename,$pos) {
global $db,$db_prefix,$ccc;
if($pos==2) $ccc=2;
$sql="select * from {$db_prefix}users where prename='$prename' and pos='$pos'";
$rs=$db->get_one($sql);
if(!empty($rs["id"])) {
return $name=getreguserpos($rs["username"],1);
}else{
return $prename;
}
}
function gettjnetupstr211($username){
global $db,$db_prefix;
$sql="select id,username,type from {$db_prefix}users where tjrname='".$username."' and type=1 order by id asc limit 1";
$rs=$db->get_one($sql);
if($rs["id"]){
gettjnetupstr211($rs['username']);
}else{
return $username;
}
}
function getzengsong_name($usernames) {
global $db,$db_prefix,$names;
$sql="select id,username from {$db_prefix}users where username='".$usernames."'";
$rs=$db->get_one($sql);
if($rs["id"]) {
$j=$j+1;
$names='';
$usernames=$rs['username']."_".$j;
getzengsong_name($usernames);
}else{
$names=$usernames;
}
}
if ($action=="reg"){
$modtime=time();$curmonth=date("Y-m",$modtime);$posnum=2;
$curyear1=date('Y',$modtime);$curmonth1=date('m',$modtime);
if ($curmonth1==1){
$lstyear=$curyear1-1;$lstmonth=12;
}
$hint="";
if(trim($username)=="") $hint.="请输入用户编号\\n";
if($glo_s_realname){
}
if(trim($pwd)=="") {
$hint.="请输入一级密码\\n";
}
if($pwd!=$repwd) $hint.="一级密码不一致\\n";
if(trim($pwd1)=="") {
$hint.="请输入二级密码\\n";
}
if($pwd1!=$repwd1) $hint.="二级密码不一致\\n";
if(trim($tjrname)=="") $hint.="请输入推荐人\\n";
if(trim($prename)=="") $hint.="请输入接点人\\n";
if(trim($tghttp)=="") $hint.="请点击获取推广链接\\n";
if(trim($rank)=="") $hint.="请选择级别\\n";
if(trim($province)=="") $hint.="请选省份地区\\n";
$idpreg="/^(\d{18,18}|\d{15,15}|\d{17,17}x)$/";
if($glo_s_bank){
if(trim($bank)=="") $hint.="请输入开户银行\\n";
}
if($glo_s_address){
}
if($glo_s_receiver){
}
if($glo_s_mobile){
if(trim($mobile)=="") $hint.="请输入联系手机\\n";
}
if($glo_s_phone){
}
if($glo_s_fax){
}
if($glo_s_postcode){
}
if($glo_s_zhanghao){
if(trim($zhanghao)=="") $hint.="请输入银行账号\\n";
}
if($glo_s_huzhu){
if(trim($huzhu)=="") $hint.="请输入户主\\n";
}
if($glo_s_bankaddress){
if(trim($bankaddress)=="") $hint.="请输入开户行地址\\n";
}
if($glo_s_qq){
}
$glstr='';$tjstr='';
$sql_chk="select * from {$db_prefix}users where username='".trim($username)."'";
$rs_chk=$db->get_one($sql_chk);
if (!empty($rs_chk["id"])) $hint.="用户编号已经被占用\\n";
$sql_chk1="select * from {$db_prefix}users where username='".trim($prename)."' and state=1";
$rs_chk1=$db->get_one($sql_chk1);
if (empty($rs_chk1["id"])) $hint.="推荐人验证失败\\n";
$tjglary=explode(',',$rs_chk1['glstr']);
if(!in_array(trim($tjrname),$tjglary) &&trim($prename)!=trim($tjrname)){
$hint.="推荐会员必须放在自己的管理网体下\\n";
}
$sql_chk2="select * from {$db_prefix}users where username='".trim($prename)."' and state=1";
$rs_chk2=$db->get_one($sql_chk2);
if (empty($rs_chk2["id"])) $hint.="接点人验证失败\\n";
if(trim($regfrom)==''){
if($pos==1){
if(trim($prename)!=trim($tjrname)){
$hint.="A区必须有自己推荐\\n";
}
}
}
$sqldo="select count(id) as a from {$db_prefix}users where state=1 and tjrname='".trim($tjrname)."'";
$rstj=$db->get_one($sqldo);
if($rstj['a']==0){
$sql1="select count(id) as a from {$db_prefix}users where prename='".trim($tjrname)."'";
$rs1=$db->get_one($sql1);
if($rs1['a']==2){
$sql1_1="select username,glstr from {$db_prefix}users where prename='".trim($tjrname)."' and pos=1";
$rs1_1=$db->get_one($sql1_1);
$sql1_2="select sum(pv1) as b from {$db_prefix}tdpv where username='".$rs1_1['username']."'";
$rs1_2=$db->get_one($sql1_2);
$sql2_1="select username,glstr from {$db_prefix}users where prename='".trim($tjrname)."' and pos=2";
$rs2_1=$db->get_one($sql2_1);
$sql2_2="select sum(pv1) as d from {$db_prefix}tdpv where username='".$rs2_1['username']."'";
$rs2_2=$db->get_one($sql2_2);
if($rs1_2['b']>$rs2_2['d']) {
$glnetary=explode(',',$rs1_2['glstr']);
if (!in_array(trim($prename),$glnetary) &&trim($prename)!=$rs1_1['username']) $hint.="会员推荐的第一个会员必须放在自己管理网体的大区内\\n";
}
if($rs1_2['b']<$rs2_2['d']) {
$glnetary=explode(',',$rs2_2['glstr']);
if (!in_array($prename,$glnetary) &&trim($prename)!=$rs2_1['username']) $hint.="会员推荐的第一个会员必须放在自己管理网体的大区内\\n";
}
}else if($rs1['a']==1){
$sql0="select username,glstr from {$db_prefix}users where prename='".trim($tjrname)."'";
$rs0=$db->get_one($sql0);
$glnetary=explode(',',$rs0['glstr']);
if (!in_array($prename,$glnetary) &&trim($prename)!=$rs0['username']) $hint.="会员推荐的第一个会员必须放在自己管理网体内\\n";
}
}
$sql_chk3="select * from {$db_prefix}users where prename='".trim($prename)."' and pos='".$pos."'";
$rs_chk3=$db->get_one($sql_chk3);
if (!empty($rs_chk3["id"])) $hint.="接点人的".$posary1[$pos]."区已被占用\\n";
if (trim($zmdname)!=""){
$sql_chk4="select * from {$db_prefix}users where username='".trim($zmdname)."' and state=1 and isdp=1";
$rs_chk4=$db->get_one($sql_chk4);
if (empty($rs_chk4["id"])) $hint.="服务中心验证失败\\n";
}
$gldept=$rs_chk2["gldept"]+1;
$tjdept=$rs_chk1["tjdept"]+1;
if($rs_chk1['tjstr']) $tjstr=$rs_chk1['username'].",".$rs_chk1['tjstr'];else $tjstr=$rs_chk1['username'];
if($rs_chk2['glstr']) $glstr=$rs_chk2['username'].",".$rs_chk2['glstr'];else $glstr=$rs_chk2['username'];
$bdmoney=0;$bdnum=0;$price=0;$shopprice=0;$bv=0;$isdp=0;$jifen=0;$price3=0;$bv=0;
$posnum=$posnumary[$rank];
if ($hint!=""){
;echo '		<script>alert(\'';echo $hint;;echo '\');location.href=\'userreg.php?';reset($_POST);if (count($_POST)){while (list($key,$val) = each($_POST)) {if(!is_array($_POST[$key])){echo $key."=".urlencode($_POST[$key])."&";}}};echo 'tempt=haha\';</script>
	 ';exit();
}
$isblank=0;
if ($isblank==0){
$glo_rname="glo_member_".$rank;
$bdmoney=$$glo_rname;
$glo_rname="glo_num_".$rank;
$bdnum=$$glo_rname;
$glo_rname="glo_shopmon_".$rank;
$price_repeat1=$$glo_rname;
}
$timepre='';$timeok=1;$tjnet=0;
$timeok=0;$tjnet=1;
$sql="select id,username from {$db_prefix}users where state=1  and timeok=0 order by confirmtime desc limit 0,1";
$p_rs=$db->get_one($sql);
if(empty($p_rs['id'])) $hint="对不起，当前时间有注册会员操作，请稍后在注册！";
if($hint==''){
$timepre=$p_rs['username'];
$db->query("update {$db_prefix}users set timeok=1 where username='".$timepre."'");
$updatenum=mysql_affected_rows();
if($updatenum<1) $hint="对不起，当前时间有注册会员操作，请稍后在注册！";
}
if ($hint!=""){
;echo '		<script>alert(\'';echo $hint;;echo '\');location.href=\'userreg.php?';reset($_POST);if (count($_POST)){while (list($key,$val) = each($_POST)) {if(!is_array($_POST[$key])){echo $key."=".urlencode($_POST[$key])."&";}}};echo 'tempt=haha\';</script>
	 ';exit();
}
$sql="insert into {$db_prefix}users(username,realname,pwd,pwd1,tjrname,prename,pos,tjstr,glstr,zmdname,price,bv,price_repeat1,bdmoney,bdnum,bdnum_team,pv_reg,pv_team_reg,pv_team_regp,rank0,rank,isdp,state,lognum,regtime,confirmtime,sex,province,city,area,mobile,postcode,address,receiver,email,idcard,bank,zhanghao,huzhu,bankaddress,fax,qq,phone,gldept,tjdept,regusername,regrealname,regtype,timepre,isblank,type,shopprice,regbv,jifen,wenti1,wenti2,tghttp,timeok,tjnet) values('".trim($username)."','".trim($realname)."','".mymd5($pwd,"EN")."','".mymd5($pwd1,"EN")."','".trim($tjrname)."','".trim($prename)."','$pos','".$tjstr."','".$glstr."','".trim($zmdname)."','$price','$bv','$price_repeat1','$bdmoney','$bdnum','$bdnum','$bdmoney','$bdmoney','$bdmoney','$rank','$rank','$isdp','1','0','$modtime','$modtime','$sex','$province','$city','$area','$mobile','$postcode','$address','$receiver','$email','$idcard','$bank','$zhanghao','$huzhu','$bankaddress','$fax','$qq','$phone','$gldept','$tjdept','".$_SESSION["glo_adminname"]."','".$_SESSION["glo_adminreal"]."','0','$timepre','$isblank','1','$shopprice','$bv','$jifen','$wenti1','$wenti2','$tghttp','$timeok','$tjnet')";
$db->query($sql);
$rank1=0;
$rstj=$db->get_one("select tjnum from {$db_prefix}users where username='".trim($tjrname)."' limit 1");
for($i=1;$i<=6;$i++){
$glotjnum="glo_xstjnum_".$i;
$tjnums=$$glotjnum-1;
if($rstj['tjnum']>=$tjnums){
$rank1=$i;
}
}
$db->query("update {$db_prefix}users set tjbdnum=tjbdnum+'$bdnum',tjnum=tjnum+1,rank1='$rank1' where username='".trim($tjrname)."' limit 1");
$sqlt="select rank,isdp from {$db_prefix}users where username='".trim($tjrname)."' limit 1";
$rst=$db->get_one($sqlt);
if($rst['rank']>=5 &&$rst['isdp']==1){
$db->query("update {$db_prefix}users set bdtjnum=bdtjnum+1 where username='".trim($tjrname)."' limit 1");
}
if($isblank==0) {
}
if($bdmoney>0){
$tjnetary=explode(",",trim($tjstr));
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
insertintopv_1($year,$month,$day,$username,$bdmoney,$bdnum,1);
if(trim($glstr)!='') {
$glnetary=explode(",",trim($glstr));
foreach($glnetary as $u=>$u1){
updateglnetusertdpv2($u1,$bdmoney,$bdnum);
updateglnettdpv($year,$month,$day,$u1,$bdmoney,$bdnum,1);
}
unset($glnetary);
}
$tjnetupstr="";
gettjnetupstr(trim($tjrname));
$tjnetary=explode(",",$tjnetupstr);
foreach($tjnetary as $u=>$u1){
updatetjnetusertdpv2($u1,$bdmoney);
updatetjnettdpv($year,$month,$day,$u1,$bdmoney);
}
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=14;$log_addtime=$modtime;$log_ip=getip();$log_memo="管理员{$log_admin}注册会员{$username}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
}
require("../autopw.php");
echo "<script>location.href='users.php';</script>";exit();
}
;echo '<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
<script>
function frmchk(frm){
	if (frm.username.value=="")
	{
		alert("对不起，请输入用户编号");
		frm.username.focus();
		return false;
	}
	//if (frm.isdp.value==0){
		if (frm.tjrname.value=="")
		{
			alert("对不起，请输入推荐人");
			frm.tjrname.focus();
			return false;
		}
		if (frm.prename.value=="")
		{
			alert("对不起，请输入接点人");
			frm.prename.focus();
			return false;
		}
	//}else{
		//do nothing
	//}
   if(frm.isdp.value==0){
	if (frm.rank.value=="")
	{
		alert("对不起，请选择级别");
		frm.rank.focus();
		return false;
	}
   }
   ';if($glo_s_idcard){;echo '	if (frm.idcard.value==""){
		alert("对不起，请输入身份证");
		frm.idcard.focus();
		return false;
	}
	';
}
;echo '	if (frm.province.value=="")
	{
		alert("对不起，请选择省份");
		frm.province.focus();
		return false;
	}
   ';
if($glo_s_address){
;echo '	if (frm.address.value=="")
	{
		//alert("对不起，请输入地址");
		//frm.address.focus();
		//return false;
	}
    ';};echo '';
if($glo_s_receiver){
;echo '	if (frm.receiver.value=="")
	{
		//alert("对不起，请输入收货人");
		//frm.receiver.focus();
		//return false;
	}
	';};echo '     ';
if($glo_s_mobile){
;echo '	if (frm.mobile.value=="")
	{
		alert("对不起，请输入手机");
		frm.mobile.focus();
		return false;
	}
    ';};echo '     ';
if($glo_s_phone){
;echo '	if (frm.phone.value=="")
	{
		//alert("对不起，请输入座机");
		//frm.phone.focus();
		//return false;
	}
     ';};echo '     ';
if($glo_s_postcode){
;echo '	if (frm.postcode.value=="")
	{
		alert("对不起，请输入邮编");
		frm.postcode.focus();
		return false;
	}
   ';};echo '   ';
if($glo_s_bank){
;echo '	if (frm.bank.value=="")
	{
		alert("对不起，请输入银行");
		frm.bank.focus();
		return false;
	}
   ';};echo '   ';
if($glo_s_zhanghao){
;echo '	if (frm.zhanghao.value=="")
	{
		alert("对不起，请输入账号");
		frm.zhanghao.focus();
		return false;
	}
   ';};echo '   ';
if($glo_s_huzhu){
;echo '	if (frm.huzhu.value=="")
	{
		alert("对不起，请输入户主");
		frm.huzhu.focus();
		return false;
	}
    ';};echo '	';
if($glo_s_bankaddress){
;echo '	if (frm.huzhu.value=="")
	{
		alert("对不起，请输入开户行地址");
		frm.bankaddress.focus();
		return false;
	}
    ';};echo '	document.getElementById(\'sub_but\').value=\'正在注册……\';
	document.getElementById(\'sub_but\').disabled=\'disabled\';
}
function ignoreSpaces(string) {
var temp = "";
string = \'\' + string;
splitstring = string.split(" ");
for(i = 0; i < splitstring.length; i++)
temp += splitstring[i];
return temp;
}
function checkpre(){
	var username=document.getElementById("prename").value;
	if (username==\'\'){
		alert("请先输入管理人编号");
	}else{
		var ifrm=document.getElementById("iframe1");
		 d = new Date();
		ifrm.src="../checkpre.php?username="+username+"&times="+d.getMilliseconds();
	}
}
function checktjr(){
	var username=document.getElementById("tjrname").value;
	if (username==\'\'){
		alert("请先输入推荐人编号");
	}else{
		var ifrm=document.getElementById("iframe1");
		 d = new Date();
		ifrm.src="../checktjr.php?username="+username+"&times="+d.getMilliseconds();
	}
}
function thschk(from){
if(from=="left") var username=document.form1.tjrname.value;
if(from=="right") var username=document.form1.prename.value;
	var ifrm=document.getElementById("iframe1");
	ifrm.src="../check.php?username="+username+"&from="+from;
}
function getLine(){
	var username=document.form1.username.value;
	var url=document.form1.url.value;
	var urls="http://"+url;
	document.getElementById("tglj").value=username;
	document.getElementById("tghttp").value=urls+username;
	document.getElementById(\'tgurl\').innerHTML=urls+username;
}
</script>
<script language="javascript">
function buypro(){
	var t1=document.getElementsByName(\'proid[]\').length;
	var tprice=0;var tpv=0;
	for(var i=0;i<t1;i++)	{
		if (document.getElementsByName(\'proid[]\')[i].checked){
			tprice+=document.getElementsByName(\'tprice[]\')[i].value*document.getElementsByName(\'buynum[]\')[i].value;
		}
	}
	var jbstr=\'\';
	var jbstr2=\'\';
	var rankjibie=0;
	if(tprice>= ';echo $glo_member_1;;echo ') {
		jbstr=\'';echo $rankary[1];echo '\';	
		rankjibie=1;
	}
	if(tprice>= ';echo $glo_member_2;;echo ') {
		jbstr=\'';echo $rankary[2];echo '\';	
		rankjibie=2;
	}
	if(tprice>= ';echo $glo_member_3;;echo ') {
		jbstr=\'';echo $rankary[3];echo '\';	
		rankjibie=3;
	}
	if(tprice>= ';echo $glo_member_4;;echo ') {
		jbstr=\'';echo $rankary[4];echo '\';	
		rankjibie=4;
	}
	if(rankjibie>0) {
		var t2=document.getElementsByName(\'trank[]\').length;
		document.getElementById(\'buyproinfo\').innerHTML=\'总计：\'+tprice+\'；已达到<b> \' +jbstr+ \' </b>级别，可以注册\';
		document.getElementById(\'rank\').value=rankjibie;
	}else {
		document.getElementById(\'buyproinfo\').innerHTML=\'产品总额于投资额不对应\';	
	}
}
</script>
</HEAD><body>
<iframe id="iframe1" name="iframe1" src="" style="display:none" height="200"></iframe>
<form name="form1" id="form1" method="post" action="userreg.php?action=reg" onSubmit="return frmchk(this);">
<input type="hidden" name="temp1" value="haha"><input name="regfrom" type="hidden" value="';echo $_GET['regfrom'];echo '">
<TABLE width="40%" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TR><TD width="100%" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TR>
<TD height=23>&nbsp;<strong>后台会员注册-- 个人信息<span class="style1">（打*号为必填项）</span></strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="28%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >用户编号:</TD>
	  <TD width="72%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >
	  <input type="text" name="username" value="';echo $t_username;echo '">  <span class="style1"> *</span></TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >昵称:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="realname" type="text" id="realname" onKeyUp="this.value=ignoreSpaces(this.value);" value="';echo $realname;;echo '"> ';if($glo_s_realname){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >一级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="pwd" type="password" id="pwd" size="21" value="';echo $glo_mima1;echo '">	<span class="style1">*</span>	 </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认一级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="repwd" type="password" id="repwd" size="20" value="';echo $glo_mima1;echo '">		<span class="style1">*</span> </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="pwd1" type="password" id="pwd1" size="20" value="';echo $glo_mima2;echo '">		<span class="style1">*</span> </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="repwd1" type="password" id="repwd1" size="20" value="';echo $glo_mima2;echo '">	<span class="style1">*</span> </TD>
	  </TR>
	<tr style="display:">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >级别选择:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <select name="rank" id="rank" >
	   ';
foreach($rankary as $key_1=>$value_1){
echo "<option value='{$key_1}'>{$value_1}</option>";
}
;echo '	    </select> <span class="style1">*</span> </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >手机号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="mobile" type="text" id="mobile" value="';echo $mobile;;echo '"> ';if($glo_s_mobile){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >推荐人编号:</TD>
	  <TD height="43" align="left" valign="middle" bgColor="#FBFDFF" ><input name="tjrname" type="text" id="tjrname" value="';echo $tjrname;;echo '">
          <span class="style1">*</span>
		  <INPUT name="but" type=button class=button_text  id="but" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="获取推荐人最左侧" onClick="checktjr();" style="display:none">
          <INPUT name="but" type=button class=button_text  id="but" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="检测推荐人" onClick="thschk(\'left\');">
	    <span id="thdiv"></span></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >接点人编号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';if($regfrom=="net"){;echo '	      <input name="prename" type="text" id="prename"  value="';echo $prename;;echo '">
	    <input name="regfrom" type="hidden" id="regfrom"  value="net">
	    ';}else{;echo '          <input name="prename" type="text" id="prename"  value="';echo $prename;;echo '">
          ';};echo '	    <span class="style1">*</span>
         <INPUT name="but" type=button class=button_text  id="but" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="获取接点人" onClick="checkpre();" style="display:none">  <INPUT name="but" type=button class=button_text  id="but" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="检测接点人" onClick="thschk(\'right\');">
	    <span id="thdiv2"></span></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >市场位置:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="pos" id="pos">
          ';
foreach($posary as $key=>$value){echo "<option value='".$key."'";
if ($pos==$key) echo " selected";
if($key==1) $value="A";
else $value="B";
echo ">".$value."区</option>";}
;echo '        </select>
          <span class="style1">*</span></TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >推广链接:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><span id="tgurl"></span>
		<input name="url" id="url" type="hidden" value="';echo $_SERVER['HTTP_HOST'],'/','user/register.php?tj=';echo '">
		<input name="thlj" id="tglj" type="hidden" value="">
		<input name="tghttp" id="tghttp" type="hidden" value="">
		<INPUT name="getlj" type=button class=button_text  id="getlj" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="获取推广链接" onClick="getLine();">
	  </TD>
	</TR>
	<TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >是否空点:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="isblank"  id="isblank" onChange="kongdianchge()">
        <option value="0" ';if(isset($isblank)&&$isblank==0) echo "selected";;echo '>否</option>
        <option value="1" ';if(isset($isblank)&&$isblank==1) echo "selected";;echo '>是</option>
      </select>
	    <span class="style1">*</span>		 <span id=\'kongdianmemo\' class="style1"></span> </TD>
	  </TR>
	  <script language="javascript">
	  function disrank(t){
	   if(t==0) document.getElementById("adddis").style.display="";
		else {
		document.getElementById("adddis").style.display="none";
		}
	  }
	  </script>
	 <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >服务中心:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zmdname" type="text" id="zmdname" size="20" value="';echo $zmdname;;echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >性别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="sex" type="radio" value="男" ';if(empty($sex)||$sex=="男") echo "checked";;echo '>
	    男
	    <input type="radio" name="sex" value="女" ';if($sex=="女") echo "checked";;echo '>
	    女</TD></TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >省份、城市、地区:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <select name="province" id="province" onChange="_province(this.value,\'city\',\'area\')">
	  <option value="">请选择</option>
	   ';
$sql_pro="select * from {$db_prefix}province where 1 order by id asc";
$result_pro=$db->query($sql_pro);
while ($rs_pro=$db->fetch_array($result_pro)){
echo "<option value='".$rs_pro["provinceID"]."'";
if ($rs["province"]==$rs_pro["provinceID"]) echo " selected";if ($province==$rs_pro["provinceID"]) echo " selected";
echo ">".$rs_pro["province"]."</option>";
}
$db->free_result($result_pro);
;echo '	    </select>
	    <select name="city" id="city" onChange="_city(this.value,\'area\')">
	      </select>
	    <select name="area" id="area">
	      </select>
       <span class="style1">*</span> </TD>
	  </TR>
	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="address" type="text" id="address" size="40" value="';echo $address;;echo '">';if($glo_s_address){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
     <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收货人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="receiver" type="text" id="receiver" size="40" value="';echo $receiver;;echo '">';if($glo_s_receiver){;echo '<span class="style1">*</span> ';};echo '</TD>
	 </TR>
    <TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >座机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="phone" type="text" id="phone" value="';echo $phone;;echo '"> ';if($glo_s_phone){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >传真:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="fax" type="text" id="fax" value="';echo $fax;;echo '"> ';if($glo_s_fax){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
	<TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="postcode" type="text" id="postcode" value="';echo $postcode;;echo '">
	  ';if($glo_s_postcode){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >Email:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="email" type="text" id="email" value="';echo $email;;echo '">';if($glo_s_email){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >QQ:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="qq" type="text" id="qq" value="';echo $qq;;echo '">';if($glo_s_qq){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >身份证:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="idcard" type="text" id="idcard" size=40 value="';echo $idcard;;echo '"> ';if($glo_s_idcard){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >银行:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<select name="bank" id="bank" size="1">
          <option value="">请选择开户行</option>
          ';
$sql="select bank from {$db_prefix}bank ";
$bres=$db->query($sql);
if(!empty($bres)){
while($brs=$db->fetch_array($bres)){
$bankname=$brs["bank"];
if($rs["bank"]==$bankname) $b_name="selected";else $b_name="";
echo "<option value=\"$bankname\" $b_name >$bankname</option>";
}
}else{
echo "<option value=\"\">暂未添加银行</option>";
}
;echo '        </select>
		 ';if($glo_s_bank){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >银行账号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zhanghao" type="text" id="zhanghao" size="35" value="';echo $zhanghao;;echo '">
	     ';if($glo_s_bank){;echo '<span class="style1">*</span> ';};echo ' </TD>
	  </TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >户主:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="huzhu" type="text" id="huzhu" value="';echo $huzhu;;echo '">';if($glo_s_huzhu){;echo '<span class="style1">*</span> ';};echo ' </TD>
	  </TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >开户行地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="bankaddress" type="text" id="bankaddress" size="35" value="';echo $bankaddress;;echo '"> ';if($glo_s_bankaddress){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
	<TR>
	  <TD background="images/tab_19.gif"  colspan="2" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="sub_but" value="注册" name="sub_but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>';
?>
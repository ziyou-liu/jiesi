<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn_2.php");
include("../include/pos.php");
include("../include/rank.php");
include("../include/pv.php");
include("../include/function.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");
include("../include/logcls.php");
include("../include/setting.php");
include("../include/secpwd.php");
$sql="select count(id) as c from {$db_prefix}users where 1";
$rs=$db->get_one($sql);
if (floatval($rs["c"])==0){die("系统未运行，请稍后操作");}
function getrand()
{
$pattern = "123567890";
for($i=0;$i<6;$i++)
{
$key .= $pattern{rand(0,8)};
}
return "cn".$key;
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
$sqlu="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rsu=$db->get_one($sqlu);
$userisdp=$rsu['isdp'];
$tjstate=$rsu['state'];
if (($userisdp!=1)&&($glo_onlybdzx==1)){
die("<center><bR><bR><bR><bR><bR><bR><bR>只有服务中心才能进行报单！</center>");
}
if ($action=="reg"){
$modtime=time();$tjrname=trim($tjrname);
$hint="";
if($glo_s_realname){
}
if($glo_s_idcard) {
if(trim($idcard=='')) $hint.="请输入身份证";
}
$idpreg="/^(\d{18,18}|\d{15,15}|\d{17,17}x)$/";
if (trim($idcard)!='') {if(!preg_match($idpreg,trim($idcard))) $hint.="请输入正确的身份证\\n";}
if(trim($pwd)==""&&trim($pwd1)==""){
$len=substr($username,-6);
$pwd=$len;$pwd1=$len;$repwd=$len;$repwd1=$len;
}
if(trim($pwd)=="") $hint.="请输入一级密码\\n";
if($pwd!=$repwd) $hint.="一级密码不一致\\n";
if(trim($pwd1)=="") $hint.="请输入二级密码\\n";
if($pwd1!=$repwd1) $hint.="二级密码不一致\\n";
if(trim($tjrname)=="") $hint.="请输入推荐人编号\\n";
if(trim($prename)=="") $hint.="请输入安置人编号\\n";
if(trim($tghttp)=="") $hint.="请点击获取推广链接\\n";
if(trim($rank)=="") $hint.="请选择级别\\n";
if(trim($province)=="") $hint.="请选择省份地区\\n";
if($glo_s_address){
if(trim($address)=="") $hint.="请输入收货地址\\n";
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
if($glo_s_email){
}
if($glo_s_qq){
if(trim($qq)=="") $hint.="请输入QQ\\n";
}
if($glo_s_bank){
if(trim($bank)=="") $hint.="请输入开户银行\\n";
}
if($glo_s_zhanghao){
if(trim($zhanghao)=="") $hint.="请输入银行账号\\n";
}
if($glo_s_huzhu){
if(trim($huzhu)=="") $hint.="请输入户主\\n";
}
if ($hint!=""){
;echo '		<script>alert(\'';echo $hint;;echo '\');location.href=\'userreg.php?';reset($_POST);if (count($_POST)){while (list($key,$val) = each($_POST)) {if(!is_array($_POST[$key])){echo $key."=".urlencode($_POST[$key])."&";}}};echo 'tempt=haha\';</script>
	 ';exit();
}
$glstr='';$tjstr='';
if(trim($idcard)!=''){
$sqlidc="select count(id) as c from {$db_prefix}users where idcard='".trim($idcard)."'";
$rsidc=$db->get_one($sqlidc);
if($rsidc['c']>=1) $hint.="身份证号已使用\\n";
}
$sql_chk="select * from {$db_prefix}users where username='".trim($username)."'";
$rs_chk=$db->get_one($sql_chk);
if (!empty($rs_chk["id"])) $hint.="会员编号已经被占用\\n";
$sql_chk1="select * from {$db_prefix}users where username='".trim($prename)."' and state=1";
$rs_chk1=$db->get_one($sql_chk1);
if (empty($rs_chk1["id"])) $hint.="推荐人验证失败\\n";
$tjrid=$rs_chk1['id'];
$tjglary=explode(',',$rs_chk1['glstr']);
if(!in_array(trim($tjrname),$tjglary) &&trim($prename)!=trim($tjrname)){
$hint.="推荐会员必须放在自己的管理网体下\\n";
}
$sql_chk2="select * from {$db_prefix}users where username='".trim($prename)."' and state=1";
$rs_chk2=$db->get_one($sql_chk2);
if (empty($rs_chk2["id"])) $hint.="接点人验证失败\\n";
$gldept=$rs_chk2["gldept"]+1;
$tjdept=$rs_chk1["tjdept"]+1;
if($rs_chk1['tjstr']) $tjstr=$rs_chk1['username'].",".$rs_chk1['tjstr'];else $tjstr=$rs_chk1['username'];
if($rs_chk2['glstr']) $glstr=$rs_chk2['username'].",".$rs_chk2['glstr'];else $glstr=$rs_chk2['username'];
$sql_chk3="select * from {$db_prefix}users where prename='".trim($prename)."' and pos='".$pos."'";
$rs_chk3=$db->get_one($sql_chk3);
if (!empty($rs_chk3["id"])) $hint.="接点人的".$posary1[$pos]."区已被占用\\n";
if($pos==1){
if(trim($prename)!=trim($tjrname)){
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
$gldept=$rs_chk2["gldept"]+1;
$tjdept=$rs_chk1["tjdept"]+1;
if($rs_chk1['tjstr']) $tjstr=$rs_chk1['username'].",".$rs_chk1['tjstr'];else $tjstr=$rs_chk1['username'];
if($rs_chk2['glstr']) $glstr=$rs_chk2['username'].",".$rs_chk2['glstr'];else $glstr=$rs_chk2['username'];
$isdp=0;$price=0;$price_shop=0;$pv_reg=0;$bdnum=1;$shopprice=0;
$isblank=0;
$glo_rname="glo_member_".$rank;
$bdmoney=$$glo_rname;
$glo_rname="glo_num_".$rank;
$bdnum=$$glo_rname;
$regstate=0;$confirmtime='';
$sql="select price from {$db_prefix}users where username='".$_SESSION["glo_username"]."' ";
$p_rs=$db->get_one($sql);
if($p_rs["price"]<$bdmoney){
}
if (trim($zmdname)!=""){
$sql_chk4="select * from {$db_prefix}users where username='".trim($zmdname)."' and state=1 and isdp=1 ";
$rs_chk4=$db->get_one($sql_chk4);
if (empty($rs_chk4["id"])) $hint.="服务中心验证失败\\n";
}
if ($hint!=""){
;echo '		<script>alert(\'';echo $hint;;echo '\');location.href=\'userreg.php?';reset($_POST);if (count($_POST)){while (list($key,$val) = each($_POST)) {if(!is_array($_POST[$key])){echo $key."=".urlencode($_POST[$key])."&";}}};echo 'tempt=haha\';</script>
	 ';exit();
}
if ($regstate==1){
$sqlkq="update {$db_prefix}users set price=price-{$bdmoney} where username='".$_SESSION["glo_username"]."' ";
$db->query($sqlkq);
$memo=11;$type=2;$optime=$modtime;$memo1="注册会员".$username;
eclsproc($_SESSION["glo_username"],$memo,$bdmoney,$type,$optime,$memo1);
}
$timepre='';$timeok=1;$tjnet=0;
if($regstate==1 &&$dprank==0){
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
;echo '			<script>alert(\'';echo $hint;;echo '\');location.href=\'userreg.php?';reset($_POST);if (count($_POST)){while (list($key,$val) = each($_POST)) {if(!is_array($_POST[$key])){echo $key."=".urlencode($_POST[$key])."&";}}};echo 'tempt=haha\';</script>
	 ';exit();
}
$db->query("update {$db_prefix}users set tjnum=tjnum+1,tjbdnum=tjbdnum+'".$bdnum."' where username='".trim($tjrname)."'");
}
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
$allm=$year*12+$month;
$sql="insert into {$db_prefix}users(username,realname,pwd,pwd1,tjrname,prename,tjstr,glstr,pos,zmdname,price,bv,bdmoney,bdnum,bdnum_team,pv_reg,pv_team_reg,pv_team_regp,rank0,rank,isdp,state,lognum,regtime,confirmtime,sex,province,city,area,mobile,postcode,address,receiver,email,idcard,bank,zhanghao,huzhu,bankaddress,fax,qq,gldept,tjdept,regusername,regrealname,regtype,timepre,tghttp,timeok,tjnet) values('".trim($username)."','".trim($realname)."','".mymd5($pwd,"EN")."','".mymd5($pwd1,"EN")."','".(trim($tjrname))."','".(trim($prename))."','".$tjstr."','".$glstr."','$pos','".trim($zmdname)."','$price','$bv','$bdmoney','$bdnum','$bdnum','$bdmoney','$bdmoney','$bdmoney','$rank','$rank','$isdp','$regstate','0','$modtime','$confirmtime','$sex','$province','$city','$area','$mobile','$postcode','$address','$receiver','$email','$idcard','$bank','$zhanghao','$huzhu','$bankaddress','$fax','$qq','$gldept','$tjdept','".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','1','$timepre','$tghttp','$timeok','$tjnet')";
$db->query($sql);
if($bdmoney>0){
if($regstate==1)  {
$db->query("update {$db_prefix}users set tjnum=tjnum+1,rfd=0,zfd=0 where username='".trim($tjrname)."' limit 1");
$tjnetary=explode(",",trim($tjstr));
include("../mjjsalfecals.php");
insertintopv_1($year,$month,$day,$username,$bdmoney,$bdnum,1);
if(trim($glstr)!='') {
$glnetary=explode(",",trim($glstr));
foreach($glnetary as $u=>$u1){
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
}
}
echo "<script>alert('注册成功');location.href='myhy11.php';</script>";exit();
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
		alert("对不起，请输入会员编号");
		frm.username.focus();
		return false;
	}
';
if($glo_s_realname){
;echo '	if (frm.realname.value=="")
	{
		//alert("对不起，请输入昵称");
		//frm.realname.focus();
		//return false;
	}
	';
}
;echo '	
	';
if($glo_s_idcard){
;echo '	if (frm.idcard.value=="")
	{
		alert("对不起，请输入身份证号");
		frm.idcard.focus();
		return false;
	}
   ';};echo '   
	if (frm.tjrname.value=="")
	{
		alert("对不起，请输入推荐人编号");
		frm.tjrname.focus();
		return false;
	}
	if (frm.prename.value=="")
	{
		alert("对不起，请输入接点人编号");
		frm.prename.focus();
		return false;
	}

	if (frm.rank.value=="")
	{
		alert("对不起，请选择级别");
		frm.rank.focus();
		return false;
	}

	if (frm.zmdname.value=="")
	{
		//alert("对不起，请输入所属店铺");
		//frm.zmdname.focus();
		//return false;
	}
	
	if (frm.province.value=="")
	{
		alert("对不起，请选择省份");
		frm.province.focus();
		return false;
	}

   ';
if($glo_s_address){
;echo '	if (frm.address.value=="")
	{
		alert("对不起，请输入地址");
		frm.address.focus();
		return false;
	}
   ';};echo '   ';
if($glo_s_mobile){
;echo '	if (frm.mobile.value=="")
	{
		alert("对不起，请输入手机");
		frm.mobile.focus();
		return false;
	}
    ';};echo '   /*  ';
if($glo_s_phone){
;echo '	if (frm.phone.value=="")
	{
		alert("对不起，请输入座机");
		frm.phone.focus();
		return false;
	}
     ';};echo '     ';
if($glo_s_fax){
;echo '	if (frm.fax.value=="")
	{
		alert("对不起，请输入传真");
		frm.fax.focus();
		return false;
	}
     ';};echo '    ';
if($glo_s_postcode){
;echo '	if (frm.postcode.value=="")
	{
		alert("对不起，请输入邮编");
		frm.postcode.focus();
		return false;
	}
   ';};echo '   ';
if($glo_s_email){
;echo '	if (frm.email.value=="")
	{
		alert("对不起，请输入电子邮箱地址");
		frm.email.focus();
		return false;
	}
   ';};echo '*/
   ';
if($glo_s_qq){
;echo '	if (frm.qq.value=="")
	{
			alert("对不起，请输入QQ");
		frm.qq.focus();
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
    ';};echo '}
function ignoreSpaces(string) {
var temp = "";
string = \'\' + string;
splitstring = string.split(" ");
for(i = 0; i < splitstring.length; i++)
temp += splitstring[i];
return temp;
}
function thschk(from){
if(from=="left") var username=document.form1.tjrname.value;
if(from=="right") var username=document.form1.prename.value;
if(from=="center") var username=document.form1.zmdname.value;
	var ifrm=document.getElementById("iframe1");
	ifrm.src="../check.php?username="+username+"&from="+from;
}
function editname(ttt){
	var len=ttt.value.length;
	var strlen=len-5;
	var idstr=ttt.value.substring(strlen);
	var ifrm=document.getElementById("iframe1");
	ifrm.src="../editname.php?idstr="+idstr;
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
<iframe id="iframe1" name="iframe1" src="" style="display:none "></iframe>
<form name="form1" method="post" action="userreg.php?action=reg" onSubmit="return frmchk(this);">
<input type="hidden" name="temp1" value="haha">
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>会员注册</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0" id="">
    <tr>
      <td width="7%">选择</td>
      <td width="23%">产品</td>
      <td width="33%">说明</td>
      <td width="23%">用户价格</td>
      <td width="14%">总数</td>
    </tr>
	';
$p=1;
$sqlreg="select * from {$db_prefix}product where 1 order by id asc";
$resultreg=$db->query($sqlreg);
while($rsreg=$db->fetch_array($resultreg)){
;echo '    <tr>
     <td><label>
        <input name="proid[]" type="checkbox" id="proid" value="';echo $p;echo '" onClick="buypro()">
		<input name="proid1[]" id="proid1" type="hidden" value="';echo $rsreg['id'];echo '">
      </label></td>
      <td>';echo $rsreg['productname'];echo '</td>
      <td>';echo $rsreg['memo'];echo '</td>
      <td>';echo $rsreg['price'];echo '<input name="tprice[]" id="tprice" type="hidden" value="';echo $rsreg['price'];echo '"></td>
     
      <td><select name="buynum[]" onChange="buypro()">
	  ';
for($i=1;$i<=100;$i++){
echo "<option value='{$i}'>{$i}</option>";
}
;echo ' 
	  </select></td>
    </tr>
	';
$p++;
}$db->free_result($resultreg);
;echo '    <tr style=" display:">
      <td colspan="6"><span id="buyproinfo"></span>  
	  ';
foreach($rankary as $key_1=>$value_1){
;echo '		<input name="trank[]" type="hidden" value="';echo $$glorname;echo '">
		';
}
;echo '	</td>
      </tr>
  </table>  -->
  
  
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
	 <TR>
	  <TD width="30%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="70%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >
	  <input type="text" name="username" id="username"  value="';echo $t_username;;echo '"></TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >昵称:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="realname" type="text" id="realname" onKeyUp="this.value=ignoreSpaces(this.value);" value="';echo $realname;;echo '"> 
	  <span class="style1">*</span>  </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >一级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="pwd" type="password" id="pwd" size="20"  value="';echo $glo_mima1;echo '">	 </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认一级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="repwd" type="password" id="repwd" size="20" value="';echo $glo_mima1;echo '">		 </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="pwd1" type="password" id="pwd1" size="20" value="';echo $glo_mima2;echo '">		</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="repwd1" type="password" id="repwd1" size="20" value="';echo $glo_mima2;echo '">		</TD>
	  </TR>
	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >会员级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <select name="rank" id="rank" >
	   ';
foreach($rankary as $key_1=>$value_1){
echo "<option value='{$key_1}'>{$value_1}</option>";
}
;echo '	    </select> <span class="style1">*</span></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >手机号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="mobile" type="text" id="mobile" value="';echo $mobile;;echo '"> ';if($glo_s_mobile){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >推荐人编号:</TD>
	  <TD height="43" align="left" valign="middle" bgColor="#FBFDFF" ><input name="tjrname" type="text" id="tjrname" value="';if($tjstate==1) echo $_SESSION['glo_username'];;echo '">
	    <span class="style1">*</span><INPUT name="but" type=button class=button_text  id="but" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="检测推荐人" onClick="thschk(\'left\');"><span id="thdiv"></span> </TD>
	  </TR>  
      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >接点人编号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';if($regfrom=="net"){;echo '<input name="prename" type="hidden" id="prename"  value="';echo $prename;;echo '"><input name="regfrom" type="hidden" id="prename"  value="net">';echo $prename;}else{;echo '	  <input name="prename" type="text" id="prename"  value="';echo $prename;;echo '">
        <span class="style1">*</span> <INPUT name="but" type=button class=button_text  id="but" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="检测接点人" onClick="thschk(\'right\');"><span id="thdiv2"></span>';};echo '</TD>
	  </TR>
      <TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >选择市场:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
      <select name="pos" id="pos">
        ';
foreach($posary as $k=>$value){echo "<option value='".$k."'";
if ($pos==$k) echo " selected";
echo ">".$value."区</option>";}
;echo '      </select>
	 <span class="style1">* 先开A区</span></TD>
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
        <input type="hidden" name="isdp" value="0">
	<TR>
	    <TD align="right" valign="middle" bgColor="#FBFDFF" >所属服务中心:</TD>
	    <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zmdname" type="text" id="zmdname" value="';if ($userisdp==1) echo $_SESSION["glo_username"];echo '" > <span class="style1">*</span></TD>
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
		';$sqlc="select city from {$db_prefix}city where cityID='$city'";
$rsc=$db->get_one($sqlc);
echo "<option value='".$city."' selected='selected'>".$rsc['city']."</option>"
;echo '	      </select>
	    <select name="area" id="area">
		';$sqlc="select area from {$db_prefix}area where areaID='$area'";
$rsc=$db->get_one($sqlc);
echo "<option value='".$area."' selected='selected'>".$rsc['area']."</option>"
;echo '	      </select>
       <span class="style1">*</span> </TD>
	  </TR>
	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="address" type="text" id="address" size="40" value="';echo $address;;echo '">';if($glo_s_address){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
    <TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收货人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="receiver" type="text" id="receiver" size="40" value="';echo $receiver;;echo '">';if($glo_s_receiver){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
    <!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >座机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="phone" type="text" id="phone" value="';echo $phone;;echo '"> ';if($glo_s_phone){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	 <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >传真:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="fax" type="text" id="fax" value="';echo $fax;;echo '"> ';if($glo_s_fax){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="postcode" type="text" id="postcode" value="';echo $postcode;;echo '">
	  ';if($glo_s_postcode){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >Email:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="email" type="text" id="email" value="';echo $email;;echo '">';if($glo_s_email){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR> -->
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >QQ:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="qq" type="text" id="qq" value="';echo $qq;;echo '">';if($glo_s_qq){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
    
     <TR style="display:">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >身份证:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="idcard" type="text" id="idcard" size=25 value="';echo $idcard;;echo '"> ';if($glo_s_idcard){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	  <tbody style="display:">
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
echo "<option value=\"\">暂未添加银行，请联系管理员</option>";
}
;echo '        </select>
		 ';if($glo_s_bank){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >银行账号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zhanghao" type="text" id="zhanghao" size="35" value="';echo $zhanghao;;echo '">
	     ';if($glo_s_zhanghao){;echo '<span class="style1">*</span> ';};echo ' </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >户主:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="huzhu" type="text" id="huzhu" value="';echo $huzhu;;echo '">';if($glo_s_huzhu){;echo '<span class="style1">*</span> ';};echo ' </TD>
	  </TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >开户行地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="bankaddress" type="text" id="bankaddress" size="35" value="';echo $bankaddress;;echo '"></TD>
	</TR>
	</tbody>
	<TR>
	  <TD background="images/tab_19.gif"  colspan="2" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="注册" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</form>
<br><br>
</body></html>';
?>
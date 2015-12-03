<?php
echo '<HTML><HEAD><title>推广链接注册</title>
<meta http-equiv="X-UA-Compatible" content="IE=7,IE=10" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist3.css" type="text/css">
<script language="javascript" type="text/javascript" src="../jQuery/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../jQuery/jquery.alerts3.js"></script>
<script type="text/javascript" src="jq/jquery132.js"></script>
<script type="text/javascript" src="jq/jquery.select-1.3.6.js"></script>
<link rel="stylesheet" href="../jQuery/jquery.alerts.css" type="text/css">
';
include("../include/conn_1.php");include("../include/pv.php");
include("../include/pos.php");
include("../include/rank.php");
include("../include/function.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");
include("../include/logcls.php");
include("../include/setting.php");
;echo '';
$sql="select count(id) as c from {$db_prefix}users where 1";
$rs=$db->get_one($sql);
if (floatval($rs["c"])==0){die("<div style='margin-top:200px;font-weight:bold;text-align:center;'>系统未运行，请稍后操作</div>");}
function getrand(){
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
$sqlt="select id,state from {$db_prefix}users where 1 and username='".trim($_GET['tj'])."'";
$rst=$db->get_one($sqlt);
if($rst['id']){
if($rst['state']==0) die("<br><br><br><br><br><br><div style='width:700px;margin:0 auto;text-align:center;font-size:16px;'>未确认会员不能注册会员</div>");
}
if ($action=="reg"){
$modtime=time();$tjrname=trim($tjrname);$prename=trim($prename);
$hint="";
if(trim($username)=="") $hint.="请输入用户名\\n";
if(trim($tghttp)=="") $hint.="请点击获取推广链接\\n";
if($glo_s_realname){
if(trim($realname)=="") $hint.="请输入姓名\\n";
}
if($glo_s_idcard) {
}
if($hint==''&&trim($idcard)!=''&&$glo_idcard_only){
$sql="select id  from {$db_prefix}users where idcard='".trim($idcard)."'";
$rs=$db->get_one($sql);
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
if(trim($rank)=="") $hint.="请选择级别\\n";
if($glo_s_zmdname){
if(trim($zmdname)=="") $hint.="请输入所属店铺\\n";
}
if(trim($province)=="") $hint.="请选省份地区\\n";
if($glo_s_address){
if(trim($address)=="") $hint.="请输入收货地址\\n";
}
if($glo_s_receiver){
if(trim($receiver)=="") $hint.="请输入收货人\\n";
}
if($glo_s_mobile){
if(trim($mobile)=="") $hint.="请输入联系手机\\n";
}
if($glo_s_email){
if(trim($email)=="") $hint.="请输入邮箱\\n";
}
if($hint==''&&trim($email)!=''&&$glo_email_only){
$sql="select id  from {$db_prefix}users where email='".trim($email)."'";
$rs=$db->get_one($sql);
if(!empty($rs['id'])) $hint.="您输入的邮箱已被占用\\n";
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
if($glo_s_bankaddress){
if(trim($bankaddress)=="") $hint.="请输入开户行地址\\n";
}
$sql_chk="select * from {$db_prefix}users where username='".trim($username)."'";
$rs_chk=$db->get_one($sql_chk);
if (!empty($rs_chk["id"])) $hint.="会员编号已经被占用\\n";
$sql_chk1="select * from {$db_prefix}users where username='".trim($tjrname)."' and state=1";
$rs_chk1=$db->get_one($sql_chk1);
if (empty($rs_chk1["id"])) $hint.="推荐人验证失败\\n";
require("../autopwn.php");
$sql_chk2="select * from {$db_prefix}users where username='".trim($prename)."' and state=1";
$rs_chk2=$db->get_one($sql_chk2);
if (empty($rs_chk2["id"])) $hint.="接点人验证失败\\n";
$sql_chk3="select * from {$db_prefix}users where prename='".trim($prename)."' and pos='".$pos."'";
$rs_chk3=$db->get_one($sql_chk3);
if (!empty($rs_chk3["id"])) $hint.="接点人的".$pos."区已被占用\\n";
if (trim($zmdname)!=""){
$sql_chk4="select * from {$db_prefix}users where username='".trim($zmdname)."' and state=1 and isdp=1 ";
$rs_chk4=$db->get_one($sql_chk4);
if (empty($rs_chk4["id"])) $hint.="服务中心验证失败\\n";
}
if ($hint!=""){
;echo '		<script>alert(\'';echo $hint;;echo '\');location.href=\'register.php?tj=';echo $tjrname;;echo '\';</script>
	';exit();
}
$gldept=$rs_chk2["gldept"]+1;
$tjdept=$rs_chk1["tjdept"]+1;
if($rs_chk1['tjstr']) $tjstr=$rs_chk1['username'].",".$rs_chk1['tjstr'];else $tjstr=$rs_chk1['username'];
if($rs_chk2['glstr']) $glstr=$rs_chk2['username'].",".$rs_chk2['glstr'];else $glstr=$rs_chk2['username'];
$regstate=0;
$zsnum=0;
$isdp=0;$price=0;$bdmoney=0;$pv_reg=0;$bdnum=0;
$glo_rname="glo_member_".$rank;
$bdmoney=$$glo_rname;
$glo_rname="glo_num_".$rank;
$bdnum=$$glo_rname;
if($_GET['tj']){
$username=$_GET['tj'];
$sql="select price from {$db_prefix}users where username='".$username."' ";
$p_rs=$db->get_one($sql);
if($p_rs["price"]<$bdmoney){
$hint="对不起，推广人没有足够的电子币，请充值后再注册!";
}
}
if ($hint!=""){
;echo '		<script>alert(\'';echo $hint;;echo '\');location.href=\'register.php?tj=';echo $tjrname;;echo '\';</script>
	';exit();
}
if ($regstate==1){
$sqlkq="update {$db_prefix}users set price=price-{$bdmoney} where username='".$_SESSION["glo_username"]."' ";
$db->query($sqlkq);
$memo=11;$type=2;$optime=$modtime;$memo1="注册会员".$username;
eclsproc($_SESSION["glo_username"],$memo,$bdmoney,$type,$optime,$memo1);
}
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
$allm=$year*12+$month;
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
$db->query("update {$db_prefix}users set tjnum=tjnum+1 where username='".trim($tjrname)."'");
}
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
;echo '		<script>alert(\'注册完成\');location.href=\'register.php?tj=';echo $tj;;echo '\';</script>
	';exit();
}
$sqlu="select * from {$db_prefix}users where username='".$_GET['tj']."'";
$rsu=$db->get_one($sqlu);
$userisdp=$rsu['isdp'];
if (($userisdp!=1)){
}
;echo '<link rel="stylesheet" href="/images/datalist3.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
.STYLE2 {font-size: 12px; color:#e4cc9c;}
-->
</style>
<script language="javascript" type="text/javascript" src="../jQuery/jquery.alerts1.js"></script>
<script language="javascript">
function frmchk(frm){
	if (frm.username.value=="")
	{
		jAlert1(\'对不起，请输入用户名\', \'系统提示\');
		frm.username.focus();
		return false;
	}

	if (frm.tjrname.value=="")
	{
		jAlert1(\'对不起，请输入推荐人\', \'系统提示\');
		frm.tjrname.focus();
		return false;
	}
   if (frm.province.value=="")
	{ 
		jAlert1(\'对不起，请选择省份\', \'系统提示\');
		frm.province.focus();
		return false;
	}	
	  ';
if($glo_s_idcard){
;echo '   if (frm.idcard.value=="")
	{
		jAlert1(\'对不起，请输入身份证\', \'系统提示\');
		frm.idcard.focus();
		return false;
	}/*else{
		var idcardpreg=/^[0-9]{15,18}$/;
		if (!idcardpreg.test(frm.idcard.value)){
			jAlert1(\'对不起，请输入正确的身份证\', \'系统提示\');
			frm.idcard.focus();
			return false;
		}
	}*/
 	';};echo '	

	 ';
if($glo_s_address){
;echo '	if (frm.address.value=="")
	{
		jAlert1(\'对不起，请输入地址\',\'系统提示\');
		frm.address.focus();
		return false;
	}
    ';};echo '
	';
if($glo_s_receiver){
;echo '	if (frm.receiver.value=="")
	{
		jAlert1(\'对不起，请输入收货人\',\'系统提示\');
		frm.receiver.focus();
		return false;
	}
	';};echo '     ';
if($glo_s_mobile){
;echo '	if (frm.mobile.value=="")
	{
		jAlert1(\'对不起，请输入手机\',\'系统提示\');
		frm.mobile.focus();
		return false;
	}
    ';};echo '    /*   ';
if($glo_s_phone){
;echo '	if (frm.phone.value=="")
	{
		jAlert1(\'对不起，请输入联系方式\',\'系统提示\');
		frm.phone.focus();
		return false;
	}
     ';};echo '   ';
if($glo_s_postcode){
;echo '	if (frm.postcode.value=="")
	{
		jAlert1(\'对不起，请输入邮编\',\'系统提示\');
		frm.postcode.focus();
		return false;
	}
   ';};echo '*/
   ';
if($glo_s_bank){
;echo '	if (frm.bank.value=="")
	{
		jAlert1(\'对不起，请输入银行\',\'系统提示\');
		frm.bank.focus();
		return false;
	}
   ';};echo '   ';
if($glo_s_zhanghao){
;echo '	if (frm.zhanghao.value=="")
	{
		jAlert1(\'对不起，请输入账号\',\'系统提示\');
		frm.zhanghao.focus();
		return false;
	}
   ';};echo '   ';
if($glo_s_huzhu){
;echo '	if (frm.huzhu.value=="")
	{
		jAlert1(\'对不起，请输入户主\',\'系统提示\');
		frm.huzhu.focus();
		return false;
	}
    ';};echo '	/*if(frm.realname.value!=""&&frm.huzhu.value!="")
	{
		if(frm.realname.value!=frm.huzhu.value){
			alert("对不起，姓名和户主必须保持一致");	
			frm.huzhu.focus();
			return false;	
		}
	}*/
	';
if($glo_s_bankaddress){
;echo '	
	if (frm.bankaddress.value=="")
	{
		jAlert1(\'对不起，请输入开户行地址\',\'系统提示\');
		frm.bankaddress.focus();
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
function getLine(){
	var username=document.form1.username.value;
	var url=document.form1.url.value;
	var urls="http://"+url;
	document.getElementById("tglj").value=username;
	document.getElementById("tghttp").value=urls+username;
	document.getElementById(\'tgurl\').innerHTML=urls+username;
}
function thschk(from){
	if(from=="left") var username=document.form1.tjrname.value;
	if(from=="right") var username=document.form1.prename.value;
	var ifrm=document.getElementById("iframe1");
	ifrm.src="../check.php?username="+escape(username)+"&from="+from;
}
</script>
<script>function resize(){ parent.document.getElementById(\'I2\').style.height = document.body.scrollHeight>500?document.body.scrollHeight:500+"px";}window.onload=resize;window.onresize = resize;</script>
<SCRIPT type="text/javascript" language="javascript" src="../include/transfer.js"></SCRIPT>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
<link href="jq/selectStyle.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color:#E5EBF4;">
<iframe id="iframe1" name="iframe1" src="" style="display:none "></iframe>
<form name="form1" method="post" action="register.php?action=reg" onSubmit="return frmchk(this);">
<input type="hidden" name="temp1" value="haha">
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>推广链接注册</strong></TD>
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
;echo '</td>
      </tr>
  </table>  -->
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
	 <TR>
	  <TD width="30%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="70%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >
	  <input type="text" name="username" id="username"  value="';echo $t_username;;echo '">	  </TD>
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
	  <TD height="43" align="left" valign="middle" bgColor="#FBFDFF" ><input name="tjrname" type="text" id="tjrname" value="';echo $_GET['tj'];;echo '">
	    <span class="style1">*</span><INPUT name="but" type=button class=button_text  id="but" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="检测推荐人" onClick="thschk(\'left\');"><span id="thdiv"></span> </TD>
	  </TR>  
      <TR style="display:none;">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >接点人编号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';if($regfrom=="net"){;echo '<input name="prename" type="hidden" id="prename"  value="';echo $prename;;echo '"><input name="regfrom" type="hidden" id="prename"  value="net">';echo $prename;}else{;echo '	  <input name="prename" type="text" id="prename"  value="';echo $prename;;echo '">
        <span class="style1">*</span> <INPUT name="but" type=button class=button_text  id="but" onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="检测接点人" onClick="thschk(\'right\');"><span id="thdiv2"></span>';};echo '</TD>
	  </TR>
      <TR style="display:none;">
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
</body></html>';
?>
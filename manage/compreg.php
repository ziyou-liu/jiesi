<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");
include("../include/function.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");
include("../include/setting.php");
$sql="select count(id) as c from {$db_prefix}users where 1";
$rs=$db->get_one($sql);
if (floatval($rs["c"])>0) {header("location:userreg.php");exit();}
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
if ($action=="reg"){
$modtime=time();
$hint="";
if(trim($username)=="") $hint.="请输入会员编号\\n";
if(trim($pwd)=="") {
$hint.="请输入一级密码\\n";
}
if($pwd!=$repwd) $hint.="一级密码不一致\\n";
if(trim($pwd1)=="") {
$hint.="请输入二级密码\\n";
}
if($pwd1!=$repwd1) $hint.="二级密码不一致\\n";
if(trim($rank)=="") $hint.="请选择级别\\n";
if(trim($province)=="") $hint.="请选省份地区\\n";
$sql_chk="select * from {$db_prefix}users where username='".trim($username)."'";
$rs_chk=$db->get_one($sql_chk);
if (!empty($rs_chk["id"])) $hint.="会员编号已经被占用\\n";
if ($hint!=""){
;echo '		<script>alert(\'';echo $hint;;echo '\');location.href=\'compreg.php?';reset($_POST);if (count($_POST)){while (list($key,$val) = each($_POST)) {if(!is_array($_POST[$key])){echo $key."=".urlencode($_POST[$key])."&";}}};echo 'tempt=haha\';</script>
 ';exit();}
$isdp=0;$price=0;$bdmoney=0;$pv_reg=0;$bdnum=0;
if($isblank==0){
$glorname="glo_member_".$rank;
$bdmoney=$$glorname;
$pv_reg=$bdmoney;
$glorname="glo_num_".$rank;
$bdnum=$$glorname;
$glo_rname="glo_shopmon_".$rank;
$price_repeat1=$$glo_rname;
}
$timepre='';$timeok=0;$tjnet=1;
$sql="insert into {$db_prefix}users(username,realname,pwd,pwd1,pwd2,tjrname,prename,pos,price,bv,price_repeat1,bdmoney,bdnum,bdnum_team,pv_reg,pv_team_reg,pv_team_regp,rank0,rank,isdp,state,lognum,regtime,confirmtime,sex,province,city,area,mobile,postcode,address,email,idcard,bank,zhanghao,huzhu,fax,qq,regusername,regrealname,regtype,isblank,gldept,tjdept,shopprice,type,jifen,timepre,wenti1,wenti2,timeok,tjnet) values('".trim($username)."','".trim($realname)."','".mymd5($pwd,"EN")."','".mymd5($pwd1,"EN")."','".mymd5($pwd2,"EN")."','','',0,'$price','$bv','$price_repeat1','$bdmoney','$bdnum','$bdnum','$bdmoney','$bdmoney','$bdmoney','$rank','$rank','$isdp','1','0','$modtime','$modtime','$sex','$province','$city','$area','$mobile','$postcode','$address','$email','$idcard','$bank','$zhanghao','$huzhu','$fax','$qq','".$_SESSION["glo_adminname"]."','".$_SESSION["glo_adminreal"]."','0','$isblank','1',1,'$shopprice',1,'$jifen','$timepre','$wenti1','$wenti2','$timeok','$tjnet')";
$db->query($sql);
if($bdmoney>0){
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
insertintopv_1($year,$month,$day,$username,$bdmoney,$bdnum);
}
require("../autopw.php");
header("location:users.php");exit();
}
;echo '
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
</HEAD><body>
<form name="form1" method="post" action="?action=reg">

<br>
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD width=511 height=23>&nbsp;<strong>公司注册</strong></TD>
<TD width="85" >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="28%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="72%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';if($glo_reguser_1==0)echo $t_username;;echo '	  <input type="';if($glo_reguser_1) echo "text";else echo "hidden";;echo '" name="username" id="username" value="';echo $t_username;;echo '"> 
	  </TD>
	  </TR>
	<!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >昵称:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="nicheng" type="text" id="nicheng"></TD>
	  </TR>-->
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="realname" type="text" id="realname"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >一级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd" type="password" id="pwd" >
	  <!--（请使用数字与字母或字符组合）--><span class="style1">* 必填</span></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认一级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="repwd" type="password" id="repwd"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd1" type="password" id="pwd1" > <span class="style1">* 必填</span></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="repwd1" type="password" id="repwd1"></TD>
	  </TR>
	
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >会员级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <select name="rank" id="rank" >
      <!--<option value=\'\'>请选择</option>-->
	   ';
foreach($rankary as $key_1=>$value_1){
echo "<option value='{$key_1}'>{$value_1}</option>";
}
;echo '	    </select> 
	  <span class="style1">* 必选</span> </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >是否空点:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	    <select name="isblank">
		   <option value="0" ';if(isset($isblank)&&$isblank==0) echo "selected";;echo '>否</option>
		   <option value="1" ';if(isset($isblank)&&$isblank==1) echo "selected";;echo '>是</option>
		</select>
		 </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >性别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="sex" type="radio" value="男" checked>
	    男
	      <input type="radio" name="sex" value="女">
	      女</TD>
	  </TR>
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
if ($province==$rs_pro["provinceID"]) echo " selected";
echo ">".$rs_pro["province"]."</option>";
}
$db->free_result($result_pro);
;echo '	    </select>
	    <select name="city" id="city" onChange="_city(this.value,\'area\')">
		';$sqlc="select city from {$db_prefix}city where cityID='".$city."'";
$rsc=$db->get_one($sqlc);
echo "<option value='".$city."' selected='selected'>".$rsc['city']."</option>";
;echo '	      </select>
	    <select name="area" id="area">
		';$sqla="select area from {$db_prefix}area where areaID='$area'";
$rsa=$db->get_one($sqla);
echo "<option value='".$area."' selected='selected'>".$rsa['area']."</option>";
;echo '	      </select>
	    <span class="style1">* 必选</span></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >手机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="mobile" type="text" id="mobile"></TD>
	  </TR>
	<!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="postcode" type="text" id="postcode"></TD>
	  </TR>
	
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >email:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="email" type="text" id="email"></TD>
	  </TR>-->
      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="address" type="text" id="address" size="40"></TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确认" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>
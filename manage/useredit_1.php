<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/pos.php");include("../include/function.php");
include("../0123456789/1_s.php");include("../include/ecls.php");include("../include/rank.php");include("../include/sys.php");
$sql="select * from {$db_prefix}users where 1 and id='".$id."'";
$rs=$db->get_one($sql);
if (empty($rs["id"])) die("会员不存在");
if ($rs["state"]==1){header("location:useredit.php?id={$id}&pageno={$pageno}");exit();}
if ($action=="edit"){
$hint="";
if(trim($pwd)=="") $hint.="请输入密码\\n";
if(trim($pwd1)=="") $hint.="请输入二级密码\\n";
if(trim($tjrname)=="") $hint.="请输入推荐人\\n";
if(trim($prename)=="") $hint.="请输入接点人\\n";
if (($rank==1)&&(floatval($bdmoney)<$glo_price_r1_1)) $hint.="保单金额不能小于".$glo_price_r1_1;
if (($rank==1)&&(floatval($bdmoney)>$glo_price_r1_2)) $hint.="保单金额不能大于".$glo_price_r1_2;
if(trim($zhanghao)=="") $hint.="请输入账号\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk="select * from {$db_prefix}users where username='".trim($username)."'";
$rs_chk=$db->get_one($sql_chk);
if (!empty($rs_chk["id"])) $hint.="会员编号已经被占用\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk1="select * from {$db_prefix}users where username='".trim($tjrname)."' and state=1";
$rs_chk1=$db->get_one($sql_chk1);
if (empty($rs_chk1["id"])) $hint.="推荐人验证失败\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk2="select * from {$db_prefix}users where username='".trim($prename)."' and state=1";
$rs_chk2=$db->get_one($sql_chk2);
if (empty($rs_chk2["id"])) $hint.="接点人验证失败\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk3="select * from {$db_prefix}users where prename='".trim($prename)."' and pos='".$pos."' and id<>'".$id."'";
$rs_chk3=$db->get_one($sql_chk3);
if (!empty($rs_chk3["id"])) $hint.="接点人的".$pos."区已被占用\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
if (($pos==4) ||($pos==5)){
$sql_kq="select (pv2+pv3) as mpv from {$db_prefix}users where prename='".trim($prename)."' and FIND_IN_SET(pos,'1,2,3') order by (pv2+pv3) desc";
$rs_kq=$db->get_one($sql_kq);
$minipv=empty($rs_kq["mpv"])?0.00:floatval($rs_kq["mpv"]);
if ($minipv<$glo_3min_pv) die("<center>接点人的4、5区还不能开放</center>");
}
if (trim($zmdname)!=""){
$sql_chk4="select * from {$db_prefix}users where username='".trim($zmdname)."' and state=1";
$rs_chk4=$db->get_one($sql_chk4);
if (empty($rs_chk4["id"])) $hint.="专卖店验证失败\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
}
$glo_price=0;$glo_price1=0;$isdp=0;
switch($rank){
case 1:$glo_price=floatval($bdmoney);break;
case 2:$glo_price=floatval($glo_price_r2_1);$bdmoney=floatval($glo_price_r2_1);break;
case 7:$glo_price=floatval($glo_rank_7_one);$glo_price1=floatval($glo_rank_7_one);$isdp=1;$bdmoney=floatval($glo_rank_7_one);break;
}
$sql="update {$db_prefix}users set realname='".trim($realname)."',pwd='".mymd5($pwd,"EN")."',pwd1='".mymd5($pwd1,"EN")."',tjrname='".trim($tjrname)."',prename='".trim($prename)."',pos='".$pos."',zmdname='".trim($zmdname)."',bdmoney='".$glo_price."',price=0.00,price1='".$glo_price1."',price2=0.00,pv='".($glo_price/$glo_pv_vs_yuan)."',pv1=0.00,pv2='".($glo_price/$glo_pv_vs_yuan)."',pv3=0.00,rank0='".$rank."',rank='".$rank."',isdp='".$isdp."',state=0,lognum=0,sex='".$sex."',province='".$province."',city='".$city."',area='".$area."',mobile='".$mobile."',postcode='".$postcode."',address='".$address."',email='".$email."',bank='".trim($bank)."',zhanghao='".trim($zhanghao)."',huzhu='".trim($huzhu)."' where id='".$id."'";
$db->query($sql);
header("location:users.php?pageno={$pageno}");exit();
}
;echo '<style type="text/css">
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
		alert("请输入会员编号");
		frm.username.focus();
		return false;
	}

	if (frm.pwd.value=="")
	{
		alert("请输入密码");
		frm.pwd.focus();
		return false;
	}
	if (frm.pwd.value!=frm.repwd.value)
	{
		alert("两次密码错误");
		frm.pwd.focus();
		return false;
	}
	if (frm.pwd1.value=="")
	{
		alert("请输入二级密码");
		frm.pwd1.focus();
		return false;
	}
	if (frm.pwd1.value!=frm.repwd1.value)
	{
		alert("二级密码错误");
		frm.repwd1.focus();
		return false;
	}
	if (frm.tjrname.value=="")
	{
		alert("请输入推荐人");
		frm.tjrname.focus();
		return false;
	}
	if (frm.prename.value=="")
	{
		alert("请输入接点人");
		frm.prename.focus();
		return false;
	}
	if (frm.zhanghao.value=="")
	{
		alert("请输入账号");
		frm.zhanghao.focus();
		return false;
	}
}
function ignoreSpaces(string) {
var temp = "";
string = \'\' + string;
splitstring = string.split(" ");
for(i = 0; i < splitstring.length; i++)
temp += splitstring[i];
return temp;
}
function rankchange(t){
	if (t==1){
		document.form1.bdmoney.style.display="";
	}else{
		document.form1.bdmoney.style.display="none";
	}
}
</script>
</HEAD><body>
<form name="form1" method="post" action="?action=edit">

<br>
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>未确认会员修改</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="40%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="60%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo '	     </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="realname" type="text" id="realname" value="';echo $rs["realname"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd" type="password" id="pwd" value="';echo mymd5($rs["pwd"],"DE");;echo '">
	    <span class="style1">*</span> </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd1" type="password" id="pwd1" value="';echo mymd5($rs["pwd1"],"DE");;echo '">
	    <span class="style1">*</span> </TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >推荐人:</TD>
      <TD height="43" align="left" valign="middle" bgColor="#FBFDFF" ><input name="tjrname" type="text" id="tjrname" value="';echo $rs["tjrname"];echo '">
          <span class="style1">*</span> </TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >接点人:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="prename" type="text" id="prename" value="';echo $rs["prename"];echo '">
          <span class="style1">*</span></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >选择部门:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="pos">
          ';
foreach($posary as $value){echo "<option value='".$value."'";
if ($rs["pos"]==$value) echo " selected";
echo ">".$value."区</option>";}
;echo '      </select>
        <span class="style1">* 注意选好部门</span></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >报单店铺:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zmdname" type="text" id="zmdname" value="';echo $rs["zmdname"];echo '">
      </TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >会员级别:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="rank" id="rank" onChange="rankchange(this.value)">
          ';
foreach($rank1ary as $key_1=>$value_1){
echo "<option value='{$key_1}'";
if ($rs["rank"]==$key_1) echo " selected";
echo ">{$value_1}</option>";
}
;echo '        </select>
          <input name="bdmoney" type="text" id="bdmoney" size="5" value="';echo $rs["bdmoney"];echo '">
    元 <span class="style1">*</span> </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >性别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="sex" type="radio" value="男" ';if ($rs["sex"]=="男") echo "checked";echo '>
	    男
	      <input type="radio" name="sex" value="女" ';if ($rs["sex"]=="女") echo "checked";echo '>
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
if ($rs["province"]==$rs_pro["provinceID"]) echo " selected";
echo ">".$rs_pro["province"]."</option>";
}
$db->free_result($result_pro);
;echo '	    </select>
	    <select name="city" id="city" onChange="_city(this.value,\'area\')">
		';
$sql_city="select * from {$db_prefix}city where 1 order by id asc";
$result_city=$db->query($sql_city);
while ($rs_city=$db->fetch_array($result_city)){
echo "<option value='".$rs_city["cityID"]."'";
if ($rs["city"]==$rs_city["cityID"]) echo " selected";
echo ">".$rs_city["city"]."</option>";
}
$db->free_result($result_city);
;echo '	      </select>
	  <select name="area" id="area">
	  ';
$sql_area="select * from {$db_prefix}area where 1 order by id asc";
$result_area=$db->query($sql_area);
while ($rs_area=$db->fetch_array($result_area)){
echo "<option value='".$rs_area["areaID"]."'";
if ($rs["area"]==$rs_area["areaID"]) echo " selected";
echo ">".$rs_area["area"]."</option>";
}
$db->free_result($result_area);
;echo '	      </select></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >手机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="mobile" type="text" id="mobile" value="';echo $rs["mobile"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="postcode" type="text" id="postcode" value="';echo $rs["postcode"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="address" type="text" id="address" size="40" value="';echo $rs["address"];echo '"></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >email:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="email" type="text" id="email" value="';echo $rs["email"];echo '"></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >银行:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="bank" id="bank">
          <option value="工行" ';if ($rs["bank"]=="工行") echo "selected";echo '>工行</option>
          <option value="建行" ';if ($rs["bank"]=="建行") echo "selected";echo '>建行</option>
          <option value="农行" ';if ($rs["bank"]=="农行") echo "selected";echo '>农行</option>
        </select>      </TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >账号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zhanghao" type="text" id="zhanghao" size="35" value="';echo $rs["zhanghao"];echo '"></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >户主:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="huzhu" type="text" id="huzhu" value="';echo $rs["huzhu"];echo '"></TD>
	  </TR>
	<TR>
	  <TD height="38" colspan="2" align="center" valign="middle">

	    <input name="id" type="hidden" id="id" value="';echo $id;echo '">
	    <input name="pageno" type="hidden" id="pageno" value="';echo $pageno;echo '">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确认" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>
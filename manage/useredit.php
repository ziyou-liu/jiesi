<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">

';
include("../include/conn.php");include("../include/pos.php");include("../include/function.php");
include("../include/logcls.php");
include("../include/rank.php");
include("../include/setting.php");
$sql="select * from {$db_prefix}users where 1 and id='".$id."'";
$rs=$db->get_one($sql);
if (empty($rs["id"])) die("会员不存在");
if ($action=="edit"){
$hint="";
if($glo_s_realname){
if(trim($realname)=="") $hint.="请输入姓名\\n";
}
if(trim($pwd)=="") $hint.="请输入密码\\n";
if(trim($pwd1)=="") $hint.="请输入二级密码\\n";
if(trim($province)=="") $hint.="请选省份地区\\n";
if($glo_s_idcard) {if(trim($idcard)=='') $hint.="请输入身份证\\n";}
$idpreg="/^(\d{18,18}|\d{15,15}|\d{17,17}x|\d{17,17}X)$/";
if (trim($idcard)!='') {
if(!preg_match($idpreg,trim($idcard))) {
$hint.="请输入正确位数的身份证号\\n";
}
}
if($hint==''&&trim($idcard)!=''){
$sql="select id  from {$db_prefix}users where idcard='".trim($idcard)."' and id!='$id'";
$rs=$db->get_one($sql);
if(!empty($rs['id'])) $hint.="您输入的身份证已被占用\\n";
}
if($glo_s_address){
if(trim($address)=="") $hint.="请输入收货地址\\n";
}
if($glo_s_receiver){
if(trim($receiver)=="") $hint.="请输入收货人\\n";
}
if($glo_s_mobile){
if(trim($mobile)=="") $hint.="请输入联系手机\\n";
}
if($glo_s_bank){
if(trim($bank)=="") $hint.="请输入开户银行\\n";
}
if($glo_s_zhanghao){
if(trim($zhanghao)=="") $hint.="请输入银行账号\\n";
}
if($glo_s_huzhu){
if(trim($huzhu)=="") $hint.="请输入开户名\\n";
}
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql="update {$db_prefix}users set realname='".trim($realname)."',pwd='".mymd5($pwd,"EN")."',pwd1='".mymd5($pwd1,"EN")."',sex='".$sex."',province='".$province."',city='".$city."',area='".$area."',mobile='".trim($mobile)."',postcode='".trim($postcode)."',address='".trim($address)."',email='".trim($email)."',idcard='".trim($idcard)."',bank='".trim($bank)."',zhanghao='".trim($zhanghao)."',huzhu='".trim($huzhu)."',bankaddress='$bankaddress',receiver='$receiver',phone='$phone',fax='$fax',qq='$qq' where id='".$id."'";
$db->query($sql);
$sql1="select * from {$db_prefix}users where id='".$id."'";
$rs1=$db->get_one($sql1);
$username=$rs1["username"];
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=2;$log_addtime=time();$log_ip=getip();$log_memo="修改会员{$username}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
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
</HEAD><body>
<form name="form1" method="post" action="?action=edit">
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>确认会员修改</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="40%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="60%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo '	     </TD>
	  </TR>
	  <!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >昵称:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="nicheng" type="text" id="nicheng" value="';echo $rs["nicheng"];echo '"> <span class="style1">*</span>	    </TD>
	  </TR>-->
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="realname" type="text" id="realname" value="';echo $rs["realname"];echo '">	 ';if($glo_s_realname){;echo '<span class="style1">*</span> ';};echo '   </TD>
	  </TR>
	   <TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >身份证:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="idcard" type="text" id="idcard" value="';echo $rs["idcard"];echo '" size="22">';if($glo_s_idcard){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >一级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd" type="password" id="pwd" value="';echo mymd5($rs["pwd"],"DE");;echo '">
	    <span class="style1">*</span> </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="pwd1" type="password" id="pwd1" value="';echo mymd5($rs["pwd1"],"DE");;echo '">
	    <span class="style1">*</span> </TD>
	  </TR>
	  <!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >旅游记录:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="lvyou" type="text" id="lvyou" value="';echo $rs["lvyou"];echo '" size="55">	  </TD>
	  </TR>-->
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
$sql_city="select * from {$db_prefix}city where 1 and father='".$rs["province"]."' order by id asc";
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
$sql_area="select * from {$db_prefix}area where 1 and father='".$rs["city"]."' order by id asc";
$result_area=$db->query($sql_area);
while ($rs_area=$db->fetch_array($result_area)){
echo "<option value='".$rs_area["areaID"]."'";
if ($rs["area"]==$rs_area["areaID"]) echo " selected";
echo ">".$rs_area["area"]."</option>";
}
$db->free_result($result_area);
;echo '	      </select>
         <span class="style1">*</span>          </TD>
	  </TR>
      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收货地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="address" type="text" id="address" size="40" value="';echo $rs["address"];echo '">';if($glo_s_address){;echo '<span class="style1">*</span> ';};echo '<span class="style1">不包括省市地区</span></TD>
	 </TR>
     <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收货人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="receiver" type="text" id="receiver"  value="';echo $rs["receiver"];echo '">';if($glo_s_mobile){;echo '<span class="style1">*</span>';};echo '</TD>
	 </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >手机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="mobile" type="text" id="mobile" value="';echo $rs["mobile"];echo '">';if($glo_s_mobile){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
		<!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >座机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="phone" type="text" id="phone" value="';echo $rs["phone"];echo '">';if($glo_s_phone){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
 <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >传真:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="fax" type="text" id="fax" value="';echo $rs["fax"];;echo '"> ';if($glo_s_fax){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="postcode" type="text" id="postcode" value="';echo $rs["postcode"];echo '">';if($glo_s_postcode){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >Email:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="email" type="text" id="email" value="';echo $rs["email"];echo '">';if($glo_s_email){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >QQ:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="qq" type="text" id="qq" value="';echo $rs["qq"];;echo '">';if($glo_s_qq){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>-->
	 
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >银行:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	 <select name="bank" id="bank">
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
;echo '        </select>';if($glo_s_bank){;echo '<span class="style1">*</span> ';};echo ' </TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >银行账号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zhanghao" type="text" id="zhanghao" size="35" value="';echo $rs["zhanghao"];echo '">
        ';if($glo_s_zhanghao){;echo '        <span class="style1">*</span>
        ';};echo '</TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >户主:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="huzhu" type="text" id="huzhu" value="';echo $rs["huzhu"];echo '">';if($glo_s_huzhu){;echo '<span class="style1">*</span> ';};echo ' </TD>
	  </TR>
      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >开户行地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="bankaddress" type="text" id="bankaddress" size="35" value="';echo $rs["bankaddress"];echo '"></TD>
	  </TR>
	  <TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
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
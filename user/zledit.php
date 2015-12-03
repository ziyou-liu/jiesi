<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">

';
include("../include/conn_2.php");include("../include/pos.php");include("../include/function.php");include("../include/rank.php");
include("../include/secpwd.php");
include("../include/setting.php");
if ($action=="edit"){
$hint="";
if($glo_s_realname &&$glo_m_realname){
if(trim($realname)=="") $hint.="请输入姓名\\n";
}
if(trim($province)=="") $hint.="请选省份地区\\n";
if($glo_s_idcard &&$glo_m_idcard) {if(trim($idcard)=='') $hint.="请输入身份证\\n";}
$idpreg="/^(\d{18,18}|\d{15,15}|\d{17,17}x|\d{17,17}X)$/";
if (trim($idcard)!='') {
if(!preg_match($idpreg,trim($idcard))) {
$hint.="请输入正确的身份证号\\n";
}
}
if($hint==''&&trim($idcard)!=''){
$sql="select id  from {$db_prefix}users where idcard='".trim($idcard)."' and id!='".$_SESSION["glo_userid"]."'";
$rs=$db->get_one($sql);
if(!empty($rs['id'])) $hint.="您输入的身份证已被占用\\n";
}
if($glo_s_address &&$glo_m_address){
if(trim($address)=="") $hint.="请输入收货地址\\n";
}
if($glo_s_receiver &&$glo_m_receiver){
if(trim($receiver)=="") $hint.="请输入收货人\\n";
}
if($glo_s_mobile &&$glo_m_mobile){
if(trim($mobile)=="") $hint.="请输入联系手机\\n";
}
if($glo_s_bank &&$glo_m_bank){
if(trim($bank)=="") $hint.="请输入开户银行\\n";
}
if($glo_s_zhanghao &&$glo_m_zhanghao){
if(trim($zhanghao)=="") $hint.="请输入银行账号\\n";
}
if($glo_s_huzhu &&$glo_m_huzhu){
if(trim($huzhu)=="") $hint.="请输入开户名\\n";
}
if ($hint!=""){
echo "<script>alert('".$hint."');location.href='zledit.php';</script>";exit();
}
$sql="update {$db_prefix}users set sex='".$sex."',province='".$province."',city='".$city."',area='".$area."',mobile='".trim($mobile)."',postcode='".trim($postcode)."',address='".trim($address)."',email='".trim($email)."',idcard='".trim($idcard)."',bank='".trim($bank)."',zhanghao='".trim($zhanghao)."',huzhu='".trim($huzhu)."',bankaddress='$bankaddress',receiver='$receiver',phone='$phone',realname='$realname',fax='$fax',qq='$qq' where id='".$_SESSION["glo_userid"]."'";
$db->query($sql);
echo "<script>alert('恭喜您！资料已经修改成功');location.href='zledit.php';</script>";exit();
}
$sql="select * from {$db_prefix}users where id='".$_SESSION["glo_userid"]."'";
$rs=$db->get_one($sql);
;echo '<style type="text/css">
<!--
.style1 {color: #FF0000}
.STYLE3 {color: #FF0000; font-weight: bold; }
.STYLE5 {color: #000000}
-->
</style>
<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
</HEAD><body>
<form name="form1" method="post" action="?action=edit">
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>资料修改</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="38%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >会员编号：</TD>
	  <TD width="62%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo '	     </TD>
	  </TR>
	 <!-- <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >昵称：</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="nicheng" type="text" id="nicheng"  value="';echo $rs["nicheng"];echo '" size="20"> <span class="style1">*</span></TD>
	  </TR>-->
	   ';if($glo_m_realname){;echo '	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名：</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="realname" type="text" id="realname"  value="';echo $rs["realname"];echo '" size="20"> ';if($glo_s_realname){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	  ';}else{;echo '	  <input type="hidden" name="realname" value="';echo $rs["realname"];echo '">
	';};echo '	';if($glo_m_idcard){;echo '	  <TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >身份证:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="idcard" type="text" id="idcard" value="';echo $rs["idcard"];echo '" size="22"> ';if($glo_s_idcard){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	  ';}else{;echo '	<input name="idcard" type="hidden" id="idcard" value="';echo $rs["idcard"];echo '">
	';};echo '	
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >性别：</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="sex" type="radio" value="男" ';if ($rs["sex"]=="男") echo "checked";echo '>
	    男
	      <input type="radio" name="sex" value="女" ';if ($rs["sex"]=="女") echo "checked";echo '>
	      女</TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF">会员级别：</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF">';echo getuserrank($rs["rank"]);echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >省份、城市、地区:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
      <span id="adddis">
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
          </span><span class="style1">*</span>
          </TD>
	  </TR>
	  ';if($glo_m_address){;echo '     <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收货地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="address" type="text" id="address" size="40" value="';echo $rs["address"];echo '">';if($glo_s_address){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
	';}else{;echo '	<input name="address" type="hidden" id="address" size="40" value="';echo $rs["address"];echo '">
	';};echo '	';if($glo_m_receiver){;echo '	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收货人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="receiver" type="text" id="receiver" size="40" value="';echo $rs["receiver"];echo '">';if($glo_s_receiver){;echo '<span class="style1">*</span> ';};echo '</TD>
	 </TR>
	 ';}else{;echo '	<input name="receiver" type="hidden" id="receiver" size="40" value="';echo $rs["receiver"];;echo '">
	';};echo '	 ';if($glo_m_mobile){;echo '	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >联系手机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="mobile" type="text" id="mobile" value="';echo $rs["mobile"];echo '">';if($glo_s_mobile){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	 ';}else{;echo '	<input name="mobile" type="hidden" id="mobile" value="';echo $rs["mobile"];echo '">
	';};echo '	<!-- ';if($glo_m_phone){;echo '    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >联系座机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="phone" type="text" id="phone" value="';echo $rs["phone"];echo '">';if($glo_s_phone){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
	 ';}else{;echo '	<input name="phone" type="hidden" id="phone" value="';echo $rs["phone"];echo '">
	';};echo '	 ';if($glo_m_fax){;echo '    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >传真:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="fax" type="text" id="fax" value="';echo $rs["fax"];echo '">';if($glo_s_fax){;echo '<span class="style1">*</span> ';};echo '</TD>
	</TR>
	 ';}else{;echo '	<input name="fax" type="hidden" id="fax" value="';echo $rs["fax"];echo '">
	';};echo '	 ';if($glo_m_postcode){;echo '	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="postcode" type="text" id="postcode" value="';echo $rs["postcode"];echo '">';if($glo_s_postcode){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	 ';}else{;echo '	<input name="postcode" type="hidden" id="postcode" value="';echo $rs["postcode"];echo '">
	';};echo '	 ';if($glo_m_email){;echo '	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >Email:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="email" type="text" id="email" value="';echo $rs["email"];echo '">';if($glo_s_email){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	    ';}else{;echo '	<input name="email" type="hidden" id="email" value="';echo $rs["email"];echo '">
	';};echo '	 ';if($glo_m_qq){;echo '	  <TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >QQ:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="qq" type="text" id="qq" value="';echo $rs["qq"];echo '">';if($glo_s_qq){;echo '<span class="style1">*</span> ';};echo '</TD>
	  </TR>
	 ';}else{;echo '	<input name="qq" type="hidden" id="qq" value="';echo $rs["qq"];echo '">
	';};echo '-->
	 
	 ';if($glo_m_bank){;echo '	<TR>
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
echo "<option value=\"\">暂未添加银行，请联系管理员</option>";
}
;echo '        </select>';if($glo_s_bank){;echo '<span class="style1">*</span> ';};echo ' </TD>
	  </TR>
	  ';}else{;echo '	<input name="bank" type="hidden" id="bank" value="';echo $rs["bank"];echo '">
	';};echo '	 ';if($glo_m_zhanghao){;echo '	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >账号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zhanghao" type="text" id="zhanghao" size="35" value="';echo $rs["zhanghao"];echo '">
	    ';if($glo_s_zhanghao){;echo '        <span class="style1">*</span>
        ';};echo ' </TD>
	  </TR>
	  ';}else{;echo '	<input name="zhanghao" type="hidden" id="zhanghao" value="';echo $rs["zhanghao"];echo '">
	';};echo '	 ';if($glo_m_huzhu){;echo '	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >户主:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="huzhu" type="text" id="huzhu" value="';echo $rs["huzhu"];echo '">';if($glo_s_huzhu){;echo '<span class="style1">*</span> ';};echo ' </TD>
	  </TR>
	   ';}else{;echo '	<input name="huzhu" type="hidden" id="huzhu" value="';echo $rs["huzhu"];echo '">
	';};echo '      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >开户行地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="bankaddress" type="text" id="bankaddress" size="35" value="';echo $rs["bankaddress"];echo '"> </TD>
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
</body></html>';
?>
<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/rank.php");
include("../include/pv.php");
if ($action=="setting"){
$sql="update {$db_prefix}setting2 set m_realname='$m_realname',m_mobile='$m_mobile',m_phone='$m_phone',m_fax='$m_fax',m_address='$m_address',m_postcode='$m_postcode',m_zhanghao='$m_zhanghao',m_huzhu='$m_huzhu',m_idcard='$m_idcard',s_realname='$s_realname',s_mobile='$s_mobile',s_phone='$s_phone',s_fax='$s_fax',s_address='$s_address',s_postcode='$s_postcode',s_zhanghao='$s_zhanghao',s_huzhu='$s_huzhu',s_idcard='$s_idcard',m_qq='$m_qq',s_qq='$s_qq',m_bank='$m_bank',s_bank='$s_bank',s_email='$s_email',m_email='$m_email',m_receiver='$m_receiver',s_receiver='$s_receiver',identify_1='$identify_1',identify_2='$identify_2',reguser_1='$reguser_1',s_zmdname='$s_zmdname',denglu_1='$denglu_1'";
foreach($weekary as $key1=>$value1){
$sql.=",fweek_".$key1."='".$_POST["fweek_".$key1]."',tweek_".$key1."='".$_POST["tweek_".$key1]."' ";
}
$db->query($sql);
echo "<script>alert('设定成功');location.href='setting_sys.php';</script>";exit();
}
$sql="select * from {$db_prefix}setting2 where 1";
$rs=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="setting_sys.php">
<input type="hidden" name="action" value="setting">
<TABLE width="500" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="500" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"  background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>参数设定</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="25%" align="left" valign="middle" bgColor="#FBFDFF">注册必选项</td>
      <TD width="75%" align="left" valign="middle" bgColor="#FBFDFF"> 
	   <table>
	     <tr>
	      <td><input type="checkbox" name="s_realname" value="1" ';if($rs["s_realname"]) echo "checked";;echo '>姓名</td>
          <!--<td><input type="checkbox" name="s_qq" value="1" ';if($rs["s_qq"]) echo "checked";;echo '>QQ</td>
		  <td><input type="checkbox" name="s_email" value="1" ';if($rs["s_email"]) echo "checked";;echo '>Email</td>
		  <td><input type="checkbox" name="s_postcode" value="1" ';if($rs["s_postcode"]) echo "checked";;echo '>邮政编码</td>
		 </tr>
		 <tr>
		   
           <td><input type="checkbox" name="s_phone" value="1" ';if($rs["s_phone"]) echo "checked";;echo '>座机</td>
           <td><input type="checkbox" name="s_fax" value="1" ';if($rs["s_fax"]) echo "checked";;echo '>传真</td>-->
           <td><input type="checkbox" name="s_mobile" value="1" ';if($rs["s_mobile"]) echo "checked";;echo '>移动电话</td>
           <td><input type="checkbox" name="s_address" value="1" ';if($rs["s_address"]) echo "checked";;echo '>地址</td>
           <td><input type="checkbox" name="s_receiver" value="1" ';if($rs["s_receiver"]) echo "checked";;echo '>收货人</td>
		 </tr>
		 <tr>
		   <td><input type="checkbox" name="s_bank" value="1" ';if($rs["s_bank"]) echo "checked";;echo '>银行</td>
		   <td><input type="checkbox" name="s_zhanghao" value="1" ';if($rs["s_zhanghao"]) echo "checked";;echo '>银行卡号</td>
		   <td><input type="checkbox" name="s_huzhu" value="1" ';if($rs["s_huzhu"]) echo "checked";;echo '>户主</td>
		   <td><input type="checkbox" name="s_idcard" value="1" ';if($rs["s_idcard"]) echo "checked";;echo '>
		   身份证号</td>
		 </tr>
		 <!--<tr>
		  
		   <td colspan="4"><input type="checkbox" name="s_zmdname" value="1" ';if($rs["s_zmdname"]) echo "checked";;echo '>所属店铺</td>
		 </tr>-->
	   </table>
	  </td>
    </TR>
	<TR>
	  <TD width="25%" align="left" valign="middle" bgColor="#FBFDFF">会员可修改项目</td>
      <TD width="75%" align="left" valign="middle" bgColor="#FBFDFF"> 
	   <table>
	     <tr>
		   <td><input type="checkbox" name="m_realname" value="1" ';if($rs["m_realname"]) echo "checked";;echo '>姓名</td>
		   <!--<td><input type="checkbox" name="m_qq" value="1" ';if($rs["m_qq"]) echo "checked";;echo '>QQ</td>
		   <td><input type="checkbox" name="m_email" value="1" ';if($rs["m_email"]) echo "checked";;echo '>Email</td> 
		   <td><input type="checkbox" name="m_postcode" value="1" ';if($rs["m_postcode"]) echo "checked";;echo '>邮政编码</td>
		 </tr>
		 <tr>
		   
		   <td><input type="checkbox" name="m_phone" value="1" ';if($rs["m_phone"]) echo "checked";;echo '>座机</td>
		   <td><input type="checkbox" name="m_fax" value="1" ';if($rs["m_fax"]) echo "checked";;echo '>传真</td>-->
           <td><input type="checkbox" name="m_mobile" value="1" ';if($rs["m_mobile"]) echo "checked";;echo '>移动电话</td>
		   <td><input type="checkbox" name="m_address" value="1" ';if($rs["m_address"]) echo "checked";;echo '>地址</td> 
           <td><input type="checkbox" name="m_receiver" value="1" ';if($rs["m_receiver"]) echo "checked";;echo '>收货人</td>
		 </tr>
		 <tr>
		   <td><input type="checkbox" name="m_bank" value="1" ';if($rs["m_bank"]) echo "checked";;echo '>银行</td>
		  <td><input type="checkbox" name="m_zhanghao" value="1" ';if($rs["m_zhanghao"]) echo "checked";;echo '>银行卡号</td>
		   <td><input type="checkbox" name="m_huzhu" value="1" ';if($rs["m_huzhu"]) echo "checked";;echo '>
		   户主</td>
		   <td><input type="checkbox" name="m_idcard" value="1" ';if($rs["m_idcard"]) echo "checked";;echo '>身份证号</td>
		 </tr>
		  
	   </table>
	  </td>
    </TR>
	
	<TR>
	  <TD width="25%" align="left" valign="middle" bgColor="#FBFDFF">验证码</td>
      <TD width="75%" align="left" valign="middle" bgColor="#FBFDFF">
	  <input type="checkbox" name="identify_1" value="1" ';if($rs["identify_1"]) echo "checked";;echo '>前台开启 &nbsp;&nbsp;&nbsp;
	  <input type="checkbox" name="identify_2" value="1" ';if($rs["identify_2"]) echo "checked";;echo '>后台开启
	  </td>
    </TR>
	<TR>
	  <TD  align="left" valign="middle" bgColor="#FBFDFF">前台登录</td>
      <TD  align="left" valign="middle" bgColor="#FBFDFF">
	  <input type="checkbox" name="denglu_1" value="1" ';if($rs["denglu_1"]) echo "checked";;echo '>开启 	  </td>
    </TR>
	<TR>
	  <TD  align="left" valign="middle" bgColor="#FBFDFF">注册会员编号</td>
      <TD  align="left" valign="middle" bgColor="#FBFDFF">
	  <input type="checkbox" name="reguser_1" value="1" ';if($rs["reguser_1"]) echo "checked";;echo '><span class="hint">(勾选后编号自由填写)</span> 	  </td>
    </TR>
	<TR>
	  <TD width="25%" align="left" valign="middle" bgColor="#FBFDFF">会员登陆时间设置</td>
      <TD width="75%" align="left" valign="middle" bgColor="#FBFDFF">
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开始时间&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;结束时间<br>
	    ';
foreach($weekary as $key=>$value){
echo $value."&nbsp;&nbsp;";;echo ' <select name="fweek_';echo $key;echo '">
 ';for($i=0;$i<24;$i++){
if(strlen($i)<2) $n="0".$i;else $n=$i;
$name="";
if($rs["fweek_".$key]==$i) $name="selected";
echo "<option value=\"$n\" $name>".$n."</option>";
};echo ' </select>---
 <select name="tweek_';echo $key;echo '">
 ';for($i=0;$i<24;$i++){
if(strlen($i)<2) $n="0".$i;else $n=$i;
$name="";
if($rs["tweek_".$key]==$i) $name="selected";
echo "<option value=\"$n\" $name>".$n."</option>";};echo '</select><br>
		 ';
}
;echo '	  </td>
    </TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="5" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>
    </table></TD>

  </TR>
</TABLE>
</form>
</body></html>';
?>